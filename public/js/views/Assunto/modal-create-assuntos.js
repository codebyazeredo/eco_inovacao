$(document).ready(function () {
    const $formularioCriarAssunto = $('#form-create-assunto');
    const $listaAssuntos = $('#assuntos-list');
    const $modalAssuntoTitle = $('#modal-assunto-title');
    const $botaoCriarEditar = $('#btn-create-assunto');
    const $btnCancelarEdicao = $('#btn-cancelar-edicao');
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        },
    });

    let editingAssuntoId = null;

    $formularioCriarAssunto.on('submit', async function (evento) {
        evento.preventDefault();

        const tipo = $('#assunto-tipo').val().trim();
        const descricao = $('#assunto-descricao').val().trim();
        const dados = { tipo, descricao };

        if (!tipo || !descricao) {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'Preencha todos os campos.',
                confirmButtonColor: '#000000'
            });
            return;
        }

        try {
            if (editingAssuntoId) {
                await $.ajax({
                    url: `/assuntos/${editingAssuntoId}`,
                    method: 'PUT',
                    contentType: 'application/json',
                    data: JSON.stringify(dados),
                });
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso',
                    text: 'Assunto atualizado com sucesso!',
                    confirmButtonColor: '#000000'
                });
            } else {
                await $.ajax({
                    url: '/assuntos',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(dados),
                });
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso',
                    text: 'Assunto criado com sucesso!',
                    confirmButtonColor: '#000000'
                });
            }

            $('#assunto-tipo').val('');
            $('#assunto-descricao').val('');
            $modalAssuntoTitle.text('Adicionar Novo Assunto');
            $botaoCriarEditar.text('Criar Novo Assunto');
            $btnCancelarEdicao.addClass('d-none');
            editingAssuntoId = null;
            await atualizarListaAssuntos();
        } catch (erro) {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: erro.responseJSON.message || erro.message,
                confirmButtonColor: '#000000'
            });
        }
    });

    async function atualizarListaAssuntos() {
        try {
            const resposta = await $.ajax({
                url: '/assuntos',
                method: 'GET',
                contentType: 'application/json',
            });
            renderizarListaAssuntos(resposta.assuntos);
        } catch (erro) {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: erro.responseJSON.message || erro.message,
                confirmButtonColor: '#000000'
            });
        }
    }

    function renderizarListaAssuntos(assuntos) {
        $listaAssuntos.empty();
        assuntos.forEach((assunto) => {
            const $linha = $(`
                <tr>
                    <td class="align-middle">${assunto.id}</td>
                    <td class="align-middle">${assunto.tipo}</td>
                    <td class="align-middle">${assunto.descricao}</td>
                    <td class="align-middle">
                        <button class="btn btn-warning btn-sm" onclick="editarAssunto(${assunto.id})"><i class="bi bi-pencil-square"></i></button>
                        <button class="btn btn-danger btn-sm" onclick="excluirAssunto(${assunto.id})"><i class="bi bi-trash3"></i></button>
                    </td>
                </tr>
            `);
            $listaAssuntos.append($linha);
        });
    }

    window.excluirAssunto = async (id) => {
        Swal.fire({
            title: 'Você tem certeza?',
            text: 'Deseja realmente excluir este assunto?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#000000'
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    await $.ajax({
                        url: `/assuntos/${id}`,
                        method: 'DELETE',
                        contentType: 'application/json',
                    });
                    Swal.fire({
                        icon: 'success',
                        title: 'Excluído!',
                        text: 'Assunto excluído com sucesso!',
                        confirmButtonColor: '#000000'
                    });
                    await atualizarListaAssuntos();
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

    window.editarAssunto = async (id) => {
        try {
            const resposta = await $.ajax({
                url: `/assuntos/${id}`,
                method: 'GET',
                contentType: 'application/json',
            });

            const assunto = resposta.assunto;

            $('#assunto-tipo').val(assunto.tipo);
            $('#assunto-descricao').val(assunto.descricao);

            $modalAssuntoTitle.text('Editar Assunto');
            $botaoCriarEditar.text('Salvar Alterações');
            $btnCancelarEdicao.removeClass('d-none');

            editingAssuntoId = assunto.id;

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

    window.cancelarEdicao = () => {
        $('#assunto-tipo').val('');
        $('#assunto-descricao').val('');
        $modalAssuntoTitle.text('Adicionar Novo Assunto');
        $botaoCriarEditar.text('Criar Novo Assunto');
        $btnCancelarEdicao.addClass('d-none');
        editingAssuntoId = null;
    };

    atualizarListaAssuntos();
});
