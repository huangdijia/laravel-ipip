# laravel-ipip

# Requirements

* PHP >= 7.0
* Laravel >= 5.5

# Installation

First, install laravel 5.5, and make sure that the database connection settings are correct.

~~~bash
composer require huangdijia/laravel-ipip
~~~

Then run these commands to publish assets and config：

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
    ]
~~~