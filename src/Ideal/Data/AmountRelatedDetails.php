<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

class AmountRelatedDetails
{
    public ?TransactionFees $transactionFees = null;

    public ?ExchangeRateInformationResponse $exchangeRateInformation = null;

    public ?CurrencyConversionFee $currencyConversionFee = null;

    public ?EstimatedTotalAmount $estimatedTotalAmount = null;

    public ?EstimatedInterbankSettlementAmount $estimatedInterbankSettlementAmount = null;
}
