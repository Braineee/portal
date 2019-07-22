$('document').ready(function() {

  // get max register unit
  $('.chkbox').change(function () {
    // get the unit for the checked course
    var course_unit = parseInt($(this).attr('data-unit'));

    // get the course code
    var code = $(this).attr('data-coursecode');

    // get the maximum course that can be selected
    var max_to_be_selected = $('.max').val();

    // get the total selected course unit
    var increment = parseInt($('.total-unit-selected').attr('data-id'));

    // compute the total
    if ($(this).prop('checked') === true) {
        if (increment < max_to_be_selected) {
            increment = increment + course_unit;
            if (increment <= max_to_be_selected) {
              $('.total-unit-selected').html(increment);
              $('.total-unit-selected').attr('data-id', increment);
              toastr.success(`<b>${code}</b> was added to your list of selected courses. you have ${max_to_be_selected - increment} unit(s) left.`);
            } else {
              increment = increment - course_unit;
              swal("Oops! too much courses", `You can not select more than ${max_to_be_selected} units`, "warning");
              $(this).prop('checked',false);
              $('.total-unit-selected').html(increment);
              $('.total-unit-selected').attr('data-id', increment);
              
            }
        } else {
          swal("Oops! too much courses.", `You can not select more than ${max_to_be_selected} units`, "warning");
          $(this).prop('checked',false);
          $('.total-unit-selected').html(increment);
          $('.total-unit-selected').attr('data-id', increment);
          
        }
    } else {
        $(this).prop('checked',false);
        increment = increment - course_unit;
        $('.total-unit-selected').html(increment);
        $('.total-unit-selected').attr('data-id', increment);
        toastr.warning(`<b>${code}</b> was removed from your list of selected courses.`);
    }
  });
});