<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data\Type;

enum AuthenticationApproach: string
{
    case Ca = 'CA';
    case Sca = 'SCA';
}
