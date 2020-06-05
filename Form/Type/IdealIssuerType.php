<?php

namespace Lens\Bundle\IdealBundle\Form\Type;

use Lens\Bundle\IdealBundle\Ideal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IdealIssuerType extends AbstractType
{
    private $ideal;

    public function __construct(Ideal $ideal)
    {
        $this->ideal = $ideal;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'choices' => array_flip($ideal->issuers()),
        ]);
    }

    public function getParent()
    {
        return ChoiceType::class;
    }
}
