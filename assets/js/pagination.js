const rowsShown = 5;
const rowsTotal = $('#table-container tbody tr').length;
const numPages = Math.ceil(rowsTotal / rowsShown);

export const paginationInit = () => {
  if (numPages <= 1) $('#next-page').prop('disabled', true);

  for (let i = 0; i < numPages; i++) {
    const pageNum = i + 1;
    $('#pagination').append(`<a href="#" rel="${i}" class="page-link">${pageNum}</a> `);
  }

  $('#table-container tbody tr').hide();
  $('#table-container tbody tr').slice(0, rowsShown).show();
  $('#pagination a:first').addClass('active');
  checkButtonStatus(0, numPages);

  $('#pagination a').on('click', function () {
    $('#pagination a').removeClass('active');
    $(this).addClass('active');
    const currPage = $(this).attr('rel');
    const startItem = currPage * rowsShown;
    const endItem = startItem + rowsShown;
    $('#table-container tbody tr')
      .css('opacity', '0.0')
      .hide()
      .slice(startItem, endItem)
      .css('display', 'table-row')
      .animate({ opacity: 1 }, 300);

    checkButtonStatus(currPage, numPages);
  });

  $('#prev-page').click(function () {
    let currPage = $('#pagination .active').attr('rel');
    currPage--;
    $('#pagination a[rel="' + currPage + '"]').click();
  });

  $('#next-page').click(function () {
    let currPage = $('#pagination .active').attr('rel');
    currPage++;
    $('#pagination a[rel="' + currPage + '"]').click();
  });

  $('#pagination a, #next-page, #prev-page').on('click', function () {
    $('.select-all-checkbox').prop('checked', false);
    $('.user-checkbox').prop('checked', false);
  });
};

const checkButtonStatus = (currPage, numPages) => {
  currPage = Number(currPage);
  if (currPage === 0) {
    $('#prev-page').prop('disabled', true);
  } else {
    $('#prev-page').prop('disabled', false);
  }

  if (currPage === numPages - 1) {
    $('#next-page').prop('disabled', true);
  } else {
    $('#next-page').prop('disabled', false);
  }
};
