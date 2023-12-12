<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Lens\Bundle\IdealBundle\Ideal\IdealInterface;
use Lens\Bundle\IdealBundle\IdealFactory;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set(IdealFactory::class)
        ->args([
            abstract_arg('configuration'),
        ])

        ->set(IdealInterface::class)
        ->factory([
            service(IdealFactory::class),
            'create',
        ]);
};
