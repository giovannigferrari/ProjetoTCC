<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tcc;
use Illuminate\Support\Facades\Storage;

class UsuarioPerfil extends Controller
{
    public function index()
    {
        $userId = session('usuario_id') ?? session('usuario');

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Precisa de estar logado.');
        }

        // Buscar dados do utilizador
        $usuario = User::where('id_usuario', $userId)->first() ?? User::findOrFail($userId);

        $totalEmprestimos = class_exists(\App\Models\Emprestimo::class) 
            ? \App\Models\Emprestimo::where('usuario_id', $userId)->where('status', 'ativo')->count() 
            : 0;

        $totalFavoritos = class_exists(\App\Models\Favorito::class) 
            ? \App\Models\Favorito::where('usuario_id', $userId)->count() 
            : 0;
        
        // Obter o nome do utilizador independentemente de a coluna chamar-se 'name' ou 'nome_usuario'
        $nomeUsuario = $usuario->name ?? $usuario->nome_usuario ?? '';

        $tccsEnviados = Tcc::where('autor_tcc', 'like', "%{$nomeUsuario}%")->get();
        $totalTccs = $tccsEnviados->count();

        $ultimosFavoritos = class_exists(\App\Models\Favorito::class) 
            ? \App\Models\Favorito::where('usuario_id', $userId)->latest()->take(3)->get() 
            : collect();
            
        $ultimosTccs = $tccsEnviados->take(2);

        return view('usuario.perfil', compact('usuario', 'totalEmprestimos', 'totalFavoritos', 'totalTccs', 'ultimosFavoritos', 'ultimosTccs'));
    }

    public function update(Request $request)
    {
        $userId = session('usuario_id') ?? session('usuario');
        $usuario = User::where('id_usuario', $userId)->first() ?? User::findOrFail($userId);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'turma' => 'nullable|string|max:50',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Atribuir considerando possíveis nomes de colunas da tabela usuarios
        if (array_key_exists('name', $usuario->getAttributes()) || \Schema::hasColumn('usuarios', 'name')) {
            $usuario->name = $request->input('name');
        } elseif (\Schema::hasColumn('usuarios', 'nome_usuario')) {
            $usuario->nome_usuario = $request->input('name');
        }

        if (array_key_exists('email', $usuario->getAttributes()) || \Schema::hasColumn('usuarios', 'email')) {
            $usuario->email = $request->input('email');
        } elseif (\Schema::hasColumn('usuarios', 'email_usuario')) {
            $usuario->email_usuario = $request->input('email');
        }

        if ($request->has('turma')) {
            if (\Schema::hasColumn('usuarios', 'turma')) {
                $usuario->turma = $request->input('turma');
            } elseif (\Schema::hasColumn('usuarios', 'turma_usuario')) {
                $usuario->turma_usuario = $request->input('turma');
            }
        }

        // Upload de foto de perfil (avatar) se enviada
        if ($request->hasFile('avatar')) {
            if (!empty($usuario->avatar) && Storage::exists('public/' . $usuario->avatar)) {
                Storage::delete('public/' . $usuario->avatar);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            $usuario->avatar = $path;
        }

        $usuario->save();

        return redirect()->route('usuario.perfil')->with('success', 'Perfil atualizado com sucesso!');
    }
}