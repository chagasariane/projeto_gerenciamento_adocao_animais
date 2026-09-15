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
            Schema::create('conversas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('usuario_1_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('usuario_2_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->timestamps();

            $table->unique(['usuario_1_id', 'usuario_2_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversas');
    }
};
