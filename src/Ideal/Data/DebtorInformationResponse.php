<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * All debtor relevant data.
 */
class DebtorInformationResponse
{
    /**
     * The name of the debtor.
     */
    #[Assert\Length(min: 1, max: 140)]
    public ?string $name = null;

    /**
     * BIC of the financial institution servicing an account for the creditor.
     */
    #[Assert\Bic]
    public ?string $agent = null;

    public ?DebtorAccount $account = null;

    public ?DebtorContactDetailsResponse $contactDetails = null;

    public ?AddressData $shippingAddress = null;

    public ?AddressData $billingAddress = null;
}
