<?php

namespace Lens\Bundle\IdealBundle\Response;

use DateTimeImmutable;
use DOMDocument;
use Exception;
use Lens\Bundle\IdealBundle\Exception\IdealErrorResponseException;
use RuntimeException;
use SimpleXMLElement;

abstract class IdealResponse implements IdealResponseInterface
{
    protected function __construct(
        protected int $status,
        protected array $info,
        protected ?SimpleXMLElement $content = null
    ) {
    }

    public function __serialize(): array
    {
        return [
            'status' => $this->status,
            'content' => $this->content?->asXML(),
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->status = $data['status'];
        $this->content = $data['content']
            ? simplexml_load_string($data['content'])
            : null;
    }

    public static function create(int $status, array $info, string $content)
    {
        if (false === ($content = @simplexml_load_string($content))) {
            throw new RuntimeException('Response does not seem to contain valid XML.');
        }

        $class = '\\'.__NAMESPACE__.'\\'.$content->getName();
        if (!class_exists($class) || !is_a($class, IdealResponseInterface::class, true)) {
            throw new RuntimeException(sprintf(
                "Unsupported response detected '%s', aborting.",
                $class
            ));
        }

        $instance = new $class($status, $info, $content);

        // See if we got an error response from the api.
        $caseStatusError = $instance instanceof AcquirerStatusRes && 'Success' !== $instance->status();
        $caseErrorResponse = $instance instanceof AcquirerErrorRes;
        if ($caseErrorResponse || $caseStatusError) {
            throw $caseStatusError
                ? self::createTransactionException($instance)
                : self::createException($instance);
        }

        return $instance;
    }

    private static function createException(AcquirerErrorRes $response): Exception
    {
        return new IdealErrorResponseException($response);
    }

    private static function createTransactionException(AcquirerStatusRes $response): Exception
    {
        $namespace = explode('\\', __NAMESPACE__);
        array_pop($namespace);

        $exception = '\\'.implode('\\', $namespace).'\\Exception\\IdealTransaction'.ucfirst($response->status()).'Exception';
        if (!class_exists($exception)) {
            throw new RuntimeException(sprintf(
                "Unsupported status detected '%s', aborting.",
                $response->status()
            ));
        }

        return new $exception($response);
    }

    public function timestamp(): DateTimeImmutable
    {
        return new DateTimeImmutable($this->content->createDateTimestamp);
    }

    public function digestValue(): string
    {
        return (string) $this->content->Signature->SignedInfo->Reference->DigestValue;
    }

    public function signatureValue(): string
    {
        return (string) $this->content->Signature->SignatureValue;
    }

    public function keyName(): string
    {
        return (string) $this->content->Signature->KeyInfo->KeyName;
    }

    public function responseContent(): string
    {
        if (!$this->content) {
            return '';
        }

        $dom = new DOMDocument("1.0");
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($this->content->asXML());

        return $dom->saveXML();
    }
}
