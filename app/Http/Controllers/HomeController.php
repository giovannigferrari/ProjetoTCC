<?php

namespace App\Http\Controllers;

use App\Models\Livro;

class HomeController extends Controller
{
    public function index()
    {
        // Traz os livros juntamente com a respetiva categoria para exibir na página inicial
        $livros = Livro::with('categoria')->get();

        // Agrupa os livros pela categoria (pode ajustar para 'categoria_id' ou o nome do campo que utiliza)
        $livrosPorCategoria = $livros->groupBy(function($livro) {
            return $livro->categoria ? $livro->categoria->nome : 'Outros';
        });

        return view('home', compact('livrosPorCategoria'));
    }
}