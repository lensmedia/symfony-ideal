<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

use DateTimeImmutable;
use Lens\Bundle\IdealBundle\Ideal\Util;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Date and place of birth of a person. This information must be requested for detection of Fraud, Money-Laundering and
 * Terrorism Financing in case of international payment.
 */
class CreditorDateAndPlaceOfBirth implements SerializableRequestData
{
    /**
     * Date on which the creditor was born.
     */
    public DateTimeImmutable $birthDate;

    /**
     * City where the creditor was born.
     */
    #[Assert\Length(max: 35)]
    public string $cityOfBirth;

    /**
     * Country where the creditor was born.
     */
    #[Assert\Country]
    public string $countryOfBirth;

    public function __construct(DateTimeImmutable $birthDate, string $cityOfBirth, string $countryOfBirth)
    {
        $this->birthDate = $birthDate;
        $this->cityOfBirth = $cityOfBirth;
        $this->countryOfBirth = strtoupper($countryOfBirth);
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'BirthDate' => Util::dateToString($this->birthDate),
            'CityOfBirth' => $this->cityOfBirth,
            'CountryOfBirth' => $this->countryOfBirth,
        ], Util::isNotNull(...));
    }
}
