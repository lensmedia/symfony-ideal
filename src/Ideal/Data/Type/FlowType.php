<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data\Type;

enum FlowType: string
{
    /**
     * Used for normal iDEAL transactions.
     */
    case Standard = 'Standard';

    /**
     * Used for initiating the fast checkout flow where the debtor will be requested to provide checkout details which
     * in turn iDEAL provides them to the merchant via a callback eventually.
     */
    case FastCheckout = 'FastCheckout';
}
