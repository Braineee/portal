$('document').ready(function () {
    $('.logout').on('click', function() {
        $.ajax({
            type: 'POST',
            url: 'controller/Logout.php',
            cache: false,
            success: function (response) {

                window.location.href = '?pg=login';

            }
        });
    });
});