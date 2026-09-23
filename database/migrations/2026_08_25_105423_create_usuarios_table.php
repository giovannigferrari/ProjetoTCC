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

            $table->string('matricula_usuario')->unique();

            $table->string('senha_usuario');

            $table->string('tipo_usuario');

            $table->string('status_usuario');

            $table->unsignedBigInteger('id_adm_cadastro');

            $table->dateTime('data_cadastro')->nullable();

            $table->foreign('id_adm_cadastro')
                ->references('id_administrador')
                ->on('administrador');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};