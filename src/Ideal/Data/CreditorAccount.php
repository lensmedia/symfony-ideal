<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

use Brick\Money\Currency;
use Lens\Bundle\IdealBundle\Ideal\Data\Type\IdentificationType;
use Lens\Bundle\IdealBundle\Ideal\Util;

class CreditorAccount implements SerializableRequestData
{
    /**
     * Secondary identification of the Creditor Account, to which a credit entry will be made as a result of the
     * transaction. (Only Openbank UK)
     */
    public ?string $secondaryIdentification = null;

    /**
     * Type of the account number.
     */
    public ?IdentificationType $schemeName = null;

    /**
     * Identification of the Creditor Account. Can be given for P2P payments only.
     */
    public ?string $identification = null;

    /**
     * A code allocated to a currency by a Maintenance Agency under an international identification scheme, as
     * described in the latest edition of the international standard ISO 4217 "Codes for the representation of
     * currencies and funds".
     */
    public ?Currency $currency = null;

    public function jsonSerialize(): array
    {
        return array_filter([
            'SecondaryIdentification' => $this->secondaryIdentification,
            'SchemeName' => Util::EnumToString($this->schemeName),
            'Identification' => $this->identification,
            'Currency' => Util::CurrencyToString($this->currency),
        ], 'is_null');
    }
}
