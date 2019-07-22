  <div class="py-5" style="margin-top: 50px;">
    <div class="container">
        <div class="row">

          <?php include('inc/sidebar.php') ?>

          <div class="col-md-9">
            <!-- error -->
            <?php include ('functions/notification.php'); ?>
            <!-- /error -->
            <div class="">
              <h3>Dashboard</h3>
              <hr>
            </div>
            <div class="row">
              <section>
                <div class="container py-3">
                  <div class="col-md-12 card" style="padding-left: 0px;padding-right: 0px;"
                       data-toggle="tooltip" data-placement="bottom" title="Just click this bar">
                    <a href="?pg=biodata" class="text-green">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 text-center v-align py-4">
                          <img src="<?= BASE_URL ?>assets/icons/user.svg" alt="user_icon" width="50px" height="50px">
                        </div>
                        <div class="col-md-8 col-sm-8">
                          <div class="card-block px-3 py-3">
                            <p class="card-text">
                              <b>Biodata</b><br>
                              Here you can print your biodata details.
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
                    <a href="?pg=fees" class="text-green">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 text-center v-align py-4">
                          <img src="<?= BASE_URL ?>assets/icons/money_2.svg" alt="user_icon" width="50px" height="50px">
                        </div>
                        <div class="col-md-8 col-sm-8">
                          <div class="card-block px-3 py-3">
                            <p class="card-text">
                              <b>Fee payments & Receipts</b><br>
                              Make your school fees payment here.
                            </p>
                          </div>
                        </div>
                    </div>
                    </a>
                  </div>
                </div>
              </section>
            </div>
            <br>
            <br>
            <div class="">
              <h3>Course registration & exam docket</h3>
              <hr>
            </div>
            <div class="row">
              <section>
                <div class="container py-3">
                  <div class="col-md-12 card" style="padding-left: 0px;padding-right: 0px;"
                       data-toggle="tooltip" data-placement="bottom" title="Just click this bar">
                    <a href="?pg=course-registration" class="text-green">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 text-center v-align py-4">
                          <img src="<?= BASE_URL ?>assets/icons/checklist2.svg" alt="user_icon" width="50px" height="50px">
                        </div>
                        <div class="col-md-8 col-sm-8">
                          <div class="card-block px-3 py-3">
                            <p class="card-text">
                              <b>Course registration</b><br>
                              Register and print your courses here.
                            </p>
                          </div>
                        </div>
                    </div>
                    </a>
                  </div>
                </div>
              </section>
              <?php
                //CHECK PAYMENT
                if (isset($_SESSION['school_fees_payment_status'])) {
                    if (($_SESSION['school_fees_payment_status'] == 'PAID_COMPLETE')) {
                        ?>
              <section>
                <div class="container py-3">
                  <div class="col-md-12 card" style="padding-left: 0px;padding-right: 0px;"
                       data-toggle="tooltip" data-placement="bottom" title="Just click this bar">
                    <a href="#" class="text-green">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 text-center v-align py-4">
                          <img src="<?= BASE_URL ?>assets/icons/matric.svg" alt="user_icon" width="50px" height="50px">
                        </div>
                        <div class="col-md-8 col-sm-8">
                          <div class="card-block px-3 py-3">
                            <p class="card-text">
                              <b>Examination Docket</b><br>
                              Click this tab to generate your exam docket
                            </p>
                          </div>
                        </div>
                    </div>
                    </a>
                  </div>
                </div>
              </section>
              <?php
                    }
                } ?>
            </div>
            <br>
            <br>
            <div class="">
              <h3>Hostel application & Payment confirmation</h3>
              <hr>
            </div>
            <div class="row">
              <?php
                //CHECK PAYMENT
                if (isset($_SESSION['school_fees_payment_status'])) {
                    if (($_SESSION['school_fees_payment_status'] == 'PAID_COMPLETE')) {
              ?>
              <section>
                <div class="container py-3">
                  <div class="col-md-12 card" style="padding-left: 0px;padding-right: 0px;"
                       data-toggle="tooltip" data-placement="bottom" title="Just click this bar">
                    <a href="?pg=hostel" class="text-green">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 text-center v-align py-4">
                          <img src="<?= BASE_URL ?>assets/icons/hostel.svg" alt="user_icon" width="50px" height="50px">
                        </div>
                        <div class="col-md-8 col-sm-8">
                          <div class="card-block px-3 py-3">
                            <p class="card-text">
                              <b>Hostel Accomodation</b><br>
                              Payments and registration for hostel here.
                            </p>
                          </div>
                        </div>
                    </div>
                    </a>
                  </div>
                </div>
              </section>
              <?php
                    }
                }
              ?>
              <section>
                <div class="container py-3">
                  <div class="col-md-12 card" style="padding-left: 0px;padding-right: 0px;"
                       data-toggle="tooltip" data-placement="bottom" title="Just click this bar">
                    <a href="http://portal.yabatech.edu.ng/paymentevidence/validatepayment.php" target="_blank" class="text-green">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 text-center v-align py-4">
                          <img src="<?= BASE_URL ?>assets/icons/checklist.svg" alt="user_icon" width="50px" height="50px">
                        </div>
                        <div class="col-md-8 col-sm-8">
                          <div class="card-block px-3 py-3">
                            <p class="card-text">
                              <b>Payment confirmation</b><br>
                              conirmation all payments here.
                            </p>
                          </div>
                        </div>
                    </div>
                    </a>
                  </div>
                </div>
              </section>
            </div>
            <br>
            <br>
            <div class="">
              <h3>Result Checker & Transcript</h3>
              <hr>
            </div>
            <div class="row">
              <section>
                <div class="container py-3">
                  <div class="col-md-12 card" style="padding-left: 0px;padding-right: 0px;"
                       data-toggle="tooltip" data-placement="bottom" title="Just click this bar">
                    <a href="?pg=result" class="text-green">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 text-center v-align py-4">
                          <img src="<?= BASE_URL ?>assets/icons/result.svg" alt="user_icon" width="50px" height="50px">
                        </div>
                        <div class="col-md-8 col-sm-8">
                          <div class="card-block px-3 py-3">
                            <p class="card-text">
                              <b>My Result</b><br>
                              Print all your previous results here.
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
                    <a href="#" class="text-green">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 text-center v-align py-4">
                          <img src="<?= BASE_URL ?>assets/icons/award.svg" alt="user_icon" width="50px" height="50px">
                        </div>
                        <div class="col-md-8 col-sm-8">
                          <div class="card-block px-3 py-3">
                            <p class="card-text">
                              <b>Transcript</b><br>
                              Make your school fees payment here.
                            </p>
                          </div>
                        </div>
                    </div>
                    </a>
                  </div>
                </div>
              </section>
            </div>
          </div>
        </div>
      </div>
