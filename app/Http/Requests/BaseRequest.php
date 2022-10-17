<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use App\Exceptions\FailedValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
// use Log;
use Illuminate\Support\Facades\Log;

abstract class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    public function failedResponse($input, $errors)
    {
        // ghi log tai day
        $this->getLogger($errors);
        // return validate exceptions
        $errorsData = [
            'status' => false,
            'code' => 422,
            'message' => trans('validation.validation_failed'),
            'pagination' => null,
            'data' => null,
            'errors' => $errors,
        ];

        throw new HttpResponseException(response()->json($errorsData, 422));
    }

    // protected function failedValidation(Validator $validator) {
    //     throw new FailedValidationException($validator);
    // }
    public function failedValidation(Validator $validator)
    {
        // $errors = $validator->errors(); // Here is your array of errors
        // throw new HttpResponseException($errors);
        $ex = new ValidationException($validator);
        $errors = $ex->errors();

        $input = $validator->attributes();
        $this->failedResponse($input, $errors);
    }

    /**
     * @return Log
     */
    public function getLogger($log)
    {
        return Log::channel('validation')->info($log);
    }
}