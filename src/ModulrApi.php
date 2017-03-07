<?php
namespace CrowdProperty\ModulrHmacPhpClient;

use Carbon\Carbon;
use CrowdProperty\ModulrHmacPhpClient\Api\CustomersApi;
use CrowdProperty\ModulrHmacPhpClient\Exception\ConfigException;

class ModulrApi
{
    private $nonce;
    private $date;
    private $headers = [];

    private $sandboxApiPath = 'https://api-sandbox.modulrfinance.com/api-sandbox';
    private $apiPath = '';

    public function __construct()
    {
        $this->checkConfig();
    }

    public function getNonce()
    {
        if (is_null($this->nonce)) {
            $this->nonce = str_replace('.', '-', uniqid(null, true));
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
            $this->setDate(Carbon::now()->format('D, d M Y H:i:s \G\M\T'));
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

        return urlencode(base64_encode(hash_hmac('sha1', $hmacSigniture, \Config::get('modulr.hmac_secret'), true)));
    }

    protected function authorisationArray()
    {
        return [
            'Signature keyId' => \Config::get('modulr.api_key'),
            'algorithm' => 'hmac-sha1',
            'headers' => 'date x-mod-nonce',
            'signature' => $this->hmac()
        ];
    }

    protected function authorisationString()
    {
        $authString = null;
        foreach ( $this->authorisationArray() as $index => $value) {
            $authString .= (!is_null($authString) ? ',' : '') .  $index . '="' . $value . '"';
        }
        return $authString;
    }

    private function checkConfig()
    {
        if (!\Config::get('modulr.api_key')) {
            throw new ConfigException('Please set your ModulrFinance API key in the config file');
        } else if (!\Config::get('modulr.hmac_secret')) {
            throw new ConfigException('Please set your ModulrFinance HMAC secret in the config file');
        }
    }

    protected function createClient($nonce)
    {
        $config = new Configuration();

        if (!empty($nonce)) {
            $this->setNonce($nonce);
            $config->addDefaultHeader('x-mod-retry', true);
        }

        $config->setApiKey('Authorization', $this->authorisationString());

        if (strtolower(\Config::get('modulr.enviroment')) == 'sandbox') {
            $config->setHost($this->sandboxApiPath);
        } else {
            $config->setHost($this->apiPath);
        }

        $config->addDefaultHeader('Date', $this->getDate());
        $config->addDefaultHeader('x-mod-nonce', $this->getNonce());

        if (\Config::get('modulr.debug')) {
            $config->setDebug(true);
        }

        $api = new ApiClient($config);

        return $api;
    }

    public function accounts()
    {

    }

    public function benificiaries()
    {

    }

    public function customers($nonce = null)
    {
        return new CustomersApi($this->createClient($nonce));
    }

    public function inboundPayments()
    {

    }

    public function notifications()
    {

    }

    public function payments()
    {

    }

    public function rule()
    {

    }

    public function transactions()
    {

    }
}