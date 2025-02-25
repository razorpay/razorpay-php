<?php

namespace Razorpay\Api;

class ValidationConfig {
    private string $fieldName;
    private array $validations;

    public function __construct(string $fieldName, array $validations) {
        $this->fieldName = $fieldName;
        $this->validations = $validations;
    }

    public function getFieldName(): string {
        return $this->fieldName;
    }

    public function getValidations(): array {
        return $this->validations;
    }
}
