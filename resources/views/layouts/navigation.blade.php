<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 transform translate-y-4">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:ms-10 sm:flex">
                    <x-nav-link :href="route('inicio')" :active="request()->routeIs('inicio')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link>
                        {{ __('Sobre') }}
                    </x-nav-link>
                    <x-nav-link>
                        {{ __('Grupos de trabalho') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="flex space-x-8">
                <div class="hidden sm:flex space-x-8">
                    @auth
                        <x-nav-link :href="route('eventos.create')" :active="request()->routeIs('eventos')">
                            {{ __('Criar Evento') }}
                        </x-nav-link>

                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Área do produtor') }}
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                            {{ __('Login') }}
                        </x-nav-link>
                        <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                            {{ __('Register') }}
                        </x-nav-link>
                    @endauth
                </div>

                @auth
                    <div class="hidden sm:flex transform translate-y-4">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Perfil') }}
                                </x-dropdown-link>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                                     onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Sair') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endauth
            </div>

            <div class="-me-2 flex sm:hidden">
                <button @click="open = !open" class="inline-flex justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': !open }" class="sm:hidden">
        <div class="space-y-1 pt-2 pb-3 border-t border-gray-200">
            <x-nav-link :href="route('inicio')" :active="request()->routeIs('inicio')">
                {{ __('Home') }}
            </x-nav-link>
            <x-nav-link>
                {{ __('Sobre') }}
            </x-nav-link>
            <x-nav-link>
                {{ __('Grupos de trabalho') }}
            </x-nav-link>
            @auth

                <x-nav-link id="criarEvento" data-bs-toggle="modal" data-bs-target="#modalCriarEvento" class="nav-link">
                    {{ __('Criar Evento') }}
                </x-nav-link>

                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-nav-link>
                <x-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Sair') }}
                </x-nav-link>
            @else
                <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                    {{ __('Login') }}
                </x-nav-link>
                <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                    {{ __('Registrar') }}
                </x-nav-link>
            @endauth
        </div>
    </div>
</nav>
