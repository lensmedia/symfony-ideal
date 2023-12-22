<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

/**
 * A list of hyperlinks to be recognized by the Initiating Party. The actual hyperlinks used in the response depend on
 * the dynamical decisions on authorization approach for example. Remark - All links are full links.
 */
class StatusResponseLinks
{
    /**
     * In case of a Redirect approach, the Initiating Party has to use this link to redirect the PSUs
     * browser session.
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
     * Missing from swagger api specs.
     */
    public ?Link $postAuthorisationForEmbedded = null;

    /**
     * In case of an embedded approach, endpoint to be called to add information to the Authorization.
     */
    public ?Link $putAuthorisationForEmbedded = null;

    /**
     * In case of an embedded approach, the Initiating Party has to use this link to pass the SCA method.
     */
    public ?Link $selectAuthenticationMethod = null;

    /**
     * In case of an embedded approach, the Initiating Party has to authorize the payment by providing the SCA OneTimePassword.
     */
    public ?Link $authorizeTransaction = null;

    /**
     * Endpoint to be called for payment confirmation for ASPSPs that require explicit confirmation of payments.
     */
    public ?Link $confirmationRequired = null;
}
