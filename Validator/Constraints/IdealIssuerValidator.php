<?php

namespace Lens\Bundle\IdealBundle\Validator\Constraints;

use Lens\Bundle\IdealBundle\Ideal;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class IdealIssuerValidator extends ConstraintValidator
{
    public function __construct(
        private Ideal $ideal,
    ) {
    }

    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof IdealIssuer) {
            throw new UnexpectedTypeException($constraint, IdealIssuer::class);
        }

        if ((null === $value) || ('' === $value)) {
            return;
        }

        $issuers = $this->ideal->issuers();
        if (!is_array($issuers) || !isset($issuers[$value])) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
