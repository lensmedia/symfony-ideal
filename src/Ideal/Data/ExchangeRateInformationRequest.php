<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

use Brick\Math\BigDecimal;
use Brick\Money\Currency;
use Lens\Bundle\IdealBundle\Ideal\Util;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Provides details on the currency exchange rate and contract.
 */
class ExchangeRateInformationRequest implements SerializableRequestData
{
    /**
     * Currency in which the rate of exchange is expressed in a currency exchange. In the example 1GBP = xxxCUR, the
     * unit currency is GBP.
     */
    public ?Currency $unitCurrency = null;

    /**
     * The factor used for conversion of an amount from one currency to another. This reflects the price at which one
     * currency was bought with another currency. Rate expressed as a decimal, for example, 0.7 is 7/10 and 70%.
     */
    public ?BigDecimal $exchangeRate = null;

    /**
     * Specifies the type used to complete the currency exchange.
     */
    public ?string $rateType = null;

    /**
     * Unique and unambiguous reference to the foreign exchange contract agreed between the initiating party/creditor and the debtor agent.
     */
    #[Assert\Length(max: 256)]
    public ?string $contractIdentification = null;

    public function setUnitCurrency(Currency|string|null $currency): void
    {
        $this->unitCurrency = (null === $currency)
            ? null
            : Currency::of($currency);
    }

    public function setExchangeRate(BigDecimal|string|null $exchangeRate): void
    {
        $this->exchangeRate = (null === $exchangeRate)
            ? null
            : BigDecimal::of($exchangeRate);
    }

    public function jsonSerialize(): array
    {
        return array_filter([
            'UnitCurrency' => Util::currencyToString($this->unitCurrency),
            'ExchangeRate' => $this->exchangeRate?->toFloat(),
            'RateType' => $this->rateType,
            'ContractIdentification' => $this->contractIdentification,
        ], Util::isNotNull(...));
    }
}
