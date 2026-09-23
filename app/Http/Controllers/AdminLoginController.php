<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Administrador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Informe seu e-mail.',
            'email.email' => 'Informe um e-mail válido.',
            'password.required' => 'Informe sua senha.',
        ]);

        // =====================================================
        // TENTA LOGIN COMO ADMINISTRADOR
        // =====================================================

        $administrador = Administrador::where(
            'email_administrador',
            $request->email
        )->first();

        if ($administrador) {

            if (Hash::check(
                $request->password,
                $administrador->senha_administrador
            )) {

                session([
                    'admin_id' => $administrador->id_administrador,
                    'admin_nome' => $administrador->nome_administrador,
                    'admin_email' => $administrador->email_administrador,
                    'admin_logado' => true,
                ]);

                return redirect()->route('admin.home');
            }
        }

        // =====================================================
        // TENTA LOGIN COMO USUÁRIO COMUM
        // =====================================================

        $usuario = Usuario::where(
            'email_usuario',
            $request->email
        )->first();

        if ($usuario) {

            if (Hash::check(
                $request->password,
                $usuario->senha_usuario
            )) {

                if ($usuario->status_usuario !== 'Ativo') {

                    return back()
                        ->withInput($request->only('email'))
                        ->withErrors([
                            'email' => 'Seu usuário está inativo.'
                        ]);
                }

                session([
                    'usuario_id' => $usuario->id_usuario,
                    'usuario_nome' => $usuario->nome_usuario,
                    'usuario_email' => $usuario->email_usuario,
                    'usuario_tipo' => $usuario->tipo_usuario,
                    'usuario_logado' => true,
                ]);

                return redirect()->route('usuario.home');
            }
        }

        // =====================================================
        // LOGIN INVÁLIDO
        // =====================================================

        return back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => 'E-mail ou senha incorretos.'
            ]);
    }

    // =========================================================
    // LOGOUT
    // =========================================================

    public function logout(Request $request)
    {
        $request->session()->forget([
            'usuario_id',
            'usuario_nome',
            'usuario_email',
            'usuario_tipo',
            'usuario_logado',

            'admin_id',
            'admin_nome',
            'admin_email',
            'admin_logado',
        ]);

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}