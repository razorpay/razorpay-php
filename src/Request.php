<?php

namespace Razorpay\Api;

use Exception;
use Razorpay\Api\Errors;
use Razorpay\Api\Errors\ErrorCode;

/**
 * Request class to communicate to the request libarary
 */
class Request
{
    public function request($method, $url, $data = null)
    {
        $url = Api::$baseUrl . $url;

        $headers = array('Razorpay-API' => 1);

        if ($data === null)
            $data = array();

        $options = array('auth'=> array(Api::$key, Api::$secret));

        $response = \Requests::request($url, $headers, $data, $method, $options);

        $this->checkErrors($response);

        return json_decode($response->body, true);
    }

    /**
     * Process the statusCode of the response and throw exception if necessary
     * @param Object $response The response object returned by Requests
     */
    private function checkErrors($response)
    {
        $body = $response->body;
        $httpStatusCode = $response->status_code;

        try
        {
            $body = json_decode($response->body, true);
        }
        catch (Exception $e)
        {
            $this->throwServerError($body, $httpStatusCode);
        }

        if ($httpStatusCode !== 200)
        {
            $this->processError($body, $httpStatusCode, $response);
        }
    }

    protected function processError($body, $httpStatusCode, $response)
    {
        if (is_array($body) === false)
        {
            $this->throwServerError($body, $httpStatusCode);
        }

        if ((isset($body['error']) === false) or
            (isset($body['error']['code']) === false))
        {
            $this->throwServerError($body, $httpStatusCode);
        }

        $code = $body['error']['code'];

        if (Errors\ErrorCode::exists($code) === false)
        {
            $this->throwServerError($body, $httpStatusCode);
        }

        // We are basically converting the error code to the Error class name
        // Replace underscores with space
        // Lowercase the words, capitalize first letter of each word
        // Remove spaces
        $error = str_replace('_', ' ', $error);
        $error = ucwords(strtolower($error));
        $error = str_replace(' ', '', $error);

        // Add namespace
        // This is the fully qualified error class name
        $error = __NAMESPACE__.'\Errors\\' . $error;

        $description = $body['error']['description'];

        $field = null;
        if (isset($body['error']['field']))
        {
            $field = $body['error']['field'];

            // Create an instance of the error and then throw it
            throw new $error($description, $code, $httpStatusCode, $field);
        }

        throw new $error($description, $code, $httpStatusCode);
    }

    protected function throwServerError($body, $httpStatusCode)
    {
        $description = "The server did not send back a well-formed response.";

        throw new Errors\ServerError(
            $description,
            ErrorCode::SERVER_ERROR,
            $httpStatusCode);
    }
}