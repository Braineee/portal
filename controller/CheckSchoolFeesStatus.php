<?php
// initialize payment variables
$amount_to_pay = 0;
$_SESSION['school_fees_amount_to_pay_full'] = 0;
$_SESSION['school_fess_amount_to_pay_half'] = 0;
$_SESSION['school_fess_balance_to_pay'] = 0;
$_SESSION['amount_paid_by_student'] = 0;
$_amont_to_select = '';

// temporary
$_EBPORTAL_SESSION_ID = $_SESSION['current_academic_session']->SessionID + 31;

$first_year = array(1 , 4 , 7 , 11 , 14);
$second_year = array(2 , 5 , 8 , 12 , 15);
$third_year = array( 3 ,  6 ,  9 ,  13);
$fourth_year = array(10);

// get the level
if (in_array($_SESSION['student_details']->level, $first_year)) {
  $_amont_to_select = "CoursefeesYr1_New";
}

if (in_array($_SESSION['student_details']->level, $second_year)) {
  //  Check if thwe student is a direct entry student
  strpos($_SESSION["student_details"]->programme, '200') !== false ? 
  $_amont_to_select = "CoursefeesYrDE_New" : $_amont_to_select = "CoursefeesYr2_New";
}

if (in_array($_SESSION['student_details']->level, $third_year)) {
  $_amont_to_select = "CoursefeesYr3_New";
}

if (in_array($_SESSION['student_details']->level, $fourth_year)) {
  $_amont_to_select = "CoursefeesYr4_New";
}

// prepare the get schoolfees amount query
$get_amount_to_pay_query = "
  SELECT * FROM course WHERE 
  session LIKE '{$_SESSION['current_academic_session']->SessionID}' AND 
  course LIKE '{$_SESSION['student_details']->programme}'
";

//run the query
$get_the_amount_to_pay = DB_STUDENT::getInstance()->query($get_amount_to_pay_query);
error_handler($get_the_amount_to_pay, $_SESSION['student_details']->matricnum, "Error occured on get_the_amount_to_pay query", "controller/CheckSchoolFeesStatus.php");

// check if the payment 
switch ($get_the_amount_to_pay->count()) {
  case 0:
    // schoolfees is not set
    Session::flash('info', 'Your school fees has not been set please check back later.');
    //set payment status as 'NOT_SET'
    $_SESSION['school_fees_payment_status'] = 'NOT_SET';
    break;
  
  case 1:
    // get the amount
    $amount_to_pay = $get_the_amount_to_pay->first()->$_amont_to_select;

    // get the total amount to pay
    $_SESSION['school_fees_amount_to_pay_full'] = $amount_to_pay;

    // get the half amount to pay
    $_SESSION['school_fess_amount_to_pay_half'] = $amount_to_pay / 2;

    // get all the school fees payment made by the student
    // prepare the get query
    $get_paid_school_fees_query = "
      SELECT * FROM vw_YCTPAY_Transactions WHERE 
      (PaymentID = 5 OR PaymentID = 70) AND 
      SessionID LIKE '{$_EBPORTAL_SESSION_ID}' AND 
      PayeeNum LIKE '{$_SESSION['student_details']->matricnum}' AND 
      TransactionStatus like '%Successful%'
    ";

    // run the query
    $get_all_school_fees_paymnet = DB_EBPORTAL::getInstance()->query($get_paid_school_fees_query);
    error_handler($get_all_school_fees_paymnet, $_SESSION['student_details']->matricnum, "Error occured on get_paid_school_fees_query query", "controller/CheckSchoolFeesStatus.php");

    // student has not made any payment
    if ($get_all_school_fees_paymnet->count() == 0) {
        $_SESSION['school_fees_payment_status'] = 'NOT_PAID';
    }

    // student has made payment, confirm payment
    if ($get_all_school_fees_paymnet->count() > 0) {
      // get if the student has paid the stipulated school fee
        foreach ($get_all_school_fees_paymnet->results() as $amount_paid) {
            $_SESSION['amount_paid_by_student'] += $amount_paid->Amount;
        }

        // if the student is a full time
        if ($_SESSION['is_full_time']) {
            // check if the payment made is equal to the payment approved
            if ($_SESSION['amount_paid_by_student'] >= $_SESSION['school_fees_amount_to_pay_full']) {
                //flag as complete payments
                $_SESSION['school_fees_payment_status'] = 'PAID_COMPLETE';
                $_SESSION['amount_to_pay'] = $amount_to_pay;
                Session::flash('success', 'Your have completed your school fees payment please proceed to register your courses for this semester if you have not.');
            } else {
                //flag as incomplete payments
                $_SESSION['school_fees_payment_status'] = 'NOT_COMPLETED';
                Session::flash('info', 'Your have not completed your school fees payment.');
            }
        }

        // if the student is a partime
        if ($_SESSION['is_part_time']) {
            // check if the payment made is equal to the payment approved
            if ($_SESSION['amount_paid_by_student'] >= $_SESSION['school_fees_amount_to_pay_full']) {
              //flag as complete payments
              $_SESSION['school_fees_payment_status'] = 'PAID_COMPLETE';
              $_SESSION['amount_to_pay'] = $amount_to_pay;
              Session::flash('success', 'Your have completed your school fees payment please proceed to register your courses for this semester.');
            } else if ($_SESSION['amount_paid_by_student'] >= $_SESSION['school_fess_amount_to_pay_half']) {
              //flag as complete payments
              $_SESSION['school_fees_payment_status'] = 'PAID_COMPLETE_HALF';
              $_SESSION['amount_to_pay'] = $amount_to_pay;
              Session::flash('success', 'Your have completed half of your school fees payment please proceed to register your courses for this semester if you have not.');
            } else {
              //flag as incomplete payments
              $_SESSION['school_fees_payment_status'] = 'NOT_COMPLETED';
              Session::flash('info', 'Your have not completed your school fees payment.');
            }
        }
    }
    break;
  
  default:
    Session::flash('error', 'Err: Could not get school fees details.');
    //set payment status as 'NOT_DEFINED'
    $_SESSION['school_fees_payment_status'] = 'NOT_DEFINED';
    break;
}













