<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $primaryKey = 'id_usuario';

    public $timestamps = false;

    protected $fillable = [
        'nome_usuario',
        'email_usuario',
        'telefone_usuario',
        'matricula_usuario',
        'senha_usuario',
        'tipo_usuario',
        'status_usuario',
        'id_adm_cadastro',
        'data_cadastro',
    ];

    protected $hidden = [
        'senha_usuario',
    ];

    public function administrador()
    {
        return $this->belongsTo(
            Administrador::class,
            'id_adm_cadastro',
            'id_administrador'
        );
    }
}