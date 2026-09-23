<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'usuarios';
    protected $fillable = [
        'nome',
        'email',
        'senha',
        'tipo',
    ];
    protected $hidden = [
        'senha',
        'remember_token',
    ];
}