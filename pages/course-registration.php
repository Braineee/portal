<div class="py-5" style="margin-top: 50px;">
  <div class="container">
      <div class="row">

        <?php include('inc/sidebar.php') ?>

        <div class="col-md-9">
          <?php include('functions/notification.php');?>
          <div class="">
            <h3>Course Registration</h3>
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
                  <a href="?pg=register-semester-courses" class="text-green">
                  <div class="row">
                      <div class="col-md-4 col-sm-4 text-center v-align py-4">
                        <img src="<?= BASE_URL ?>assets/icons/checklist2.svg" alt="user_icon" width="50px" height="50px">
                      </div>
                      <div class="col-md-8 col-sm-8">
                        <div class="card-block px-3 py-3">
                          <p class="card-text">
                            <b>Register my courses </b><br>
                            Register courses for this semester.
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
                  <a href="?pg=print-courses-registered" class="text-green">
                  <div class="row">
                      <div class="col-md-4 col-sm-4 text-center v-align py-4">
                        <img src="<?= BASE_URL ?>assets/icons/printer.svg" alt="user_icon" width="50px" height="50px">
                      </div>
                      <div class="col-md-8 col-sm-8">
                        <div class="card-block px-3 py-3">
                          <p class="card-text">
                            <b>Print course registration</b><br>
                            Print all course registered here.
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
                //CHECK PAYMENT
                if (isset($_SESSION['school_fees_payment_status'])) {
                    if (($_SESSION['school_fees_payment_status'] == 'PAID_COMPLETE')) {
            ?>
            <section>
              <div class="container py-3">
                <div class="col-md-12 card" style="padding-left: 0px;padding-right: 0px;"
                     data-toggle="tooltip" data-placement="bottom" title="Just click this bar">
                  <a href="#" class="text-green unlock">
                  <div class="row">
                      <div class="col-md-4 col-sm-4 text-center v-align py-4">
                        <img src="<?= BASE_URL ?>assets/icons/unlock.svg" alt="user_icon" width="50px" height="50px">
                      </div>
                      <div class="col-md-8 col-sm-8">
                        <div class="card-block px-3 py-3">
                          <p class="card-text">
                            <b>Unlock course registered</b><br>
                            Unlock your course registration here.
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
        </div>
        <br>
        <hr>
        <div class="col-md-6 col-sm-12 text-right py-2">
          <a href="?pg=home" class="btn back-button btn-md btn-block"><i class="fa fa-arrow-left"></i>&ensp;<b>Go back</b></a>
        </div>
    </div>
  </div>
</div>
<script src="<?php echo BASE_URL; ?>ajax/unlock-course-registration.js"></script>
