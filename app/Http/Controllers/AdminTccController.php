<?php

namespace App\Http\Controllers;

use App\Models\Tcc;
use Illuminate\Http\Request;

class AdminTccController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | GERENCIAR TCCS
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $tccs = Tcc::orderBy('created_at', 'desc')->get();

        return view('admin.tccs', compact('tccs'));
    }


    /*
    |--------------------------------------------------------------------------
    | PÁGINA DE UPLOAD
    |--------------------------------------------------------------------------
    */

    public function upload()
    {
        return view('admin.upload-tcc');
    }


    /*
    |--------------------------------------------------------------------------
    | SALVAR TCC
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        // Validação
        $request->validate([

            'titulo_tcc' => 'required|string|max:255',

            'autor_tcc' => 'required|string|max:255',

            'orientador_tcc' => 'nullable|string|max:255',

            'curso_tcc' => 'required|string|max:255',

            'turma_tcc' => 'nullable|string|max:100',

            'ano_tcc' => 'required|integer|min:2000|max:2100',

            'resumo_tcc' => 'nullable|string',

            'palavras_chave_tcc' => 'nullable|string',

            'arquivo_pdf' => 'required|file|mimes:pdf|max:51200',

            'capa_tcc' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',

            'status_tcc' => 'required|in:rascunho,publicado',

        ]);


        // Upload do PDF
        $arquivoPdf = $request
            ->file('arquivo_pdf')
            ->store('tccs', 'public');


        // Upload da capa
        $capaTcc = null;

        if ($request->hasFile('capa_tcc')) {

            $capaTcc = $request
                ->file('capa_tcc')
                ->store('tccs/capas', 'public');
        }


        // Salvar informações no banco
        Tcc::create([

            'titulo_tcc' => $request->titulo_tcc,

            'autor_tcc' => $request->autor_tcc,

            'orientador_tcc' => $request->orientador_tcc,

            'curso_tcc' => $request->curso_tcc,

            'turma_tcc' => $request->turma_tcc,

            'ano_tcc' => $request->ano_tcc,

            'resumo_tcc' => $request->resumo_tcc,

            'palavras_chave_tcc' => $request->palavras_chave_tcc,

            'arquivo_pdf' => $arquivoPdf,

            'capa_tcc' => $capaTcc,

            'status_tcc' => $request->status_tcc,

        ]);


        // Voltar para Gerenciar TCCs
        return redirect()
            ->route('admin.tccs')
            ->with('success', 'TCC cadastrado com sucesso!');
    }
}