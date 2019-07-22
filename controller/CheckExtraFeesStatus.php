<?php
// initialize extra fee payment
$_SESSION['extra_payment'] = false;

$_EBPORTAL_SESSION_ID = $_SESSION['current_academic_session']->SessionID + 31;

//check if it in that balace table
$get_balance_info = DB_STUDENT::getInstance()->query("SELECT * FROM Extrafee WHERE Matricno like '{$_SESSION['student_details']->matricnum}'");
error_handler($get_balance_info, $_SESSION['student_details']->matricnum, "Error occured on get_balance_info query", "controller/CheckExtraFeesStatus.php");


if ($get_balance_info->count() > 0) {
  // get the balance_amount
  $balance_amount = $get_balance_info->first()->Amount;
  $balance_paymentid = $get_balance_info->first()->PaymentID;
  $balance_description = $get_balance_info->first()->PaymentDescrip;

  // check the yctpay_transaction table for payment id 70 and balance_amount and successfull
  $query_ = "SELECT * FROM vw_YCTPAY_Transactions
            WHERE PaymentID = '$balance_paymentid'
            AND SessionID LIKE '$_EBPORTAL_SESSION_ID' 
            AND PayeeNum LIKE '{$_SESSION['student_details']->matricnum}' 
            AND Amount LIKE '$balance_amount%'
            AND TransactionStatus like '%Successful%'";
  $check_balance_payment = DB_EBPORTAL::getInstance()->query($query_);

  // Not paid
  if ($check_balance_payment->count() == 0) {
    //Session::flash('info', 'You have {$balance_description} balance to pay, you are to pay this balance before you proceed.');
    $_SESSION['extra_payment'] = true;
    $_SESSION['extra_payment_id'] = $balance_paymentid;
    $_SESSION['extra_payment_amount'] = $balance_amount;
    $_SESSION['extra_payment_description'] = $balance_description;
  }
}


