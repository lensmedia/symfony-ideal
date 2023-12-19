<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

use Lens\Bundle\IdealBundle\Ideal\Util;

/**
 * By this the Merchant is requesting the checkout data from the iDEAL Hub with the finalization of the transaction.
 */
class ExpectedCheckoutData implements SerializableRequestData
{
    public ?DebtorContactDetailsRequestData $debtorContactDetails = null;

    /**
     * Request to provide the details of the shipping address of the debtor.
     *
     * Default: false
     */
    public ?bool $shippingAddress = null;

    /**
     * Request to provide the details of the billing address of the debtor.
     *
     * Default: false
     */
    public ?bool $billingAddress = null;

    public function jsonSerialize(): array
    {
        return array_filter([
            'DebtorContactDetails' => $this->debtorContactDetails,
            'ShippingAddress' => $this->shippingAddress,
            'BillingAddress' => $this->billingAddress,
        ], Util::isNotNull(...));
    }
}
