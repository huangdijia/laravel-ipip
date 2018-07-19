<?php

namespace Huangdijia\Ipip\Console;

use Exception;
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
        $this->cookiejar = storage_path('app/public/ipip.cookie');
        $zip_file        = storage_path('app/public/17monipdb.zip');
        $datx_file       = storage_path('app/public/17monipdb/17monipdb.datx');

        if (!config('ipip.auth.mail') || !config('ipip.auth.pass')) {
            throw new Exception('Please set ipip.auth.mail && ipip.auth.pass');
            return;
        }

        // login ipip
        $this->info('logining ipip.net');
        $this->login(
            config('ipip.auth.mail'),
            config('ipip.auth.pass')
        );
        $this->info('logined');

        // downling
        $this->info('downloading');
        $this->download($zip_file);
        if (!is_file($zip_file)) {
            throw new Exception('Download faild!');
        }
        $this->info('download success! path: ' . $zip_file);

        // unzip
        $this->info('extracting');
        $this->extract($zip_file);
        if (!is_file($datx_file)) {
            throw new Exception("Extract faild", 1);
        }
        $this->info('extracted success! path:' . $datx_file);
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
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookiejar);
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch));
        }
        if (
            stripos($response, '请使用邮箱登录')
            || stripos($response, '登录失败')
        ) {
            throw new Exception('Login faild');
        }
        curl_close($ch);
    }

    private function download($zip_file)
    {
        $fp = fopen($zip_file, 'w+');
        $ch = curl_init(self::IPIP_DOWNLOAD_URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookiejar);
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_exec($ch);
        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch));
        }
        fclose($fp);
    }

    private function extract($zip_file)
    {
        // unzip
        try {
            $zip = new ZipArchive;
            if ($zip->open($zip_file) === true) {
                $zip->extractTo(storage_path('app/public/17monipdb'));
                $zip->close();
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
}
