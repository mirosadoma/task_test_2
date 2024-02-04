<?php

namespace App\Http\Requests\Api\Posts;

use App\Support\JsonFormRequest as FormRequest;

class UpdateRequest extends FormRequest
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

    public function attributes()
    {
        return [
            'title'                 => __('Title'),
            'description'           => __('Description'),
            'phone_number'          => __('Phone Number'),
            'image'                 => __('Image'),
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
            'title'                 => 'required|string|between:2,100',
            'description'           => 'required|string|between:2,5000000000',
            'phone_number'          => ['required', 'between:9,15'],
            'image'                 => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
}
