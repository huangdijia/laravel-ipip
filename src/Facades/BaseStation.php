<?php

namespace Huangdijia\Ipip\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array find(string $ip)
 * @see \ipip\datx\BaseStation
 */

class BaseStation extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ipip.basestation'; 
    }
}