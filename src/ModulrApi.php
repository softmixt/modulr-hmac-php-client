<?php

namespace CrowdProperty\ModulrHmacPhpClient;

use Carbon\Carbon;
use CrowdProperty\ModulrHmacPhpClient\Api\AccountsApi;
use CrowdProperty\ModulrHmacPhpClient\Api\BeneficiariesApi;
use CrowdProperty\ModulrHmacPhpClient\Api\CustomersApi;
use CrowdProperty\ModulrHmacPhpClient\Api\DocumentUploadApi;
use CrowdProperty\ModulrHmacPhpClient\Api\InboundpaymentsApi;
use CrowdProperty\ModulrHmacPhpClient\Api\NotificationsApi;
use CrowdProperty\ModulrHmacPhpClient\Api\PaymentsApi;
use CrowdProperty\ModulrHmacPhpClient\Api\RuleApi;
use CrowdProperty\ModulrHmacPhpClient\Api\TransactionsApi;
use CrowdProperty\ModulrHmacPhpClient\Exception\ConfigException;

/**
 * Class ModulrApi.
 */
class ModulrApi
{
    /**
     * @var
     */
    private $nonce;

    /**
     * @var
     */
    private $date;

    /**
     * @var
     */
    private $apiPath;

    /**
     * @var
     */
    private $apiKey;

    /**
     * @var
     */
    private $hmacSecret;

    /**
     * @var
     */
    private $debugMode = false;

    /**
     * @var
     */
    private $timezone = 'UTC';

    /**
     * ModulrApi constructor.
     */
    public function __construct()
    {
    }

    /**
     * Generates new nonce if not set
     * Returns nonce.
     *
     * @return string
     */
    public function getNonce()
    {
        if (is_null($this->nonce)) {
            $this->setNonce(str_replace('.', '-', uniqid(null, true)));
        }

        return $this->nonce;
    }

    /**
     * Set nonce.
     *
     * @param $nonce
     *
     * @return $this
     */
    public function setNonce($nonce)
    {
        $this->nonce = $nonce;

        return $this;
    }

    /**
     * Generates date if not set
     * Returns date.
     *
     * @return mixed
     */
    public function getDate()
    {
        if (is_null($this->date)) {
            $this->setDate(Carbon::now($this->timezone));
        }

        return $this->date->format('D, d M Y H:i:s e');
    }

    /**
     * Sets date.
     *
     * @param Carbon $date
     *
     * @return $this
     */
    public function setDate(Carbon $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Sets the timezone.
     *
     * @param Carbon $date
     *
     * @return $this
     */
    public function setTimezone($timezone = 'UTC')
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * Sets API Path.
     *
     * @param string $apiPath
     *
     * @return $this
     */
    public function setApiPath($apiPath)
    {
        $this->apiPath = $apiPath;

        return $this;
    }

    /**
     * Sets API Path.
     *
     * @param string $apiKey
     *
     * @return $this
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Sets HMAC secret.
     *
     * @param string $hmacSecret
     *
     * @return $this
     */
    public function setHmacSecret($hmacSecret)
    {
        $this->hmacSecret = $hmacSecret;

        return $this;
    }

    /**
     * Sets Debug mode.
     *
     * @param string $debug
     *
     * @return $this
     */
    public function setDebugMode($debug)
    {
        $this->debugMode = $debug;

        return $this;
    }

    /**
     * Generates hmac string.
     *
     * @return string
     */
    protected function hmac()
    {
        $hmacStr = [
            'date: '.$this->getDate(),
            'x-mod-nonce: '.$this->getNonce(),
        ];

        $hmacSignature = implode("\n", $hmacStr);

        return urlencode(base64_encode(hash_hmac('sha1', $hmacSignature, $this->hmacSecret, true)));
    }

    /**
     * Creates authorisation array.
     *
     * @return array
     */
    protected function authorisationArray()
    {
        return [
            'Signature keyId' => $this->apiKey,
            'algorithm'       => 'hmac-sha1',
            'headers'         => 'date x-mod-nonce',
            'signature'       => $this->hmac(),
        ];
    }

    /**
     * Converts authoristion array into string.
     *
     * @return string
     */
    public function authorisationString()
    {
        $authString = null;
        foreach ($this->authorisationArray() as $index => $value) {
            $authString .= (!is_null($authString) ? ',' : '').$index.'="'.$value.'"';
        }

        return $authString;
    }

    /**
     * Checks if modulr config is setup.
     *
     * @throws ConfigException
     */
    private function checkConfig()
    {
        if (!$this->apiKey) {
            throw new ConfigException('Please set your ModulrFinance API key in the config file');
        } elseif (!$this->hmacSecret) {
            throw new ConfigException('Please set your ModulrFinance HMAC secret in the config file');
        }
    }

    /**
     * @param $nonce
     *
     * @return ApiClient
     */
    protected function createClient($nonce = null)
    {
        $this->checkConfig();
        $config = new Configuration();

        $this->setNonce($nonce);

        if (!empty($nonce)) {
            $config->addDefaultHeader('x-mod-retry', true);
        }

        $config->setApiKey('Authorization', $this->authorisationString());

        $config->setHost($this->apiPath);

        $config->addDefaultHeader('Date', $this->getDate());
        $config->addDefaultHeader('x-mod-nonce', $this->getNonce());

        $config->setDebug($this->debugMode);

        $api = new ApiClient($config);

        return $api;
    }

    /**
     * @param null $nonce
     *
     * @return AccountsApi
     */
    public function accounts($nonce = null)
    {
        return new AccountsApi($this->createClient($nonce));
    }

    /**
     * @param null $nonce
     *
     * @return BeneficiariesApi
     */
    public function beneficiaries($nonce = null)
    {
        return new BeneficiariesApi($this->createClient($nonce));
    }

    /**
     * @param null $nonce
     *
     * @return CustomersApi
     */
    public function customers($nonce = null)
    {
        return new CustomersApi($this->createClient($nonce));
    }

    /**
     * @param null $nonce
     *
     * @return DocumentUploadApi
     */
    public function documents($nonce = null)
    {
        return new DocumentUploadApi($this->createClient($nonce));
    }

    /**
     * @param null $nonce
     *
     * @return InboundpaymentsApi
     */
    public function inboundPayments($nonce = null)
    {
        return new InboundpaymentsApi($this->createClient($nonce));
    }

    /**
     * @param null $nonce
     *
     * @return NotificationsApi
     */
    public function notifications($nonce = null)
    {
        return new NotificationsApi($this->createClient($nonce));
    }

    /**
     * @param null $nonce
     *
     * @return PaymentsApi
     */
    public function payments($nonce = null)
    {
        return new PaymentsApi($this->createClient($nonce));
    }

    /**
     * @param null $nonce
     *
     * @return RuleApi
     */
    public function rule($nonce = null)
    {
        return new RuleApi($this->createClient($nonce));
    }

    /**
     * @param null $nonce
     *
     * @return TransactionsApi
     */
    public function transactions($nonce = null)
    {
        return new TransactionsApi($this->createClient($nonce));
    }
}
