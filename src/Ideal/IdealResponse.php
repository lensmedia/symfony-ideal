<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal;

use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Base class for ideal responses, don't forget to add the response property.
 */
abstract class IdealResponse implements IdealResponseInterface
{
    public ?ResponseInterface $response = null;

    public function setResponse(ResponseInterface $response): void
    {
        $this->response = $response;
    }

    public function headers(): array
    {
        if (!$this->response) {
            return [];
        }

        return $this->response->getHeaders(false);
    }

    public function info(): array
    {
        if (!$this->response) {
            return [];
        }

        return $this->response->getInfo();
    }
}
