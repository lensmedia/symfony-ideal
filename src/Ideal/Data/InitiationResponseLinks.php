<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

class InitiationResponseLinks
{
    /**
     * In case of an embedded pre-authentication required by the ASPSP, the Initiating Party has to use this link.
     */
    public ?Link $preAuthenticationForEmbedded = null;

    /**
     * In case of a Redirect approach, the Initiating Party has to use this link to redirect the PSU’s browser session.
     */
    public ?Link $redirectUrl = null;

    /**
     * In case the ASPSP requires explicit start of authorization.
     */
    public ?Link $postAuthorisationForExplicit = null;

    /**
     * In case of a Decoupled approach, identification of the PSU required to start the decoupled authorization.
     */
    public ?Link $postIdentificationForDecoupled = null;

    /**
     * In case of an embedded approach, endpoint to be called to start the embedded authorization.
     */
    public ?Link $postAuthorisationForEmbedded = null;

    /**
     * In case of an embedded approach, the Initiating Party has to use this link to pass the SCA method.
     */
    public ?Link $selectAuthenticationMethod = null;

    /**
     * In case of an embedded approach, the Initiating Party has to authorize the payment by providing the SCA
     * OneTimePassword.
     */
    public ?Link $authorizeTransaction = null;

    /**
     * Endpoint to be called for payment confirmation for ASPSPs that require explicit confirmation of payments.
     */
    public ?Link $confirmationRequired = null;

    /**
     * Endpoint to be called for retrieving the payment status.
     */
    public ?Link $getPaymentStatus = null;
}
