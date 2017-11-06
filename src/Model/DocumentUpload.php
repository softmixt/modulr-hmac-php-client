<?php

namespace CrowdProperty\ModulrHmacPhpClient\Model;

use ArrayAccess;

class DocumentUpload extends Document
{
    const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $swaggerModelName = 'DocumentUpload';

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @var string[]
     */
    protected static $swaggerTypes = [
        'file_name'     => 'string',
        'path'          => 'string',
        'uploaded_date' => 'string',
        'group'         => 'string',
        'content'       => 'string',
    ];

    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

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

    /**
     * Array of attributes where the key is the local name, and the value is the original name.
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'file_name'     => 'fileName',
        'path'          => 'path',
        'uploaded_date' => 'uploadedDate',
        'group'         => 'group',
        'content'       => 'content',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @var string[]
     */
    protected static $setters = [
        'file_name'     => 'setFileName',
        'path'          => 'setPath',
        'uploaded_date' => 'setUploadedDate',
        'group'         => 'setGroup',
        'content'       => 'setContent',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @var string[]
     */
    protected static $getters = [
        'file_name'     => 'getFileName',
        'path'          => 'getPath',
        'uploaded_date' => 'getUploadedDate',
        'group'         => 'getGroup',
        'content'       => 'getContent',
    ];

    /**
     * Constructor.
     *
     * @param mixed[] $data Associated array of property values initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['group'] = isset($data['group']) ? $data['group'] : null;
        $this->container['content'] = isset($data['content']) ? $data['content'] : null;
        parent::__construct($data);
    }

    /**
     * Gets group.
     *
     * @return string
     */
    public function getGroup()
    {
        return $this->container['group'];
    }

    /**
     * Sets file_name.
     *
     * @param string $group
     *
     * @return $this
     */
    public function setGroup($group)
    {
        $this->container['group'] = $group;

        return $this;
    }

    /**
     * Gets content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->container['content'];
    }

    /**
     * Sets path.
     *
     * @param string $content
     *
     * @return $this
     */
    public function setContent($content)
    {
        $this->container['content'] = $content;

        return $this;
    }

    /**
     * Gets the string presentation of the object.
     *
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
