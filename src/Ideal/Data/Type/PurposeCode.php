<?php /** @noinspection SpellCheckingInspection */

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data\Type;

/**
 * ExternalPurpose1Code list published by ISO20022 or the values "Commerce", "Carpark", "Transport"
 *
 * @link https://www.iso20022.org/external_code_list.page
 */
enum PurposeCode: string
{
    case Commerce = 'Commerce';
    case Carpark = 'Carpark';
    case Transport = 'Transport';

    // Everything below is copied and pasted from https://www.iso20022.org/external_code_list.page
    // XSD its ExternalPurpose1Code part.

    /**
     * BankLoanDelayedDrawFunding
     * Delayed draw funding. Certain issuers may utilize delayed draw loans whereby the lender is committed to fund
     * cash within a specified period once a call is made by the issuer. The lender receives a fee for entering into
     * such a commitment
     */
    case Bkdf = 'BKDF';

    /**
     * BankLoanFees
     * Bank loan fees. Cash activity related to specific bank loan fees, including (a) agent / assignment fees; (b)
     * amendment fees; (c) commitment fees; (d) consent fees; (e) cost of carry fees; (f) delayed compensation fees;
     * (g) facility fees; (h) fronting fees; (i) funding fees; (j) letter of credit assignment fees
     */
    case Bkfe = 'BKFE';

    /**
     * BankLoanFundingMemo
     * Bank loan funding memo. Net cash movement for the loan contract final notification when sent separately from the
     * loan contract final notification instruction.
     */
    case Bkfm = 'BKFM';

    /**
     * BankLoanAccruedInterestPayment
     * Accrued interest payments. Specific to bank loans.
     */
    case Bkip = 'BKIP';

    /**
     * BankLoanPrincipalPaydown
     * Principal paydowns. Specific to bank loans
     */
    case Bkpp = 'BKPP';

    /**
     * CardBulkClearing
     * A Service that is settling money for a bulk of card transactions, while referring to a specific transaction file
     * or other information like terminal ID, card acceptor ID or other transaction details.
     */
    case Cblk = 'CBLK';

    /**
     * CardPaymentWithCashBack
     * Purchase of Goods and Services with additional Cash disbursement at the POI (Cashback)
     */
    case Cdcb = 'CDCB';

    /**
     * CashDisbursementCashSettlement
     * ATM Cash Withdrawal in an unattended or Cash Advance in an attended environment (POI or bank counter)
     */
    case Cdcd = 'CDCD';

    /**
     * CashDisbursementWithSurcharging
     * ATM Cash Withdrawal in an unattended or Cash Advance in an attended environment (POI or bank counter) with
     * surcharging.
     */
    case Cdcs = 'CDCS';

    /**
     * CardDeferredPayment
     * A combined service which enables the card acceptor to perform an authorisation for a temporary amount and a
     * completion for the final amount within a limited time frame. Deferred Payment is only available in the
     * unattended environment. Examples where this service is widely used are unattended petrol pumps and phone booths
     */
    case Cddp = 'CDDP';

    /**
     * OriginalCredit
     * A service which allows the card acceptor to effect a credit to a cardholder' account. Unlike a Merchant Refund,
     * an Original Credit is not preceded by a card payment. This service is used for example for crediting winnings
     * from gaming.
     */
    case Cdoc = 'CDOC';

    /**
     * QuasiCash
     * Purchase of Goods which are equivalent to cash like coupons in casinos.
     */
    case Cdqc = 'CDQC';

    /**
     * EPurseTopUp
     * Transaction is related to a Service that is first reserving money from a card account and then is loading an
     * e-purse application by this amount.
     */
    case Etup = 'ETUP';

    /**
     * FeeCollection
     * A Service that is settling card transaction related fees between two parties.
     */
    case Fcol = 'FCOL';

    /**
     * MobileTopUp
     * A Service that is first reserving money from a card account and then is loading a prepaid mobile phone amount by
     * this amount.
     */
    case Mtup = 'MTUP';

    /**
     * AccountManagement
     * Transaction moves funds between 2 accounts of same account holder at the same bank.
     */
    case Acct = 'ACCT';

    /**
     * CashManagementTransfer
     * Transaction is a general cash management instruction.
     */
    case Cash = 'CASH';

    /**
     * CollectionPayment
     * Transaction is a collection of funds initiated via a credit transfer or direct debit.
     */
    case Coll = 'COLL';

    /**
     * CashDisbursementCashManagement
     * Transaction is related to cash disbursement.
     */
    case Csdb = 'CSDB';

    /**
     * Deposit
     * Transaction is releted to a payment of deposit.
     */
    case Dept = 'DEPT';

    /**
     * IntraCompanyPayment
     * Transaction is an intra-company payment, ie, a payment between two companies belonging to the same group.
     */
    case Intc = 'INTC';

    /**
     * IntraPartyPayment
     * Transaction is a payment between two accounts belonging to the same party (intra-party payment), where party is
     * a natural person (identified by a private ID, not organisation ID).
     */
    case Intp = 'INTP';

    /**
     * LiquidityManagement
     * Bank initiated account transfer to support zero target balance management, pooling or sweeping.
     */
    case Lima = 'LIMA';

    /**
     * Netting
     * Transaction is related to a netting operation.
     */
    case Nett = 'NETT';

    /**
     * BondForward
     * Cash collateral related to any securities traded out beyond 3 days which include treasury notes, JGBs and Gilts.
     */
    case Bfwd = 'BFWD';

    /**
     * CrossCurrencyIRS
     * Cash Collateral related to a Cross Currency Interest Rate Swap, indicating the exchange of fixed interest
     * payments in one currency for those in another.
     */
    case Ccir = 'CCIR';

    /**
     * CCPClearedInitialMargin
     * Cash Collateral associated with an ISDA or Central Clearing Agreement that is covering the initial margin
     * requirements for OTC trades clearing through a CCP.
     */
    case Ccpc = 'CCPC';

    /**
     * CCPClearedVariationMargin
     * Cash Collateral associated with an ISDA or Central Clearing Agreement that is covering the variation margin
     * requirements for OTC trades clearing through a CCP.
     */
    case Ccpm = 'CCPM';

    /**
     * CCPClearedInitialMarginSegregatedCash
     * CCP Segregated initial margin: Initial margin on OTC Derivatives cleared through a CCP that requires segregation
     */
    case Ccsm = 'CCSM';

    /**
     * CreditDefaultSwap
     * Cash collateral related to trading of credit default swap.
     */
    case Crds = 'CRDS';

    /**
     * CrossProduct
     * Cash collateral related to a combination of various types of trades.
     */
    case Crpr = 'CRPR';

    /**
     * CreditSupport
     * Cash collateral related to cash lending/borrowing; letter of Credit; signing of master agreement.
     */
    case Crsp = 'CRSP';

    /**
     * CreditLine
     * Cash collateral related to opening of a credit line before trading.
     */
    case Crtl = 'CRTL';

    /**
     * EquityOption
     * Cash collateral related to trading of equity option (Also known as stock options).
     */
    case Eqpt = 'EQPT';

    /**
     * EquitySwap
     * Cash collateral related to equity swap trades where the return of an equity is exchanged for either a fixed or a
     * floating rate of interest.
     */
    case Equs = 'EQUS';

    /**
     * ExoticOption
     * Cash collateral related to trading of an exotic option for example a non-standard option.
     */
    case Expt = 'EXPT';

    /**
     * ExchangeTradedDerivatives
     * Cash collateral related to trading of exchanged traded derivatives in general (Opposite to Over the Counter
     * (OTC)).
     */
    case Extd = 'EXTD';

    /**
     * FixedIncome
     * Cash collateral related to a fixed income instrument
     */
    case Fixi = 'FIXI';

    /**
     * ForwardBrokerOwnedCashCollateral
     * Cash collateral payment against a Master Forward Agreement (MFA) where the cash is held in a segregated account
     * and is not available for use by the client. Includes any instruments with a forward settling date such TBAs,
     * repurchase agreements and bond forwards
     */
    case Fwbc = 'FWBC';

    /**
     * ForwardClientOwnedCashCollateral
     * Cash collateral payment against a Master Forward Agreement (MFA) where the cash is owned and may be used by the
     * client when returned. Includes any instruments with a forward settling date such TBAs, repurchase agreements and
     * bond forwards
     */
    case Fwcc = 'FWCC';

    /**
     * ForwardBrokerOwnedCashCollateralSegregated
     * Any cash payment related to the collateral for a Master Agreement forward, which is segregated, and not
     * available for use by the client. Example master agreement forwards include TBA, repo and Bond Forwards.
     */
    case Fwsb = 'FWSB';

    /**
     * ForwardClientOwnedSegregatedCashCollateral
     * Any cash payment related to the collateral for a Master agreement forward, which is owned by the client and is
     * available for use by the client when it is returned to them from the segregated account. Example master
     * agreement forwards include TBA, repo and Bond Forwards.
     */
    case Fwsc = 'FWSC';

    /**
     * DailyMarginOnListedDerivatives
     * Daily margin on listed derivatives – not segregated as collateral associated with an FCM agreement. Examples
     * include listed futures and options margin payments; premiums for listed options not covered in the MT54X message
     */
    case Marg = 'MARG';

    /**
     * MBSBrokerOwnedCashCollateral
     * MBS Broker Owned Segregated (40Act/Dodd Frank) Cash Collateral - Any cash payment related to the collateral for
     * a Mortgage Back Security, which is segregated, and not available for use by the client.
     */
    case Mbsb = 'MBSB';

    /**
     * MBSClientOwnedCashCollateral
     * MBS Client Owned Cash Segregated (40Act/Dodd Frank) Cash Collateral - Any cash payment related to the collateral
     * for a Mortgage Back Security, which is owned by the client and is available for use by the client when it is
     * returned to them from the segregated account
     */
    case Mbsc = 'MBSC';

    /**
     * FuturesInitialMargin
     * Initial futures margin. Where such payment is owned by the client and is available for use by them on return
     */
    case Mgcc = 'MGCC';

    /**
     * FuturesInitialMarginClientOwnedSegregatedCashCollateral
     * Margin Client Owned Segregated Cash Collateral - Any cash payment related to the collateral for initial futures
     * margin, which is owned by the client and is available for use by the client when it is returned to them from the
     * segregated account.
     */
    case Mgsc = 'MGSC';

    /**
     * ClientOwnedOCCPledgedCollateral
     * Client owned collateral identified as eligible for OCC pledging
     */
    case Occc = 'OCCC';

    /**
     * OTCOptionBrokerOwnedCashCollateral
     * Cash collateral payment for OTC options associated with an FCM agreement. Where such payment is segregated and
     * not available for use by the client
     */
    case Opbc = 'OPBC';

    /**
     * OTCOptionClientOwnedCashCollateral
     * Cash collateral payment for OTC options associated with an FCM agreement. Where such payment is not segregated
     * and is available for use by the client upon return
     */
    case Opcc = 'OPCC';

    /**
     * OTCOptionBrokerOwnedSegregatedCashCollateral
     * Option Broker Owned Segregated Cash Collateral - Any cash payment related to the collateral for an OTC option,
     * which is segregated, and not available for use by the client.
     */
    case Opsb = 'OPSB';

    /**
     * OTCOptionClientOwnedCashSegregatedCashCollateral
     * Option Client Owned Cash Segregated Cash Collateral - Any cash payment related to the collateral for an OTC
     * option, which is owned by the client and is available for use by the client when it is returned to them from the
     * segregated account
     */
    case Opsc = 'OPSC';

    /**
     * FXOption
     * Cash collateral related to trading of option on Foreign Exchange.
     */
    case Optn = 'OPTN';

    /**
     * OTCDerivatives
     * Cash collateral related to Over-the-counter (OTC) Derivatives in general for example contracts which are traded
     * and privately negotiated.
     */
    case Otcd = 'OTCD';

    /**
     * RepurchaseAgreement
     * Cash collateral related to a repurchase agreement transaction.
     */
    case Repo = 'REPO';

    /**
     * BilateralRepoBrokerOwnedCollateral
     * Bi-lateral repo broker owned collateral associated with a repo master agreement – GMRA or MRA Master Repo
     * Agreements
     */
    case Rpbc = 'RPBC';

    /**
     * RepoClientOwnedCollateral
     * Repo client owned collateral associated with a repo master agreement – GMRA or MRA Master Repo Agreements
     */
    case Rpcc = 'RPCC';

    /**
     * BilateralRepoBrokerOwnedSegregatedCashCollateral
     * Bi-lateral repo broker owned segregated cash collateral associated with a repo master agreement
     */
    case Rpsb = 'RPSB';

    /**
     * BilateralRepoClientOwnedSegregatedCashCollateral
     * Repo client owned segregated collateral associated with a repo master agreement
     */
    case Rpsc = 'RPSC';

    /**
     * ReverseRepurchaseAgreement
     * Cash collateral related to a reverse repurchase agreement transaction.
     */
    case Rvpo = 'RVPO';

    /**
     * SecuritiesBuySellSellBuyBack
     * Cash collateral related to a Securities Buy Sell Sell Buy Back
     */
    case Sbsc = 'SBSC';

    /**
     * SingleCurrencyIRSExotic
     * Cash collateral related to Exotic single currency interest rate swap.
     */
    case Scie = 'SCIE';

    /**
     * SingleCurrencyIRS
     * Cash collateral related to Single Currency Interest Rate Swap.
     */
    case Scir = 'SCIR';

    /**
     * SecuritiesCrossProducts
     * Cash collateral related to Combination of securities-related exposure types.
     */
    case Scrp = 'SCRP';

    /**
     * BrokerOwnedCollateralShortSale
     * Short Sale broker owned collateral associated with a prime broker agreement
     */
    case Shbc = 'SHBC';

    /**
     * ClientOwnedCollateralShortSale
     * Short Sale client owned collateral associated with a prime brokerage agreement
     */
    case Shcc = 'SHCC';

    /**
     * ShortSell
     * Cash Collateral related to a Short Sell
     */
    case Shsl = 'SHSL';

    /**
     * SecuritiesLendingAndBorrowing
     * Cash collateral related to Securities lending and borrowing.
     */
    case Sleb = 'SLEB';

    /**
     * SecuredLoan
     * Cash collateral related to a Secured loan.
     */
    case Sloa = 'SLOA';

    /**
     * SwapBrokerOwnedCashCollateral
     * Cash collateral payment for swaps associated with an ISDA agreement. . Where such payment is segregated and not
     * available for use by the client. Includes any cash collateral payments made under the terms of a CSA agreement
     * for instruments such as swaps and FX forwards.
     */
    case Swbc = 'SWBC';

    /**
     * SwapClientOwnedCashCollateral
     * Cash collateral payment for swaps associated with an ISDA agreement. Where such payment is not segregated and is
     * available for use by the client upon return. Includes any cash collateral payments made under the terms of a CSA
     * agreement for instruments such as swaps and FX forwards.
     */
    case Swcc = 'SWCC';

    /**
     * Swaption
     * Cash collateral related to an option on interest rate swap.
     */
    case Swpt = 'SWPT';

    /**
     * SwapsBrokerOwnedSegregatedCashCollateral
     * Swaps Broker Owned Segregated Cash Collateral - Any cash payment related to the collateral for Swap margin ,
     * which is segregated, and not available for use by the client. This includes any collateral identified in a CSA
     * agreement such as Swap or FX Forward collateral.
     */
    case Swsb = 'SWSB';

    /**
     * SwapsClientOwnedSegregatedCashCollateral
     * Swaps Client Owned Segregated Cash Collateral - Any cash payment related to the collateral for Swap margin,
     * which is owned by the client and is available for use by the client when returned from the segregated account.
     * This includes any collateral identified in a CSA agreement such as Swap or FX Forward collateral.
     */
    case Swsc = 'SWSC';

    /**
     * ToBeAnnounced
     * Cash collateral related to a To Be Announced (TBA)
     */
    case Tbas = 'TBAS';

    /**
     * TBABrokerOwnedCashCollateral
     * Cash collateral payment (segregated) for TBA securities associated with a TBA Master Agreement. Where such
     * payment is segregated and not available for use by the client.
     */
    case Tbbc = 'TBBC';

    /**
     * TBAClientOwnedCashCollateral
     * Cash collateral payment (for use by client)for TBA securities associated with a TBA Master Agreement. Where such
     * payment is not segregated and is available for use by the client upon return.
     */
    case Tbcc = 'TBCC';

    /**
     * TreasuryCrossProduct
     * Cash collateral related to a combination of treasury-related exposure types.
     */
    case Trcp = 'TRCP';

    /**
     * AgriculturalTransfer
     * Transaction is related to the agricultural domain.
     */
    case Agrt = 'AGRT';

    /**
     * AccountsReceivablesEntry
     * Transaction is related to a payment associated with an Account Receivable Entry
     */
    case Aren = 'AREN';

    /**
     * BusinessExpenses
     * Transaction is related to a payment of business expenses.
     */
    case Bexp = 'BEXP';

    /**
     * BackOfficeConversionEntry
     * Transaction is related to a payment associated with a Back Office Conversion Entry
     */
    case Boce = 'BOCE';

    /**
     * CommercialPayment
     * Transaction is related to a payment of commercial credit or debit. (formerly CommercialCredit)
     */
    case Comc = 'COMC';

    /**
     * Copyright
     * Transaction is payment of copyright.
     */
    case Cpyr = 'CPYR';

    /**
     * PurchaseSaleOfGoods
     * Transaction is related to purchase and sale of goods.
     */
    case Gdds = 'GDDS';

    /**
     * PurchaseSaleOfGoodsAndServices
     * Transaction is related to purchase and sale of goods and services.
     */
    case Gdsv = 'GDSV';

    /**
     * PurchaseSaleOfGoodsAndServicesWithCashBack
     * Transaction is related to purchase and sale of goods and services with cash back.
     */
    case Gscb = 'GSCB';

    /**
     * LicenseFee
     * Transaction is payment of a license fee.
     */
    case Licf = 'LICF';

    /**
     * MobileP2BPayment
     * A service which enables a user to use an app on its mobile to pay a merchant or other business payees by
     * initiating a payment message. Within this context, the account information or an alias of the payee might be
     * transported through different channels to the app, for example QR Code, NFC, Bluetooth, other Networks.
     */
    case Mp2b = 'MP2B';

    /**
     * PointOfPurchaseEntry
     * Transaction is related to a payment associated with a Point of Purchase Entry.
     */
    case Pope = 'POPE';

    /**
     * Royalties
     * Transaction is the payment of royalties.
     */
    case Roya = 'ROYA';

    /**
     * PurchaseSaleOfServices
     * Transaction is related to purchase and sale of services.
     */
    case Scve = 'SCVE';

    /**
     * ServiceCharges
     * Transaction is related to service charges charged by a service provider.
     */
    case Serv = 'SERV';

    /**
     * Subscription
     * Transaction is related to a payment of information or entertainment services either in printed or electronic
     * form.
     */
    case Subs = 'SUBS';

    /**
     * SupplierPayment
     * Transaction is related to a payment to a supplier.
     */
    case Supp = 'SUPP';

    /**
     * Commercial
     * Transaction is related to a trade services operation.
     */
    case Trad = 'TRAD';

    /**
     * CharityPayment
     * Transaction is a payment for charity reasons.
     */
    case Char = 'CHAR';

    /**
     * ConsumerThirdPartyConsolidatedPayment
     * Transaction is a payment used by a third party who can collect funds to pay on behalf of consumers, ie credit
     * counseling or bill payment companies.
     */
    case Comt = 'COMT';

    /**
     * MobileP2PPayment
     * A service which enables a user to use an app on its mobile to initiate moving funds from his/her bank account to
     * another person’s bank account while not using the account number  but an alias information like an MSISDN as
     * account addressing information in his/her app.
     */
    case Mp2p = 'MP2P';

    /**
     * GuaranteedEPayment
     * E-Commerce payment with payment guarantee of the issuing bank.
     */
    case Ecpg = 'ECPG';

    /**
     * EPaymentReturn
     * E-Commerce payment return.
     */
    case Ecpr = 'ECPR';

    /**
     * NonGuaranteedEPayment
     * E-Commerce payment without payment guarantee of the issuing bank.
     */
    case Ecpu = 'ECPU';

    /**
     * Epayment
     * Transaction is related to ePayment.
     */
    case Epay = 'EPAY';

    /**
     * CarLoanPrincipalRepayment
     * Transaction is a payment of car loan principal payment.
     */
    case Clpr = 'CLPR';

    /**
     * CompensationPayment
     * Transaction is related to the payment of a compensation relating to interest loss/value date adjustment and can
     * include fees.
     */
    case Comp = 'COMP';

    /**
     * DebitCollectionPayment
     * Collection of funds initiated via a debit transfer.
     */
    case Dbtc = 'DBTC';

    /**
     * GovernmentInsurance
     * Transaction is related to a payment of government insurance.
     */
    case Govi = 'GOVI';

    /**
     * PropertyLoanRepayment
     * Transaction is related to a payment of property loan.
     */
    case Hlrp = 'HLRP';

    /**
     * PropertyLoanSettlement
     * Transaction is related to the settlement of a property loan.
     */
    case Hlst = 'HLST';

    /**
     * InsurancePremiumCar
     * Transaction is a payment of car insurance premium.
     */
    case Inpc = 'INPC';

    /**
     * InsurancePremiumRefund
     * Transaction is related to an insurance premium refund.
     */
    case Inpr = 'INPR';

    /**
     * PaymentOfInsuranceClaim
     * Transaction is related to the payment of an insurance claim.
     */
    case Insc = 'INSC';

    /**
     * InsurancePremium
     * Transaction is payment of an insurance premium.
     */
    case Insu = 'INSU';

    /**
     * Interest
     * Transaction is payment of interest.
     */
    case Inte = 'INTE';

    /**
     * LaborInsurance
     * Transaction is a payment of labor insurance.
     */
    case Lbri = 'LBRI';

    /**
     * LifeInsurance
     * Transaction is a payment of life insurance.
     */
    case Lifi = 'LIFI';

    /**
     * Loan
     * Transaction is related to transfer of loan to borrower.
     */
    case Loan = 'LOAN';

    /**
     * LoanRepayment
     * Transaction is related to repayment of loan to lender.
     */
    case Loar = 'LOAR';

    /**
     * PaymentBasedOnEnforcementOrder
     * Payment based on enforcement orders except those arising from judicial alimony decrees.
     */
    case Peno = 'PENO';

    /**
     * PropertyInsurance
     * Transaction is a payment of property insurance.
     */
    case Ppti = 'PPTI';

    /**
     * RentalLeaseGeneral
     * Transaction is for general rental/lease.
     */
    case Relg = 'RELG';

    /**
     * RecurringInstallmentPayment
     * Transaction is related to a payment of a recurring installment made at regular intervals.
     */
    case Rinp = 'RINP';

    /**
     * TrustFund
     * Transaction is related to a payment of a trust fund.
     */
    case Trfd = 'TRFD';

    /**
     * ForwardForeignExchange
     * FX trades with a value date in the future.
     */
    case Forw = 'FORW';

    /**
     * ForeignExchangeRelatedNetting
     * FX netting if cash is moved by separate wire instead of within the closing FX instruction
     */
    case Fxnt = 'FXNT';

    /**
     * AdministrativeManagement
     * Transaction is related to a payment associated with administrative management.
     */
    case Admg = 'ADMG';

    /**
     * AdvancePayment
     * Transaction is an advance payment.
     */
    case Adva = 'ADVA';

    /**
     * BearerChequeDomestic
     * Transaction is the payment of a domestic bearer cheque.
     */
    case Bcdm = 'BCDM';

    /**
     * BearerChequeForeign
     * Transaction is the payment of a foreign bearer cheque.
     */
    case Bcfg = 'BCFG';

    /**
     * BuildingMaintenance
     * Transaction is related to a payment associated with building maintenance.
     */
    case Bldm = 'BLDM';

    /**
     * BondForwardNetting
     * Bond Forward pair-off cash net movement
     */
    case Bnet = 'BNET';

    /**
     * CapitalBuilding
     * Transaction is related to capital building fringe fortune, ie capital building in general
     */
    case Cbff = 'CBFF';

    /**
     * CapitalBuildingRetirement
     * Transaction is related to capital building fringe fortune for retirement
     */
    case Cbfr = 'CBFR';

    /**
     * CreditCardPayment
     * Transaction is related to a payment of credit card account.
     */
    case Ccrd = 'CCRD';

    /**
     * CreditCardBill
     * Transaction is related to a payment of credit card bill.
     */
    case Cdbl = 'CDBL';

    /**
     * CancellationFee
     * Transaction is related to a payment of cancellation fee.
     */
    case Cfee = 'CFEE';

    /**
     * CardGeneratedDirectDebit
     * Transaction is related to a direct debit where the mandate was generated by using data from a payment card at
     * the point of sale.
     */
    case Cgdd = 'CGDD';

    /**
     * TradeSettlementPayment
     * Transaction is related to settlement of a trade, e.g. a foreign exchange deal or a securities transaction.
     */
    case Cort = 'CORT';

    /**
     * Costs
     * Transaction is related to payment of costs.
     */
    case Cost = 'COST';

    /**
     * CarparkCharges
     * Transaction is related to carpark charges.
     */
    case Cpkc = 'CPKC';

    /**
     * DebitCardPayment
     * Transaction is related to a debit card payment.
     */
    case Dcrd = 'DCRD';

    /**
     * PrintedOrderDisbursement
     * Transaction is the payment of a disbursement due to a specific type of printed order for a payment of a
     * specified sum, issued by a bank or a post office (Zahlungsanweisung zur Verrechnung)
     */
    case Dsmt = 'DSMT';

    /**
     * DeliverAgainstPayment
     * Code used to pre-advise the account servicer of a forthcoming deliver against payment instruction.
     */
    case Dvpm = 'DVPM';

    /**
     * Education
     * Transaction is related to a payment of study/tuition fees.
     */
    case Educ = 'EDUC';

    /**
     * FactorUpdateRelatedPayment
     * Payment related to a factor update
     */
    case Fact = 'FACT';

    /**
     * FinancialAidInCaseOfNaturalDisaster
     * Financial aid by State authorities for abolition of consequences of natural disasters.
     */
    case Fand = 'FAND';

    /**
     * LatePaymentOfFeesAndCharges
     * Transaction is the payment for late fees &amp; charges. E.g Credit card charges
     */
    case Fcpm = 'FCPM';

    /**
     * PaymentOfFees
     * Payment of fees/charges.
     */
    case Fees = 'FEES';

    /**
     * Gift
     * Payment with no commercial or statutory purpose.
     */
    case Gift = 'GIFT';

    /**
     * GovernmentPayment
     * Transaction is a payment to or from a government department.
     */
    case Govt = 'GOVT';

    /**
     * IrrevocableCreditCardPayment
     * Transaction is reimbursement of credit card payment.
     */
    case Iccp = 'ICCP';

    /**
     * IrrevocableDebitCardPayment
     * Transaction is reimbursement of debit card payment.
     */
    case Idcp = 'IDCP';

    /**
     * InstalmentHirePurchaseAgreement
     * Transaction is payment for an installment/hire-purchase agreement.
     */
    case Ihrp = 'IHRP';

    /**
     * Installment
     * Transaction is related to a payment of an installment.
     */
    case Insm = 'INSM';

    /**
     * InvoicePayment
     * Transaction is the payment for invoices.
     */
    case Ivpt = 'IVPT';

    /**
     * MultiCurrenyChequeDomestic
     * Transaction is the payment of a domestic multi-currency cheque
     */
    case Mcdm = 'MCDM';

    /**
     * MultiCurrenyChequeForeign
     * Transaction is the payment of a foreign multi-currency cheque
     */
    case Mcfg = 'MCFG';

    /**
     * MultipleServiceTypes
     * Transaction is related to a payment for multiple service types.
     */
    case Msvc = 'MSVC';

    /**
     * NotOtherwiseSpecified
     * Transaction is related to a payment for type of services not specified elsewhere.
     */
    case Nows = 'NOWS';

    /**
     * OrderChequeDomestic
     * Transaction is the payment of a domestic order cheque
     */
    case Ocdm = 'OCDM';

    /**
     * OrderChequeForeign
     * Transaction is the payment of a foreign order cheque
     */
    case Ocfg = 'OCFG';

    /**
     * OpeningFee
     * Transaction is related to a payment of opening fee.
     */
    case Ofee = 'OFEE';

    /**
     * Other
     * Other payment purpose.
     */
    case Othr = 'OTHR';

    /**
     * PreauthorizedDebit
     * Transaction is related to a pre-authorized debit origination
     */
    case Padd = 'PADD';

    /**
     * PaymentTerms
     * Transaction is related to payment terms specifications
     */
    case Ptsp = 'PTSP';

    /**
     * RepresentedCheckEntry
     * Transaction is related to a payment associated with a re-presented check entry
     */
    case Rcke = 'RCKE';

    /**
     * ReceiptPayment
     * Transaction is related to a payment of receipt.
     */
    case Rcpt = 'RCPT';

    /**
     * Rebate
     * Transaction is the payment of a rebate.
     */
    case Rebt = 'REBT';

    /**
     * Refund
     * Transaction is the payment of a refund.
     */
    case Refu = 'REFU';

    /**
     * Rent
     * Transaction is the payment of rent.
     */
    case Rent = 'RENT';

    /**
     * AccountOverdraftRepayment
     * Transaction is for account overdraft repayment
     */
    case Reod = 'REOD';

    /**
     * ReimbursementOfAPreviousErroneousTransaction
     * Transaction is related to a reimbursement of a previous erroneous transaction.
     */
    case Rimb = 'RIMB';

    /**
     * BilateralRepoInternetNetting
     * Bi-lateral repo interest net/bulk payment at rollover/pair-off or other closing scenarios where applicable
     */
    case Rpnt = 'RPNT';

    /**
     * RoundRobin
     * Cash payment resulting from a Round Robin
     */
    case Rrbn = 'RRBN';

    /**
     * ReimbursementReceivedCreditTransfer
     * Transaction is related to a reimbursement for commercial reasons of a correctly received credit transfer.
     */
    case Rrct = 'RRCT';

    /**
     * RelatedRequestToPay
     * Transaction is related to a Request to Pay.
     */
    case Rrtp = 'RRTP';

    /**
     * ReceiveAgainstPayment
     * Code used to pre-advise the account servicer of a forthcoming receive against payment instruction.
     */
    case Rvpm = 'RVPM';

    /**
     * PaymentSlipInstruction
     * Transaction is payment of a well formatted payment slip.
     */
    case Slpi = 'SLPI';

    /**
     * SplitPayments
     * Split payments. To be used when cash and security movements for a security trade settlement are instructed
     * separately.
     */
    case Splt = 'SPLT';

    /**
     * Study
     * Transaction is related to a payment of study/tuition costs.
     */
    case Stdy = 'STDY';

    /**
     * TBAPairOffNetting
     * TBA pair-off cash wire net movement
     */
    case Tban = 'TBAN';

    /**
     * TelecommunicationsBill
     * Transaction is related to a payment of telecommunications related bill.
     */
    case Tbil = 'TBIL';

    /**
     * TownCouncilServiceCharges
     * Transaction is related to a payment associated with charges levied by a town council.
     */
    case Tcsc = 'TCSC';

    /**
     * TelephoneInitiatedTransaction
     * Transaction is related to a payment initiated via telephone.
     */
    case Teli = 'TELI';

    /**
     * TMPGClaimPayment
     * Cash payment resulting from a TMPG Claim
     */
    case Tmpg = 'TMPG';

    /**
     * TriPartyRepoInterest
     * Tri-Party Repo related interest
     */
    case Tpri = 'TPRI';

    /**
     * TriPartyRepoNetting
     * Tri-party Repo related net gain/loss cash movement
     */
    case Tprp = 'TPRP';

    /**
     * TruncatedPaymentSlip
     * Transaction is payment of a beneficiary prefilled payment slip where beneficiary to payer information is
     * truncated.
     */
    case Trnc = 'TRNC';

    /**
     * TravellerCheque
     * Transaction is the payment of a travellers cheque
     */
    case Trvc = 'TRVC';

    /**
     * InternetInitiatedTransaction
     * Transaction is related to a payment initiated via internet.
     */
    case Webi = 'WEBI';

    /**
     * InstantPayments
     * Transaction in which the amount is available to the payee immediately.
     */
    case Ipay = 'IPAY';

    /**
     * InstantPaymentsCancellation
     * Transaction in which the Return of the amount is fully returned.
     */
    case Ipca = 'IPCA';

    /**
     * InstantPaymentsForDonations
     * Transaction in which the amount is available to the payee immediately, done for donations, with sending the
     * address data of the payer.
     */
    case Ipdo = 'IPDO';

    /**
     * InstantPaymentsInECommerceWithoutAddressData
     * Transaction in which the amount is available to the payee immediately, done in E-commerce, without sending the
     * address data of the payer.
     */
    case Ipea = 'IPEA';

    /**
     * InstantPaymentsInECommerceWithAddressData
     * Transaction in which the amount is available to the payee immediately, done in E-commerce, with sending the
     * address data of the payer.
     */
    case Ipec = 'IPEC';

    /**
     * InstantPaymentsInECommerce
     * Transaction in which the amount is available to the payee immediately, done in E-commerce.
     */
    case Ipew = 'IPEW';

    /**
     * InstantPaymentsAtPOS
     * Transaction in which the amount is available to the payee immediately, done at POS.
     */
    case Ipps = 'IPPS';

    /**
     * InstantPaymentsReturn
     * Transaction in which the Return of the amount is fully or partial returned.
     */
    case Iprt = 'IPRT';

    /**
     * InstantPaymentsUnattendedVendingMachineWith2FA
     * Transaction is made via an unattending vending machine by using 2-factor-authentification.
     */
    case Ipu2 = 'IPU2';

    /**
     * InstantPaymentsUnattendedVendingMachineWithout2FA
     * Transaction is made via an unattending vending machine by without using 2-factor-authentification.
     */
    case Ipuw = 'IPUW';

    /**
     * Annuity
     * Transaction settles annuity related to credit, insurance, investments, other.n
     */
    case Anni = 'ANNI';

    /**
     * CustodianManagementFeeInhouse
     * Transaction is the payment of custodian account management fee where custodian bank and current account
     * servicing bank coincide
     */
    case Cafi = 'CAFI';

    /**
     * CapitalFallingDueInhouse
     * Transaction is the payment of capital falling due where custodian bank and current account servicing bank
     * coincide
     */
    case Cfdi = 'CFDI';

    /**
     * CommodityTransfer
     * Transaction is payment of commodities.
     */
    case Cmdt = 'CMDT';

    /**
     * Derivatives
     * Transaction is related to a derivatives transaction
     */
    case Deri = 'DERI';

    /**
     * Dividend
     * Transaction is payment of dividends.
     */
    case Divd = 'DIVD';

    /**
     * ForeignExchange
     * Transaction is related to a foreign exchange operation.
     */
    case Frex = 'FREX';

    /**
     * Hedging
     * Transaction is related to a hedging operation.
     */
    case Hedg = 'HEDG';

    /**
     * InvestmentAndSecurities
     * Transaction is for the payment of mutual funds, investment products and shares
     */
    case Invs = 'INVS';

    /**
     * PreciousMetal
     * Transaction is related to a precious metal operation.
     */
    case Prme = 'PRME';

    /**
     * Savings
     * Transfer to savings/retirement account.
     */
    case Savg = 'SAVG';

    /**
     * Securities
     * Transaction is the payment of securities.
     */
    case Secu = 'SECU';

    /**
     * SecuritiesPurchaseInhouse
     * Transaction is the payment of a purchase of securities where custodian bank and current account servicing bank
     * coincide
     */
    case Sepi = 'SEPI';

    /**
     * TreasuryPayment
     * Transaction is related to treasury operations.
     */
    case Trea = 'TREA';

    /**
     * UnitTrustPurchase
     * Transaction is purchase of Unit Trust
     */
    case Unit = 'UNIT';

    /**
     * FuturesNettingPayment
     * Cash associated with a netting of futures payments. Refer to CCPM codeword for netting of initial and variation
     * margin through a CCP
     */
    case Fnet = 'FNET';

    /**
     * Futures
     * Cash related to futures trading activity.
     */
    case Futr = 'FUTR';

    /**
     * AnesthesiaServices
     * Transaction is a payment for anesthesia services.
     */
    case Ants = 'ANTS';

    /**
     * ConvalescentCareFacility
     * Transaction is a payment for convalescence care facility services.
     */
    case Cvcf = 'CVCF';

    /**
     * DurableMedicaleEquipment
     * Transaction is a payment is for use of durable medical equipment.
     */
    case Dmeq = 'DMEQ';

    /**
     * DentalServices
     * Transaction is a payment for dental services.
     */
    case Dnts = 'DNTS';

    /**
     * HomeHealthCare
     * Transaction is a payment for home health care services.
     */
    case Hltc = 'HLTC';

    /**
     * HealthInsurance
     * Transaction is a payment of health insurance.
     */
    case Hlti = 'HLTI';

    /**
     * HospitalCare
     * Transaction is a payment for hospital care services.
     */
    case Hspc = 'HSPC';

    /**
     * IntermediateCareFacility
     * Transaction is a payment for intermediate care facility services.
     */
    case Icrf = 'ICRF';

    /**
     * LongTermCareFacility
     * Transaction is a payment for long-term care facility services.
     */
    case Ltcf = 'LTCF';

    /**
     * MedicalAidFundContribution
     * Transaction is contribution to medical aid fund.
     */
    case Mafc = 'MAFC';

    /**
     * MedicalAidRefund
     * Transaction is related to a medical aid refund.
     */
    case Marf = 'MARF';

    /**
     * MedicalServices
     * Transaction is a payment for medical care services.
     */
    case Mdcs = 'MDCS';

    /**
     * VisionCare
     * Transaction is a payment for vision care services.
     */
    case View = 'VIEW';

    /**
     * CreditDefaultEventPayment
     * Payment related to a credit default event
     */
    case Cdep = 'CDEP';

    /**
     * SwapContractFinalPayment
     * Final payments for a swap contract
     */
    case Swfp = 'SWFP';

    /**
     * SwapContractPartialPayment
     * Partial payment for a swap contract
     */
    case Swpp = 'SWPP';

    /**
     * SwapContractResetPayment
     * Reset payment for a swap contract
     */
    case Swrs = 'SWRS';

    /**
     * SwapContractUpfrontPayment
     * Upfront payment for a swap contract
     */
    case Swuf = 'SWUF';

    /**
     * AdvisoryDonationCopyrightServices
     * Payments for donation, sponsorship, advisory, intellectual and other copyright services.
     */
    case Adcs = 'ADCS';

    /**
     * ActiveEmploymentPolicy
     * Payment concerning active employment policy.
     */
    case Aemp = 'AEMP';

    /**
     * Allowance
     * Transaction is the payment of allowances.
     */
    case Allw = 'ALLW';

    /**
     * AlimonyPayment
     * Transaction is the payment of alimony.
     */
    case Almy = 'ALMY';

    /**
     * BabyBonusScheme
     * Transaction is related to a payment made as incentive to encourage parents to have more children
     */
    case Bbsc = 'BBSC';

    /**
     * ChildBenefit
     * Transaction is related to a payment made to assist parent/guardian to maintain child.
     */
    case Bech = 'BECH';

    /**
     * UnemploymentDisabilityBenefit
     * Transaction is related to a payment to a person who is unemployed/disabled.
     */
    case Bene = 'BENE';

    /**
     * BonusPayment
     * Transaction is related to payment of a bonus.
     */
    case Bonu = 'BONU';

    /**
     * CashCompensationHelplessnessDisability
     * Payments made by Government institute related to cash compensation, helplessness, disability. These payments are
     * made by the Government institution as a social benefit in addition to regularly paid salary or pension.
     */
    case Cchd = 'CCHD';

    /**
     * Commission
     * Transaction is payment of commission.
     */
    case Comm = 'COMM';

    /**
     * CompanySocialLoanPaymentToBank
     * Transaction is a payment by a company to a bank for financing social loans to employees.
     */
    case Cslp = 'CSLP';

    /**
     * GuaranteeFundRightsPayment
     * Compensation to unemployed persons during insolvency procedures.
     */
    case Gfrp = 'GFRP';

    /**
     * AustrianGovernmentEmployeesCategoryA
     * Transaction is payment to category A Austrian government employees.
     */
    case Gvea = 'GVEA';

    /**
     * AustrianGovernmentEmployeesCategoryB
     * Transaction is payment to category B Austrian government employees.
     */
    case Gveb = 'GVEB';

    /**
     * AustrianGovernmentEmployeesCategoryC
     * Transaction is payment to category C Austrian government employees.
     */
    case Gvec = 'GVEC';

    /**
     * AustrianGovernmentEmployeesCategoryD
     * Transaction is payment to category D Austrian government employees.
     */
    case Gved = 'GVED';

    /**
     * GovermentWarLegislationTransfer
     * Payment to victims of war violence and to disabled soldiers.
     */
    case Gwlt = 'GWLT';

    /**
     * HousingRelatedContribution
     * Transaction is a contribution by an employer to the housing expenditures (purchase, construction, renovation) of
     * the employees within a tax free fringe benefit system
     */
    case Hrec = 'HREC';

    /**
     * Payroll
     * Transaction is related to the payment of payroll.
     */
    case Payr = 'PAYR';

    /**
     * PensionFundContribution
     * Transaction is contribution to pension fund.
     */
    case Pefc = 'PEFC';

    /**
     * PensionPayment
     * Transaction is the payment of pension.
     */
    case Pens = 'PENS';

    /**
     * PricePayment
     * Transaction is related to a payment of a price.
     */
    case Prcp = 'PRCP';

    /**
     * RehabilitationSupport
     * Benefit for the duration of occupational rehabilitation.
     */
    case Rhbs = 'RHBS';

    /**
     * SalaryPayment
     * Transaction is the payment of salaries.
     */
    case Sala = 'SALA';

    /**
     * SalaryPensionSumPayment
     * Salary or pension payment for more months in one amount or a delayed payment of salaries or pensions.
     */
    case Spsp = 'SPSP';

    /**
     * SocialSecurityBenefit
     * Transaction is a social security benefit, ie payment made by a government to support individuals.
     */
    case Ssbe = 'SSBE';

    /**
     * LendingBuyInNetting
     * Net payment related to a buy-in. When an investment manager is bought in on a sell trade that fails due to a
     * failed securities lending recall, the IM may seize the underlying collateral to pay for the buy-in. Any
     * difference between the value of the collateral and the sell proceeds would be paid or received under this code
     */
    case Lbin = 'LBIN';

    /**
     * LendingCashCollateralFreeMovement
     * Free movement of cash collateral. Cash collateral paid by the borrower is done separately from the delivery of
     * the shares at loan opening or return of collateral done separately from return of the loaned security. Note:
     * common when the currency of the security is different the currency of the cash collateral.
     */
    case Lcol = 'LCOL';

    /**
     * LendingFees
     * Fee payments, other than rebates, for securities lending. Includes (a) exclusive fees; (b) transaction fees; (c)
     * custodian fees; (d) minimum balance fees
     */
    case Lfee = 'LFEE';

    /**
     * LendingEquityMarkedToMarketCashCollateral
     * Cash collateral payments resulting from the marked-to-market of a portfolio of loaned equity securities
     */
    case Lmeq = 'LMEQ';

    /**
     * LendingFixedIncomeMarkedToMarketCashCollateral
     * Cash collateral payments resulting from the marked-to-market of a portfolio of loaned fixed income securities
     */
    case Lmfi = 'LMFI';

    /**
     * LendingUnspecifiedTypeOfMarkedToMarketCashCollateral
     * Cash collateral payments resulting from the marked-to-market of a portfolio of loaned securities where the
     * instrument types are not specified
     */
    case Lmrk = 'LMRK';

    /**
     * LendingRebatePayments
     * Securities lending rebate payments
     */
    case Lreb = 'LREB';

    /**
     * LendingRevenuePayments
     * Revenue payments made by the lending agent to the client
     */
    case Lrev = 'LREV';

    /**
     * LendingClaimPayment
     * Payments made by a borrower to a lending agent to satisfy claims made by the investment manager related to sell
     * fails from late loan recall deliveries
     */
    case Lsfl = 'LSFL';

    /**
     * EstateTax
     * Transaction is related to a payment of estate tax.
     */
    case Estx = 'ESTX';

    /**
     * ForeignWorkerLevy
     * Transaction is related to a payment of Foreign Worker Levy
     */
    case Fwlv = 'FWLV';

    /**
     * GoodsServicesTax
     * Transaction is the payment of Goods &amp; Services Tax
     */
    case Gstx = 'GSTX';

    /**
     * HousingTax
     * Transaction is related to a payment of housing tax.
     */
    case Hstx = 'HSTX';

    /**
     * IncomeTax
     * Transaction is related to a payment of income tax.
     */
    case Intx = 'INTX';

    /**
     * NetIncomeTax
     * Transaction is related to a payment of net income tax.
     */
    case Nitx = 'NITX';

    /**
     * PropertyTax
     * Transaction is related to a payment of property tax.
     */
    case Ptxp = 'PTXP';

    /**
     * RoadTax
     * Transaction is related to a payment of road tax.
     */
    case Rdtx = 'RDTX';

    /**
     * TaxPayment
     * Transaction is the payment of taxes.
     */
    case Taxs = 'TAXS';

    /**
     * ValueAddedTaxPayment
     * Transaction is the payment of value added tax.
     */
    case Vatx = 'VATX';

    /**
     * WithHolding
     * Transaction is related to a payment of withholding tax.
     */
    case Whld = 'WHLD';

    /**
     * TaxRefund
     * Transaction is the refund of a tax payment or obligation.
     */
    case Taxr = 'TAXR';

    /**
     * TrailerFeePayment
     * US mutual fund trailer fee (12b-1) payment
     */
    case B112 = 'B112';

    /**
     * TrailerFeeRebate
     * US mutual fund trailer fee (12b-1) rebate payment
     */
    case Br12 = 'BR12';

    /**
     * NonUSMutualFundTrailerFeePayment
     * Any non-US mutual fund trailer fee (retrocession) payment (use ISIN to determine onshore versus offshore
     * designation)
     */
    case Tlrf = 'TLRF';

    /**
     * NonUSMutualFundTrailerFeeRebatePayment
     * Any non-US mutual fund trailer fee (retrocession) rebate payment (use ISIN to determine onshore versus offshore
     * designation)
     */
    case Tlrr = 'TLRR';

    /**
     * Air
     * Transaction is a payment for air transport related business.
     */
    case Airb = 'AIRB';

    /**
     * Bus
     * Transaction is a payment for bus transport related business.
     */
    case Busb = 'BUSB';

    /**
     * Ferry
     * Transaction is a payment for ferry related business.
     */
    case Ferb = 'FERB';

    /**
     * Railway
     * Transaction is a payment for railway transport related business.
     */
    case Rlwy = 'RLWY';

    /**
     * RoadPricing
     * Transaction is for the payment to top-up pre-paid card and electronic road pricing for the purpose of
     * transportation
     */
    case Trpt = 'TRPT';

    /**
     * CableTVBill
     * Transaction is related to a payment of cable TV bill.
     */
    case Cbtv = 'CBTV';

    /**
     * ElectricityBill
     * Transaction is related to a payment of electricity bill.
     */
    case Elec = 'ELEC';

    /**
     * Energies
     * Transaction is related to a utility operation.
     */
    case Enrg = 'ENRG';

    /**
     * GasBill
     * Transaction is related to a payment of gas bill.
     */
    case Gasb = 'GASB';

    /**
     * NetworkCharge
     * Transaction is related to a payment of network charges.
     */
    case Nwch = 'NWCH';

    /**
     * NetworkCommunication
     * Transaction is related to a payment of network communication.
     */
    case Nwcm = 'NWCM';

    /**
     * OtherTelecomRelatedBill
     * Transaction is related to a payment of other telecom related bill.
     */
    case Otlc = 'OTLC';

    /**
     * TelephoneBill
     * Transaction is related to a payment of telephone bill.
     */
    case Phon = 'PHON';

    /**
     * Utilities
     * Transaction is for the payment to common utility provider that provide gas, water and/or electricity.
     */
    case Ubil = 'UBIL';

    /**
     * WaterBill
     * Transaction is related to a payment of water bill.
     */
    case Wter = 'WTER';

    /**
     * Bonds
     * Securities Lending-Settlement of Bond transaction.
     */
    case Bond = 'BOND';

    /**
     * CorporateActions
     * Securities Lending-Settlement of Corporate Actions: Bonds transactions.
     */
    case Cabd = 'CABD';

    /**
     * CorporateActions
     * Securities Lending-Settlement of Corporate Actions: Equities transactions.
     */
    case Caeq = 'CAEQ';

    /**
     * CreditCard
     * Card Settlement-Settlement of Credit Card transactions.
     */
    case Cbcr = 'CBCR';

    /**
     * DebitCard
     * Card Settlement-Settlement of Debit Card transactions.
     */
    case Dbcr = 'DBCR';

    /**
     * Diners
     * Card Settlement-Settlement of Diners transactions.
     */
    case Dicl = 'DICL';

    /**
     * Equities
     * Securities Lending-Settlement of Equities transactions.
     */
    case Eqts = 'EQTS';

    /**
     * FleetCard
     * Card Settlement-Settlement of Fleet transactions.
     */
    case Flcr = 'FLCR';

    /**
     * LowValueCredit
     * Utilities-Settlement of Low value Credit transactions.
     */
    case Eftc = 'EFTC';

    /**
     * LowValueDebit
     * Utilities-Settlement of Low value Debit transactions.
     */
    case Eftd = 'EFTD';

    /**
     * MoneyMarket
     * Securities Lending-ettlement of Money Market PCH.
     */
    case Moma = 'MOMA';

    /**
     * RapidPaymentInstruction
     * Instant Payments-Settlement of Rapid Payment Instruction (RPI) transactions.
     */
    case Rapi = 'RAPI';

    /**
     * GamblingOrWageringPayment
     * General-Payments towards a purchase or winnings received from gambling, betting or other wagering activities.
     */
    case Gamb = 'GAMB';

    /**
     * LotteryPayment
     * General-Payment towards a purchase or winnings received from lottery activities.
     */
    case Lott = 'LOTT';

    /**
     * Amex
     * Card Settlement-Settlement of AMEX transactions.
     */
    case Amex = 'AMEX';

    /**
     * ATM
     * Card Settlement-Settlement of ATM transactions.
     */
    case Sasw = 'SASW';

    /**
     * AuthenticatedCollections
     * Utilities-Settlement of Authenticated Collections transactions.
     */
    case Auco = 'AUCO';

    /**
     * PropertyCompletionPayment
     * Final payment to complete the purchase of a property.
     */
    case Pcom = 'PCOM';

    /**
     * PropertyDeposit
     * Payment of the deposit required towards purchase of a property.
     */
    case Pdep = 'PDEP';

    /**
     * PropertyLoanDisbursement
     * Payment of funds from a lender as part of the issuance of a property loan.
     */
    case Plds = 'PLDS';

    /**
     * PropertyLoanRefinancing
     * Transfer or extension of a property financing arrangement to a new deal or loan provider, without change of
     * ownership of property.
     */
    case Plrf = 'PLRF';

    /**
     * GovernmentFamilyAllowance
     * Salary and Benefits-Allowance from government to support family.
     */
    case Gafa = 'GAFA';

    /**
     * GovernmentHousingAllowance
     * Salary and Benefits-Allowance from government to individuals to support payments of housing.
     */
    case Gaho = 'GAHO';

    /**
     * CashPenalties
     * Cash penalties related to securities transaction, including CSDR Settlement Discipline Regime.
     */
    case Cpen = 'CPEN';

    /**
     * DependentSupportPayment
     * Transaction is related to a payment concerning dependent support, for example child support or support for a
     * person substantially financially dependent on the support provider.
     */
    case Depd = 'DEPD';

    /**
     * RetailPayment
     * Retail payment including e-commerce and online shopping.
     */
    case Retl = 'RETL';

    /**
     * ChargesBorneByDebtor
     * Purpose of payment is the settlement of charges payable by the debtor in relation to an underlying customer
     * credit transfer.
     */
    case Debt = 'DEBT';
}
