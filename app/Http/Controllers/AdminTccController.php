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

        $arquivoPdf = $request
            ->file('arquivo_pdf')
            ->store('tccs', 'public');

        $capaTcc = null;

        if ($request->hasFile('capa_tcc')) {
            $capaTcc = $request
                ->file('capa_tcc')
                ->store('tccs/capas', 'public');
        }

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

            // Sua tabela usa status_tcc_
            'status_tcc_' => $request->status_tcc,
        ]);

        return redirect()
            ->route('admin.tccs')
            ->with('success', 'TCC cadastrado com sucesso!');
    }


    /*
    |--------------------------------------------------------------------------
    | APROVAR TCC
    |--------------------------------------------------------------------------
    */

    public function aprovar($id)
    {
        $tcc = Tcc::findOrFail($id);

        $tcc->status_tcc_ = 'publicado';
        $tcc->save();

        return redirect()
            ->route('admin.tccs')
            ->with('success', 'TCC aprovado com sucesso!');
    }


    /*
    |--------------------------------------------------------------------------
    | DESTACAR TCC
    |--------------------------------------------------------------------------
    */

    public function destacar($id)
    {
        $tcc = Tcc::findOrFail($id);

        /*
         * Por enquanto não alteramos o banco,
         * pois sua tabela não possui um campo
         * de destaque informado.
         */

        return redirect()
            ->route('admin.tccs')
            ->with('success', 'TCC destacado com sucesso!');
    }


    /*
    |--------------------------------------------------------------------------
    | EDITAR TCC
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $tcc = Tcc::findOrFail($id);

        return view('admin.edit-tcc', compact('tcc'));
    }


    /*
    |--------------------------------------------------------------------------
    | ATUALIZAR TCC
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $tcc = Tcc::findOrFail($id);

        $request->validate([
            'titulo_tcc' => 'required|string|max:255',
            'autor_tcc' => 'required|string|max:255',
            'orientador_tcc' => 'nullable|string|max:255',
            'curso_tcc' => 'required|string|max:255',
            'turma_tcc' => 'nullable|string|max:100',
            'ano_tcc' => 'required|integer|min:2000|max:2100',
            'resumo_tcc' => 'nullable|string',
            'palavras_chave_tcc' => 'nullable|string',
            'status_tcc_' => 'required|in:rascunho,publicado',
        ]);

        $tcc->titulo_tcc = $request->titulo_tcc;
        $tcc->autor_tcc = $request->autor_tcc;
        $tcc->orientador_tcc = $request->orientador_tcc;
        $tcc->curso_tcc = $request->curso_tcc;
        $tcc->turma_tcc = $request->turma_tcc;
        $tcc->ano_tcc = $request->ano_tcc;
        $tcc->resumo_tcc = $request->resumo_tcc;
        $tcc->palavras_chave_tcc = $request->palavras_chave_tcc;
        $tcc->status_tcc_ = $request->status_tcc_;

        $tcc->save();

        return redirect()
            ->route('admin.tccs')
            ->with('success', 'TCC atualizado com sucesso!');
    }


    /*
    |--------------------------------------------------------------------------
    | EXCLUIR TCC
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $tcc = Tcc::findOrFail($id);

        $tcc->delete();

        return redirect()
            ->route('admin.tccs')
            ->with('success', 'TCC excluído com sucesso!');
    }


    /*
    |--------------------------------------------------------------------------
    | APROVAR TCC
    |--------------------------------------------------------------------------
    */

    public function aprovar($id)
    {
        $tcc = Tcc::findOrFail($id);

        $tcc->status_tcc = 'publicado';

        $tcc->save();

        return redirect()
            ->route('admin.tccs')
            ->with('success', 'TCC aprovado com sucesso!');
    }


    /*
    |--------------------------------------------------------------------------
    | DESTACAR TCC
    |--------------------------------------------------------------------------
    */

    public function destacar($id)
    {
        $tcc = Tcc::findOrFail($id);

        $tcc->destacado = !$tcc->destacado;

        $tcc->save();

        return redirect()
            ->route('admin.tccs')
            ->with('success', 'Destaque atualizado com sucesso!');
    }


    /*
    |--------------------------------------------------------------------------
    | EDITAR TCC
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $tcc = Tcc::findOrFail($id);

        return view('admin.edit-tcc', compact('tcc'));
    }


    /*
    |--------------------------------------------------------------------------
    | ATUALIZAR TCC
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $tcc = Tcc::findOrFail($id);

        $request->validate([
            'titulo_tcc' => 'required|string|max:255',
            'autor_tcc' => 'required|string|max:255',
            'orientador_tcc' => 'nullable|string|max:255',
            'curso_tcc' => 'required|string|max:255',
            'turma_tcc' => 'nullable|string|max:100',
            'ano_tcc' => 'required|integer|min:2000|max:2100',
            'resumo_tcc' => 'nullable|string',
            'palavras_chave_tcc' => 'nullable|string',

            'arquivo_pdf' => 'nullable|file|mimes:pdf|max:51200',
            'capa_tcc' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',

            'status_tcc' => 'required|in:rascunho,publicado',
        ]);

        $tcc->titulo_tcc = $request->titulo_tcc;
        $tcc->autor_tcc = $request->autor_tcc;
        $tcc->orientador_tcc = $request->orientador_tcc;
        $tcc->curso_tcc = $request->curso_tcc;
        $tcc->turma_tcc = $request->turma_tcc;
        $tcc->ano_tcc = $request->ano_tcc;
        $tcc->resumo_tcc = $request->resumo_tcc;
        $tcc->palavras_chave_tcc = $request->palavras_chave_tcc;
        $tcc->status_tcc = $request->status_tcc;

        // Substituir PDF somente se enviar um novo
        if ($request->hasFile('arquivo_pdf')) {
            $tcc->arquivo_pdf = $request
                ->file('arquivo_pdf')
                ->store('tccs', 'public');
        }

        // Substituir capa somente se enviar uma nova
        if ($request->hasFile('capa_tcc')) {
            $tcc->capa_tcc = $request
                ->file('capa_tcc')
                ->store('tccs/capas', 'public');
        }

        $tcc->save();

        return redirect()
            ->route('admin.tccs')
            ->with('success', 'TCC atualizado com sucesso!');
    }


    /*
    |--------------------------------------------------------------------------
    | EXCLUIR TCC
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $tcc = Tcc::findOrFail($id);

        $tcc->delete();

        return redirect()
            ->route('admin.tccs')
            ->with('success', 'TCC excluído com sucesso!');
    }
}