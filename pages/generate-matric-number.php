<?php //redirect('?pg=under-construction'); ?>

<?php
// check if payment status exists
if(!isset($_SESSION['school_fees_payment_status'])){
  redirect('?pg=home');
  die();
}

// check if the payment status is PAID COMPLETE
if($_SESSION['school_fees_payment_status'] != 'PAID_COMPLETE'){
  Session::flash('error', 'Sorry, You are not eligible to generate matriculation number');
  redirect('?pg=home');
  die();
}

//check if the appnum is available
if(!isset($_SESSION['applicant_details']->Appnum)){
  redirect('?pg=home');
  die();
}
?>


<div class="py-5" style="margin-top: 50px;">
  <div class="container">
      <div class="row">

        <?php include('inc/sidebar.php') ?>

        <div class="col-md-9">
          <div class="">
            <h3>Generate Matriculation Number</h3>
            <hr>
          </div>
          <div class="row">
            <div class="col-md-3 col-sm-1 text-center py-4">
              <span><img src="<?= BASE_URL ?>assets/icons/thumbs-up.svg" alt="construction_icon" width="80px" height="80px"></span>
            </div>
            <div class="col-md-9 col-sm-12">
              <span style="font-size:20px;" class="text-muted">
                <h3 class="text-green-light">Congratulations!</h3>
                <?php
                  if(isset($_SESSION['has_generate_matric'])){
                    if($_SESSION['has_generate_matric'] != true){
                ?>
                  You can now generate your matriculation number by clicking the<br>
                  <strong class="text-green-light">"Generate matriculation number"</strong> button below to generate your matric number.
                <?php
                    }else{
                ?>
                  You have generated your matric number previously, please view details below.<br>
                <?php
                    }
                  }
                ?>
              </span>
            </div>
          </div>
          <br>
          <div class="row">

            <div class="col-md-6 col-sm-12 py-2">
              <?php
                if(isset($_SESSION['has_generate_matric'])){
                  if($_SESSION['has_generate_matric'] != true){
              ?>
              <form>
                <input type="hidden" name="form_token" id="form_token" value="<?php echo hash_hmac('sha256', Token::generate_unique('gen_matric'), $token); ?>">
                <button type="submit" class="btn admission-button" id="get_matric"><b>Generate matriculation number</b></button>
              </form>
              <?php
                  }
                }
              ?>
            </div>
            <div class="col-md-6 col-sm-12 text-right py-2">
              <a href="?pg=home" class="btn back-button"><i class="fa fa-arrow-left"></i>&ensp;<b>Go back</b></a>
            </div>

          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12 py-5 text-center" id="display-matric-number">
              <span><small class="py-3 text-danger"><i class="fa fa-exclamation-circle"></i>&nbsp;<b>Please ensure that you save or write your matric number down, you cannot re-generate matric number once it has already been generated.</b></small></span>
              <div class="py-3 px-3" style="border: solid 3px #cb2431; border-radius:5px;" id="display-matric-status">
                <?php
                  if(isset($_SESSION['has_generate_matric'])){
                    if($_SESSION['has_generate_matric'] != true){
                      echo '<h3 class="text-green-light">Not Generated.</h3>';
                    }else{
                      echo "<h3 class='text-green-light'>Your matric number is: <b>{$_SESSION['applicant_matric_no']}</b></h3>";
                    }
                  }
                ?>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="<?php echo BASE_URL; ?>ajax/generate-matric-number.js"></script>
