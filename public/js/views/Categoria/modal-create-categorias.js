$(document).ready(function () {
    const $formularioCriarCategoria = $('#form-create-categoria');
    const $listaCategorias = $('#categorias-list');
    const $modalCategoriaTitle = $('#modal-categoria-title');
    const $botaoCriarEditarCategoria = $('#btn-create-categoria');
    const $btnCancelarEdicaoCategoria = $('#btn-cancelar-edicao-categoria');
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        },
    });

    let editingCategoriaId = null;

    $formularioCriarCategoria.on('submit', async function (evento) {
        evento.preventDefault();

        const nome = $('#categoria-nome').val().trim();
        const descricao = $('#categoria-descricao').val().trim();
        const dados = { nome, descricao };

        if (!nome || !descricao) {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: 'Preencha todos os campos.',
                confirmButtonColor: '#000000'
            });
            return;
        }

        try {
            if (editingCategoriaId) {
                await $.ajax({
                    url: `/categorias/${editingCategoriaId}`,
                    method: 'PUT',
                    contentType: 'application/json',
                    data: JSON.stringify(dados),
                });
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso',
                    text: 'Categoria atualizada com sucesso!',
                    confirmButtonColor: '#000000'
                });
            } else {
                await $.ajax({
                    url: '/categorias',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(dados),
                });
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso',
                    text: 'Categoria criada com sucesso!',
                    confirmButtonColor: '#000000'
                });
            }

            $('#categoria-nome').val('');
            $('#categoria-descricao').val('');
            $modalCategoriaTitle.text('Adicionar Nova Categoria');
            $botaoCriarEditarCategoria.text('Criar Nova Categoria');
            $btnCancelarEdicaoCategoria.addClass('d-none');
            editingCategoriaId = null;
            await atualizarListaCategorias();
        } catch (erro) {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: erro.responseJSON.message || erro.message,
                confirmButtonColor: '#000000'
            });
        }
    });

    async function atualizarListaCategorias() {
        try {
            const resposta = await $.ajax({
                url: '/categorias',
                method: 'GET',
                contentType: 'application/json',
            });
            renderizarListaCategorias(resposta.categorias);
        } catch (erro) {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                text: erro.responseJSON.message || erro.message,
                confirmButtonColor: '#000000'
            });
        }
    }

    function renderizarListaCategorias(categorias) {
        $listaCategorias.empty();
        categorias.forEach((categoria) => {
            const $linha = $(`
                <tr>
                    <td class="align-middle">${categoria.id}</td>
                    <td class="align-middle">${categoria.nome}</td>
                    <td class="align-middle">${categoria.descricao}</td>
                    <td class="align-middle">
                        <button class="btn btn-warning btn-sm" onclick="editarCategoria(${categoria.id})"><i class="bi bi-pencil-square"></i></button>
                        <button class="btn btn-danger btn-sm" onclick="excluirCategoria(${categoria.id})"><i class="bi bi-trash3"></i></button>
                    </td>
                </tr>
            `);
            $listaCategorias.append($linha);
        });
    }

    window.excluirCategoria = async (id) => {
        Swal.fire({
            title: 'Você tem certeza?',
            text: 'Deseja realmente excluir esta categoria?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#000000'
        }).then(async (result) => {
            if (result.isConfirmed) {
                try {
                    await $.ajax({
                        url: `/categorias/${id}`,
                        method: 'DELETE',
                        contentType: 'application/json',
                    });
                    Swal.fire({
                        icon: 'success',
                        title: 'Excluída!',
                        text: 'Categoria excluída com sucesso!',
                        confirmButtonColor: '#000000'
                    });
                    await atualizarListaCategorias();
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

    window.editarCategoria = async (id) => {
        try {
            const resposta = await $.ajax({
                url: `/categorias/${id}`,
                method: 'GET',
                contentType: 'application/json',
            });

            const categoria = resposta.categoria;

            $('#categoria-nome').val(categoria.nome);
            $('#categoria-descricao').val(categoria.descricao);

            $modalCategoriaTitle.text('Editar Categoria');
            $botaoCriarEditarCategoria.text('Salvar Alterações');
            $btnCancelarEdicaoCategoria.removeClass('d-none');

            editingCategoriaId = categoria.id;

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

    window.cancelarEdicaoCategoria = () => {
        $('#categoria-nome').val('');
        $('#categoria-descricao').val('');
        $modalCategoriaTitle.text('Adicionar Nova Categoria');
        $botaoCriarEditarCategoria.text('Criar Nova Categoria');
        $btnCancelarEdicaoCategoria.addClass('d-none');
        editingCategoriaId = null;
    };

    atualizarListaCategorias();
});
