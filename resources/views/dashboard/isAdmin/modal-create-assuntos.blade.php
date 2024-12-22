<div class="modal fade" id="modal-create-assuntos" tabindex="-1" aria-labelledby="modal-create-assuntos-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content border-0 rounded-3 shadow-lg">
            <div class="modal-header bg-light text-dark rounded-top-3">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Gerenciar Assuntos
                </h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <h5 class="mb-3" id="modal-assunto-title">Adicionar Novo Assunto</h5>
                    <form id="form-create-assunto">
                        @csrf
                        <input type="hidden" id="assunto-id">
                        <div class="mb-3">
                            <label for="assunto-tipo" class="form-label">Tipo</label>
                            <input
                                class="form-control"
                                id="assunto-tipo"
                                placeholder="Digite o tipo do assunto"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="assunto-descricao" class="form-label">Descrição</label>
                            <textarea
                                class="form-control"
                                id="assunto-descricao"
                                rows="3"
                                placeholder="Digite a descrição do assunto"
                                required>
                            </textarea>
                        </div>
                        <button type="submit" class="btn btn-dark mb-3" id="btn-create-assunto">
                            Criar Novo Assunto
                        </button>

                        <button type="button" class="btn btn-outline-secondary mb-3 d-none" id="btn-cancelar-edicao" onclick="cancelarEdicao()"><i class="bi bi-x"></i> Cancelar Edição</button>
                    </form>
                </div>

                <div>
                    <h5 class="mb-3 mt-4">Listagem de Assuntos</h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="align-middle">ID</th>
                                <th class="align-middle">Tipo</th>
                                <th class="align-middle">Descrição</th>
                                <th class="align-middle">Ações</th>
                            </tr>
                            </thead>
                            <tbody id="assuntos-list"></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Fechar</button>
                <button type="button" class="btn btn-dark" id="btn-save-assuntos"><i class="bi bi-arrow-clockwise"></i> Atualizar</button>
            </div>
        </div>
    </div>
</div>
