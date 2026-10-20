<!DOCTYPE html>
<html lang="pt-BR" class="h-full bg-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BIBLIO-TEK - Gerenciar Livros</title>
    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: { brand: { dark: '#090D28', orange: '#ea580c', } } } } }
    </script>
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="h-full font-sans antialiased text-slate-800 bg-slate-100">
<div class="min-h-screen flex flex-col lg:flex-row">
    {{-- SIDEBAR --}}
    @include('admin.sidebar')

    {{-- CONTEÚDO PRINCIPAL --}}
    <main class="flex-1 min-w-0 flex flex-col p-4 sm:p-6 lg:p-8 overflow-y-auto">
        {{-- TOPO / HEADER --}}
        <header class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-2.5">
                <span class="w-1 h-4 bg-orange-600 rounded-full inline-block"></span>
                <span class="text-sm font-semibold text-slate-800 tracking-wide">Gerenciar Livros</span>
            </div>
            <div class="flex items-center gap-4">
                <span class="bg-orange-600 text-white text-xs font-medium px-3 py-1 rounded-full shadow-sm shadow-orange-600/20">Administrador</span>
                <a href="{{ route('home') }}" class="text-sm text-slate-500 hover:text-slate-800 transition-colors">Sair</a>
            </div>
        </header>

        {{-- TÍTULO DA PÁGINA --}}
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight mb-1">Gerenciar Livros</h1>
            <p class="text-sm text-slate-500">{{ $livros->total() }} {{ Str::plural('livro cadastrado', $livros->total()) }}</p>
        </div>

        {{-- MENSAGEM DE SUCESSO --}}
        @if(session('success'))
            <div class="mb-5 flex items-center gap-2 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                <i class="bi bi-check-circle-fill"></i><span>{{ session('success') }}</span>
            </div>
        @endif

        {{-- CARD PRINCIPAL --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden flex flex-col">
            {{-- BARRA DE BUSCA E FILTROS --}}
            <div class="p-4 border-b border-slate-100">
                <form method="GET" action="{{ route('admin.livros') }}" class="flex flex-col lg:flex-row gap-3">
                    {{-- BUSCA --}}
                    <div class="w-full lg:max-w-md">
                        <div class="relative flex items-center">
                            <i class="bi bi-search absolute left-4 text-slate-400 text-sm pointer-events-none"></i>
                            <input id="busca-livro" name="search" type="search" class="w-full bg-slate-100/80 hover:bg-slate-100 focus:bg-white text-sm text-slate-700 placeholder:text-slate-400 pl-10 pr-4 py-2.5 rounded-full border border-transparent focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-500/20 transition-all" placeholder="Buscar por título ou autor..." value="{{ request('search') }}">
                        </div>
                    </div>
                    {{-- CATEGORIA --}}
                    <div class="w-full lg:w-52">
                        <select name="categoria" onchange="this.form.submit()" class="w-full bg-slate-100/80 hover:bg-slate-100 focus:bg-white text-sm text-slate-600 px-4 py-2.5 rounded-full border border-transparent focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-500/20 transition-all">
                            <option value="">Todas as categorias</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria }}" {{ request('categoria') == $categoria ? 'selected' : '' }}>{{ $categoria }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- STATUS --}}
                    <div class="w-full lg:w-44">
                        <select name="status" onchange="this.form.submit()" class="w-full bg-slate-100/80 hover:bg-slate-100 focus:bg-white text-sm text-slate-600 px-4 py-2.5 rounded-full border border-transparent focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-500/20 transition-all">
                            <option value="">Todos os status</option>
                            <option value="disponivel" {{ request('status') == 'disponivel' ? 'selected' : '' }}>Disponível</option>
                            <option value="emprestado" {{ request('status') == 'emprestado' ? 'selected' : '' }}>Emprestado</option>
                            <option value="reservado" {{ request('status') == 'reservado' ? 'selected' : '' }}>Reservado</option>
                        </select>
                    </div>
                    {{-- LIMPAR FILTROS --}}
                    @if(request()->hasAny(['search', 'categoria', 'status']))
                        <a href="{{ route('admin.livros') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-full border border-slate-200 text-sm text-slate-500 hover:text-slate-800 hover:bg-slate-50 transition-all">
                            <i class="bi bi-x-lg"></i>Limpar
                        </a>
                    @endif
                </form>
            </div>

            {{-- TABELA DE LIVROS --}}
            <div class="overflow-x-auto w-full">
                <table class="w-full text-left border-collapse">
                    <caption class="sr-only">Lista de livros cadastrados</caption>
                    <thead>
                        <tr class="border-b border-slate-100 text-xs font-medium text-slate-400 uppercase tracking-wider bg-slate-50/50">
                            <th scope="col" class="pl-6 pr-4 py-3.5">Capa</th>
                            <th scope="col" class="px-4 py-3.5">Título</th>
                            <th scope="col" class="px-4 py-3.5">Autor</th>
                            <th scope="col" class="px-4 py-3.5">Categoria</th>
                            <th scope="col" class="px-4 py-3.5">Avaliação</th>
                            <th scope="col" class="px-4 py-3.5">Status</th>
                            <th scope="col" class="pr-6 pl-4 py-3.5 text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse ($livros as $livro)
                            <tr class="hover:bg-slate-50/60 transition-colors">
                                {{-- CAPA --}}
                                <td class="pl-6 pr-4 py-3.5 whitespace-nowrap">
                                    {{-- CAPA --}}
{{-- CAPA --}}
<td class="pl-6 pr-4 py-3.5 whitespace-nowrap">
    @if ($livro->capa_livro)
        <img src="{{ asset($livro->capa_livro) }}" class="w-11 h-14 rounded-lg object-cover shadow-sm border border-slate-200/60" alt="Capa: {{ $livro->titulo_livro }}">
    @else
        <div class="w-11 h-14 rounded-lg bg-slate-100 text-slate-400 flex items-center justify-center border border-slate-200/60">
            <i class="bi bi-book text-lg"></i>
        </div>
    @endif
</td>
                                </td>
                                {{-- TÍTULO --}}
                                <td class="px-4 py-3.5">
                                    <span class="font-bold text-slate-900 line-clamp-2 max-w-xs block" title="{{ $livro->titulo_livro }}">{{ $livro->titulo_livro }}</span>
                                    @if($livro->descricao_livro)
                                        <span class="text-xs text-slate-400 line-clamp-1 max-w-xs block mt-1">{{ \Illuminate\Support\Str::limit($livro->descricao_livro, 70) }}</span>
                                    @endif
                                </td>
                                {{-- AUTOR --}}
                                <td class="px-4 py-3.5"><span class="text-slate-600 line-clamp-1 max-w-[160px] block">{{ $livro->autor_livro ?? 'Não informado' }}</span></td>
                                {{-- CATEGORIA --}}
                                <td class="px-4 py-3.5 whitespace-nowrap">
                                    @if($livro->categoria_livro)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-600 border border-slate-200/60">{{ $livro->categoria_livro }}</span>
                                    @else
                                        <span class="text-slate-400 text-xs">Sem categoria</span>
                                    @endif
                                </td>
                                {{-- AVALIAÇÃO --}}
                                <td class="px-4 py-3.5 whitespace-nowrap">
                                    @if($livro->avaliacao_livro !== null)
                                        <div class="flex items-center gap-1.5"><i class="bi bi-star-fill text-xs text-amber-400"></i><span class="text-slate-500">{{ number_format($livro->avaliacao_livro, 1, ',', '.') }}</span></div>
                                    @else
                                        <span class="text-slate-400">Sem avaliação</span>
                                    @endif
                                </td>
                                {{-- STATUS --}}
                                <td class="px-4 py-3.5 whitespace-nowrap">
                                    @php $status = strtolower(trim($livro->status_livro ?? '')); @endphp
                                    @if(in_array($status, ['disponivel', 'disponível']))
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-600 border border-emerald-100">Disponível</span>
                                    @elseif($status === 'emprestado')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-50 text-amber-600 border border-amber-100">Emprestado</span>
                                    @elseif($status === 'reservado')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-600 border border-blue-100">Reservado</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-500 border border-slate-200">{{ $livro->status_livro ?? 'Indefinido' }}</span>
                                    @endif
                                </td>
                                {{-- AÇÕES --}}
                                <td class="pr-6 pl-4 py-3.5 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center gap-3 text-slate-400">
                                        @if(Route::has('admin.livros.show'))
                                            <a href="{{ route('admin.livros.show', $livro->id_livro) }}" class="hover:text-slate-800 transition-colors p-1" title="Visualizar livro"><i class="bi bi-eye text-base"></i></a>
                                        @endif
                                        @if(Route::has('admin.livros.edit'))
                                            <a href="{{ route('admin.livros.edit', $livro->id_livro) }}" class="hover:text-blue-600 transition-colors p-1" title="Editar livro"><i class="bi bi-pencil text-base"></i></a>
                                        @endif
                                        @if(Route::has('admin.livros.destroy'))
                                            <form action="{{ route('admin.livros.destroy', $livro->id_livro) }}" method="POST" class="inline-flex" onsubmit="return confirm('Deseja realmente excluir este livro?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="hover:text-red-600 transition-colors p-1" title="Excluir livro"><i class="bi bi-trash text-base"></i></button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-slate-400 py-12">
                                    <i class="bi bi-book text-4xl block mb-3 opacity-40"></i>
                                    <p class="text-sm">Nenhum livro encontrado.</p>
                                    <a href="{{ route('admin.livros.create') }}" class="inline-flex items-center gap-2 mt-4 px-4 py-2 rounded-lg bg-orange-600 text-white text-sm font-medium hover:bg-orange-700 transition-colors"><i class="bi bi-plus-lg"></i>Adicionar livro</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINAÇÃO --}}
            @if (method_exists($livros, 'hasPages') && $livros->hasPages())
                <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                    {{ $livros->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </main>
</div>
</body>
</html>