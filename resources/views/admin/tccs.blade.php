<!DOCTYPE html>
<html lang="pt-BR" class="h-full bg-slate-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BIBLIO-TEK - Gerenciar TCCs</title>

    <!-- Tailwind CSS (Vite / CDN Fallback) -->
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

        {{-- TOPO / HEADER (IGUAL AO FIGMA) --}}
        <header class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-2.5">
                <span class="w-1 h-4 bg-orange-600 rounded-full inline-block"></span>
                <span class="text-sm font-semibold text-slate-800 tracking-wide">
                    Gerenciar TCCs
                </span>
            </div>

            <div class="flex items-center gap-4">
                <span class="bg-orange-600 text-white text-xs font-medium px-3 py-1 rounded-full shadow-sm shadow-orange-600/20">
                    Administrador
                </span>
                <a href="{{ route('home') }}" class="text-sm text-slate-500 hover:text-slate-800 transition-colors">
                    Sair
                </a>
            </div>
        </header>


        {{-- TÍTULO DA PÁGINA --}}
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight mb-1">
                Gerenciar TCCs
            </h1>
            <p class="text-sm text-slate-500">
                {{ $tccs->count() }} {{ Str::plural('trabalho cadastrado', $tccs->count()) }}
            </p>
        </div>


        {{-- CARD CONTAINER PRINCIPAL --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden flex flex-col">

            {{-- BARRA DE BUSCA --}}
            <div class="p-4 border-b border-slate-100">
                <form method="GET" class="w-full max-w-md">
                    <div class="relative flex items-center">
                        <i class="bi bi-search absolute left-4 text-slate-400 text-sm pointer-events-none"></i>
                        <input
                            id="busca-tcc"
                            name="busca"
                            type="search"
                            class="w-full bg-slate-100/80 hover:bg-slate-100 focus:bg-white text-sm text-slate-700 placeholder:text-slate-400 pl-10 pr-4 py-2.5 rounded-full border border-transparent focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-500/20 transition-all"
                            placeholder="Buscar por título, autor ou turma..."
                            value="{{ request('busca') }}"
                        >
                    </div>
                </form>
            </div>


            {{-- TABELA DE TCCS --}}
            <div class="overflow-x-auto w-full">
                <table class="w-full text-left border-collapse">
                    <caption class="sr-only">Lista de trabalhos de conclusão de curso cadastrados</caption>
                    
                    <thead>
                        <tr class="border-b border-slate-100 text-xs font-medium text-slate-400 uppercase tracking-wider bg-slate-50/50">
                            <th scope="col" class="pl-6 pr-4 py-3.5">Capa</th>
                            <th scope="col" class="px-4 py-3.5">Título</th>
                            <th scope="col" class="px-4 py-3.5">Autor</th>
                            <th scope="col" class="px-4 py-3.5">Turma</th>
                            <th scope="col" class="px-4 py-3.5">Ano</th>
                            <th scope="col" class="px-4 py-3.5">Visualizações</th>
                            <th scope="col" class="pr-6 pl-4 py-3.5 text-center">Ações</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse ($tccs as $tcc)
                            <tr class="hover:bg-slate-50/60 transition-colors">
                                
                                {{-- CAPA --}}
                                <td class="pl-6 pr-4 py-3.5 whitespace-nowrap">
                                    @if ($tcc->capa_tcc)
                                        <img
                                            src="{{ asset('storage/' . $tcc->capa_tcc) }}"
                                            class="w-11 h-11 rounded-lg object-cover shadow-sm border border-slate-200/60"
                                            alt="Capa: {{ $tcc->titulo_tcc }}"
                                        >
                                    @else
                                        <div class="w-11 h-11 rounded-lg bg-slate-100 text-slate-400 flex items-center justify-center border border-slate-200/60">
                                            <i class="bi bi-file-earmark-text text-lg"></i>
                                        </div>
                                    @endif
                                </td>

                                {{-- TÍTULO --}}
                                <td class="px-4 py-3.5">
                                    <span class="font-bold text-slate-900 line-clamp-2 max-w-xs block" title="{{ $tcc->titulo_tcc }}">
                                        {{ $tcc->titulo_tcc }}
                                    </span>
                                </td>

                                {{-- AUTOR --}}
                                <td class="px-4 py-3.5">
                                    <span class="text-slate-600 line-clamp-1 max-w-[160px] block">
                                        {{ $tcc->autor_tcc }}
                                    </span>
                                </td>

                                {{-- TURMA --}}
                                <td class="px-4 py-3.5 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-600 border border-slate-200/60">
                                        {{ $tcc->turma_tcc }}
                                    </span>
                                </td>

                                {{-- ANO --}}
                                <td class="px-4 py-3.5 whitespace-nowrap text-slate-500">
                                    {{ $tcc->ano_tcc }}
                                </td>

                                {{-- VISUALIZAÇÕES --}}
                                <td class="px-4 py-3.5 whitespace-nowrap text-slate-500">
                                    <div class="flex items-center gap-1.5">
                                        <i class="bi bi-eye text-xs text-slate-400"></i>
                                        <span>{{ number_format($tcc->visualizacoes ?? 0, 0, ',', '.') }}</span>
                                    </div>
                                </td>

                                {{-- AÇÕES --}}
                                <td class="pr-6 pl-4 py-3.5 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center gap-3 text-slate-400">
                                        
                                        {{-- APROVAR --}}
                                        <form action="{{ route('admin.tccs.aprovar', $tcc->id_tcc) }}" method="POST" class="inline-flex">
                                            @csrf
                                            <button type="submit" class="hover:text-emerald-600 transition-colors p-1" title="Aprovar TCC">
                                                <i class="bi bi-check-circle text-base"></i>
                                            </button>
                                        </form>

                                        {{-- DESTACAR / FAVORITAR --}}
                                        <form action="{{ route('admin.tccs.destacar', $tcc->id_tcc) }}" method="POST" class="inline-flex">
                                            @csrf
                                            <button type="submit" class="hover:text-amber-500 transition-colors p-1" title="Destacar TCC">
                                                <i class="bi bi-star text-base"></i>
                                            </button>
                                        </form>

                                        {{-- EDITAR --}}
                                        <a href="{{ route('admin.tccs.edit', $tcc->id_tcc) }}" class="hover:text-blue-600 transition-colors p-1" title="Editar TCC">
                                            <i class="bi bi-pencil text-base"></i>
                                        </a>

                                        {{-- EXCLUIR --}}
                                        <form action="{{ route('admin.tccs.destroy', $tcc->id_tcc) }}" method="POST" class="inline-flex" onsubmit="return confirm('Deseja realmente excluir este TCC?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="hover:text-red-600 transition-colors p-1" title="Excluir TCC">
                                                <i class="bi bi-trash text-base"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-slate-400 py-12">
                                    <i class="bi bi-journal-x text-4xl block mb-3 opacity-40"></i>
                                    <p class="text-sm">Nenhum trabalho encontrado.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINAÇÃO --}}
            @if (method_exists($tccs, 'hasPages') && $tccs->hasPages())
                <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                    {{ $tccs->links() }}
                </div>
            @endif

        </div>

    </main>

</div>

</body>
</html>