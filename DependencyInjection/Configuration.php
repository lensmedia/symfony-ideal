<?php

namespace Lens\Bundle\IdealBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function __construct(
        private bool $debug,
        private string $cacheDir,
        private string $projectDir,
        private string $appSecret
    ) {
    }

    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('lens_ideal');

        $treeBuilder
            ->getRootNode()
            ->children()
                ->booleanNode('test')
                    ->defaultValue($this->debug)
                    ->info('Set to true (default) for TEST dashboard and false for the LIVE dashboard.')
                ->end()
                ->scalarNode('acquirer')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('protocol')
                    ->cannotBeEmpty()
                    ->defaultValue('ssl')
                    ->info('Override protocol to use for our iDeal requests.')
                ->end()
                ->scalarNode('language')
                    ->cannotBeEmpty()
                    ->defaultValue('nl')
                    ->info('Default fallback locale for iDeal transactions issuer pages.')
                ->end()
                ->scalarNode('currency')
                    ->cannotBeEmpty()
                    ->defaultValue('EUR')
                    ->info('This should not be altered as iDeal only supports EUR so far.')
                ->end()
                ->scalarNode('expiration_period')
                    ->cannotBeEmpty()
                    ->defaultValue('PT1H')
                    ->info('Expiration period for transactions defaulting to one hour (PT1H) see https://en.wikipedia.org/wiki/ISO_8601#Durations.')
                ->end()
                ->scalarNode('merchant_id')
                    ->info('Your merchant ID.')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('sub_id')
                    ->defaultValue('0')
                    ->info('Your sub ID.')
                ->end()
                ->scalarNode('temp_path')
                    ->cannotBeEmpty()
                    ->defaultValue($this->cacheDir.'/')
                    ->info('Folder to store cached issuer list, should be writable (CHMOD 0777).')
                ->end()
                ->scalarNode('certificate_path')
                    ->cannotBeEmpty()
                    ->defaultValue($this->projectDir.'/config/certificates/')
                    ->info('Folder to store keys & certificates.')
                ->end()
                ->scalarNode('private_certificate_file')
                    ->cannotBeEmpty()
                    ->defaultValue('merchantprivatecert.cer')
                    ->info('Private certificate file name.')
                ->end()
                ->scalarNode('public_certificate_file')
                    ->defaultNull()
                    ->info('Public certificate file name.')
                ->end()
                ->scalarNode('private_key_pass')
                    ->cannotBeEmpty()
                    ->defaultValue($this->appSecret)
                    ->info('Password used to generate private key file.')
                ->end()
                ->scalarNode('private_key_file')
                    ->cannotBeEmpty()
                    ->defaultValue('merchantprivatekey.key')
                    ->info('Private key file name.')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
