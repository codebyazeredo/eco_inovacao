document.addEventListener("DOMContentLoaded", function () {
    const quill = new Quill('#descricao', {
        theme: 'snow',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline'],
                [{'list': 'ordered'}, {'list': 'bullet'}],
                ['link', 'blockquote', 'code-block'],
                [{'header': [1, 2, 3, false]}],
                ['clean']
            ]
        },
        placeholder: 'Adicione aqui a descrição do seu evento...'
    });

    const descricaoInput = document.getElementById('descricao_input');
    quill.on('text-change', function () {
        descricaoInput.value = quill.root.innerHTML;
    });
});
