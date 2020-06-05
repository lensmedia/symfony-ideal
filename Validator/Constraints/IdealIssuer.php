<?php

namespace Lens\Bundle\IdealBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class IdealIssuer extends Constraint
{
    public $message = 'Invalid iDeal issuer value.';
}
