<aside class="w-64 bg-[#090D28] text-white flex flex-col justify-between p-4 shrink-0 min-h-screen select-none border-r border-slate-800/50">

    <div>

        {{-- Logo BIBLIO-TEK --}}
        <a href="{{ route('admin.home') }}"
           class="mb-8 px-2 py-2 flex items-center gap-3 group cursor-pointer text-decoration-none">

            <div class="p-2.5 bg-orange-600 rounded-xl flex items-center justify-center shadow-lg shadow-orange-600/30 transition-transform duration-300 group-hover:scale-105">
                <i class="bi bi-book text-xl text-white"></i>
            </div>

            <div>
                <h2 class="font-bold text-base tracking-wide leading-tight text-white group-hover:text-orange-400 transition-colors duration-200">
                    BIBLIO-TEK
                </h2>

                <span class="text-xs text-orange-500 font-medium">
                    Administrator
                </span>
            </div>

        </a>


        {{-- Links de Navegação --}}
        <nav class="space-y-1.5">

            @php
                $menuItems = [

                    [
                        'route' => 'admin.home',
                        'icon' => 'bi-grid-fill',
                        'label' => 'Dashboard'
                    ],

                    [
                        'route' => 'admin.livros',
                        'icon' => 'bi-book',
                        'label' => 'Gerenciar Livros'
                    ],

                    [
                        'route' => 'admin.usuarios',
                        'icon' => 'bi-people',
                        'label' => 'Usuários'
                    ],

                    [
                        'route' => 'admin.emprestimos',
                        'icon' => 'bi-arrow-left-right',
                        'label' => 'Empréstimos'
                    ],

                    [
                        'route' => 'admin.tccs',
                        'icon' => 'bi-mortarboard',
                        'label' => 'Gerenciar TCCs'
                    ],

                    [
                        'route' => 'admin.upload-tcc',
                        'icon' => 'bi-upload',
                        'label' => 'Upload de TCC'
                    ],

                    [
                        'route' => 'admin.mensagens',
                        'icon' => 'bi-chat-dots',
                        'label' => 'Mensagens'
                    ],

                ];
            @endphp
            @foreach($menuItems as $item)

                @php
                    $isActive = request()->routeIs($item['route']);
                @endphp
                <a href="{{ route($item['route']) }}"
                   class="group relative flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 overflow-hidden
                   {{ $isActive
                        ? 'bg-orange-600 text-white shadow-lg shadow-orange-600/30'
                        : 'text-gray-400 hover:bg-slate-800/70 hover:text-white hover:translate-x-1'
                   }}">

                    {{-- Barra lateral --}}
                    @if(!$isActive)
                        <span class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-0 bg-orange-500 rounded-r transition-all duration-200 group-hover:h-6"></span>
                    @endif


                    {{-- Ícone --}}
                    <i class="{{ $item['icon'] }} text-lg transition-transform duration-200 group-hover:scale-110
                    {{ $isActive
                        ? 'text-white'
                        : 'text-gray-400 group-hover:text-orange-400'
                    }}"></i>


                    {{-- Texto --}}
                    <span>
                        {{ $item['label'] }}
                    </span>

                </a>

            @endforeach

        </nav>

    </div>


    {{-- Botão Sair --}}
    <div class="pt-4 border-t border-slate-800/80">

        <a href="{{ route('home') }}"
           class="group flex items-center gap-3.5 px-4 py-3 rounded-xl text-sm font-medium text-gray-400 hover:bg-red-500/10 hover:text-red-400 transition-all duration-200">

            <i class="bi bi-box-arrow-left text-lg transition-transform duration-200 group-hover:-translate-x-1 text-gray-400 group-hover:text-red-400"></i>

            <span>
                Sair
            </span>

        </a>

    </div>

</aside>