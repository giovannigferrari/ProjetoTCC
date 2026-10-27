<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BIBLIO-TEK - Dashboard</title>
    <!-- Tailwind CSS & Ícones do Bootstrap -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Bootstrap CSS (caso precise para os cards/grid) se estiver usando no projeto -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans antialiased">

    <!-- Container Flexbox (Sidebar + Conteúdo Lado a Lado) -->
    <div class="flex min-h-screen">
        
        @include('admin.sidebar')

        <!-- Conteúdo Principal à Direita -->
        <div class="flex-1 flex flex-col">
            
            <!-- Cabeçalho Superior -->
            <header class="bg-white border-b border-gray-200 px-8 py-4 flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <span class="w-1 h-5 bg-orange-600 rounded-full"></span>
                    <h1 class="text-sm font-semibold text-gray-800">Dashboard</h1>
                </div>
                <div class="flex items-center gap-4">
                    <span class="bg-orange-600 text-white text-xs px-3 py-1.5 rounded-full font-medium">Administrador</span>
                    <a href="#" class="text-sm text-gray-500 hover:text-gray-700">Sair</a>
                </div>
            </header>

            <!-- Área de Conteúdo da Home -->
            <main class="p-8 flex-1">
                <!-- Título da Seção -->
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Dashboard</h2>
                    <p class="text-sm text-gray-500">Visão geral do sistema — maio 2024</p>
                </div>

                <!-- Grid dos Cards (1º Bloco) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <!-- Card 1: Livros Cadastrados -->
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex justify-between items-start">
                        <div>
                            <span class="text-4xl font-extrabold text-indigo-950 block">847</span>
                            <p class="text-sm font-semibold text-gray-700 mt-1">Livros Cadastrados</p>
                            <span class="text-xs text-gray-400 mt-2 block">+12 este mês</span>
                        </div>
                        <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl">
                            <i class="bi bi-book text-xl"></i>
                        </div>
                    </div>

                    <!-- Card 2: Usuários Ativos -->
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex justify-between items-start">
                        <div>
                            <span class="text-4xl font-extrabold text-orange-600 block">312</span>
                            <p class="text-sm font-semibold text-gray-700 mt-1">Usuários Ativos</p>
                            <span class="text-xs text-gray-400 mt-2 block">+8 esta semana</span>
                        </div>
                        <div class="p-3 bg-orange-50 text-orange-600 rounded-xl">
                            <i class="bi bi-person text-xl"></i>
                        </div>
                    </div>

                    <!-- Card 3: Empréstimos Ativos -->
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex justify-between items-start">
                        <div>
                            <span class="text-4xl font-extrabold text-indigo-950 block">89</span>
                            <p class="text-sm font-semibold text-gray-700 mt-1">Empréstimos Ativos</p>
                            <span class="text-xs text-gray-400 mt-2 block">+5 hoje</span>
                        </div>
                        <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl">
                            <i class="bi bi-arrow-left-right text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Grid dos Cards (2º Bloco) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Card 4: Pendências -->
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex justify-between items-start">
                        <div>
                            <span class="text-4xl font-extrabold text-orange-600 block">14</span>
                            <p class="text-sm font-semibold text-gray-700 mt-1">Pendências</p>
                            <span class="text-xs text-gray-400 mt-2 block">↓ 3 resolvidas</span>
                        </div>
                        <div class="p-3 bg-orange-50 text-orange-600 rounded-xl">
                            <i class="bi bi-exclamation-circle text-xl"></i>
                        </div>
                    </div>

                    <!-- Card 5: TCCs Cadastrados -->
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex justify-between items-start">
                        <div>
                            <span class="text-4xl font-extrabold text-emerald-600 block">156</span>
                            <p class="text-sm font-semibold text-gray-700 mt-1">TCCs Cadastrados</p>
                            <span class="text-xs text-gray-400 mt-2 block">+2 este mês</span>
                        </div>
                        <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl">
                            <i class="bi bi-mortarboard text-xl"></i>
                        </div>
                    </div>

                    <!-- Card 6: Reservas Ativas -->
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex justify-between items-start">
                        <div>
                            <span class="text-4xl font-extrabold text-indigo-950 block">23</span>
                            <p class="text-sm font-semibold text-gray-700 mt-1">Reservas Ativas</p>
                            <span class="text-xs text-gray-400 mt-2 block">+4 hoje</span>
                        </div>
                        <div class="p-3 bg-purple-50 text-purple-600 rounded-xl">
                            <i class="bi bi-bookmark text-xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Seção de Acervo de Livros por Categoria com Botão de Favoritar -->
                <div class="mt-10">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Acervo de Livros</h3>

                    @if(isset($livrosPorCategoria) && count($livrosPorCategoria) > 0)
                        @foreach($livrosPorCategoria as $categoriaNome => $livrosDaCategoria)
                            <div class="mb-8">
                                <h4 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">{{ $categoriaNome }}</h4>
                                
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                                    @foreach($livrosDaCategoria as $livro)
                                        <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm relative flex flex-col justify-between">
                                            
                                            <!-- Botão de Favoritar (Coração) -->
                                            <form action="{{ route('usuario.favoritos.toggle', $livro->id) }}" method="POST" class="absolute top-3 right-3 z-10">
                                                @csrf
                                                <button type="submit" class="w-8 h-8 bg-white rounded-full shadow-md flex items-center justify-center border-0 hover:bg-gray-50 transition" title="Favoritar">
                                                    <i class="bi {{ $livro->favorito ? 'bi-heart-fill text-red-500' : 'bi-heart text-gray-400' }}"></i>
                                                </button>
                                            </form>

                                            <div>
                                                <h5 class="font-bold text-gray-900 text-base mb-1 truncate pr-8" title="{{ $livro->titulo }}">{{ $livro->titulo }}</h5>
                                                <p class="text-xs text-gray-500 mb-3">{{ $livro->autor }}</p>
                                            </div>

                                            <div class="flex items-center justify-between mt-4">
                                                <span class="text-xs px-2.5 py-1 rounded-full font-medium {{ ($livro->quantidade_disponivel ?? 1) > 0 ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600' }}">
                                                    {{ ($livro->quantidade_disponivel ?? 1) > 0 ? 'Disponível' : 'Indisponível' }}
                                                </span>
                                            </div>

                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-sm text-gray-500">Nenhum livro cadastrado no momento.</p>
                    @endif
                </div>

            </main>
        </div>

    </div>

</body>
</html>