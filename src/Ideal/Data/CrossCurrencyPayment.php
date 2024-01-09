<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

use Lens\Bundle\IdealBundle\Ideal\Util;

class CrossCurrencyPayment implements SerializableRequestData
{
    /**
     * Set to true if a currency exchange is required. If set to true the ExchangeRateInformation section can be used.
     *
     * Defaults to false
     */
    public bool $crossCurrencyTransaction = false;

    /**
     * Provides details on the currency exchange rate and contract.
     */
    public ?ExchangeRateInformationRequest $exchangeRateInformation = null;

    public function jsonSerialize(): array
    {
        return array_filter([
            'CrossCurrencyTransaction' => $this->crossCurrencyTransaction,
            'ExchangeRateInformation' => $this->exchangeRateInformation,
        ], Util::isNotNull(...));
    }
}
