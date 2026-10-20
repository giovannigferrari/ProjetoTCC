<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class AdminLivroController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $query = Livro::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('titulo_livro', 'like', "%{$search}%")
                  ->orWhere('autor_livro', 'like', "%{$search}%")
                  ->orWhere('categoria_livro', 'like', "%{$search}%");
            });
        }

        if ($status && in_array($status, ['Disponível', 'Emprestado'])) {
            $query->where('status_livro', $status);
        }

        $livros = $query->paginate(10)->withQueryString();
        $totalLivros = Livro::count();

        return view('admin.livros', compact('livros', 'search', 'status', 'totalLivros'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo_livro' => 'required|string|max:255',
            'autor_livro' => 'required|string|max:255',
            'categoria_livro' => 'required|string|max:100',
            'descricao_livro' => 'nullable|string',
            'capa_livro' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'avaliacao_livro' => 'nullable|numeric|min:0|max:5',
        ]);

        $caminhoCapa = null;
        if ($request->hasFile('capa_livro')) {
            $caminhoCapa = $request->file('capa_livro')->store('capas', 'public');
        }

        $avaliacao = $request->avaliacao_livro;
        if (!$avaliacao) {
            try {
                $response = Http::get("https://www.googleapis.com/books/v1/volumes?q=" . urlencode($request->titulo_livro));
                $data = $response->json();
                $avaliacao = $data['items'][0]['volumeInfo']['averageRating'] ?? 0.0;
            } catch (\Exception $e) {
                $avaliacao = 0.0;
            }
        }

        Livro::create([
            'titulo_livro' => $request->titulo_livro,
            'autor_livro' => $request->autor_livro,
            'categoria_livro' => $request->categoria_livro,
            'descricao_livro' => $request->descricao_livro,
            'capa_livro' => $caminhoCapa,
            'avaliacao_livro' => $avaliacao,
            'status_livro' => 'Disponível',
            'data_cadastro' => now(),
        ]);

        return redirect()->route('admin.livros')->with('success', 'Livro cadastrado com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $livro = Livro::findOrFail($id);

        $request->validate([
            'titulo_livro' => 'required|string|max:255',
            'autor_livro' => 'required|string|max:255',
            'categoria_livro' => 'required|string|max:100',
            'descricao_livro' => 'nullable|string',
            'capa_livro' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'avaliacao_livro' => 'nullable|numeric|min:0|max:5',
        ]);

        if ($request->hasFile('capa_livro')) {
            if ($livro->capa_livro && Storage::disk('public')->exists($livro->capa_livro)) {
                Storage::disk('public')->delete($livro->capa_livro);
            }
            $livro->capa_livro = $request->file('capa_livro')->store('capas', 'public');
        }

        $livro->titulo_livro = $request->titulo_livro;
        $livro->autor_livro = $request->autor_livro;
        $livro->categoria_livro = $request->categoria_livro;
        $livro->descricao_livro = $request->descricao_livro;
        $livro->avaliacao_livro = $request->avaliacao_livro ?? $livro->avaliacao_livro;
        $livro->save();

        return redirect()->route('admin.livros')->with('success', 'Livro atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $livro = Livro::findOrFail($id);
        
        if ($livro->capa_livro && Storage::disk('public')->exists($livro->capa_livro)) {
            Storage::disk('public')->delete($livro->capa_livro);
        }

        $livro->delete();

        return redirect()->route('admin.livros')->with('success', 'Livro eliminado com sucesso!');
    }

    public function buscarApi(Request $request)
    {
        $titulo = $request->input('titulo');

        if (!$titulo) {
            return response()->json(['error' => 'Informe o título do livro.'], 400);
        }

        try {
            $response = Http::get("https://www.googleapis.com/books/v1/volumes?q=" . urlencode($titulo));
            $data = $response->json();

            if (!isset($data['items']) || count($data['items']) === 0) {
                return response()->json(['error' => 'Nenhum livro encontrado com esse nome.'], 404);
            }

            $info = $data['items'][0]['volumeInfo'];

            return response()->json([
                'titulo_livro' => $info['title'] ?? '',
                'autor_livro' => isset($info['authors']) ? implode(', ', $info['authors']) : 'Desconhecido',
                'categoria_livro' => isset($info['categories']) ? $info['categories'][0] : 'Geral',
                'descricao_livro' => $info['description'] ?? '',
                'avaliacao_livro' => $info['averageRating'] ?? 0.0,
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao comunicar com a API externa.'], 500);
        }
    }
}