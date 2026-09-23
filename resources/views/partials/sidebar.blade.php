<style>
    .sidebar-link {
        transition: all 0.2s ease-in-out;
        color: rgba(255, 255, 255, 0.6) !important;
    }
    .sidebar-link:hover {
        background-color: rgba(255, 255, 255, 0.08);
        color: #ffffff !important;
        transform: translateX(4px);
    }
    .sidebar-link:hover i {
        color: #E25C3C;
        transition: color 0.2s ease-in-out;
    }
    .sidebar-logout:hover {
        background-color: rgba(220, 53, 69, 0.15) !important;
        color: #ff6b6b !important;
    }
    .sidebar-logout:hover i {
        color: #ff6b6b !important;
    }
</style>

<aside
    class="d-flex flex-column text-white min-vh-100 select-none"
    style="width: 250px; background-color: #02003a;"
>

    {{-- =========================================================
         LOGO
    ========================================================== --}}
    <div
        class="d-flex align-items-center gap-3 px-3 py-4"
        style="border-bottom: 1px solid rgba(255,255,255,.08);"
    >
        <div
            class="d-flex align-items-center justify-content-center rounded-3 text-white"
            style="
                width: 36px;
                height: 36px;
                background-color: #E25C3C;
            "
        >
            <i class="bi bi-book-half fs-6"></i>
        </div>

        <h5
            class="fw-bold mb-0 text-white"
            style="
                font-size: 1.1rem;
                letter-spacing: .5px;
            "
        >
            BIBLIO-TEK
        </h5>
    </div>


    {{-- =========================================================
         MENU
    ========================================================== --}}
    <div class="d-flex flex-column flex-grow-1 p-3">

        {{-- Início --}}
        <a
            href="{{ route('login') }}"
            class="
                sidebar-link
                d-flex align-items-center gap-3
                text-decoration-none
                rounded-3 px-3 py-2 mb-2 fw-medium
            "
        >
            <i class="bi bi-house-door-fill fs-5"></i>
            <span>Início</span>
        </a>


        {{-- Favoritos --}}
        <a
            href="{{ route('login') }}"
            class="
                sidebar-link
                d-flex align-items-center gap-3
                text-decoration-none
                rounded-3 px-3 py-2 mb-2 fw-medium
            "
        >
            <i class="bi bi-heart fs-5"></i>
            <span>Favoritos</span>
        </a>


        {{-- Histórico --}}
        <a
            href="{{ route('login') }}"
            class="
                sidebar-link
                d-flex align-items-center gap-3
                text-decoration-none
                rounded-3 px-3 py-2 mb-2 fw-medium
            "
        >
            <i class="bi bi-clock-history fs-5"></i>
            <span>Histórico</span>
        </a>


        {{-- Biblioteca TCC --}}
        <a
            href="{{ route('login') }}"
            class="
                sidebar-link
                d-flex align-items-center gap-3
                text-decoration-none
                rounded-3 px-3 py-2 mb-2 fw-medium
            "
        >
            <i class="bi bi-mortarboard fs-5"></i>
            <span>Biblioteca TCC</span>
        </a>


        {{-- Mensagens --}}
        <a
            href="{{ route('login') }}"
            class="
                sidebar-link
                d-flex align-items-center gap-3
                text-decoration-none
                rounded-3 px-3 py-2 mb-2 fw-medium
            "
        >
            <i class="bi bi-chat-square-text fs-5"></i>
            <span>Mensagens</span>
        </a>


        {{-- Perfil --}}
        <a
            href="{{ route('login') }}"
            class="
                sidebar-link
                d-flex align-items-center gap-3
                text-decoration-none
                rounded-3 px-3 py-2 mb-2 fw-medium
            "
        >
            <i class="bi bi-person fs-5"></i>
            <span>Perfil</span>
        </a>


        {{-- =====================================================
             ADMINISTRAÇÃO
        ====================================================== --}}
        @if(session('tipo_usuario') === 'admin')

            <hr class="border-secondary my-3 opacity-25">

            <div
                class="text-uppercase text-white-50 small fw-bold px-3 mb-2"
                style="
                    font-size: .7rem;
                    letter-spacing: .5px;
                "
            >
                Administração
            </div>


            {{-- Usuários --}}
            <a
                href="{{ route('login') }}"
                class="
                    sidebar-link
                    d-flex align-items-center gap-3
                    text-decoration-none
                    rounded-3 px-3 py-2 mb-2 fw-medium
                "
            >
                <i class="bi bi-people fs-5"></i>
                <span>Usuários</span>
            </a>


            {{-- Gerenciar livros --}}
            <a
                href="{{ route('login') }}"
                class="
                    sidebar-link
                    d-flex align-items-center gap-3
                    text-decoration-none
                    rounded-3 px-3 py-2 mb-2 fw-medium
                "
            >
                <i class="bi bi-journal-plus fs-5"></i>
                <span>Gerenciar livros</span>
            </a>


            {{-- Empréstimos --}}
            <a
                href="{{ route('login') }}"
                class="
                    sidebar-link
                    d-flex align-items-center gap-3
                    text-decoration-none
                    rounded-3 px-3 py-2 mb-2 fw-medium
                "
            >
                <i class="bi bi-arrow-left-right fs-5"></i>
                <span>Empréstimos</span>
            </a>

        @endif

    </div>


    {{-- =========================================================
         RODAPÉ
    ========================================================== --}}
    <div
        class="p-3"
        style="border-top: 1px solid rgba(255,255,255,.08);"
    >

        @if(session()->has('usuario') || session()->has('admin'))

            {{-- Sair --}}
            <form
                method="POST"
                action="{{ route('logout') }}"
            >
                @csrf

                <button
                    type="submit"
                    class="
                        sidebar-link
                        sidebar-logout
                        btn btn-link
                        text-decoration-none
                        w-100
                        rounded-3
                        px-3
                        py-2
                        d-flex
                        align-items-center
                        gap-3
                        fw-medium
                    "
                >
                    <i class="bi bi-box-arrow-left fs-5"></i>
                    <span>Sair</span>
                </button>
            </form>

        @else

            {{-- Entrar --}}
            <a
                href="{{ route('login') }}"
                class="
                    sidebar-link
                    text-decoration-none
                    rounded-3
                    px-3
                    py-2
                    d-flex
                    align-items-center
                    gap-3
                    fw-medium
                "
            >
                <i class="bi bi-box-arrow-in-right fs-5"></i>
                <span>Entrar</span>
            </a>

        @endif

    </div>

</aside>