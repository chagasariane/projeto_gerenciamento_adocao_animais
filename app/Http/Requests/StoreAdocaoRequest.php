<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdocaoRequest extends FormRequest
{
    /**
     * Autorização.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepara dados antes da validação.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([

            'mensagem' => $this->mensagem
                ? trim($this->mensagem)
                : null,
        ]);
    }

    /**
     * Regras de validação.
     */
    public function rules(): array
    {
        return [

            'animal_id' => [
                'required',
                'exists:animais,id'
            ],

            'mensagem' => [
                'nullable',
                'string',
                'max:2000'
            ],
        ];
    }

    /**
     * Mensagens personalizadas.
     */
    public function messages(): array
    {
        return [

            'animal_id.required' =>
                'O animal é obrigatório.',

            'animal_id.exists' =>
                'Animal inválido.',

            'mensagem.max' =>
                'A mensagem deve possuir no máximo 2000 caracteres.',
        ];
    }
}