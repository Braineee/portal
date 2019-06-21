
  <div class="py-5" style="margin-top: 50px;">
    <div class="container">
        <div class="row">

          <?php include('inc/sidebar.php') ?>

          <div class="col-md-9">
            <!-- error -->
            <?php
              if(Session::exists('error')){
                echo "<div class='alert alert-dismissable alert-danger'>
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                              <span aria-hidden='true'>&times;</span>
                          </button>

                              <i class='fa fa-exclamation-circle'></i>&ensp;<strong>". Session::flash('error') . "</strong>

                      </div>";
              }
              if(Session::exists('info')){
                echo "<div class='alert alert-dismissable alert-warning'>
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                              <span aria-hidden='true'>&times;</span>
                          </button>

                              <i class='fa fa-exclamation-triangle'></i>&ensp;<strong>". Session::flash('info') . "</strong>

                      </div>";
              }
              if(Session::exists('success')){
                echo "<div class='alert alert-dismissable alert-success'>
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                              <span aria-hidden='true'>&times;</span>
                          </button>

                              <i class='fa fa-check'></i>&ensp;<strong>". Session::flash('success') . "</strong>

                      </div>";
              }
            ?>
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
            <?php
              //CHECK PAYMENT
              if(isset($_SESSION['school_fees_payment_status'])){
                if($_SESSION['school_fees_payment_status'] == 'PAID_COMPLETE'){
            ?>
            <div class="">
              <h3>Admission</h3>
              <hr>
            </div>
            <div class="row">
              <section>
                <div class="container py-3">
                  <div class="col-md-12 card" style="padding-left: 0px;padding-right: 0px;"
                       data-toggle="tooltip" data-placement="bottom" title="Just click this bar">
                    <a href="?pg=admission" class="text-green">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 text-center v-align py-4">
                          <img src="<?= BASE_URL ?>assets/icons/award.svg" alt="user_icon" width="50px" height="50px">
                        </div>
                        <div class="col-md-8 col-sm-8">
                          <div class="card-block px-3 py-3">
                            <p class="card-text">
                              <b>Admission letter</b><br>
                              Print your admission letter here.
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
                    <a href="?pg=generate-matric-number" class="text-green">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 text-center v-align py-4">
                          <img src="<?= BASE_URL ?>assets/icons/matric.svg" alt="user_icon" width="50px" height="50px">
                        </div>
                        <div class="col-md-8 col-sm-8">
                          <div class="card-block px-3 py-3">
                            <p class="card-text">
                              <b>Matric number</b><br>
                              Generate your matriculation number here
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
            <?php
                  }
              }
              //END OF CHECK PAYMENT
            ?>
            <div class="">
              <h3>Others</h3>
              <hr>
            </div>
            <div class="row">
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
                              <b>Hostel & Accomodation</b><br>
                              Make payments and registration <br>for hostel here.
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
                    <a href="http://portal.yabatech.edu.ng/paymentevidence/validatepayment.php" target="_blank" class="text-green">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 text-center v-align py-4">
                          <img src="<?= BASE_URL ?>assets/icons/checklist.svg" alt="user_icon" width="50px" height="50px">
                        </div>
                        <div class="col-md-8 col-sm-8">
                          <div class="card-block px-3 py-3">
                            <p class="card-text">
                              <b>Payment confirmation & verification</b><br>
                              Click here for all payment <br>conirmation and validation
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
