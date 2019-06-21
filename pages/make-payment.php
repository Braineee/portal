<?php
// check if payment status exists
if(!isset($_SESSION['school_fees_payment_status'])){
  redirect('?pg=home');
  die();
}

//check if the person has not PAID
if($_SESSION['school_fees_payment_status'] != 'NOT_PAID' && $_SESSION['school_fees_payment_status'] != 'NOT_COMPLETED'){

  if($_SESSION['school_fees_payment_status'] == 'NOT_DEFINED'){
    Session::flash('error', 'Err: Could not get school fees details.');
    redirect('?pg=home');
    die();
  }
  if($_SESSION['school_fees_payment_status'] == 'PAYMENT_NOT_DEFINED'){
    Session::flash('error', 'Err: Could not get school fees payment status.');
    redirect('?pg=home');
    die();
  }
  if($_SESSION['school_fees_payment_status'] == 'NOT_SET'){
    Session::flash('info', 'Your school fees has not been set please check back later.');
    redirect('?pg=home');
    die();
  }
  if($_SESSION['school_fees_payment_status'] == 'PAID_COMPLETE'){
    Session::flash('success', 'Your have completed your school fees payment please proceed to generate your matric number if you have not.');
    redirect('?pg=home');
    die();
  }
  redirect('?pg=home');
  die();

}

//get payment description
try {
  $get_payment_description = DB_EBPORTAL::getInstance()->get('YCTPAY_Payments', array('PaymentID','=',5));

  // check for errors
  if(!is_object($get_payment_description)){
    $log = new Logger(ROOT_PATH ."error_log.html");
    $log->setTimestamp("D M d 'y h.i A");
    $log->putLog("\n Error Message: pages/make-payment :: variable (get_payment_description) did not drop an object >> ".$_SESSION['applicant_details']->Appnum);
    die("<br><br><br><br><a href='?pg=home' class='btn btn-success'>Goto homepage</a>");
  }
  if($get_payment_description->error() == true){
    $log = new Logger(ROOT_PATH ."error_log.html");
    $log->setTimestamp("D M d 'y h.i A");
    $log->putLog("\n Error Message: pages/make-payment ::".$get_payment_description->error_message()[2].">> ".$_SESSION['applicant_details']->Appnum);
    die("<br><br><br><br><a href='?pg=home' class='btn btn-success'>Goto homepage</a>");
  }
  //end of check for errors

  $payment_description = $get_payment_description->first()->PaymentName;

}catch (\Exception $e) {
  $log = new Logger(ROOT_PATH ."error_log.txt");
  $log->setTimestamp("D M d 'y h.i A");
  $log->putLog("\n Error Message: ".$e->getMessage().">> ".$_SESSION['applicant_details']->Appnum);
  die("<br><br><br><a href='?pg=home' class='btn btn-success'>Goto homepage</a>");
}

//initialize payment
$payment_id = '';
//check if applicant is fulltime or partime
$_SESSION['applicant_details']->PTAcronym == 'PT' ? $payment_id = 70 : $payment_id = 5;

?>



<div class="py-5" style="margin-top: 50px;">
  <div class="container">
      <div class="row">

        <?php include('inc/sidebar.php') ?>

        <div class="col-md-9">
          <div class="py-2">
            <h3>Fee Payment & Registration</h3>
          </div>
          <div class="row px-2 py-2">
            <table class="table table-responsive" style="width: 100%; border: 0px;">
              <tr width="100px">
                <td>
                  <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                  <span class="text-muted">Application number:</span>
                </td>
                <th>
                  <?= $_SESSION['applicant_details']->Appnum ?>
                </th>
              </tr>
              <tr width="100px">
                <td>
                  <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                  <span class="text-muted">Full Name:</span>
                </td>
                <th>
                  <?= $_SESSION['applicant_details']->Surname ?> <?= $_SESSION['applicant_details']->Firstname ?> <?= $_SESSION['applicant_details']->Othername ?>
                </th>
              </tr>
              <tr>
                <td>
                  <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                  <span class="text-muted">School:</span>
                </td>
                <th>
                  <?= $_SESSION['applicant_details']->SchoolName ?>
                </th>
              </tr>
              <tr>
                <td>
                  <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                  <span class="text-muted">Programme type:</span>
                </td>
                <th>
                  <?= $_SESSION['applicant_details']->PTName ?>
                </th>
              </tr>
              <tr>
                <td>
                  <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                  <span class="text-muted">Department:</span>
                </td>
                <th>
                  <?= $_SESSION['applicant_details']->PNName ?>
                </th>
              </tr>
              <tr>
                <td>
                  <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                  <span class="text-muted">Programme:</span>
                </td>
                <th>
                  <?= $_SESSION['applicant_details']->program ?>
                </th>
              </tr>
              <tr>
                <td>
                  <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                  <span class="text-muted">Session:</span>
                </td>
                <th>
                  <?= $_SESSION['applicant_details']->EntrySession ?>
                </th>
              </tr>
              <?php if($_SESSION['applicant_details']->PTAcronym == 'PT'){ // show this only if thw applicant is part time?>
              <tr>
                <td>
                  <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                  <span class="text-muted">Amount for half payment:</span>
                </td>
                <th>
                  &#8358;<?= number_format($_SESSION['amount_to_pay']); ?>
                </th>
              </tr>
            <?php }?>
              <tr>
                <td>
                  <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                  <span class="text-muted">Amount for full payment:</span>
                </td>
                <th>
                  &#8358;<?= number_format($_SESSION['actual_amount']); ?>
                </th>
              </tr>
            </table>
            <?php if($_SESSION['applicant_details']->PTAcronym == 'PT'){ // show this only if thw applicant is part time?>
            <div class="col-md-12 col-sm-12 py-2" >
              <form  method="post" action="http://portal.yabatech.edu.ng/yctpay/" style="border: solid 1px #cb2431; border-radius:5px;" class="px-4 py-4">
                <span style="color:#cb2431;"><b>Caution.</b></span>
                <p>Please ensure you have confirmed your details before proceeding to make this payment.</p>
                <hr>
    						<input name="studentnumber" type="hidden" id="studentnumber" value="<?= $_SESSION['applicant_details']->Appnum; ?>" />
    						<input name="sessionid" type="hidden" id="sessionid" value="<?= $_SESSION['current_application_session_ebportaldb']; ?>" />
    						<input name="paymentid" type="hidden" id="paymentid" value="<?php if($payment_id == ''){die();}else{echo $payment_id;}; ?>" />
    						<input name="paymentamount" type="hidden" id="paymentamount" value="<?= $_SESSION['amount_to_pay']; ?>" />
    					  <input name="paymentdescription" type="hidden" id="paymentdescription" value="<?PHP echo $payment_description; ?>" />
    						<button
                  type="submit"
                  name="process" id="process"
                  style="margin-top:5px;"
                  class="btn payment-button">
                  <b>Proceed with half payment</b>
                </button>
    					</form>
            </div>
            <?php }?>
            <div class="col-md-12 col-sm-12 py-2" >
              <form  method="post" action="http://portal.yabatech.edu.ng/yctpay/" style="border: solid 1px #cb2431; border-radius:5px;" class="px-4 py-4">
                <span style="color:#cb2431;"><b>Caution.</b></span>
                <p>Please ensure you have confirmed your details before proceeding to make this payment.</p>
                <hr>
    						<input name="studentnumber" type="hidden" id="studentnumber" value="<?= $_SESSION['applicant_details']->Appnum; ?>" />
    						<input name="sessionid" type="hidden" id="sessionid" value="<?= $_SESSION['current_application_session_ebportaldb']; ?>" />
    						<input name="paymentid" type="hidden" id="paymentid" value="<?php if($payment_id == ''){die();}else{echo $payment_id;}; ?>" />
    						<input name="paymentamount" type="hidden" id="paymentamount" value="<?= $_SESSION['actual_amount']; ?>" />
    					  <input name="paymentdescription" type="hidden" id="paymentdescription" value="<?PHP echo $payment_description; ?>" />
    						<button
                  type="submit"
                  name="process" id="process"
                  style="margin-top:5px;"
                  class="btn payment-button">
                  <b>Proceed with full payment</b>
                </button>
    					</form>
            </div>
          </div>
          <br>
          <a href="?pg=fees" class="btn back-button pull-right"><i class="fa fa-arrow-left"></i>&ensp;<b>Go back</b></a>
        </div>
    </div>
  </div>
</div>
