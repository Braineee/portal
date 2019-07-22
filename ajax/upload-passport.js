$('document').ready(function () {
    $.ajaxSetup({
        headers: {
            'CsrfToken': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    // save the picture temporarily
    $('#student_passport').on('change', function () {
        var house_picture = $("#student_passport").prop("files")[0];
        $('img#display_').fadeIn("fast").attr('src', URL.createObjectURL(event.target.files[0]));
    });
});