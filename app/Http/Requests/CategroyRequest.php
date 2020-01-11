<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategroyRequest extends FormRequest
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
            "name" => "required|unique:categories"
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'The name must not be duplicated.',
        ];
    }
}
