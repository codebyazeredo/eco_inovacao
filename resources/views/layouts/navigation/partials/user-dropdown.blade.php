@auth
    <div class="hidden sm:flex transform translate-y-4">
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button
                    class="inline-flex px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                    <div>{{ Auth::user()->name }}</div>
                    <div class="ms-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    {{ __('Perfil') }}
                </a>

                @if(Auth::user()->isAdmin())
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-create-categorias"
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        {{ __('Categorias') }}
                    </a>

                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-create-assuntos"
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        {{ __('Assuntos') }}
                    </a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-create-classificacoes"
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        {{ __('Classificações') }}
                    </a>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        {{ __('Sair') }}
                    </a>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
@endauth
