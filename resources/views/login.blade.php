<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>BIBLIO-TEK - Login</title>

    <!-- Bootstrap 5 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

</head>

<body class="bg-light">

<div class="container-fluid min-vh-100">

    <div class="row min-vh-100">

        {{-- ================================================= --}}
        {{-- LADO ESQUERDO --}}
        {{-- ================================================= --}}

        <div
            class="col-lg-6 d-none d-lg-flex flex-column justify-content-center
                   align-items-center text-white text-center"
            style="background-color: #02003a;"
        >

            {{-- Ícone --}}
            <div
                class="rounded-4 d-flex justify-content-center align-items-center mb-4"
                style="width: 86px; height: 86px; background-color: #E25C3C;"
            >
                <i class="bi bi-book text-white fs-1"></i>
            </div>


            {{-- Nome --}}

            <h1 class="fw-bold display-5 mb-3">

                BIBLIO-TEK

            </h1>


            {{-- Descrição --}}

            <p class="fs-5 text-white-50 mb-5">

                Sua biblioteca digital moderna,<br>

                acadêmica e conectada.

            </p>


            {{-- Estatísticas --}}

            <div class="d-flex gap-4">

                <div
                    class="bg-primary bg-opacity-25 rounded-4
                           px-4 py-3 text-center"
                >

                    <h2 class="fw-bold mb-0">
                        847
                    </h2>

                    <small class="text-white-50">
                        Livros
                    </small>

                </div>


                <div
                    class="bg-primary bg-opacity-25 rounded-4
                           px-4 py-3 text-center"
                >

                    <h2 class="fw-bold mb-0">
                        312
                    </h2>

                    <small class="text-white-50">
                        Alunos
                    </small>

                </div>


                <div
                    class="bg-primary bg-opacity-25 rounded-4
                           px-4 py-3 text-center"
                >

                    <h2 class="fw-bold mb-0">
                        156
                    </h2>

                    <small class="text-white-50">
                        TCCs
                    </small>

                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- LADO DIREITO --}}
        {{-- ================================================= --}}

        <div
            class="col-lg-6 d-flex justify-content-center
                   align-items-center p-4"
        >

            <div
                class="card border-0 shadow rounded-4 w-100"
                style="max-width: 480px;"
            >

                <div class="card-body p-4 p-md-5">


                    {{-- ================================================= --}}
                    {{-- TÍTULO --}}
                    {{-- ================================================= --}}

                    <h2
                        class="fw-bold mb-2"
                        style="color: #02003a;"
                    >

                        Bem-vindo de volta

                    </h2>

                    <p class="text-secondary mb-4">

                        Faça login para acessar sua biblioteca

                    </p>


                    {{-- ================================================= --}}
                    {{-- MENSAGEM DE ERRO --}}
                    {{-- ================================================= --}}

                    @if ($errors->any())

                        <div class="alert alert-danger rounded-3">

                            <div class="d-flex align-items-center">

                                <i
                                    class="bi bi-exclamation-triangle-fill me-2"
                                ></i>

                                <div>

                                    {{ $errors->first() }}

                                </div>

                            </div>

                        </div>

                    @endif


                    {{-- ================================================= --}}
                    {{-- MENSAGEM DE SUCESSO --}}
                    {{-- ================================================= --}}

                    @if (session('success'))

                        <div class="alert alert-success rounded-3">

                            <i class="bi bi-check-circle-fill me-2"></i>

                            {{ session('success') }}

                        </div>

                    @endif


                    {{-- ================================================= --}}
                    {{-- FORMULÁRIO --}}
                    {{-- ================================================= --}}

                    <form
                        method="POST"
                        action="{{ route('login.store') }}"
                    >

                        @csrf


                        {{-- ================================================= --}}
                        {{-- E-MAIL --}}
                        {{-- ================================================= --}}

                        <div class="mb-3">

                            <label
                                for="email"
                                class="form-label fw-semibold"
                            >

                                E-mail institucional

                            </label>


                            <div class="input-group">

                                <span class="input-group-text bg-light">

                                    <i class="bi bi-envelope"></i>

                                </span>


                                <input
                                    type="email"
                                    class="form-control bg-light @error('email') is-invalid @enderror"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="seu@escola.edu.br"
                                    required
                                    autofocus
                                >

                            </div>


                            @error('email')

                                <div class="text-danger small mt-1">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>


                        {{-- ================================================= --}}
                        {{-- SENHA --}}
                        {{-- ================================================= --}}

                        <div class="mb-3">

                            <label
                                for="password"
                                class="form-label fw-semibold"
                            >

                                Senha

                            </label>


                            <div class="input-group">

                                <span class="input-group-text bg-light">

                                    <i class="bi bi-lock"></i>

                                </span>


                                <input
                                    type="password"
                                    class="form-control bg-light @error('password') is-invalid @enderror"
                                    id="password"
                                    name="password"
                                    placeholder="••••••••"
                                    required
                                >


                                <button
                                    type="button"
                                    class="btn btn-light border"
                                    onclick="mostrarSenha()"
                                >

                                    <i
                                        id="iconeSenha"
                                        class="bi bi-eye"
                                    ></i>

                                </button>

                            </div>


                            @error('password')

                                <div class="text-danger small mt-1">

                                    {{ $message }}

                                </div>

                            @enderror

                        </div>


                        {{-- ================================================= --}}
                        {{-- ESQUECEU SENHA --}}
                        {{-- ================================================= --}}

                        <div class="mb-4">

                            <a
                                href="#"
                                class="text-decoration-none"
                                style="color: #E25C3C;"
                            >

                                Esqueci minha senha

                            </a>

                        </div>


                        {{-- ================================================= --}}
                        {{-- ENTRAR --}}
                        {{-- ================================================= --}}

                        <button
                            type="submit"
                            class="btn w-100 text-white fw-bold py-3 rounded-3"
                            style="background-color: #02003a;"
                        >

                            <i class="bi bi-box-arrow-in-right me-2"></i>

                            Entrar

                        </button>


                        {{-- ================================================= --}}
                        {{-- OU --}}
                        {{-- ================================================= --}}

                        <div class="d-flex align-items-center my-4">

                            <hr class="flex-grow-1">

                            <span class="px-3 text-secondary">

                                ou

                            </span>

                            <hr class="flex-grow-1">

                        </div>


                        {{-- ================================================= --}}
                        {{-- GOOGLE --}}
                        {{-- ================================================= --}}

                        <button
                            type="button"
                            class="btn btn-outline-secondary w-100 py-2 rounded-3"
                        >

                            <i class="bi bi-google me-2"></i>

                            Entrar com Google

                        </button>


                        {{-- ================================================= --}}
                        {{-- CADASTRO --}}
                        {{-- ================================================= --}}

                        <div class="text-center mt-4">

                            <span class="text-secondary">

                                Não tem conta?

                            </span>


                            <a
                                href="{{ route('register.form') }}"
                                class="text-decoration-none fw-semibold ms-1"
                                style="color: #d9532b;"
                            >

                                Cadastrar-se

                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- ================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ================================================= --}}

<script>

function mostrarSenha() {

    const senha = document.getElementById('password');

    const icone = document.getElementById('iconeSenha');


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


</body>

</html>