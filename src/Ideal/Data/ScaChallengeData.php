<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

class ScaChallengeData
{
    /**
     * Additional Information for the PSU describing the method.
     */
    public ?string $additionalInformation = null;

    /**
     * A collection of strings as challenge data.
     *
     * @var string[]
     */
    public ?array $data = null;

    /**
     * Image in base64 encoding.
     */
    public ?string $image = null;

    /**
     * URL of image.
     */
    public ?string $imageLink = null;

    /**
     * The OTP format.
     */
    public ?string $otpFormat = null;

    /**
     * The maximum length for the OTP (int32).
     */
    public ?int $otpMaxLength = null;
}
