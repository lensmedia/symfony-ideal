<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Resource;

use Lens\Bundle\IdealBundle\Ideal\Exception\NotImplemented;
use Lens\Bundle\IdealBundle\Ideal\IdealInterface;

readonly class Refunds extends Resource
{
    private const BASE_URL = '/xs2a/routingservice/services/ob/pis/'.IdealInterface::VERSION.'/refunds';

    /**
     * Use this operation to initiate an order for refunds containing more than 1 refund instruction.
     */
    public function create(): void
    {
        // POST

        throw new NotImplemented(__METHOD__);
    }

    /**
     * Use this operation to retrieve the status of a refund.
     */
    public function status(string $refundId): void
    {
        // GET /{refundId}/status

        throw new NotImplemented(__METHOD__);
    }

    /**
     * This API is used to confirm a refund, confirmation is required when the link 'ConfirmationRequired' is returned.
     */
    public function confirmation(string $refundId): void
    {
        // POST /{refundId}/confirmation

        throw new NotImplemented(__METHOD__);
    }

    /**
     * Use this operation to identify a PSU in decoupled approach. The response of the post refunds API will provide a
     * link to this api in the 'PostIdentificationForDecoupled' field if this step is required.
     */
    public function identification(string $refundId): void
    {
        // POST /{refundId}/identification

        throw new NotImplemented(__METHOD__);
    }

    /**
     * Use this operation to authorise a refund explicitly.
     */
    public function authorise(string $refundId): void
    {
        // POST /{refundId}/authorisations

        throw new NotImplemented(__METHOD__);
    }

    /**
     * Use this operation to change the authorisation resource.
     */
    public function changeAuthorisation(string $refundId): void
    {
        // PUT /{refundId}/authorisations/{authorisationId}
        throw new NotImplemented(__METHOD__);
    }
}
