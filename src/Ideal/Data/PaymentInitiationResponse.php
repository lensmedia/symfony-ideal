<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

/**
 * Payment Initiation Response
 */
class PaymentInitiationResponse
{
    public CommonPaymentDataResponse $commonPaymentData;

    /**
     * A list of hyperlinks to be recognized by the Initiating Party. The actual hyperlinks used in the response depend
     * on the dynamical decisions on authorization approach for example. Remark - All links are full links.
     */
    public InitiationResponseLinks $links;

    /**
     * If true the IP should show a waiting screen even if the RedirectUrl is provided. On the waiting screen a
     * redirection button should be placed. Click on the button should redirect the PSU by the link from RedirectUrl
     */
    public bool $useWaitingScreen = false;
}
