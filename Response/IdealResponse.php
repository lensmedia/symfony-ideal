<?php

namespace Lens\Bundle\IdealBundle\Response;

use DateTimeImmutable;
use Exception;
use SimpleXMLElement;
use Symfony\Component\HttpFoundation\HeaderBag;

abstract class IdealResponse implements IdealResponseInterface
{
    protected $status;
    protected $headers;
    protected $content;

    protected function __construct(int $status, HeaderBag $headers, SimpleXMLElement $content)
    {
        $this->status = $status;
        $this->headers = $headers;
        $this->content = $content;
    }

    public static function create(int $status, array $headers, string $content)
    {
        $headers = new HeaderBag($headers);

        if (false === ($content = @simplexml_load_string($content))) {
            throw new Exception('Response does not seem to contain valid XML.');
        }

        $class = '\\'.__NAMESPACE__.'\\'.$content->getName();
        if (!class_exists($class) || !is_a($class, IdealResponseInterface::class, true)) {
            throw new Exception(sprintf(
                "Unsupported response detected '%s', aborting.",
                $class
            ));
        }

        $instance = new $class($status, $headers, $content);
        if (($instance instanceof AcquirerStatusRes) && ('Success' !== $instance->status())) {
            throw self::createTransactionException($instance);
        }

        return $instance;
    }

    private static function createTransactionException(AcquirerStatusRes $response): Exception
    {
        $namespace = explode('\\', __NAMESPACE__);
        array_pop($namespace);

        $exception = '\\'.implode('\\', $namespace).'\\Exception\\IdealTransaction'.$response->status().'Exception';
        if (!class_exists($exception)) {
            throw new Exception(sprintf(
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
}
