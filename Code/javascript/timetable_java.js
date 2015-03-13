$('.AddNew').click(function(){
   var row = $(this).closest('tr').clone();
   row.find('input').val('');
   $(this).closest('tr').after(row);
   $('input[type="button"]', row).removeClass('AddNew').addClass('RemoveRow').val('Remove item');
});

$('table').on('click', '.RemoveRow', function(){
  $(this).closest('tr').remove();
});