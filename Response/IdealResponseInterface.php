<?php

namespace Lens\Bundle\IdealBundle\Response;

interface IdealResponseInterface
{
    const STATUS_SUCCESS = 'Success';
    const STATUS_CANCELLED = 'Cancelled';
    const STATUS_EXPIRED = 'Expired';
    const STATUS_FAILURE = 'Failure';
    const STATUS_OPEN = 'Open';
}
