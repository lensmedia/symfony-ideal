<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Lens\Bundle\IdealBundle\Ideal\IdealInterface;
use Lens\Bundle\IdealBundle\IdealFactory;
use Lens\Bundle\IdealBundle\ObjectMapper;
use Lens\Bundle\IdealBundle\Serializer\Normalizer\BigDecimalDenormalizer;
use Lens\Bundle\IdealBundle\Serializer\Normalizer\CurrencyDenormalizer;

return static function (ContainerConfigurator $container): void {
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
            service('serializer.lens_ideal'),
        ])

        ->set(BigDecimalDenormalizer::class)
        ->tag('serializer.normalizer')

        ->set(CurrencyDenormalizer::class)
        ->tag('serializer.normalizer');
};
