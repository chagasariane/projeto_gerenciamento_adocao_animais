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
        Schema::create('adocoes', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | RELACIONAMENTOS
            |--------------------------------------------------------------------------
            */

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('restrict');

            $table->foreignId('animal_id')
                  ->constrained('animais')
                  ->onDelete('restrict');

            /*
            |--------------------------------------------------------------------------
            | PROCESSO DE ADOÇÃO
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [
                'PENDENTE',
                'APROVADA',
                'RECUSADA',
                'CANCELADA'
            ])->default('PENDENTE');

            $table->text('mensagem')
                  ->nullable();

            $table->timestamp('data_aprovacao')
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

            $table->index('user_id');

            $table->index('animal_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adocoes');
    }
};