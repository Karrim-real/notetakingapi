<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:8',
            'email' => 'required|email',
            'username' => 'required|string',
            'password' => 'required|min:6|confirmed'
        ];
    }

    public function attributes()
    {
        return
            [
                'email.required' => 'Please Provide Valid email address'
            ];
    }
}
