<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data;

use Lens\Bundle\IdealBundle\Ideal\Data\Type\AuthenticationApproach;
use Lens\Bundle\IdealBundle\Ideal\Data\Type\ChannelType;
use Lens\Bundle\IdealBundle\Ideal\Data\Type\PaymentContextCode;
use Lens\Bundle\IdealBundle\Ideal\Util;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Information used for risk scoring by the ASPSP.
 */
class RiskInformation implements SerializableRequestData
{
    /**
     * Specifies the payment context. Payments for EcommerceGoods and EcommerceServices will be expected to have a
     * MerchantCategoryCode and MerchantCustomerIdentification populated. Payments for EcommerceGoods will also have
     * the DeliveryAddress populated.
     */
    public ?PaymentContextCode $paymentContextCode = null;

    /**
     * Category code conform to ISO 18245, related to the type of services or goods the merchant provides for the
     * transaction.
     */
    #[Assert\Length(min: 3, max: 4)]
    public ?string $merchantCategoryCode = null;

    /**
     * The unique customer identifier of the PSU with the merchant.
     */
    #[Assert\Length(min: 1, max: 70)]
    public ?string $merchantCustomerId = null;

    /**
     * Payment channel type.
     */
    public ?ChannelType $channelType = null;

    /**
     * Additional information related to the channel.
     */
    public ?string $channelMetaData = null;

    /**
     * Indicates the Applied Authentication Approach.
     */
    public ?AuthenticationApproach $appliedAuthenticationApproach = null;

    #[Assert\Length(max: 128)]
    public ?string $referencePaymentOrderId = null;

    public function jsonSerialize(): array
    {
        return array_filter([
            'PaymentContextCode' => Util::enumToString($this->paymentContextCode),
            'MerchantCategoryCode' => $this->merchantCategoryCode,
            'MerchantCustomerId' => $this->merchantCustomerId,
            'ChannelType' => Util::enumToString($this->channelType),
            'ChannelMetaData' => $this->channelMetaData,
            'AppliedAuthenticationApproach' => Util::enumToString($this->appliedAuthenticationApproach),
            'ReferencePaymentOrderId' => $this->referencePaymentOrderId,
        ], Util::isNotNull(...));
    }
}
