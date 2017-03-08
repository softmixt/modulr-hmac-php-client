<?php
namespace CrowdProperty\ModulrHmacPhpClient;

use Carbon\Carbon;
use CrowdProperty\ModulrHmacPhpClient\Api\AccountsApi;
use CrowdProperty\ModulrHmacPhpClient\Api\BeneficiariesApi;
use CrowdProperty\ModulrHmacPhpClient\Api\CustomersApi;
use CrowdProperty\ModulrHmacPhpClient\Api\InboundpaymentsApi;
use CrowdProperty\ModulrHmacPhpClient\Api\NotificationsApi;
use CrowdProperty\ModulrHmacPhpClient\Api\PaymentsApi;
use CrowdProperty\ModulrHmacPhpClient\Api\RuleApi;
use CrowdProperty\ModulrHmacPhpClient\Api\TransactionsApi;
use CrowdProperty\ModulrHmacPhpClient\Exception\ConfigException;

/**
 * Class ModulrApi
 * @package CrowdProperty\ModulrHmacPhpClient
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
     * @var string
     */
    private $sandboxApiPath = 'https://api-sandbox.modulrfinance.com/api-sandbox';

    /**
     * @var string
     */
    private $apiPath = '';

    /**
     * ModulrApi constructor.
     */
    public function __construct()
    {
        $this->checkConfig();
    }

    /**
     * Generates new nonce if not set
     * Returns nonce
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
     * Set nonce
     * @param $nonce
     * @return $this
     */
    public function setNonce($nonce)
    {
        $this->nonce = $nonce;
        return $this;
    }

    /**
     * Generates date if not set
     * Returns date
     * @return mixed
     */
    public function getDate()
    {
        if (is_null($this->date)) {
            $this->setDate(Carbon::now()->format('D, d M Y H:i:s \G\M\T'));
        }
        return $this->date;
    }

    /**
     * Sets date
     * @param $date
     * @return $this
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Generates hmac string
     * @return string
     */
    protected function hmac()
    {
        $hmacStr = [
            "date: " . $this->getDate(),
            "x-mod-nonce: " . $this->getNonce()
        ];

        $hmacSigniture = implode("\n", $hmacStr);

        return urlencode(base64_encode(hash_hmac('sha1', $hmacSigniture, \Config::get('modulr.hmac_secret'), true)));
    }

    /**
     * Creates authorisation array
     * @return array
     */
    protected function authorisationArray()
    {
        return [
            'Signature keyId' => \Config::get('modulr.api_key'),
            'algorithm' => 'hmac-sha1',
            'headers' => 'date x-mod-nonce',
            'signature' => $this->hmac()
        ];
    }

    /**
     * Converts authoristion array into string
     * @return string
     */
    protected function authorisationString()
    {
        $authString = null;
        foreach ( $this->authorisationArray() as $index => $value) {
            $authString .= (!is_null($authString) ? ',' : '') .  $index . '="' . $value . '"';
        }
        return $authString;
    }

    /**
     * Checks if modulr config is setup
     * @throws ConfigException
     */
    private function checkConfig()
    {
        if (!\Config::get('modulr.api_key')) {
            throw new ConfigException('Please set your ModulrFinance API key in the config file');
        } else if (!\Config::get('modulr.hmac_secret')) {
            throw new ConfigException('Please set your ModulrFinance HMAC secret in the config file');
        }
    }

    /**
     *
     * @param $nonce
     * @return ApiClient
     */
    protected function createClient($nonce = null)
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

    /**
     * @param null $nonce
     * @return AccountsApi
     */
    public function accounts($nonce = null)
    {
        return new AccountsApi($this->createClient($nonce));
    }

    /**
     * @param null $nonce
     * @return BeneficiariesApi
     */
    public function beneficiaries($nonce = null)
    {
        return new BeneficiariesApi($this->createClient($nonce));
    }

    /**
     * @param null $nonce
     * @return CustomersApi
     */
    public function customers($nonce = null)
    {
        return new CustomersApi($this->createClient($nonce));
    }

    /**
     * @param null $nonce
     * @return InboundpaymentsApi
     */
    public function inboundPayments($nonce = null)
    {
        return new InboundpaymentsApi($this->createClient($nonce));
    }

    /**
     * @param null $nonce
     * @return NotificationsApi
     */
    public function notifications($nonce = null)
    {
        return new NotificationsApi($this->createClient($nonce));
    }

    /**
     * @param null $nonce
     * @return PaymentsApi
     */
    public function payments($nonce = null)
    {
        return new PaymentsApi($this->createClient($nonce));
    }

    /**
     * @param null $nonce
     * @return RuleApi
     */
    public function rule($nonce = null)
    {
        return new RuleApi($this->createClient($nonce));
    }

    /**
     * @param null $nonce
     * @return TransactionsApi
     */
    public function transactions($nonce = null)
    {
        return new TransactionsApi($this->createClient($nonce));
    }
}