<?php

namespace Razorpay\Tests;

use Razorpay\Api\Api;
use Razorpay\Api\Request;
use PHPUnit\Framework\TestCase as PhpUnitTest;

$key = $_ENV["RAZORPAY_API_KEY"];
$secret = $_ENV["RAZORPAY_API_SECRET"];


class TestCase extends PhpUnitTest
{
    
    public function setUp(): void
    {
        $apiKey = $key;
        $apiSecret = $secret;
        
        $this->api = new Api( $apiKey, $apiSecret);
    }
}
