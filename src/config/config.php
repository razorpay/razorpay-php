<?php

namespace Razorpay\Api\Config;

use Razorpay\Config\DNSConfig;
use Requests;

class Config
{
    const DEFAULT_DNS = 'https://api.razorpay.com';
    const DEFAULT_COUNTRY_CODE = 'IN';

    const URL     = '';
    const TIMEOUT = 1;

    const CACHE_PATH = 'tmp://rzp_sdk_conf';
    const CACHE_TIME = 86400; // one day

    private $dnsConfig;

    private $defaultResponse = '{"dns":{}}';

    public function __construct()
    {
        $this->load();
    }

    private function load()
    {
        $this->dnsConfig = new DNSConfig();

        $response = $this->fetchSDKConfig();

        $this->dnsConfig = new DNSConfig($response);
    }

    private function fetchSDKConfig()
    {
        if(!file_exists(self::CACHE_PATH) OR
            (filemtime(self::CACHE_PATH) < (time() - self::CACHE_TIME)))
        {
           $content = $this->fetchConfigFromRemoteServer();
           file_put_contents(self::CACHE_PATH, $content, LOCK_EX);
           return json_decode($content);
        }

        return json_decode(file_get_contents(self::CACHE_PATH));
    }

    private function fetchConfigFromRemoteServer()
    {
        $options = [
            'timeout' => self::TIMEOUT
        ];

        try
        {
            $response = Requests::request(self::URL, [], [], Requests::GET, $options);
        }
        catch (\Throwable $e)
        {
            return $this->defaultResponse;
        }

        if ($response->status_code !== 200)
        {
            return $this->defaultResponse;
        }

        return $response->body;
    }

    public function getDNS(string $key): string
    {
        $countryCode = $this->deriveCountryCode($key);
        if (array_key_exists($countryCode, $this->dnsConfig))
        {
            return $this->dnsConfig[$countryCode];
        }

        return self::DEFAULT_DNS;
    }

    private function deriveCountryCode(string $key): string
    {
        $tokens = explode("_", $key);

        if (count($tokens) < 4)
        {
            return self::DEFAULT_COUNTRY_CODE;
        }

        $countryCode = array_slice($tokens, -2, 1);
        // Check for default format and return default country code
        if (strlen($countryCode) !== 2)
        {
            return self::DEFAULT_COUNTRY_CODE;
        }

        return strtoupper(substr($countryCode, 0, 2));
    }
}
