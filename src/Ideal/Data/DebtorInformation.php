<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

use Lens\Bundle\IdealBundle\Ideal\Util;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * All debtor relevant data.
 */
class DebtorInformation implements SerializableRequestData
{
    /**
     * The name of the debtor.
     */
    #[Assert\Length(max: 140)]
    public ?string $name = null;

    /**
     * BIC of the financial institution servicing an account for the debtor.
     */
    #[Assert\Bic]
    public ?string $agent = null;

    public ?DebtorAccount $account = null;

    /**
     * Ultimate party that owes an amount of money to the (ultimate) creditor.
     */
    #[Assert\Length(max: 140)]
    public ?string $ultimateDebtor = null;

    public ?AddressData $shippingAddress = null;

    public ?BillingAddress $billingAddress = null;

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'Name' => $this->name,
            'Agent' => $this->agent,
            'Account' => $this->account,
            'UltimateDebtor' => $this->ultimateDebtor,
            'ShippingAddress' => $this->shippingAddress,
            'BillingAddress' => $this->billingAddress,
        ], Util::isNotNull(...));
    }
}
