<?php

namespace Lens\Bundle\IdealBundle\Response;

interface IdealResponseInterface
{
    public const STATUS_SUCCESS = 'Success';
    public const STATUS_CANCELLED = 'Cancelled';
    public const STATUS_EXPIRED = 'Expired';
    public const STATUS_FAILURE = 'Failure';
    public const STATUS_OPEN = 'Open';
}
