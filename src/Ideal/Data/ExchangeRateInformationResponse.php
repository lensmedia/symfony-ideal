<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

use Brick\Math\BigDecimal;
use Brick\Money\Currency;
use DateTimeImmutable;
use Lens\Bundle\IdealBundle\Ideal\Data\Type\RateType;

/**
 * Provides details on the currency exchange rate and contract.
 */
class ExchangeRateInformationResponse
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
    public ?RateType $rateType = null;

    /**
     * Unique and unambiguous reference to the foreign exchange contract agreed between the initiating party/creditor
     * and the debtor agent.
     */
    public ?string $contractIdentification = null;

    /**
     * Expiration date time. ISO 8601 DateTime.
     */
    public ?DateTimeImmutable $expirationDateTime = null;

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
}
