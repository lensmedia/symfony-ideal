<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

class BillingAddress implements SerializableRequestData
{
    /**
     * Indicates whether the billing address is the same with shipping address. If true the information provided under
     * BillingAddressDetails will be ignored.
     *
     * Defaults to true
     */
    public ?bool $sameAsShippingAddress = null;

    public ?AddressData $billingAddressDetails = null;

    public function jsonSerialize(): array
    {
        return [
            'SameAsShippingAddress' => $this->sameAsShippingAddress,
            'BillingAddressDetails' => $this->billingAddressDetails,
        ];
    }
}
