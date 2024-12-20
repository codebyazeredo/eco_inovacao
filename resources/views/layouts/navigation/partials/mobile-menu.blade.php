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
