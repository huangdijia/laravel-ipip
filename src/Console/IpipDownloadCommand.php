<?php

namespace Huangdijia\Ipip\Console;

use Illuminate\Console\Command;
use ZipArchive;

class IpipDownloadCommand extends Command
{
    protected $signature   = 'ipip:download';
    protected $description = 'Download datx from ipip.net';
    private $cookiejar;

    const IPIP_DOWNLOAD_URL = 'https://www.ipip.net/free_download/17monipdb.zip';
    const IPIP_LOGIN_URL    = 'https://user.ipip.net/login.php';

    public function handle()
    {
        $this->cookiejar = stroage_path('ipip.cookie');
        $savepath        = stroage_path('app/public/17monipdb.zip');

        // login ipip
        $this->login(
            config('ipip.auth.mail'),
            config('ipip.auth.pass')
        );
        $this->download($savepath);

        // unzip
        $zip = new ZipArchive;
        if ($zip->open($savepath)) {
            $zip->extractTo(stroage_path('app/public'));
        }

        // report
        $this->info('Download success! path:' . stroage_path('app/public'));
    }

    private function login($mail = '', $pass = '')
    {
        $data = http_build_query([
            'csrf' => '',
            'mail' => $mail,
            'pass' => $pass,
        ]);
        $ch = curl_init(self::IPIP_LOGIN_URL);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
        curl_exec($ch);
    }

    private function download($savepath)
    {
        $fp = fopen($savepath, 'w+');
        $ch = curl_init(self::IPIP_DOWNLOAD_URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_exec($ch);
        fclose($fp);
    }
}
