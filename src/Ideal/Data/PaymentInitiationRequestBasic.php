<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

use Lens\Bundle\IdealBundle\Ideal\Data\Type\CategoryPurpose;
use Lens\Bundle\IdealBundle\Ideal\Data\Type\ChargeBearer;
use Lens\Bundle\IdealBundle\Ideal\Data\Type\PreferredScaMethod;
use Lens\Bundle\IdealBundle\Ideal\Data\Type\PurposeCode;
use Lens\Bundle\IdealBundle\Ideal\Data\Type\TransactionType;
use Lens\Bundle\IdealBundle\Ideal\Util;
use Symfony\Component\Validator\Constraints as Assert;

class PaymentInitiationRequestBasic implements SerializableRequestData
{
    /**
     * This field is only applicable for Aspsp which support pre-authentication. It can also be filled in payments
     * toward other ASPSP's, but the value will then be ignored.
     *
     * * If set to true the Open Banking Service will store the pre-authentication token for use with future payments.
     * This will only work if also a PsuId is provided which is stored in the Open Banking Service.
     * * If set to false the pre-authentication token will only be used to finish one payment. After which it will be
     * discarded.
     *
     * Defaults to false
     */
    #[Assert\Type('bool')]
    public ?bool $usePreAuthentication = null;

    /**
     * Unique identification, as assigned by the initiating party, to unambiguously identify the transaction. This
     * identification is passed on, unchanged, throughout the entire end-to-end chain. Usage: The end-to-end
     * identification can be used for reconciliation or to link tasks relating to the transaction. It can be included
     * in several messages related to the transaction. Required for PSD2 payments
     *
     * @example ID-0123456789
     */
    #[Assert\Length(min: 1, max: 35)]
    public ?string $endToEndId = null;

    /**
     * Reference to the payment created by the Initiating Party. This Id will not be visible to the Payment Service
     * User. Required for PSD2 payments
     *
     * @example InitParty ref-id-23457890
     */
    #[Assert\Length(min: 1, max: 36)]
    public ?string $initiatingPartyReferenceId = null;

    /**
     * Multiple preferred methods can be chosen. It is not guaranteed that the ASPSP will use the preferred method.
     */
    public ?PreferredScaMethod $preferredScaMethod = null;

    /**
     * Transaction type used in this transaction.
     *
     * ONLINE - Used particularly for Online transactions, e.g. a webshop
     * QR - Used for transactions from a QR. eg. Invoice
     * INSTORE - Used for instore transactions for e.g. a POS device
     * P2P - Used for peer-to-peer (customer-to-customer) transactions, e.g. a Transaction Request
     */
    public ?TransactionType $transactionType = null;

    /**
     * Time in seconds after which the transaction will expire. If not provided a default value will be used if the
     * PaymentProduct equals IDEAL. For ONLINE - 1200 and for INSTORE - 120. Required for QR type transactions
     */
    #[Assert\Range(min: 60, max: 3600)]
    public ?int $expirationPeriod = null;

    public Amount $amount;

    /**
     * All debtor relevant data.
     */
    public ?DebtorInformation $debtorInformation = null;

    /**
     * All creditor relevant data
     */
    public ?CreditorInformation $creditorInformation = null;

    /**
     * Charge bearer.
     *
     * ISO20022 ChargeBearerType1Code.
     */
    public ?ChargeBearer $chargeBearer = null;

    /**
     * Specifies the purpose code that resulted in a payment initiation.
     */
    public ?PurposeCode $purposeCode = null;

    /**
     * Specifies the high level purpose of the instruction based on a set of pre-defined categories. This is used by
     * the initiating party to provide information concerning the processing of the payment. It is likely to trigger
     * special processing by any of the agents involved in the payment chain. Not all the given codes might be
     * accepted by all banks. The standard for STET for example is limited to CASH, CORT, DVPM, INTC and TREA.
     */
    public ?CategoryPurpose $categoryPurpose = null;

    /**
     * Information used for risk scoring by the ASPSP.
     */
    public ?RiskInformation $paymentContext = null;

    public ?CrossCurrencyPayment $crossCurrencyPayments = null;

    /**
     * List of needed regulatory reporting codes for international payments.
     *
     * @var RegulatoryReportingCode[]
     */
    #[Assert\Count(min: 1, max: 10)]
    public ?array $regulatoryReportingCodes = null;

    /**
     * Information supplied to enable the matching of an entry with the items that the transfer is intended to settle.
     * This information will be visible to the Payment Service User.
     *
     * Conditional validation: In case the PaymentProduct is set to IDEAL the maxLength is limited to 35.
     */
    #[Assert\Length(max: 140)]
    public ?string $remittanceInformation = null;

    public ?RemittanceInformationStructured $remittanceInformationStructured = null;

    public function jsonSerialize(): array
    {
        return array_filter([
            'UsePreAuthentication' => $this->usePreAuthentication,
            'EndToEndId' => $this->endToEndId,
            'InitiatingPartyReferenceId' => $this->initiatingPartyReferenceId,
            'PreferredScaMethod' => Util::enumToString($this->preferredScaMethod),
            'TransactionType' => Util::enumToString($this->transactionType),
            'ExpirationPeriod' => $this->expirationPeriod,
            'Amount' => $this->amount,
            'DebtorInformation' => $this->debtorInformation,
            'CreditorInformation' => $this->creditorInformation,
            'ChargeBearer' => $this->chargeBearer,
            'PurposeCode' => Util::enumToString($this->purposeCode),
            'CategoryPurpose' => Util::enumToString($this->categoryPurpose),
            'PaymentContext' => $this->paymentContext,
            'CrossCurrencyPayments' => $this->crossCurrencyPayments,
            'RegulatoryReportingCodes' => $this->regulatoryReportingCodes,
            'RemittanceInformation' => $this->remittanceInformation,
            'RemittanceInformationStructured' => $this->remittanceInformationStructured,
        ], Util::isNotNull(...));
    }
}
