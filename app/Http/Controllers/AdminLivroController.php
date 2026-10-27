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

        // Se enviou arquivo manualmente
        if ($request->hasFile('capa_livro')) {
            $caminhoCapa = $request->file('capa_livro')->store('capas', 'public');
        } 
        // Se escolheu um livro da API que possui URL de capa
        elseif ($request->filled('capa_url')) {
            try {
                $imageContents = Http::get($request->capa_url)->body();
                $filename = 'capas/' . uniqid() . '.jpg';
                Storage::disk('public')->put($filename, $imageContents);
                $caminhoCapa = $filename;
            } catch (\Exception $e) {
                // Caso ocorra falha no download, segue sem capa
            }
        }

        Livro::create([
            'titulo_livro' => $request->titulo_livro,
            'autor_livro' => $request->autor_livro,
            'categoria_livro' => $request->categoria_livro,
            'descricao_livro' => $request->descricao_livro,
            'capa_livro' => $caminhoCapa,
            'avaliacao_livro' => $request->avaliacao_livro ?? 0.0,
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
        } elseif ($request->filled('capa_url') && !$livro->capa_livro) {
            try {
                $imageContents = Http::get($request->capa_url)->body();
                $filename = 'capas/' . uniqid() . '.jpg';
                Storage::disk('public')->put($filename, $imageContents);
                $livro->capa_livro = $filename;
            } catch (\Exception $e) {
                // Ignora erro de download
            }
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
        // Consulta à Open Library API enviando User-Agent recomendado
        $response = Http::withHeaders([
            'User-Agent' => 'BiblioTekSystem/1.0 (contato@bibliotek.com)'
        ])->get("https://openlibrary.org/search.json", [
            'q' => $titulo,
            'limit' => 5
        ]);

        $data = $response->json();

        if (!isset($data['docs']) || count($data['docs']) === 0) {
            return response()->json(['error' => 'Nenhum livro encontrado na Open Library.'], 404);
        }

        $livrosEncontrados = [];

        foreach ($data['docs'] as $book) {
            // Monta o link da capa oficial da Open Library se houver cover_i
            $coverUrl = isset($book['cover_i']) 
                ? "https://covers.openlibrary.org/b/id/{$book['cover_i']}-L.jpg" 
                : '';

            // Tenta obter o ano ou primeira frase como descrição
            $descricao = '';
            if (isset($book['first_sentence'])) {
                $descricao = is_array($book['first_sentence']) ? $book['first_sentence'][0] : $book['first_sentence'];
            } elseif (isset($book['first_publish_year'])) {
                $descricao = "Primeira publicação no ano de " . $book['first_publish_year'] . ".";
            }

            $livrosEncontrados[] = [
                'titulo_livro' => $book['title'] ?? '',
                'autor_livro' => isset($book['author_name']) ? implode(', ', $book['author_name']) : 'Autor Desconhecido',
                'categoria_livro' => isset($book['subject']) ? $book['subject'][0] : 'Geral',
                'descricao_livro' => $descricao,
                'avaliacao_livro' => 4.5, // Padrão indicativo (a busca básica da Open Library não possui notas de estrelas)
                'capa_url' => $coverUrl,
            ];
        }

        return response()->json($livrosEncontrados);

    } catch (\Exception $e) {
        return response()->json(['error' => 'Erro ao comunicar com a Open Library API.'], 500);
    }
}
}