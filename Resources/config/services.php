<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Lens\Bundle\IdealBundle\Form\Type\IdealIssuerType;
use Lens\Bundle\IdealBundle\Ideal;
use Lens\Bundle\IdealBundle\Request\AcquirerStatusReq;
use Lens\Bundle\IdealBundle\Request\AcquirerTrxReq;
use Lens\Bundle\IdealBundle\Request\DirectoryReq;
use Lens\Bundle\IdealBundle\Request\IdealRequest;
use Lens\Bundle\IdealBundle\Validator\Constraints\IdealIssuerValidator;
use Symfony\Component\DependencyInjection\Argument\AbstractArgument;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set(IdealRequest::class)
            ->abstract()
            ->args([service(HttpClientInterface::class), new AbstractArgument('defined in Extension')])

        ->set(DirectoryReq::class)->parent(IdealRequest::class)
        ->set(AcquirerTrxReq::class)->parent(IdealRequest::class)
        ->set(AcquirerStatusReq::class)->parent(IdealRequest::class)

        ->set(Ideal::class)
            ->args([
                service(CacheInterface::class),
                service(AcquirerStatusReq::class),
                service(DirectoryReq::class),
            ])

        ->set(IdealIssuerType::class)
            ->args([service(Ideal::class)])
            ->tag('form.type', ['extended_type' => ChoiceType::class])

        ->set(IdealIssuerValidator::class)
            ->args([service(Ideal::class)])
            ->tag('validator.constraint_validator')
    ;
};

