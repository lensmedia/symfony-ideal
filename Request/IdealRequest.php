<?php

namespace Lens\Bundle\IdealBundle\Request;

use DOMDocument;
use Lens\Bundle\IdealBundle\Exception\IdealException;
use Lens\Bundle\IdealBundle\Response\IdealResponse;
use RobRichards\XMLSecLibs\XMLSecEnc;
use RobRichards\XMLSecLibs\XMLSecurityDSig;
use RobRichards\XMLSecLibs\XMLSecurityKey;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Contracts\HttpClient\HttpClientInterface;

abstract class IdealRequest implements IdealRequestInterface
{
    public function __construct(
        private HttpClientInterface $http,
        protected array $options
    ) {
    }

    abstract public function message(IdealRequestOptions $options): DOMDocument;

    public function execute(IdealRequestOptions $options = null): IdealResponse
    {
        $url = $this->acquirerUrl();

        // Prepare our options.
        if (!$options) {
            $options = new IdealRequestOptions();
        }

        $options->set('merchant_id', $this->options['merchant_id']);
        $options->set('sub_id', $this->options['sub_id']);

        // Generate request using said options.
        $request = $this->message($options);
        $request = $this->sign($request);

        // Execute our request.
        $response = $this->http->request('POST', $url, [
            'headers' => ['Content-Type: application/xml'],
            'body' => $request->saveXML(),
        ]);

        // Verify response.
        $document = new DOMDocument();
        if (!$document->loadXML($response->getContent()) || !$this->verify($document)) {
            throw new IdealException('Response validation failed');
        }

        return IdealResponse::create(
            $response->getStatusCode(),
            $response->getInfo(),
            $response->getContent()
        );
    }

    protected function timestamp(): string
    {
        return gmdate('Y-m-d\TH:i:s.000\Z');
    }

    private function privateKeyPassword(): ?string
    {
        return $this->options['private_key_pass'];
    }

    private function privateKeyFile(): File
    {
        return new File($this->options['certificate_path'].$this->options['private_key_file']);
    }

    private function privateCertificateFile(): File
    {
        return new File($this->options['certificate_path'].$this->options['private_certificate_file']);
    }

    private function publicCertificateFile(): File
    {
        $path = $this->options['certificate_path'];
        if (null !== $this->options['public_certificate_file']) {
            return new File($path.$this->options['public_certificate_file']);
        }

        $acquirer = $this->options['acquirer'];

        $publicCertificateFiles = [
            'abn' => 'abnamro.cer',
            'deu' => 'deutschebank.cer',
            'fries' => 'frieslandbank.cer',
            'ing' => 'ingbank.cer',
            'rabo' => 'rabobank.cer',
            'sim' => 'simulator.cer',
        ];

        foreach ($publicCertificateFiles as $acquirerPart => $certificate) {
            if (false === stripos($acquirer, $acquirerPart)) {
                continue;
            }

            return new File($path.$certificate);
        }

        throw new IdealException('Unknown acquirer configured.');
    }

    private function acquirerUrl(): string
    {
        $acquirer = $this->options['acquirer'];
        $test = $this->options['test'];

        $acquirer = strtolower($acquirer);

        $protocol = $this->options['protocol'];

        $acquirerUrls = [
            'abn' => $protocol.'://abnamro'.($test ? '-test' : '').'.ideal-payment.de:443/ideal/iDEALv3',
            'deu' => $protocol.'://ideal'.($test ? 'test' : '').'.db.com:443/ideal/iDEALv3',
            'fries' => $protocol.'://'.($test ? 'test' : '').'idealkassa.frieslandbank.nl:443/ideal/iDEALv3',
            'ing' => $protocol.'://ideal'.($test ? 'test' : '').'.secure-ing.com:443/ideal/iDEALv3',
            'rabo' => $protocol.'://ideal'.($test ? 'test' : '').'.rabobank.nl:443/ideal/iDEALv3',
        ];

        foreach ($acquirerUrls as $acquirerPart => $url) {
            if (false === stripos($acquirer, $acquirerPart)) {
                continue;
            }

            return $url;
        }

        throw new IdealException('Unknown acquirer configured.');
    }

    private function sign(DOMDocument $document): DOMDocument
    {
        $signature = new XMLSecurityDSig();
        $signature->setCanonicalMethod(XMLSecurityDSig::EXC_C14N);
        $signature->addReference(
            $document,
            XMLSecurityDSig::SHA256,
            ['http://www.w3.org/2000/09/xmldsig#enveloped-signature'],
            ['force_uri' => true]
        );

        $key = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, ['type' => 'private']);
        $key->passphrase = $this->privateKeyPassword();
        $key->loadKey($this->privateKeyFile(), true);

        $keyName = $this->getCertificateFingerprint($this->privateCertificateFile());
        $this->appendKeyNameToKeyInfo($signature, $keyName);

        $signature->sign($key);
        $signature->appendSignature($document->documentElement);

        return $document;
    }

    private function verify(DOMDocument $document): bool
    {
        $ds = new XMLSecurityDSig();
        $signature = $ds->locateSignature($document);
        if (!$signature) {
            return false;
        }

        $ds->canonicalizeSignedInfo();
        $ds->idKeys = ['ID'];
        if (!$ds->validateReference()) {
            return false;
        }

        $key = $ds->locateKey();
        if (!$key) {
            return false;
        }

        $keyInfo = XMLSecEnc::staticLocateKeyInfo($key, $ds);
        $key->loadKey('file://'.$this->publicCertificateFile(), false, true);

        return $ds->verify($key);
    }

    private function appendKeyNameToKeyInfo(XMLSecurityDSig $signature, string $name): XMLSecurityDSig
    {
        if (empty($name)) {
            return $signature;
        }

        $child = $signature->createNewSignNode('KeyName', $name);
        $signature->appendToKeyInfo($child);

        return $signature;
    }

    private function getCertificateFingerprint(File $path): string
    {
        return openssl_x509_fingerprint('file://'.(string) $path, 'sha1');
    }
}
