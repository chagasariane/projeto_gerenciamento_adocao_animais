<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['ADMIN', 'ADOTANTE', 'PROTETOR'])
                  ->default('ADOTANTE')
                  ->after('password');

            $table->string('cpf')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('telefone')->nullable();
            $table->string('celular')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role',
                'cpf',
                'cnpj',
                'telefone',
                'celular'
            ]);
        });
    }
};