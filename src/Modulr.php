<?php
/**
 * Created by PhpStorm.
 * User: stewartmcintosh
 * Date: 01/03/2017
 * Time: 11:27
 */

namespace CrowdProperty\ModulrHmacPhpClient;


class Modulr
{
    protected $request;

    public function test()
    {
        $request = new Request();
        $request->send();
    }
}