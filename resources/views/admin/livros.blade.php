<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BIBLIO-TEK - Gerir Livros</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-slate-50 font-sans antialiased">

<div class="flex min-h-screen bg-slate-50">
    
    {{-- Incluindo o Sidebar --}}
    @include('admin.sidebar')

    {{-- Conteúdo Principal --}}
    <main class="flex-1 flex flex-col min-w-0">
        
        {{-- Header Superior --}}
        <header class="bg-white border-b border-slate-200 px-8 py-4 flex items-center justify-between">
            <div class="flex items-center gap-2 text-sm text-slate-500">
                <span class="font-semibold text-slate-800">BIBLIO-TEK Digital Library System</span>
            </div>
            <div class="flex items-center gap-4">
                <span class="px-4 py-1.5 bg-orange-600 text-white text-sm font-medium rounded-full shadow-md shadow-orange-600/20">
                    Administrador
                </span>
                <a href="{{ route('home') }}" class="text-sm text-slate-600 hover:text-orange-600 font-medium transition-colors">
                    Sair
                </a>
            </div>
        </header>

        {{-- Container --}}
        <div class="p-8 max-w-7xl w-full mx-auto space-y-6">
            
            {{-- Alertas de Sucesso --}}
            @if(session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl text-sm shadow-sm flex items-center justify-between">
                    <span>{{ session('success') }}</span>
                    <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700"><i class="bi bi-x-lg"></i></button>
                </div>
            @endif

            {{-- Título e Botão Adicionar Livro --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex flex-col gap-1">
                    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Gerir Livros</h1>
                    <p class="text-sm text-slate-500">{{ $totalLivros ?? $livros->total() }} livros cadastrados</p>
                </div>
                <button type="button" onclick="openCreateModal()" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-medium rounded-2xl shadow-lg shadow-slate-900/10 transition-all">
                    <i class="bi bi-plus-lg"></i> Adicionar Livro
                </button>
            </div>

            {{-- Formulário de Pesquisa --}}
            <form method="GET" action="{{ route('admin.livros') }}" class="bg-white p-4 rounded-2xl shadow-sm border border-slate-200/80 flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="relative w-full">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por título, autor ou categoria..." 
                           class="w-full pl-10 pr-4 py-2.5 bg-slate-100 border-none rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-orange-500 transition-all">
                </div>
            </form>

            {{-- Tabela de Livros --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-100 text-xs font-semibold text-slate-400 uppercase tracking-wider bg-slate-50/50">
                                <th class="py-4 px-6">Capa</th>
                                <th class="py-4 px-6">Título</th>
                                <th class="py-4 px-6">Autor</th>
                                <th class="py-4 px-6">Categoria</th>
                                <th class="py-4 px-6">Avaliação</th>
                                <th class="py-4 px-6">Status</th>
                                <th class="py-4 px-6 text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                            
                            @forelse($livros as$livro)
                                <tr class="hover:bg-slate-50/80 transition-colors">
                                    <td class="py-4 px-6">
                                        <div class="w-10 h-14 bg-slate-200 rounded-lg overflow-hidden shadow-sm flex items-center justify-center text-slate-400">
                                            @if(!empty($livro->capa_livro))
                                                <img src="{{ asset('storage/' . $livro->capa_livro) }}" alt="Capa" class="w-full h-full object-cover">
                                            @else
                                                <i class="bi bi-book"></i>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 font-semibold text-slate-900">{{ $livro->titulo_livro }}</td>
                                    <td class="py-4 px-6 text-slate-600">{{ $livro->autor_livro }}</td>
                                    <td class="py-4 px-6">
                                        <span class="inline-block px-2.5 py-1 text-xs font-medium bg-slate-100 text-slate-600 rounded-lg">
                                            {{ $livro->categoria_livro }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-slate-600">
                                        ⭐ {{ $livro->avaliacao_livro ?? '0.0' }}
                                    </td>
                                    <td class="py-4 px-6">
                                        @if($livro->status_livro === 'Emprestado')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-700">
                                                Emprestado
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                                                Disponível
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-right space-x-1">
                                        {{-- Botão Editar --}}
                                        <button type="button" onclick="openEditModal('{{ $livro->id_livro }}', '{{ addslashes($livro->titulo_livro) }}', '{{ addslashes($livro->autor_livro) }}', '{{ addslashes($livro->categoria_livro) }}', '{{ addslashes($livro->descricao_livro ?? '') }}', '{{ $livro->avaliacao_livro ?? 0 }}')" 
                                                class="p-2 text-slate-400 hover:text-orange-600 transition-colors" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </button>

                                        {{-- Botão Excluir --}}
                                        <form action="{{ route('admin.livros.destroy', $livro->id_livro) }}" method="POST" class="inline" onsubmit="return confirm('Tem a certeza absoluta que deseja eliminar o livro {{ $livro->titulo_livro }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-slate-400 hover:text-red-600 transition-colors" title="Eliminar">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-8 text-center text-slate-400">
                                        Nenhum livro encontrado.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                {{-- Paginação --}}
                <div class="py-4 px-6 border-t border-slate-100 flex items-center justify-between text-sm text-slate-500">
                    <div>
                        Mostrando {{ $livros->firstItem() ?? 0 }} até {{ $livros->lastItem() ?? 0 }} de {{$livros->total() }} livros
                    </div>
                    <div>
                        {{ $livros->links() }}
                    </div>
                </div>

            </div>

        </div>

    </main>
</div>

{{-- Modal de Adicionar / Editar Livro --}}
<div id="livroModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden">
    <div class="bg-white rounded-2xl p-6 w-full max-w-lg shadow-xl space-y-4 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center border-b pb-3">
            <h3 id="modalTitle" class="text-lg font-bold text-slate-900">Adicionar Livro</h3>
            <button onclick="closeLivroModal()" class="text-slate-400 hover:text-slate-600"><i class="bi bi-x-lg"></i></button>
        </div>
        
        <form id="livroForm" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">

            {{-- Campo Título com Botão de Consulta à API --}}
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Título do Livro</label>
                <div class="flex gap-2">
                    <input type="text" name="titulo_livro" id="titulo_livro" required class="w-full px-4 py-2 bg-slate-100 rounded-xl text-sm border-none focus:ring-2 focus:ring-orange-500">
                    <button type="button" onclick="buscarDadosLivroApi()" class="px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white rounded-xl text-xs font-medium transition-all whitespace-nowrap shadow-sm">
                        <i class="bi bi-magic"></i> Buscar API
                    </button>
                </div>
                <span id="apiLoading" class="text-xs text-orange-600 mt-1 hidden">A consultar API externa...</span>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Autor</label>
                <input type="text" name="autor_livro" id="autor_livro" required class="w-full px-4 py-2 bg-slate-100 rounded-xl text-sm border-none focus:ring-2 focus:ring-orange-500">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Categoria</label>
                <input type="text" name="categoria_livro" id="categoria_livro" required class="w-full px-4 py-2 bg-slate-100 rounded-xl text-sm border-none focus:ring-2 focus:ring-orange-500">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Capa do Livro (Upload)</label>
                <input type="file" name="capa_livro" accept="image/*" class="w-full px-4 py-2 bg-slate-100 rounded-xl text-sm border-none focus:ring-2 focus:ring-orange-500 file:mr-4 file:py-1 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Avaliação (0 a 5)</label>
                <input type="number" step="0.1" min="0" max="5" name="avaliacao_livro" id="avaliacao_livro" class="w-full px-4 py-2 bg-slate-100 rounded-xl text-sm border-none focus:ring-2 focus:ring-orange-500" placeholder="Ex: 4.5">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Descrição</label>
                <textarea name="descricao_livro" id="descricao_livro" rows="3" class="w-full px-4 py-2 bg-slate-100 rounded-xl text-sm border-none focus:ring-2 focus:ring-orange-500"></textarea>
            </div>

            <div class="flex justify-end gap-2 pt-4">
                <button type="button" onclick="closeLivroModal()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-sm font-medium">Cancelar</button>
                <button type="submit" class="px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-xl text-sm font-medium shadow-md shadow-orange-600/20">Salvar</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openCreateModal() {
        document.getElementById('modalTitle').innerText = 'Adicionar Livro';
        document.getElementById('livroForm').action = "{{ route('admin.livros.store') }}";
        document.getElementById('formMethod').value = 'POST';
        document.getElementById('titulo_livro').value = '';
        document.getElementById('autor_livro').value = '';
        document.getElementById('categoria_livro').value = '';
        document.getElementById('avaliacao_livro').value = '';
        document.getElementById('descricao_livro').value = '';
        document.getElementById('livroModal').classList.remove('hidden');
    }

    function openEditModal(id, titulo, autor, categoria, descricao, avaliacao) {
        document.getElementById('modalTitle').innerText = 'Editar Livro';
        document.getElementById('livroForm').action = '/admin/livros/' + id;
        document.getElementById('formMethod').value = 'PUT';
        document.getElementById('titulo_livro').value = titulo;
        document.getElementById('autor_livro').value = autor;
        document.getElementById('categoria_livro').value = categoria;
        document.getElementById('descricao_livro').value = descricao;
        document.getElementById('avaliacao_livro').value = avaliacao;
        document.getElementById('livroModal').classList.remove('hidden');
    }

    function closeLivroModal() {
        document.getElementById('livroModal').classList.add('hidden');
    }

    async function buscarDadosLivroApi() {
        const titulo = document.getElementById('titulo_livro').value;
        const loadingSpan = document.getElementById('apiLoading');

        if (!titulo) {
            alert('Por favor, digite o título do livro primeiro.');
            return;
        }

        loadingSpan.classList.remove('hidden');

        try {
            const response = await fetch(`/admin/livros/buscar-api?titulo=${encodeURIComponent(titulo)}`);
            const data = await response.json();

            if (response.ok) {
                document.getElementById('autor_livro').value = data.autor_livro;
                document.getElementById('categoria_livro').value = data.categoria_livro;
                document.getElementById('descricao_livro').value = data.descricao_livro;
                document.getElementById('avaliacao_livro').value = data.avaliacao_livro;
                alert('Dados preenchidos com sucesso pela API!');
            } else {
                alert(data.error || 'Livro não encontrado.');
            }
        } catch (error) {
            console.error('Erro:', error);
            alert('Ocorreu um erro ao consultar a API externa.');
        } finally {
            loadingSpan.classList.add('hidden');
        }
    }
</script>

</body>
</html>