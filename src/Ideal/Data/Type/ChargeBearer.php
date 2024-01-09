<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data\Type;

/**
 * ISO20022 ChargeBearerType1Code
 */
enum ChargeBearer: string
{
    /**
     * BorneByDebtor: All transaction charges are to be borne by the debtor.
     */
    case Debt = 'DEBT';

    /**
     * BorneByCreditor: All transaction charges are to be borne by the creditor.
     */
    case Cred = 'CRED';

    /**
     * Shared: In a credit transfer context, means that transaction charges on the sender side are to be borne by the debtor, transaction charges on the receiver side are to be borne by the creditor. In a direct debit context, means that transaction charges on the sender side are to be borne by the creditor, transaction charges on the receiver side are to be borne by the debtor.
     */
    case Shar = 'SHAR';

    /**
     * FollowingServiceLevel: Charges are to be applied following the rules agreed in the service level and/or scheme.
     */
    case Slev = 'SLEV';
}
