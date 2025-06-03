<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required | string | max:255',
            'year' => 'required | integer | min: 1888 | max:' . date(('Y') + 1),
            'rating' => 'nullable | numeric | min: 0 | max: 10',
            'review' => 'nullable | string',
            'watched' => 'required | boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'  => 'O título do filme é obrigatório.',
            'year.required'   => 'O ano do filme é obrigatório.',
            'year.integer'    => 'O ano deve ser numérico.',
            'year.min'        => 'O ano informado não é válido.',
            'year.max'        => 'O ano informado não é válido.',
            'rating.numeric'  => 'A nota deve ser um número entre 0 e 10.',
            'rating.min'      => 'A nota mínima é 0.',
            'rating.max'      => 'A nota máxima é 10.',
            'watched.required' => 'Informe se o filme já foi assistido.',
            'watched.boolean' => 'O valor assistido deve ser “0” ou “1”.',
        ];
    }
}
