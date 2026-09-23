<?php

namespace App\Http\Controllers;

use App\Models\Livro;

class HomeController extends Controller
{
    public function index()
    {
        $livros = Livro::all();

        $livrosPorCategoria = $livros->groupBy('categoria_livro');

        return view('home', compact('livrosPorCategoria'));
    }
}