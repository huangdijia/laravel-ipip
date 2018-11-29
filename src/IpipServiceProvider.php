<?php

namespace Huangdijia\Ipip;

use Huangdijia\Ipip\Console\BaseStationFindCommand;
use Huangdijia\Ipip\Console\CityFindCommand;
use Huangdijia\Ipip\Console\DistrictFindCommand;
use Huangdijia\Ipip\Console\DownloadCommand;
use Illuminate\Support\ServiceProvider;
use ipip\datx\BaseStation;
use ipip\datx\City;
use ipip\datx\District;

class IpipServiceProvider extends ServiceProvider
{
    protected $defer    = true;
    protected $commands = [
        CityFindCommand::class,
        DistrictFindCommand::class,
        BaseStationFindCommand::class,
        DownloadCommand::class,
    ];

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../config/config.php' => config_path('ipip.php')]);
        }
    }

    public function register()
    {
        $this->app->singleton(City::class, function () {
            $path = config('ipip.datx.city');
            return new City($path);
        });
        $this->app->alias(City::class, 'ipip.city');

        $this->app->singleton(District::class, function () {
            $path = config('ipip.datx.district');
            return new District($path);
        });
        $this->app->alias(District::class, 'ipip.district');

        $this->app->singleton(BaseStation::class, function () {
            $path = config('ipip.datx.basestation');
            return new BaseStation($path);
        });
        $this->app->alias(BaseStation::class, 'ipip.basestation');

        $this->commands($this->commands);
    }

    public function provides()
    {
        return [
            City::class,
            'ipip.city',

            District::class,
            'ipip.district',

            BaseStation::class,
            'ipip.basestation',
        ];
    }
}
