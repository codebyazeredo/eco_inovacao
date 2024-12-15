<x-app-layout>
    <x-slot name="header">
        Carousel logo
    </x-slot>

    @include('inicio.filter-card-index')


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Eventos") }}

                    calendario
                </div>
            </div>
        </div>

    @include('inicio.modal-busca-personalizada')
    @include('inicio.modal-criar-evento')
</x-app-layout>
