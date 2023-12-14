<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal;

use Lens\Bundle\IdealBundle\Ideal\Exception\InvalidConfiguration;
use Lens\Bundle\IdealBundle\Ideal\Exception\UnableToGenerateSignature;
use OpenSSLAsymmetricKey;
use OpenSSLCertificate;

class Configuration
{
    public const DATE_FORMAT = 'c';

    private OpenSSLCertificate $publicKey;
    private OpenSSLAsymmetricKey $privateKey;

    public function __construct(
        public readonly string $merchantId,
        public readonly string $client,
        public readonly string $baseUrl,
        public readonly string $publicKeyPath,
        public readonly string $privateKeyPath,
        public readonly ?string $privateKeyPass = null,
        public readonly ?string $callbackUrl = null,
        public readonly int $subId = 0,
    ) {
        $this->validateUrl($baseUrl, sprintf(
            'Acquirer URL "%s" is not a valid URL',
            $baseUrl,
        ));

        $this->validateFile($publicKeyPath, sprintf(
            'Public key file "%s" does not exist or is not readable',
            $publicKeyPath,
        ));

        $this->initializePublicKey($this->publicKeyPath);

        $this->validateFile($privateKeyPath, sprintf(
            'Private key file "%s" does not exist or is not readable',
            $privateKeyPath,
        ));

        $this->initializePrivateKey($this->privateKeyPath, $this->privateKeyPass);

        $this->validateSubId($subId);

        if ($callbackUrl) {
            $this->validateUrl($callbackUrl, sprintf(
                'Callback URL "%s" is not a valid URL',
                $callbackUrl,
            ));
        }
    }

    public function id(): string
    {
        return $this->subId
            ? sprintf('%s:%d', $this->merchantId, $this->subId)
            : $this->merchantId;
    }

    public function client(): string
    {
        return $this->client;
    }

    public function fingerprint(): string
    {
        return openssl_x509_fingerprint($this->publicKey);
    }

    public function sign(array $headers): string
    {
        $parts = [];
        foreach ($headers as $header => $value) {
            $parts[] = sprintf("%s: %s", strtolower($header), $value);
        }

        return openssl_sign(implode("\n", $parts), $signature, $this->privateKey, OPENSSL_ALGO_SHA256)
            ? base64_encode($signature)
            : throw new UnableToGenerateSignature('Unable to generate signature using headers '.implode(', ', array_keys($headers)));
    }

    private function validateUrl(string $url, string $errorMessage): void
    {
        if (!preg_match('/^https?:\/\//', $url)) {
            throw new InvalidConfiguration($errorMessage);
        }
    }

    private function validateFile(string $path, string $errorMessage): void
    {
        if (!file_exists($path) || !is_readable($path)) {
            throw new InvalidConfiguration($errorMessage);
        }
    }

    private function validateSubId(int $subId): void
    {
        if ($subId < 0 || $subId > 255) {
            throw new InvalidConfiguration(sprintf(
                'Sub ID "%s" is not a valid sub ID',
                $subId,
            ));
        }
    }

    private function initializePublicKey(string $publicKeyFile): void
    {
        $publicKey = openssl_x509_read(file_get_contents($publicKeyFile));
        if (!$publicKey) {
            throw new InvalidConfiguration('Unable to get public key, it seems to be an invalid key/certificate.');
        }

        $this->publicKey = $publicKey;
    }

    private function initializePrivateKey(string $privateKeyFile, ?string $privateKeyPass): void
    {
        $privateKey = openssl_pkey_get_private(
            file_get_contents($privateKeyFile),
            $privateKeyPass,
        );

        if (!$privateKey) {
            throw new InvalidConfiguration('Unable to get private key, it seems to be an invalid key/certificate.');
        }

        $this->privateKey = $privateKey;
    }
}
