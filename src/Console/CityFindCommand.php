<?php

namespace Huangdijia\Ipip\Console;

use Illuminate\Console\Command;
use Huangdijia\Ipip\Facades\City;

class CityFindCommand extends Command
{
    protected $signature   = 'ipip:city {ip}';
    protected $description = 'Find city info of ip by ipip';
    public function handle()
    {
        $ip   = $this->argument('ip');
        if (empty($ip)) {
            $this->error("argument ip is empty");
        }
        $info = City::find($ip);
        $this->info(json_encode($info, JSON_UNESCAPED_UNICODE));
    }
}