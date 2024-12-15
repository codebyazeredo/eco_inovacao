<x-app-layout>
    <x-slot name="header">
        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-md-8">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight d-flex align-items-center gap-2">
                    {{ __('Criar Novo Evento') }}
                    <i class="fa fa-exclamation-triangle" data-tippy-content="Os campos marcados com (*) são obrigatórios." aria-hidden="true" style="font-size: 15px; color: #ffc107"></i>
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Os eventos criados ficarão pendentes de aprovação do administrador do sistema para serem exibidos.') }}
                </p>
            </div>

            <div class="col-md-4 d-flex justify-content-end gap-2">
                <button class="btn btn-danger">Cancelar</button>
                <button class="btn btn-success">Publicar Evento</button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto xl:w-auto space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div style="padding: 20px">
                    @include('Evento.partials._form-info')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div style="padding: 20px">
                    @include('Evento.partials._form-local')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div style="padding: 20px">
                    @include('Evento.partials._form-descricao')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div style="padding: 20px">
                    @include('Evento.partials._form-data-hora')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div style="padding: 20px">
                    @include('Evento.partials._form-confirm')
                </div>
            </div>

            <div class="d-flex justify-content-between gap-2">
                <div class="justify-content-start">
                    <button class="btn btn-secondary">Voltar ao topo</button>
                </div>
                <div>
                    <button class="btn btn-danger">Cancelar</button>
                    <button class="btn btn-success">Publicar Evento</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="{{ asset('js/views/Evento/index.js') }}"></script>
