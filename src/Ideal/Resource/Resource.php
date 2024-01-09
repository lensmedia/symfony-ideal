<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Resource;

use Lens\Bundle\IdealBundle\Ideal\Configuration;
use Lens\Bundle\IdealBundle\Ideal\IdealInterface;
use Lens\Bundle\IdealBundle\Ideal\ObjectMapperInterface;

readonly abstract class Resource implements ObjectMapperInterface
{
    public function __construct(
        protected IdealInterface $ideal,
    ) {
    }

    public function config(): Configuration
    {
        return $this->ideal->config();
    }

    public function map(string|array $data, string $type, array $context = []): object
    {
        return $this->ideal->map($data, $type, $context);
    }

    /**
     * Converts header array to signature string.
     */
    protected function sign(array $headers, bool $useAuthorizationHeaderInsteadOfSignature = false): array
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

        unset($headers['(Request-Target)']);

        $header = $useAuthorizationHeaderInsteadOfSignature
            ? 'Authorization'
            : 'Signature';

        $headers[$header] = 'Signature '.implode(', ', $parts);

        return $headers;
    }

    protected function digest(string $payload): string
    {
        return 'SHA-256='.base64_encode(hash('sha256', $payload, true));
    }

    protected function authorizationHeader(): string
    {
        return $this->ideal->authorize->token()->asAuthorizationHeader();
    }
}
