@extends('layouts.app')

@section('title', 'Meu Perfil')

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
     
        <div class="p-4 p-md-5">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- HEADER / BANNER DO PERFIL --}}
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 bg-white">
                {{-- Banner superior escuro --}}
                <div class="position-relative bg-dark" style="height: 140px; background: linear-gradient(135deg, #090D28 0%, #1a237e 100%);"></div>
                
                <div class="card-body px-4 pt-0 pb-4 position-relative">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-end">
                        
                        {{-- Foto de Perfil / Avatar --}}
                        <div class="d-flex align-items-end gap-3" style="margin-top: -50px;">
                            <div class="position-relative">
                                @if(!empty($usuario->avatar))
                                    <img src="{{ asset('storage/' . $usuario->avatar) }}" alt="{{ $usuario->name }}" class="rounded-circle border border-4 border-white shadow object-fit-cover bg-white" style="width: 100px; height: 100px;">
                                @else
                                    <div class="rounded-circle border border-4 border-white shadow bg-primary text-white d-flex align-items-center justify-content-center fw-bold fs-2" style="width: 100px; height: 100px;">
                                        {{ strtoupper(substr($usuario->name, 0, 2)) }}
                                    </div>
                                @endif
                            </div>
                            <div class="mb-1">
                                <h3 class="fw-bold text-dark mb-0">{{ $usuario->name }}</h3>
                                <p class="text-muted small mb-0">
                                    <i class="bi bi-envelope me-1"></i>{{ $usuario->email }} &bull; 
                                    <span class="badge bg-light text-secondary border ms-1">{{ $usuario->turma ?? 'Turma não informada' }}</span>
                                </p>
                            </div>
                        </div>

                        {{-- Botão Editar Perfil --}}
                        <div class="mt-3 mt-md-0">
                            <button type="button" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-medium text-sm" data-bs-toggle="modal" data-bs-target="#modalEditarPerfil">
                                <i class="bi bi-pencil me-1"></i> Editar perfil
                            </button>
                        </div>

                    </div>
                </div>
            </div>

            {{-- CARDS DE ESTATÍSTICAS (Empréstimos, Favoritos, TCCs Enviados) --}}
            <div class="row g-4 mb-5">
                <div class="col-12 col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 text-center bg-white h-100">
                        <div class="text-secondary mb-2">
                            <i class="bi bi-journal-bookmark fs-3"></i>
                        </div>
                        <h2 class="fw-bold text-dark mb-1">{{ $totalEmprestimos }}</h2>
                        <p class="text-muted small mb-0">Empréstimos ativos</p>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 text-center bg-white h-100">
                        <div class="text-danger mb-2">
                            <i class="bi bi-heart fs-3"></i>
                        </div>
                        <h2 class="fw-bold text-dark mb-1">{{ $totalFavoritos }}</h2>
                        <p class="text-muted small mb-0">Favoritos salvos</p>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 text-center bg-white h-100">
                        <div class="text-warning mb-2">
                            <i class="bi bi-mortarboard fs-3"></i>
                        </div>
                        <h2 class="fw-bold text-dark mb-1">{{ $totalTccs }}</h2>
                        <p class="text-muted small mb-0">TCCs Enviados</p>
                    </div>
                </div>
            </div>

            {{-- SEÇÕES INFERIORES: ÚLTIMOS FAVORITOS E TCCS ENVIADOS --}}
            <div class="row g-4">
                
                {{-- Últimos Favoritos --}}
                <div class="col-12 col-lg-6">
                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold text-dark mb-0">Últimos Favoritos</h5>
                            <a href="{{ route('usuario.favoritos') }}" class="text-decoration-none small fw-semibold" style="color: #E25C3C;">Ver todos</a>
                        </div>

                        @forelse($ultimosFavoritos as $fav)
                            <div class="d-flex align-items-center justify-content-between py-2 border-bottom">
                                <span class="text-dark small fw-medium">{{ $fav->livro->titulo ?? 'Livro favorito' }}</span>
                                <span class="badge bg-light text-secondary">Salvo</span>
                            </div>
                        @empty
                            <div class="text-center py-4 text-muted small">
                                <i class="bi bi-heart fs-3 d-block mb-1 opacity-50"></i>
                                Nenhum favorito ainda.
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- TCCs Enviados --}}
                <div class="col-12 col-lg-6">
                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold text-dark mb-0">TCCs Enviados</h5>
                            <a href="{{ route('usuario.tccs') }}" class="text-decoration-none small fw-semibold" style="color: #E25C3C;">Ver biblioteca</a>
                        </div>

                        @forelse($ultimosTccs as $tcc)
                            <div class="d-flex align-items-center gap-3 py-2 border-bottom">
                                <div class="bg-light rounded p-2 text-secondary">
                                    <i class="bi bi-file-earmark-pdf fs-5"></i>
                                </div>
                                <div class="overflow-hidden">
                                    <h6 class="text-dark small fw-bold mb-0 text-truncate">{{ $tcc->titulo_tcc }}</h6>
                                    <p class="text-muted small mb-0" style="font-size: 0.8rem;">{{ $tcc->ano_tcc }} - {{ $tcc->curso_tcc }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4 text-muted small">
                                <i class="bi bi-mortarboard fs-3 d-block mb-1 opacity-50"></i>
                                Nenhum TCC enviado.
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

        </div>

    </main>

</div>

{{-- MODAL DE EDITAR PERFIL --}}
<div class="modal fade" id="modalEditarPerfil" tabindex="-1" aria-labelledby="modalEditarPerfilLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow">
            <form action="{{ route('usuario.perfil.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-dark" id="modalEditarPerfilLabel">Editar Perfil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body py-4">
                    <div class="mb-3">
                        <label class="form-label small text-secondary fw-semibold">Nome Completo</label>
                        <input type="text" name="name" class="form-control rounded-3" value="{{ $usuario->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small text-secondary fw-semibold">E-mail</label>
                        <input type="email" name="email" class="form-control rounded-3" value="{{ $usuario->email }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small text-secondary fw-semibold">Turma</label>
                        <input type="text" name="turma" class="form-control rounded-3" value="{{ $usuario->turma }}" placeholder="Ex: 3ºA - Ensino Médio">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small text-secondary fw-semibold">Foto de Perfil (Avatar)</label>
                        <input type="file" name="avatar" class="form-control rounded-3">
                    </div>
                </div>

                <div class="modal-header border-0 pt-0 pb-3 justify-content-end gap-2">
                    <button type="button" class="btn btn-light rounded-3 px-4" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn text-white rounded-3 px-4" style="background: #E25C3C;">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection