<?php

namespace Razorpay\Api;

use Razorpay\Api\Request;
use Razorpay\Api\ValidationType;
use Razorpay\Api\PayloadValidator;

class OAuthTokenClient extends Api {

    protected static $baseUrl = 'https://auth.razorpay.com';
    
    protected static $authorize = 'authorize';

    protected static $version = '';

    private $payloadValidator;

    private $request;

    private static $CLIENT_ID = 'client_id';
    private static $CLIENT_SECRET = 'client_secret';
    private static $REDIRECT_URI = 'redirect_uri';
    private static $STATE = 'state';
    private static $SCOPES = 'scopes';
    private static $GRANT_TYPE = 'grant_type';
    private static $REFRESH_TOKEN = 'refresh_token';
    private static $TOKEN = "token";
    private static $TOKEN_TYPE_HINT = "token_type_hint";

    public function __construct(){
      $this->payloadValidator = new PayloadValidator();
      $this->request = new Request();
    }

    public static function getBaseUrl()
    {
        return static::$baseUrl;
    }

    public static function getFullUrl($relativeUrl, $apiVersion = "v1")
    {
        return static::getBaseUrl() . $apiVersion . "/". $relativeUrl;
    }

    function getAuthURL(array $request) { 
        
        $this->payloadValidator->validate($request, $this->getValidationsForAuthRequestURL());

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
    
    public function getAccessToken(array $data){
        $this->payloadValidator->validate($data, $this->getValidationsForAccessTokenRequest()); 
        return $this->request->request('POST', 'token', $data, static::$version, true);
    }

    public function getRefreshToken(array $data){
        $this->payloadValidator->validate($data, $this->getValidationsForRefreshTokenRequest()); 
        return $this->request->request('POST', 'token', $data, static::$version, true);
    }

    public function revokeToken(array $data){
        $this->payloadValidator->validate($data, $this->getValidationsForRevokeTokenRequest()); 
        return $this->request->request('POST', 'revoke', $data, static::$version, true);
    }

    private function getValidationsForAuthRequestURL(): array {
        return [
            new ValidationConfig(self::$CLIENT_ID, [ValidationType::ID]),
            new ValidationConfig(self::$REDIRECT_URI, [ValidationType::NON_EMPTY_STRING, ValidationType::URL]),
            new ValidationConfig(self::$SCOPES, [ValidationType::NON_NULL]),
            new ValidationConfig(self::$STATE, [ValidationType::NON_EMPTY_STRING]),
        ];
    }

    private function getValidationsForAccessTokenRequest(): array {
        return [
            new ValidationConfig(self::$CLIENT_ID, [ValidationType::ID]),
            new ValidationConfig(self::$CLIENT_SECRET, [ValidationType::NON_EMPTY_STRING]),
            new ValidationConfig(self::$REDIRECT_URI, [ValidationType::NON_EMPTY_STRING, ValidationType::URL]),
            new ValidationConfig(self::$GRANT_TYPE, [ValidationType::NON_EMPTY_STRING, ValidationType::TOKEN_GRANT]),
        ];
    }

    private function getValidationsForRefreshTokenRequest(): array {
        return [
            new ValidationConfig(self::$CLIENT_ID, [ValidationType::ID]),
            new ValidationConfig(self::$CLIENT_SECRET, [ValidationType::NON_EMPTY_STRING]),
            new ValidationConfig(self::$REFRESH_TOKEN, [ValidationType::NON_EMPTY_STRING]),
            new ValidationConfig(self::$GRANT_TYPE, [ValidationType::NON_EMPTY_STRING, ValidationType::TOKEN_GRANT]),
        ];
    }

    private function getValidationsForRevokeTokenRequest(): array {
        return [
            new ValidationConfig(self::$CLIENT_ID, [ValidationType::ID]),
            new ValidationConfig(self::$CLIENT_SECRET, [ValidationType::NON_EMPTY_STRING]),
            new ValidationConfig(self::$TOKEN, [ValidationType::NON_EMPTY_STRING]),
            new ValidationConfig(self::$TOKEN_TYPE_HINT, [ValidationType::NON_EMPTY_STRING]),
        ];
    }
}