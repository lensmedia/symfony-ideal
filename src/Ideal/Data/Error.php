<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

use Lens\Bundle\IdealBundle\Ideal\Exception\ErrorResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\ResponseInterface;

readonly class Error
{
    public const MESSAGES = [
        /** 400 */
        1 => 'Bad client request',
        2 => 'The message does not comply the schema definition',
        8 => 'Duplicate message',
        101 => 'The client or merchant is unknown',
        102 => 'The client or merchant is inactive',
        105 => 'The aspsp is not active',
        122 => 'The PSU consent is not valid',
        133 => 'A conditional field is missing',
        136 => 'Consent could not be found',

        /** 401 */
        3 => 'Invalid signature',
        21 => 'Unauthorized',
        123 => 'The PSU consent is expired',
        132 => 'A pre-authentication is required - but could not be found',
        135 => 'The status of the payment does not allow cancellation.',
        140 => 'The transaction authentication number is wrong',
        141 => 'The transaction authentication number is not valid anymore.',
        142 => 'The transaction authentication number has expired.',
        143 => 'The transaction authentication number is not active anymore.',
        144 => 'The user account is locked.',
        145 => 'The user account is temporarily locked.',
        146 => 'The user password has expired.',
        147 => 'The user account does not support a second factor.',
        148 => 'The user password has expired.',
        149 => 'User credential validation failed.',
        153 => 'The online refunds API has not been activated for your tenant.',
        154 => 'Invalid digest',

        /** 403 */
        7 => 'Initiating Party is not authorised',
        17 => 'Initiating party access token is expired',
        109 => 'No Subscription for psu management',
        119 => 'A PSU subscription is present, but inactive',
        120 => 'Payment status is not in the AUTHORISED state and cannot be confirmed',
        134 => 'The payment amount is above the limit set in your PIS subscription',

        /** 404 */
        104 => 'The Aspsp is unknown',
        110 => 'Resource could not be found',
        150 => 'No pre-authentication found',

        /** 405 */
        137 => 'Request is not supported by Aspsp',

        /** 415 */
        158 => 'Unsupported media type',

        /** 500 */
        4 => 'An internal error occurred',
        116 => 'The aspsp responded with an error',
        152 => 'Invalid response from ASPSP',

        /** 502 */
        12 => 'Aspsp did not authorise',

        /** 503 */
        16 => 'Request limit of the ASPSP server exceeded',
    ];

    public ?int $statusCode;

    public function __construct(
        public int $code,
        public string $message,
        ?int $statusCode = null,
        public ?string $details = null,
        public ?Link $link = null,
        public ?ResponseInterface $response = null,
    ) {
        $this->statusCode = $statusCode
            ?? $this->response?->getStatusCode()
            ?? Response::HTTP_BAD_REQUEST;
    }

    public function throw(): void
    {
        throw new ErrorResponse($this->statusCode, (string)$this, code :$this->code);
    }

    public function __toString(): string
    {
        return sprintf(
            '[%03d] %s: %s',
            $this->code,
            self::MESSAGES[$this->code] ?? 'Unknown error',
            $this->message,
        );
    }
}
