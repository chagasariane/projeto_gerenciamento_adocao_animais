<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('animal_fotos', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | RELACIONAMENTO
            |--------------------------------------------------------------------------
            */

            $table->foreignId('animal_id')
                  ->constrained('animais')
                  ->onDelete('cascade');

            /*
            |--------------------------------------------------------------------------
            | ARQUIVO
            |--------------------------------------------------------------------------
            */

            // Caminho relativo da imagem no storage
            $table->string('caminho');

            /*
            |--------------------------------------------------------------------------
            | FOTO PRINCIPAL
            |--------------------------------------------------------------------------
            */

            $table->boolean('principal')
                  ->default(false);

            /*
            |--------------------------------------------------------------------------
            | CONTROLE
            |--------------------------------------------------------------------------
            */

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | ÍNDICES
            |--------------------------------------------------------------------------
            */

            $table->index([
                'animal_id',
                'principal'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animal_fotos');
    }
};