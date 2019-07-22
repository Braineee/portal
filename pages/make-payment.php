<?php

// check the deadline
include('controller/CheckDeadLine.php');

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
    Session::flash('success', 'Your have completed your school fees payment please proceed to course registration if you have not.');
    redirect('?pg=home');
    die();
  }
  redirect('?pg=home');
  die();
}

// Check if the school fees details is available
if (!isset($_SESSION['school_fees_payment_details'])) {
  Session::flash('Err', 'Err: Could not get school fees payment details, kindly logout and login again.');
  redirect('?pg=home');
  die();
}

// check deadline

// temporary
$_EBPORTAL_SESSION_ID = $_SESSION['current_academic_session']->SessionID + 31;

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
                  <span class="text-muted">Matric number:</span>
                </td>
                <th>
                  <?= $_SESSION['student_details']->matricnum ?>
                </th>
              </tr>
              <tr width="100px">
                <td>
                  <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                  <span class="text-muted">Full Name:</span>
                </td>
                <th>
                  <?= $_SESSION['student_details']->surname ?> <?= $_SESSION['student_details']->firstname ?> <?= $_SESSION['student_details']->othername ?>
                </th>
              </tr>
              <tr>
                <td>
                  <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                  <span class="text-muted">School:</span>
                </td>
                <th>
                  <?= $_SESSION['student_details']->School ?>
                </th>
              </tr>
              <tr>
                <td>
                  <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                  <span class="text-muted">Programme type:</span>
                </td>
                <th>
                  <?= $_SESSION['student_details']->programme_type ?>
                </th>
              </tr>
              <tr>
                <td>
                  <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                  <span class="text-muted">Department:</span>
                </td>
                <th>
                  <?= $_SESSION['student_details']->department ?>
                </th>
              </tr>
              <tr>
                <td>
                  <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                  <span class="text-muted">Programme:</span>
                </td>
                <th>
                  <?= $_SESSION['student_details']->programme ?>
                </th>
              </tr>
              <tr>
                <td>
                  <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                  <span class="text-muted">Session:</span>
                </td>
                <th>
                  <?= $_SESSION['current_academic_session']->Session ?>
                </th>
              </tr>

              <?php if($_SESSION['school_fees_payment_status'] != "NOT_COMPLETED"){ ?>
              <tr>
                <td>
                  <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                  <span class="text-muted">Amount for full payment:</span>
                </td>
                <th>
                  &#8358;<?= number_format($_SESSION['school_fees_amount_to_pay_full']); ?>
                </th>
              </tr>
              <?php } ?>

              <?php if($_SESSION['is_part_time'] && ($_SESSION['school_fees_payment_status'] != "NOT_COMPLETED") ){ // show this only if thw applicant is part time?>
              <tr>
                <td>
                  <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                  <span class="text-muted">Amount for half payment:</span>
                </td>
                <th>
                  &#8358;<?= number_format($_SESSION['school_fess_amount_to_pay_half']); ?>
                </th>
              </tr>
              <?php }?>

              <?php if ($_SESSION['school_fees_payment_status'] == "NOT_COMPLETED") { ?>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Amount for school fees balance:</span>
                  </td>
                  <th>
                    &#8358;<?= number_format($_SESSION['school_fess_balance_to_pay']); ?>
                  </th>
                </tr>
              <?php } ?>

            </table>

            <?php if($_SESSION['school_fees_payment_status'] != "NOT_COMPLETED"){ // show this only if thw applicant is part time?>
              <div class="col-md-12 col-sm-12 py-2" >
                <form  method="post" action="http://portal.yabatech.edu.ng/yctpay/" style="border: solid 1px #cb2431; border-radius:5px;" class="px-4 py-4">
                  <span style="color:#cb2431;"><b>Caution.</b></span>
                  <p>Please ensure you have confirmed your details before proceeding to make this payment.</p>
                  <hr>
                  <input name="studentnumber" type="hidden" id="studentnumber" value="<?= $_SESSION['student_details']->matricnum; ?>" />
                  <input name="sessionid" type="hidden" id="sessionid" value="<?= $_EBPORTAL_SESSION_ID; ?>" />
                  <input name="paymentid" type="hidden" id="paymentid" value="<?= $_SESSION['school_fees_payment_details']->PaymentID ?>" />
                  <input name="paymentamount" type="hidden" id="paymentamount" value="<?= $_SESSION['school_fees_amount_to_pay_full'] ?>" />
                  <input name="paymentdescription" type="hidden" id="paymentdescription" value="<?= $_SESSION['school_fees_payment_details']->PaymentName ?>" />
                  <button
                    type="submit"
                    name="process" id="process"
                    style="margin-top:5px;"
                    class="btn payment-button">
                    <b>Proceed with full payment</b>
                  </button>
                </form>
              </div>
            <?php } ?>
          
          <?php if($_SESSION['is_part_time'] && ($_SESSION['school_fees_payment_status'] != "NOT_COMPLETED")){ // show this only if thw applicant is part time?>
            <div class="col-md-12 col-sm-12 py-2" >
              <form  method="post" action="http://portal.yabatech.edu.ng/yctpay/" style="border: solid 1px #cb2431; border-radius:5px;" class="px-4 py-4">
                <span style="color:#cb2431;"><b>Caution.</b></span>
                <p>Please ensure you have confirmed your details before proceeding to make this payment.</p>
                <hr>
    						<input name="studentnumber" type="hidden" id="studentnumber" value="<?= $_SESSION['student_details']->matricnum; ?>" />
    						<input name="sessionid" type="hidden" id="sessionid" value="<?= $_EBPORTAL_SESSION_ID; ?>" />
    						<input name="paymentid" type="hidden" id="paymentid" value="<?= $_SESSION['school_fees_payment_details']->PaymentID ?>" />
    						<input name="paymentamount" type="hidden" id="paymentamount" value="<?= $_SESSION['school_fess_amount_to_pay_half'] ?>" />
    					  <input name="paymentdescription" type="hidden" id="paymentdescription" value="<?= $_SESSION['school_fees_payment_details']->PaymentName ?>" />
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
          <?php if ($_SESSION['school_fees_payment_status'] == "NOT_COMPLETED") { ?>
            <div class="col-md-12 col-sm-12 py-2" >
              <form  method="post" action="http://portal.yabatech.edu.ng/yctpay/" style="border: solid 1px #cb2431; border-radius:5px;" class="px-4 py-4">
                <span style="color:#cb2431;"><b>Caution.</b></span>
                <p>Please ensure you have confirmed your details before proceeding to make this payment.</p>
                <hr>
    						<input name="studentnumber" type="hidden" id="studentnumber" value="<?= $_SESSION['student_details']->matricnum; ?>" />
    						<input name="sessionid" type="hidden" id="sessionid" value="<?= $_EBPORTAL_SESSION_ID; ?>" />
    						<input name="paymentid" type="hidden" id="paymentid" value="<?= $_SESSION['school_fees_payment_details']->PaymentID ?>" />
    						<input name="paymentamount" type="hidden" id="paymentamount" value="<?= $_SESSION['school_fess_balance_to_pay']; ?>" />
    					  <input name="paymentdescription" type="hidden" id="paymentdescription" value="<?= $_SESSION['school_fees_payment_details']->PaymentName ?>" />
    						<button
                  type="submit"
                  name="process" id="process"
                  style="margin-top:5px;"
                  class="btn payment-button">
                  <b>Proceed with balance payment</b>
                </button>
    					</form>
            </div>
          <?php } ?>
          </div>
          <br>
          <a href="?pg=fees" class="btn back-button btn-block"><i class="fa fa-arrow-left"></i>&ensp;<b>Go back</b></a>
        </div>
    </div>
  </div>
</div>
