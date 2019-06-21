
<?php
// redirect the user if he or she is looged in
 if($student->isLoggedin()){
  redirect('?pg=home');
  die();
}
?>
  <body class="login-body">
    <div class="container" style="">
        <div class="col-md-4 col-sm-6 offset-md-4 offset-sm-2">
          <div class="col-md-12 col-sm-12">
            <div class="text-center">
              <img src="<?= BASE_URL ?>assets/img/logo_new.png" alt="YABATECH" width="100px">
              <h4 class="deep-green login white">Sign in to student portal</h4>
            </div>
            <div id="error">
            </div>
          </div>
          <div class="col-md-12 col-sm-12">
            <form class="form-signin">
              <label for="appnum" class="label" >
                  Matric No.
              </label>
              <input type="text" id="matric_number" name="matric_number" class="form-control input-shadow"  placeholder="Enter your matric no. here">


              <label for="password" class="label-password">
                  Password
              </label>
              <input type="password" id="password" name="password" class="form-control input-shadow" placeholder="Your surname is password">
              <div class="text-right margin-buttom-10">
                <a href="#" class="forgot-password">Forgot password?</a>
              </div>
              <input type="hidden" name="form_token" id="form_token" value="<?php echo hash_hmac('sha256', Token::generate_unique('login'), $token); ?>">
              <button class="btn btn-md btn-success login-button btn-block form-control" type="submit" id="login">Sign in</button>
            </form>
          </div>
          <div class="col-md-12 col-sm-12 margin-10 text-center">
            <div class="student-portal">
              Take me home -  <a href="http://portal.yabatech.edu.ng/portalplus">Go to College site</a>
            </div>
          </div>
          <div class="col-md-12 col-sm-12 other-links inline text-center">
              <a href="http://portal.yabatech.edu.ng/paymentevidence/validatepayment.php" class="deep-green">payment-verification</a>&ensp;
              <a href="http://portal.yabatech.edu.ng/escreening" class="deep-green">E-Screening</a>&ensp;
              <a href="http://portal.yabatech.edu.ng/helpdesk" class="deep-green">Help Desk</a>
          </div>
        </div>
    </div>
  </body>
  <script type="text/javascript" src="<?php echo BASE_URL; ?>ajax/login.js"></script>
