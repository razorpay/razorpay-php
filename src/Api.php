<?php

namespace Razorpay\Api;

class Api
{
    public static $baseUrl = "https://api.razorpay.com/v1/";

    public static $key = null;

    public static $secret = null;

    /**
     * @param string $api_key
     */
    function __construct($key, $secret)
    {
        self::$key = $key;
        self::$secret = $secret;
    }

    /**
     * @param string $name
     */
    function __get($name)
    {
        $className = __NAMESPACE__.'\\'.ucwords($name);

        $entity = new $className();

        return $entity;
    }
}