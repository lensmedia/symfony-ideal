Basic bundle for creating iDEAL 2 payments.

Currently only implemented basic payment initiation/notification/status calls. Uses [brick/money](https://github.com/brick/money) (Money/Decimal/Currency) for money values/currency things.

The bundle exists of mainly two parts, the symfony bundle things. And a sort of not-extracted-standalone-library (https://github.com/lensmedia/symfony-ideal/tree/master/src/Ideal) for all requests/responses from the API which I ran in to. Which could be used outside of symfony.

## Config
These are the test values from our rabobank docs.
```yaml
lens_ideal:
    initiating_party_id: '002881'
    client: 'RaboiDEAL'
    base_url: 'https://routingservice-rabo.awltest.de/'
    public_key_path: '%kernel.project_dir%/config/certificates/TestCertificatesiDEAL.2.0.pem'
    private_key_path: '%kernel.project_dir%/config/certificates/TestCertificatesiDEAL.2.0.key'

    notifications:
        token: 'iDEAL2.0testnotificationtoken'
```

## Payment
```php
// Random ID
$endToEndId = (string)(new Ulid());

// This bundle has a lib of classes for the data structure comparable to the open banking one.
$payment = new PaymentInitiationRequest();
$payment->paymentProduct[] = PaymentProduct::Ideal;

$basicPayment = new PaymentInitiationRequestBasic();
$basicPayment->endToEndId = $endToEndId;
$payment->commonPaymentData = $basicPayment;

$price = Money::of(IdealInterface::DEBUG_PRICE_COMPLETED, 'EUR');
$basicPayment->amount = Amount::create($price);
$basicPayment->remittanceInformation = '00004123';
$basicPayment->remittanceInformationStructured = new RemittanceInformationStructured();
$basicPayment->remittanceInformationStructured->reference = '00004123';

// Set up headers, see docs or PaymentArrayShapeTrait::PAYMENT_HEADERS
$headers = [
    // The return URL when the payment has been completed.
    'InitiatingPartyReturnUrl' => $this->generateUrl('ideal_completed', [
        'id' => $endToEndId,
    ], UrlGeneratorInterface::ABSOLUTE_URL),

    // Optional if you want to use the notification system.
    'InitiatingPartyNotificationUrl' => $this->generateUrl('ideal_notification', [
        'id' => $endToEndId,
    ], UrlGeneratorInterface::ABSOLUTE_URL),

    'Locale' => $request->getLocale(),
];

// Send payment initiation request.
$response = $ideal->payments->create($payment, headers: $headers);

// Redirect to bank.
return $this->redirect($response->links->redirectUrl->href);
```

## Status
```php
/** @var \Lens\Bundle\IdealBundle\Ideal\Data\PaymentDetailedInformation $response */
$response = $ideal->payments->status($paymentId);
```

* **note** `paymentId` is returned by the bank in the initiation request, it is not our end to end id or anything.
* **note** `paymentId` is different from the `aspspPaymentId` which holds the old ideal transaction id. This makes status requests INCOMPATIBLE with previous transactions as you can not query using the old ID's.

## Notification
Notification route example.
```php
public function notification(
    IdealInterface $ideal,
    Request $request,
): Response {
    /** @var \Lens\Bundle\IdealBundle\Ideal\Data\PaymentDetailedInformation $data */
    $data = $ideal->payments->mapPaymentNotificationData($request->getContent());

    ...
```
