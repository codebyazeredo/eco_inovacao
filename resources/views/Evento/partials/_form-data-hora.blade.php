<style>
    .input-group-text {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .input-group .form-control {
        height: calc(2.25rem + 2px);
    }

</style>

<section>
    <header class="mb-12">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('4. Data e hora') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Informe a data e a hora de inicio e término do seu evento.') }}
        </p>
    </header>

    <div class="row mb-3">
        <div class="col-md-3">
            <div class="d-flex align-items-center">
                <x-input-label for="data_inicio" :value="__('Data de Início')"/>
                <x-obrigatorio-simbolo/>
            </div>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                <x-text-input id="data_inicio" name="data_inicio" type="text" class="form-control"
                              placeholder="Selecione a data de início"/>
            </div>
            <x-input-error :messages="$errors->get('data_inicio')" class="mt-2"/>
        </div>

        <div class="col-md-2 mr-12">
            <div class="d-flex align-items-center">
                <x-input-label for="hora_inicio" :value="__('Hora de Início')"/>
                <x-obrigatorio-simbolo/>
            </div>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-clock"></i></span>
                <x-text-input id="hora_inicio" name="hora_inicio" type="text" class="form-control"
                              placeholder="Selecione a hora de início"/>
            </div>
            <x-input-error :messages="$errors->get('hora_inicio')" class="mt-2"/>
        </div>

        <div class="col-md-3 ml-12">
            <div class="d-flex align-items-center">
                <x-input-label for="data_fim" :value="__('Data de Término')"/>
                <x-obrigatorio-simbolo/>
            </div>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                <x-text-input id="data_fim" name="data_fim" type="text" class="form-control"
                              placeholder="Selecione a data de fim"/>
            </div>
            <x-input-error :messages="$errors->get('data_fim')" class="mt-2"/>
        </div>

        <div class="col-md-2">
            <div class="d-flex align-items-center">
                <x-input-label for="hora_fim" :value="__('Hora de Término')"/>
                <x-obrigatorio-simbolo/>
            </div>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-clock"></i></span>
                <x-text-input id="hora_fim" name="hora_fim" type="text" class="form-control"
                              placeholder="Selecione a hora de fim"/>
            </div>
            <x-input-error :messages="$errors->get('hora_fim')" class="mt-2"/>
        </div>
    </div>
</section>

<script src="{{ asset('js/views/Evento/_form-data-hora.js') }}"></script>

