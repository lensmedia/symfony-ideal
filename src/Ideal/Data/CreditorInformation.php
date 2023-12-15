<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * All creditor relevant data.
 */
class CreditorInformation implements SerializableRequestData
{
    /**
     * External identification of the subsidiary initiating party.
     */
    #[Assert\Length(min: 1, max: 50)]
    public ?string $initiatingPartySubId = null;

    /**
     * The name of creditor. Can be given for P2P payments only.
     */
    public ?string $name = null;

    public ?CreditorAccount $account = null;

    /**
     * BIC of the financial institution servicing an account for the creditor.
     */
    #[Assert\Bic]
    public ?string $agent = null;

    /**
     * Ultimate party to which an amount of money is due.
     */
    #[Assert\Length(max: 140)]
    public ?string $ultimateCreditor = null;

    public ?AddressData $postalAddress = null;

    /**
     * Date and place of birth of a person. This information must be requested for detection of Fraud, Money-Laundering
     * and Terrorism Financing in case of international payment.
     */
    public ?CreditorDateAndPlaceOfBirth $creditorDateAndPlaceOfBirth = null;

    public function jsonSerialize(): array
    {
        return array_filter([
            'InitiatingPartySubId' => $this->initiatingPartySubId,
            'Name' => $this->name,
            'Account' => $this->account,
            'Agent' => $this->agent,
            'UltimateCreditor' => $this->ultimateCreditor,
            'PostalAddress' => $this->postalAddress,
            'CreditorDateAndPlaceOfBirth' => $this->creditorDateAndPlaceOfBirth,
        ], 'is_null');
    }
}
