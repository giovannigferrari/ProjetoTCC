@extends('layouts.app')

@section('title', 'Início')

@section('content')

<div class="d-flex min-vh-100 bg-light">
    <div class="position-sticky top-0"style="height: 100vh;">
    @include('partials.sidebar')
    </div>
    <main class="flex-grow-1 overflow-hidden">

        @include('partials.navbar')

        <div class="container-fluid px-4 py-4">

            {{-- CARROSSEL PRINCIPAL --}}
            <div id="heroCarousel"
                 class="carousel slide rounded-4 overflow-hidden mb-4 shadow-sm"
                 data-bs-ride="carousel"
                 data-bs-interval="5000">

                <div class="carousel-indicators mb-3">
                    @for($i = 0; $i < 3; $i++)
                        <button type="button"
                                data-bs-target="#heroCarousel"
                                data-bs-slide-to="{{ $i }}"
                                class="{{ $i === 0 ? 'active' : '' }}"
                                aria-label="Slide {{ $i + 1 }}"></button>
                    @endfor
                </div>

                @php
                    $slides = [
                        [
                            'imagem' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2000&auto=format&fit=crop',
                            'titulo' => 'TCCs em Destaque',
                            'texto' => 'Confira os trabalhos acadêmicos mais acessados pelos alunos este semestre.',
                            'botao' => 'Ver TCCs',
                            'link' => '#tcc',
                            'cor' => '#E25C3C'
                        ],
                        [
                            'imagem' => 'https://images.unsplash.com/photo-1507842217343-583bb7270b66?q=80&w=2000&auto=format&fit=crop',
                            'titulo' => 'Livros Recomendados',
                            'texto' => 'Explore as novas adições do catálogo de leitura complementar para este mês.',
                            'botao' => 'Explorar',
                            'link' => '#acervo',
                            'cor' => '#E25C3C'
                        ],
                        [
                            'imagem' => 'https://images.unsplash.com/photo-1456324504439-367cee3b3c32?q=80&w=2000&auto=format&fit=crop',
                            'titulo' => 'Conheça nosso Acervo',
                            'texto' => 'Encontre livros, artigos e materiais acadêmicos para complementar seus estudos.',
                            'botao' => 'Ver Acervo',
                            'link' => '#acervo',
                            'cor' => '#E25C3C'
                        ]
                    ];
                @endphp

                <div class="carousel-inner" style="height:340px;">

                    @foreach($slides as $index => $slide)

                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }} h-100">

                            <div class="h-100"
                                 style="
                                    background:
                                    linear-gradient(
                                        to right,
                                        rgba(20,15,30,.92),
                                        rgba(20,15,30,.35)
                                    ),
                                    url('{{ $slide['imagem'] }}') center/cover;
                                 ">

                                <div class="h-100 d-flex flex-column justify-content-center p-5 text-white"
                                     style="max-width:640px; margin-left:40px;">

                                    <h1 class="display-6 fw-bold mb-3">
                                        {{ $slide['titulo'] }}
                                    </h1>

                                    <p class="fs-6 opacity-75 mb-4"
                                       style="max-width:400px;">
                                        {{ $slide['texto'] }}
                                    </p>

                                    <a href="{{ $slide['link'] }}"
                                       class="btn text-white px-4 py-2 rounded-3 fw-medium align-self-start"
                                       style="background:{{ $slide['cor'] }}; border:0;">
                                        {{ $slide['botao'] }}
                                    </a>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

                <button class="carousel-control-prev"
                        type="button"
                        data-bs-target="#heroCarousel"
                        data-bs-slide="prev">

                    <span class="btn rounded-circle d-flex align-items-center justify-content-center p-0"
                          style="width:40px;height:40px;background:rgba(255,255,255,.15);">

                        <i class="bi bi-chevron-left text-white"></i>

                    </span>

                </button>

                <button class="carousel-control-next"
                        type="button"
                        data-bs-target="#heroCarousel"
                        data-bs-slide="next">

                    <span class="btn rounded-circle d-flex align-items-center justify-content-center p-0"
                          style="width:40px;height:40px;background:rgba(255,255,255,.15);">

                        <i class="bi bi-chevron-right text-white"></i>

                    </span>

                </button>

            </div>


            {{-- CARDS DE RESUMO --}}
            <section id="acervo" class="mb-5">

                @php
                    $resumos = [
                        [
                            'icone' => 'bi-book',
                            'titulo' => 'Acervo Total',
                            'valor' => $livrosPorCategoria->flatten()->count() . ' livros',
                            'fundo' => '#F8F9FA',
                            'cor' => '#6c757d'
                        ],
                        [
                            'icone' => 'bi-graph-up-arrow',
                            'titulo' => 'Em Alta',
                            'valor' => '23 reservas hoje',
                            'fundo' => '#FFF5F5',
                            'cor' => '#dc3545'
                        ],
                        [
                            'icone' => 'bi-stars',
                            'titulo' => 'Novidades',
                            'valor' => '12 novos títulos',
                            'fundo' => '#F0F4FF',
                            'cor' => '#0d6efd'
                        ]
                    ];
                @endphp

                <div class="row g-4">

                    @foreach($resumos as $resumo)

                        <div class="col-xl-4 col-md-6">

                            <div class="card border-0 shadow-sm rounded-4 h-100">

                                <div class="card-body p-4 d-flex align-items-center gap-3">

                                    <div class="border rounded-3 d-flex align-items-center justify-content-center"
                                         style="
                                            width:50px;
                                            height:50px;
                                            background:{{ $resumo['fundo'] }};
                                         ">

                                        <i class="bi {{ $resumo['icone'] }} fs-5"
                                           style="color:{{ $resumo['cor'] }};"></i>

                                    </div>

                                    <div>

                                        <span class="text-secondary small fw-medium">
                                            {{ $resumo['titulo'] }}
                                        </span>

                                        <h5 class="fw-bold mb-0 text-dark">
                                            {{ $resumo['valor'] }}
                                        </h5>

                                    </div>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            </section>


            {{-- LIVROS POR CATEGORIA --}}
            <div id="tcc">

                @forelse($livrosPorCategoria as $categoria => $livros)

                    <section class="mb-5">

                        {{-- CABEÇALHO --}}
                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <div>

                                <h2 class="fw-bold mb-1">
                                    {{ $categoria }}
                                </h2>

                                <small class="text-secondary">
                                    {{ $livros->unique('id_livro')->count() }} livros disponíveis
                                </small>

                            </div>

                            <div class="d-flex gap-2">

                                <button type="button"
                                        class="btn btn-sm bg-white rounded-circle shadow-sm border-0 categoria-prev"
                                        style="width:35px;height:35px;"
                                        aria-label="Livros anteriores">

                                    <i class="bi bi-chevron-left text-secondary"></i>

                                </button>

                                <button type="button"
                                        class="btn btn-sm bg-white rounded-circle shadow-sm border-0 categoria-next"
                                        style="width:35px;height:35px;"
                                        aria-label="Próximos livros">

                                    <i class="bi bi-chevron-right text-secondary"></i>

                                </button>

                            </div>

                        </div>


                        {{-- CARROSSEL DOS LIVROS --}}
                        <div class="categoria-carousel d-flex gap-3 overflow-auto pb-3"
                             style="
                                scrollbar-width:none;
                                -ms-overflow-style:none;
                                scroll-behavior:smooth;
                             ">

                            @foreach($livros->unique('id_livro') as $livro)

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

                                <div class="card border-0 shadow-sm rounded-4 flex-shrink-0 overflow-hidden"
                                     style="width:190px;">

                                    {{-- CAPA --}}
                                    <div class="position-relative"
                                         style="height:250px;">

                                        @if($capaUrl)

                                            <img src="{{ $capaUrl }}"
                                                 class="w-100 h-100"
                                                 style="object-fit:cover;"
                                                 alt="{{ $livro->titulo_livro }}"
                                                 onerror="this.style.display='none'; this.nextElementSibling.classList.remove('d-none');">

                                            <div class="d-none h-100 bg-light align-items-center justify-content-center">

                                                <i class="bi bi-book text-secondary"
                                                   style="font-size:55px;"></i>

                                            </div>

                                        @else

                                            <div class="h-100 bg-light d-flex align-items-center justify-content-center">

                                                <i class="bi bi-book text-secondary"
                                                   style="font-size:55px;"></i>

                                            </div>

                                        @endif


                                        {{-- STATUS --}}
                                        <span class="position-absolute top-0 start-0 m-2 badge rounded-pill
                                            @if($livro->status_livro === 'Disponível')
                                                text-bg-success
                                            @elseif($livro->status_livro === 'Reservado')
                                                text-bg-warning
                                            @else
                                                text-bg-danger
                                            @endif">

                                            {{ $livro->status_livro }}

                                        </span>


                                        {{-- FAVORITO --}}
                                        <button type="button"
                                                class="favorito-btn btn bg-white rounded-circle shadow-sm
                                                       position-absolute top-0 end-0 m-2
                                                       d-flex align-items-center justify-content-center"
                                                style="width:35px;height:35px;"
                                                aria-label="Adicionar aos favoritos">

                                            <i class="bi bi-heart text-secondary"></i>

                                        </button>

                                    </div>


                                    {{-- INFORMAÇÕES --}}
                                    <div class="card-body p-3">

                                        <h6 class="fw-bold mb-1"
                                            style="
                                                min-height:40px;
                                                display:-webkit-box;
                                                -webkit-line-clamp:2;
                                                -webkit-box-orient:vertical;
                                                overflow:hidden;
                                            ">

                                            {{ $livro->titulo_livro }}

                                        </h6>

                                        <p class="text-secondary small mb-2 text-truncate">

                                            {{ $livro->autor_livro }}

                                        </p>

                                        <div class="d-flex align-items-center gap-1">

                                            <i class="bi bi-star-fill text-warning"></i>

                                            <small class="fw-semibold">

                                                {{ number_format($livro->avaliacao_livro, 1, ',', '.') }}

                                            </small>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </section>

                @empty

                    {{-- NENHUM LIVRO --}}
                    <div class="text-center py-5">

                        <i class="bi bi-book text-secondary"
                           style="font-size:70px;"></i>

                        <h3 class="fw-bold mt-3">
                            Nenhum livro encontrado
                        </h3>

                        <p class="text-secondary">
                            Ainda não existem livros cadastrados na biblioteca.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </main>

</div>


{{-- JAVASCRIPT --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    // Navegação das categorias
    document.querySelectorAll('section').forEach(function (section) {

        const carousel = section.querySelector('.categoria-carousel');
        const prev = section.querySelector('.categoria-prev');
        const next = section.querySelector('.categoria-next');

        if (!carousel) return;

        next?.addEventListener('click', function () {
            carousel.scrollBy({
                left: 420,
                behavior: 'smooth'
            });
        });

        prev?.addEventListener('click', function () {
            carousel.scrollBy({
                left: -420,
                behavior: 'smooth'
            });
        });

    });


    // Favoritos
    document.querySelectorAll('.favorito-btn').forEach(function (button) {

        button.addEventListener('click', function () {

            const icon = this.querySelector('i');
            const ativo = icon.classList.contains('bi-heart-fill');

            icon.classList.toggle('bi-heart', ativo);
            icon.classList.toggle('bi-heart-fill', !ativo);
            icon.classList.toggle('text-secondary', ativo);
            icon.classList.toggle('text-danger', !ativo);

            this.setAttribute(
                'aria-label',
                ativo
                    ? 'Adicionar aos favoritos'
                    : 'Remover dos favoritos'
            );

        });

    });

});

</script>

@endsection