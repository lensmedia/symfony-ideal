<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Resource;

use Lens\Bundle\IdealBundle\Ideal\Configuration;
use Lens\Bundle\IdealBundle\Ideal\IdealInterface;

readonly abstract class Resource
{
    public function __construct(
        protected IdealInterface $ideal,
    ) {
    }

    public function config(): Configuration
    {
        return $this->ideal->config();
    }

    /**
     * Converts header array to signature string.
     */
    protected function signature(array $headers): string
    {
        $signature = [
            'keyId' => $this->config()->fingerprint(),
            'algorithm' => 'SHA256withRSA',
            'headers' => strtolower(implode(' ', array_keys($headers))),
            'signature' => $this->config()->sign($headers),
        ];

        $parts = [];
        foreach ($signature as $key => $value) {
            $parts[] = sprintf('%s="%s"', $key, $value);
        }

        return 'Signature '.implode(', ', $parts);
    }

    protected function isSuccessfulHttpStatus(int $status): bool
    {
        return $status >= 200 && $status < 300;
    }
}
