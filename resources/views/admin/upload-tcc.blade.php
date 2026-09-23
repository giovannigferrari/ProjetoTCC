@extends('layouts.app')

@section('title', 'Upload de TCC')

@section('content')

<div class="min-h-screen bg-slate-100">

    {{-- CABEÇALHO --}}

    <div class="bg-white border-b border-slate-200 px-8 py-4">

        <div class="flex items-center justify-between">

            <div class="flex items-center gap-3">

                <div class="w-1.5 h-8 bg-orange-600 rounded-full"></div>

                <h1 class="text-xl font-bold text-[#090D28]">
                    Upload de TCC
                </h1>

            </div>

            <div class="flex items-center gap-4">

                <span class="bg-orange-600 text-white px-5 py-2 rounded-full text-sm font-semibold">
                    Administrador
                </span>

                <a
                    href="{{ route('login') }}"
                    class="text-slate-500 hover:text-red-500 transition"
                >
                    Sair
                </a>

            </div>

        </div>

    </div>


    {{-- CONTEÚDO --}}

    <div class="max-w-4xl mx-auto px-6 py-10">

        <div class="mb-8">

            <h2 class="text-3xl font-bold text-[#090D28]">
                Upload de TCC
            </h2>

            <p class="text-slate-500 mt-1">
                Cadastre um novo trabalho de conclusão de curso
            </p>

        </div>


        {{-- MENSAGEM DE SUCESSO --}}

        @if(session('success'))

            <div class="mb-6 bg-green-100 border border-green-300 text-green-700 px-5 py-4 rounded-xl">

                <i class="bi bi-check-circle-fill me-2"></i>

                {{ session('success') }}

            </div>

        @endif


        {{-- ERROS --}}

        @if($errors->any())

            <div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-5 py-4 rounded-xl">

                <strong>
                    Verifique os seguintes erros:
                </strong>

                <ul class="mt-2 list-disc list-inside">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- FORMULÁRIO --}}

        <form
            action="{{ route('admin.upload-tcc.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf


            {{-- ARQUIVOS --}}

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">

                {{-- PDF --}}

                <label
                    for="arquivo_pdf"
                    class="cursor-pointer border-2 border-dashed border-slate-300 rounded-2xl p-10 bg-white hover:border-orange-500 transition text-center"
                >

                    <i class="bi bi-file-earmark-pdf text-4xl text-slate-500"></i>

                    <h3 class="font-bold text-[#090D28] mt-4">
                        Arquivo PDF
                    </h3>

                    <p class="text-sm text-slate-500 mt-2">
                        Clique para selecionar o arquivo PDF
                    </p>

                    <p
                        id="pdf-name"
                        class="text-sm text-orange-600 font-medium mt-3"
                    ></p>

                    <input
                        type="file"
                        name="arquivo_pdf"
                        id="arquivo_pdf"
                        accept=".pdf"
                        class="hidden"
                        required
                    >

                </label>


                {{-- CAPA --}}

                <label
                    for="capa_tcc"
                    class="cursor-pointer border-2 border-dashed border-slate-300 rounded-2xl p-10 bg-white hover:border-orange-500 transition text-center"
                >

                    <i class="bi bi-image text-4xl text-slate-500"></i>

                    <h3 class="font-bold text-[#090D28] mt-4">
                        Capa (Imagem)
                    </h3>

                    <p class="text-sm text-slate-500 mt-2">
                        JPG, PNG — até 5MB
                    </p>

                    <p
                        id="capa-name"
                        class="text-sm text-orange-600 font-medium mt-3"
                    ></p>

                    <input
                        type="file"
                        name="capa_tcc"
                        id="capa_tcc"
                        accept=".jpg,.jpeg,.png"
                        class="hidden"
                    >

                </label>

            </div>


            {{-- INFORMAÇÕES DO TCC --}}

            <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8">

                <h3 class="text-2xl font-bold text-[#090D28] mb-6">
                    Informações do TCC
                </h3>


                {{-- TÍTULO --}}

                <div class="mb-5">

                    <label
                        for="titulo_tcc"
                        class="block text-sm font-semibold text-[#090D28] mb-2"
                    >
                        Título completo
                    </label>

                    <input
                        type="text"
                        name="titulo_tcc"
                        id="titulo_tcc"
                        value="{{ old('titulo_tcc') }}"
                        placeholder="Título do trabalho"
                        required
                        class="w-full bg-slate-100 border-0 rounded-xl px-4 py-4 focus:ring-2 focus:ring-orange-500"
                    >

                </div>


                {{-- AUTOR / ORIENTADOR --}}

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">

                    <div>

                        <label
                            for="autor_tcc"
                            class="block text-sm font-semibold text-[#090D28] mb-2"
                        >
                            Autor
                        </label>

                        <input
                            type="text"
                            name="autor_tcc"
                            id="autor_tcc"
                            value="{{ old('autor_tcc') }}"
                            placeholder="Nome completo do autor"
                            required
                            class="w-full bg-slate-100 border-0 rounded-xl px-4 py-4 focus:ring-2 focus:ring-orange-500"
                        >

                    </div>


                    <div>

                        <label
                            for="orientador_tcc"
                            class="block text-sm font-semibold text-[#090D28] mb-2"
                        >
                            Orientador
                        </label>

                        <input
                            type="text"
                            name="orientador_tcc"
                            id="orientador_tcc"
                            value="{{ old('orientador_tcc') }}"
                            placeholder="Prof. Dr. Nome Sobrenome"
                            class="w-full bg-slate-100 border-0 rounded-xl px-4 py-4 focus:ring-2 focus:ring-orange-500"
                        >

                    </div>

                </div>


                {{-- CURSO / TURMA / ANO --}}

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-5">

                    <div>

                        <label
                            for="curso_tcc"
                            class="block text-sm font-semibold text-[#090D28] mb-2"
                        >
                            Curso
                        </label>

                        <select
                            name="curso_tcc"
                            id="curso_tcc"
                            required
                            class="w-full bg-slate-100 border-0 rounded-xl px-4 py-4 focus:ring-2 focus:ring-orange-500"
                        >

                            <option value="">
                                Selecionar
                            </option>

                            <option
                                value="Desenvolvimento de Sistemas"
                                {{ old('curso_tcc') == 'Desenvolvimento de Sistemas' ? 'selected' : '' }}
                            >
                                Desenvolvimento de Sistemas
                            </option>

                            <option
                                value="Administração"
                                {{ old('curso_tcc') == 'Administração' ? 'selected' : '' }}
                            >
                                Administração
                            </option>

                            <option
                                value="Informática"
                                {{ old('curso_tcc') == 'Informática' ? 'selected' : '' }}
                            >
                                Informática
                            </option>

                        </select>

                    </div>


                    <div>

                        <label
                            for="turma_tcc"
                            class="block text-sm font-semibold text-[#090D28] mb-2"
                        >
                            Turma
                        </label>

                        <input
                            type="text"
                            name="turma_tcc"
                            id="turma_tcc"
                            value="{{ old('turma_tcc') }}"
                            placeholder="Ex: 3ºA"
                            class="w-full bg-slate-100 border-0 rounded-xl px-4 py-4 focus:ring-2 focus:ring-orange-500"
                        >

                    </div>


                    <div>

                        <label
                            for="ano_tcc"
                            class="block text-sm font-semibold text-[#090D28] mb-2"
                        >
                            Ano
                        </label>

                        <input
                            type="number"
                            name="ano_tcc"
                            id="ano_tcc"
                            value="{{ old('ano_tcc', date('Y')) }}"
                            min="2000"
                            max="{{ date('Y') + 1 }}"
                            required
                            class="w-full bg-slate-100 border-0 rounded-xl px-4 py-4 focus:ring-2 focus:ring-orange-500"
                        >

                    </div>

                </div>


                {{-- RESUMO --}}

                <div class="mb-5">

                    <label
                        for="resumo_tcc"
                        class="block text-sm font-semibold text-[#090D28] mb-2"
                    >
                        Resumo
                    </label>

                    <textarea
                        name="resumo_tcc"
                        id="resumo_tcc"
                        rows="5"
                        placeholder="Escreva um resumo completo do trabalho..."
                        class="w-full bg-slate-100 border-0 rounded-xl px-4 py-4 focus:ring-2 focus:ring-orange-500"
                    >{{ old('resumo_tcc') }}</textarea>

                </div>


                {{-- PALAVRAS-CHAVE --}}

                <div>

                    <label
                        for="palavras_chave_tcc"
                        class="block text-sm font-semibold text-[#090D28] mb-2"
                    >
                        Palavras-chave
                    </label>

                    <input
                        type="text"
                        name="palavras_chave_tcc"
                        id="palavras_chave_tcc"
                        value="{{ old('palavras_chave_tcc') }}"
                        placeholder="Ex: inteligência artificial, redes neurais"
                        class="w-full bg-slate-100 border-0 rounded-xl px-4 py-4 focus:ring-2 focus:ring-orange-500"
                    >

                    <p class="text-xs text-slate-500 mt-2">
                        Separe as palavras-chave por vírgula.
                    </p>

                </div>

            </div>


            {{-- BOTÕES --}}

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">

                <button
                    type="submit"
                    name="status_tcc"
                    value="rascunho"
                    class="w-full border border-slate-300 bg-white text-[#090D28] font-semibold py-4 rounded-xl hover:bg-slate-100 transition"
                >

                    <i class="bi bi-save me-2"></i>

                    Salvar rascunho

                </button>


                <button
                    type="submit"
                    name="status_tcc"
                    value="publicado"
                    class="w-full bg-[#090D28] text-white font-semibold py-4 rounded-xl hover:bg-orange-600 transition"
                >

                    <i class="bi bi-upload me-2"></i>

                    Enviar TCC

                </button>

            </div>

        </form>

    </div>

</div>


{{-- JAVASCRIPT --}}

<script>

    document.getElementById('arquivo_pdf').addEventListener('change', function () {

        const nome = this.files.length > 0
            ? this.files[0].name
            : '';

        document.getElementById('pdf-name').textContent = nome;

    });


    document.getElementById('capa_tcc').addEventListener('change', function () {

        const nome = this.files.length > 0
            ? this.files[0].name
            : '';

        document.getElementById('capa-name').textContent = nome;

    });

</script>

@endsection

