<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('livros', function (Blueprint $table) {

            $table->id('id_livro');

            $table->string('titulo_livro');

            $table->string('autor_livro');

            $table->string('capa_livro')->nullable();

            $table->text('descricao_livro')->nullable();

            $table->string('categoria_livro');

            $table->decimal('avaliacao_livro', 2, 1)->default(0);

            $table->enum('status_livro', [
                'Disponível',
                'Reservado',
                'Emprestado'
            ])->default('Disponível');

            $table->dateTime('data_cadastro')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('livros');
    }
};