$('document').ready(function(){
    $.ajaxSetup({
        headers : {
            'CsrfToken': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function error_alert(value) {
      $('#error').html(`<div class="alert alert-danger" role="alert"><strong><img src="assets/img/svg/cancel.svg" width="6%"></strong>&ensp;${value}</div>`);
    }

    // check the matric_number
    $('#matric_number').on('blur', function(){
        var matric_number_ = $('#matric_number').val();
        if(matric_number_ == ""){
          error_alert('Please enter your matric number');
          $('#login').attr("disabled", true);
        }else{
            $('#login').attr("disabled", false);
        }
    });

    //check the password
    $('#password').on('blur', function(){
        var password_ = $('#password').val();
        if(password_ == ""){
          error_alert('Please enter your password');
          $('#login').attr("disabled", true);
        }else{
            $('#login').attr("disabled", false);
        }
    });

    $( "form" ).submit(function( e ) {
      e.preventDefault();
      if ($('#matric_number').val() == "" || $('#password').val() == ""){
            if($('#matric_number').val() == ""){
              error_alert('Please enter your app number');
              $('#matric_number').focus();
              $('#login').attr("disabled", true);
            }else if($('#password').val() == ""){
              error_alert('Please enter your password');
              $('#password').focus();
              $('#login').attr("disabled", true);
            }
        }else{
          confirm_login_details();
        }

        // confirm the login details
        function confirm_login_details(e){
            form = $("form").serialize();
            $.ajax({
                type: 'POST',
                url: 'controller/Login.php',
                data: form,
                cache:false,
                beforeSend: function(){
                    $("#error").fadeOut();
                    $('#error').html('');
                    $("#login").html('Please wait...');
                    $("#login").attr("disabled", true);
                },
                success: function(response){
                    if(response.success == true){
                        $("#login").html('Signing in...');
                        $("#login").attr("disabled", true);
                        window.location.href = '?pg=home';
                    }else if(response.error){
                        $("#error").fadeIn(1000,function(){
                          error_alert(response.error);
                          $("#login").html('Sign in');
                          $("#login").attr("disabled", false);
                        });
                    }else{
                      $("#error").fadeIn(1000,function(){
                        error_alert('Oops!, Error signing in, please try again.');
                        $("#login").html('Sign in');
                        $("#login").attr("disabled", false);
                      });
                    }
                }
            });
        }
    });//ends login
});
