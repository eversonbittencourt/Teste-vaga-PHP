<?php

namespace App\Http\Requests\Api\Users;

// Required Libraries
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|confirmed',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'      => 'Nome não informado.',
            'email.required'     => 'E-mail nao informado.',
            'email.email'        => 'E-mail invalido.',
            'email.unique'       => 'E-mail já possui cadastro.',
            'password.required'  => 'Senha não informada.', 
            'password.confirmed' => 'Senha não conferem.'
        ];
    }
}
