$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'CsrfToken': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.save-courses').on('click', function() {
        // get the list of select course code
        var CoursesID = $('input[type=checkbox]:checked').map(function () {
            return $(this).val();
        }).get();
        console.log(CoursesID);

        // get the lis of selected course id
        var CoursesCode = $('input[type=checkbox]:checked').map(function () {
            return $(this).attr('data-coursecode');
        }).get();
        console.log(CoursesCode);

        // get the lis of selected course id
        var CoursesUnit = $('input[type=checkbox]:checked').map(function () {
            return $(this).attr('data-unit');
        }).get();
        console.log(CoursesUnit);

        // check if any course was selected
        if (CoursesID.length == 0) {
            swal("Data Not Saved", "You haven't selected any course yet", "warning");
        } else {
            processData();
        }

        function processData () {
            // submite the course to the controller
            var data = { CoursesID, CoursesCode, CoursesUnit };
            $.ajax({
                type: 'POST',
                url: 'controller/SaveCourseRegistration.php',
                data: data,
                beforeSend: function () {
                    $(".save-courses").html('<i class="fa fa-save"></i>&ensp;<b>Please wait...</b>');
                    $(".save-courses").attr("disabled", true);
                },
                success: function (response) {
                    if (response.success == true) {
                        $(".save-courses").hide();
                        swal({
                            title: "Data Saved",
                            text: "Your courses have been saved successfully, please preview them and submit the registration",
                            type: "success",
                            showCancelButton: false,
                            confirmButtonClass: "btn-success",
                            confirmButtonText: "Okay",
                            closeOnConfirm: false
                        },
                        function () {
                            window.location.href = "?pg=preview-courses-registered";
                        });
                    } else if (response.error == true) {
                        swal("Data Not Saved", `${response.error}`, "error");
                        $(".save-courses").attr("disabled", false);
                        $(".save-courses").html('<i class="fa fa-save"></i>&ensp;<b>Save</b>');
                    } else {
                        swal("Data Not Saved", `An error occured while saving your course please try again`, "error");
                        $(".save-courses").attr("disabled", false);
                        $(".save-courses").html('<i class="fa fa-save"></i>&ensp;<b>Save</b>');
                    }
                }
            });
        }
    });
})