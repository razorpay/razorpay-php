<?php

namespace Razorpay\Api;

class Api
{
    protected static $baseUrl = 'https://api.razorpay.com';

    protected static $key = null;

    protected static $secret = null;

    protected static $oauthToken = null;

    /*
     * App info is to store the Plugin/integration
     * information
     */
    public static $appsDetails = array();

    const VERSION = '2.9.1';

    /**
     * @param string $key
     * @param string $secret
     */
    public function __construct($key, $secret, $oauthToken=null)
    {
        self::$key = $key;
        self::$secret = $secret;
        self::$oauthToken = $oauthToken;
    }

    /*
     *  Set Headers
     */
    public function setHeader($header, $value)
    {
        Request::addHeader($header, $value);
    }

    public function setAppDetails($title, $version = null)
    {
        $app = array(
            'title' => $title,
            'version' => $version
        );

        array_push(self::$appsDetails, $app);
    }

    public function getAppsDetails()
    {
        return self::$appsDetails;
    }

    public function setBaseUrl($baseUrl)
    {
        self::$baseUrl = $baseUrl;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        $className = __NAMESPACE__.'\\'.ucwords($name);

        $entity = new $className();

        return $entity;
    }

    public static function getBaseUrl()
    {
        return self::$baseUrl;
    }

    public static function getKey()
    {
        return self::$key;
    }

    public static function getSecret()
    {
        return self::$secret;
    }

    public static function getToken()
    {
        return self::$oauthToken;
    }

    public static function getFullUrl($relativeUrl, $apiVersion = "v1")
    {
        return self::getBaseUrl() . "/". $apiVersion . "/". $relativeUrl;
    }
}
