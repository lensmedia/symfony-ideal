<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

use Lens\Bundle\IdealBundle\Ideal\Data\Type\PaymentProduct;
use Lens\Bundle\IdealBundle\Ideal\IdealResponse;

/**
 * Payment Status
 */
class PaymentDetailedInformation extends IdealResponse
{
    /**
     * Indicates the requested payment method.
     *
     * Default: PSD2-SCT
     */
    public ?PaymentProduct $paymentProductUsed = null;

    public ?CommonPaymentDataResponse $commonPaymentData = null;

    /**
     * A list of hyperlinks to be recognized by the Initiating Party. The actual hyperlinks used in the response depend
     * on the dynamical decisions on authorization approach for example. Remark - All links are full links.
     */
    public ?StatusResponseLinks $links = null;

    /**
     * If true the Initiating Party should show a waiting screen even if the RedirectUrl is provided. On the
     * waiting screen a redirection button should be placed. Click on the button should redirect the PSU to the link
     * provided in the RedirectUrl field.
     */
    public ?bool $useWaitingScreen = null;
}
