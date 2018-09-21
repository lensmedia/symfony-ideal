<?php

namespace Lens\Bundle\IdealBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    private $debug;
    private $cacheDir;
    private $projectDir;
    private $appSecret;

    public function __construct(
        bool $debug,
        string $cacheDir,
        string $projectDir,
        string $appSecret
    ) {
        $this->debug = $debug;
        $this->cacheDir = $cacheDir;
        $this->projectDir = $projectDir;
        $this->appSecret = $appSecret;
    }

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('lens_ideal');

        $rootNode
            ->children()
                ->booleanNode('test')
                    ->defaultValue($this->debug)
                    ->info('Set to true (default) for TEST dashboard and false for the LIVE dashboard')
                ->end()
                ->scalarNode('acquirer')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('merchant_id')
                    ->info('Your merchant ID')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('sub_id')
                    ->defaultValue('0')
                    ->info('Your sub ID')
                ->end()
                ->scalarNode('temp_path')
                    ->cannotBeEmpty()
                    ->defaultValue($this->cacheDir.'/')
                    ->info('Folder to store cached issuer list, should be writable (CHMOD 0777)')
                ->end()
                ->scalarNode('certificate_path')
                    ->cannotBeEmpty()
                    ->defaultValue($this->projectDir.'/config/certificates/')
                    ->info('Folder to store keys & certificates')
                ->end()
                ->scalarNode('private_certificate_file')
                    ->cannotBeEmpty()
                    ->defaultValue('merchantprivatecert.cer')
                    ->info('Private certificate file name')
                ->end()
                ->scalarNode('public_certificate_file')
                    ->defaultNull()
                    ->info('Public certificate file name')
                ->end()
                ->scalarNode('private_key_pass')
                    ->cannotBeEmpty()
                    ->defaultValue($this->appSecret)
                    ->info('Password used to generate private key file')
                ->end()
                ->scalarNode('private_key_file')
                    ->cannotBeEmpty()
                    ->defaultValue('merchantprivatekey.key')
                    ->info('Private key file name')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
