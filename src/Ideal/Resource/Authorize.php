<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Resource;

use Lens\Bundle\IdealBundle\Ideal\Data\AccessToken;
use Lens\Bundle\IdealBundle\Ideal\Ideal;

readonly class Authorize extends Resource
{
    private const BASE_URL = '/xs2a/routingservice/services/authorize';

    /**
     * Generates a token for the Initiating Party.
     */
    public function token(bool $debugToken = false): AccessToken
    {
        if ($debugToken) {
            return new AccessToken('97fb13a74c712d8c7a50476e71769eaf', 'Bearer');
        }

        $headers = $this->headers();

        $response = $this->ideal->post(self::BASE_URL.'/token', [
            'headers' => $headers + [
                'Authorization' => $this->signature($headers),
            ],
            'body' => [
                'grant_type' => 'client_credentials',
            ],
        ]);

        return $this->denormalize($response, AccessToken::class);
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
            'headers' => $headers + [
                    'Authorization' => $this->signature($headers),
                ],
            'body' => [
                'token' => $accessToken,
            ],
        ]);
    }

    private function headers(): array
    {
        return [
            'App' => Ideal::APP,
            'Client' => $this->config()->client(),
            'Id' => $this->config()->id(),
            'Date' => date('c'),
        ];
    }
}
