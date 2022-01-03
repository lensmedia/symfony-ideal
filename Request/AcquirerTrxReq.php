<?php

namespace Lens\Bundle\IdealBundle\Request;

use DOMDocument;

final class AcquirerTrxReq extends IdealRequest
{
    public function message(IdealRequestOptions $options): DOMDocument
    {
        $document = new DOMDocument();

        $document->loadXML('
            <AcquirerTrxReq xmlns="http://www.idealdesk.com/ideal/messages/mer-acq/3.3.1" version="3.3.1">
                <createDateTimestamp>'.$this->timestamp().'</createDateTimestamp>
                <Issuer>
                    <issuerID>'.$options->get('issuer').'</issuerID>
                </Issuer>
                <Merchant>
                    <merchantID>'.$options->get('merchant_id').'</merchantID>
                    <subID>'.$options->get('sub_id').'</subID>
                    <merchantReturnURL>'.$options->get('url').'</merchantReturnURL>
                </Merchant>
                <Transaction>
                    <purchaseID>'.$options->get('id').'</purchaseID>
                    <amount>'.$options->get('amount').'</amount>
                    <currency>'.strtoupper($options->get('currency')).'</currency>
                    <expirationPeriod>'.strtoupper($options->get('expiration_period')).'</expirationPeriod>
                    <language>'.$options->get('language').'</language>
                    <description>'.$options->get('description').'</description>
                    <entranceCode>'.$options->get('entrance_code', sha1(uniqid(true, true))).'</entranceCode>
                </Transaction>
            </AcquirerTrxReq>
        ');

        return $document;
    }
}
