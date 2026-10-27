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
        Schema::create('favoritos', function (Blueprint $table) {
            $table->id();
            
            // Ajustado para a tabela 'usuarios' com chave 'id_usuario' (caso seja esse o seu padrão)
            $table->foreignId('user_id')->constrained('usuarios', 'id_usuario')->onDelete('cascade');
            
            // Ajustado para apontar para a coluna real da sua tabela de livros (substitua 'id_livro' se o nome na sua tabela for diferente)
            $table->foreignId('livro_id')->constrained('livros', 'id_livro')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favoritos');
    }
};