<?php

namespace App\Http\Controllers;

class UsuarioFavoritos extends Controller
{
    public function index()
    {
        return view('usuario.favoritos');
    }
}