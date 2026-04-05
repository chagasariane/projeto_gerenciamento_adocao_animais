<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Raca;
use App\Models\Especie;

class RacaSeeder extends Seeder
{
    public function run(): void
    {
        $dados = [
            'Cão' => [
                'Labrador',
                'Poodle',
                'Bulldog',
                'Pastor Alemão',
                'Vira-lata'
            ],
            'Gato' => [
                'Siamês',
                'Persa',
                'Maine Coon',
                'Sphynx',
                'Vira-lata'
            ],
            'Coelho' => [
                'Mini Lop',
                'Lionhead',
                'Angorá'
            ],
            'Porquinho-da-Índia' => [
                'Abissínio',
                'Peruano',
                'Inglês'
            ],
            'Hamster' => [
                'Sírio',
                'Anão Russo',
                'Roborovski'
            ],
            'Chinchila' => [
                'Chinchila Padrão'
            ],
            'Furão' => [
                'Furão Doméstico'
            ],
            'Ave' => [
                'Calopsita',
                'Periquito',
                'Canário'
            ]
        ];

        foreach ($dados as $nomeEspecie => $racas) {

            $especie = Especie::where('nome', $nomeEspecie)->first();

            if (!$especie) continue;

            foreach ($racas as $nomeRaca) {
                Raca::firstOrCreate([
                    'nome' => $nomeRaca,
                    'especie_id' => $especie->id
                ]);
            }
        }
    }
}