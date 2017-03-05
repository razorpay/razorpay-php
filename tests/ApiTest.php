<?php

namespace Razorpay\Tests;

use Razorpay\Api\Request;

class ApiTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->baseUrl = 'https://test-api.razorpay.com/v1/';
    }

    public function testApiConfig()
    {
        $key = $this->api->getKey();
        $secret = $this->api->getSecret();

        $this->assertEquals($key, $_SERVER['KEY_ID']);
        $this->assertEquals($secret, $_SERVER['KEY_SECRET']);
    }

    public function testHeaders()
    {
        Request::addHeader('DEMO', 1);

        $headers = Request::getHeaders();
        $this->assertEquals($headers['DEMO'], 1);
    }

    public function testAppDetails()
    {
        $this->api->setAppDetails('Magento', '1.9');

        $appsDetails = $this->api->getAppsDetails();

        $this->assertEquals($appsDetails[0]['title'], 'Magento');
        $this->assertEquals($appsDetails[0]['version'], '1.9');
    }

    public function testBaseUrl()
    {
        $this->api->setBaseUrl($this->baseUrl);

        $this->assertEquals($this->baseUrl, $this->api->getBaseUrl());
    }

    public function testFullUrl()
    {
        $this->testBaseUrl();

        $relativeUrl = 'orders';

        $fullUrl = $this->api->getFullUrl($relativeUrl);

        $this->assertEquals($this->baseUrl . $relativeUrl, $fullUrl);
    }
}