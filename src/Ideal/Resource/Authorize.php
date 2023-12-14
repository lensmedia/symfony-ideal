<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Resource;

use Lens\Bundle\IdealBundle\Ideal\Data\AccessToken;
use Lens\Bundle\IdealBundle\Ideal\Exception\NotImplemented;
use Lens\Bundle\IdealBundle\Ideal\Ideal;

readonly class Authorize extends Resource
{
    private const BASE_URL = '/xs2a/routingservice/services/authorize';

    /**
     * Generates a token for the Initiating Party.
     */
    public function token(): AccessToken
    {
        $headers = [
            'App' => Ideal::APP,
            'Client' => $this->config()->client(),
            'Id' => $this->config()->id(),
            'Date' => date('c'),
        ];

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
    public function revoke(): void
    {
        // POST /revoke

        throw new NotImplemented(__METHOD__);
    }
}
