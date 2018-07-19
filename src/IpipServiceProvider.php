<?php

namespace Huangdijia\Ipip;

use Illuminate\Support\ServiceProvider;
use ipip\datx\City;
use ipip\datx\District;
use ipip\datx\BaseStation;

class SsdbServiceProvider extends ServiceProvider
{
    protected $commands = [
        'Huangdijia\\Ipip\\Console\\IpipCityFindCommand',
        'Huangdijia\\Ipip\\Console\\IpipDistrictFindCommand',
        'Huangdijia\\Ipip\\Console\\IpipBaseStationFindCommand',
    ];

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__.'/../config' => config_path()], 'ipip-config');
        }
    }

    /**
     * 注册服务提供者
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('ipip.city', function () {
            $path = config('ipip.datx.city');
            return new City($path);
        });
        $this->app->singleton('ipip.district', function () {
            $path = config('ipip.datx.district');
            return new District($path);
        });
        $this->app->singleton('ipip.basestation', function () {
            $path = config('ipip.datx.basestation');
            return new BaseStation($path);
        });
    }
}