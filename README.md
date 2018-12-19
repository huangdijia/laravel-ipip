# laravel-ipip

[![Latest Stable Version](https://poser.pugx.org/huangdijia/laravel-ipip/version.png)](https://packagist.org/packages/huangdijia/laravel-ipip)
[![Total Downloads](https://poser.pugx.org/huangdijia/laravel-ipip/d/total.png)](https://packagist.org/packages/huangdijia/laravel-ipip)

## Requirements

* PHP >= 7.0
* Laravel >= 5.5

## Installation

First, install laravel 5.5, and make sure that the database connection settings are correct.

~~~bash
composer require huangdijia/laravel-ipip
~~~

Then run these commands to publish config

~~~bash
php artisan vendor:publish --provider="Huangdijia\Ipip\IpipServiceProvider"
~~~

## Configurations

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

## Usage

### As Facade

~~~php
use Huangdijia\Ipip\Facades\BaseStation;
use Huangdijia\Ipip\Facades\City;
use Huangdijia\Ipip\Facades\District;

...

BaseStation::find('66.249.69.48'); // ['美国', '美国', '', '']
City::find('66.249.69.48');
District::find('66.249.69.48');

~~~

### As Command

~~~bash
php artisan ipip:basestation '66.249.69.48' # ['美国', '美国', '', '']
php artisan ipip:city '66.249.69.48'
php artisan ipip:district '66.249.69.48'
php artisan ipip:download # must set mail and pass at config/ipip.php
~~~

### As Helper

~~~php
ipip('city')->find('66.249.69.48'); // ['美国', '美国', '', '']
ipip_city()->find('66.249.69.48'); // ['美国', '美国', '', '']
ipip_city('66.249.69.48'); // ['美国', '美国', '', '']

ipip('basestation')->find('66.249.69.48');
ipip_basestation()->find('66.249.69.48');
ipip_basestation('66.249.69.48');

ipip('distric')->find('66.249.69.48');
ipip_distric()->find('66.249.69.48');
ipip_distric('66.249.69.48');

~~~

## Other

> * https://www.ipip.net
> * https://github.com/ipipdotnet/datx-php

## License

laravel-ipip is licensed under The MIT License (MIT).