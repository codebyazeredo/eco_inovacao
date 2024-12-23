<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassificacaoIndicativaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:50',
            'sigla' => 'required|string|max:5',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O campo nome deve ser uma string.',
            'nome.max' => 'O campo nome não pode ter mais que 50 caracteres.',
            'sigla.required' => 'O campo sigla é obrigatório.',
            'sigla.string' => 'O campo sigla deve ser uma string.',
            'sigla.max' => 'O campo sigla não pode ter mais que 5 caracteres.',
        ];
    }
}
