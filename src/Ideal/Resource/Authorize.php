<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Resource;

use Lens\Bundle\IdealBundle\Ideal\Data\AccessToken;
use Lens\Bundle\IdealBundle\Ideal\IdealInterface;

readonly class Authorize extends Resource
{
    private const BASE_URL = '/xs2a/routingservice/services/authorize';

    /**
     * Generates a token for the Initiating Party.
     */
    public function token(): AccessToken
    {
        $headers = $this->headers();

        $options = [
            'headers' => $this->sign($headers, useAuthorizationHeaderInsteadOfSignature: true),
            'body' => [
                'grant_type' => 'client_credentials',
            ],
        ];

        return $this->ideal->post(self::BASE_URL.'/token', $options, AccessToken::class);
    }

    /**
     * Revokes a token for the Initiating Party.
     */
    public function revoke(AccessToken|string $accessToken): void
    {
        if ($accessToken instanceof AccessToken) {
            $accessToken = $accessToken->accessToken;
        }

        $headers = $this->headers();

        $this->ideal->post(self::BASE_URL.'/revoke', [
            'headers' => $this->sign($headers, useAuthorizationHeaderInsteadOfSignature: true),
            'body' => [
                'token' => $accessToken,
            ],
        ]);
    }

    private function headers(): array
    {
        return [
            'App' => IdealInterface::APP,
            'Client' => $this->config()->client(),
            'Id' => $this->config()->id(),
            'Date' => date('c'),
        ];
    }
}
