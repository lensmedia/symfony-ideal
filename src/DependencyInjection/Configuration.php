<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

readonly class Configuration implements ConfigurationInterface
{
    public function __construct(
        private string $projectDir,
    ) {
    }

    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('lens_ideal');

        $rootNode = $treeBuilder->getRootNode();
        $rootNode
            ->children()
                ->scalarNode('merchant_id')
                    ->info('Your initiating party/merchant ID.')
                    ->isRequired()
                    ->cannotBeEmpty()
                    ->validate()
                        ->ifTrue(fn ($v) => !preg_match('/^\d+$/', $v))
                        ->thenInvalid('Merchant ID must be a 9 digit number.')
                    ->end()
                ->end()
                ->scalarNode('sub_id')
                    ->info('Your sub ID, used if you have multiple contracts under the same merchant ID.')
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
                        ->ifTrue($this->validateUrl(...))
                        ->thenInvalid('Acquirer URL must be a valid URL.')
                    ->end()
                ->end()

                ->scalarNode('public_key_path')
                    ->defaultValue($this->projectDir.'/config/certificates/ideal-public.pem')
                    ->cannotBeEmpty()
                    ->validate()
                        ->ifTrue($this->validateFilePath(...))
                        ->thenInvalid('Public key path must be a valid readable file path.')
                    ->end()
                ->end()

                ->scalarNode('private_key_pass')
                    ->defaultNull()
                    ->cannotBeEmpty()
                    ->info('Password used to generate private key file, used for validating the response.')
                ->end()

                ->scalarNode('private_key_path')
                    ->defaultValue($this->projectDir.'/config/certificates/ideal-private.key')
                    ->cannotBeEmpty()
                    ->validate()
                        ->ifTrue($this->validateFilePath(...))
                        ->thenInvalid('Private key path must be a valid readable file path.')
                   ->end()
                ->end()

                ->scalarNode('callback_url')
                    ->defaultNull()
                    ->cannotBeEmpty()
                    ->validate()
                        ->ifTrue($this->validateUrl(...))
                        ->thenInvalid('Callback URL must be a valid URL.')
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }

    private function validateUrl(?string $value): bool
    {
        return $value && !preg_match('/^https?:\/\//', $value);
    }

    private function validateFilePath(?string $path): bool
    {
        return $path && (!file_exists($path) || !is_readable($path));
    }
}
