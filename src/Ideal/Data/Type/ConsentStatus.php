<?php

declare(strict_types=1);

namespace Lens\Bundle\IdealBundle\Ideal\Data\Type;

enum ConsentStatus: string
{
    case Open = 'Open';
    case Pending = 'Pending';
    case Rejected = 'Rejected';
    case Authorised = 'Authorised';
    case Expired = 'Expired';
    case Revoked = 'Revoked';
    case Error = 'Error';
    case Inactive = 'Inactive';
    case RevokedAtTpp = 'RevokedAtTpp';
    case PartiallyAuthorised = 'PartiallyAuthorised';
}
