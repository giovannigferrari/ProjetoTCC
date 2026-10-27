@extends('layouts.app')

@section('title', 'Favoritos')

@section('content')

<div class="d-flex min-vh-100 bg-light">
    
    {{-- Sidebar Fixa --}}
    <div class="position-sticky top-0" style="height: 100vh; z-index: 100;">
        @include('usuario.sidebar')
    </div>

    {{-- Conteúdo Principal --}}
    <main class="flex-grow-1 overflow-y-auto" style="max-height: 100vh;">

        {{-- Navbar Superior --}}
        @include('usuario.navbar')
     
        {{-- Seção de Conteúdo --}}
        <div class="p-4 p-md-5">

            {{-- Cabeçalho da Seção --}}
            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background-color: #fdeee9; color: #E25C3C;">
                    <i class="bi bi-heart-fill fs-4"></i>
                </div>
                <div>
                    <h2 class="fw-bold text-dark mb-0 fs-3">Favoritos</h2>
                    <p class="text-muted mb-0 fs-6">{{ $favoritos->count() }} livros salvos</p>
                </div>
            </div>

            {{-- Formulário de Filtro e Busca (GET) --}}
            <form method="GET" action="{{ route('usuario.favoritos') }}" class="row g-3 align-items-center mb-4">
                
                {{-- Campo de Busca --}}
                <div class="col-12 col-md-4">
                    <div class="position-relative">
                        <i class="bi bi-search position-absolute text-muted top-50 translate-middle-y ms-3"></i>
                        <input type="text" name="busca" value="{{ request('busca') }}" class="form-control bg-white border ps-5 rounded-3 py-2" placeholder="Buscar nos favoritos...">
                    </div>
                </div>

                {{-- Filtros por Gênero (Pills dinâmicas) --}}
                <div class="col-12 col-md-8">
                    <div class="d-flex gap-2 overflow-auto pb-2 pb-md-0">
                        <input type="hidden" name="categoria" id="categoriaInput" value="{{ request('categoria', 'todos') }}">
                        
                        <button type="submit" onclick="document.getElementById('categoriaInput').value='todos'" 
                            class="btn {{ request('categoria', 'todos') == 'todos' ? 'btn-dark' : 'btn-white bg-white border text-secondary' }} rounded-pill px-4">
                            Todos
                        </button>

                        @foreach($categorias as $cat)
                            <button type="submit" onclick="document.getElementById('categoriaInput').value='{{ $cat->id }}'" 
                                class="btn {{ request('categoria') == $cat->id ? 'btn-dark' : 'btn-white bg-white border text-secondary' }} rounded-pill px-4 text-nowrap">
                                {{ $cat->nome }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </form>

            {{-- Grid de Cards de Livros Favoritos Dinâmicos --}}
            <div class="row g-4">
                @forelse($favoritos as $livro)
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="card bg-white border-0 p-3 shadow-sm position-relative h-100" style="border-radius: 1rem;">
                            
                            {{-- Botão de Remover dos Favoritos (Toggle corrigido para id_livro) --}}
                            <form action="{{ route('usuario.favoritos.toggle', $livro->id_livro) }}" method="POST" class="position-absolute top-0 end-0 m-4" style="z-index: 2;">
                                @csrf
                                <button type="submit" class="btn btn-light rounded-circle shadow-sm p-0 d-flex align-items-center justify-content-center text-danger border-0" style="width: 32px; height: 32px;" title="Remover dos favoritos">
                                    <i class="bi bi-heart-fill"></i>
                                </button>
                            </form>

                            {{-- Capa / Imagem --}}
                            <div class="rounded-3 bg-dark text-white d-flex align-items-center justify-content-center position-relative mb-3 overflow-hidden" style="height: 200px;">
                                @php
                                    $capa = $livro->capa_livro;
                                    if ($capa && filter_var($capa, FILTER_VALIDATE_URL)) {
                                        $capaUrl = $capa;
                                    } elseif ($capa) {
                                        $caminhoLimpo = ltrim(str_replace(['public/', '/public/'], '', $capa), '/');
                                        $capaUrl = asset($caminhoLimpo);
                                    } else {
                                        $capaUrl = null;
                                    }
                                @endphp

                                @if($capaUrl)
                                    <img src="{{ $capaUrl }}" alt="{{ $livro->titulo_livro }}" class="w-100 h-100 object-fit-cover">
                                @else
                                    <span class="text-muted small">Capa Indisponível</span>
                                @endif

                                <span class="position-absolute bottom-0 start-0 m-3 badge 
                                    @if(isset($livro->status_livro) && $livro->status_livro === 'Disponível') text-bg-success 
                                    @elseif(isset($livro->status_livro) && $livro->status_livro === 'Reservado') text-bg-warning 
                                    @else text-bg-danger @endif px-2 py-1">
                                    {{ $livro->status_livro ?? 'Disponível' }}
                                </span>
                            </div>

                            {{-- Informações do Livro --}}
                            <h6 class="fw-bold text-dark mb-1 text-truncate" title="{{ $livro->titulo_livro }}">{{ $livro->titulo_livro }}</h6>
                            <p class="text-muted small mb-3 text-truncate">{{ $livro->autor_livro }}</p>

                            {{-- Avaliação --}}
                            <div class="mt-auto d-flex align-items-center gap-1 text-warning small fw-bold">
                                <i class="bi bi-star-fill"></i>
                                <span>{{ number_format($livro->avaliacao_livro ?? 4.8, 1, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="text-muted mb-2">
                            <i class="bi bi-heart display-4 opacity-50"></i>
                        </div>
                        <h5 class="fw-bold text-dark">Nenhum livro nos favoritos</h5>
                        <p class="text-muted small">Explore a biblioteca e favorite os livros que deseja acompanhar.</p>
                    </div>
                @endforelse
            </div>

        </div>

    </main>

</div>

@endsection