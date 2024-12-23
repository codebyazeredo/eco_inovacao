$(document).ready(function () {
    const $formularioCriarClassificacao = $('#form-create-classificacao');
    const $listaClassificacoes = $('#classificacoes-list');
    const $modalClassificacaoTitle = $('#modal-classificacao-title');
    const $botaoCriarEditarClassificacao = $('#btn-create-classificacao');
    const $btnCancelarEdicaoClassificacao = $('#btn-cancelar-edicao-classificacao');
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        },
    });

    let editingClassificacaoId = null;

    $formularioCriarClassificacao.on('submit', async function (evento) {
        evento.preventDefault();

        const nome = $('#classificacao-nome').val().trim();
        const sigla = $('#classificacao-sigla').val().trim();
        const dados = { nome, sigla };

        if (!nome || !sigla) {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'Preencha todos os campos.',
                confirmButtonColor: '#000000'
            });
            return;
        }

        try {
            if (editingClassificacaoId) {
                const resposta = await $.ajax({
                    url: `/classificacoes/${editingClassificacaoId}`,
                    method: 'PUT',
                    contentType: 'application/json',
                    data: JSON.stringify(dados),
                });

                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso',
                    text: resposta.message || 'Classificação Indicativa atualizada com sucesso!',
                    confirmButtonColor: '#000000'
                });
            } else {
                const resposta = await $.ajax({
                    url: '/classificacoes',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(dados),
                });

                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso',
                    text: resposta.message || 'Classificação Indicativa criada com sucesso!',
                    confirmButtonColor: '#000000'
                });
            }

            $('#classificacao-nome').val('');
            $('#classificacao-sigla').val('');
            $modalClassificacaoTitle.text('Adicionar Nova Classificação Indicativa');
            $botaoCriarEditarClassificacao.text('Criar Nova Classificação Indicativa');
            $btnCancelarEdicaoClassificacao.addClass('d-none');
            editingClassificacaoId = null;
            await atualizarListaClassificacoes();
        } catch (erro) {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: erro.responseJSON.message || erro.message,
                confirmButtonColor: '#000000'
            });
        }
    });

    async function atualizarListaClassificacoes() {
        try {
            const resposta = await $.ajax({
                url: '/classificacoes',
                method: 'GET',
                contentType: 'application/json',
            });
            renderizarListaClassificacoes(resposta.classificacoes);
        } catch (erro) {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: erro.responseJSON.message || erro.message,
                confirmButtonColor: '#000000'
            });
        }
    }

    function renderizarListaClassificacoes(classificacoes) {
        $listaClassificacoes.empty();
        classificacoes.forEach((classificacao) => {
            const $linha = $(`
                <tr>
                    <td class="align-middle">${classificacao.id}</td>
                    <td class="align-middle">${classificacao.nome}</td>
                    <td class="align-middle">${classificacao.sigla}</td>
                    <td class="align-middle">
                        <button class="btn btn-warning btn-sm" onclick="editarClassificacao(${classificacao.id})">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="excluirClassificacao(${classificacao.id})">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </td>
                </tr>
            `);
            $listaClassificacoes.append($linha);
        });
    }

    window.excluirClassificacao = async (id) => {
        Swal.fire({
            title: 'Você tem certeza?',
            text: 'Deseja realmente excluir esta classificação?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#000000'
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    const resposta = await $.ajax({
                        url: `/classificacoes/${id}`,
                        method: 'DELETE',
                        contentType: 'application/json',
                    });
                    Swal.fire({
                        icon: 'success',
                        title: 'Excluída!',
                        text: resposta.message || 'Classificação excluída com sucesso!',
                        confirmButtonColor: '#000000'
                    });
                    await atualizarListaClassificacoes();
                } catch (erro) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: erro.responseJSON.message || erro.message,
                        confirmButtonColor: '#000000'
                    });
                }
            }
        });
    };

    window.editarClassificacao = async (id) => {
        try {
            const resposta = await $.ajax({
                url: `/classificacoes/${id}`,
                method: 'GET',
                contentType: 'application/json',
            });

            const classificacao = resposta.classificacao;

            $('#classificacao-nome').val(classificacao.nome);
            $('#classificacao-sigla').val(classificacao.sigla);

            $modalClassificacaoTitle.text('Editar Classificação Indicativa');
            $botaoCriarEditarClassificacao.text('Salvar Alterações');
            $btnCancelarEdicaoClassificacao.removeClass('d-none');

            editingClassificacaoId = classificacao.id;

            $('.modal-body').scrollTop(0);
        } catch (erro) {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: erro.responseJSON.message || erro.message,
                confirmButtonColor: '#000000'
            });
        }
    };

    window.cancelarEdicaoClassificacao = () => {
        $('#classificacao-nome').val('');
        $('#classificacao-sigla').val('');
        $modalClassificacaoTitle.text('Adicionar Nova Classificação Indicativa');
        $botaoCriarEditarClassificacao.text('Criar Nova Classificação Indicativa');
        $btnCancelarEdicaoClassificacao.addClass('d-none');
        editingClassificacaoId = null;
    };

    atualizarListaClassificacoes();
});
