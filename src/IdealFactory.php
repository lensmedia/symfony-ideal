<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle;

use InvalidArgumentException;
use Lens\Bundle\IdealBundle\Ideal\Configuration;
use Lens\Bundle\IdealBundle\Ideal\Ideal;

final readonly class IdealFactory
{
    public function __construct(
        private array $config,
    ) {
    }

    public function create(): Ideal
    {
        $config = new Configuration(
            merchantId: $this->config['merchant_id'] ?? throw new InvalidArgumentException('Merchant ID is required'),
            client: $this->config['client'] ?? throw new InvalidArgumentException('Client is required'),
            acquirerUrl: $this->config['acquirer_url'] ?? throw new InvalidArgumentException('Acquirer URL is required'),
            publicKeyPath: $this->config['public_key_path'] ?? throw new InvalidArgumentException('Public key path is required'),
            privateKeyPath: $this->config['private_key_path'] ?? throw new InvalidArgumentException('Private key path is required'),
            privateKeyPass: $this->config['private_key_pass'] ?? throw new InvalidArgumentException('Public key pass is required'),
            subId: $this->config['sub_id'] ?? throw new InvalidArgumentException('Sub ID is required'),
        );

        return new Ideal($config);
    }
}
