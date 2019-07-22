<div class="py-5" style="margin-top: 50px;">
  <div class="container">
      <div class="row">

        <?php include('inc/sidebar.php') ?>

        <div class="col-md-9">
          <div class="">
            <h3>Fee Payment & Registration</h3>
            <hr>
          </div>
          <div class="row">
            <section>
              <div class="container py-3">
                <div class="col-md-12 card" style="padding-left: 0px;padding-right: 0px;"
                     data-toggle="tooltip" data-placement="bottom" title="Just click this bar">
                  <a href="?pg=make-payment" class="text-green">
                  <div class="row">
                      <div class="col-md-4 col-sm-4 text-center v-align py-4">
                        <img src="<?= BASE_URL ?>assets/icons/money_2.svg" alt="user_icon" width="50px" height="50px">
                      </div>
                      <div class="col-md-8 col-sm-8">
                        <div class="card-block px-3 py-3">
                          <p class="card-text">
                            <b>Pay my school fees now</b><br>
                            Click here to pay your school fees.
                          </p>
                        </div>
                      </div>
                  </div>
                  </a>
                </div>
              </div>
            </section>
            <section>
              <div class="container py-3">
                <div class="col-md-12 card" style="padding-left: 0px;padding-right: 0px;"
                     data-toggle="tooltip" data-placement="bottom" title="Just click this bar">
                  <a href="?pg=print-out-payment-advise-full" target="_blank" class="text-green">
                  <div class="row">
                      <div class="col-md-4 col-sm-4 text-center v-align py-4">
                        <img src="<?= BASE_URL ?>assets/icons/printer.svg" alt="user_icon" width="50px" height="50px">
                      </div>
                      <div class="col-md-8 col-sm-8">
                        <div class="card-block px-3 py-3">
                          <p class="card-text">
                            <b>Payment Advice Full</b><br>
                            Print full school fees payment advice.
                          </p>
                        </div>
                      </div>
                  </div>
                  </a>
                </div>
              </div>
            <section>
          </div>
          <div class="row">
          <?php
          if ($_SESSION['is_part_time']) {
          ?>
            <section>
              <div class="container py-3">
                <div class="col-md-12 card" style="padding-left: 0px;padding-right: 0px;"
                     data-toggle="tooltip" data-placement="bottom" title="Just click this bar">
                  <a href="?pg=print-out-payment-advise-half" target="_blank" class="text-green">
                  <div class="row">
                      <div class="col-md-4 col-sm-4 text-center v-align py-4">
                        <img src="<?= BASE_URL ?>assets/icons/printer.svg" alt="user_icon" width="50px" height="50px">
                      </div>
                      <div class="col-md-8 col-sm-8">
                        <div class="card-block px-3 py-3">
                          <p class="card-text">
                            <b>Payment Advice Half</b><br>
                            Print half school fees payment advice.
                          </p>
                        </div>
                      </div>
                  </div>
                  </a>
                </div>
              </div>
            <section>
          <?php } ?>
          </div>
          <br>
          <hr>
          <div class="col-md-6 col-sm-12 text-right py-2">
          <a href="?pg=fees" class="btn back-button btn-md btn-block"><i class="fa fa-arrow-left"></i>&ensp;<b>Go back</b></a>
          </div>
        </div>

    </div>
  </div>
</div>
