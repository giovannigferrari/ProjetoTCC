<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BIBLIO-TEK - Gerenciar Usuários</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-slate-50 font-sans antialiased">

<div class="flex min-h-screen bg-slate-50">
    
    {{-- Incluindo o Sidebar existente --}}
    @include('admin.sidebar')

    {{-- Conteúdo Principal --}}
    <main class="flex-1 flex flex-col min-w-0">
        
        {{-- Barra Superior (Header) --}}
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

        {{-- Container da Página --}}
        <div class="p-8 max-w-7xl w-full mx-auto space-y-6">
            
            {{-- Alertas de Sucesso ou Erro --}}
            @if(session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl text-sm shadow-sm flex items-center justify-between">
                    <span>{{ session('success') }}</span>
                    <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700"><i class="bi bi-x-lg"></i></button>
                </div>
            @endif

            @if(session('error'))
                <div class="p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-2xl text-sm shadow-sm flex items-center justify-between">
                    <span>{{ session('error') }}</span>
                    <button type="button" onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700"><i class="bi bi-x-lg"></i></button>
                </div>
            @endif

            {{-- Título da Seção --}}
            <div class="flex flex-col gap-1">
                <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Usuários</h1>
                <p class="text-sm text-slate-500">{{ $totalUsers ?? $users->total() }} usuários cadastrados</p>
            </div>

            {{-- Formulário de Busca e Filtros --}}
            <form method="GET" action="{{ route('admin.usuarios') }}" class="bg-white p-4 rounded-2xl shadow-sm border border-slate-200/80 flex flex-col md:flex-row items-center justify-between gap-4">
                
                {{-- Input de Pesquisa --}}
                <div class="relative w-full md:w-96">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por nome, email ou turma..." 
                           class="w-full pl-10 pr-4 py-2.5 bg-slate-100 border-none rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-orange-500 transition-all">
                </div>

                {{-- Filtros --}}
                <div class="flex items-center gap-2 w-full md:w-auto overflow-x-auto pb-2 md:pb-0">
                    <button type="submit" name="status" value="" class="px-4 py-2 {{ request('status') === null ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }} rounded-xl text-sm font-medium transition-all">Todos</button>
                    <button type="submit" name="status" value="Ativo" class="px-4 py-2 {{ request('status') === 'Ativo' ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }} rounded-xl text-sm font-medium transition-all">Ativos</button>
                    <button type="submit" name="status" value="Suspenso" class="px-4 py-2 {{ request('status') === 'Suspensos' || request('status') === 'Suspenso' ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }} rounded-xl text-sm font-medium transition-all">Suspensos</button>
                </div>

            </form>

            {{-- Tabela de Usuários --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-100 text-xs font-semibold text-slate-400 uppercase tracking-wider bg-slate-50/50">
                                <th class="py-4 px-6">Usuário</th>
                                <th class="py-4 px-6">Turma</th>
                                <th class="py-4 px-6">Email</th>
                                <th class="py-4 px-6">Status</th>
                                <th class="py-4 px-6">Empréstimos</th>
                                <th class="py-4 px-6 text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                            
                            @forelse($users as $user)
                                @php
                                    $names = explode(' ', $user->nome_usuario ?? 'Usuário');
                                    $initials = strtoupper(substr($names[0], 0, 1) . (isset($names[1]) ? substr($names[1], 0, 1) : ''));
                                @endphp
                                <tr class="hover:bg-slate-50/80 transition-colors">
                                    <td class="py-4 px-6 flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-orange-500 text-white font-bold flex items-center justify-center text-xs shadow-sm">
                                            {{ $initials }}
                                        </div>
                                        <div>
                                            <span class="font-semibold text-slate-900 block">{{ $user->nome_usuario }}</span>
                                            @if($user->tipo_usuario === 'Admin')
                                                <span class="inline-block px-2 py-0.5 text-[10px] font-bold bg-orange-100 text-orange-700 rounded-md mt-0.5">Admin</span>
                                            @else
                                                <span class="inline-block px-2 py-0.5 text-[10px] font-medium bg-slate-100 text-slate-600 rounded-md mt-0.5">Usuário</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-slate-600">{{ $user->turma ?? 'N/A' }}</td>
                                    <td class="py-4 px-6 text-slate-600">{{ $user->email_usuario }}</td>
                                    <td class="py-4 px-6">
                                        @if($user->status_usuario == 'Suspenso')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-rose-100 text-rose-700">
                                                Suspenso
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                                                Ativo
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 font-semibold text-slate-900">
                                        {{ $user->emprestimos_count ?? 0 }}
                                    </td>
                                    <td class="py-4 px-6 text-right space-x-1">
                                        @if($user->tipo_usuario === 'Admin')
                                            <span class="text-xs text-slate-400 italic bg-slate-100 px-3 py-1.5 rounded-lg">Protegido</span>
                                        @else
                                            {{-- Botão Editar --}}
                                            <button type="button" onclick="openEditModal('{{ $user->id_usuario }}', '{{ $user->nome_usuario }}', '{{ $user->email_usuario }}', '{{ $user->turma }}')" 
                                                    class="p-2 text-slate-400 hover:text-orange-600 transition-colors" title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </button>

                                            {{-- Botão Suspender ou Ativar --}}
                                            @if($user->status_usuario === 'Suspenso')
                                                <form action="{{ route('admin.usuarios.toggleStatus', $user->id_usuario) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="p-2 text-slate-400 hover:text-emerald-600 transition-colors" title="Ativar Usuário">
                                                        <i class="bi bi-check-circle"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <button type="button" onclick="openSuspendModal('{{ $user->id_usuario }}', '{{ addslashes($user->nome_usuario) }}')" 
                                                        class="p-2 text-slate-400 hover:text-amber-600 transition-colors" title="Suspender Usuário">
                                                    <i class="bi bi-slash-circle"></i>
                                                </button>
                                            @endif

                                            {{-- Botão Excluir --}}
                                            <form action="{{ route('admin.usuarios.destroy', $user->id_usuario) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza absoluta que deseja eliminar o usuário {{ $user->nome_usuario }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-slate-400 hover:text-red-600 transition-colors" title="Eliminar">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-8 text-center text-slate-400">
                                        Nenhum usuário encontrado.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                {{-- Rodapé / Paginação --}}
                <div class="py-4 px-6 border-t border-slate-100 flex items-center justify-between text-sm text-slate-500">
                    <div>
                        Mostrando {{ $users->firstItem() ?? 0 }} até {{ $users->lastItem() ?? 0 }} de {{ $users->total() }} usuários
                    </div>
                    <div>
                        {{ $users->links() }}
                    </div>
                </div>

            </div>

        </div>

    </main>
</div>

{{-- Modal de Edição de Usuário --}}
<div id="editModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden">
    <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-xl space-y-4">
        <div class="flex justify-between items-center border-b pb-3">
            <h3 class="text-lg font-bold text-slate-900">Editar Usuário</h3>
            <button onclick="closeEditModal()" class="text-slate-400 hover:text-slate-600"><i class="bi bi-x-lg"></i></button>
        </div>
        
        <form id="editForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Nome</label>
                <input type="text" name="nome_usuario" id="edit_nome" required class="w-full px-4 py-2 bg-slate-100 rounded-xl text-sm border-none focus:ring-2 focus:ring-orange-500">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Email</label>
                <input type="email" name="email_usuario" id="edit_email" required class="w-full px-4 py-2 bg-slate-100 rounded-xl text-sm border-none focus:ring-2 focus:ring-orange-500">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Turma</label>
                <input type="text" name="turma" id="edit_turma" class="w-full px-4 py-2 bg-slate-100 rounded-xl text-sm border-none focus:ring-2 focus:ring-orange-500">
            </div>

            <div class="flex justify-end gap-2 pt-4">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-sm font-medium">Cancelar</button>
                <button type="submit" class="px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-xl text-sm font-medium shadow-md shadow-orange-600/20">Salvar Alterações</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal de Tempo de Suspensão --}}
<div id="suspendModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden">
    <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-xl space-y-4">
        <div class="flex justify-between items-center border-b pb-3">
            <h3 class="text-lg font-bold text-slate-900">Suspender Usuário</h3>
            <button onclick="closeSuspendModal()" class="text-slate-400 hover:text-slate-600"><i class="bi bi-x-lg"></i></button>
        </div>
        
        <form id="suspendForm" method="POST" class="space-y-4">
            @csrf
            @method('PATCH')

            <p class="text-sm text-slate-600">Selecione o tempo de suspensão para <strong id="suspendUserName" class="text-slate-900"></strong>:</p>

            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Duração da Suspensão</label>
                <select name="duracao" required class="w-full px-4 py-2 bg-slate-100 rounded-xl text-sm border-none focus:ring-2 focus:ring-orange-500 text-slate-800">
                    <option value="3">3 dias</option>
                    <option value="7" selected>7 dias</option>
                    <option value="15">15 dias</option>
                    <option value="30">30 dias</option>
                    <option value="permanent">Indefinido / Permanente</option>
                </select>
            </div>

            <div class="flex justify-end gap-2 pt-4">
                <button type="button" onclick="closeSuspendModal()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-sm font-medium">Cancelar</button>
                <button type="submit" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-xl text-sm font-medium shadow-md shadow-amber-600/20">Confirmar Suspensão</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(id, nome, email, turma) {
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editForm').action = '/admin/usuarios/' + id;
        document.getElementById('edit_nome').value = nome;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_turma').value = turma === 'N/A' ? '' : turma;
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    function openSuspendModal(id, nome) {
        document.getElementById('suspendModal').classList.remove('hidden');
        document.getElementById('suspendForm').action = '/admin/usuarios/' + id + '/suspender';
        document.getElementById('suspendUserName').innerText = nome;
    }

    function closeSuspendModal() {
        document.getElementById('suspendModal').classList.add('hidden');
    }
</script>

</body>
</html>