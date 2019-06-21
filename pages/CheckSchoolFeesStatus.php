<?php
//initialize the amonut
$amount = 0;
$_SESSION['amount_to_pay'] = 0;

//check if it is direct entry or normal Application
strpos($_SESSION['applicant_details']->program, '200') !== false ?
$payment_to_select = "CoursefeesYrDE_New" : $payment_to_select = "CoursefeesYr1_New";

//check if the neccessary parameters are available
if(!isset($_SESSION['current_application_session_studentdb']) || !isset($_SESSION['program_type_acronym'])
){
  redirect('?pg=logout');
  die();
}

try{
  //get details of the payment
  $query="
    SELECT * FROM course
    WHERE
    session = '{$_SESSION['current_application_session_studentdb']}' AND
    prog_status = '{$_SESSION['applicant_details']->PTAcronym}' AND
    course = '{$_SESSION['applicant_details']->program}'
  ";


  $get_payment_details = DB_STUDENT::getInstance()->query($query);

  //check for errors
  if(!is_object($get_payment_details)){
    $log = new Logger(ROOT_PATH ."error_log.html");
    $log->setTimestamp("D M d 'y h.i A");
    $log->putLog("\n Error Message: controller/checkschoolfeesstatus :: variable (get_payment_details) did not drop an object >> ".$_SESSION['applicant_details']->Appnum);
    die("<br><br><a href='?pg=home' class='btn btn-success'>Goto homepage</a>");
  }
  if($get_payment_details->error() == true){
    $log = new Logger(ROOT_PATH ."error_log.html");
    $log->setTimestamp("D M d 'y h.i A");
    $log->putLog("\n Error Message: controller/checkschoolfeesstatus :: ".$get_payment_details->error_message()[2].">> ".$_SESSION['applicant_details']->Appnum);
    die("<br><br><a href='?pg=home' class='btn btn-success'>Goto homepage</a>");
  }
  //end of check for errors

  //var_dump($get_payment_details);
  switch ($get_payment_details->count()) {
    case "0":
      // schoolfees is not set
      Session::flash('info', 'Your school fees has not been set please check back later.');
      //set payment status as 'NOT_SET'
      $_SESSION['school_fees_payment_status'] = 'NOT_SET';
      break;

    case "1":

      //get the schoolfees details
      $payment_details = $get_payment_details->first();

        //get the payment $amount_to_pay
        $real_amount = $payment_details->$payment_to_select;

        //initialize the actual ammount
        $_SESSION['actual_amount'] = $real_amount;

        //initialize the payment $amount_to_pay
        $amount_to_pay = 0;

        //check if it is pt or ft
        //if it is parttime divide the school fees by 2 to get the half payment
        $_SESSION['applicant_details']->PTAcronym == 'PT' ? $amount_to_pay = ($real_amount/2) :  $amount_to_pay = $real_amount;

        //initialize the real amount session
        $_SESSION['real_amount'] = $amount_to_pay;

        //check if the applicant has payed school fees
        $query="
          SELECT * FROM vw_YCTPAY_Transactions
          WHERE
          PaymentID = 5  AND
          SessionID LIKE '{$_SESSION['current_application_session_ebportaldb']}' AND
          Appnum LIKE '{$_SESSION['applicant_details']->Appnum}' AND
          TransactionStatus like 'Successful'
        ";

        $get_applicant_school_fees_status = DB_EBPORTAL::getInstance()->query($query);

        //check for errors
        if(!is_object($get_applicant_school_fees_status)){
          $log = new Logger(ROOT_PATH ."error_log.html");
          $log->setTimestamp("D M d 'y h.i A");
          $log->putLog("\n Error Message: controller/checkschoolfeesstatus :: variable (get_applicant_school_fees_status) did not drop an object >> ".$_SESSION['applicant_details']->Appnum);
          die("<br><br><a href='?pg=home' class='btn btn-success'>Goto homepage</a>");
        }
        if($get_applicant_school_fees_status->error() == true){
          $log = new Logger(ROOT_PATH ."error_log.html");
          $log->setTimestamp("D M d 'y h.i A");
          $log->putLog("\n Error Message: controller/checkschoolfeesstatus :: ".$get_applicant_school_fees_status->error_message()[2].">> ".$_SESSION['applicant_details']->Appnum);
          die("<br><br><a href='?pg=home' class='btn btn-success'>Goto homepage</a>");
        }
        //end of check for errors


        //if applicant hass paid flag applicant_school_fees_payment_status as 'PAID_COMPLETE' esle as 'NOT_COMPLETED'
          // if its partime check if the ammount paid is equal half the actual amount
          $get_applicant_school_fees_status->count() >= 0 ? $status_count = 1 : $status_count = $get_applicant_school_fees_status->count();
          switch ($status_count) {
            case '0':
              // flag as NOT PAID
              $_SESSION['school_fees_payment_status'] = 'NOT_PAID';
              $_SESSION['amount_to_pay'] = $amount_to_pay;
              Session::flash('info', 'Your have not paid your school fees.');
              break;

            case '1':
              //initialize the total payment
              $total_applicant_payment = 0;

              //Get applicant payments
              $applicant_school_fees_status = $get_applicant_school_fees_status->results();

              //add all the payment up
              foreach ($applicant_school_fees_status as $payment) {
                $total_applicant_payment = $payment->Amount + $total_applicant_payment;
              }

              //check if what is paid is equal to the amount to be paid
              if($total_applicant_payment >= $amount_to_pay){
                //flag as complete payments
                $_SESSION['school_fees_payment_status'] = 'PAID_COMPLETE';
                $_SESSION['amount_to_pay'] = $amount_to_pay;
                Session::flash('success', 'Your have completed your school fees payment please proceed to generate your matric number if you have not.');
              }else{
                //flag as incomplete payments
                $_SESSION['school_fees_payment_status'] = 'NOT_COMPLETED';
                $_SESSION['amount_to_pay'] = $amount_to_pay - $total_applicant_payment;
                Session::flash('info', 'Your have not completed your school fees payment.');
              }
              break;

            default:
              Session::flash('error', 'Err: Could not get school fees payment status.');
              //set payment status as 'PAYMENT_NOT_DEFINED'
              $_SESSION['school_fees_payment_status'] = 'PAYMENT_NOT_DEFINED';
              break;
          }


      break;

    default:
      Session::flash('error', 'Err: Could not get school fees details.');
      //set payment status as 'NOT_DEFINED'
      $_SESSION['school_fees_payment_status'] = 'NOT_DEFINED';
  };




}catch(Exception $e){

  $log = new Logger(ROOT_PATH ."error_log.txt");
  $log->setTimestamp("D M d 'y h.i A");
  $log->putLog("\n Error Message: ".$e->getMessage().">> ".$_SESSION['applicant_details']->Appnum);
  die("<a href='?pg=home' class='btn btn-success'>Goto homepage</a>");

}
