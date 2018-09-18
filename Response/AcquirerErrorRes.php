<?php

namespace Lens\Bundle\IdealBundle\Response;

use SimpleXMLElement;
use Symfony\Component\HttpFoundation\HeaderBag;

/**
 * IX Invalid XML and all related problems. Such as incorrect encoding, invalid version, otherwise unreadable.
 * SO System maintenance. The errors that are communicated in the event of system maintenance or system failure. Also covers the situation where new requests are no longer being accepted but requests already submitted will be dealt with (until a certain time).
 * SE Security and authentication errors. Incorrect authentication methods and expired certificates.
 * BR Field errors. Additional information on incorrect fields.
 * AP Application errors. Errors relating to IDs, account numbers, time zones, transactions, currencies.
 */
final class AcquirerErrorRes extends IdealResponse
{
    const ERROR_CATEGORIES = [
        'IX' => 'Invalid XML and all related problems. Such as incorrect encoding, invalid version, otherwise unreadable.',
        'SO' => 'System maintenance. The errors that are communicated in the event of system maintenance or system failure. Also covers the situation where new requests are no longer being accepted but requests already submitted will be dealt with (until a certain time).',
        'SE' => 'Security and authentication errors. Incorrect authentication methods and expired certificates.',
        'BR' => 'Field errors. Additional information on incorrect fields.',
        'AP' => 'Application errors. Errors relating to IDs, account numbers, time zones, transactions, currencies.',
    ];

    const ERROR_DESCRIPTIONS = [
        'IX1100' => 'Received XML not valid',
        'IX1200' => 'Encoding type not UTF-8',
        'IX1300' => 'XML version number invalid',
        'IX1600' => 'Mandatory value missing',
        'SO1000' => 'Failure in system',
        'SO1100' => 'Issuer unavailable',
        'SO1200' => 'System busy. Try again later',
        'SO1400' => 'Unavailable due to maintenance',
        'SE2000' => 'Authentication error',
        'SE2100' => 'Authentication method not supported',
        'BR1200' => 'iDEAL version number invalid',
        'BR1210' => 'Value contains non-permitted character',
        'BR1220' => 'Value too long',
        'BR1230' => 'Value too short',
        'BR1270' => 'Invalid date/time',
        'BR1280' => 'Invalid URL',
        'AP1100' => 'MerchantID unknown',
        'AP1200' => 'IssuerID unknown',
        'AP1300' => 'SubID unknown',
        'AP1500' => 'MerchantID not active',
        'AP2600' => 'Transaction does not exist',
        'AP2900' => 'Selected currency not supported',
        'AP2910' => 'Maximum amount exceeded. (Detailed record states the maximum amount)',
        'AP2915' => 'Amount too low. (Detailed record states the minimum amount)',
        'AP2920' => 'Expiration period is not valid',
    ];

    protected function __construct(int $status, HeaderBag $headers, SimpleXMLElement $content)
    {
        parent::__construct($status, $headers, $content);
    }

    public function errorCode(): string
    {
        return (string) $this->content->Error->errorCode;
    }

    public function errorMessage(): string
    {
        return (string) $this->content->Error->errorMessage;
    }

    public function errorDetail(): string
    {
        return (string) $this->content->Error->errorDetail;
    }

    public function suggestedAction(): string
    {
        return isset($this->content->Error->suggestedAction) ? (string) $this->content->Error->suggestedAction : null;
    }

    public function consumerMessage(): string
    {
        return (string) $this->content->Error->consumerMessage;
    }
}
