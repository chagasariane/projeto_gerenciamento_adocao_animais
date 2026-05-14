<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdocaoRequest extends FormRequest
{
    /**
     * Autorização.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Regras de validação.
     */
    public function rules(): array
    {
        return [

            'status' => [
                'required',
                'in:APROVADA,RECUSADA'
            ],
        ];
    }

    /**
     * Mensagens personalizadas.
     */
    public function messages(): array
    {
        return [

            'status.required' =>
                'O status é obrigatório.',

            'status.in' =>
                'Status inválido.',
        ];
    }
}