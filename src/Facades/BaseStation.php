<?php

namespace Huangdijia\Ipip\Facades;

class BaseStation extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ipip.basestation'; 
    }
}