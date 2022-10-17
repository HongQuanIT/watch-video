<?php

namespace App\Http\Requests\Base\Auth;

use App\Http\Requests\BaseRequest;

class ResetRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|string|email|max:255|exists:users,email',
        ];
    }
    // // custom messages validation rules
    // public function messages()
    // {
    // }
    
}