<!DOCTYPE html>
<html lang="pt-BR" class="h-full bg-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BIBLIO-TEK - Upload de TCC</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            dark: '#090D28',
                            orange: '#ea580c',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="h-full font-sans antialiased text-slate-800 bg-slate-100">

<div class="min-h-screen flex flex-col lg:flex-row">

    {{-- SIDEBAR TAILWIND --}}
    @include('admin.sidebar')

    {{-- CONTEÚDO PRINCIPAL --}}
    <main class="flex-1 min-w-0 flex flex-col p-4 sm:p-6 lg:p-8 overflow-y-auto">


        {{-- HEADER --}}
        <header class="flex items-center justify-between mb-8 max-w-4xl mx-auto w-full">

            <div class="flex items-center gap-2.5">

                <span
                    class="w-1 h-4 bg-orange-600 rounded-full inline-block"
                ></span>

                <span
                    class="text-sm font-semibold text-slate-800 tracking-wide"
                >
                    Editar TCC
                </span>

            </div>


            <div class="flex items-center gap-4">

                <span
                    class="bg-orange-600 text-white text-xs font-medium px-3.5 py-1.5 rounded-full shadow-sm shadow-orange-600/20"
                >
                    Administrador
                </span>

                <a
                    href="{{ route('home') }}"
                    class="text-sm text-slate-500 hover:text-slate-800 transition-colors"
                >
                    Sair
                </a>

            </div>

        </header>


        {{-- CONTEÚDO --}}
        <div class="max-w-4xl mx-auto w-full">


            {{-- TÍTULO --}}
            <div class="mb-8">

                <div class="flex items-center gap-3 mb-2">

                    <a
                        href="{{ route('admin.tccs') }}"
                        class="w-9 h-9 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-500 hover:text-orange-600 hover:border-orange-300 transition-all"
                    >
                        <i class="bi bi-arrow-left"></i>
                    </a>

                    <h1
                        class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight"
                    >
                        Editar TCC
                    </h1>

                </div>

                <p class="text-slate-500 text-sm mt-1 ml-12">

                    Altere as informações do trabalho acadêmico cadastrado.

                </p>

            </div>


            {{-- SUCESSO --}}
            @if(session('success'))

                <div
                    class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-4 rounded-2xl text-sm flex items-center gap-2"
                >

                    <i class="bi bi-check-circle-fill text-emerald-600 text-base"></i>

                    <span>{{ session('success') }}</span>

                </div>

            @endif


            {{-- ERROS --}}
            @if($errors->any())

                <div
                    class="mb-6 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-2xl text-sm"
                >

                    <strong class="font-semibold block mb-1">
                        Verifique os seguintes erros:
                    </strong>

                    <ul class="list-disc list-inside space-y-1 text-xs">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- FORMULÁRIO --}}
            <form
                action="{{ route('admin.tccs.update', $tcc->id_tcc) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf
                @method('PUT')


                {{-- ARQUIVOS ATUAIS --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">


                    {{-- PDF --}}
                    <div
                        class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-sm"
                    >

                        <div class="flex items-center gap-3 mb-4">

                            <div
                                class="p-3 bg-slate-50 rounded-xl text-orange-600"
                            >
                                <i class="bi bi-file-earmark-pdf text-2xl"></i>
                            </div>

                            <div>

                                <h3 class="font-bold text-slate-800 text-base">
                                    Arquivo PDF
                                </h3>

                                <p class="text-xs text-slate-400">
                                    Arquivo atualmente cadastrado
                                </p>

                            </div>

                        </div>


                        @if($tcc->arquivo_pdf)

                            <a
                                href="{{ asset('storage/' . $tcc->arquivo_pdf) }}"
                                target="_blank"
                                class="w-full inline-flex items-center justify-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold py-3 rounded-xl transition-all text-sm mb-3"
                            >

                                <i class="bi bi-eye"></i>

                                Visualizar PDF atual

                            </a>

                        @else

                            <div
                                class="w-full bg-slate-50 border border-slate-200 text-slate-400 text-sm text-center py-3 rounded-xl mb-3"
                            >
                                Nenhum PDF cadastrado
                            </div>

                        @endif


                        <label
                            for="arquivo_pdf"
                            class="block text-xs font-semibold text-slate-700 mb-2"
                        >
                            Substituir PDF
                        </label>

                        <input
                            type="file"
                            name="arquivo_pdf"
                            id="arquivo_pdf"
                            accept=".pdf"
                            class="w-full text-sm text-slate-500 border border-slate-200 rounded-xl cursor-pointer bg-slate-50 focus:outline-none focus:border-orange-500"
                        >

                        <p
                            id="pdf-name"
                            class="text-xs text-orange-600 font-medium mt-2"
                        ></p>

                        <p class="text-xs text-slate-400 mt-2">
                            Deixe vazio para manter o arquivo atual.
                        </p>

                    </div>


                    {{-- CAPA --}}
                    <div
                        class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-sm"
                    >

                        <div class="flex items-center gap-3 mb-4">

                            <div
                                class="p-3 bg-slate-50 rounded-xl text-orange-600"
                            >
                                <i class="bi bi-image text-2xl"></i>
                            </div>

                            <div>

                                <h3 class="font-bold text-slate-800 text-base">
                                    Capa do TCC
                                </h3>

                                <p class="text-xs text-slate-400">
                                    Imagem atualmente cadastrada
                                </p>

                            </div>

                        </div>


                        @if($tcc->capa_tcc)

                            <div class="mb-4 flex justify-center">

                                <img
                                    src="{{ asset('storage/' . $tcc->capa_tcc) }}"
                                    alt="Capa atual do TCC"
                                    class="max-h-48 rounded-xl border border-slate-200 shadow-sm object-cover"
                                >

                            </div>

                        @else

                            <div
                                class="w-full bg-slate-50 border border-slate-200 text-slate-400 text-sm text-center py-3 rounded-xl mb-3"
                            >
                                Nenhuma capa cadastrada
                            </div>

                        @endif


                        <label
                            for="capa_tcc"
                            class="block text-xs font-semibold text-slate-700 mb-2"
                        >
                            Substituir capa
                        </label>

                        <input
                            type="file"
                            name="capa_tcc"
                            id="capa_tcc"
                            accept=".jpg,.jpeg,.png"
                            class="w-full text-sm text-slate-500 border border-slate-200 rounded-xl cursor-pointer bg-slate-50 focus:outline-none focus:border-orange-500"
                        >

                        <p
                            id="capa-name"
                            class="text-xs text-orange-600 font-medium mt-2"
                        ></p>

                        <p class="text-xs text-slate-400 mt-2">
                            JPG ou PNG — até 5MB.
                        </p>

                    </div>

                </div>


                {{-- CARD INFORMAÇÕES --}}
                <div
                    class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8 shadow-sm"
                >

                    <h3 class="text-xl font-bold text-slate-900 mb-6">
                        Informações do TCC
                    </h3>


                    <div class="space-y-5">


                        {{-- TÍTULO --}}
                        <div>

                            <label
                                for="titulo_tcc"
                                class="block text-xs font-semibold text-slate-700 mb-2"
                            >
                                Título completo
                            </label>

                            <input
                                type="text"
                                name="titulo_tcc"
                                id="titulo_tcc"
                                value="{{ old('titulo_tcc', $tcc->titulo_tcc) }}"
                                placeholder="Título do trabalho"
                                required
                                class="w-full bg-slate-100/80 focus:bg-white text-sm text-slate-800 placeholder:text-slate-400 border border-transparent focus:border-orange-500 rounded-2xl px-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-orange-500/20 transition-all"
                            >

                        </div>


                        {{-- AUTOR / ORIENTADOR --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">


                            <div>

                                <label
                                    for="autor_tcc"
                                    class="block text-xs font-semibold text-slate-700 mb-2"
                                >
                                    Autor
                                </label>

                                <input
                                    type="text"
                                    name="autor_tcc"
                                    id="autor_tcc"
                                    value="{{ old('autor_tcc', $tcc->autor_tcc) }}"
                                    placeholder="Nome completo do autor"
                                    required
                                    class="w-full bg-slate-100/80 focus:bg-white text-sm text-slate-800 placeholder:text-slate-400 border border-transparent focus:border-orange-500 rounded-2xl px-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-orange-500/20 transition-all"
                                >

                            </div>


                            <div>

                                <label
                                    for="orientador_tcc"
                                    class="block text-xs font-semibold text-slate-700 mb-2"
                                >
                                    Orientador
                                </label>

                                <input
                                    type="text"
                                    name="orientador_tcc"
                                    id="orientador_tcc"
                                    value="{{ old('orientador_tcc', $tcc->orientador_tcc) }}"
                                    placeholder="Prof. Dr. Nome Sobrenome"
                                    class="w-full bg-slate-100/80 focus:bg-white text-sm text-slate-800 placeholder:text-slate-400 border border-transparent focus:border-orange-500 rounded-2xl px-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-orange-500/20 transition-all"
                                >

                            </div>

                        </div>


                        {{-- CURSO / TURMA / ANO --}}
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">


                            {{-- CURSO --}}
                            <div>

                                <label
                                    for="curso_tcc"
                                    class="block text-xs font-semibold text-slate-700 mb-2"
                                >
                                    Curso
                                </label>

                                <select
                                    name="curso_tcc"
                                    id="curso_tcc"
                                    required
                                    class="w-full bg-slate-100/80 focus:bg-white text-sm text-slate-800 border border-transparent focus:border-orange-500 rounded-2xl px-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-orange-500/20 transition-all cursor-pointer"
                                >

                                    <option value="">
                                        Selecionar
                                    </option>

                                    <option
                                        value="Desenvolvimento de Sistemas"
                                        {{ old('curso_tcc', $tcc->curso_tcc) == 'Desenvolvimento de Sistemas' ? 'selected' : '' }}
                                    >
                                        Desenvolvimento de Sistemas
                                    </option>

                                    <option
                                        value="Administração"
                                        {{ old('curso_tcc', $tcc->curso_tcc) == 'Administração' ? 'selected' : '' }}
                                    >
                                        Administração
                                    </option>

                                    <option
                                        value="Informática"
                                        {{ old('curso_tcc', $tcc->curso_tcc) == 'Informática' ? 'selected' : '' }}
                                    >
                                        Informática
                                    </option>

                                </select>

                            </div>


                            {{-- TURMA --}}
                            <div>

                                <label
                                    for="turma_tcc"
                                    class="block text-xs font-semibold text-slate-700 mb-2"
                                >
                                    Turma
                                </label>

                                <input
                                    type="text"
                                    name="turma_tcc"
                                    id="turma_tcc"
                                    value="{{ old('turma_tcc', $tcc->turma_tcc) }}"
                                    placeholder="Ex: 3ºA"
                                    class="w-full bg-slate-100/80 focus:bg-white text-sm text-slate-800 placeholder:text-slate-400 border border-transparent focus:border-orange-500 rounded-2xl px-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-orange-500/20 transition-all"
                                >

                            </div>


                            {{-- ANO --}}
                            <div>

                                <label
                                    for="ano_tcc"
                                    class="block text-xs font-semibold text-slate-700 mb-2"
                                >
                                    Ano
                                </label>

                                <input
                                    type="number"
                                    name="ano_tcc"
                                    id="ano_tcc"
                                    value="{{ old('ano_tcc', $tcc->ano_tcc) }}"
                                    min="2000"
                                    max="{{ date('Y') + 1 }}"
                                    required
                                    class="w-full bg-slate-100/80 focus:bg-white text-sm text-slate-800 placeholder:text-slate-400 border border-transparent focus:border-orange-500 rounded-2xl px-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-orange-500/20 transition-all"
                                >

                            </div>

                        </div>


                        {{-- STATUS --}}
                        <div>

                            <label
                                for="status_tcc_"
                                class="block text-xs font-semibold text-slate-700 mb-2"
                            >
                                Status do TCC
                            </label>

                            <select
                                name="status_tcc_"
                                id="status_tcc_"
                                required
                                class="w-full bg-slate-100/80 focus:bg-white text-sm text-slate-800 border border-transparent focus:border-orange-500 rounded-2xl px-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-orange-500/20 transition-all cursor-pointer"
                            >

                                <option
                                    value="rascunho"
                                    {{ old('status_tcc_', $tcc->status_tcc_) == 'rascunho' ? 'selected' : '' }}
                                >
                                    Rascunho
                                </option>

                                <option
                                    value="publicado"
                                    {{ old('status_tcc_', $tcc->status_tcc_) == 'publicado' ? 'selected' : '' }}
                                >
                                    Publicado
                                </option>

                            </select>

                        </div>


                        {{-- RESUMO --}}
                        <div>

                            <label
                                for="resumo_tcc"
                                class="block text-xs font-semibold text-slate-700 mb-2"
                            >
                                Resumo
                            </label>

                            <textarea
                                name="resumo_tcc"
                                id="resumo_tcc"
                                rows="5"
                                placeholder="Escreva um resumo completo do trabalho..."
                                class="w-full bg-slate-100/80 focus:bg-white text-sm text-slate-800 placeholder:text-slate-400 border border-transparent focus:border-orange-500 rounded-2xl px-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-orange-500/20 transition-all resize-none"
                            >{{ old('resumo_tcc', $tcc->resumo_tcc) }}</textarea>

                        </div>


                        {{-- PALAVRAS-CHAVE --}}
                        <div>

                            <label
                                for="palavras_chave_tcc"
                                class="block text-xs font-semibold text-slate-700 mb-2"
                            >
                                Palavras-chave
                            </label>

                            <input
                                type="text"
                                name="palavras_chave_tcc"
                                id="palavras_chave_tcc"
                                value="{{ old('palavras_chave_tcc', $tcc->palavras_chave_tcc) }}"
                                placeholder="Ex: inteligência artificial, machine learning, redes neurais"
                                class="w-full bg-slate-100/80 focus:bg-white text-sm text-slate-800 placeholder:text-slate-400 border border-transparent focus:border-orange-500 rounded-2xl px-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-orange-500/20 transition-all"
                            >

                            <p class="text-xs text-slate-400 mt-2">
                                Separe as palavras-chave por vírgula.
                            </p>

                        </div>


                        {{-- IDENTIFICAÇÃO --}}
                        <div
                            class="pt-5 border-t border-slate-100"
                        >

                            <p class="text-xs text-slate-400">

                                TCC #{{ $tcc->id_tcc }}

                            </p>

                        </div>

                    </div>

                </div>


                {{-- BOTÕES --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-8">


                    {{-- CANCELAR --}}
                    <a
                        href="{{ route('admin.tccs') }}"
                        class="w-full bg-slate-100/80 hover:bg-slate-200/80 border border-slate-200 text-slate-800 font-semibold py-3.5 rounded-full transition-all text-sm text-center"
                    >
                        Cancelar
                    </a>


                    {{-- SALVAR --}}
                    <button
                        type="submit"
                        class="w-full bg-[#090D28] hover:bg-slate-900 text-white font-semibold py-3.5 rounded-full shadow-lg shadow-slate-900/10 transition-all text-sm flex items-center justify-center gap-2"
                    >

                        <i class="bi bi-check-lg"></i>

                        <span>
                            Salvar alterações
                        </span>

                    </button>

                </div>

            </form>

        </div>

    </main>

</div>


{{-- JAVASCRIPT --}}
<script>

    const arquivoPdf = document.getElementById('arquivo_pdf');
    const capaTcc = document.getElementById('capa_tcc');

    if (arquivoPdf) {

        arquivoPdf.addEventListener('change', function () {

            const nome = this.files.length > 0
                ? this.files[0].name
                : '';

            document.getElementById('pdf-name').textContent = nome;

        });

    }


    if (capaTcc) {

        capaTcc.addEventListener('change', function () {

            const nome = this.files.length > 0
                ? this.files[0].name
                : '';

            document.getElementById('capa-name').textContent = nome;

        });

    }

</script>


</body>

</html>



</body>
</html>