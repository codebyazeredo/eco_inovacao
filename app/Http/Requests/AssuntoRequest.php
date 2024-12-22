<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssuntoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tipo' => 'required|string|max:255',
            'descricao' => 'required|string|max:500',
        ];
    }

    public function messages()
    {
        return [
            'tipo.required' => 'O campo tipo é obrigatório.',
            'tipo.string' => 'O campo tipo deve ser uma string.',
            'tipo.max' => 'O campo tipo não pode ter mais que 255 caracteres.',
            'descricao.required' => 'O campo descrição é obrigatório.',
            'descricao.string' => 'O campo descrição deve ser uma string.',
            'descricao.max' => 'O campo descrição não pode ter mais que 500 caracteres.',
        ];
    }
}
