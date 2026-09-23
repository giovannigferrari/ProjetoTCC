@extends('layouts.admin')

@section('content')

<div class="container-fluid bg-light min-vh-100 p-4">

    {{-- TÍTULO --}}
    <div class="mb-4">

        <h2 class="fw-bold mb-1" style="color: #050044;">
            Gerenciar TCCs
        </h2>

        <p class="text-secondary mb-0">
            6 trabalhos cadastrados
        </p>

    </div>


    {{-- CARD PRINCIPAL --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

        {{-- BUSCA --}}
        <div class="p-3">

            <div class="input-group" style="max-width: 350px;">

                <span class="input-group-text bg-light border-0 rounded-start-4">
                    <i class="bi bi-search text-secondary"></i>
                </span>

                <input
                    type="text"
                    class="form-control bg-light border-0 rounded-end-4 py-2"
                    placeholder="Buscar por título, autor ou turma..."
                >

            </div>

        </div>


        {{-- TABELA --}}
        <div class="table-responsive">

            <table class="table align-middle mb-0">

                <thead>

                    <tr class="border-top border-bottom">

                        <th class="ps-3 small text-secondary fw-semibold">
                            Capa
                        </th>

                        <th class="small text-secondary fw-semibold">
                            Título
                        </th>

                        <th class="small text-secondary fw-semibold">
                            Autor
                        </th>

                        <th class="small text-secondary fw-semibold">
                            Turma
                        </th>

                        <th class="small text-secondary fw-semibold">
                            Ano
                        </th>

                        <th class="small text-secondary fw-semibold">
                            Visualizações
                        </th>

                        <th class="small text-secondary fw-semibold text-center">
                            Ações
                        </th>

                    </tr>

                </thead>


                <tbody>

                    {{-- TCC 1 --}}
                    <tr>

                        <td class="ps-3">

                            <img
                                src="https://images.unsplash.com/photo-1532012197267-da84d127e765?w=100"
                                class="rounded-3"
                                width="52"
                                height="52"
                                style="object-fit: cover;"
                            >

                        </td>

                        <td style="max-width: 250px;">

                            <span class="fw-bold" style="color:#050044;">
                                Aplicação de Redes Neurais<br>
                                no Diagnóstico Precoce de...
                            </span>

                        </td>

                        <td class="text-secondary">
                            Ana Carolina Menezes
                        </td>

                        <td>
                            <span class="badge rounded-pill bg-light text-dark">
                                3ºA
                            </span>
                        </td>

                        <td class="text-secondary">
                            2024
                        </td>

                        <td class="text-secondary">
                            <i class="bi bi-eye me-1"></i>
                            1.205
                        </td>

                        <td class="text-center">

                            <button class="btn btn-sm text-secondary">
                                <i class="bi bi-check-circle"></i>
                            </button>

                            <button class="btn btn-sm text-warning">
                                <i class="bi bi-star-fill"></i>
                            </button>

                            <button class="btn btn-sm text-secondary">
                                <i class="bi bi-pencil"></i>
                            </button>

                            <button class="btn btn-sm text-secondary">
                                <i class="bi bi-trash"></i>
                            </button>

                        </td>

                    </tr>


                    {{-- TCC 2 --}}
                    <tr>

                        <td class="ps-3">

                            <img
                                src="https://images.unsplash.com/photo-1497366754035-f200968a6e72?w=100"
                                class="rounded-3"
                                width="52"
                                height="52"
                                style="object-fit: cover;"
                            >

                        </td>

                        <td>

                            <span class="fw-bold" style="color:#050044;">
                                Sistema de Monitoramento<br>
                                Ambiental com IoT para...
                            </span>

                        </td>

                        <td class="text-secondary">
                            Lucas Ferreira Alves
                        </td>

                        <td>
                            <span class="badge rounded-pill bg-light text-dark">
                                3ºB
                            </span>
                        </td>

                        <td class="text-secondary">
                            2024
                        </td>

                        <td class="text-secondary">
                            <i class="bi bi-eye me-1"></i>
                            876
                        </td>

                        <td class="text-center">

                            <button class="btn btn-sm text-secondary">
                                <i class="bi bi-check-circle"></i>
                            </button>

                            <button class="btn btn-sm text-warning">
                                <i class="bi bi-star-fill"></i>
                            </button>

                            <button class="btn btn-sm text-secondary">
                                <i class="bi bi-pencil"></i>
                            </button>

                            <button class="btn btn-sm text-secondary">
                                <i class="bi bi-trash"></i>
                            </button>

                        </td>

                    </tr>


                    {{-- TCC 3 --}}
                    <tr>

                        <td class="ps-3">

                            <div
                                class="rounded-3 d-flex align-items-center justify-content-center"
                                style="
                                    width:52px;
                                    height:52px;
                                    background:#111;
                                    color:#e50914;
                                    font-size:25px;
                                    font-weight:bold;
                                "
                            >
                                N
                            </div>

                        </td>

                        <td>

                            <span class="fw-bold" style="color:#050044;">
                                Análise do Impacto das<br>
                                Redes Sociais no...
                            </span>

                        </td>

                        <td class="text-secondary">
                            Beatriz Lima Costa
                        </td>

                        <td>
                            <span class="badge rounded-pill bg-light text-dark">
                                3ºC
                            </span>
                        </td>

                        <td class="text-secondary">
                            2023
                        </td>

                        <td class="text-secondary">
                            <i class="bi bi-eye me-1"></i>
                            654
                        </td>

                        <td class="text-center">

                            <button class="btn btn-sm text-secondary">
                                <i class="bi bi-check-circle"></i>
                            </button>

                            <button class="btn btn-sm text-secondary">
                                <i class="bi bi-star"></i>
                            </button>

                            <button class="btn btn-sm text-secondary">
                                <i class="bi bi-pencil"></i>
                            </button>

                            <button class="btn btn-sm text-secondary">
                                <i class="bi bi-trash"></i>
                            </button>

                        </td>

                    </tr>


                    {{-- TCC 4 --}}
                    <tr>

                        <td class="ps-3">

                            <img
                                src="https://images.unsplash.com/photo-1556761175-b413da4baf72?w=100"
                                class="rounded-3"
                                width="52"
                                height="52"
                                style="object-fit: cover;"
                            >

                        </td>

                        <td>

                            <span class="fw-bold" style="color:#050044;">
                                Desenvolvimento de<br>
                                Aplicativo Mobile para...
                            </span>

                        </td>

                        <td class="text-secondary">
                            Gabriel Souza Neto
                        </td>

                        <td>
                            <span class="badge rounded-pill bg-light text-dark">
                                5ºA
                            </span>
                        </td>

                        <td class="text-secondary">
                            2024
                        </td>

                        <td class="text-secondary">
                            <i class="bi bi-eye me-1"></i>
                            1.890
                        </td>

                        <td class="text-center">

                            <button class="btn btn-sm text-secondary">
                                <i class="bi bi-check-circle"></i>
                            </button>

                            <button class="btn btn-sm text-warning">
                                <i class="bi bi-star-fill"></i>
                            </button>

                            <button class="btn btn-sm text-secondary">
                                <i class="bi bi-pencil"></i>
                            </button>

                            <button class="btn btn-sm text-secondary">
                                <i class="bi bi-trash"></i>
                            </button>

                        </td>

                    </tr>


                    {{-- TCC 5 --}}
                    <tr>

                        <td class="ps-3">

                            <img
                                src="https://images.unsplash.com/photo-1509391366360-2e959784a276?w=100"
                                class="rounded-3"
                                width="52"
                                height="52"
                                style="object-fit: cover;"
                            >

                        </td>

                        <td>

                            <span class="fw-bold" style="color:#050044;">
                                Energia Solar Fotovoltaica<br>
                                como Alternativa para...
                            </span>

                        </td>

                        <td class="text-secondary">
                            Rafaela Carvalho Mota
                        </td>

                        <td>
                            <span class="badge rounded-pill bg-light text-dark">
                                5ºB
                            </span>
                        </td>

                        <td class="text-secondary">
                            2023
                        </td>

                        <td class="text-secondary">
                            <i class="bi bi-eye me-1"></i>
                            543
                        </td>

                        <td class="text-center">

                            <button class="btn btn-sm text-secondary">
                                <i class="bi bi-check-circle"></i>
                            </button>

                            <button class="btn btn-sm text-secondary">
                                <i class="bi bi-star"></i>
                            </button>

                            <button class="btn btn-sm text-secondary">
                                <i class="bi bi-pencil"></i>
                            </button>

                            <button class="btn btn-sm text-secondary">
                                <i class="bi bi-trash"></i>
                            </button>

                        </td>

                    </tr>


                    {{-- TCC 6 --}}
                    <tr>

                        <td class="ps-3">

                            <img
                                src="https://images.unsplash.com/photo-1521737711867-e3b97375f902?w=100"
                                class="rounded-3"
                                width="52"
                                height="52"
                                style="object-fit: cover;"
                            >

                        </td>

                        <td>

                            <span class="fw-bold" style="color:#050044;">
                                Gamificação como<br>
                                Estratégia Pedagógica no...
                            </span>

                        </td>

                        <td class="text-secondary">
                            Pedro Henrique Silva
                        </td>

                        <td>
                            <span class="badge rounded-pill bg-light text-dark">
                                4ºA
                            </span>
                        </td>

                        <td class="text-secondary">
                            2024
                        </td>

                        <td class="text-secondary">
                            <i class="bi bi-eye me-1"></i>
                            1.102
                        </td>

                        <td class="text-center">

                            <button class="btn btn-sm text-secondary">
                                <i class="bi bi-check-circle"></i>
                            </button>

                            <button class="btn btn-sm text-secondary">
                                <i class="bi bi-star"></i>
                            </button>

                            <button class="btn btn-sm text-secondary">
                                <i class="bi bi-pencil"></i>
                            </button>

                            <button class="btn btn-sm text-secondary">
                                <i class="bi bi-trash"></i>
                            </button>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection