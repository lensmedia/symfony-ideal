<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

/**
 *
 * A list of hyperlinks to be recognized by the Initiating Party. The actual hyperlinks used in the response depend on
 * the dynamical decisions on authorization approach for example. Remark - All links are full links.
 */
class ConsentStatusLinks
{
    /**
     * In case of an Redirect approach, the Initiating Party has to use this link to redirect the PSU’s browser session.
     */
    public ?Link $redirectUrl = null;

    public ?Link $postAuthorisationForExplicit = null;

    /**
     * In case of a Decoupled approach, the Initiating Party has to use this link to post the PSU username.
     */
    public ?Link $postIdentificationForDecoupled = null;

    public ?Link $postAuthorisationForEmbedded = null;

    /**
     * In case of an embedded approach, the Initiating Party has to use this link to post the PSU credentials.
     */
    public ?Link $putAuthorisationForEmbedded = null;

    /**
     * In case of an embedded approach, the Initiating Party has to use this link to post the credentials.
     */
    public ?Link $selectAuthenticationMethod = null;

    /**
     * In case of an embedded approach, the Initiating Party has to authorize the transaction (consent) by providing
     * the SCA OneTimePassword.
     */
    public ?Link $authorizeTransaction = null;

    /**
     * Endpoint to be called for retrieving the consent status.
     */
    public ?Link $getConsentStatus = null;
}
