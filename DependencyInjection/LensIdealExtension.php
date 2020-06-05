<?php

namespace Lens\Bundle\IdealBundle\DependencyInjection;

use Lens\Bundle\IdealBundle\Request\IdealRequest;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class LensIdealExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        // configuration
        $configuration = new Configuration(
            $container->getParameter('kernel.debug'),
            $container->getParameter('kernel.cache_dir'),
            $container->getParameter('kernel.project_dir'),
            $container->getParameter('env(APP_SECRET)')
        );
        $config = $this->processConfiguration($configuration, $configs);

        // services
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );

        $loader->load('services.yaml');

        $issuer = $container->getDefinition(IdealRequest::class);
        $issuer->replaceArgument(1, $config);
    }
}
