<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Resource;

use Lens\Bundle\IdealBundle\Ideal\Configuration;
use Lens\Bundle\IdealBundle\Ideal\IdealInterface;
use Symfony\Component\Serializer\Exception\ExceptionInterface as SerializerExceptionInterface;

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
     * @template T
     *
     * @param array<string, mixed> $data
     * @param class-string<T> $class
     *
     * @return T
     *
     * @throws SerializerExceptionInterface
     */
    protected function denormalize(array $data, string $class, array $context = []): object
    {
        return $this->ideal->denormalize($data, $class, $context);
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

        return 'Signature: '.implode(', ', $parts);
    }

    protected function digest(string $payload): string
    {
        return 'SHA-256='.base64_encode(hash('sha256', $payload, true));
    }

    protected function isSuccessfulHttpStatus(int $status): bool
    {
        return $status >= 200 && $status < 300;
    }
}
