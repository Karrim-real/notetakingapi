<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
            'title' => 'nullable|string',
            'author'  => 'nullable|string',
            'pages' => 'nullable|string',
            'description' => 'nullable|string',
            'isFavourite' => 'nullable|boolean',
            'image' => 'nullable'
        ];
    }
}
