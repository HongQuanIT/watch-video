<?php

namespace App\Exceptions;

use Illuminate\Contracts\Validation\Validator;
use Exception;

class FailedValidationException extends Exception
{
    protected $validator;

    protected $code = 200;

    public function __construct(Validator $validator) {
        $this->validator = $validator;
    }

    public function render() {
        $errors = [];
        $validator = $this->validator->errors()->toArray();
        foreach ($validator as $key => $value) {
            $errors = array_merge($errors, $value);
        }
        return response()->json([
            "status" => "error",
            "data" => [],
            "messages" => $errors
        ], $this->code);
    }
}
