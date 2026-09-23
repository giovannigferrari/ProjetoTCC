<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    use HasFactory;

    protected $table = 'administrador';

    protected $primaryKey = 'id_administrador';

    public $timestamps = false;

    protected $fillable = [
        'nome_administrador',
        'email_administrador',
        'senha_administrador',
        'data_cadastro',
    ];

    protected $hidden = [
        'senha_administrador',
    ];

    public function usuarios()
    {
        return $this->hasMany(
            Usuario::class,
            'id_adm_cadastro',
            'id_administrador'
        );
    }
}
