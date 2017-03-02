<?php
/**
 * Created by PhpStorm.
 * User: stewartmcintosh
 * Date: 01/03/2017
 * Time: 11:27
 */

namespace CrowdProperty\ModulrHmacPhpClient\Facades;
use Illuminate\Support\Facades\Facade;


class Modulr extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'modulr';
    }
}