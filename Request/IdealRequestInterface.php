<?php

namespace Lens\Bundle\IdealBundle\Request;

use DOMDocument;
use Lens\Bundle\IdealBundle\Response\IdealResponse;

interface IdealRequestInterface
{
    /**
     * Executes a specific request using our options.
     */
    public function execute(?IdealRequestOptions $options = null): IdealResponse;

    /**
     * Internally used function used to retrieve the DOMDocument using our specific
     * request options when supplied in our execute function.
     *
     * @param IdealRequestOptions $options
     *
     * @return DOMDocument instance for the specific request
     */
    public function message(IdealRequestOptions $options): DOMDocument;
}
