<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data\Type;

use RuntimeException;

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

    /**
     * Converts old, pre iDEAL 2.0 status strings to the new ones.
     */
    public static function OldToNew(?string $oldStatus): self
    {
        if ($oldStatus === null) {
            return self::Open;
        }

        return match (strtoupper($oldStatus)) {
            'OPEN' => self::Open,
            'COMPLETED' => self::SettlementCompleted,
            'CANCELLED' => self::Cancelled,
            'ERROR' => self::Error,
            'FAILURE' => self::Expired,
            default => throw new RuntimeException(sprintf(
                'Unknown legacy iDEAL transaction status "%s".',
                $oldStatus,
            )),
        };
    }

    /**
     * Converts new iDEAL 2.0 PaymentStatus types, to the old, pre iDEAL 2.0 string types.
     */
    public static function NewToOld(self $status): string
    {
        return match ($status) {
            self::Open => 'Open',
            self::SettlementCompleted => 'Completed',
            self::Cancelled => 'Cancelled',
            self::Error => 'Error',
            self::Expired => 'Failure',
            default => throw new RuntimeException(sprintf(
                'iDEAL PaymentStatus "%s" does not have an original variant.',
                $status->value,
            )),
        };
    }
}
