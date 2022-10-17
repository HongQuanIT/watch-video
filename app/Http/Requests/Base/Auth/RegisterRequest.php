<?php

namespace App\Http\Requests\Base\Auth;

use App\Http\Requests\BaseRequest;

class RegisterRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|string|email|unique:users,email|max:255',
            'password' => 'required|min:3|max:255|confirmed',
            'access_register' => 'accepted|max:255',
            'last_name' => 'required|min:1|max:255',
            'first_name' => 'required|min:1|max:255',
        ];
    }
}
