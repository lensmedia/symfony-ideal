<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data\Type;

enum PaymentStatus: string
{
    case Open = 'Open';
    case Authorised = 'Authorised';
    case PartiallyAuthorised = 'PartiallyAuthorised';
    case Pending = 'Pending';
    case SettlementInProcess = 'SettlementInProcess';
    case SettlementCompleted = 'SettlementCompleted';
    case ReceivedByCreditorBank = 'ReceivedByCreditorBank';
    case ReceivedOnCreditorAccount = 'ReceivedOnCreditorAccount';
    case Cancelled = 'Cancelled';
    case CancelledAtTpp = 'CancelledAtTPP';
    case Error = 'Error';
    case Expired = 'Expired';
}
