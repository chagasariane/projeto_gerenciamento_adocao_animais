<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PerguntaAdocao;

class PerguntaAdocaoSeeder extends Seeder
{
    public function run(): void
    {
        $perguntas = [

            [
                'pergunta' => 'Todos os moradores da residência concordam com a adoção?',
                'tipo' => 'boolean',
                'opcoes' => null,
                'obrigatoria' => true,
                'ordem' => 1,
            ],

            [
                'pergunta' => 'Você mora em casa ou apartamento?',
                'tipo' => 'select',
                'opcoes' => [
                    'Casa',
                    'Apartamento'
                ],
                'obrigatoria' => true,
                'ordem' => 2,
            ],

            [
                'pergunta' => 'O imóvel é próprio ou alugado?',
                'tipo' => 'select',
                'opcoes' => [
                    'Próprio',
                    'Alugado'
                ],
                'obrigatoria' => true,
                'ordem' => 3,
            ],

            [
                'pergunta' => 'Caso o imóvel seja alugado, o proprietário permite animais?',
                'tipo' => 'boolean',
                'opcoes' => null,
                'obrigatoria' => false,
                'ordem' => 4,
            ],

            [
                'pergunta' => 'Sua residência possui telas, muros ou proteção adequada para o animal?',
                'tipo' => 'boolean',
                'opcoes' => null,
                'obrigatoria' => true,
                'ordem' => 5,
            ],

            [
                'pergunta' => 'Você possui outros animais atualmente?',
                'tipo' => 'boolean',
                'opcoes' => null,
                'obrigatoria' => true,
                'ordem' => 6,
            ],

            [
                'pergunta' => 'Caso possua outros animais, descreva quais.',
                'tipo' => 'textarea',
                'opcoes' => null,
                'obrigatoria' => false,
                'ordem' => 7,
            ],

            [
                'pergunta' => 'Já teve outros animais anteriormente?',
                'tipo' => 'boolean',
                'opcoes' => null,
                'obrigatoria' => true,
                'ordem' => 8,
            ],

            [
                'pergunta' => 'Quanto tempo por dia o animal ficará sozinho?',
                'tipo' => 'text',
                'opcoes' => null,
                'obrigatoria' => true,
                'ordem' => 9,
            ],

            [
                'pergunta' => 'Onde o animal permanecerá durante a maior parte do tempo?',
                'tipo' => 'textarea',
                'opcoes' => null,
                'obrigatoria' => true,
                'ordem' => 10,
            ],

            [
                'pergunta' => 'Está preparado para os custos com alimentação, vacinação e atendimento veterinário?',
                'tipo' => 'boolean',
                'opcoes' => null,
                'obrigatoria' => true,
                'ordem' => 11,
            ],

            [
                'pergunta' => 'O que faria caso o animal apresentasse problemas de comportamento?',
                'tipo' => 'textarea',
                'opcoes' => null,
                'obrigatoria' => true,
                'ordem' => 12,
            ],

            [
                'pergunta' => 'Por que você deseja adotar este animal?',
                'tipo' => 'textarea',
                'opcoes' => null,
                'obrigatoria' => true,
                'ordem' => 13,
            ],

        ];

        foreach ($perguntas as $pergunta) {

            PerguntaAdocao::updateOrCreate(
                [
                    'ordem' => $pergunta['ordem']
                ],
                $pergunta
            );

        }
    }
}