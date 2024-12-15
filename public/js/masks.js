// set flatpickr defaults
flatpickr.setDefaults({
    dateFormat: "Y-m-d",
    locale: "pt",
    allowInput: true,
    altFormat: "d/m/Y",
    altInput: true,
});

// set blockui defaults
$.blockUI.defaults.message = `
    <h5 class="text-primary">Aguarde...</h5>
     <div class="sk-chase sk-center mt-5">
         <div class="sk-chase-dot"></div>
         <div class="sk-chase-dot"></div>
         <div class="sk-chase-dot"></div>
         <div class="sk-chase-dot"></div>
         <div class="sk-chase-dot"></div>
         <div class="sk-chase-dot"></div>
     </div>
`;

$.blockUI.defaults.css = {
    ...$.blockUI.defaults.css,
    backgroundColor: "transparent",
    border: "0",
    cursor: "default",
    zIndex: 1111,
}

$.blockUI.defaults.overlayCSS = {
    ...$.blockUI.defaults.overlayCSS,
    backgroundColor: "#fff",
    opacity: 0.8,
    cursor: "default",
    zIndex: 1100,
};

function select2Mask(element) {
    if (!element.placeholder) {
        element.innerHTML = '<option></option>' + element.innerHTML;
    }

    const value = element.value;
    const $element = $(element);

    let params = {
        placeholder: 'Selecione uma opção',
        dropdownParent: $element.parent(),
    };
    if ($element.data('url')) {
        params.ajax = {
            url: $element.data('url'),
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term,
                    page: params.page || 1
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;
                return {
                    results: data.data,
                    pagination: {
                        more: data.current_page < data.last_page
                    }
                };
            },
            cache: true
        };
        params.minimumInputLength = 1;
    }

    if ($element.data('selected')) {
        params.data = [$element.data('selected')];
    }

    $element.select2(params);
    if ($element.data('selected')) {
        $element.val($element.data('selected').id).trigger('change');
    }

    $element.on('select2:open', searchFieldEventSelect2);
    if (element.dataset.allowClear) {
        $element.on('select2:unselecting', unselectingEventSelect2).on('select2:open', openEventSelect2);
    }

    if (value && !$element.val()) {
        $element.val(value).trigger('change').trigger('select2:select');
    }

    return $element;
}

function simpleSelect2Mask(element) {
    if (!element.placeholder) {
        element.innerHTML = '<option></option>' + element.innerHTML;
    }

    const value = element.value;
    const $element = $(element);

    $element.select2({
        placeholder: 'Selecione uma opção',
        dropdownParent: $element.parent(),
        minimumResultsForSearch: -1,
    });
    $element.on('select2:open', searchFieldEventSelect2);
    if (element.dataset.allowClear) {
        $element.on('select2:unselecting', unselectingEventSelect2).on('select2:open', openEventSelect2);
    }

    if (value && !$element.val()) {
        $element.val(value).trigger('change').trigger('select2:select');
    }

    return $element;
}

function searchFieldEventSelect2(event) {
    focusNextElement(this.nextElementSibling);
}

function focusNextElement(element) {
    if (!element) {
        return;
    }
    if (element.nextElementSibling && element.nextElementSibling.querySelector('.select2-search__field')) {
        element.nextElementSibling.querySelector('.select2-search__field').focus();
        return;
    }
    focusNextElement(element.nextElementSibling);
}

function unselectingEventSelect2(event) {
    if (!this.dataset.openClear) this.dataset.state = 'unselected';
}

function openEventSelect2(event) {
    if (this.dataset.state == 'unselected') {
        this.dataset.state = '';
        $(this).select2('close');
    };
}

function cpfMask(element) {
    return new Cleave(element, {
        delimiters: ['.', '.', '-'],
        blocks: [3, 3, 3, 2],
        numericOnly: true
    });
}

function cnpjMask(element) {
    return new Cleave(element, {
        delimiters: ['.', '.', '/', '-'],
        blocks: [2, 3, 3, 4, 2],
        numericOnly: true
    });
}

function onlyNumbersMask(element) {
    return new Cleave(element, {
        numeral: true,
        numeralPositiveOnly: true,
        numeralThousandsGroupStyle: 'none',
        delimiter: '',
    });
}

function datepicker(element) {
    if (Array.isArray(element)) {
        const returns = [];
        element.forEach(el => returns.push(datepicker(el)));
        return returns;
    }

    return element.flatpickr();
}

function dateMask(element) {
    if (Array.isArray(element)) {
        element.forEach(el => dateMask(el));
        return;
    }
    if (element.nextElementSibling && element.nextElementSibling.classList.contains('input')) {
        element = element.nextElementSibling;
    }
    return new Cleave(element, {
        date: true,
        datePattern: ['d', 'm', 'Y'],
        delimiter: '/'
    });
}

function moneyMask(element) {
    return $(element).maskMoney({
        prefix: 'R$ ',
        decimal: ',',
        thousands: '.',
        allowZero: true,
    }).maskMoney('mask');
}

function timeHiPicker(input) {
    return input.flatpickr({
        enableTime: true,
        time_24hr: true,
        altInput: false,
        noCalendar: true,
    });
}

function timeHiMask(input) {
    return new Cleave(input, {
        delimiters: [':'],
        blocks: [2, 2],
    });
}
