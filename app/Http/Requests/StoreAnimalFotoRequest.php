<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnimalRequest extends FormRequest
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
            | DADOS BÁSICOS
            |--------------------------------------------------------------------------
            */

            'nome' => [
                'required',
                'string',
                'max:255'
            ],

            'descricao' => [
                'required',
                'string'
            ],

            'data_nascimento' => [
                'nullable',
                'date'
            ],

            /*
            |--------------------------------------------------------------------------
            | RELACIONAMENTOS
            |--------------------------------------------------------------------------
            */

            'especie_id' => [
                'required',
                'exists:especies,id'
            ],

            'raca_id' => [
                'required',
                'exists:racas,id'
            ],

            /*
            |--------------------------------------------------------------------------
            | CARACTERÍSTICAS
            |--------------------------------------------------------------------------
            */

            'sexo' => [
                'required',
                'in:MACHO,FEMEA,NAO_IDENTIFICADO'
            ],

            'porte' => [
                'required',
                'in:PEQUENO,MEDIO,GRANDE'
            ],

            /*
            |--------------------------------------------------------------------------
            | LOCALIZAÇÃO
            |--------------------------------------------------------------------------
            */

            'cidade' => [
                'required',
                'string',
                'max:255'
            ],

            'estado' => [
                'required',
                'string',
                'max:2'
            ],

            /*
            |--------------------------------------------------------------------------
            | SAÚDE
            |--------------------------------------------------------------------------
            */

            'castrado' => [
                'nullable',
                'boolean'
            ],

            'vacinado' => [
                'nullable',
                'boolean'
            ],

            'necessidades_especiais' => [
                'nullable',
                'string'
            ],

            /*
            |--------------------------------------------------------------------------
            | FOTOS
            |--------------------------------------------------------------------------
            */

            'fotos' => [
                'nullable',
                'array',
                'max:10'
            ],

            'fotos.*' => [
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

            /*
            |--------------------------------------------------------------------------
            | CAMPOS OBRIGATÓRIOS
            |--------------------------------------------------------------------------
            */

            'nome.required' =>
                'O nome do animal é obrigatório.',

            'descricao.required' =>
                'A descrição do animal é obrigatória.',

            'especie_id.required' =>
                'Selecione uma espécie.',

            'raca_id.required' =>
                'Selecione uma raça.',

            'sexo.required' =>
                'Selecione o sexo do animal.',

            'porte.required' =>
                'Selecione o porte do animal.',

            'cidade.required' =>
                'Informe a cidade.',

            'estado.required' =>
                'Informe o estado.',

            /*
            |--------------------------------------------------------------------------
            | FORMATOS
            |--------------------------------------------------------------------------
            */

            'data_nascimento.date' =>
                'Informe uma data válida.',

            'especie_id.exists' =>
                'A espécie selecionada é inválida.',

            'raca_id.exists' =>
                'A raça selecionada é inválida.',

            'sexo.in' =>
                'Sexo inválido.',

            'porte.in' =>
                'Porte inválido.',

            'estado.max' =>
                'O estado deve possuir no máximo 2 caracteres.',

            /*
            |--------------------------------------------------------------------------
            | FOTOS
            |--------------------------------------------------------------------------
            */

            'fotos.array' =>
                'Formato inválido para envio das fotos.',

            'fotos.max' =>
                'É permitido enviar no máximo 10 fotos.',

            'fotos.*.image' =>
                'O arquivo enviado deve ser uma imagem.',

            'fotos.*.mimes' =>
                'As imagens devem estar nos formatos JPG, JPEG, PNG ou WEBP.',

            'fotos.*.max' =>
                'Cada imagem deve possuir no máximo 5MB.',
        ];
    }
}