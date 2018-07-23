<?php

namespace Huangdijia\Ipip\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array find(string $ip)
 * @see \ipip\datx\City
 */

class City extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ipip.city'; 
    }
}