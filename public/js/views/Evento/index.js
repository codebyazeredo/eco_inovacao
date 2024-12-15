document.addEventListener('DOMContentLoaded', () => {

    tippy('[data-tippy-content]', {
        theme: 'light',
        animation: 'scale',
        placement: 'right',
    });

    function contagemDeCaracteres(inputId, counterId) {
        const $input = $(`#${inputId}`);
        const $counter = $(`#${counterId}`);
        const maxLength = $input.attr('maxlength');

        $input.on('input', function () {
            const charCount = $(this).val().length;
            $counter.text(`${charCount} / ${maxLength} caracteres`);

            if (charCount >= maxLength) {
                $counter
                    .addClass('text-danger')
                    .text(`${charCount} / ${maxLength} Máximo de caracteres atingido!`);
            } else {
                $counter.removeClass('text-danger');
            }
        });
    }

    contagemDeCaracteres('local_nome', 'charCountLocal');
    contagemDeCaracteres('complemento', 'charCountComplemento');
    contagemDeCaracteres('nome_evento', 'charCountNome');
})
