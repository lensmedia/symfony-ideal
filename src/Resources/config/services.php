<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Lens\Bundle\IdealBundle\Ideal\IdealInterface;
use Lens\Bundle\IdealBundle\IdealFactory;
use Lens\Bundle\IdealBundle\ObjectMapper;
use Symfony\Component\Serializer\SerializerInterface;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set(IdealFactory::class)
        ->args([
            abstract_arg('configuration'),
            service(ObjectMapper::class),
        ])

        ->set(IdealInterface::class)
        ->factory([
            service(IdealFactory::class),
            'create',
        ])

        ->set(ObjectMapper::class)
        ->args([
            service(SerializerInterface::class),
        ]);
};
