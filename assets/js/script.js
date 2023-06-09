$(document).ready(function () {
  $('.remove-button').click(function () {
    let userId = $(this).data('id');
    $.post('/', { action: 'remove', id: userId }, function (response) {
      location.reload();
    });
  });
});
