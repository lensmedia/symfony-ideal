<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

use Lens\Bundle\IdealBundle\Ideal\IdealResponse;

class AccessToken extends IdealResponse
{
    public string $accessToken;

    public string $tokenType;

    public int $expiresIn = 0;

    public function asAuthorizationHeader(): string
    {
        return sprintf('%s %s', $this->tokenType, $this->accessToken);
    }
}
