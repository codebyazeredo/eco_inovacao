<section>
    <header class="mb-12">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('3. Descrição') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Conte-nos como será o seu evento, como diferenciais e detalhes sobre a programação.') }}
        </p>
    </header>

    <div class="mb-3">
        <div id="descricao" style="height: 300px; background-color: white;"></div>
        <x-input-error :messages="$errors->get('descricao')" class="mt-2"/>
    </div>
    <input type="hidden" name="descricao" id="descricao_input">
</section>

<script src="{{ asset('js/views/Evento/_form-descricao.js') }}"></script>

