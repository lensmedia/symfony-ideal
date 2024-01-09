<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal;

use DateTimeImmutable;
use JetBrains\PhpStorm\ArrayShape;
use Lens\Bundle\IdealBundle\Ideal\Resource\PaymentArrayShapeTrait;
use Symfony\Component\Uid\Uuid;
use Symfony\Contracts\HttpClient\Exception\HttpExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Base class for ideal responses, don't forget to add the response property.
 */
abstract class IdealResponse implements IdealResponseInterface
{
    use PaymentArrayShapeTrait;

    public ?ResponseInterface $response = null;

    public function setResponse(ResponseInterface $response): void
    {
        $this->response = $response;
    }

    #[ArrayShape([
        /**
         * UUID for unique request identification
         */
        'X-Request-ID' => 'string',

        /**
         * The message create date time.
         *
         * ISO 8601 DateTime.
         */
        'MessageCreateDateTime' => 'string',

        /**
         * Required for IDEAL payments.
         */
        'Signature' => 'string',

        /**
         * Is contained if and only if the Signature element is contained in the header of the request.
         */
        'Digest' => 'string',
    ])]
    public function headers(): array
    {
        if (!$this->response) {
            return [];
        }

        static $headers = [];

        if (empty($headers)) {
            try {
                $headers = $this->response->getHeaders(false);
            } catch (TransportExceptionInterface|HttpExceptionInterface) {
            }
        }

        return $headers;
    }

    public function header(string $name): ?string
    {
        return $this->headers()[$name];
    }

    public function requestId(): ?Uuid
    {
        return $this->header('X-Request-ID')
            ? Uuid::fromString($this->header('X-Request-ID'))
            : null;
    }

    public function messageCreatedAt(): DateTimeImmutable
    {
        return new DateTimeImmutable($this->header('MessageCreateDateTime') ?? '');
    }

    public function signature(): ?string
    {
        return $this->header('Signature');
    }

    public function digest(): ?string
    {
        return $this->header('Digest');
    }

    public function info(): array
    {
        if (!$this->response) {
            return [];
        }

        return $this->response->getInfo();
    }
}
