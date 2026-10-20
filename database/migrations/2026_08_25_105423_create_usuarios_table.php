<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('nome_usuario');
            $table->string('email_usuario')->unique();
            $table->string('telefone_usuario')->nullable();
            $table->string('matricula_usuario');
            $table->string('turma')->nullable(); // Adicionado para suportar a turma na tela
            $table->string('senha_usuario');
            $table->string('tipo_usuario'); // Ex: Aluno, Admin
            $table->string('status_usuario')->default('Ativo'); // Ativo ou Suspenso
            $table->unsignedBigInteger('id_adm_cadastro')->nullable();
            $table->dateTime('data_cadastro')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};