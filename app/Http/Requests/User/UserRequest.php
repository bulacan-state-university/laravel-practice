<?php

namespace App\Http\Requests\User;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // make this true if you dont have user authentication
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string'
            ],
            'email' => [
                'required',
                'email',
                'string',
                Rule::unique('users', 'email')->ignore($this->id, 'id')
            ],
            'password' => [
                'required',
                'confirmed',
                'min: 6'
            ]
        ];
    }
}
