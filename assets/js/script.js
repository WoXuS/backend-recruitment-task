$(document).ready(function () {
  $('.remove-button').click(function () {
    let userId = $(this).data('id');
    $.post('/', { action: 'remove', id: userId }, function (response) {
      location.reload();
    });
  });

  $('#add-form__form').submit(function (e) {
    e.preventDefault();
    if (!validateForm()) return;
    let formData = $(this).serialize();
    $.post('/', { action: 'add', newUser: formData }, function (response) {
      location.reload();
    });
  });

  const phoneInput = document.querySelector('#phone');

  phoneInput.addEventListener('input', function (e) {
    let x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
    e.target.value = !x[2] ? x[1] : `(${x[1]}) ${x[2]}-${x[3]}`;
  });

  function validateForm() {
    let form = document.forms['add-form__form'];

    let fields = [
      'first_name',
      'last_name',
      'username',
      'email',
      'street',
      'city',
      'zipcode',
      'phone',
      'extension',
      'country_code',
      'company'
    ];
    let isValid = true;

    fields.forEach((field) => {
      let value = form[field].value;
      let error = '';
      if (value === '') {
        error = field + ' is required';
      } else {
        switch (field) {
          case 'first_name':
          case 'last_name':
            if (!/^\s*[a-zA-Z][a-zA-Z\s]*$/.test(value)) {
              error = 'Invalid name. Only letters and white space allowed';
            }
            break;
          case 'username':
          case 'company':
            if (!/^[ -~]*$/.test(value)) {
              error = 'Invalid. Only printable characters are allowed';
            }
            break;
          case 'email':
            if (!/\S+@\S+\.\S+/.test(value)) {
              error = 'Invalid email format';
            }
            break;
          case 'street':
            if (!/^[a-zA-Z0-9\.]*$/.test(value)) {
              error = 'Invalid street. Only letters, numbers and . are allowed';
            }
            break;
          case 'city':
            if (!/^[a-zA-Z ]*$/.test(value)) {
              error = 'Invalid city. Only letters and white space allowed';
            }
            break;
          case 'zipcode':
            if (!/^\d{5}(-\d{4})?$/.test(value)) {
              error = 'Invalid zip code';
            }
            break;
          case 'phone':
          case 'extension':
          case 'country_code':
            if (!/^\d*$/.test(value)) {
              error = 'Invalid number. Only digits are allowed';
            }
            break;
        }
      }

      if (error !== '') {
        displayError(form[field], error);
        isValid = false;
      } else {
        clearError(form[field]);
      }
    });

    if (isValid) {
      form.submit();
    }
    return isValid;
  }

  function displayError(field, message) {
    let errorField = field.parentElement.querySelector('.error-message');
    if (!errorField) {
      errorField = document.createElement('div');
      errorField.className = 'error-message';
      field.parentElement.appendChild(errorField);
    }
    field.classList.add('error');
    errorField.textContent = message;
    errorField.style.display = 'block';
  }

  function clearError(field) {
    field.classList.remove('error');
    let errorField = field.parentElement.querySelector('.error-message');
    if (errorField) {
      errorField.style.display = 'none';
    }
  }
});
