<?php

namespace Huangdijia\Ipip\Console;

use Illuminate\Console\Command;
use Huangdijia\Ipip\Facades\District;

class IpipDistrictFindCommand extends Command
{
    protected $signature   = 'ipip:district {ip}';
    protected $description = 'Find district info of ip by ipip';
    public function handle()
    {
        $ip   = $this->argument('ip');
        if (empty($ip)) {
            $this->error("argument ip is empty");
        }
        $info = District::find($ip);
        $this->info(json_encode($info));
    }
}