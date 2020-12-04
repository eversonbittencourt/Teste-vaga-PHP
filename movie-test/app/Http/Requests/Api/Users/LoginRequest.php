<?php

namespace App\Http\Requests\Api\Users;

// Required Libraries
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email'     => 'required|email|exists:users,email',
            'password'  => 'required'
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
            'email.exists'       => 'E-mail nao localizado.',
            'email.email'        => 'E-mail invalido.',
            'password.required'  => 'Senha não informada.', 
            'password.confirmed' => 'Senha não conferem.'
        ];
    }
}
