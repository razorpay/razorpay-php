<?php

namespace Razorpay\Tests;

use Razorpay\Api\Api;
use Razorpay\Api\Request;

class TestCase extends \PHPUnit_Framework_TestCase
{
    
    public function setUp()
    {
        $apiKey = '';

        $apiSecret = '';
        
        $this->api = new Api($apiKey, $apiSecret);
    }
}