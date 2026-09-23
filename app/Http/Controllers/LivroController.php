<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    /**
     * Lista todos os livros.
     */
    public function index()
    {
        $livros = Livro::orderBy('titulo_livro')->get();

        return view('admin.livros', compact('livros'));
    }

    /**
     * Mostra formulário de cadastro.
     */
    public function create()
    {
        return view('livros.create');
    }

    /**
     * Salva um novo livro.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo_livro' => 'required|string|max:255',
            'autor_livro' => 'required|string|max:255',
            'capa_livro' => 'nullable|string|max:255',
            'descricao_livro' => 'nullable|string',
            'categoria_livro' => 'required|string|max:255',
            'avaliacao_livro' => 'nullable|numeric|min:0|max:5',
            'status_livro' => 'required|in:Disponível,Reservado,Emprestado',
        ]);

        Livro::create([
            'titulo_livro' => $request->titulo_livro,
            'autor_livro' => $request->autor_livro,
            'capa_livro' => $request->capa_livro,
            'descricao_livro' => $request->descricao_livro,
            'categoria_livro' => $request->categoria_livro,
            'avaliacao_livro' => $request->avaliacao_livro ?? 0,
            'status_livro' => $request->status_livro,
            'data_cadastro' => now(),
        ]);

        return redirect()
            ->route('livros.index')
            ->with('success', 'Livro cadastrado com sucesso!');
    }

    /**
     * Mostra um livro específico.
     */
    public function show($id)
    {
        $livro = Livro::findOrFail($id);

        return view('livros.show', compact('livro'));
    }

    /**
     * Mostra formulário de edição.
     */
    public function edit($id)
    {
        $livro = Livro::findOrFail($id);

        return view('livros.edit', compact('livro'));
    }

    /**
     * Atualiza um livro.
     */
    public function update(Request $request, $id)
    {
        $livro = Livro::findOrFail($id);

        $request->validate([
            'titulo_livro' => 'required|string|max:255',
            'autor_livro' => 'required|string|max:255',
            'capa_livro' => 'nullable|string|max:255',
            'descricao_livro' => 'nullable|string',
            'categoria_livro' => 'required|string|max:255',
            'avaliacao_livro' => 'nullable|numeric|min:0|max:5',
            'status_livro' => 'required|in:Disponível,Reservado,Emprestado',
        ]);

        $livro->update([
            'titulo_livro' => $request->titulo_livro,
            'autor_livro' => $request->autor_livro,
            'capa_livro' => $request->capa_livro,
            'descricao_livro' => $request->descricao_livro,
            'categoria_livro' => $request->categoria_livro,
            'avaliacao_livro' => $request->avaliacao_livro ?? 0,
            'status_livro' => $request->status_livro,
        ]);

        return redirect()
            ->route('livros.index')
            ->with('success', 'Livro atualizado com sucesso!');
    }

    /**
     * Exclui um livro.
     */
    public function destroy($id)
    {
        $livro = Livro::findOrFail($id);

        $livro->delete();

        return redirect()
            ->route('livros.index')
            ->with('success', 'Livro excluído com sucesso!');
    }
}