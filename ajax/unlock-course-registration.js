$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'CsrfToken': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.unlock').on('click', function () {
        swal({
            title: "Confirm registration unlock",
            text: "Are you really sure you want to unlock your course registration?, if you do, you would need to re-submit your course registration.",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonText: "Yes, Unlock registration",
            showLoaderOnConfirm: true
        }, function () {
            $.ajax({
                type: 'POST',
                url: 'controller/UnlockCourseRegistration.php',
                success: function (response) {
                    if (response.success == true) {
                        swal({
                            title: "Success",
                            text: "Your unlock is successful",
                            type: "success",
                            showCancelButton: false,
                            confirmButtonClass: "btn-success",
                            confirmButtonText: "Okay",
                            closeOnConfirm: false
                        },
                        function () {
                            window.location.href = "?pg=preview-courses-registered";
                        });
                    } else if (response.error == "not_submited") {
                        swal("Please check", `You haven't submitted your course registration`, "error");
                    } else if (response.error == "used_up") {
                        swal("Notice", `You have used up your unlock previledges, please visit CITM`, "info");
                    }else {
                        swal("Error", `Your unlock was unsuccessfull please try again`, "error");
                    }
                }
            });
        });
        
        // submite the unlock course to the controller
        /*$.ajax({
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
        });*/
    });
})