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
        Schema::create('animais', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | RELACIONAMENTOS
            |--------------------------------------------------------------------------
            */

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->foreignId('especie_id')
                  ->constrained('especies')
                  ->onDelete('restrict');

            /*
            |--------------------------------------------------------------------------
            | Toda raça é obrigatória.
            | Animais sem raça definida deverão utilizar
            | registros como:
            | - SRD
            | - Vira-Lata
            |--------------------------------------------------------------------------
            */

            $table->foreignId('raca_id')
                  ->constrained('racas')
                  ->onDelete('restrict');

            /*
            |--------------------------------------------------------------------------
            | DADOS PRINCIPAIS
            |--------------------------------------------------------------------------
            */

            $table->string('nome');

            $table->text('descricao');

            $table->date('data_nascimento')
                  ->nullable();

            /*
            |--------------------------------------------------------------------------
            | ENUMS
            |--------------------------------------------------------------------------
            */

            $table->enum('sexo', [
                'MACHO',
                'FEMEA',
                'NAO_IDENTIFICADO'
            ]);

            $table->enum('porte', [
                'PEQUENO',
                'MEDIO',
                'GRANDE'
            ]);

            $table->enum('status', [
                'DISPONIVEL',
                'ADOTADO',
                'INATIVO'
            ])->default('DISPONIVEL');

            /*
            |--------------------------------------------------------------------------
            | LOCALIZAÇÃO
            |--------------------------------------------------------------------------
            */

            $table->string('cidade')
                  ->index();

            $table->string('estado', 2)
                  ->index();

            /*
            |--------------------------------------------------------------------------
            | SAÚDE
            |--------------------------------------------------------------------------
            */

            $table->boolean('castrado')
                  ->default(false);

            $table->boolean('vacinado')
                  ->default(false);

            /*
            |--------------------------------------------------------------------------
            | NECESSIDADES ESPECIAIS
            |--------------------------------------------------------------------------
            */

            $table->text('necessidades_especiais')
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
            | ÍNDICES
            |--------------------------------------------------------------------------
            */

            $table->index('status');

            $table->index('especie_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animais');
    }
};