<?php

namespace Razorpay\Tests;

use Razorpay\Api\Api;
use Razorpay\Api\Request;

class TestCase extends \PHPUnit_Framework_TestCase
{
    
    public function setUp()
    {
        $apiKey = 'rzp_test_k6uL897VPBz20q';
        $apiSecret = 'EnLs21M47BllR3X8PSFtjtbd';

        // $apiKey = 'rzp_test_G8lBRRcxH1t9Bd';
        // $apiSecret = 'Iwm6wk1Wy5AnB7ahSIpfJYxP';
        
        $this->api = new Api( $apiKey, $apiSecret);
    }
}