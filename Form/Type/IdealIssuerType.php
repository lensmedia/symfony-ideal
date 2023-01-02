<?php

namespace Lens\Bundle\IdealBundle\Form\Type;

use Lens\Bundle\IdealBundle\Ideal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IdealIssuerType extends AbstractType
{
    public function __construct(
        private Ideal $ideal,
    ) {
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'choices' => array_flip($this->ideal->issuers()),
        ]);
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }
}
