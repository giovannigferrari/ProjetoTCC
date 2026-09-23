@extends('layouts.admin')

@section('title', 'Dashboard - BIBLIO-TEK')
@section('page-header', 'Dashboard')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Dashboard</h2>
        <p class="text-sm text-gray-500">Visão geral do sistema — maio 2024</p>
    </div>

    <!-- Grid de Cards Indicadores -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Card 1 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-start">
            <div>
                <span class="text-3xl font-extrabold text-gray-800 block">847</span>
                <p class="text-sm font-semibold text-gray-600 mt-1">Livros Cadastrados</p>
                <span class="text-xs text-gray-400 mt-2 block">+12 este mês</span>
            </div>
            <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl">
                <i class="bi bi-journal-bookmark text-xl"></i>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-start">
            <div>
                <span class="text-3xl font-extrabold text-orange-600 block">312</span>
                <p class="text-sm font-semibold text-gray-600 mt-1">Usuários Ativos</p>
                <span class="text-xs text-gray-400 mt-2 block">+8 esta semana</span>
            </div>
            <div class="p-3 bg-orange-50 text-orange-600 rounded-xl">
                <i class="bi bi-people text-xl"></i>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex justify-between items-start">
            <div>
                <span class="text-3xl font-extrabold text-gray-800 block">89</span>
                <p class="text-sm font-semibold text-gray-600 mt-1">Empréstimos Ativos</p>
                <span class="text-xs text-gray-400 mt-2 block">+5 hoje</span>
            </div>
            <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
                <i class="bi bi-arrow-left-right text-xl"></i>
            </div>
        </div>
    </div>
@endsection