<?php

// check if payment status exists
if (!isset($_SESSION['school_fees_payment_status'])) {
  Session::flash('error', 'Sorry, could not get your school fees payment status, logout out and login again.');
  redirect('?pg=home');
  die();
}

// check if the student payment is complete
if ($_SESSION['school_fees_payment_status'] != 'PAID_COMPLETE') {
  Session::flash('info', 'You are not eligible for course registration, you have to complete your school fees payment first.');
  redirect('?pg=home');
  die();
}

// check if registration status exists
if (!isset($_SESSION['course_registration_status'])) {
  Session::flash('error', 'Sorry, could not get your registration status, logout out and login again.');
  redirect('?pg=home');
  die();
}

// check if the student has not registered
if ($_SESSION['course_registration_status'] == "NOT_REGISTERED") {
  Session::flash('info', 'You have not registered any course for this semester yet, please register.');
  redirect('?pg=course-registration');
  die();
}

// check if the student has registered successfully
if ($_SESSION['course_registration_submittion'] == "SUBMITTED") {
  Session::flash('info', 'You have registered and submitted your courses for this semester already, you can unlock the course registration to edit it or you can print the registration.');
  redirect('?pg=course-registration');
  die();
}


?>
<div class="py-5" style="margin-top: 50px;">
  <div class="container">
      <div class="row">

        <?php include('inc/sidebar.php') ?>

        <div class="col-md-9">
          <div class="py-2">
            <h3>Preview register courses</h3>
            <hr>
          </div>
            <table class="table table-responsive table-striped" style="width: 100%; border: 0px;">
              <tr>
                  <th>#</th>
                  <th class='text-center'>Course Code</th>
                  <th>Course Title</th>
                  <th class='text-center'>Course Unit</th>
                  <th class='text-center'>Course Status</th>
              </tr>
              <?php
                $i = 1;
                $_total_unit = 0;
                if (isset($_SESSION['course_registration_details']) && !empty($_SESSION['course_registration_details'])) {
                  foreach ($_SESSION['course_registration_details'] as $main_courses) {
                    echo "
                      <tr>
                        <td class='text-center'>
                          ". $i++ ."
                        </td>
                        <td class='text-center'>{$main_courses->CourseCode}</td>
                        <td>{$main_courses->CourseTitle}</td>
                        <td class='text-center'>{$main_courses->CourseUnit}</td>
                        <td class='text-center'>{$main_courses->Tstatus}</td>
                      </tr>
                    ";
                    // calculate the total units
                    $_total_unit += $main_courses->CourseUnit;
                  }
                } else {
                  echo "
                    <tr>
                      <td class='text-center'><img src='assets/img/svg/warning.svg' width='20px'></td>
                      <td colspan='4'>We couldn't fetch your registered courses, please relogin.</td>
                    </tr>
                  ";
                }
              ?>
            </table>
            <hr>
            <br>
            <div class="row">
              <div class="col-md-12 col-sm-12 text-center">
                <span style="font-size: 25px;"><strong> Total Unit(s): <span class="text-danger">
                  <?php if(isset($_total_unit)){echo $_total_unit;}else{echo 0;} ?></span></strong>
                </span>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-4 col-sm-12 py-2">
                <button class="btn btn-block back-button btn-md submit-courses" 
                data-toggle="tooltip" data-placement="top" title="You are about to submit your registered courses.">
                <i class="fa fa-send-o"></i>&ensp;<b>Submit</b></button>
              </div>
              <div class="col-md-4 col-sm-12 py-2">
                <a  href="?pg=register-semester-courses&action=edit" class="btn btn-block back-button btn-md" 
                data-toggle="tooltip" data-placement="top" title="This would take you back to re-select courses you want registered.">
                <i class="fa fa-edit"></i>&ensp;<b>Edit</b></a>
              </div>
              <div class="col-md-4 col-sm-12 py-2">
                <a href="?pg=course-registration" class="btn btn-block back-button"
                data-toggle="tooltip" data-placement="top" title="You haven't submitted your registration, please do.">
                <i class="fa fa-arrow-left"></i>&ensp;<b>Go back</b></a>
              </div>
            </div>
        </div>
    </div>
  </div>
</div>
<script src="<?php echo BASE_URL; ?>ajax/submit-course-registration.js"></script>
