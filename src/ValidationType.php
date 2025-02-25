<?php

namespace Razorpay\Api;

class ValidationType {
    public const NON_NULL = 'NON_NULL';
    public const NON_EMPTY_STRING = 'NON_EMPTY_STRING';
    public const URL = 'URL';
    public const ID = 'ID';
    public const TOKEN_GRANT = 'TOKEN_GRANT';

    public static function getValues(): array {
        return [
            self::NON_NULL,
            self::NON_EMPTY_STRING,
            self::URL,
            self::ID,
            self::TOKEN_GRANT,
        ];
    }
}