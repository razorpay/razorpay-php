<?php

namespace Razorpay\Tests;

use Razorpay\Api\Api;
use Razorpay\Api\Request;

class TestCase extends \PHPUnit_Framework_TestCase
{
    
    public function setUp()
    {
        $apiKey = "api_key";
        $apiSecret = "api_secret";
        
        $this->api = new Api( $apiKey, $apiSecret);
    }
}