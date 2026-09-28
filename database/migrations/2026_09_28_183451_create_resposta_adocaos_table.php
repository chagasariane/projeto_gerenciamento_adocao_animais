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
        Schema::create('respostas_adocao', function (Blueprint $table) {
            $table->id();

            $table->foreignId('adocao_id')
                ->constrained('adocoes')
                ->cascadeOnDelete();

            $table->foreignId('pergunta_id')
                ->constrained('perguntas_adocao');

            $table->text('pergunta');

            $table->text('resposta')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resposta_adocaos');
    }
};
