<?php

namespace Razorpay\Api\Errors;

use Exception;

class Error extends Exception
{
    protected $httpStatusCode;
    protected $field    = null;
    protected $source   = null;
    protected $step     = null;
    protected $reason   = null;
    protected $metadata = null;

    public function __construct($message, $code, $httpStatusCode, $field = null, $source = null, $step = null, $reason = null, $metadata = null)
    {
        $this->code     = $code;
        $this->message  = $message;

        $this->httpStatusCode = $httpStatusCode;
        $this->field          = $field;
        $this->source         = $source;
        $this->step           = $step;
        $this->reason         = $reason;
        $this->metadata       = $metadata;
    }

    public function getHttpStatusCode()
    {
        return $this->httpStatusCode;
    }

    public function getField()
    {
        return $this->field;
    }

    public function getSource()
    {
        return $this->source;
    }

    public function getStep()
    {
        return $this->step;
    }

    public function getReason()
    {
        return $this->reason;
    }

    public function getMetadata()
    {
        return $this->metadata;
    }
}