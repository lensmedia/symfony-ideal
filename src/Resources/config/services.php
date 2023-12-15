<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Lens\Bundle\IdealBundle\Ideal\IdealInterface;
use Lens\Bundle\IdealBundle\IdealFactory;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set(IdealFactory::class)
        ->args([
            abstract_arg('configuration'),
            service(CacheItemPoolInterface::class),
            service(LoggerInterface::class),
        ])

        ->set(IdealInterface::class)
        ->factory([
            service(IdealFactory::class),
            'create',
        ]);
};
