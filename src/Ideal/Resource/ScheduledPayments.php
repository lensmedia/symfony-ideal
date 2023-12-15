<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Resource;

use Lens\Bundle\IdealBundle\Ideal\Exception\NotImplemented;

readonly class ScheduledPayments extends Resource
{
    use PaymentTrait;

    private const BASE_URL = '/xs2a/routingservice/services/ob/pis/v3';

    /**
     * Use this operation to initiate a payment on behalf of the Payment Service User. Strong customer authentication
     * might be required by the ASPSP, the response will indicate which step is required to complete the payment.
     */
    public function create(): void
    {
        // POST /payments

        throw new NotImplemented(__METHOD__);
    }

    /**
     * Use this operation to retrieve the status of a payment.
     */
    public function status(string $paymentId): void
    {
        // GET /payments/{paymentId}/status

        throw new NotImplemented(__METHOD__);
    }

    /**
     * This API is used to confirm a payment. Confirmation is required when the link 'ConfirmationRequired' is
     * returned. Confirmation of a payment can be required in two cases 1) When it's required by the ASPSP standard 2)
     * when a payment fee is involved.
     */
    public function confirmation(string $paymentId): void
    {
        // POST /payments/{paymentId}/confirmation

        throw new NotImplemented(__METHOD__);
    }

    /**
     * Use this operation to identify a PSU in decoupled approach. The response of the post payments api will provide a
     * link to this api in the 'PostIdentificationForDecoupled' field if this step is required.
     */
    public function identification(string $paymentId): void
    {
        // POST /payments/{paymentId}/identification

        throw new NotImplemented(__METHOD__);
    }

    /**
     * Use this operation to authorise a PSU explicitly. This has to be used if multiple PSU's have to authorise the
     * payment. Background information: If only one PSU has to authorise, this step is started implicitly by the post
     * payments api.
     */
    public function authorize(string $paymentId): void
    {
        // POST /payments/{paymentId}/authorizations

        throw new NotImplemented(__METHOD__);
    }

    /**
     * Use this operation to change the authorisation resource.
     */
    public function changeAuthorization(string $paymentId, string $authorisationId): void
    {
        // POST /payments/{paymentId}/authorizations/{authorisationId}

        throw new NotImplemented(__METHOD__);
    }

    /**
     * Use this operation to cancel a payment on behalf of the Payment Service User. Strong Customer Authentication
     * might be required by the ASPSP, the response will indicate which step is required to complete the cancellation.
     */
    public function delete(string $paymentId): void
    {
        // DELETE /payments/{paymentId}

        throw new NotImplemented(__METHOD__);
    }

    /**
     * Use this operation to identify a Payment Service User in a decoupled approach.
     */
    public function cancellationIdentification(string $paymentId): void
    {
        // POST /payments/{paymentId}/cancellation-identification

        throw new NotImplemented(__METHOD__);
    }

    /**
     * Use this operation to authorise a Payment Service User (PSU) explicitly.
     */
    public function cancellationAuthorizations(string $paymentId): void
    {
        // POST /payments/{paymentId}/cancellation-authorizations

        throw new NotImplemented(__METHOD__);
    }

    /**
     * Use this operation to update the authorisation resource.
     */
    public function cancellationAuthorization(string $paymentId, string $authorisationId): void
    {
        // PUT /payments/{paymentId}/cancellation-authorizations/{authorisationId}

        throw new NotImplemented(__METHOD__);
    }
}
