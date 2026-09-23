<nav class="navbar bg-white border-bottom px-4 py-3">

    <div class="container-fluid p-0">

        {{-- Pesquisa --}}
        <div class="flex-grow-1" style="max-width: 600px;">

            <div class="input-group">

                <span class="input-group-text bg-light border-0">
                    <i class="bi bi-search text-secondary"></i>
                </span>

                <input
                    type="text"
                    class="form-control bg-light border-0 shadow-none"
                    placeholder="Pesquisar livros, autores, categorias..."
                    aria-label="Pesquisar">

            </div>

        </div>

        {{-- Ações --}}
        <div class="d-flex align-items-center gap-3">

            {{-- Notificações --}}
            <button
                type="button"
                class="btn btn-light rounded-circle position-relative d-flex align-items-center justify-content-center"
                style="width: 42px; height: 42px;"
                aria-label="Notificações">

                <i class="bi bi-bell"></i>

                <span
                    class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                </span>

            </button>

            {{-- Mensagens --}}
            <button
                type="button"
                class="btn btn-light rounded-circle d-flex align-items-center justify-content-center"
                style="width: 42px; height: 42px;"
                aria-label="Mensagens">

                <i class="bi bi-chat-dots"></i>

            </button>
        </div>
    </div>

</nav>