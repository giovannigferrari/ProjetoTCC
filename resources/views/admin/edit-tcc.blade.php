<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar TCC - BIBLIO-TEK</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">

<div class="container py-5">

    {{-- CABEÇALHO --}}
    <div class="mb-4">

        <a href="{{ route('admin.tccs') }}"
           class="text-decoration-none text-secondary">

            <i class="bi bi-arrow-left"></i>
            Voltar para Gerenciar TCCs

        </a>

        <h2 class="fw-bold mt-3 mb-1" style="color: #02003a;">
            Editar TCC
        </h2>

        <p class="text-secondary mb-0">
            Atualize as informações do trabalho de conclusão de curso.
        </p>

    </div>


    {{-- ERROS --}}
    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>Verifique os seguintes erros:</strong>

            <ul class="mb-0 mt-2">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- FORMULÁRIO --}}
    <form action="{{ route('admin.tccs.update', $tcc->id_tcc) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        @method('PUT')


        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                {{-- TÍTULO --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Título do TCC
                    </label>

                    <input
                        type="text"
                        name="titulo_tcc"
                        class="form-control"
                        value="{{ old('titulo_tcc', $tcc->titulo_tcc) }}"
                        required
                    >

                </div>


                {{-- AUTOR --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Autor
                    </label>

                    <input
                        type="text"
                        name="autor_tcc"
                        class="form-control"
                        value="{{ old('autor_tcc', $tcc->autor_tcc) }}"
                        required
                    >

                </div>


                {{-- ORIENTADOR --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Orientador
                    </label>

                    <input
                        type="text"
                        name="orientador_tcc"
                        class="form-control"
                        value="{{ old('orientador_tcc', $tcc->orientador_tcc) }}"
                    >

                </div>


                {{-- CURSO / TURMA / ANO --}}
                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-semibold">
                            Curso
                        </label>

                        <input
                            type="text"
                            name="curso_tcc"
                            class="form-control"
                            value="{{ old('curso_tcc', $tcc->curso_tcc) }}"
                            required
                        >

                    </div>


                    <div class="col-md-3 mb-3">

                        <label class="form-label fw-semibold">
                            Turma
                        </label>

                        <input
                            type="text"
                            name="turma_tcc"
                            class="form-control"
                            value="{{ old('turma_tcc', $tcc->turma_tcc) }}"
                        >

                    </div>


                    <div class="col-md-3 mb-3">

                        <label class="form-label fw-semibold">
                            Ano
                        </label>

                        <input
                            type="number"
                            name="ano_tcc"
                            class="form-control"
                            value="{{ old('ano_tcc', $tcc->ano_tcc) }}"
                            min="2000"
                            max="2100"
                            required
                        >

                    </div>

                </div>


                {{-- RESUMO --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Resumo
                    </label>

                    <textarea
                        name="resumo_tcc"
                        class="form-control"
                        rows="6"
                    >{{ old('resumo_tcc', $tcc->resumo_tcc) }}</textarea>

                </div>


                {{-- PALAVRAS-CHAVE --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Palavras-chave
                    </label>

                    <input
                        type="text"
                        name="palavras_chave_tcc"
                        class="form-control"
                        value="{{ old('palavras_chave_tcc', $tcc->palavras_chave_tcc) }}"
                    >

                </div>


                {{-- STATUS --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Status
                    </label>

                    <select
                        name="status_tcc"
                        class="form-select"
                        required
                    >

                        <option value="rascunho"
                            {{ old('status_tcc', $tcc->status_tcc_) == 'rascunho' ? 'selected' : '' }}>
                            Rascunho
                        </option>

                        <option value="publicado"
                            {{ old('status_tcc', $tcc->status_tcc_) == 'publicado' ? 'selected' : '' }}>
                            Publicado
                        </option>

                    </select>

                </div>


                {{-- PDF ATUAL --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Arquivo PDF
                    </label>

                    @if($tcc->arquivo_pdf)

                        <div class="mb-2">

                            <a
                                href="{{ asset('storage/' . $tcc->arquivo_pdf) }}"
                                target="_blank"
                                class="btn btn-sm btn-outline-primary"
                            >

                                <i class="bi bi-file-earmark-pdf"></i>

                                Ver PDF atual

                            </a>

                        </div>

                    @endif

                    <input
                        type="file"
                        name="arquivo_pdf"
                        class="form-control"
                        accept=".pdf"
                    >

                    <div class="form-text">
                        Se não selecionar um novo arquivo, o PDF atual será mantido.
                    </div>

                </div>


                {{-- CAPA ATUAL --}}
                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Capa do TCC
                    </label>

                    @if($tcc->capa_tcc)

                        <div class="mb-3">

                            <img
                                src="{{ asset('storage/' . $tcc->capa_tcc) }}"
                                alt="Capa do TCC"
                                class="img-thumbnail"
                                style="max-width: 180px; max-height: 220px;"
                            >

                        </div>

                    @endif

                    <input
                        type="file"
                        name="capa_tcc"
                        class="form-control"
                        accept="image/jpeg,image/png,image/webp"
                    >

                    <div class="form-text">
                        Se não selecionar uma nova capa, a atual será mantida.
                    </div>

                </div>


                {{-- BOTÕES --}}
                <div class="d-flex gap-2">

                    <a
                        href="{{ route('admin.tccs') }}"
                        class="btn btn-secondary"
                    >

                        <i class="bi bi-arrow-left"></i>

                        Cancelar

                    </a>


                    <button
                        type="submit"
                        class="btn text-white"
                        style="background-color: #02003a;"
                    >

                        <i class="bi bi-save"></i>

                        Salvar alterações

                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

</body>

</html>