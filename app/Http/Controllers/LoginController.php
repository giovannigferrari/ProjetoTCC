<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Administrador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // =====================================================
        // VALIDAÇÃO
        // =====================================================

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Informe seu e-mail.',
            'email.email' => 'Informe um e-mail válido.',
            'password.required' => 'Informe sua senha.',
        ]);


        // =====================================================
        // LOGIN DO ADMINISTRADOR
        // =====================================================

        $administrador = Administrador::where(
            'email_administrador',
            $request->email
        )->first();

        if ($administrador) {

            if (
                Hash::check(
                    $request->password,
                    $administrador->senha_administrador
                )
            ) {

                session([
                    'administrador_id' =>
                        $administrador->id_administrador,

                    'administrador_nome' =>
                        $administrador->nome_administrador,

                    'administrador_email' =>
                        $administrador->email_administrador,

                    'administrador_logado' => true,
                ]);

                return redirect()->route('admin.home');
            }
        }


        // =====================================================
        // LOGIN DO USUÁRIO
        // =====================================================

        $usuario = Usuario::where(
            'email_usuario',
            $request->email
        )->first();

        if (!$usuario) {

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'E-mail ou senha incorretos.'
                ]);
        }


        // =====================================================
        // VERIFICA SENHA DO USUÁRIO
        // =====================================================

        if (!Hash::check(
            $request->password,
            $usuario->senha_usuario
        )) {

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'E-mail ou senha incorretos.'
                ]);
        }


        // =====================================================
        // VERIFICA STATUS
        // =====================================================

        if ($usuario->status_usuario !== 'Ativo') {

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Seu usuário está inativo.'
                ]);
        }


        // =====================================================
        // CRIA SESSÃO DO USUÁRIO
        // =====================================================

        session([
            'usuario_id' =>
                $usuario->id_usuario,

            'usuario_nome' =>
                $usuario->nome_usuario,

            'usuario_email' =>
                $usuario->email_usuario,

            'usuario_tipo' =>
                $usuario->tipo_usuario,

            'usuario_logado' => true,
        ]);


        // =====================================================
        // REDIRECIONA USUÁRIO
        // =====================================================

        return redirect()->route('usuario.home');
    }


    // =========================================================
    // LOGOUT
    // =========================================================

    public function logout(Request $request)
    {
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
