<?php

namespace Lens\Bundle\IdealBundle\Request;

use DOMDocument;

final class DirectoryReq extends IdealRequest
{
    public function message(IdealRequestOptions $options): DOMDocument
    {
        $document = new DOMDocument();

        $document->loadXML('
            <DirectoryReq xmlns="http://www.idealdesk.com/ideal/messages/mer-acq/3.3.1" version="3.3.1">
                <createDateTimestamp>'.$this->timestamp().'</createDateTimestamp>
                <Merchant>
                    <merchantID>'.$options->get('merchant_id').'</merchantID>
                    <subID>'.$options->get('sub_id').'</subID>
                </Merchant>
            </DirectoryReq>
        ');

        return $document;
    }
}
