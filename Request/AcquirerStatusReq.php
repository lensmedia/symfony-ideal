<?php

namespace Lens\Bundle\IdealBundle\Request;

use DOMDocument;

/*
  The following situations must never occur:
  * Request the status of a transaction more than 5 times before the expiration period has passed;
  * Perform repeated StatusRequests with a time interval shorter than 60 seconds
  *
  The following situations should not occur after the expiration period has passed:
  * Perform repeated StatusRequests with a time interval shorter than 60 minutes
  * Request the status of a transaction more than 5 times per day
  * Request the status of a transaction after the final status of the transaction has been received;
  * Perform StatusRequests for transactions with a timestamp older than 7 days;
  * Stop requesting the status of a transaction before the final status of the transaction has been received (unless timestamp is older than 7 days).

  Also when a Consumer does not return to your website because he does not appropriately complete or cancel the
  iDEAL payment (e.g. when he/she clicks away its browser screen), the Merchant must at least perform the Query
  Protocol after the expiration time has ended, to collect the final status at the iDEAL Acquiring bank.
  is older than 7 days).

  @see IDeal merchant integration guide: Page 28
 */
final class AcquirerStatusReq extends IdealRequest
{
    public function message(IdealRequestOptions $options): DOMDocument
    {
        $document = new DOMDocument();

        $document->loadXML('
            <AcquirerStatusReq xmlns="http://www.idealdesk.com/ideal/messages/mer-acq/3.3.1" version="3.3.1">
                <createDateTimestamp>'.$this->timestamp().'</createDateTimestamp>
                <Merchant>
                        <merchantID>'.$options->get('merchant_id').'</merchantID>
                        <subID>'.$options->get('sub_id').'</subID>
                </Merchant>
                <Transaction>
                    <transactionID>'.$options->get('transaction').'</transactionID>
                </Transaction>
            </AcquirerStatusReq>
       ');

        return $document;
    }
}
