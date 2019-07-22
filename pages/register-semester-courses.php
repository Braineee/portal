<?php

// check the deadline
include('controller/CheckDeadLine.php');

// include the student status checker
include ('controller/CheckStudentStatus.php');

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


// check hostel status
if ($_SESSION['course_registration_status'] == 'APPLIED') {
  if (!isset($_GET['action']) || $_GET['action'] != 'edit') {
    Session::flash('info', 'You have registered your courses for this semester already. <a href="?pg=preview-courses-registered">Click here to edit it</a>');
    redirect('?pg=course-registration');
    die();
  }
}

// check student summary status
if ($_SESSION['student_summary_data'] == NULL) {
  Session::flash('info', 'We are unable to get your record summary, please re-login');
  redirect('?pg=home');
  die();
}

// check deadline
//TODO: include deadline controller

// Calculate total units reg
function calculateTotalUnitReg(){
  // calculate the total unit registered
  $_total_unit = 0;
  foreach ($_SESSION['course_registration_details'] as $course_to_check_id){
    $_total_unit += $course_to_check_id->CourseUnit;
  }
  return $_total_unit;
}

// check if the student is trying to edit course and highlights course previously selected by the student
function checkEdit ($course_id) {
  if (isset($_GET['action']) && $_GET['action'] == 'edit') {
    // check if the previousr registered courses are available
    if (isset($_SESSION['course_registration_details']) && $_SESSION['course_registration_details'] != "ERR") {
      foreach ($_SESSION['course_registration_details'] as $course_to_check_id) {
        if ($course_id == $course_to_check_id->CourseId) {
          return "checked";
        }
      }
    }
  }
}

// get the total unit registered
(isset($_GET['action']) && $_GET['action'] == 'edit') ? $_TOTLAL_UNITS_REG = calculateTotalUnitReg() : $_TOTLAL_UNITS_REG = 0;

// include the get courses to register 
include ('controller/GetCoursesToRegister.php');


?>

<div class="py-5" style="margin-top: 50px;">
  <div class="container">
      <div class="row">

        <?php include('inc/sidebar.php') ?>

        <div class="col-md-9">
          <div class="py-2">
            <h3>Register Courses</h3>
            <hr>
          </div>
          <?php if (count($_carry_over_courses_details) > 0) { ?>
          <div class="row px-2 py-2">
            <h6 class="text-danger" align="center">Courser for carried over</h6>
            <table class="table table-responsive table-striped" style="width: 100%; border: 0px;">
              <tr>
                  <th>#</th>
                  <th class='text-center'>Course Code</th>
                  <th>Course Title</th>
                  <th class='text-center'>Course Unit</th>
                  <th class='text-center'>Course Status</th>
              </tr>
              <?php
              foreach ($_carry_over_courses_details as $carry_over) {
                if(!empty($carry_over)){
                  if (is_array($carry_over)) {
                    for ($i=0; $i<count($carry_over); $i++) {
                      echo "
                        <tr>
                          <td class='text-center'>
                            <label class='container_check text-center'>
                              <input type='checkbox' 
                                class='chkbox' value='{$carry_over[$i]->ID}' 
                                data-coursecode='{$carry_over[$i]->CourseCode}' 
                                data-unit='{$carry_over[$i]->CourseUnit}'
                                ".checkEdit($carry_over[$i]->ID)."
                              >
                              <span class='checkmark'></span>
                            </label>
                          </td>
                          <td class='text-center'>{$carry_over[$i]->CourseCode}</td>
                          <td>{$carry_over[$i]->CourseTitle}</td>
                          <td class='text-center'>{$carry_over[$i]->CourseUnit}</td>
                          <td class='text-center'>{$carry_over[$i]->Tstatus}</td>
                        </tr>
                      ";
                    }
                  } else {
                      echo "
                        <tr>
                          <td class='text-center'><img src='assets/img/svg/warning.svg' width='20px'></td>
                          <td class='text-center'>{$carry_over}</td>
                          <td colspan='3'>This course is not available for this semester, kindly see your course adviser for more info.</td>
                        </tr>
                      ";
                  }
                }
              }
              ?>
            </table>
        </div>
        <?php } ?>

        <?php if($_is_extra_year_student == false) { ?>

        <div class="row px-2 py-2">
            <h6 class="text-danger" align="center">Courser for <?php echo strtolower($_SESSION['current_semester']->Semester) ?></h6>
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
                if (!empty($_current_courses_details)) {
                  foreach ($_current_courses_details as $main_courses) {
                    
                    echo "
                      <tr>
                        <td class='text-center'>
                          <label class='container_check text-center'>
                            <input type='checkbox' 
                              class='chkbox' value='{$main_courses->ID}' 
                              data-coursecode='{$main_courses->CourseCode}' 
                              data-unit='{$main_courses->CourseUnit}'
                              ".checkEdit($main_courses->ID)."
                            >
                            <span class='checkmark'></span>
                          </label>
                        </td>
                        <td class='text-center'>{$main_courses->CourseCode}</td>
                        <td>{$main_courses->CourseTitle}</td>
                        <td class='text-center'>{$main_courses->CourseUnit}</td>
                        <td class='text-center'>{$main_courses->Tstatus}</td>
                      </tr>
                    ";
                  }
                } else {
                  echo "
                    <tr>
                      <td class='text-center'><img src='assets/img/svg/warning.svg' width='20px'></td>
                      <td colspan='4'>Your courses for this semester are not available yet, kindly see your course adviser for more info.</td>
                    </tr>
                  ";
                }
              ?>
            </table>
        </div>

        <?php } ?>

        <hr>
        <br>
        <div class="row">
          <div class="col-md-12 col-sm-12 text-center">
            <span style="font-size: 25px;">
              <strong> Total Unit(s): 
                <span class="text-danger total-unit-selected" data-id="<?= $_TOTLAL_UNITS_REG ?>"><?= $_TOTLAL_UNITS_REG ?></span>
              </strong>
            </span>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-6 col-sm-12 py-2">
            <button class="btn btn-block back-button btn-md save-courses" 
            data-toggle="tooltip" data-placement="top" title="Hello! Please remember to submit your registration after previewing it.">
            <i class="fa fa-save"></i>&ensp;<b>Save</b></button>
          </div>
          <div class="col-md-6 col-sm-12 py-2">
            <a href="?pg=course-registration" class="btn btn-block back-button"
            data-toggle="tooltip" data-placement="top" title="Hello! If you click this button your selected courses wouldn't be saved.">
            <i class="fa fa-arrow-left"></i>&ensp;<b>Go back</b></a>
          </div>
        </div>
    </div>
  </div>
</div>
<input type="hidden" class="max" value="<?= $_maximum_unit_to_be_register ?>">
<script src="<?php echo BASE_URL; ?>ajax/maximum-unit-checker.js"></script>
<script src="<?php echo BASE_URL; ?>ajax/save-course-registration.js"></script>