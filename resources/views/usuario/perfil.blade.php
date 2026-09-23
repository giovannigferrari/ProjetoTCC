@extends('layouts.app')

@section('title', 'Início')

@section('content')

<div class="d-flex min-vh-100 bg-light">
    <div class="position-sticky top-0"style="height: 100vh;">
    @include('usuario.sidebar')
    </div>
    <main class="flex-grow-1 overflow-hidden">

        @include('usuario.navbar')
     
    </main>

</div>

@endsection