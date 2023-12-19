<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

use Brick\Money\Currency;
use Lens\Bundle\IdealBundle\Ideal\Data\Type\IdentificationType;
use Lens\Bundle\IdealBundle\Ideal\Util;

class DebtorAccount implements SerializableRequestData
{
    /**
     * Type of the account number.
     */
    public ?IdentificationType $schemeName = null;

    /**
     * Unambiguous identification of the account of the debtor to which a debit entry will be made as a result of the
     * transaction.
     */
    public ?string $identification = null;

    /**
     * Secondary identification of the Debtor Account, to which a debit entry will be made as a result of the
     * transaction. (Only Openbank UK)
     */
    public ?string $secondaryIdentification = null;

    /**
     * A code allocated to a currency by a Maintenance Agency under an international identification scheme, as
     * described in the latest edition of the international standard ISO 4217 "Codes for the representation of
     * currencies and funds".
     */
    public ?Currency $currency = null;

    public function jsonSerialize(): array
    {
        return array_filter([
            'SchemeName' => Util::enumToString($this->schemeName),
            'Identification' => $this->identification,
            'SecondaryIdentification' => $this->secondaryIdentification,
            'Currency' => Util::currencyToString($this->currency),
        ], Util::isNotNull(...));
    }
}
