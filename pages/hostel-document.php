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
if ($_SESSION['hostel_status'] != "PAID COMPLETE") {
  Session::flash('info', 'You have not paid for any hostel space yet');
  redirect('?pg=hostel');
  die(); 
}

?>
<div class="py-5" style="margin-top: 50px;">
  <div class="container">
      <div class="row">

        <?php include('inc/sidebar.php') ?>

        <div class="col-md-9">
          <div class="py-2">
            <h3>Hostel Documents</h3>
          </div>
          <div class="row px-2 py-2">
            <table class="table table-responsive table-striped" style="width: 100%; border: 0px;">
              <thead>
                <th class="col-4">Hostel Document Type</th>
                <th>option</th>
              </thead>
              <tr>
                <td>Room Allocation</td>
                <td>
                  <a class='btn btn-block back-button btn-sm' 
                    target='_blank'
                    href='?pg=print-out-room-allocation-form'>
                    <i class='fa fa-print'></i>&ensp;Print 
                  </a> 
                </td>
              </tr>
              <tr>
                <td>Hostel Code of Conduct</td>
                <td>
                  <a class='btn btn-block back-button btn-sm' 
                    target='_blank'
                    href='?pg=print-out-code-of-conduct'>
                    <i class='fa fa-print'></i>&ensp;Print 
                  </a> 
                </td>
              </tr>
              <tr>
                <td>Hostel Undertaking</td>
                <td>
                  <a class='btn btn-block back-button btn-sm' 
                    target='_blank'
                    href='?pg=print-out-hostel-undertaking'>
                    <i class='fa fa-print'></i>&ensp;Print 
                  </a> 
                </td>
              </tr>
              <tr>
                <td>Hostel Pass</td>
                <td>
                  <a class='btn btn-block back-button btn-sm' 
                    target='_blank'
                    href='?pg=print-out-hostel-pass'>
                    <i class='fa fa-print'></i>&ensp;Print 
                  </a> 
                </td>
              </tr>
            </table>
          </div>
          <br>
          <br>
          <div class="row">
            <div class="col-md-6 col-sm-12 text-right py-2">
              <a href="?pg=hostel" class="btn back-button btn-block"><i class="fa fa-arrow-left"></i>&ensp;<b>Go back</b></a>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
