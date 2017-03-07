<?php
/**
 * Beneficiary
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
 * Beneficiary Class Doc Comment
 *
 * @category    Class
 * @package     CrowdProperty\ModulrHmacPhpClient
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class Beneficiary implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'Beneficiary';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'account_id' => 'string',
        'approval_required' => 'bool',
        'created' => '\DateTime',
        'customer_id' => 'string',
        'default_reference' => 'string',
        'destination_identifier' => '\CrowdProperty\ModulrHmacPhpClient\Model\AccountIdentifier',
        'external_reference' => 'string',
        'id' => 'string',
        'name' => 'string',
        'status' => 'string'
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
        'approval_required' => 'approvalRequired',
        'created' => 'created',
        'customer_id' => 'customerId',
        'default_reference' => 'defaultReference',
        'destination_identifier' => 'destinationIdentifier',
        'external_reference' => 'externalReference',
        'id' => 'id',
        'name' => 'name',
        'status' => 'status'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'account_id' => 'setAccountId',
        'approval_required' => 'setApprovalRequired',
        'created' => 'setCreated',
        'customer_id' => 'setCustomerId',
        'default_reference' => 'setDefaultReference',
        'destination_identifier' => 'setDestinationIdentifier',
        'external_reference' => 'setExternalReference',
        'id' => 'setId',
        'name' => 'setName',
        'status' => 'setStatus'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'account_id' => 'getAccountId',
        'approval_required' => 'getApprovalRequired',
        'created' => 'getCreated',
        'customer_id' => 'getCustomerId',
        'default_reference' => 'getDefaultReference',
        'destination_identifier' => 'getDestinationIdentifier',
        'external_reference' => 'getExternalReference',
        'id' => 'getId',
        'name' => 'getName',
        'status' => 'getStatus'
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

    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_DELETED = 'DELETED';
    const STATUS_PENDING = 'PENDING';
    const STATUS_BLOCKED = 'BLOCKED';
    

    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_ACTIVE,
            self::STATUS_DELETED,
            self::STATUS_PENDING,
            self::STATUS_BLOCKED,
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
        $this->container['approval_required'] = isset($data['approval_required']) ? $data['approval_required'] : null;
        $this->container['created'] = isset($data['created']) ? $data['created'] : null;
        $this->container['customer_id'] = isset($data['customer_id']) ? $data['customer_id'] : null;
        $this->container['default_reference'] = isset($data['default_reference']) ? $data['default_reference'] : null;
        $this->container['destination_identifier'] = isset($data['destination_identifier']) ? $data['destination_identifier'] : null;
        $this->container['external_reference'] = isset($data['external_reference']) ? $data['external_reference'] : null;
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];

        if ($this->container['created'] === null) {
            $invalid_properties[] = "'created' can't be null";
        }
        if ($this->container['customer_id'] === null) {
            $invalid_properties[] = "'customer_id' can't be null";
        }
        if ($this->container['default_reference'] === null) {
            $invalid_properties[] = "'default_reference' can't be null";
        }
        if ($this->container['destination_identifier'] === null) {
            $invalid_properties[] = "'destination_identifier' can't be null";
        }
        if ($this->container['id'] === null) {
            $invalid_properties[] = "'id' can't be null";
        }
        if ($this->container['name'] === null) {
            $invalid_properties[] = "'name' can't be null";
        }
        if ($this->container['status'] === null) {
            $invalid_properties[] = "'status' can't be null";
        }
        $allowed_values = ["ACTIVE", "DELETED", "PENDING", "BLOCKED"];
        if (!in_array($this->container['status'], $allowed_values)) {
            $invalid_properties[] = "invalid value for 'status', must be one of 'ACTIVE', 'DELETED', 'PENDING', 'BLOCKED'.";
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

        if ($this->container['created'] === null) {
            return false;
        }
        if ($this->container['customer_id'] === null) {
            return false;
        }
        if ($this->container['default_reference'] === null) {
            return false;
        }
        if ($this->container['destination_identifier'] === null) {
            return false;
        }
        if ($this->container['id'] === null) {
            return false;
        }
        if ($this->container['name'] === null) {
            return false;
        }
        if ($this->container['status'] === null) {
            return false;
        }
        $allowed_values = ["ACTIVE", "DELETED", "PENDING", "BLOCKED"];
        if (!in_array($this->container['status'], $allowed_values)) {
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
     * @param string $account_id Id of the account if this beneficiary is a Modulr account, null otherwise
     * @return $this
     */
    public function setAccountId($account_id)
    {
        $this->container['account_id'] = $account_id;

        return $this;
    }

    /**
     * Gets approval_required
     * @return bool
     */
    public function getApprovalRequired()
    {
        return $this->container['approval_required'];
    }

    /**
     * Sets approval_required
     * @param bool $approval_required Indicates if the beneficiary creation is pending approval
     * @return $this
     */
    public function setApprovalRequired($approval_required)
    {
        $this->container['approval_required'] = $approval_required;

        return $this;
    }

    /**
     * Gets created
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->container['created'];
    }

    /**
     * Sets created
     * @param \DateTime $created Datetime the Beneficiary was created
     * @return $this
     */
    public function setCreated($created)
    {
        $this->container['created'] = $created;

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
     * @param string $customer_id Id of the customer than owns this beneficiary
     * @return $this
     */
    public function setCustomerId($customer_id)
    {
        $this->container['customer_id'] = $customer_id;

        return $this;
    }

    /**
     * Gets default_reference
     * @return string
     */
    public function getDefaultReference()
    {
        return $this->container['default_reference'];
    }

    /**
     * Sets default_reference
     * @param string $default_reference Default reference used for payments to the Beneficiary.
     * @return $this
     */
    public function setDefaultReference($default_reference)
    {
        $this->container['default_reference'] = $default_reference;

        return $this;
    }

    /**
     * Gets destination_identifier
     * @return \CrowdProperty\ModulrHmacPhpClient\Model\AccountIdentifier
     */
    public function getDestinationIdentifier()
    {
        return $this->container['destination_identifier'];
    }

    /**
     * Sets destination_identifier
     * @param \CrowdProperty\ModulrHmacPhpClient\Model\AccountIdentifier $destination_identifier
     * @return $this
     */
    public function setDestinationIdentifier($destination_identifier)
    {
        $this->container['destination_identifier'] = $destination_identifier;

        return $this;
    }

    /**
     * Gets external_reference
     * @return string
     */
    public function getExternalReference()
    {
        return $this->container['external_reference'];
    }

    /**
     * Sets external_reference
     * @param string $external_reference External system reference for the Beneficiary
     * @return $this
     */
    public function setExternalReference($external_reference)
    {
        $this->container['external_reference'] = $external_reference;

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
     * @param string $id Unique reference for the Beneficiary. Begins with 'B'
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
     * @param string $name Name for the Beneficiary
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets status
     * @return string
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     * @param string $status Status of the Beneficiary. Can be:
     * @return $this
     */
    public function setStatus($status)
    {
        $allowed_values = array('ACTIVE', 'DELETED', 'PENDING', 'BLOCKED');
        if ((!in_array($status, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'status', must be one of 'ACTIVE', 'DELETED', 'PENDING', 'BLOCKED'");
        }
        $this->container['status'] = $status;

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

