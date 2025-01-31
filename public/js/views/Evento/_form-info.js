document.addEventListener('DOMContentLoaded', function () {
    let maxLength = 100;
    let charCount = document.getElementById('charCount');
    let nome_evento = document.getElementById('nome_evento');

    $(document).ready(function () {
        $('#categoria-eventos-select2').select2({
            placeholder: "Selecione a categoria",
            allowClear: true
        });

        $(document).ready(function () {
            $('#assunto-eventos-select2').select2({
                placeholder: "Selecione o assunto",
                allowClear: true,
                ajax: {
                    url: '/select2/assuntos',
                    type: 'GET',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });
        });

        $('#classificacao-eventos-select2').select2({
            placeholder: "Selecione a classificação indicativa",
            allowClear: true
        });
    });

    nome_evento.addEventListener('input', function () {
        let currentLength = nome_evento.value.length;
        charCount.textContent = currentLength + ' / ' + maxLength + ' caracteres';

        if (currentLength > maxLength) {
            charCount.style.color = '#EF0000';
        } else {
            charCount.style.color = '';
        }
    });
});
