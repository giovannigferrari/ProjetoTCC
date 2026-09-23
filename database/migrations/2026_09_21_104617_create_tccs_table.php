<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tccs', function (Blueprint $table) {

            $table->id('id_tcc');

            // Informações do TCC
            $table->string('titulo_tcc');
            $table->string('autor_tcc');
            $table->string('orientador_tcc')->nullable();

            $table->string('curso_tcc');
            $table->string('turma_tcc')->nullable();

            $table->year('ano_tcc');

            $table->text('resumo_tcc')->nullable();

            $table->text('palavras_chave_tcc')->nullable();

            // Arquivos
            $table->string('arquivo_pdf');
            $table->string('capa_tcc')->nullable();

            // Status
            $table->enum('status_tcc', [
                'rascunho',
                'publicado'
            ])->default('rascunho');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tccs');
    }
};