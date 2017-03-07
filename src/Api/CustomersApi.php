<?php
/**
 * CustomersApi
 * PHP version 5
 *
 * @category Class
 * @package  CrowdProperty\ModulrHmacPhpClient
 * @author   Swagger Codegen team
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

namespace CrowdProperty\ModulrHmacPhpClient\Api;

use \CrowdProperty\ModulrHmacPhpClient\ApiClient;
use \CrowdProperty\ModulrHmacPhpClient\ApiException;
use \CrowdProperty\ModulrHmacPhpClient\Configuration;
use \CrowdProperty\ModulrHmacPhpClient\ObjectSerializer;

/**
 * CustomersApi Class Doc Comment
 *
 * @category Class
 * @package  CrowdProperty\ModulrHmacPhpClient
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class CustomersApi
{
    /**
     * API Client
     *
     * @var \CrowdProperty\ModulrHmacPhpClient\ApiClient instance of the ApiClient
     */
    protected $apiClient;

    /**
     * Constructor
     *
     * @param \CrowdProperty\ModulrHmacPhpClient\ApiClient|null $apiClient The api client to use
     */
    public function __construct(\CrowdProperty\ModulrHmacPhpClient\ApiClient $apiClient = null)
    {
        if ($apiClient === null) {
            $apiClient = new ApiClient();
        }

        $this->apiClient = $apiClient;
    }

    /**
     * Get API client
     *
     * @return \CrowdProperty\ModulrHmacPhpClient\ApiClient get the API client
     */
    public function getApiClient()
    {
        return $this->apiClient;
    }

    /**
     * Set the API client
     *
     * @param \CrowdProperty\ModulrHmacPhpClient\ApiClient $apiClient set the API client
     *
     * @return CustomersApi
     */
    public function setApiClient(\CrowdProperty\ModulrHmacPhpClient\ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
        return $this;
    }

    /**
     * Operation createCustomer
     *
     * Create Customer
     *
     * @param \CrowdProperty\ModulrHmacPhpClient\Model\CreateCustomerRequest $customer_request Details of Customer to create (optional)
     * @throws \CrowdProperty\ModulrHmacPhpClient\ApiException on non-2xx response
     * @return \CrowdProperty\ModulrHmacPhpClient\Model\Customer
     */
    public function createCustomer($customer_request = null)
    {
        list($response) = $this->createCustomerWithHttpInfo($customer_request);
        return $response;
    }

    /**
     * Operation createCustomerWithHttpInfo
     *
     * Create Customer
     *
     * @param \CrowdProperty\ModulrHmacPhpClient\Model\CreateCustomerRequest $customer_request Details of Customer to create (optional)
     * @throws \CrowdProperty\ModulrHmacPhpClient\ApiException on non-2xx response
     * @return array of \CrowdProperty\ModulrHmacPhpClient\Model\Customer, HTTP status code, HTTP response headers (array of strings)
     */
    public function createCustomerWithHttpInfo($customer_request = null)
    {
        // parse inputs
        $resourcePath = "/customers";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->apiClient->selectHeaderAccept(['application/json']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType(['application/json;charset=UTF-8']);

        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        // body params
        $_tempBody = null;
        if (isset($customer_request)) {
            $_tempBody = $customer_request;
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // this endpoint requires API key authentication
        $apiKey = $this->apiClient->getApiKeyWithPrefix('Authorization');
        if (strlen($apiKey) !== 0) {
            $headerParams['Authorization'] = $apiKey;
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'POST',
                $queryParams,
                $httpBody,
                $headerParams,
                '\CrowdProperty\ModulrHmacPhpClient\Model\Customer',
                '/customers'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\CrowdProperty\ModulrHmacPhpClient\Model\Customer', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 201:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\CrowdProperty\ModulrHmacPhpClient\Model\Customer', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation editCustomerUsingPUT
     *
     * Edit customer
     *
     * @param string $cid Id of Customer to be edited (required)
     * @param \CrowdProperty\ModulrHmacPhpClient\Model\UpdateCustomerRequest $customer_details Details of Customer to edit (optional)
     * @throws \CrowdProperty\ModulrHmacPhpClient\ApiException on non-2xx response
     * @return \CrowdProperty\ModulrHmacPhpClient\Model\Customer
     */
    public function editCustomerUsingPUT($cid, $customer_details = null)
    {
        list($response) = $this->editCustomerUsingPUTWithHttpInfo($cid, $customer_details);
        return $response;
    }

    /**
     * Operation editCustomerUsingPUTWithHttpInfo
     *
     * Edit customer
     *
     * @param string $cid Id of Customer to be edited (required)
     * @param \CrowdProperty\ModulrHmacPhpClient\Model\UpdateCustomerRequest $customer_details Details of Customer to edit (optional)
     * @throws \CrowdProperty\ModulrHmacPhpClient\ApiException on non-2xx response
     * @return array of \CrowdProperty\ModulrHmacPhpClient\Model\Customer, HTTP status code, HTTP response headers (array of strings)
     */
    public function editCustomerUsingPUTWithHttpInfo($cid, $customer_details = null)
    {
        // verify the required parameter 'cid' is set
        if ($cid === null) {
            throw new \InvalidArgumentException('Missing the required parameter $cid when calling editCustomerUsingPUT');
        }
        // parse inputs
        $resourcePath = "/customers/{cid}";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->apiClient->selectHeaderAccept(['application/json']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType(['application/json']);

        // path params
        if ($cid !== null) {
            $resourcePath = str_replace(
                "{" . "cid" . "}",
                $this->apiClient->getSerializer()->toPathValue($cid),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        // body params
        $_tempBody = null;
        if (isset($customer_details)) {
            $_tempBody = $customer_details;
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // this endpoint requires API key authentication
        $apiKey = $this->apiClient->getApiKeyWithPrefix('Authorization');
        if (strlen($apiKey) !== 0) {
            $headerParams['Authorization'] = $apiKey;
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'PUT',
                $queryParams,
                $httpBody,
                $headerParams,
                '\CrowdProperty\ModulrHmacPhpClient\Model\Customer',
                '/customers/{cid}'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\CrowdProperty\ModulrHmacPhpClient\Model\Customer', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\CrowdProperty\ModulrHmacPhpClient\Model\Customer', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation getCustomerUsingGET
     *
     * getCustomer
     *
     * @param string $cid cid (required)
     * @throws \CrowdProperty\ModulrHmacPhpClient\ApiException on non-2xx response
     * @return \CrowdProperty\ModulrHmacPhpClient\Model\Customer
     */
    public function getCustomerUsingGET($cid)
    {
        list($response) = $this->getCustomerUsingGETWithHttpInfo($cid);
        return $response;
    }

    /**
     * Operation getCustomerUsingGETWithHttpInfo
     *
     * getCustomer
     *
     * @param string $cid cid (required)
     * @throws \CrowdProperty\ModulrHmacPhpClient\ApiException on non-2xx response
     * @return array of \CrowdProperty\ModulrHmacPhpClient\Model\Customer, HTTP status code, HTTP response headers (array of strings)
     */
    public function getCustomerUsingGETWithHttpInfo($cid)
    {
        // verify the required parameter 'cid' is set
        if ($cid === null) {
            throw new \InvalidArgumentException('Missing the required parameter $cid when calling getCustomerUsingGET');
        }
        // parse inputs
        $resourcePath = "/customers/{cid}";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->apiClient->selectHeaderAccept(['application/json']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType(['application/json']);

        // path params
        if ($cid !== null) {
            $resourcePath = str_replace(
                "{" . "cid" . "}",
                $this->apiClient->getSerializer()->toPathValue($cid),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // this endpoint requires API key authentication
        $apiKey = $this->apiClient->getApiKeyWithPrefix('Authorization');
        if (strlen($apiKey) !== 0) {
            $headerParams['Authorization'] = $apiKey;
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'GET',
                $queryParams,
                $httpBody,
                $headerParams,
                '\CrowdProperty\ModulrHmacPhpClient\Model\Customer',
                '/customers/{cid}'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\CrowdProperty\ModulrHmacPhpClient\Model\Customer', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\CrowdProperty\ModulrHmacPhpClient\Model\Customer', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation getCustomersUsingGET
     *
     * getCustomers
     *
     * @param string $q Id or name or external reference of customer to search for (optional)
     * @param string $type Type to filter (optional)
     * @param string $verification_status Verification Status to filter (optional)
     * @param string $from_created_date Customers created after and on this date (optional)
     * @param string $to_created_date Customers created before and on this date (optional)
     * @param int $page Page to fetch (0 indexed) (optional)
     * @param int $size Size of Page to fetch (optional, default to 20)
     * @param string $sort_field Sort by field (optional)
     * @param string $sort_order Sorting order (optional)
     * @throws \CrowdProperty\ModulrHmacPhpClient\ApiException on non-2xx response
     * @return \CrowdProperty\ModulrHmacPhpClient\Model\PageResponseCustomer_
     */
    public function getCustomersUsingGET($q = null, $type = null, $verification_status = null, $from_created_date = null, $to_created_date = null, $page = null, $size = null, $sort_field = null, $sort_order = null)
    {
        list($response) = $this->getCustomersUsingGETWithHttpInfo($q, $type, $verification_status, $from_created_date, $to_created_date, $page, $size, $sort_field, $sort_order);
        return $response;
    }

    /**
     * Operation getCustomersUsingGETWithHttpInfo
     *
     * getCustomers
     *
     * @param string $q Id or name or external reference of customer to search for (optional)
     * @param string $type Type to filter (optional)
     * @param string $verification_status Verification Status to filter (optional)
     * @param string $from_created_date Customers created after and on this date (optional)
     * @param string $to_created_date Customers created before and on this date (optional)
     * @param int $page Page to fetch (0 indexed) (optional)
     * @param int $size Size of Page to fetch (optional, default to 20)
     * @param string $sort_field Sort by field (optional)
     * @param string $sort_order Sorting order (optional)
     * @throws \CrowdProperty\ModulrHmacPhpClient\ApiException on non-2xx response
     * @return array of \CrowdProperty\ModulrHmacPhpClient\Model\PageResponseCustomer_, HTTP status code, HTTP response headers (array of strings)
     */
    public function getCustomersUsingGETWithHttpInfo($q = null, $type = null, $verification_status = null, $from_created_date = null, $to_created_date = null, $page = null, $size = null, $sort_field = null, $sort_order = null)
    {
        // parse inputs
        $resourcePath = "/customers";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->apiClient->selectHeaderAccept(['application/json']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType(['application/json']);

        // query params
        if ($q !== null) {
            $queryParams['q'] = $this->apiClient->getSerializer()->toQueryValue($q);
        }
        // query params
        if ($type !== null) {
            $queryParams['type'] = $this->apiClient->getSerializer()->toQueryValue($type);
        }
        // query params
        if ($verification_status !== null) {
            $queryParams['verificationStatus'] = $this->apiClient->getSerializer()->toQueryValue($verification_status);
        }
        // query params
        if ($from_created_date !== null) {
            $queryParams['fromCreatedDate'] = $this->apiClient->getSerializer()->toQueryValue($from_created_date);
        }
        // query params
        if ($to_created_date !== null) {
            $queryParams['toCreatedDate'] = $this->apiClient->getSerializer()->toQueryValue($to_created_date);
        }
        // query params
        if ($page !== null) {
            $queryParams['page'] = $this->apiClient->getSerializer()->toQueryValue($page);
        }
        // query params
        if ($size !== null) {
            $queryParams['size'] = $this->apiClient->getSerializer()->toQueryValue($size);
        }
        // query params
        if ($sort_field !== null) {
            $queryParams['sortField'] = $this->apiClient->getSerializer()->toQueryValue($sort_field);
        }
        // query params
        if ($sort_order !== null) {
            $queryParams['sortOrder'] = $this->apiClient->getSerializer()->toQueryValue($sort_order);
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // this endpoint requires API key authentication
        $apiKey = $this->apiClient->getApiKeyWithPrefix('Authorization');
        if (strlen($apiKey) !== 0) {
            $headerParams['Authorization'] = $apiKey;
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'GET',
                $queryParams,
                $httpBody,
                $headerParams,
                '\CrowdProperty\ModulrHmacPhpClient\Model\PageResponseCustomer_',
                '/customers'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\CrowdProperty\ModulrHmacPhpClient\Model\PageResponseCustomer_', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\CrowdProperty\ModulrHmacPhpClient\Model\PageResponseCustomer_', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }
}
