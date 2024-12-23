<div class="modal fade" id="modal-create-categorias" tabindex="-1" aria-labelledby="modal-create-categorias-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content border-0 rounded-3 shadow-lg">
            <div class="modal-header bg-light text-dark rounded-top-3">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Gerenciar Categorias
                </h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <div class="mb-4">
                    <h5 class="mb-3" id="modal-categoria-title">Adicionar Nova Categoria</h5>
                    <form id="form-create-categoria">
                        @csrf
                        <input type="hidden" id="categoria-id">
                        <div class="mb-3">
                            <label for="categoria-nome" class="form-label">Nome</label>
                            <input
                                class="form-control"
                                id="categoria-nome"
                                placeholder="Digite o nome da categoria"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="categoria-descricao" class="form-label">Descrição</label>
                            <textarea
                                class="form-control"
                                id="categoria-descricao"
                                rows="3"
                                placeholder="Digite a descrição da categoria"
                                required>
                            </textarea>
                        </div>
                        <button type="submit" class="btn btn-dark mb-3" id="btn-create-categoria">
                            Criar Nova Categoria
                        </button>

                        <button type="button" class="btn btn-outline-secondary mb-3 d-none" id="btn-cancelar-edicao" onclick="cancelarEdicaoCategoria()"><i class="bi bi-x"></i> Cancelar Edição</button>
                    </form>
                </div>

                <div>
                    <h5 class="mb-3 mt-4">Listagem de Categorias</h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="align-middle">ID</th>
                                <th class="align-middle">Nome</th>
                                <th class="align-middle">Descrição</th>
                                <th class="align-middle">Ações</th>
                            </tr>
                            </thead>
                            <tbody id="categorias-list"></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Fechar</button>
                <button type="button" class="btn btn-dark" id="btn-save-categorias"><i class="bi bi-arrow-clockwise"></i> Atualizar</button>
            </div>
        </div>
    </div>
</div>
