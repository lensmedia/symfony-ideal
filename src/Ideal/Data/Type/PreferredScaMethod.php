<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data\Type;

enum PreferredScaMethod: string
{
    case Redirect = 'Redirect';
    case Decoupled = 'Decoupled';
    case Embedded = 'Embedded';
}
