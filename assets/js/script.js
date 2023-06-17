$(document).ready(function () {
  $('.remove-button').click(function () {
    let userId = $(this).data('id');
    $.post('/', { action: 'remove', id: userId }, function (response) {
      location.reload();
    });
  });

  let formSubmitted = false;

  $('#add-form__form').submit(function (e) {
    e.preventDefault();
    formSubmitted = true;
    if (!validateForm()) return;
    let formData = $(this).serialize();
    $.post('/', { action: 'add', newUser: formData }, function (response) {
      if (response.errors) {
        for (let field in response.errors) {
          displayError(document.forms['add-form__form'][field], response.errors[field]);
        }
      } else {
        location.reload();
      }
    });
  });

  $('#add-form__form input').on('blur input', function () {
    if (formSubmitted) {
      validateForm($(this));
    }
    if ($(this).val().trim() !== '') {
      $(this).addClass('has-value');
    } else {
      $(this).removeClass('has-value');
    }
  });

  const phoneInput = document.querySelector('#phone');
  const extensionInput = document.querySelector('#extension');
  const zipcodeInput = document.querySelector('#zipcode');

  if (phoneInput !== null) {
    let phoneMask = new Inputmask({
      mask: '+1 (999) 999-9999',
      placeholder: '_',
      showMaskOnHover: false,
      showMaskOnFocus: true
    });
    phoneMask.mask(phoneInput);
  }

  if (extensionInput !== null) {
    let extensionMask = new Inputmask({
      mask: 'x999999',
      placeholder: '_',
      showMaskOnHover: false,
      showMaskOnFocus: true
    });
    extensionMask.mask(extensionInput);
  }

  if (zipcodeInput !== null) {
    let zipcodeMask = new Inputmask({
      mask: '99999[-9999]',
      placeholder: '_',
      showMaskOnHover: false,
      showMaskOnFocus: true
    });
    zipcodeMask.mask(zipcodeInput);
  }

  function validateForm() {
    let form = document.forms['add-form__form'];

    let fields = {
      first_name: { required: true, label: 'First Name' },
      last_name: { required: true, label: 'Last Name' },
      username: { required: true, label: 'Username' },
      email: { required: true, label: 'Email' },
      street: { required: true, label: 'Street' },
      city: { required: true, label: 'City' },
      zipcode: { required: true, label: 'Zip Code' },
      phone: { required: true, label: 'Phone' },
      extension: { required: false, label: 'Extension' },
      company: { required: true, label: 'Company' }
    };

    let isValid = true;

    for (let field in fields) {
      let value = form[field].value.trim();
      let error = '';

      if (fields[field].required && value === '') {
        error = fields[field].label + ' is required';
      } else {
        switch (field) {
          case 'first_name':
          case 'last_name':
            if (!/^\s*[a-zA-Z][a-zA-Z\s]*$/.test(value)) {
              error = 'Invalid name. Only letters are allowed';
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
              error = 'Invalid email';
            }
            break;
          case 'street':
            if (!/^[a-zA-Z0-9\. ]*$/.test(value)) {
              error = 'Invalid street. Only letters and numbers are allowed';
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
            if (!/^\+1 \(\d{3}\) \d{3}-\d{4}$/.test(value)) {
              error = 'Invalid phone number';
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

    let label = field.parentElement.querySelector('label');
    label.style.color = 'var(--color-error)';

    errorField.textContent = message;
    errorField.style.display = 'block';
  }

  function clearError(field) {
    field.classList.remove('error');
    let errorField = field.parentElement.querySelector('.error-message');
    if (errorField) {
      errorField.style.display = 'none';
    }

    let label = field.parentElement.querySelector('label');
    label.style.color = 'inherit';
  }
});
