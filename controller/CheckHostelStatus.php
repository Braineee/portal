<?php
// initialize the hostel status
$_SESSION['hostel_status'] = "NOT APPLIED";

// get the ebportal session
$_EBPORTAL_SESSION_ID = $_SESSION['current_academic_session']->SessionID + 31;

// check if the student applied for hostel
$_query_get_application_trans = "
  SELECT * FROM vw_YCTPAY_Transactions WHERE 
  PaymentID = 6 AND 
  SessionID LIKE '{$_EBPORTAL_SESSION_ID}' 
  AND PayeeNum LIKE '{$_SESSION['student_details']->matricnum}' AND 
  TransactionStatus like 'Successful%'
";
$get_application_details = DB_EBPORTAL::getInstance()->query($_query_get_application_trans);
error_handler($get_application_details, $_SESSION['student_details']->matricnum, "Error occured on _query_get_application_trans query", "controller/CheckHostelStatus.php");
if ($get_application_details->count() > 0) :
  $_SESSION['hostel_status'] = "APPLIED";
endif;

// check if the student has been balloted
$check_balot_status = DB_HOSTEL::getInstance()->get('StudentInfo', array('matricNum', 'LIKE', $_SESSION['student_details']->matricnum));
error_handler($check_balot_status, $_SESSION['student_details']->matricnum, "Error occured on check_balot_status query", "controller/CheckHostelStatus.php");
if ($check_balot_status->count() > 0) :
  if ($check_balot_status->first()->allocatedStatus == '1') :
    $_SESSION['hostel_status'] = "BALLOTED";
  endif;
endif;

// check if student is allocated hostel
$check_allocation_status = DB_HOSTEL::getInstance()->get('Allocation', array('Matricno', 'LIKE', $_SESSION['student_details']->matricnum));
error_handler($check_allocation_status, $_SESSION['student_details']->matricnum, "Error occured on check_allocation_status query", "controller/CheckHostelStatus.php");
if ($check_allocation_status->count() > 0) :
  $_SESSION['hostel_status'] = "ALLOCATED";
  $_SESSION['hostel_allocation_details'] = $check_allocation_status->first();
endif;

// check if the student has paid for hostellallocation
$_query_get_allocation_trans = "
  SELECT * FROM vw_YCTPAY_Transactions WHERE 
  PaymentID = 7 AND 
  SessionID LIKE '{$_EBPORTAL_SESSION_ID}' 
  AND PayeeNum LIKE '{$_SESSION['student_details']->matricnum}' AND 
  TransactionStatus like 'Successful%'
";
$get_allocation_details = DB_EBPORTAL::getInstance()->query($_query_get_allocation_trans); 
error_handler($get_allocation_details, $_SESSION['student_details']->matricnum, "Error occured on get_allocation_details query", "controller/CheckHostelStatus.php");
if ($get_allocation_details->count() > 0) :
  $_SESSION['hostel_status'] = "PAID COMPLETE";
endif;
