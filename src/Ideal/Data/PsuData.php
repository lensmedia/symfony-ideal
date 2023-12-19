<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

use Lens\Bundle\IdealBundle\Ideal\Util;
use Symfony\Component\Validator\Constraints as Assert;

class PsuData implements SerializableRequestData
{
    /**
     * The ID of the ASPSP. The Open Banking Service needs this information to route the payment, so it has to be
     * either provided in this field or it should be available in PSU management as the preferred bank of the PSU.
     */
    #[Assert\Length(min: 1)]
    public ?string $aspspId = null;

    /**
     * This is describing the ProductCode as defined by the ASPSP.
     */
    public ?string $aspspProductCode = null;

    /**
     * PSU's ID at ASPSP. Allows the unique identification of the PSU at the ASPSP.
     */
    public ?string $aspspPsuId = null;

    /**
     * PSU's second ID at ASPSP. Required for some ASPSPs
     */
    public ?string $aspspCustomerId = null;

    /**
     * Type of the ASPSP PSU-ID, needed in scenarios where PSU's have several PSU-IDs as access possibility.
     */
    public ?string $aspspPsuIdType = null;

    /**
     * Identification of a Corporate in the Online Channels.
     */
    public ?string $aspspPsuCorporateId = null;

    /**
     * This is describing the type of the identification needed by the ASPSP to identify the PsuCorporate-ID content.
     */
    public ?string $aspspPsuCorporateIdType = null;

    /**
     * The code of the country regarding ISO 3166 standard. For the IDEAL payments the country name will be provided
     */
    #[Assert\Country]
    public ?string $country = null;

    public function jsonSerialize(): array
    {
        return array_filter([
            'AspspId' => $this->aspspId,
            'AspspProductCode' => $this->aspspProductCode,
            'AspspPsuId' => $this->aspspPsuId,
            'AspspCustomerId' => $this->aspspCustomerId,
            'AspspPsuIdType' => $this->aspspPsuIdType,
            'AspspPsuCorporateId' => $this->aspspPsuCorporateId,
            'AspspPsuCorporateIdType' => $this->aspspPsuCorporateIdType,
            'Country' => $this->country,
        ], Util::isNotNull(...));
    }
}
