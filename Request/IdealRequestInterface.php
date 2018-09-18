<?php

namespace Lens\Bundle\IdealBundle\Request;

use DOMDocument;
use Lens\Bundle\IdealBundle\Response\IdealResponse;

interface IdealRequestInterface
{
    /**
     * Executes a specific request using our options.
     *
     * @param IdealRequestOptions|null $options
     *
     * @return
     */
    public function execute(IdealRequestOptions $options = null): IdealResponse;

    /**
     * Internally used function used to retreive the DOMDocument using our specific
     * request options when supplied in our execute function.
     *
     * @param IdealRequestOptions|null $options
     *
     * @return IdealResponseInterface instance for the specific request
     */
    public function message(IdealRequestOptions $options): DOMDocument;
}
