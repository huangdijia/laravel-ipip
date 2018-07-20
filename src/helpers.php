<?php
if (!function_exists('ipip')) {
    function ipip($type = 'city')
    {
        $types = ['city', 'district', 'basestation'];
        $type  = in_array($type, $types) ? $type : $types[0];
        return app('ipip.' . $type);
    }
}

if (!function_exists('ipip_city')) {
    function ipip_city($ip = null)
    {
        if (is_null($ip)) {
            return app('ipip.city');
        }
        return app('ipip.city')->find($ip);
    }
}

if (!function_exists('ipip_district')) {
    function ipip_district($ip = null)
    {
        if (is_null($ip)) {
            return app('ipip.district');
        }
        return app('ipip.district')->find($ip);
    }
}

if (!function_exists('ipip_base_station')) {
    function ipip_base_station($ip = null)
    {
        if (is_null($ip)) {
            return app('ipip.basestation');
        }
        return app('ipip.basestation')->find($ip);
    }
}

