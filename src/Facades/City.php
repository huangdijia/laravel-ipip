<?php

namespace Huangdijia\Ipip\Facades;

use Illuminate\Support\Facades\Facade;

class City extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ipip.city'; 
    }
}