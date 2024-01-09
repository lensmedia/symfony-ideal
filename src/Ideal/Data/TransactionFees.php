<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

/**
 * Information used for transporting transaction fees by the ASPSP.
 */
class TransactionFees
{
    use MoneyTrait;

    /**
     * Indicates if transaction fees are applicable on the payment.
     */
    public bool $feesApply = false;
}
