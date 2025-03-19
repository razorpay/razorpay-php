<?php

namespace Razorpay\Api;

use Razorpay\Api\Request;
use Razorpay\Api\Validator;

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
      $this->request = new Request(Request::$OAUTH);
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
        $validator = new Validator($request, $this->getauthURLRule());
        $validator->validateOrFail();

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
        $validator = new Validator($data, $this->getAccessTokenRule());
        $validator->validateOrFail();
        return $this->request->request('POST', 'token', $data, static::$version);
    }

    public function getRefreshToken(array $data){
        $validator = new Validator($data, $this->getRefreshTokenRule());
        $validator->validateOrFail();
        return $this->request->request('POST', 'token', $data, static::$version);
    }

    public function revokeToken(array $data){
        $validator = new Validator($data, $this->revokeTokenRule());
        $validator->validateOrFail();
        return $this->request->request('POST', 'revoke', $data, static::$version);
    }

    protected function getauthURLRule(){
        return [
            self::$CLIENT_ID => 'required|id',
            self::$REDIRECT_URI => 'required|url',
            self::$SCOPES => 'required',
            self::$STATE => 'required'
        ];
    }

    protected function getAccessTokenRule(){
        return [
            self::$CLIENT_ID => 'required|id',
            self::$CLIENT_SECRET => 'required',
            self::$REDIRECT_URI => 'required|url',
            self::$GRANT_TYPE => 'required'
        ];
    }

    protected function getRefreshTokenRule(){
        return [
            self::$CLIENT_ID => 'required|id',
            self::$CLIENT_SECRET => 'required',
            self::$REFRESH_TOKEN => 'required'
        ];
    }

    protected function revokeTokenRule(){
        return [
            self::$CLIENT_ID => 'required|id',
            self::$CLIENT_SECRET => 'required',
            self::$TOKEN_TYPE_HINT => 'required|token_type',
            self::$TOKEN => 'required'
        ];
    }
}