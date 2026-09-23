@extends('layouts.app')

@section('title', 'Criar Conta')

@section('content')

<div class="min-vh-100 d-flex align-items-center justify-content-center p-3"
     style="background: linear-gradient(135deg, #02003a 0%, #08065c 100%);">

```
<div class="card border-0 shadow-lg rounded-4 overflow-hidden"
     style="max-width: 470px; width: 100%;">

    <div class="card-body p-4 p-md-5">

        {{-- Voltar --}}
        <a href="{{ route('login') }}"
           class="text-decoration-none text-dark fs-4 d-inline-block mb-2">

            <i class="bi bi-arrow-left"></i>

        </a>

        {{-- Cabeçalho --}}
        <div class="text-center mb-4">

            <div class="mb-3">

                <div class="d-inline-flex align-items-center justify-content-center
                            rounded-circle bg-primary bg-opacity-10"
                     style="width: 80px; height: 80px;">

                    <i class="bi bi-person-plus-fill text-primary"
                       style="font-size: 48px;"></i>

                </div>

            </div>

            <h1 class="fw-bold mb-2">
                Criar Conta
            </h1>

            <p class="text-secondary mb-0">
                Preencha seus dados para começar
            </p>

        </div>


        {{-- Erros --}}
        @if ($errors->any())

            <div class="alert alert-danger rounded-3">

                <div class="fw-semibold mb-1">

                    <i class="bi bi-exclamation-circle me-2"></i>

                    Não foi possível criar a conta

                </div>

                <div class="small">

                    Verifique os campos informados.

                </div>

            </div>

        @endif


        {{-- Formulário --}}
        <form method="POST"
              action="{{ route('register.store') }}">

            @csrf


            {{-- Nome --}}
            <div class="mb-3">

                <label for="nome"
                       class="form-label fw-semibold">

                    Nome completo

                </label>

                <div class="input-group">

                    <span class="input-group-text bg-white">

                        <i class="bi bi-person text-secondary"></i>

                    </span>

                    <input
                        type="text"
                        id="nome"
                        name="nome"
                        class="form-control"
                        placeholder="Digite seu nome"
                        value="{{ old('nome') }}"
                        required
                    >

                </div>

                @error('nome')

                    <div class="text-danger small mt-1">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- E-mail --}}
            <div class="mb-3">

                <label for="email"
                       class="form-label fw-semibold">

                    E-mail

                </label>

                <div class="input-group">

                    <span class="input-group-text bg-white">

                        <i class="bi bi-envelope text-secondary"></i>

                    </span>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        placeholder="Digite seu e-mail"
                        value="{{ old('email') }}"
                        required
                    >

                </div>

                @error('email')

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

                        <i class="bi bi-lock text-secondary"></i>

                    </span>

                    <input
                        type="password"
                        id="senha"
                        name="senha"
                        class="form-control"
                        placeholder="Crie uma senha"
                        required
                    >

                    <button
                        type="button"
                        class="btn btn-outline-secondary"
                        onclick="mostrarSenha('senha', 'iconeSenha')"
                    >

                        <i
                            class="bi bi-eye"
                            id="iconeSenha"
                        ></i>

                    </button>

                </div>

                @error('senha')

                    <div class="text-danger small mt-1">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- Confirmar senha --}}
            <div class="mb-4">

                <label for="senha_confirmation"
                       class="form-label fw-semibold">

                    Confirmar senha

                </label>

                <div class="input-group">

                    <span class="input-group-text bg-white">

                        <i class="bi bi-lock-fill text-secondary"></i>

                    </span>

                    <input
                        type="password"
                        id="senha_confirmation"
                        name="senha_confirmation"
                        class="form-control"
                        placeholder="Digite a senha novamente"
                        required
                    >

                    <button
                        type="button"
                        class="btn btn-outline-secondary"
                        onclick="mostrarSenha(
                            'senha_confirmation',
                            'iconeSenhaConfirmacao'
                        )"
                    >

                        <i
                            class="bi bi-eye"
                            id="iconeSenhaConfirmacao"
                        ></i>

                    </button>

                </div>

                @error('senha_confirmation')

                    <div class="text-danger small mt-1">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- Criar conta --}}
            <button
                type="submit"
                class="btn btn-primary btn-lg w-100 rounded-3"
            >

                <i class="bi bi-person-plus me-2"></i>

                Criar conta

            </button>

        </form>


        {{-- Login --}}
        <div class="text-center mt-4 pt-3 border-top">

            <span class="text-secondary">
                Já possui uma conta?
            </span>

            <a
                href="{{ route('login') }}"
                class="text-primary text-decoration-none fw-bold ms-1"
            >

                Fazer login

            </a>

        </div>

    </div>

</div>
```

</div>

<script>

function mostrarSenha(idSenha, idIcone) {

    const senha = document.getElementById(idSenha);
    const icone = document.getElementById(idIcone);

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