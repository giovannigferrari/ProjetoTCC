@extends('layouts.app')

@section('title', 'Login Administrativo')

@section('content')

<div class="min-vh-100 d-flex align-items-center justify-content-center p-3"
     style="background: linear-gradient(135deg, #02003a 0%, #08065c 100%);">

    <div class="card border-0 shadow-lg rounded-4 overflow-hidden"
         style="max-width: 450px; width: 100%;">

        <div class="card-body p-4 p-md-5">

            {{-- Voltar --}}
            <a href="{{ route('login') }}"
               class="text-decoration-none text-dark fs-4 d-inline-block mb-2">
                <i class="bi bi-arrow-left"></i>
            </a>

            {{-- Cabeçalho --}}
            <div class="text-center mb-4">

                <div class="mb-3">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-warning bg-opacity-10"
                         style="width: 80px; height: 80px;">

                        <i class="bi bi-shield-lock-fill text-warning"
                           style="font-size: 48px;"></i>

                    </div>
                </div>

                <h1 class="fw-bold mb-2">
                    Área Administrativa
                </h1>

                <p class="text-secondary mb-0">
                    Acesso exclusivo para administradores
                </p>

            </div>

            {{-- Erros --}}
            @if ($errors->any())
                <div class="alert alert-danger rounded-3">

                    <div class="fw-semibold mb-1">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        Não foi possível entrar
                    </div>

                    <div class="small">
                        Usuário ou senha inválidos.
                    </div>

                </div>
            @endif

            {{-- Formulário --}}
            <form method="POST"
                  action="{{ route('login.admin') }}">

                @csrf

                {{-- Usuário --}}
                <div class="mb-3">

                    <label for="usuario"
                           class="form-label fw-semibold">
                        Usuário administrativo
                    </label>

                    <div class="input-group">

                        <span class="input-group-text bg-white">
                            <i class="bi bi-person-badge text-secondary"></i>
                        </span>

                        <input type="text"
                               id="usuario"
                               name="usuario"
                               class="form-control"
                               placeholder="Digite seu usuário"
                               value="{{ old('usuario') }}"
                               required
                               autofocus>

                    </div>

                    @error('usuario')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- Senha --}}
                <div class="mb-3">

                    <label for="senha"
                           class="form-label fw-semibold">
                        Senha
                    </label>

                    <div class="input-group">

                        <span class="input-group-text bg-white">
                            <i class="bi bi-lock-fill text-secondary"></i>
                        </span>

                        <input type="password"
                               id="senha"
                               name="senha"
                               class="form-control"
                               placeholder="Digite sua senha"
                               required>

                        <button type="button"
                                class="btn btn-outline-secondary"
                                onclick="mostrarSenhaAdmin()">

                            <i class="bi bi-eye"
                               id="iconeSenhaAdmin"></i>

                        </button>

                    </div>

                    @error('senha')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- Lembrar --}}
                <div class="form-check mb-4">

                    <input type="checkbox"
                           class="form-check-input"
                           id="remember"
                           name="remember">

                    <label for="remember"
                           class="form-check-label">
                        Lembrar de mim
                    </label>

                </div>

                {{-- Entrar --}}
                <button type="submit"
                        class="btn btn-primary btn-lg w-100 rounded-3">

                    <i class="bi bi-box-arrow-in-right me-2"></i>
                    Entrar

                </button>

            </form>

            {{-- Rodapé --}}
            <div class="text-center mt-4 pt-3 border-top">

                <small class="text-secondary">

                    <i class="bi bi-shield-check me-1"></i>
                    Área restrita do sistema

                </small>

            </div>

        </div>

    </div>

</div>

{{-- Mostrar/ocultar senha --}}
<script>
    function mostrarSenhaAdmin() {
        const senha = document.getElementById('senha');
        const icone = document.getElementById('iconeSenhaAdmin');

        if (senha.type === 'password') {
            senha.type = 'text';
            icone.classList.remove('bi-eye');
            icone.classList.add('bi-eye-slash');
        } else {
            senha.type = 'password';
            icone.classList.remove('bi-eye-slash');
            icone.classList.add('bi-eye');
        }
    }
</script>

@endsection