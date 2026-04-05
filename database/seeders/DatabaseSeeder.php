<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\EspecieSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            EspecieSeeder::class,
            RacaSeeder::class,
        ]);
    }
}