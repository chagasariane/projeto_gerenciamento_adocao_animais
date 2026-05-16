<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnimalFotoRequest extends FormRequest
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

            /*
            |--------------------------------------------------------------------------
            | FOTOS
            |--------------------------------------------------------------------------
            */

            'fotos' => [
                'required',
                'array',
                'max:10'
            ],

            'fotos.*' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120'
            ],
        ];
    }

    /**
     * Mensagens personalizadas.
     */
    public function messages(): array
    {
        return [

            'fotos.required' =>
                'Selecione pelo menos uma foto.',

            'fotos.array' =>
                'Formato inválido para envio das fotos.',

            'fotos.max' =>
                'É permitido enviar no máximo 10 fotos.',

            'fotos.*.required' =>
                'Imagem inválida.',

            'fotos.*.image' =>
                'O arquivo enviado deve ser uma imagem.',

            'fotos.*.mimes' =>
                'As imagens devem estar nos formatos JPG, JPEG, PNG ou WEBP.',

            'fotos.*.max' =>
                'Cada imagem deve possuir no máximo 5MB.',
        ];
    }
}