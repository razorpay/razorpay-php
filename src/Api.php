<?php

namespace Razorpay\Api;

class Api
{
    public static $baseUrl = "https://api.razorpay.com/v1/";

    public static $key = null;

    public static $secret = null;

    const VERSION = '1.2.8';

    /**
     * @param string $key
     * @param string $secret
     */
    function __construct($key, $secret)
    {
        self::$key = $key;
        self::$secret = $secret;

        // Add the version to all HTTP Requests
        Request::addHeader('User-Agent', "Razorpay-PHP/".self::VERSION);
    }

    /*
     *  Set Headers
     *
     */
    function setHeader($header, $value)
    {
        Request::addHeader($header, $value);
    }

    /**
     * @param string $name
     * @return mixed
     */
    function __get($name)
    {
        $className = __NAMESPACE__.'\\'.ucwords($name);

        $entity = new $className();

        return $entity;
    }
}
