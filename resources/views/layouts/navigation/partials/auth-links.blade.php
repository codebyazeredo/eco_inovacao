<div class="hidden sm:flex space-x-8">
    @auth
        <x-nav-link :href="route('eventos.create')" :active="request()->routeIs('eventos')">
            {{ __('Criar Evento') }}
        </x-nav-link>
        @if(Auth::user()->isAdmin())
            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                {{ __('Área do Administrador') }}
            </x-nav-link>
        @else
            <x-nav-link :href="route('produtor.dashboard')" :active="request()->routeIs('produtor.dashboard')">
                {{ __('Área do produtor') }}
            </x-nav-link>
        @endif
    @else
        <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
            {{ __('Login') }}
        </x-nav-link>
        <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
            {{ __('Register') }}
        </x-nav-link>
    @endauth
</div>
