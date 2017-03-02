<?php
namespace CrowdProperty\ModulrHmacPhpClient;

use Carbon\Carbon;
use CrowdProperty\ModulrHmacPhpClient\Exception\ConfigException;
use GuzzleHttp\Client;

class Request
{
    private $client;
    private $nonce;
    private $date;
    private $headers = [];

    private $apiPath = '';
    private $sandBoxApiPath = 'https://api-sandbox.modulrfinance.com/api-sandbox-token/';

    public function __construct()
    {
        $this->checkConfig();
        $this->client = new Client();
    }

    public function addHeaders($headers)
    {
        $this->headers = array_merge($this->headers, $headers);
        return $this;
    }

    public function retry()
    {
        $this->setDate(null);
        $this->addHeaders([
            'x-mod-retry' => true
        ]);

        return $this->send();
    }

    public function send()
    {
        $this->addHeaders([
            'x-mod-nonce' => $this->getNonce(),
            'Date' => $this->getDate(),
            'Authorization' => $this->authorisationString()
        ]);
    }

    public function getNonce()
    {
        if (is_null($this->nonce)) {
            $this->nonce = uniqid(null, true);
        }
        return $this->nonce;
    }

    public function setNonce($nonce)
    {
        $this->nonce = $nonce;
        return $this;
    }

    public function getDate()
    {
        if (is_null($this->date)) {
            $this->setDate(Carbon::now()->format('D, d M Y H:i:s e'));
        }
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    protected function hmac()
    {
        $hmacStr = [
            "date: " . $this->getDate(),
            "x-mod-nonce: " . $this->getNonce()
        ];

        $hmacSigniture = implode("\n", $hmacStr);

        return urlencode(base64_encode(hash_hmac('sha1', $hmacSigniture , \Config::get('modulr.hmac_secret'), true)));
    }

    protected function authorisationString()
    {
        return [
            'Signiture keyId' => \Config::get('modulr.api_key'),
            'algorithm' => 'hmac-sha1',
            'headers' => 'date x-mod-nonce',
            'signiture' => $this->hmac()
        ];
    }

    private function checkConfig()
    {
        if (!\Config::get('modulr.api_key')) {
            throw new ConfigException('Please set your ModulrFinance API key in the config file');
        } else if (!\Config::get('modulr.hmac_secret')) {
            throw new ConfigException('Please set your ModulrFinance HMAC secret in the config file');
        }
    }
}