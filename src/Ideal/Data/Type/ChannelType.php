<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data\Type;

enum ChannelType: string
{
    case ContactLess = 'ContactLess';
    case PointOfSale = 'PointOfSale';
    case Ecommerce = 'Ecommerce';
    case UnattendedTerminal = 'UnattendedTerminal';
}
