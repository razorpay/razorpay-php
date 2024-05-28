<?php

namespace Razorpay\Config;

class DNSConfig extends \ArrayObject
{
    public function __construct(array $input = [])
    {
        parent::__construct($input['dns'], \ArrayObject::ARRAY_AS_PROPS);
    }
}
