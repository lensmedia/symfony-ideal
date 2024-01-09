<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\DependencyInjection;

use Lens\Bundle\IdealBundle\IdealFactory;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class LensIdealExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration(
            $container->getParameter('kernel.project_dir'),
        );

        $config = $this->processConfiguration($configuration, $configs);

        $loader = new PhpFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.php');

        $container->getDefinition(IdealFactory::class)
            ->setArgument(0, $config);
    }
}
