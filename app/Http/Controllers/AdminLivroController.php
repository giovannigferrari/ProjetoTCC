<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Illuminate\Http\Request;

class AdminLivroController extends Controller
{
    /**
     * Lista os livros.
     */
    public function index(Request $request)
    {
        $query = Livro::query();

        // Busca por título ou autor
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('titulo_livro', 'like', "%{$search}%")
                  ->orWhere('autor_livro', 'like', "%{$search}%");
            });
        }

        // Filtro por categoria
        if ($request->filled('categoria')) {
            $query->where(
                'categoria_livro',
                $request->categoria
            );
        }

        // Filtro por status
        if ($request->filled('status')) {
            $query->where(
                'status_livro',
                $request->status
            );
        }

        // Paginação
        $livros = $query
            ->orderBy('titulo_livro')
            ->paginate(10)
            ->withQueryString();

        // Categorias existentes na própria tabela livros
        $categorias = Livro::query()
            ->whereNotNull('categoria_livro')
            ->where('categoria_livro', '!=', '')
            ->select('categoria_livro')
            ->distinct()
            ->orderBy('categoria_livro')
            ->pluck('categoria_livro');

        return view('admin.livros', compact(
            'livros',
            'categorias'
        ));
    }

    /**
     * Exibe o formulário para cadastrar livro.
     */
    public function create()
    {
        return view('admin.criar-livro');
    }
}