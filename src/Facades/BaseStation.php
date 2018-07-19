<?php

namespace Huangdijia\Ipip\Facades;

use Illuminate\Support\Facades\Facade;

class BaseStation extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ipip.basestation'; 
    }
}