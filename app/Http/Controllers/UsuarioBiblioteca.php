<?php

namespace App\Http\Controllers;

class UsuarioBiblioteca extends Controller
{
    public function index()
    {
        return view('usuario.biblioteca');
    }
}