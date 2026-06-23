<?php

namespace Razorpay\Api\Errors;

use Exception;

class Error extends Exception
{
    protected $httpStatusCode;
    protected $context = [];

    public function __construct($message, $code, $httpStatusCode, array $context = [])
    {
        parent::__construct($message);

        $this->code           = $code;
        $this->httpStatusCode = $httpStatusCode;
        $this->context        = $context;
    }

    public function getHttpStatusCode()
    {
        return $this->httpStatusCode;
    }

    public function getSource()
    {
        return $this->context['source'] ?? null;
    }

    public function getStep()
    {
        return $this->context['step'] ?? null;
    }

    public function getReason()
    {
        return $this->context['reason'] ?? null;
    }

    public function getMetadata()
    {
        $metadata = $this->context['metadata'] ?? null;

        return is_array($metadata) ? $metadata : null;
    }
}
