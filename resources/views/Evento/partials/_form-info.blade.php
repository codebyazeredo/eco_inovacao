<section>
    <header class="mb-12">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('1. Informações Básicas') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Adicione as principais informações sobre o evento.') }}
        </p>
    </header>

    <div class="row">
        <div class="col-md-12">
            <div class="d-flex align-items-center">
                <x-input-label for="nome_evento" :value="__('Nome do evento')" />
                <x-obrigatorio-simbolo />
            </div>
            <x-text-input id="nome_evento" name="nome_evento" type="text" class="mt-1 block w-full"
                          placeholder="Digite o nome do evento" maxlength="100"/>
            <x-input-error :messages="$errors->get('nome_evento')" class="mt-2"/>
            <small id="charCountNome" class="form-text text-muted">0 / 100 caracteres</small>
        </div>

        <div class="col-md-6 mt-8">
            <x-input-label for="imagem_capa" :value="__('Imagem da capa')"/>
            @include('components.file-input')
        </div>

        <div class="col-md-4 mt-8 d-flex justify-content-center align-items-center" style="transform: translateX(20%)">
            <p class="text-center text-gray-600">
                A dimensão recomendada é de 1600 x 838
                (mesma proporção do formato utilizado nas páginas de evento no Facebook).
                Formato JPEG, GIF ou PNG de no máximo 2MB.
                Imagens com dimensões diferentes serão redimensionadas.
            </p>
        </div>

        <div class="col-md-3 mt-7">
            <div class="d-flex align-items-center">
                <x-input-label for="assunto" :value="__('Assunto')" />
                <x-obrigatorio-simbolo />
            </div>
            <select id="assunto-eventos-select2" name="assuntoEventos[]" class="js-select2-multiple shadow sm:rounded-lg" multiple="multiple" style="width: 100%;">

            </select>
            <x-input-error :messages="$errors->get('assunto')" class="mt-2"/>
        </div>

        <div class="col-md-3 mt-8">
            <x-input-label for="categoria" :value="__('Categoria (opcional)')"/>
            <select id="categoria-eventos-select2"
                    name="categoria"
                    class="js-example-basic-single"
                    style="width: 100%;">
                <option>1</option>
                <option>2</option>
                <option>3</option>
            </select>
            <x-input-error :messages="$errors->get('categorias')" class="mt-2"/>
        </div>

        <div class="col-md-3 mt-7">
            <div class="d-flex align-items-center">
            <x-input-label for="classificacao" :value="__('Classificação Indicativa')"/>
                <x-obrigatorio-simbolo />
            </div>
            <select id="classificacao-eventos-select2" name="classificacao"
                    class="js-example-basic-single" style="width: 100%;">
                <option>1</option>
                <option>2</option>
                <option>3</option>
            </select>
            <x-input-error :messages="$errors->get('categorias')" class="mt-2"/>
        </div>

        <div class="col-md-3 mt-7">
            <x-input-label for="eventoPrivadoSwitch" :value="__('Evento privado')" />
            <div class="form-check form-switch d-flex justify-content-start">
                <input class="form-check-input" type="checkbox" id="eventoPrivadoSwitch">
            </div>
        </div>
    </div>



    <script src="{{ asset('js/views/Evento/_form-info.js') }}"></script>


