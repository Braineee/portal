<?php
//build query
try{

  $query="
    SELECT * FROM vw_YCTPAY_Transactions
    WHERE
    Appnum LIKE '{$_SESSION['applicant_details']->Appnum}' AND
    TransactionStatus LIKE 'successful'
    ORDER BY TranID ASC;
  ";

  //run query
  $get_history = DB_EBPORTAL::getInstance()->query($query);

  // check for errors
  if(!is_object($get_history)){
    $log = new Logger(ROOT_PATH ."error_log.html");
    $log->setTimestamp("D M d 'y h.i A");
    $log->putLog("\n Error Message: pages/payment-history :: variable (get_history) did not drop an object >> ".$_SESSION['applicant_details']->Appnum);
    die("<br><br><br><br><a href='?pg=home' class='btn btn-success'>Goto homepage</a>");
  }
  if($get_history->error() == true){
    $log = new Logger(ROOT_PATH ."error_log.html");
    $log->setTimestamp("D M d 'y h.i A");
    $log->putLog("\n Error Message: pages/payment-history ::".$get_history->error_message()[2].">> ".$_SESSION['applicant_details']->Appnum);
    die("<br><br><br><br><a href='?pg=home' class='btn btn-success'>Goto homepage</a>");
  }
  //end of check for errors

  //continue
  $history = $get_history->results();

}catch(Exception $e){

  $log = new Logger(ROOT_PATH ."error_log.txt");
  $log->setTimestamp("D M d 'y h.i A");
  $log->putLog("\n Error Message: ".$e->getMessage().">> ".$_SESSION['applicant_details']->Appnum);
  die("<a href='?pg=home' class='btn btn-success'>Goto homepage</a>");

}

?>
<div class="py-5" style="margin-top: 50px;">
  <div class="container">
      <div class="row">

        <?php include('inc/sidebar.php') ?>

        <div class="col-md-9">
          <div class="py-2">
            <h3>Payment History</h3>
          </div>
          <div class="row px-2 py-2">
            <table class="table table-responsive" style="width: 100%; border: 0px;">
              <thead>
                <th>Fee</th>
                <th>Academic session</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Status</th>
              </thead>
              <?php
                foreach ($history as $payment){
                  $price = number_format($payment->Amount);
                  echo "<tr><td>{$payment->PaymentName}</td><td>{$payment->Session}</td><td>&#8358;{$price}</td><td>{$payment->DatePosted}</td><td>{$payment->TransactionStatus}</td></tr>";
                }
              ?>
            </table>
          </div>
          <br>
          <div class="row">

            <div class="col-md-6 col-sm-12 py-2">
              <a href="?pg=print-payment-history" target="_blank" class="btn back-button btn-md"><i class="fa fa-print"></i>&ensp;<b>Print</b></a>
            </div>
            <div class="col-md-6 col-sm-12 text-right py-2">
              <a href="?pg=fees" class="btn back-button"><i class="fa fa-arrow-left"></i>&ensp;<b>Go back</b></a>
            </div>

          </div>
        </div>
    </div>

  </div>
</div>
