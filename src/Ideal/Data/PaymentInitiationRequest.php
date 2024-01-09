<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

use Lens\Bundle\IdealBundle\Ideal\Data\Type\PaymentProduct;
use Lens\Bundle\IdealBundle\Ideal\Util;

/**
 * Payment Initiation Request
 */
class PaymentInitiationRequest implements SerializableRequestData
{
    /**
     * Indicates the requested payment method.
     *
     * Multiple PaymentProducts can only be supplied if UseAuthorisationLandingPages equals TRUE. These will then
     * influence ASPSPs visible to the PSU on the Bank Selection Interface. The IDEAL payment product cannot be mixed
     * with the other PSD2-xxxx payment products, because it requires a separate subscription and therefore uses a
     * different authorization token.
     *
     * Default: PSD2-SCT
     *
     * @var PaymentProduct[]
     */
    public ?array $paymentProduct = null;

    /**
     * Allowing PSU to change pre-selected payment product if the ASPSP supports more than one from the list provided
     * by the Initiating Party. Usable only if UseAuthorisationLandingPages equals TRUE. Otherwise, will be ignored.
     *
     * Default: false
     */
    public ?bool $paymentProductChangeable = null;

    /**
     * The array is defined to mention the master data specific to selected payment product.
     *
     * @var ProductSpecificMasterData[]
     */
    public ?array $productSpecificMasterData = null;

    public ?PsuData $psuData = null;

    public PaymentInitiationRequestBasic $commonPaymentData;

    public ?IdealPayments $idealPayments = null;

    public function jsonSerialize(): array
    {
        return array_filter([
            'PaymentProduct' => Util::enumToString($this->paymentProduct),
            'PaymentProductChangeable' => $this->paymentProductChangeable,
            'ProductSpecificMasterData' => $this->productSpecificMasterData,
            'PsuData' => $this->psuData,
            'CommonPaymentData' => $this->commonPaymentData,
            'IDEALPayments' => $this->idealPayments,
        ], Util::isNotNull(...));
    }
}
