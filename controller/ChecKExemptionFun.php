<?php
// get the ebportal session
$EBPORTAL_SESSION = $_SESSION['current_academic_session']->SessionID + 31;

// exemption function
function _check_exemption_function ($is_totaly_closed = false) {
  // query to get the exenmption status
  $query_get_exemption_status = "
    SELECT * FROM registration_exemption
    WHERE programTypeID = '{$_SESSION['student_details']->ProgrammeTypeID}' 
    AND status = 1
    AND
    (
      schoolID = '{$_SESSION['student_details']->SchoolID}' OR
      levelID = '{$_SESSION['student_details']->level}' OR
      programID = '{$_SESSION['student_details']->ProgrammeID}' OR
      departmentID = '{$_SESSION['student_details']->DepartmentID}' OR
      matricNo like '{$_SESSION['student_details']->matricnum}'
    )
  ";

  // check the expemtion status
  $get_exemption_status = DB_STUDENT::getInstance()->query($query_get_exemption_status);
  error_handler($get_exemption_status, $_SESSION['student_details']->matricnum, "Error occured on get_exemption_status query", "controller/CheckDeadLine.php");
  if ($get_exemption_status->count() > 0) :
    return 0;
  endif;

  if ($is_totaly_closed == false) :
    // if not exempted, check the late payment status
    $query_get_late_payment_status = "
      SELECT * FROM vw_YCTPAY_Transactions
      WHERE PaymentID = 19
      AND SessionID LIKE '{$EBPORTAL_SESSION}' 
      AND PayeeNum LIKE '{$_SESSION['student_details']->matricnum}' 
      AND TransactionStatus like 'Successful%'
    ";

    // check the expemtion status
    $get_late_payment_status = DB_EBPORTAL::getInstance()->query($query_get_late_payment_status);
    error_handler($get_late_payment_status, $_SESSION['student_details']->matricnum, "Error occured on query_get_late_payment_status query", "controller/CheckDeadLine.php");
    if ($get_late_payment_status->count() > 0) :
      return 0;
    else :
      return 1;
    endif;
  else:
    return 1;
  endif;
}
