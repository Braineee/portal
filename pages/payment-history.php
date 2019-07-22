<?php 
 include_once ("controller/GetPaymentHistroy.php");
?>
<div class="py-5" style="margin-top: 50px;">
  <div class="container">
      <div class="row">

        <?php include ('inc/sidebar.php') ?>

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
                  echo "<tr>
                          <td>{$payment->PaymentName}</td>
                          <td>{$payment->Session}</td>
                          <td>&#8358;{$price}</td>
                          <td>{$payment->DatePosted}</td>
                          <td>{$payment->TransactionStatus}</td>
                        </tr>";
                }
              ?>
            </table>
          </div>
          <br>
          <br>
          <div class="row">

            <div class="col-md-6 col-sm-12 py-2">
              <a href="?pg=print-out-payment-history" target="_blank" class="btn back-button btn-md btn-block"><i class="fa fa-print"></i>&ensp;<b>Print</b></a>
            </div>
            <div class="col-md-6 col-sm-12 text-right py-2">
              <a href="?pg=fees" class="btn back-button btn-block"><i class="fa fa-arrow-left"></i>&ensp;<b>Go back</b></a>
            </div>

          </div>
        </div>
    </div>
  </div>
</div>
