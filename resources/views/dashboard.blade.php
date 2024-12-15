<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Eventos Cadastrados") }}

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="align-middle">Nome</th>
                                <th class="align-middle">Local</th>
                                <th class="align-middle">Data</th>
                                <th class="align-middle">Classificacao</th>
                                <th class="align-middle">Status</th>
                                <th class="align-middle">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="align-middle"> Evento 1</td>
                                <td class="align-middle"> Escola ABC</td>
                                <td class="align-middle"> 12/12/2024 </td>
                                <td class="align-middle"> Livre </td>
                                <td class="align-middle"> Pendente </td>
                                <td>
                                    <button class="btn btn-sm btn-warning">Visualizar</button>
                                    <button class="btn btn-sm btn-success">Aprovar</button>
                                    <button class="btn btn-sm btn-danger">Reprovar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
