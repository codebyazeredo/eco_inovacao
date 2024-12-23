<div class="modal fade" id="modal-create-classificacoes" tabindex="-1" aria-labelledby="modal-create-classificacoes-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content border-0 rounded-3 shadow-lg">
            <div class="modal-header bg-light text-dark rounded-top-3">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Classificações Indicativas') }}
                </h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <h5 class="mb-3" id="modal-title">Adicionar Nova Classificação Indicativa</h5>
                    <form id="form-create-classificacao">
                        @csrf
                        <input type="hidden" id="classificacao-id">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <x-input-label for="classificacao-nome" :value="__('Nome')" />
                                <input class="form-control" id="classificacao-nome" placeholder="Digite o nome da classificação" required>
                            </div>
                            <div class="col-md-2 mb-3">
                                <x-input-label for="classificacao-sigla" :value="__('Sigla')" />
                                <input class="form-control" id="classificacao-sigla" placeholder="Digite a sigla" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-dark mb-3" id="btn-create-classificacao">Criar Nova Classificação</button>
                        <button type="button" class="btn btn-outline-secondary mb-3 d-none" id="btn-cancelar-edicao-classificacao" onclick="cancelarEdicaoClassificacao()"><i class="bi bi-x"></i> Cancelar Edição</button>
                    </form>
                </div>

                <div>
                    <h5 class="mb-3 mt-4">Listagem de Classificações Indicativas</h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="align-middle">ID</th>
                                <th class="align-middle">Nome</th>
                                <th class="align-middle">Sigla</th>
                                <th class="align-middle">Ações</th>
                            </tr>
                            </thead>
                            <tbody id="classificacoes-list"></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Fechar</button>
                <button type="button" class="btn btn-dark" id="btn-save-classificacoes"><i class="bi bi-arrow-clockwise"></i> Atualizar</button>
            </div>
        </div>
    </div>
</div>
