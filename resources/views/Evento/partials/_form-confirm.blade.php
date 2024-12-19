<style>
    .form-check-label {
        font-size: 14px;
        color: #555;
    }
</style>

<section>
    <header class="mb-6">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('5. Responsabilidade e aprovação') }}
        </h2>
        <p class="mt-2 text-sm text-gray-600">
            {{ __('Antes de criar o evento, leia atentamente as condições abaixo e marque a caixa para confirmar que você está de acordo com elas.') }}
        </p>
    </header>

    <div class="row">
        <div class="col-md-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="responsabilidade" name="responsabilidade" required>
                <div class="d-flex align-items-center">
                    <label class="form-check-label" for="responsabilidade">
                        <strong>Eu concordo com os seguintes termos</strong>

                    </label>
                    <x-obrigatorio-simbolo/>
                </div>

                <div class="mt-3">
                    <ul class="text-sm text-gray-600 pl-4">
                        <li>Você é o responsável pelas informações fornecidas no evento, garantindo que elas sejam
                            verídicas e precisas.
                        </li>
                        <li>O evento passará por uma análise e será revisado pela nossa equipe antes de ser publicado.
                        </li>
                        <li>Qualquer evento que não atender aos nossos critérios de conteúdo e/ou políticas será
                            recusado.
                        </li>
                        <li>Você entende que, ao submeter o evento, ele não será imediatamente visível ao público,
                            aguardando aprovação.
                        </li>
                    </ul>
                </div>

                <div class="mt-4">
                    <strong>Ao prosseguir, você declara estar ciente e de acordo com essas condições.</strong>
                </div>
            </div>
            <x-input-error :messages="$errors->get('responsabilidade')" class="mt-2"/>
        </div>
    </div>
</section>

