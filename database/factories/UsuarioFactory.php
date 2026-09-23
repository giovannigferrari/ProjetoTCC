<?php

namespace Database\Factories;

use App\Models\Administrador;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UsuarioFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome_usuario' => fake()->name(),

            'email_usuario' => fake()->unique()->safeEmail(),

            'telefone_usuario' => fake()->numerify('(##) #####-####'),

            'matricula_usuario' => fake()->unique()->numerify('########'),

            'senha_usuario' => Hash::make('123456'),

            'tipo_usuario' => 'Aluno',

            'status_usuario' => 'Ativo',

            'id_adm_cadastro' => Administrador::inRandomOrder()
                ->value('id_administrador'),

            'data_cadastro' => now(),
        ];
    }
}