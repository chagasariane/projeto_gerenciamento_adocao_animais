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
        Schema::create('perguntas_adocao', function (Blueprint $table) {
            $table->id();

            $table->text('pergunta');

            $table->string('tipo')->default('text');

            $table->json('opcoes')->nullable();

            $table->boolean('obrigatoria')->default(true);
            $table->integer('ordem')->default(0);
            $table->boolean('ativo')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pergunta_adocaos');
    }
};
