<?php
// get the student list of successfull transaction
//build query
try {
    $query="
    SELECT * FROM vw_YCTPAY_Transactions
    WHERE
    Payeenum LIKE '{$_SESSION['student_details']->matricnum}' AND
    TransactionStatus LIKE 'successful'
    ORDER BY TranID ASC;
  ";

    //run query
    $get_history = DB_EBPORTAL::getInstance()->query($query);
    error_handler($get_history, $_SESSION['student_details']->matricnum, "Error occured on get_history query", "controller/GetPaymentHistroy.php");

    //continue
    $history = $get_history->results();

} catch (Exception $e) {
    $log = new Logger(ROOT_PATH ."error_log.txt");
    $log->setTimestamp("D M d 'y h.i A");
    $log->putLog("\n Error Message: ".$e->getMessage().">> ".$_SESSION['applicant_details']->Appnum);
    die("<a href='?pg=home' class='btn btn-success'>Goto homepage</a>");
}
