<?php

namespace App\Http\Requests\Api\Movies;

// Required Libraries
use Illuminate\Foundation\Http\FormRequest;

class RemoveFavoriteRequest extends FormRequest
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
            'movie_id' => 'required|integer',
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
            'movie_id.required'  => 'ID do vídeo não informado.',
            'movie_id.integer'   => 'ID do vídeo deve ser um número interiro.'
        ];
    }
}
