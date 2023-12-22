<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Resource;

trait PaymentArrayShapeTrait
{
    public const PAYMENT_QUERY_PARAMS = [
        /**
         * If set to 'true' the transaction will be immediately confirmed by the Open Banking Service if
         * confirmation of the payment by the Initiating Party is required by the ASPSP.
         *
         * Note: This field is only applicable when the notification service is used by the Initiating Party to
         * receive the status of the payment. When the notification is not used this flag can be set in the GET
         * status API.
         */
        'confirm' => 'bool',
    ];

    public const PAYMENT_HEADERS = [
        /**
         * UUID for unique request identification.
         */
        'X-Request-ID' => 'string',

        /**
         * The message create date time.
         * ISO 8601 DateTime.
         * Example: 2020-09-25T08:15:00.856Z
         */
        'MessageCreateDateTime' => 'string',

        /**
         * The URL which will be used for notification service request. The Open Banking Service supports two ways
         * in which this field can be filled:
         *
         * Option A) with a URL ending on /v2 or /v3, indicating the version of the Notification API implemented by
         * the Initiating Party. In this case the URL called for notifications will be extended with
         * /notification/status by the Open Banking Service. URL Matching pattern includes query parameters.
         *
         * Option B) with a full URL. The version information MUST BE provided in the 'NotificationVersion' field.
         * In this case the provided URL will not be extended, and used as-is.
         */
        'InitiatingPartyNotificationUrl' => 'string',

        /**
         * The version of the Notification API, implemented by the Initiating Party, which shall be used for
         * notification service request. Can be filled with v2 or v3. This field is only applicable if option
         * 'B' is chosen, see 'InitiatingPartyNotificationUrl' description.
         */
        'NotificationVersion' => 'string',

        /**
         * The callback URL for the redirection back to the initiating party after authorization.
         */
        'InitiatingPartyReturnUrl' => 'string',

        /**
         * If true, Bank Selection Interface will be used to request required information from PSU directly.
         *
         * Default: false
         */
        'UseAuthorisationLandingPages' => 'bool',

        /**
         * 2-digit ISO-639 code for the language in which the Bank Selection Interface are displayed.
         *
         * For special languages can be used 5-digit code like nl-BE, where first is ISO-639 langauge code and the
         * second is ISO-3166 country code.
         *
         * If not set, the language of the Bank Selection Interface is taken over from the end user’s browser
         * configuration or the system configuration of the Bank Selection Interface server.
         */
        'Locale' => 'string',

        /**
         * Indicates whether the user uses mobile device\tablet or PC.
         *
         * Default: false
         */
        'AppRedirectPreferred' => 'bool',

        /**
         * If this field is filled the Open Banking Service will try to retrieve previously stored information to
         * complete the payment:
         * - preferred bank of the PSU, if filled it will used to fill the AspspId.
         * - preferred bank account.
         * - check for a pre authentication token in case pre-authentication is available for the ASPSP.
         * - check for debtor token in case of IDEAL payments
         */
        'PsuId' => 'string',

        /**
         * PSU Session information.
         * The time when the PSU last logged in with the TPP. ISO 8601 DateTime.
         */
        'LastLogin' => 'string',

        /**
         * PSU Session information.
         * The forwarded IP Address header field consists of the corresponding HTTP request IP Address field between
         * PSU and TPP. It shall be contained if and only if this request was actively initiated by the PSU.
         */
        'PsuIpAddress' => 'string',

        /**
         * PSU Session information.
         * The forwarded IP Port header field consists of the corresponding HTTP request IP Port field between PSU
         * and TPP, if available.
         */
        'PsuIpPort' => 'string',

        /**
         * PSU Session information.
         * HTTP method used at the PSU-TPP interface. Available values - GET, POST, PUT, DELETE.
         */
        'HttpMethod' => 'string',

        /**
         * PSU Session information.
         * The forwarded Agent header field of the HTTP request between PSU and TPP.
         * Required if
         * - the PaymentProductequals IDEAL
         * - PsuIdis provided
         * - UseDebtorToken does not equal false
         */
        'HttpHeaderReferer' => 'string',

        /**
         * PSU Session information.
         * The forwarded IP Accept header fields consist of the corresponding HTTP request Accept header fields
         * between PSU and TPP.
         */
        'HttpHeaderAccept' => 'string',

        /**
         * PSU Session information.
         * The forwarded IP Accept header fields consist of the corresponding HTTP request Accept header fields
         * between PSU and TPP.
         */
        'HttpHeaderAcceptCharset' => 'string',

        /**
         * PSU Session information.
         * The forwarded IP Accept header fields consist of the corresponding HTTP request Accept header fields
         * between PSU and TPP.
         */
        'HttpHeaderAcceptEncoding' => 'string',

        /**
         * PSU Session information.
         * The forwarded IP Accept header fields consist of the corresponding HTTP request Accept header fields
         * between PSU and TPP.
         */
        'HttpHeaderAcceptLanguage' => 'string',

        /**
         * UUID (Universally Unique Identifier) for a device, which is used by the PSU. UUID identifies either a
         * device or a device dependant application installation. In case of an installation identification this
         * ID need to be unaltered until removal from device.
         */
        'DeviceId' => 'string',

        /**
         * The forwarded Geo Location of the corresponding http request between PSU and TPP.
         */
        'GeoLocation' => 'string',

        /**
         * Conditionally required for iDEAL payments. The signature in the request should include a keyId with the
         * value of fingerprint of the certificate.
         */
        'Signature' => 'string',

        /**
         * Is contained if and only if the Signature element is contained in the header of the request.
         * Example : SHA-256=hl1/Eps8BEQW58FJhDApwJXjGY4nr1ArGDHIT25vq6A=
         */
        'Digest' => 'string',
    ];

    public const STATUS_HEADERS = [
        /**
         * UUID for unique request identification.
         */
        'X-Request-ID' => 'string',

        /**
         * The message create date time.
         * ISO 8601 DateTime.
         * Example: 2020-09-25T08:15:00.856Z
         */
        'MessageCreateDateTime' => 'string',

        /**
         * PSU Session information.
         * The forwarded IP Address header field consists of the corresponding HTTP request IP Address field between
         * PSU and TPP. It shall be contained if and only if this request was actively initiated by the PSU.
         */
        'PsuIpAddress' => 'string',

        /**
         *
         * Conditionally required for iDEAL payments. The signature in the request should include a keyId with the
         * value of fingerprint of the certificate.
         */
        'Signature' => 'string',

        /**
         * Is contained if and only if the Signature element is contained in the header of the request.
         * Example: SHA-256=hl1/Eps8BEQW58FJhDApwJXjGY4nr1ArGDHIT25vq6A=
         */
        'Digest' => 'string',
    ];
}
