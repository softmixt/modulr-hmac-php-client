<?php
/**
 * IdentifierRequest
 *
 * PHP version 5
 *
 * @category Class
 * @package  CrowdProperty\ModulrHmacPhpClient
 * @author   Swaagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * Modulr API
 *
 * Modulo API
 *
 * OpenAPI spec version: 1
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 *
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace CrowdProperty\ModulrHmacPhpClient\Model;

use \ArrayAccess;

/**
 * IdentifierRequest Class Doc Comment
 *
 * @category    Class
 * @package     CrowdProperty\ModulrHmacPhpClient
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class IdentifierRequest implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'IdentifierRequest';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'account_number' => 'string',
        'iban_number' => 'string',
        'sort_code' => 'string',
        'type' => 'string'
    ];

    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of attributes where the key is the local name, and the value is the original name
     * @var string[]
     */
    protected static $attributeMap = [
        'account_number' => 'accountNumber',
        'iban_number' => 'ibanNumber',
        'sort_code' => 'sortCode',
        'type' => 'type'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'account_number' => 'setAccountNumber',
        'iban_number' => 'setIbanNumber',
        'sort_code' => 'setSortCode',
        'type' => 'setType'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'account_number' => 'getAccountNumber',
        'iban_number' => 'getIbanNumber',
        'sort_code' => 'getSortCode',
        'type' => 'getType'
    ];

    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    public static function setters()
    {
        return self::$setters;
    }

    public static function getters()
    {
        return self::$getters;
    }

    const TYPE_SCAN = 'SCAN';
    const TYPE_IBAN = 'IBAN';
    

    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getTypeAllowableValues()
    {
        return [
            self::TYPE_SCAN,
            self::TYPE_IBAN,
        ];
    }
    

    /**
     * Associative array for storing property values
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     * @param mixed[] $data Associated array of property values initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['account_number'] = isset($data['account_number']) ? $data['account_number'] : null;
        $this->container['iban_number'] = isset($data['iban_number']) ? $data['iban_number'] : null;
        $this->container['sort_code'] = isset($data['sort_code']) ? $data['sort_code'] : null;
        $this->container['type'] = isset($data['type']) ? $data['type'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];

        if (!is_null($this->container['account_number']) && !preg_match("/^\\d{8}$/", $this->container['account_number'])) {
            $invalid_properties[] = "invalid value for 'account_number', must be conform to the pattern /^\\d{8}$/.";
        }

        if (!is_null($this->container['sort_code']) && !preg_match("/^\\d{6}/", $this->container['sort_code'])) {
            $invalid_properties[] = "invalid value for 'sort_code', must be conform to the pattern /^\\d{6}/.";
        }

        $allowed_values = ["SCAN", "IBAN"];
        if (!in_array($this->container['type'], $allowed_values)) {
            $invalid_properties[] = "invalid value for 'type', must be one of 'SCAN', 'IBAN'.";
        }

        return $invalid_properties;
    }

    /**
     * validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {

        if (!preg_match("/^\\d{8}$/", $this->container['account_number'])) {
            return false;
        }
        if (!preg_match("/^\\d{6}/", $this->container['sort_code'])) {
            return false;
        }
        $allowed_values = ["SCAN", "IBAN"];
        if (!in_array($this->container['type'], $allowed_values)) {
            return false;
        }
        return true;
    }


    /**
     * Gets account_number
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->container['account_number'];
    }

    /**
     * Sets account_number
     * @param string $account_number
     * @return $this
     */
    public function setAccountNumber($account_number)
    {

        if (!is_null($account_number) && (!preg_match("/^\\d{8}$/", $account_number))) {
            throw new \InvalidArgumentException("invalid value for $account_number when calling IdentifierRequest., must conform to the pattern /^\\d{8}$/.");
        }

        $this->container['account_number'] = $account_number;

        return $this;
    }

    /**
     * Gets iban_number
     * @return string
     */
    public function getIbanNumber()
    {
        return $this->container['iban_number'];
    }

    /**
     * Sets iban_number
     * @param string $iban_number
     * @return $this
     */
    public function setIbanNumber($iban_number)
    {
        $this->container['iban_number'] = $iban_number;

        return $this;
    }

    /**
     * Gets sort_code
     * @return string
     */
    public function getSortCode()
    {
        return $this->container['sort_code'];
    }

    /**
     * Sets sort_code
     * @param string $sort_code
     * @return $this
     */
    public function setSortCode($sort_code)
    {

        if (!is_null($sort_code) && (!preg_match("/^\\d{6}/", $sort_code))) {
            throw new \InvalidArgumentException("invalid value for $sort_code when calling IdentifierRequest., must conform to the pattern /^\\d{6}/.");
        }

        $this->container['sort_code'] = $sort_code;

        return $this;
    }

    /**
     * Gets type
     * @return string
     */
    public function getType()
    {
        return $this->container['type'];
    }

    /**
     * Sets type
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $allowed_values = array('SCAN', 'IBAN');
        if (!is_null($type) && (!in_array($type, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'type', must be one of 'SCAN', 'IBAN'");
        }
        $this->container['type'] = $type;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     * @param  integer $offset Offset
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     * @param  integer $offset Offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     * @param  integer $offset Offset
     * @param  mixed   $value  Value to be set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     * @param  integer $offset Offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(\CrowdProperty\ModulrHmacPhpClient\ObjectSerializer::sanitizeForSerialization($this), JSON_PRETTY_PRINT);
        }

        return json_encode(\CrowdProperty\ModulrHmacPhpClient\ObjectSerializer::sanitizeForSerialization($this));
    }
}


