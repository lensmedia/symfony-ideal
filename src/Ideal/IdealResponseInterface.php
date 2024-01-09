<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal;

use Symfony\Contracts\HttpClient\ResponseInterface;

interface IdealResponseInterface
{
    public function setResponse(ResponseInterface $response): void;
}
