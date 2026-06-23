<?php

namespace Razorpay\Api\Errors;

class BadRequestError extends Error
{
    protected $field = null;

    public function __construct($message, $code, $httpStatusCode, $field = null, array $context = [])
    {
        parent::__construct($message, $code, $httpStatusCode, $context);

        $this->field = $field;
    }

    public function getField()
    {
        return $this->field;
    }
}
