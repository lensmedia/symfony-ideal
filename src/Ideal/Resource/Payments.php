<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Resource;

use DateTimeImmutable;
use DateTimeInterface;
use JetBrains\PhpStorm\ArrayShape;
use JsonException;
use Lens\Bundle\IdealBundle\Ideal\Data\PaymentDetailedInformation;
use Lens\Bundle\IdealBundle\Ideal\Data\PaymentInitiationRequest;
use Lens\Bundle\IdealBundle\Ideal\Data\PaymentInitiationResponse;
use Lens\Bundle\IdealBundle\Ideal\Exception\NotImplemented;
use Lens\Bundle\IdealBundle\Ideal\Exception\UnableToEncodeData;
use Lens\Bundle\IdealBundle\Ideal\IdealInterface;
use Symfony\Component\Uid\Uuid;

readonly class Payments extends Resource
{
    use PaymentTrait;
    use PaymentArrayShapeTrait;

    private const BASE_URL = '/xs2a/routingservice/services/ob/pis/'.IdealInterface::VERSION.'/payments';

    /**
     * Use this operation to initiate a payment on behalf of the Payment Service User. Strong customer authentication
     * might be required by the ASPSP, the response will indicate which step is required to complete the payment.
     */
    public function create(
        PaymentInitiationRequest $payment,

        #[ArrayShape(self::PAYMENT_QUERY_PARAMS)]
        array $query = [],

        #[ArrayShape(self::PAYMENT_HEADERS)]
        array $headers = [],
    ): PaymentInitiationResponse {
        try {
            $payload = json_encode($payment, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT);
        } catch (JsonException $e) {
            throw new UnableToEncodeData($e->getMessage(), $e->getCode(), $e);
        }

        $headers += $this->sign([
            'Digest' => $this->digest($payload),
            'X-Request-ID' => (string)Uuid::v4(),
            'MessageCreateDateTime' => (new DateTimeImmutable())->format(DateTimeInterface::ATOM),
            '(Request-Target)' => 'post '.self::BASE_URL,
        ]);

        $response = $this->ideal->post(self::BASE_URL, [
            'headers' => $headers + [
                'Authorization' => $this->authorizationHeader(),
                'Content-Type' => 'application/json',
            ],
            'body' => $payload,
            'query' => $query,
        ], PaymentInitiationResponse::class);

        // Add some context to the return url.
        $href = &$response->links->redirectUrl->href;

        // This happens on the test site, in production it is a link to the bank.
        // For the test case, the link is returned to be the return url provided in
        // the header bypassing the bank entirely.
        if ('https://worldline.com' === $href) {
            $href = $headers['InitiatingPartyReturnUrl'] ?? '/';

            // Artificially delay the response to give the bank time to process the "payment".
            // If we don't have this all status checks return as open, which is annoying.
            sleep(10);
        }

        $href .= (str_contains($href, '?') ? '&' : '?').http_build_query([
            'endToEndId' => $payment->commonPaymentData->endToEndId,
            'paymentId' => $response->commonPaymentData->paymentId,
            'aspspPaymentId' => $response->commonPaymentData->aspspPaymentId,
        ]);

        return $response;
    }

    /**
     * Use this operation to retrieve the status of a payment.
     */
    public function status(
        string $paymentId,

        #[ArrayShape(self::PAYMENT_QUERY_PARAMS)]
        array $query = [],

        #[ArrayShape(self::STATUS_HEADERS)]
        array $headers = [],
    ): PaymentDetailedInformation {
        $requestTarget = self::BASE_URL.'/'.$paymentId.'/status';

        $headers += $this->sign([
            'Digest' => $this->digest(''),
            'X-Request-ID' => (string)Uuid::v4(),
            'MessageCreateDateTime' => (new DateTimeImmutable())->format(DateTimeInterface::ATOM),
            '(Request-Target)' => 'get '.$requestTarget,
        ]);

        return $this->ideal->get($requestTarget, [
            'headers' => $headers + [
                'Authorization' => $this->authorizationHeader(),
            ],
            'query' => $query,
        ], PaymentDetailedInformation::class);
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
