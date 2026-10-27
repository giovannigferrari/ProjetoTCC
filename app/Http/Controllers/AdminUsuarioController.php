<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUsuarioController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $query = User::query();

        // Sorteio automático de cargo (Admin ou Usuário) se não tiver
        $usuariosSemTipo = User::whereNull('tipo_usuario')->orWhere('tipo_usuario', '')->get();
        
        foreach ($usuariosSemTipo as $user) {
            $user->tipo_usuario = (rand(0, 1) == 1) ? 'Admin' : 'Usuário';
            $user->save();
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nome_usuario', 'like', "%{$search}%")
                  ->orWhere('email_usuario', 'like', "%{$search}%")
                  ->orWhere('turma', 'like', "%{$search}%");
            });
        }

        if ($status && in_array($status, ['Ativo', 'Suspenso'])) {
            $query->where('status_usuario', $status);
        }

        $users = $query->paginate(10)->withQueryString();
        $totalUsers = User::count();

        return view('admin.usuarios', compact('users', 'search', 'status', 'totalUsers'));
    }

    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        if ($usuario->tipo_usuario === 'Admin') {
            return redirect()->route('admin.usuarios')->with('error', 'Não é permitido alterar dados de administradores por esta via.');
        }

        $request->validate([
            'nome_usuario' => 'required|string|max:255',
            'email_usuario' => 'required|email|unique:usuarios,email_usuario,' . $id . ',id_usuario',
            'turma' => 'nullable|string|max:50',
        ]);

        $usuario->nome_usuario = $request->nome_usuario;
        $usuario->email_usuario = $request->email_usuario;
        $usuario->turma = $request->turma;
        $usuario->save();

        return redirect()->route('admin.usuarios')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function suspender(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        if ($usuario->tipo_usuario === 'Admin') {
            return redirect()->route('admin.usuarios')->with('error', 'Não é possível suspender uma conta de administrador.');
        }

        $duracao = $request->input('duracao');

        $usuario->status_usuario = 'Suspenso';
        
        // Se desejar salvar a data limite de suspensão no banco, você pode descomentar a linha abaixo (caso tenha a coluna 'suspenso_ate'):
        // $usuario->suspenso_ate = ($duracao === 'permanent') ? null : now()->addDays((int) $duracao);

        $usuario->save();

        $mensagem = $duracao === 'permanent' 
            ? 'Usuário suspenso por período indeterminado!' 
            : "Usuário suspenso por {$duracao} dias com sucesso!";

        return redirect()->route('admin.usuarios')->with('success', $mensagem);
    }

    public function toggleStatus($id)
    {
        $usuario = User::findOrFail($id);
        
        if ($usuario->tipo_usuario === 'Admin') {
            return redirect()->route('admin.usuarios')->with('error', 'Não é possível alterar o status de uma conta de administrador.');
        }
        
        $usuario->status_usuario = ($usuario->status_usuario === 'Suspenso') ? 'Ativo' : 'Suspenso';
        $usuario->save();

        return redirect()->route('admin.usuarios')->with('success', 'Status do usuário alterado com sucesso!');
    }

    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        
        if ($usuario->tipo_usuario === 'Admin') {
            return redirect()->route('admin.usuarios')->with('error', 'Não é permitido eliminar contas de administradores.');
        }

        $usuario->delete();

        return redirect()->route('admin.usuarios')->with('success', 'Usuário eliminado com sucesso!');
    }
}