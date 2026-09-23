<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Administrador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',

            'email' => 'required|email|unique:usuarios,email_usuario',

            'senha' => 'required|min:6|confirmed',
        ], [
            'nome.required' => 'Informe seu nome.',

            'email.required' => 'Informe seu e-mail.',
            'email.email' => 'Informe um e-mail válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',

            'senha.required' => 'Informe uma senha.',
            'senha.min' => 'A senha deve ter pelo menos 6 caracteres.',
            'senha.confirmed' => 'As senhas não coincidem.',
        ]);
        $administrador = Administrador::first();
        if (!$administrador) {
            return back()
                ->withInput()
                ->withErrors([
                    'email' => 'Não existe nenhum administrador cadastrado no sistema.'
                ]);
        }
        Usuario::create([
            'nome_usuario' => $request->nome,
            'email_usuario' => $request->email,
            'senha_usuario' => Hash::make($request->senha),
            'matricula_usuario' => 'MAT' . time(),
            'tipo_usuario' => 'Aluno',
            'status_usuario' => 'Ativo',
            'id_adm_cadastro' => $administrador->id_administrador,
            'data_cadastro' => now(),
        ]);
        return redirect()
            ->route('usuario.home')
            ->with('success', 'Conta criada com sucesso! Agora faça login.');
    }
}