@extends('layouts.app')

@section('title', 'Biblioteca de TCCs')

@section('content')

<div class="d-flex min-vh-100 bg-light">
    
    <div class="position-sticky top-0" style="height: 100vh; z-index: 100;">
        @include('usuario.sidebar')
    </div>

    <main class="flex-grow-1 overflow-y-auto" style="max-height: 100vh;">

        @include('usuario.navbar')
     
        <div class="p-4 p-md-5">

            <div class="mb-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background-color: #fdeee9; color: #E25C3C;">
                        <i class="bi bi-mortarboard-fill fs-4"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold text-dark mb-0 fs-3">Biblioteca de TCCs</h2>
                        <p class="text-muted mb-0 fs-6">{{ $tccs->count() }} trabalhos disponíveis</p>
                    </div>
                </div>
            </div>

            {{-- TCCs EM DESTAQUE --}}
            @if($destaques->count() > 0)
                <div class="mb-5">
                    <h4 class="fw-bold text-dark mb-3">
                        <i class="bi bi-star-fill text-warning me-1"></i> TCCs em Destaque
                    </h4>
                    
                    <div class="row g-4">
                        @foreach($destaques as $tcc)
                            <div class="col-12 col-md-4">
                                <div class="card bg-white border-0 shadow-sm rounded-4 overflow-hidden h-100 position-relative">
                                    <span class="position-absolute top-0 start-0 m-3 badge text-bg-warning text-dark fw-semibold px-2.5 py-1" style="z-index: 2;">
                                        <i class="bi bi-star-fill me-1"></i> Destaque
                                    </span>

                                    <div class="bg-dark position-relative" style="height: 160px;">
                                        @if(!empty($tcc->capa_tcc))
                                            <img src="{{ asset('storage/' . $tcc->capa_tcc) }}" alt="{{ $tcc->titulo_tcc }}" class="w-100 h-100 object-fit-cover opacity-75">
                                        @else
                                            <div class="w-100 h-100 d-flex align-items-center justify-content-center text-white bg-secondary opacity-50">
                                                <i class="bi bi-file-earmark-pdf fs-1"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                                        <div>
                                            <h5 class="fw-bold text-dark mb-2 text-truncate" title="{{ $tcc->titulo_tcc }}">{{ $tcc->titulo_tcc }}</h5>
                                            <p class="text-secondary small mb-1"><strong>Autor:</strong> {{ $tcc->autor_tcc }}</p>
                                            <p class="text-secondary small mb-1"><strong>Orientador:</strong> {{ $tcc->orientador_tcc }}</p>
                                            <p class="text-secondary small mb-3"><strong>Curso:</strong> {{ $tcc->curso_tcc }}</p>
                                            
                                            <div class="d-flex gap-2 mb-3">
                                                <span class="badge bg-light text-secondary border">{{ $tcc->turma_tcc }}</span>
                                                <span class="badge bg-light text-secondary border">{{ $tcc->ano_tcc }}</span>
                                            </div>
                                        </div>

                                        <div class="d-flex gap-2 mt-3 pt-3 border-top">
                                            <a href="{{ asset('storage/' . $tcc->arquivo_pdf) }}" target="_blank" class="btn btn-dark w-50 py-2 rounded-3 text-sm fw-medium">
                                                Visualizar
                                            </a>
                                            <a href="{{ route('usuario.tccs.download', $tcc->id_tcc) }}" class="btn text-white w-50 py-2 rounded-3 text-sm fw-medium" style="background: #E25C3C;">
                                                Download
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- BUSCAR E FILTRAR --}}
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                <h5 class="fw-bold text-dark mb-3">
                    <i class="bi bi-funnel me-1"></i> Buscar e Filtrar
                </h5>
                
                <form method="GET" action="{{ route('usuario.tccs') }}" class="row g-3">
                    
                    <div class="col-12">
                        <div class="d-flex gap-1 bg-light p-1 rounded-pill mb-3 d-inline-flex border">
                            <input type="radio" class="btn-check" name="tipo_busca" id="tipo_titulo" value="titulo" {{ request('tipo_busca', 'titulo') == 'titulo' ? 'checked' : '' }} onchange="this.form.submit()">
                            <label class="btn btn-sm rounded-pill px-4 {{ request('tipo_busca', 'titulo') == 'titulo' ? 'btn-dark text-white shadow-sm' : 'btn-light text-secondary border-0' }}" for="tipo_titulo">Título</label>

                            <input type="radio" class="btn-check" name="tipo_busca" id="tipo_autor" value="autor" {{ request('tipo_busca') == 'autor' ? 'checked' : '' }} onchange="this.form.submit()">
                            <label class="btn btn-sm rounded-pill px-4 {{ request('tipo_busca') == 'autor' ? 'btn-dark text-white shadow-sm' : 'btn-light text-secondary border-0' }}" for="tipo_autor">Autor</label>

                            <input type="radio" class="btn-check" name="tipo_busca" id="tipo_orientador" value="orientador" {{ request('tipo_busca') == 'orientador' ? 'checked' : '' }} onchange="this.form.submit()">
                            <label class="btn btn-sm rounded-pill px-4 {{ request('tipo_busca') == 'orientador' ? 'btn-dark text-white shadow-sm' : 'btn-light text-secondary border-0' }}" for="tipo_orientador">Orientador</label>

                            <input type="radio" class="btn-check" name="tipo_busca" id="tipo_turma" value="turma" {{ request('tipo_busca') == 'turma' ? 'checked' : '' }} onchange="this.form.submit()">
                            <label class="btn btn-sm rounded-pill px-4 {{ request('tipo_busca') == 'turma' ? 'btn-dark text-white shadow-sm' : 'btn-light text-secondary border-0' }}" for="tipo_turma">Turma</label>
                        </div>

                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-secondary"><i class="bi bi-search"></i></span>
                            <input type="text" name="busca" value="{{ request('busca') }}" class="form-control border-start-0 ps-0 shadow-none py-2" placeholder="Buscar por {{ request('tipo_busca', 'titulo') }}...">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small text-secondary fw-semibold">Curso</label>
                        <select name="curso" class="form-select rounded-3 bg-light border-0 py-2">
                            <option value="todos">Todos os cursos</option>
                            @foreach($cursos as $curso)
                                <option value="{{ $curso }}" {{ request('curso') == $curso ? 'selected' : '' }}>{{ $curso }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small text-secondary fw-semibold">Ano</label>
                        <select name="ano" class="form-select rounded-3 bg-light border-0 py-2">
                            <option value="todos">Todos os anos</option>
                            @foreach($anos as $ano)
                                <option value="{{ $ano }}" {{ request('ano') == $ano ? 'selected' : '' }}>{{ $ano }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small text-secondary fw-semibold">Turma</label>
                        <select name="turma_filtro" class="form-select rounded-3 bg-light border-0 py-2">
                            <option value="todos">Todas as turmas</option>
                            @foreach($turmas as $turma)
                                <option value="{{ $turma }}" {{ request('turma_filtro') == $turma ? 'selected' : '' }}>{{ $turma }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                        <a href="{{ route('usuario.tccs') }}" class="btn btn-light border px-4 py-2 rounded-3 text-secondary fw-medium">
                            Limpar Filtros
                        </a>
                        <button type="submit" class="btn text-white px-5 py-2 rounded-3 fw-medium" style="background: #E25C3C;">
                            Aplicar Filtros
                        </button>
                    </div>

                </form>
            </div>

            <div class="mb-3">
                <h5 class="fw-bold text-dark">{{ $tccs->count() }} resultados</h5>
            </div>

            {{-- LISTAGEM --}}
            <div class="row g-4">
                @forelse($tccs as $tcc)
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="card bg-white border-0 p-4 shadow-sm h-100 rounded-4 d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="badge bg-light text-secondary border">{{ $tcc->curso_tcc }}</span>
                                    <span class="text-muted small"><i class="bi bi-calendar-event me-1"></i>{{ $tcc->ano_tcc }}</span>
                                </div>

                                <h5 class="fw-bold text-dark mb-2">{{ $tcc->titulo_tcc }}</h5>
                                <p class="text-secondary small mb-1"><strong>Autor:</strong> {{ $tcc->autor_tcc }}</p>
                                <p class="text-secondary small mb-3"><strong>Orientador:</strong> {{ $tcc->orientador_tcc }}</p>
                                <p class="text-secondary small mb-3"><strong>Turma:</strong> {{ $tcc->turma_tcc }}</p>
                            </div>

                            <div class="d-flex gap-2 pt-3 border-top mt-3">
                                <a href="{{ asset('storage/' . $tcc->arquivo_pdf) }}" target="_blank" class="btn btn-dark w-50 py-2 rounded-3 text-sm fw-medium">
                                    Visualizar
                                </a>
                                <a href="{{ route('usuario.tccs.download', $tcc->id_tcc) }}" class="btn text-white w-50 py-2 rounded-3 text-sm fw-medium" style="background: #E25C3C;">
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="text-muted mb-2">
                            <i class="bi bi-mortarboard display-4 opacity-50"></i>
                        </div>
                        <h5 class="fw-bold text-dark">Nenhum TCC encontrado</h5>
                        <p class="text-muted small">Tente ajustar os termos da busca ou os filtros selecionados.</p>
                    </div>
                @endforelse
            </div>

        </div>

    </main>

</div>

@endsection