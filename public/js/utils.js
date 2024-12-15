"use strict";

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll('.btn-confirma-excluir').forEach(element => element.addEventListener('click', excluir));
    document.querySelectorAll('.email').forEach(element => element.addEventListener('input', formataEmail));
    document.querySelectorAll('.number').forEach(element => element.addEventListener('keypress', onlyNumberComma))
    document.querySelectorAll(".senha").forEach(element => element.addEventListener("click", AbrirModalSenha));

    const select2Elements = document.querySelectorAll('select.select2');
    const simpleSelect2Elements = document.querySelectorAll('select.simple-select2');
    if (select2Elements.length) {
        select2Elements.forEach(element => select2Mask(element));
    }

    if (simpleSelect2Elements) {
        simpleSelect2Elements.forEach(element => simpleSelect2Mask(element));
    }

    document.querySelectorAll('.cpf').forEach(element => cpfMask(element));
    document.querySelectorAll('.cnpj').forEach(element => cnpjMask(element));
    document.querySelectorAll('.loadable').forEach(element => element.loadable());
    document.querySelectorAll('.date-mask').forEach(element => datepicker(element));
    document.querySelectorAll('.date-mask').forEach(element => dateMask(element));
    document.querySelectorAll('textarea.autosize').forEach(element => autosize(element));
    document.querySelectorAll('.money-mask').forEach(element => moneyMask(element));
});

// Função para usar somente numeros ex 123456789
function onlyNumber(e) {
    const keyCode = (e.keyCode ? e.keyCode : e.wich)
    if (keyCode >= 48 && keyCode <= 58) {
        return true;
    }
    e.preventDefault();
}

// função para usar somente numeros e ponto ex: ####.##
function onlyNumberComma(e) {
    const keyCode = (e.keyCode ? e.keyCode : e.wich);

    if ((keyCode >= 48 && keyCode <= 58) || keyCode == 46) {
        return true;
    } else {
        e.preventDefault();
    }
}

//Função para mascara de Telefone ex: (##) #### ####
function mascaraTelefone(e) {
    let inptlengt = e.target.value.length

    if (inptlengt === 0) {
        e.target.value += '(';
    } else if (inptlengt === 3) {
        e.target.value += ')';
    } else if (inptlengt === 8)
        e.target.value += '-';
}

// Função para mascara de celular ex: (##) ##### ####
function mascaraCelular(e) {
    let inptlengt = e.target.value.length

    if (inptlengt === 0) {
        e.target.value += '(';
    } else if (inptlengt === 3) {
        e.target.value += ')';
    } else if (inptlengt === 9)
        e.target.value += '-';
}

// função de requisição do metado post promise
async function fetchJSON(url = '', data = {}, method = 'GET', formData = false) {
    let config = {};
    let blockUI = false;
    let blockUITarget = null;
    if (typeof url == 'object') {
        config = url || config;
        method = config.method || method;
        data = config.data || data;
        formData = config.formData || formData;
        url = config.url;
        blockUI = config.blockUI || blockUI;
    }

    if (data instanceof FormData) {
        formData = true;
    }

    const fetchParams = {
        method: method,
        mode: 'cors',
        cache: 'no-cache',
        credentials: 'same-origin',
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        redirect: 'follow',
        referrerPolicy: 'no-referrer',
    }

    if (method != 'GET' && method != 'HEAD') {
        fetchParams.body = formData ? data : JSON.stringify(data);
    }

    if (!formData) {
        fetchParams.headers['Content-Type'] = 'application/json';
    }

    if (blockUI) {
        let blockUIMessage = 'Aguarde...';
        if (typeof blockUI == 'string') {
            blockUIMessage = blockUI;
        } else if (typeof blockUI == 'object') {
            if (blockUI.message) {
                blockUIMessage = blockUI.message;
            }
            if (blockUI.target) {
                blockUITarget = blockUI.target;
            }
        }

        if (blockUITarget) {
            blockUITarget.block(blockUIMessage);
        } else {
            block(blockUIMessage);
        }
    }
    return fetch(aplicarParamsToUrl(url, data, method), fetchParams)
    .then(async response => {
        if (!response.ok) {
            return response.json().then(err => Promise.reject(err));
        }
        return response.json(); 
    }).catch(error => {
        if (error.message && error.message == 'Unauthenticated.') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Sua sessão expirou! Redirecionando para a página de login...',
                customClass: {
                    confirmButton: 'btn btn-success'
                },
                allowOutsideClick: false
            }).then(() => {
                window.location.href = baseUrl + 'login';
            });
            return;
        }

        throw error;
    }).finally(() => {
        if (blockUI) {
            if (blockUITarget) {
                blockUITarget.unblock();
            } else {
                unblock();
            }
        }
    });
}

function aplicarParamsToUrl(url, params, method) {
    if (method != 'GET' && method != 'HEAD') {
        return url;
    }

    const queryString = objectToQueryString(params);
    if (!queryString.length) {
        return url;
    }

    return url + '?' + queryString;
}

function objectToQueryString(obj) {
    var str = [];
    for (var p in obj)
        if (obj.hasOwnProperty(p)) {
            str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
        }
    return str.join("&");
}

// função para formatar numeros
function formataNumero(value, decimals = 2) {
    return parseFloat(value).toFixed(decimals).toString().replace('.', ',');
}

function dateBrToDb(date = '') {
    return date.length >= 10 ? date.substring(6, 10) + "-" + date.substring(3, 5) + "-" + date.substring(0, 2) : '';
}

function dateDbToBr(date = '') {
    return date.length >= 10 ? date.substring(8, 10) + "/" + date.substring(5, 7) + "/" + date.substring(0, 4) : '';
}

const converteHorasEmSegundos = (valor) => {
    valor = valor || '00:00';
    const hora_segundo = valor.split(':', 2);
    const horas_em_segundos = hora_segundo[0] * 3600;
    const minutos_em_segundos = hora_segundo[1] * 60;
    const valor_em_segundos = horas_em_segundos + minutos_em_segundos;
    return valor_em_segundos;

}

const converteSegundoEmHoras = (valor) => {
    return new Date(valor * 1000).toISOString().slice(11, 16);
}

const successAlert = (params, html = '', width = '40rem', position = 'top') => {
    let config = {
        html: html,
        width: width,
        position: position,
        icon: 'success',
    };

    if (typeof params == 'object') {
        config = { ...config, ...params };
    }

    if (typeof params == 'string') {
        config.title = params;
    }

    Swal.fire(config);
}

const errorAlert = (msg, subMsg = '', width = '40rem', position = 'top') => {
    Swal.fire({
        width: width,
        position: position,
        title: msg,
        html: subMsg,
        icon: 'error',
    });
}

const infoAlert = (msg, subMsg = '', width = '40rem', position = 'top') => {
    Swal.fire({
        width: width,
        position: position,
        title: msg,
        html: subMsg,
        icon: 'info',
    });
}

const confirmAlert = async (msg, subMsg ='', width = '40rem', position = 'top') => {
    const result = await Swal.fire({
        text: msg,
        title: subMsg,
        icon: 'question',
        width: width,
        position: position,
        showCancelButton: true,
        confirmButtonText: 'Sim',
        cancelButtonText: 'Não'
    });
    if (result.isConfirmed) {
        return true;
    } else if (result.isDenied) {
        return false;
    }
}

function excluir(e) {
    let resposta = confirm('Deseja mesmo excluir?');

    if (!resposta) {
        e.preventDefault();
    }
}

function formataEmail() {
    let emailPadrao = /^[\w._-]+@[\w_.-]+\.[\w]/;
    this.onblur = function() {
        if (this.value.length == 0) {
            return;
        }        
        if (!emailPadrao.test(this.value)) {
            errorAlert('Email invalido');
            setTimeout(() => {
                this.focus()            
            }, 2000)
        }
    }
}

function AbrirModalSenha() {
    $('#modalMudarSenha').modal('show');
    document.querySelector("#trocarSenha").addEventListener("click", trocarSenha);
}

function trocarSenha() {
    const password = document.querySelector('#password');
    const params = {
        password: password.value,
        id: password.dataset.id
    };
    const url = `trocar_senha`;
    fetchJSON(url, params, "PUT")
    .then(() => {
        successAlert('Senha alterada com sucesso');
        $('#modalMudarSenha').modal('hide');
        password.value = "";
        }
        ).catch((error) => {
            errorAlert(error.message)
        });
}

function formDataToObject(formData) {
    var object = {};
    for (var [key, value] of formData) {
        object[key] = value;
    }

    return object;
}


function limparOptionsSelectExceptPlaceholder(element) {
  if (element.tagName != 'SELECT') {
    return;
  }

  while (element.length > 1) {
    element.remove(1);
  }
}

function block(config = {}) {
    if (typeof config == 'string') {
        config = { message: config };
    }

    const message = config.message || 'Aguarde...';
    delete config.message;
    $.blockUI({
        message: `
            <h5 class="text-primary">${message}</h5>
            <div class="sk-chase sk-center mt-5">
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
            </div>
        `,
        ...config
    });
}

function unblock() {
    $.unblockUI();
}
