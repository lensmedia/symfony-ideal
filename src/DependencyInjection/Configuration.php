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
                    ->info('Your merchant ID.')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('sub_id')
                    ->defaultValue(0)
                    ->info('Your sub ID.')
                ->end()

                ->scalarNode('client')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()

                ->scalarNode('acquirer_url')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()

                ->scalarNode('public_key_path')
                    ->cannotBeEmpty()
                    ->defaultValue($this->projectDir.'/config/certificates/ideal-public.pem')
                ->end()

                ->scalarNode('private_key_pass')
                    ->isRequired()
                    ->cannotBeEmpty()
                    ->info('Password used to generate private key file, used for validating the response.')
                ->end()

                ->scalarNode('private_key_path')
                    ->cannotBeEmpty()
                    ->defaultValue($this->projectDir.'/config/certificates/ideal-private.key')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
