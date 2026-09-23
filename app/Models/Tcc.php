<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tcc extends Model
{
    use HasFactory;
    protected $table = 'tccs';
    protected $primaryKey = 'id_tcc';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'titulo_tcc',
        'autor_tcc',
        'orientador_tcc',
        'curso_tcc',
        'turma_tcc',
        'ano_tcc',
        'resumo_tcc',
        'palavras_chave_tcc',
        'arquivo_pdf',
        'capa_tcc',
        'status_tcc',
    ];
}