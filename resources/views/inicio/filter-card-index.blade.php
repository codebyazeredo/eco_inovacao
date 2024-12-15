<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-center text-gray-900">
                <h2 class="text-2xl font-bold">{{ __("Bem Vindo(a)! O que está procurando?") }}</h2>
            </div>

            <div class="row align-items-center justify-content-center pb-6">
                <div class="col-md-6">
                    <label for="search-events"></label>
                    <x-search id="search-events" />
                </div>
                <div class="col-md-2">
                    <label>&nbsp;</label>
                    <button
                        class="btn btn-dark"
                        style="width: 105%"
                        data-bs-toggle="modal"
                        data-bs-target="#customSearchModal"
                        id="buscaPersonalizada">
                        <i class="bi bi-funnel"></i> {{ __("Busca personalizada") }}
                    </button>
                </div>
                <div class="col-md-2">
                    <label>&nbsp;</label>
                    <button
                        class="btn btn-dark"
                        style="width: 50%; transform: translateY(30%)"
                        type="submit"
                        id="busca">
                        {{ __("Buscar") }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
