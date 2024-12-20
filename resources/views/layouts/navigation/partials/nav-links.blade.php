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
