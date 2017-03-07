<?php
/**
 * Created by PhpStorm.
 * User: stewartmcintosh
 * Date: 01/03/2017
 * Time: 11:27
 */

namespace CrowdProperty\ModulrHmacPhpClient;


use CrowdProperty\ModulrHmacPhpClient\Model\Customer;

class Modulr
{
    protected $request;

    public function test()
    {
        $request = new ModulrApi();
        $customer = new Customer();

        $customer->setName('test');

        echo $customer;

        $customerApi = $request->customers();

        $customerApi->createCustomer($customer->__toString());
                //$request->retry();
    }
}