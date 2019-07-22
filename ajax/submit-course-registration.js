$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'CsrfToken': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.submit-courses').on('click', function () {
        // submite the course to the controller
        $.ajax({
            type: 'POST',
            url: 'controller/SubmitCourseRegistration.php',

            beforeSend: function () {
                $(".submit-courses").html('<i class="fa fa-save"></i>&ensp;<b>Please wait...</b>');
                $(".submit-courses").attr("disabled", true);
            },
            success: function (response) {
                if (response.success == true) {
                    $(".submit-courses").hide();
                    swal({
                        title: "Data Saved",
                        text: "Your courses have been submitted successfully, you can now proceed to print your course form",
                        type: "success",
                        showCancelButton: false,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "Okay",
                        closeOnConfirm: false
                    },
                        function () {
                            window.location.href = "?pg=print-courses-registered";
                        });
                } else if (response.error == true) {
                    swal("Data Not Saved", `${response.error}`, "error");
                    $(".submit-courses").attr("disabled", false);
                    $(".submit-courses").html('<i class="fa fa-send-o"></i>&ensp;<b>Submit</b>');
                } else {
                    swal("Data Not Saved", `An error occured while submitting your registration please try again`, "error");
                    $(".submit-courses").attr("disabled", false);
                    $(".submit-courses").html('<i class="fa fa-save"></i>&ensp;<b>Submit</b>');
                }
            }
        });
    });
})