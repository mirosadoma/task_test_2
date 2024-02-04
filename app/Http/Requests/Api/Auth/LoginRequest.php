<?php

namespace App\Http\Requests\Api\Auth;

use App\Support\JsonFormRequest as FormRequest;
use App\Rules\IsValidPassword;

class LoginRequest extends FormRequest
{
    protected $errorBag = 'form';

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function attributes()
    {
        return [
            'email'                 => __('Email'),
            'password'              => __('Password'),
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'                 => ['required', 'email:rfc,dns', 'regex:/(.+)@(.+)\.(.+)/i', 'between:2,200','exists:users,email', 'email'],
            'password'              => [
                'required',
                'string',
                new IsValidPassword()
            ]
        ];
    }
}
