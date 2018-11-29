<?php

namespace Huangdijia\Ipip\Console;

use Illuminate\Console\Command;
use Huangdijia\Ipip\Facades\BaseStation;

class BaseStationFindCommand extends Command
{
    protected $signature   = 'ipip:basestation {ip}';
    protected $description = 'Find basestation info of ip by ipip';
    public function handle()
    {
        $ip   = $this->argument('ip');
        if (empty($ip)) {
            $this->error("argument ip is empty");
        }
        $info = BaseStation::find($ip);
        $this->info(json_encode($info, JSON_UNESCAPED_UNICODE));
    }
}