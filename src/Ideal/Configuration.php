<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal;

use InvalidArgumentException;

readonly class Configuration
{
    public function __construct(
        public string $merchantId,
        public string $client,
        public string $acquirerUrl,
        public string $publicKeyPath,
        public string $privateKeyPath,
        public string $privateKeyPass,
        public int $subId = 0,
    ) {
        if (!preg_match('/^https?:\/\//', $acquirerUrl)) {
            throw new InvalidArgumentException(sprintf(
                'Acquirer URL "%s" is not a valid URL',
                $acquirerUrl,
            ));
        }

        if (!file_exists($publicKeyPath) || !is_readable($publicKeyPath)) {
            throw new InvalidArgumentException(sprintf(
                'Public key file "%s" does not exist or is not readable',
                $publicKeyPath,
            ));
        }

        if (!file_exists($privateKeyPath) || !is_readable($privateKeyPath)) {
            throw new InvalidArgumentException(sprintf(
                'Private key file "%s" does not exist or is not readable',
                $privateKeyPath,
            ));
        }

        if ($subId < 0) {
            throw new InvalidArgumentException(sprintf(
                'Sub ID "%s" is not a valid sub ID',
                $subId,
            ));
        }
    }
}
