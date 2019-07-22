<?php

// get the hostel application detail
$get_hostel_application_details = DB_EBPORTAL::getInstance()->get('YCTPAY_Payments', array('PaymentID', '=', 7));
error_handler($get_hostel_application_details, $_SESSION['student_details']->matricnum, "Error occured on get_hostel_application_details query", "controller/GetHostelAllocationDetails.php");
if ($get_hostel_application_details->count() > 0) :
  $_hostel_allocation_details = $get_hostel_application_details->first();
endif;

