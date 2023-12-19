<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle;

use Lens\Bundle\IdealBundle\Ideal\Configuration;
use Lens\Bundle\IdealBundle\Ideal\Ideal;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Used to create an instance of the iDEAL client using values defined in the symfony configuration files.
 *
 * This class is not meant to be used directly. Use the "IdealInterface" dependency injection instead.
 *
 * @internal
 */
final readonly class IdealFactory
{
    public function __construct(
        private array $config,
        private SerializerInterface $denormalizer,
    ) {
    }

    public function create(): Ideal
    {
        $config = new Configuration(
            merchantId: $this->config['merchant_id'],
            client: $this->config['client'],
            baseUrl: $this->config['base_url'],
            publicKeyPath: $this->config['public_key_path'],
            privateKeyPath: $this->config['private_key_path'],
            privateKeyPass: $this->config['private_key_pass'],
            callbackUrl: $this->config['callback_url'],
            subId: $this->config['sub_id'],
        );

        return new Ideal($config, $this->denormalizer);
    }
}
