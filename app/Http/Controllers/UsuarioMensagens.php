<?php

namespace App\Http\Controllers;

class UsuarioMensagens extends Controller
{
    public function index()
    {
        return view('usuario.mensagens');
    }
}