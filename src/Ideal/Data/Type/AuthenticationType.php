<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data\Type;

/**
 * Type of the SCA authentication method.
 */
enum AuthenticationType: string
{
    /**
     * The PSU will receive a One Time Password via SMS
     */
    case SmsOtp = 'SMS_OTP';

    /**
     * The PSU will be presented with a picture or text to create a One Time Password using their bank card
     */
    case CipOtp = 'CHIP_OTP';

    /**
     * The PSU will be presented with a picture to create a One Time Password
     */
    case PhotoOtp = 'PHOTO_OTP';

    /**
     * The PSU will receive a One Time Password via push notification on their mobile device
     */
    case PushOtp = 'PUSH_OTP';

    /**
     * The PSU will receive a One Time Password via email
     */
    case SmtpOtp = 'SMTP_OTP';
}
