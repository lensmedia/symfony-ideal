<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

use Symfony\Contracts\HttpClient\ResponseInterface;

readonly class AccessToken
{
    public function __construct(
        public string $accessToken,
        public string $tokenType,
        public int $expiresIn,
    ) {
    }

    public static function fromResponse(ResponseInterface $request): AccessToken
    {
        $response = $request->toArray();

        return new self(
            $response['access_token'],
            $response['token_type'],
            $response['expires_in'],
        );
    }

    public function header(): string
    {
        return sprintf('%s %s', $this->tokenType, $this->accessToken);
    }
}
