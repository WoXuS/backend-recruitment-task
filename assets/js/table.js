export const removeButtonHandler = () => {
  $('.remove-button').click(function () {
    const userId = [$(this).data('id')];
    $.post('/', { action: 'remove', id: userId }, () => {
      location.reload();
    });
  });

  $('.remove-selected-button').click(function () {
    const selectedIds = [];
    $('.user-checkbox:checked').each(function () {
      selectedIds.push($(this).data('id'));
    });
    if (selectedIds.length > 0) {
      $.post('/', { action: 'remove', id: selectedIds }, () => {
        location.reload();
      });
    }
  });
};

export const checkboxHandler = () => {
  $('.select-all-checkbox').change(function () {
    if ($(this).prop('checked')) {
      $('.user-checkbox:visible').prop('checked', true);
      $('.remove-selected-button').addClass('show');
    } else {
      $('.user-checkbox:visible').prop('checked', false);
      $('.remove-selected-button').removeClass('show');
    }
  });

  $('.user-checkbox, .select-all-checkbox').change(function () {
    const allChecked = $('.user-checkbox:visible').length === $('.user-checkbox:visible:checked').length;
    $('.select-all-checkbox').prop('checked', allChecked);

    const selectedCheckboxesCount = $('.user-checkbox:checked').length;
    if (selectedCheckboxesCount > 0) {
      $('.remove-selected-button').addClass('show');
    } else {
      $('.remove-selected-button').removeClass('show');
    }
  });
};
