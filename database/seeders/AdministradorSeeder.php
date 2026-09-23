<?php

namespace Database\Seeders;

use App\Models\Administrador;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdministradorSeeder extends Seeder
{
    public function run(): void
    {
        Administrador::firstOrCreate(
            [
                'email_administrador' => 'admin@bibliotek.com',
            ],
            [
                'nome_administrador' => 'Administrador',
                'senha_administrador' => Hash::make('123456'),
                'data_cadastro' => now(),
            ]
        );
    }
}