<?php

namespace Razorpay\Tests;
require_once realpath(__DIR__ . "/../vendor/autoload.php");

use Razorpay\Api\Api;
use Razorpay\Api\Request;
use PHPUnit\Framework\TestCase as PhpUnitTest;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

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
