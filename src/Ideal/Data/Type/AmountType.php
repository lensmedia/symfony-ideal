<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data\Type;

enum AmountType: string
{
    /**
     * The amount defined by the merchant can not be changed by the user.
     */
    case Fixed = 'Fixed';

    /**
     * The amount defined by the merchant can be changed by the user within the defined bounds. Currently, can be used
     * only for iDEAL Payments.
     */
    case Change = 'Change';

    /**
     * The amount needs to be defined by the user. Currently, can be used only for iDEAL Payments.
     */
    case Define = 'Define';
}
