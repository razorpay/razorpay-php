<?php

namespace Razorpay\Tests;

use Razorpay\Api\Api;
use Razorpay\Api\Request;
use PHPUnit\Framework\TestCase as PhpUnitTest;

class TestCase extends PhpUnitTest
{
    
    public function setUp(): void
    {
        $apiKey = "rzp_test_1DP5mmOlF5G5ag";
        $apiSecret = "thisissupersecret";
        
        $this->api = new Api( $apiKey, $apiSecret);
    }
}