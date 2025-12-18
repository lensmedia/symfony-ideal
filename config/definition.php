<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;

return static function (DefinitionConfigurator $definition): void {
    static $validateUrl = static fn(?string $value): bool => $value && !preg_match('/^https?:\/\//', $value);
    static $validateFilePath = static fn(?string $path): bool => $path && (!file_exists($path) || !is_readable($path));

    $rootNode = $definition->rootNode();

    $rootNode->children()
        ->scalarNode('initiating_party_id')
            ->info('Your initiating party ID, e.g. with Rabobank this is your dashboard id.')
            ->isRequired()
            ->cannotBeEmpty()
            ->validate()
                ->ifTrue(fn ($v) => !preg_match('/^\d+$/', $v))
                ->thenInvalid('Initiating party ID must only contain digits.')
            ->end()
        ->end()
        ->scalarNode('sub_id')
            ->info('Your sub ID, used if you have multiple contracts under the same party.')
            ->defaultValue(0)
        ->end()

        ->scalarNode('client')
            ->isRequired()
            ->cannotBeEmpty()
        ->end()

        ->scalarNode('base_url')
            ->isRequired()
            ->cannotBeEmpty()
            ->validate()
                ->ifTrue($validateUrl)
                ->thenInvalid('Acquirer URL must be a valid URL.')
            ->end()
        ->end()

        ->scalarNode('public_key_path')
            ->cannotBeEmpty()
            ->validate()
                ->ifTrue($validateFilePath)
                ->thenInvalid('Public key path must be a valid readable file path.')
            ->end()
        ->end()

        ->scalarNode('private_key_pass')
            ->defaultNull()
            ->cannotBeEmpty()
            ->info('Password used to generate private key file, used for validating the response.')
        ->end()

        ->scalarNode('private_key_path')
            ->cannotBeEmpty()
            ->validate()
                ->ifTrue($validateFilePath)
                ->thenInvalid('Private key path must be a valid readable file path.')
           ->end()
        ->end()

        ->scalarNode('callback_url')
            ->defaultNull()
            ->cannotBeEmpty()
            ->validate()
                ->ifTrue($validateUrl)
                ->thenInvalid('Callback URL must be a valid URL.')
            ->end()
        ->end()
    ->end();

    $rootNode->children()
        ->arrayNode('notifications')
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('token')
                    ->defaultNull()
                    ->cannotBeEmpty()
                ->end()
            ->end()
        ->end()
    ->end();
};
