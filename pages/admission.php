<?php
// check if payment status exists
if(!isset($_SESSION['school_fees_payment_status'])){
  redirect('?pg=home');
  die();
}

// check if the payment status is PAID COMPLETE
if($_SESSION['school_fees_payment_status'] != 'PAID_COMPLETE'){
  Session::flash('error', 'Sorry, You are not eligible to print admission letter');
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
            <h3>School Fees Receipt</h3>
            <hr>
          </div>
          <div class="row">
            <div class="col-md-3 col-sm-1 text-center py-4">
              <span><img src="<?= BASE_URL ?>assets/icons/thumbs-up.svg" alt="construction_icon" width="80px" height="80px"></span>
            </div>
            <div class="col-md-9 col-sm-12">
              <span style="font-size:20px;" class="text-muted">
                <h3 class="text-green-light">Congratulations!</h3>
                You have been granted provisional admission, please click the <br>
                <strong class="text-green-light">"Print admission letter"</strong> button below to print your admission letter.
              </span>
            </div>
          </div>
          <br>
          <div class="row">

            <div class="col-md-6 col-sm-12 py-2">
              <a href="?pg=print-admission-letter" target="_blank" class="btn admission-button"><b>Print admission letter</b></a>
            </div>
            <div class="col-md-6 col-sm-12 text-right py-2">
              <a href="?pg=home" class="btn back-button"><i class="fa fa-arrow-left"></i>&ensp;<b>Go back</b></a>
            </div>

          </div>
        </div>
    </div>
  </div>
</div>
