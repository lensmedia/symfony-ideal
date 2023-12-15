<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data\Type;

enum RateType: string
{
    /**
     * Exchange rate applied is the spot rate.
     */
    case Spot = 'Spot';

    /**
     * Exchange rate applied is the market rate at the time of the sale.
     */
    case Sale = 'Sale';

    /**
     * Exchange rate applied is the rate agreed between the parties.
     */
    case Agreed = 'Agreed';
}
