<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

return static function (ContainerConfigurator $container): void {
    $container->extension('framework', [
        'serializer' => [
            'named_serializers' => [
                'lens_ideal' => [
                    'name_converter' => 'serializer.name_converter.camel_case_to_snake_case',
                    'include_built_in_normalizers' => true,
                    'include_built_in_encoders' => true,
                ],
            ],
        ],
    ]);
};
