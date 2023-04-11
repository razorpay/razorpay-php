<?php

namespace Razorpay\Tests;
require_once realpath(__DIR__ . "/../vendor/autoload.php");

use Razorpay\Api\Api;
use Razorpay\Api\Request;
use PHPUnit\Framework\TestCase as PhpUnitTest;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


class TestCase extends PhpUnitTest
{
    
    public function setUp(): void
    {
        $key = getenv("RAZORPAY_API_KEY");
        $secret = getenv("RAZORPAY_API_SECRET");
        
        $this->api = new Api( $apiKey, $apiSecret);
    }
}
