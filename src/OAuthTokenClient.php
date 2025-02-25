<?php

namespace Razorpay\Api;

use Razorpay\Api\Request;
use Razorpay\Api\ValidationType;
use Razorpay\Api\PayloadValidator;

class OAuthTokenClient extends Api {

    protected static $baseUrl = 'https://auth.razorpay.com';
    
    protected static $authorize = 'authorize';

    protected static $version = '';

    private static $payloadValidator;

    public function __construct(){
    }

    public static function getBaseUrl()
    {
        return static::$baseUrl;
    }

    public static function getFullUrl($relativeUrl, $apiVersion = "v1")
    {
        return static::getBaseUrl() . "/". $apiVersion . "/". $relativeUrl;
    }

    function getAuthURL(array $request) { 
        
        $payload = new PayloadValidator();

        $payload->validate($request, $this->getValidationsForAuthRequestURL());

        $clientId = $request['client_id'];
        $redirectUri = $request['redirect_uri'];
        $state = $request['state'];
        $scopes = $request['scopes'];
    
        $queryParams = [
          'response_type' => 'code',
          'client_id' => $clientId,
          'redirect_uri' => $redirectUri,
          'state' => $state
        ];
    
        $scopesParam = null;
        foreach ($scopes as $scope) {
            $scopesParam .= "scope[]=$scope&";
        }

        if (!empty($request['onboarding_signature'])) {
            $queryParams['onboarding_signature'] = $request['onboarding_signature'];
        }

        $authUrl = static::$baseUrl . "/" . static::$authorize . "?" . $scopesParam . http_build_query($queryParams);
        return $authUrl;
    }
    
    public function getAccessToken($data = array()){

        $request = new Request(); 
        return $request->request('POST', 'token', $data, static::$version, true);
    }

    public function getRefreshToken($data = array()){

        $request = new Request(); 
        return $request->request('POST', 'token', $data, static::$version, true);
    }

    public function revokeToken($data = array()){

        $request = new Request(); 
        return $request->request('POST', 'token', $data, static::$version, true);
    }

    private function getValidationsForAuthRequestURL(): array {
        return [
            new ValidationConfig('client_id', [ValidationType::ID]),
            new ValidationConfig('redirect_uri', [ValidationType::NON_EMPTY_STRING, ValidationType::URL]),
            new ValidationConfig('scopes', [ValidationType::NON_NULL]),
            new ValidationConfig('state', [ValidationType::NON_EMPTY_STRING]),
        ];
    }
}