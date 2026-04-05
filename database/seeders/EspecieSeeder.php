<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Especie;

class EspecieSeeder extends Seeder
{
    public function run(): void
    {
        $especies = [
            'Cão',
            'Gato',
            'Coelho',
            'Porquinho-da-Índia',
            'Hamster',
            'Chinchila',
            'Furão',
            'Ave'
        ];

        foreach ($especies as $nome) {
            Especie::firstOrCreate([
                'nome' => $nome
            ]);
        }
    }
}