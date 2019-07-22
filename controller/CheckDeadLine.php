<?php

include ('ChecKExemptionFun.php');

// initialize the link category array
$check_registration = array(
  'register-semester-courses',
  'preview-courses-registered'
);

$check_payment = array(
  'make-payment'
);

// determing if schoolfees or course 
if (in_array($_GET['pg'], $check_registration)) :
  $_late_table = 'RegistrationStatus';
elseif (in_array($_GET['pg'], $check_payment)) :
  $_late_table = 'PaymentStatus';
endif;

// Get the registration status from the database
$late_reg_query = "SELECT * FROM registrationLock WHERE programTypeID = '{$_SESSION['student_details']->ProgrammeTypeID}'";
$get_registration_status = DB_STUDENT::getInstance()->query($late_reg_query);
error_handler($get_registration_status, $_SESSION['student_details']->matricnum, "Error occured on late_reg_query query", "controller/CheckDeadLine.php");

// get the value of the deadline status
$late_registration_status = $get_registration_status->first()->$_late_table;

/**
 * case 1: registration is open
 * case 2: registration is open with late payment
 * case 3: registration is totally closed
 */
// determin the best course of action
switch ($late_registration_status) {
  case '1':
    // registration is opened; continue with registration do noting 
    $has_closed = 0;
    $case = '1';
    break;

  case '2':
    // registration is closed, but late payment is open, and exemption is open
    $has_closed = 1;
    $case = '2';

    // check for the exemption status 
    $has_closed = _check_exemption_function();
    $has_closed == 0 ? $case = 1 : $case = 2;
    break;
  
  case '3':
    // registration is closed, but exemption
    $has_closed = 1;
    $case = '3';

    // check for the exemption status
    $has_closed = _check_exemption_function(true);
    $has_closed == 0 ? $case = 1 : $case = 3;
    break;

  default:
    Session::flash('error', 'Err: We could not get the deadline details.');
    redirect('?pg=home');
    die();
    break;
}

do_alert($late_registration_status);
do_alert($has_closed);
do_alert($case);


// decide the course of action
if (in_array($_GET['pg'], $check_registration)) :

  if ($has_closed == 0 and $case == 1) :
    // do nothing, registration is open
  elseif ($has_closed == 1 and $case == 2) :
    // redirect the user to payment part
    Session::flash('info', 'Registration is closed, You are required to pay late registration penalty in order to proceed.<br> <a href="http://portal.yabatech.edu.ng/applications_xtr001/penaltypayment_latereg.php" target="_blank">Click here to pay for late registration penalty</a>.');
    redirect('?pg=home');
    die();
  elseif ($has_closed == 1 and $case == 3) :
    // redirect the user to payment part
    Session::flash('info', 'Registration is closed.');
    redirect('?pg=home');
    die();
  endif;
  
elseif (in_array($_GET['pg'], $check_payment)) :
  
  if ($has_closed == 0 and $case == 1) :
    // do nothing, registration is open
  elseif ($has_closed == 1 and $case == 2) :
    // redirect the user to payment part
    Session::flash('info', 'Payment is closed. You are required to pay late payment penalty in order to proceed.<br> <a href="http://portal.yabatech.edu.ng/applications_xtr001/penaltypayment_latereg.php" target="_blank">Click here to pay for late payment penalty</a>.');
    redirect('?pg=home');
    die();
  elseif ($has_closed == 1 and $case == 3) :
    // redirect the user to payment part
    Session::flash('info', 'Payment is closed.');
    redirect('?pg=home');
    die();
  endif;

endif;