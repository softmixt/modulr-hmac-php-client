<?php
/**
 * RuleResponse
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
 * RuleResponse Class Doc Comment
 *
 * @category    Class
 * @package     CrowdProperty\ModulrHmacPhpClient
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class RuleResponse implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'RuleResponse';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'account_id' => 'string',
        'customer_id' => 'string',
        'data' => 'object',
        'id' => 'string',
        'name' => 'string',
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
        'account_id' => 'accountId',
        'customer_id' => 'customerId',
        'data' => 'data',
        'id' => 'id',
        'name' => 'name',
        'type' => 'type'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'account_id' => 'setAccountId',
        'customer_id' => 'setCustomerId',
        'data' => 'setData',
        'id' => 'setId',
        'name' => 'setName',
        'type' => 'setType'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'account_id' => 'getAccountId',
        'customer_id' => 'getCustomerId',
        'data' => 'getData',
        'id' => 'getId',
        'name' => 'getName',
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

    const TYPE_SPLIT = 'SPLIT';
    const TYPE_SWEEP = 'SWEEP';
    

    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getTypeAllowableValues()
    {
        return [
            self::TYPE_SPLIT,
            self::TYPE_SWEEP,
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
        $this->container['account_id'] = isset($data['account_id']) ? $data['account_id'] : null;
        $this->container['customer_id'] = isset($data['customer_id']) ? $data['customer_id'] : null;
        $this->container['data'] = isset($data['data']) ? $data['data'] : null;
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
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

        if ($this->container['account_id'] === null) {
            $invalid_properties[] = "'account_id' can't be null";
        }
        if ($this->container['data'] === null) {
            $invalid_properties[] = "'data' can't be null";
        }
        if ($this->container['id'] === null) {
            $invalid_properties[] = "'id' can't be null";
        }
        if ($this->container['name'] === null) {
            $invalid_properties[] = "'name' can't be null";
        }
        if ((strlen($this->container['name']) > 25)) {
            $invalid_properties[] = "invalid value for 'name', the character length must be smaller than or equal to 25.";
        }

        if ($this->container['type'] === null) {
            $invalid_properties[] = "'type' can't be null";
        }
        $allowed_values = ["SPLIT", "SWEEP"];
        if (!in_array($this->container['type'], $allowed_values)) {
            $invalid_properties[] = "invalid value for 'type', must be one of 'SPLIT', 'SWEEP'.";
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

        if ($this->container['account_id'] === null) {
            return false;
        }
        if ($this->container['data'] === null) {
            return false;
        }
        if ($this->container['id'] === null) {
            return false;
        }
        if ($this->container['name'] === null) {
            return false;
        }
        if (strlen($this->container['name']) > 25) {
            return false;
        }
        if ($this->container['type'] === null) {
            return false;
        }
        $allowed_values = ["SPLIT", "SWEEP"];
        if (!in_array($this->container['type'], $allowed_values)) {
            return false;
        }
        return true;
    }


    /**
     * Gets account_id
     * @return string
     */
    public function getAccountId()
    {
        return $this->container['account_id'];
    }

    /**
     * Sets account_id
     * @param string $account_id The Account which the Rule is created on.
     * @return $this
     */
    public function setAccountId($account_id)
    {
        $this->container['account_id'] = $account_id;

        return $this;
    }

    /**
     * Gets customer_id
     * @return string
     */
    public function getCustomerId()
    {
        return $this->container['customer_id'];
    }

    /**
     * Sets customer_id
     * @param string $customer_id The Customer which the Rule is created on.
     * @return $this
     */
    public function setCustomerId($customer_id)
    {
        $this->container['customer_id'] = $customer_id;

        return $this;
    }

    /**
     * Gets data
     * @return object
     */
    public function getData()
    {
        return $this->container['data'];
    }

    /**
     * Sets data
     * @param object $data Complex object that describes the Rule. For Split Type, this is an array of splits, with each split having percent & destinationId. Sweep Type, this needs frequency & destinationId.
     * @return $this
     */
    public function setData($data)
    {
        $this->container['data'] = $data;

        return $this;
    }

    /**
     * Gets id
     * @return string
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     * @param string $id Unique identifier for a Rule
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets name
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     * @param string $name Rule's name
     * @return $this
     */
    public function setName($name)
    {
        if ((strlen($name) > 25)) {
            throw new \InvalidArgumentException('invalid length for $name when calling RuleResponse., must be smaller than or equal to 25.');
        }

        $this->container['name'] = $name;

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
     * @param string $type The type of Rule.Can be one of
     * @return $this
     */
    public function setType($type)
    {
        $allowed_values = array('SPLIT', 'SWEEP');
        if ((!in_array($type, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'type', must be one of 'SPLIT', 'SWEEP'");
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


