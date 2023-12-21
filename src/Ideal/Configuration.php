<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal;

use Lens\Bundle\IdealBundle\Ideal\Exception\InvalidConfiguration;
use Lens\Bundle\IdealBundle\Ideal\Exception\UnableToGenerateSignature;
use OpenSSLAsymmetricKey;
use OpenSSLCertificate;
use SensitiveParameter;

class Configuration
{
    private OpenSSLCertificate $publicKey;
    private OpenSSLAsymmetricKey $privateKey;

    public readonly ?string $notificationToken;

    public function __construct(
        public readonly string $initiatingPartyId,
        public readonly string $client,
        public readonly string $baseUrl,

        string $publicKeyPath,
        string $privateKeyPath,
        #[SensitiveParameter]
        ?string $privateKeyPass = null,

        public readonly int $subId = 0,

        public readonly ?string $notificationPath = null,
        #[SensitiveParameter]
        ?string $notificationToken = null,
    ) {
        $this->validateUrl($baseUrl, sprintf(
            'Acquirer URL "%s" is not a valid URL',
            $baseUrl,
        ));

        $this->validateFile($publicKeyPath, sprintf(
            'Public key file "%s" does not exist or is not readable',
            $publicKeyPath,
        ));

        $this->initializePublicKey($publicKeyPath);

        $this->validateFile($privateKeyPath, sprintf(
            'Private key file "%s" does not exist or is not readable',
            $privateKeyPath,
        ));

        $this->initializePrivateKey($privateKeyPath, $privateKeyPass);

        $this->validateSubId($subId);

        $this->notificationToken = $notificationToken;
    }

    public function id(): string
    {
        return $this->subId
            ? sprintf('%s:%d', $this->initiatingPartyId, $this->subId)
            : $this->initiatingPartyId;
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

    private function initializePrivateKey(
        string $privateKeyFile,

        #[SensitiveParameter]
        ?string $privateKeyPass,
    ): void {
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
