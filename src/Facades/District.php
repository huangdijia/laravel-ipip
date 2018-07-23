<?php

namespace Huangdijia\Ipip\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array find(string $ip)
 * @see \ipip\datx\District
 */

class District extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ipip.district'; 
    }
}