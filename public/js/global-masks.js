document.addEventListener("DOMContentLoaded", () => {
  // Função do datepicker
  if (document.querySelector('.datepicker')) {
      flatpickr('.datepicker', {
      allowInput: true,
      dateFormat: 'Y-m-d',
      altFormat: 'd/m/Y',
      altInput: true,
      locale: 'pt',
      });
  }
  if (document.getElementById('formValidate')) {
      document.getElementById('formValidate').addEventListener('submit', function (e) {
          e.preventDefault();
          const requireds = [...document.querySelectorAll('#formValidate .form-control.form-required')].filter(element => !element.value.trim());
          if (requireds.length) {
              let txt = '';
              requireds.map(element => element.closest('div.col-form').querySelector('label').innerHTML).forEach(campo => {
                  txt += `<br>${campo}`;
              });
              Swal.fire({
                  width: '40rem',
                  position: 'top',
                  title: 'Os seguintes campos são obrigatórios:<br>',
                  html: txt,
                  icon: 'error',
              })
              return false;
          }

          return this.submit();
      });
  }
  if (document.querySelector('.only-number')) {
    document.querySelectorAll('.only-number').forEach(input => input.addEventListener('input', onlyNumber));
  }
  if (document.querySelector('.only-number-comma')) {
    document.querySelectorAll('.only-number-comma').forEach(input => {
      if (input.value) input.value = formataNumero(input.value, input.dataset.casasDecimais);
      input.addEventListener('input', onlyNumberComma);
    });
  }
});
