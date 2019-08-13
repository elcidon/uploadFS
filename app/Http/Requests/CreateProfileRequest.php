<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProfileRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name'  => 'required',
            'image'      => 'image|max:2048',
        ];
    }

    public function messages() {
        return [
            'first_name.required' => 'Primeiro nome é um campo obrigatório',
            'last_name.required'  => 'Último nome é um campo obrigatório',
        ];
    }
}
