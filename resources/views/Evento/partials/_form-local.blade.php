<style>
    .text-danger {
        color: red !important;
    }
</style>

<section>
    <header class="mb-12">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('2. Onde o seu evento vai acontecer?') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Informe onde ocorrerá o evento.') }}
        </p>
    </header>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <x-input-label for="local_evento" :value="__('Informe o endereco do evento')"/>
                <x-text-input id="local_evento" name="nome_local" type="text" class="mt-1 block w-full"
                              placeholder="Informe o nome do local do evento" />
                <datalist id="suggestions"></datalist>
                <x-input-error :messages="$errors->get('local_evento')" class="mt-2"/>
            </div>

            <div class="mb-3">
                <x-input-label for="local_nome" :value="__('Nome do local')"/>
                <x-text-input id="local_nome" name="local_nome" type="text" class="mt-1 block w-full" maxlength="100"/>
                <x-input-error :messages="$errors->get('local_nome')" class="mt-2"/>
                <small id="charCountLocal" class="form-text text-muted">0 / 100 caracteres</small>
            </div>

            <div class="mb-3">
                <x-input-label for="cep" :value="__('CEP')"/>
                <x-text-input id="cep" name="cep" type="text" class="mt-1 block w-full"
                              />
                <x-input-error :messages="$errors->get('cep')" class="mt-2"/>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <x-input-label for="cidade" :value="__('Cidade')"/>
                    <x-text-input id="cidade" name="cidade" type="text" class="mt-1 block w-full" value="Criciúma" readonly/>
                    <x-input-error :messages="$errors->get('cidade')" class="mt-2"/>
                </div>

                <div class="col-md-6">
                    <x-input-label for="estado" :value="__('Estado')"/>
                    <select id="estado" name="estado" class="mt-1 block w-full">
                        <option value="SC" selected>SC</option>
                    </select>
                    <x-input-error :messages="$errors->get('estado')" class="mt-2"/>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <x-input-label for="bairro" :value="__('Bairro')"/>
                    <x-text-input id="bairro" name="bairro" type="text" class="mt-1 block w-full"/>
                    <x-input-error :messages="$errors->get('bairro')" class="mt-2"/>
                </div>

                <div class="col-md-6">
                    <x-input-label for="rua" :value="__('Av./Rua')"/>
                    <x-text-input id="address" name="rua" type="text" list="suggestions" class="mt-1 block w-full"
                                  placeholder="Digite o endereço do evento" autocomplete="off"/>
                    <datalist id="suggestions"></datalist>
                    <x-input-error :messages="$errors->get('rua')" class="mt-2"/>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-10">
                    <x-input-label for="complemento" :value="__('Complemento')"/>
                    <x-text-input id="complemento" name="complemento" type="text" class="mt-1 block w-full" maxlength="100"
                                  placeholder="Digite informações adicionais do local (opcional)"/>
                    <x-input-error :messages="$errors->get('complemento')" class="mt-2"/>
                    <small id="charCountComplemento" class="form-text text-muted">0 / 100 caracteres</small>
                </div>

                <div class="col-md-2">
                    <x-input-label for="numero" :value="__('Número')"/>
                    <x-text-input id="numero" name="numero" type="text" class="mt-1 block w-full"/>
                    <x-input-error :messages="$errors->get('numero')" class="mt-2"/>
                </div>
            </div>
        </div>

        <div class="col-md-6 mt-3">
            <div id="map" style="height: 470px; margin-top: 10px;"></div>
            <x-text-input id="latitude" name="latitude" type="text" class="mt-1 block w-full" hidden/>
            <x-text-input id="longitude" name="longitude" type="text" class="mt-1 block w-full" hidden/>
        </div>
    </div>
</section>

<script src="{{ asset('js/views/Evento/_form-local.js') }}"></script>
