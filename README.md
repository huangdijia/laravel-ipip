# laravel-ipip

# Requirements

* PHP >= 7.0
* Laravel >= 5.5

# Installation

First, install laravel 5.5, and make sure that the database connection settings are correct.

~~~bash
composer require huangdijia/laravel-ipip
~~~

Then run these commands to publish config

~~~bash
php artisan vendor:publish --provider="Huangdijia\Ipip\IpipServiceProvider"
~~~

# Configurations

~~~php
// config/ipip.php
    'datx' => [
        'city'        => 'path/mydata4vipday4.datx',
        'district'    => 'path/quxian.datx',
        'basestation' => 'path/station_ip.datx',
    ],
    'auth' => [
        'mail' => '', // mail of ipip.net
        'pass' => '', // password of ipip.net
    ]
~~~

# Usage

## As Facade

~~~php
use Huangdijia\Ipip\Facades\BaseStation;
use Huangdijia\Ipip\Facades\City;
use Huangdijia\Ipip\Facades\District;

...

BaseStation::find('66.249.69.48');
City::find('66.249.69.48');
District::find('66.249.69.48');

~~~

## As Command

~~~bash
php artisan ipip:basestation 'ip'
php artisan ipip:city 'ip'
php artisan ipip:district 'ip'
php artisan ipip:download # must set mail and pass at config/ipip.php
~~~

# Other

> * https://www.ipip.net
> * https://github.com/ipipdotnet/datx-php

# License

laravel-ipip is licensed under The MIT License (MIT).