<?php

namespace Razorpay\Api;

use Razorpay\Api\ValidationType;
use Razorpay\Api\Errors;

class PayloadValidator {

    public function validate($request, $validationConfig){
      foreach($validationConfig as $config){
        $fieldName = $config->getFieldName();

        foreach($config->getValidations() as $validationType){
            $this->applyValidation($request, $fieldName, $validationType);
        }
      }
    }

    private function applyValidation($payload, $field, $validationType) {
        switch ($validationType) {
            case ValidationType::NON_NULL:
                $this->validateNonNull($payload, $field);
                break;
            case ValidationType::NON_EMPTY_STRING:
                $this->validateNonEmptyString($payload, $field);
                break;
            case ValidationType::URL:
                $this->validateUrl($payload, $field);
                break;
            case ValidationType::ID:
                $this->validateID($payload, $field);
                break;
            case ValidationType::TOKEN_GRANT:
                $this->validateGrantType($payload, $field);
            default:
                break;
        }
    }

    private function validateNonNull($payload, $field) {
        
        if (!isset($payload[$field]) || is_null($payload[$field])) {
            $errorMessage = sprintf("Field %s cannot be null", $field);
            throw new Errors\BadRequestError($errorMessage, "BAD_REQUEST_ERROR", 400);
        }
    }

    private function validateNonEmptyString($payload, $field) {
        if (isset($payload[$field])) { 
            if (strlen($payload[$field]) == 0) {
                $errorMessage = sprintf("Field %s cannot be empty", $field);
                throw new Errors\BadRequestError($errorMessage, "BAD_REQUEST_ERROR", 400);
            }
       }    
    }

    private function validateUrl(array $payload, string $field): void {
        $url = $payload[$field] ?? '';
    
        $urlRegex = "/^(https?):\\/\\/[^\\s\\/$.?#].[^\\s]*$/i";
    
        if (!preg_match($urlRegex, $url)) {
            $errorMessage = sprintf("Field %s is not a valid URL", $field);
            throw new Errors\BadRequestError($errorMessage, "BAD_REQUEST_ERROR", 400);
        }
    }

    private function validateID(array $payload, string $field): void {
        $this->validateNonNull($payload, $field);
        $this->validateNonEmptyString($payload, $field);
    
        $value = $payload[$field];
    
        $idRegex = "/^[A-Za-z0-9]{1,14}$/";
    
        if (!preg_match($idRegex, $value)) {
            $errorMessage = sprintf("Field %s is not a valid ID", $field);
            throw new Errors\BadRequestError($errorMessage, "BAD_REQUEST_ERROR", 400);
        }
    }

    private function validateGrantType($payload, $field){
        $this->validateNonNull($payload, $field);
        $grantType = $payload[$field];

        switch($grantType){
            case "authorization_code":
                $this->validateNonNull($payload, "code");
            case "refresh_token":
                $this->validateNonNull($payload, "refresh_token");
                break;
            default:
                break;
        }
    }
}