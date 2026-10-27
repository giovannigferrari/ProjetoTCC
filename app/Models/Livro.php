<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    protected $table = 'livros';

    protected $primaryKey = 'id_livro';

    protected $fillable = [
        'titulo_livro',
        'autor_livro',
        'capa_livro',
        'descricao_livro',
        'categoria_livro',
        'avaliacao_livro',
        'status_livro',
        'data_cadastro',
        'favorito', // <-- ADICIONADO AQUI
    ];

    protected $casts = [
        'avaliacao_livro' => 'decimal:1',
        'data_cadastro' => 'datetime',
    ];
}