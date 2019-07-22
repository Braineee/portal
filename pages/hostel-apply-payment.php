<?php
// do this if student is partime
if ($_SESSION['is_part_time'] == true) :
  Session::flash('info', 'Part time students are not eligible to apply for hostel.');
  redirect('?pg=home');
  die();
endif;

// check if payment status exists
if (!isset($_SESSION['school_fees_payment_status'])) {
  Session::flash('error', 'Sorry, we could not get your school fees payment status, kindly logout and login again.');
    redirect('?pg=home');
    die();
}

// check if the student payment is complete
if ($_SESSION['school_fees_payment_status'] != 'PAID_COMPLETE') {
  Session::flash('info', 'You are not eligible to apply for hostel, you have to complete your school fees payment first.');
  redirect('?pg=home');
  die();
}

// check if hostel status exits
if (!isset($_SESSION['hostel_status'])) :
  Session::flash('info', 'Sorry, we could not get your hostel application status, kindly logout and login again.');
  redirect('?pg=home');
  die();
endif;

// Check if the studen has appied already
if ($_SESSION['hostel_status'] != "NOT APPLIED") {
  Session::flash('info', 'You have previously applied for hostel, please proceed to check your ballot status on the dashboard under the &apos;<b>HOSTEL STATUS</b>&apos;.');
  redirect('?pg=hostel');
  die();
}

// temporary
$_EBPORTAL_SESSION_ID = $_SESSION['current_academic_session']->SessionID + 31;

// get the hostel application details
include ('controller/GetHostelApplicationDetails.php');

?>

<div class="py-5" style="margin-top: 50px;">
  <div class="container">
      <div class="row">

        <?php include('inc/sidebar.php') ?>

        <div class="col-md-9">
          <div class="py-2">
            <h3>Application for Hostel</h3>
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
              <tr>
                <td>
                  <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                  <span class="text-muted">Amount:</span>
                </td>
                <th>
                  &#8358;1,000
                </th>
              </tr>

            </table>

            <?php if ($_SESSION['hostel_status'] == "NOT APPLIED") : // show this only if thw applicant is part time?>
              <div class="col-md-12 col-sm-12 py-2" >
                <form  method="post" action="http://portal.yabatech.edu.ng/yctpay/" style="border: solid 1px #cb2431; border-radius:5px;" class="px-4 py-4">
                  <span style="color:#cb2431;"><b>Caution.</b></span>
                  <p>Please ensure you have confirmed your details before proceeding to make this payment.</p>
                  <hr>
                  <input name="studentnumber" type="hidden" id="studentnumber" value="<?= $_SESSION['student_details']->matricnum; ?>" />
                  <input name="sessionid" type="hidden" id="sessionid" value="<?= $_EBPORTAL_SESSION_ID; ?>" />
                  <input name="paymentid" type="hidden" id="paymentid" value="6" />
                  <input name="paymentamount" type="hidden" id="paymentamount" value="1000" />
                  <input name="paymentdescription" type="hidden" id="paymentdescription" value="<?= $_hostel_application_details->PaymentName ?>" />
                  <button
                    type="submit"
                    name="process" id="process"
                    style="margin-top:5px;"
                    class="btn payment-button">
                    <b>Proceed with full payment</b>
                  </button>
                </form>
              </div>
            <?php endif; ?>

          </div>
          <br>
          <a href="?pg=fees" class="btn back-button btn-block"><i class="fa fa-arrow-left"></i>&ensp;<b>Go back</b></a>
        </div>
    </div>
  </div>
</div>
