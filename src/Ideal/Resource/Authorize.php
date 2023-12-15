<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Resource;

use Exception;
use Lens\Bundle\IdealBundle\Ideal\Data\AccessToken;
use Lens\Bundle\IdealBundle\Ideal\Ideal;

readonly class Authorize extends Resource
{
    private const BASE_URL = '/xs2a/routingservice/services/authorize';

    /**
     * Generates a token for the Initiating Party.
     */
    public function token(): AccessToken
    {
        $headers = $this->headers();

        // POST /token
        $request = $this->ideal->post(self::BASE_URL.'/token', [
            'headers' => $headers + [
                'Authorization' => $this->signature($headers),
            ],
            'body' => [
                'grant_type' => 'client_credentials',
            ],
        ]);

        return AccessToken::fromResponse($request);
    }

    /**
     * Revokes a token for the Initiating Party.
     */
    public function revoke(AccessToken|string $accessToken): bool
    {
        if ($accessToken instanceof AccessToken) {
            $accessToken = $accessToken->accessToken;
        }

        $headers = $this->headers();

        // POST /revoke
        $request = $this->ideal->post(self::BASE_URL.'/revoke', [
            'headers' => $headers + [
                'Authorization' => $this->signature($headers),
            ],
            'body' => [
                'token' => $accessToken,
            ],
        ]);

        try {
            return $this->isSuccessfulHttpStatus($request->getStatusCode());
        } catch (Exception $exception) {
            $this->ideal->logger?->error($exception->getMessage());

            return false;
        }
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
