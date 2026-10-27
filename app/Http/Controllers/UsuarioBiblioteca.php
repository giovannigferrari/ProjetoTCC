<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tcc;

class UsuarioBiblioteca extends Controller
{
    public function index(Request $request)
    {
        $userId = session('usuario_id') ?? session('usuario');

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Precisa de estar logado.');
        }

        $query = Tcc::query();

        // Filtro de busca textual por tipo (Título, Autor, Orientador, Turma)
        if ($request->filled('busca')) {
            $termo = $request->input('busca');
            $tipoBusca = $request->input('tipo_busca', 'titulo');

            if ($tipoBusca === 'autor') {
                $query->where('autor_tcc', 'like', "%{$termo}%");
            } elseif ($tipoBusca === 'orientador') {
                $query->where('orientador_tcc', 'like', "%{$termo}%");
            } elseif ($tipoBusca === 'turma') {
                $query->where('turma_tcc', 'like', "%{$termo}%");
            } else {
                $query->where('titulo_tcc', 'like', "%{$termo}%");
            }
        }

        // Filtro por Curso
        if ($request->filled('curso') && $request->input('curso') != 'todos') {
            $query->where('curso_tcc', $request->input('curso'));
        }

        // Filtro por Ano
        if ($request->filled('ano') && $request->input('ano') != 'todos') {
            $query->where('ano_tcc', $request->input('ano'));
        }

        // Filtro por Turma (Select secundário)
        if ($request->filled('turma_filtro') && $request->input('turma_filtro') != 'todos') {
            $query->where('turma_tcc', $request->input('turma_filtro'));
        }

        // Substituído temporariamente para evitar o erro de coluna inexistente
        $destaques = Tcc::latest()->take(3)->get();
        $tccs = $query->get();

        // Dados para preencher os selects dinamicamente
        $cursos = Tcc::select('curso_tcc')->distinct()->pluck('curso_tcc');
        $anos = Tcc::select('ano_tcc')->distinct()->orderBy('ano_tcc', 'desc')->pluck('ano_tcc');
        $turmas = Tcc::select('turma_tcc')->distinct()->pluck('turma_tcc');

        return view('usuario.tccs', compact('destaques', 'tccs', 'cursos', 'anos', 'turmas'));
    }

    public function download($id)
    {
        $tcc = Tcc::findOrFail($id);
        $caminhoArquivo = storage_path('app/public/' . $tcc->arquivo_pdf);

        if (!file_exists($caminhoArquivo)) {
            return back()->with('error', 'Arquivo PDF não encontrado.');
        }

        return response()->download($caminhoArquivo);
    }
}