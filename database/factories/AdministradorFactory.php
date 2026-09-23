<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class AdministradorFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome_administrador' => fake()->name(),
            'email_administrador' => fake()->unique()->safeEmail(),
            'senha_administrador' => Hash::make('123456'),
            'data_cadastro' => now(),
        ];
    }
}