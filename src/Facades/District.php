<?php

namespace Huangdijia\Ipip\Facades;

use Illuminate\Support\Facades\Facade;

class District extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ipip.district'; 
    }
}