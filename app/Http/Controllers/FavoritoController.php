<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Livro;

class FavoritoController extends Controller
{
    public function index(Request $request)
    {
        // Valida se o utilizador está logado através da sessão do projeto
        $userId = session('usuario_id') ?? session('usuario');

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Precisa de estar logado.');
        }

        // Busca apenas os livros onde o campo favorito está ativo (1)
        $query = Livro::where('favorito', 1);

        // Filtro de busca por texto (título ou autor)
        if ($request->filled('busca')) {
            $termo = $request->input('busca');
            $query->where(function($q) use ($termo) {
                $q->where('titulo_livro', 'like', "%{$termo}%")
                  ->orWhere('autor_livro', 'like', "%{$termo}%");
            });
        }

        // Filtro por género / categoria utilizando o campo string 'categoria_livro'
        if ($request->filled('categoria') && $request->input('categoria') != 'todos') {
            $query->where('categoria_livro', $request->input('categoria'));
        }

        $favoritos = $query->get();
        
        try {
            $categorias = Categoria::all();
        } catch (\Exception $e) {
            $categorias = collect();
        }

        return view('usuario.favoritos', compact('favoritos', 'categorias'));
    }

    public function toggle($id)
    {
        $userId = session('usuario_id') ?? session('usuario');

        if (!$userId) {
            return redirect()->route('login');
        }

        // Encontra o livro (usando a chave primária id_livro configurada no Model) 
        // e inverte o valor do campo favorito (0 passa a 1, 1 passa a 0)
        $livro = Livro::findOrFail($id);
        $livro->favorito = !$livro->favorito;
        $livro->save();

        return back();
    }
}