<?php

namespace App\Http\Controllers;

use App\Models\Livro;

class UsuarioController extends Controller
{
    public function index()
    {
        $livros = Livro::orderBy('titulo_livro')->get();

        $livrosPorCategoria = $livros->groupBy('categoria_livro');

        return view('usuario.home', compact('livrosPorCategoria'));
    }
}