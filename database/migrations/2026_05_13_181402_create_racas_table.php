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
        Schema::create('racas', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | RELACIONAMENTO
            |--------------------------------------------------------------------------
            */

            $table->foreignId('especie_id')
                  ->constrained('especies')
                  ->onDelete('restrict');

            /*
            |--------------------------------------------------------------------------
            | DADOS
            |--------------------------------------------------------------------------
            */

            $table->string('nome');

            $table->text('descricao')
                  ->nullable();

            /*
            |--------------------------------------------------------------------------
            | CONTROLE
            |--------------------------------------------------------------------------
            */

            $table->timestamps();

            $table->softDeletes();

            /*
            |--------------------------------------------------------------------------
            | RESTRIÇÃO DE DUPLICIDADE
            |--------------------------------------------------------------------------
            */

            $table->unique([
                'especie_id',
                'nome'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('racas');
    }
};