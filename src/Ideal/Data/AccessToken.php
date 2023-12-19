<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

class AccessToken
{
    public string $accessToken;

    public string $tokenType;

    public int $expiresIn = 0;

    public function __toString(): string
    {
        return sprintf('%s %s', $this->tokenType, $this->accessToken);
    }
}
