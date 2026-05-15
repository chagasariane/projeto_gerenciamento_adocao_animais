<?php

return [

    'required' => 'O campo :attribute é obrigatório.',
    'email' => 'Informe um e-mail válido.',
    'min' => [
        'string' => 'O campo :attribute deve possuir pelo menos :min caracteres.',
    ],
    'max' => [
        'string' => 'O campo :attribute não pode ultrapassar :max caracteres.',
    ],
    'confirmed' => 'A confirmação da senha não confere.',
    'unique' => 'Este :attribute já está cadastrado.',

    'attributes' => [

        'name' => 'nome',
        'email' => 'e-mail',
        'password' => 'senha',
        'celular' => 'celular',
        'cep' => 'CEP',
        'logradouro' => 'logradouro',
        'numero' => 'número',
        'cidade' => 'cidade',
        'estado' => 'estado',

    ],

];