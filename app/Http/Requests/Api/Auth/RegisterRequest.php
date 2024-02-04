<?php

namespace App\Http\Requests\Api\Auth;

use App\Rules\IsValidPassword;
use App\Support\JsonFormRequest as FormRequest;

class RegisterRequest extends FormRequest
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
            'name'                  => __('Name'),
            'email'                 => __('Email'),
            'password'              => __('Password'),
            'password_confirmation' => __('Password Confirmation'),
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
            'name'                  => 'required|string|between:2,100',
            'email'                 => 'required|email:rfc,dns|regex:/(.+)@(.+)\.(.+)/i|between:2,200|unique:users,email',
            'password'              => [
                'required',
                'string',
                new IsValidPassword(),
            ],
            'password_confirmation' => 'required_with:password|same:password',
        ];
    }
}
