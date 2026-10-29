<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnimalRequest extends FormRequest
{
    /**
     * Determina se o usuário pode realizar esta requisição.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepara os dados antes da validação.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([

            'nome' => $this->nome
                ? trim($this->nome)
                : null,

            'descricao' => $this->descricao
                ? trim($this->descricao)
                : null,

            'cidade' => $this->cidade
                ? trim($this->cidade)
                : null,

            'estado' => $this->estado
                ? strtoupper(trim($this->estado))
                : null,

            'necessidades_especiais' =>
                $this->necessidades_especiais
                    ? trim($this->necessidades_especiais)
                    : null,
        ]);
    }

    /**
     * Regras de validação.
     */
    public function rules(): array
    {
        return [

            'nome' => [
                'required',
                'string',
                'max:255'
            ],

            'descricao' => [
                'required',
                'string'
            ],

            'sexo' => [
                'required',
                'in:MACHO,FEMEA,NAO_IDENTIFICADO'
            ],

            'porte' => [
                'required',
                'in:PEQUENO,MEDIO,GRANDE'
            ],

            'cidade' => [
                'required',
                'string',
                'max:255'
            ],

            'estado' => [
                'required',
                'string',
                'size:2'
            ],

            'raca_id' => [
                'required',
                'exists:racas,id'
            ],

            'especie_id' => [
                'required',
                'exists:especies,id'
            ],

            'data_nascimento' => [
                'required',
                'date'
            ],

            'necessidades_especiais' => [
                'nullable',
                'string'
            ],
            'fotos' => [
                'nullable',
                'array',
                'max:10',
            ],

            'fotos.*' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
            
        ];
    }

    /**
     * Mensagens personalizadas.
     */
    public function messages(): array
    {
        return [

            'nome.required' =>
                'O nome do animal é obrigatório.',

            'descricao.required' =>
                'A descrição do animal é obrigatória.',

            'sexo.required' =>
                'O sexo do animal é obrigatório.',

            'sexo.in' =>
                'Sexo inválido.',

            'porte.required' =>
                'O porte do animal é obrigatório.',

            'porte.in' =>
                'Porte inválido.',

            'cidade.required' =>
                'A cidade é obrigatória.',

            'estado.required' =>
                'O estado é obrigatório.',

            'estado.size' =>
                'O estado deve possuir 2 caracteres.',

            'raca_id.required' =>
                'A raça é obrigatória.',

            'raca_id.exists' =>
                'Raça inválida.',

            'especie_id.required' =>
                'A espécie é obrigatória.',

            'especie_id.exists' =>
                'Espécie inválida.',

            'data_nascimento.required' =>
                'A data de nascimento é obrigatória.',

            'data_nascimento.date' =>
                'Informe uma data válida.',
            
            'fotos.array' =>
                'Formato inválido para envio das fotos.',

            'fotos.max' =>
                'É permitido enviar no máximo 10 fotos por vez.',

            'fotos.*.required' =>
                'Imagem inválida.',

            'fotos.*.image' =>
                'O arquivo enviado deve ser uma imagem.',

            'fotos.*.mimes' =>
                'As imagens devem estar nos formatos JPG, JPEG, PNG ou WEBP.',

            'fotos.*.max' =>
                'Cada imagem deve possuir no máximo 5 MB.',
        ];
    }
}