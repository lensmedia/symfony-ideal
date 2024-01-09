<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data\Type;

enum PaymentContextCode: string
{
    case BillPayment = 'BillPayment';
    case ContactlessTravel = 'ContactlessTravel';
    case EcommerceGoods = 'EcommerceGoods';
    case EcommerceServices = 'EcommerceServices';
    case Kiosk = 'Kiosk';
    case Parking = 'Parking';
    case P2p = 'P2P';
    case BillingGoodsAndServicesInAdvance = 'BillingGoodsAndServicesInAdvance';
    case BillingGoodsAndServicesInArrears = 'BillingGoodsAndServicesInArrears';
    case PispPayee = 'PispPayee';
    case EcommerceMerchantInitiatedPayment = 'EcommerceMerchantInitiatedPayment';
    case FaceToFacePointOfSale = 'FaceToFacePointOfSale';
    case TransferToSelf = 'TransferToSelf';
    case TransferToThirdParty = 'TransferToThirdParty';
}
