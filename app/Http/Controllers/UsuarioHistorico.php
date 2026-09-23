<?php

namespace App\Http\Controllers;

class UsuarioHistorico extends Controller
{
    public function index()
    {
        return view('usuario.historico');
    }
}