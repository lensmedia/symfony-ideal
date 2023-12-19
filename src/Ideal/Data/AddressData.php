<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

use Lens\Bundle\IdealBundle\Ideal\Util;
use Symfony\Component\Validator\Constraints as Assert;

class AddressData implements SerializableRequestData
{
    /**
     * The first name of the debtor.
     *
     * @example Bob
     */
    #[Assert\Length(min: 1)]
    public ?string $firstName = null;

    /**
     * The last name of the debtor.
     *
     * @example Smith
     */
    #[Assert\Length(min: 1)]
    public ?string $lastName = null;

    /**
     * The company name of the debtor.
     *
     * @example Cookie factory
     */
    #[Assert\Length(min: 1)]
    public ?string $companyName = null;

    /**
     * The postal code of the address without spaces.
     *
     * @example 1234AB
     */
    #[Assert\Regex(pattern: '/^[1-9][0-9]{3}[A-Z]{2}$/')]
    public ?string $postCode = null;

    /**
     * The house number of the address.
     */
    #[Assert\Length(min: 1)]
    public ?string $buildingNumber = null;

    /**
     * The addition of the address.
     *
     * @example 3B
     */
    #[Assert\Length(min: 1)]
    public ?string $floor = null;

    /**
     * The street of the address
     *
     * @example Coolsingel
     */
    #[Assert\Length(min: 1)]
    public ?string $streetName = null;

    /**
     * The city of the address.
     *
     * @example Rotterdam
     */
    #[Assert\Length(min: 1)]
    public ?string $townName = null;

    /**
     * The code of the country regarding ISO 3166 standard. For the IDEAL payments the country name will be provided
     */
    #[Assert\Country]
    public ?string $country = null;

    /**
     * Country subdivision.
     */
    #[Assert\Length(min: 1, max: 35)]
    public ?string $countrySubDivision = null;

    public function jsonSerialize(): array
    {
        return array_filter([
            'FirstName' => $this->firstName,
            'LastName' => $this->lastName,
            'CompanyName' => $this->companyName,
            'PostCode' => $this->postCode,
            'BuildingNumber' => $this->buildingNumber,
            'Floor' => $this->floor,
            'StreetName' => $this->streetName,
            'TownName' => $this->townName,
            'Country' => $this->country,
            'CountrySubDivision' => $this->countrySubDivision,
        ], Util::isNotNull(...));
    }
}
