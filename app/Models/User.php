<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    protected $fillable = [
        'nome_usuario',
        'email_usuario',
        'telefone_usuario',
        'matricula_usuario',
        'turma',
        'senha_usuario',
        'tipo_usuario',
        'status_usuario',
        'id_adm_cadastro',
        'data_cadastro',
    ];

    protected $hidden = [
        'senha_usuario',
        'remember_token',
    ];
    // Diz ao Laravel qual coluna armazena a senha
    public function getAuthPassword()
    {
        return $this->senha_usuario;
    }
}