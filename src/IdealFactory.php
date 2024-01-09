<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle;

use Lens\Bundle\IdealBundle\Ideal\Configuration;
use Lens\Bundle\IdealBundle\Ideal\Ideal;
use Lens\Bundle\IdealBundle\Ideal\ObjectMapperInterface;

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
        private ObjectMapperInterface $objectMapper,
    ) {
    }

    public function create(): Ideal
    {
        /** @noinspection PhpNamedArgumentsWithChangedOrderInspection */
        $config = new Configuration(
            initiatingPartyId: $this->config['initiating_party_id'],
            subId: $this->config['sub_id'],

            client: $this->config['client'],
            baseUrl: $this->config['base_url'],

            publicKeyPath: $this->config['public_key_path'],
            privateKeyPath: $this->config['private_key_path'],
            privateKeyPass: $this->config['private_key_pass'],

            notificationToken: $this->config['notifications']['token'],
        );

        return new Ideal($config, $this->objectMapper);
    }
}
