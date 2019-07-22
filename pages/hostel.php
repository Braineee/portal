<?php 
  //redirect('?pg=under-construction'); 
  // check if the student if partime
  if (!isset($_SESSION['is_part_time'])) :
    Session::flash('info', 'Sorry, we could not determine if you are a full time student or not, kindly logout and login again.');
    redirect('?pg=home');
    die();
  endif;
  
  // do this if student is partime
  if ($_SESSION['is_part_time'] == true) :
    Session::flash('info', 'Part time students are not eligible to apply for hostel.');
    redirect('?pg=home');
    die();
  endif;
  
  // check if the student has been balloted for hostel
?>
<div class="py-5" style="margin-top: 50px;">
  <div class="container">
      <div class="row">

        <?php include('inc/sidebar.php') ?>

        <div class="col-md-9">
          <?php include('functions/notification.php');?>
          <div class="">
            <h3>Hostel & Accomodation</h3>
            <hr>
          </div>
          <div class="row">
            <div class="col-md-6">
            <section>
              <div class="container py-3">
                <div class="col-md-12 card" style="padding-left: 0px;padding-right: 0px;"
                      data-toggle="tooltip" data-placement="bottom" title="Just click this bar">
                  <a href="?pg=hostel-apply-payment" class="text-green">
                  <div class="row">
                      <div class="col-md-4 col-sm-4 text-center v-align py-4">
                        <img src="<?= BASE_URL ?>assets/icons/money_2.svg" alt="user_icon" width="50px" height="50px">
                      </div>
                      <div class="col-md-8 col-sm-8">
                        <div class="card-block px-3 py-3">
                          <p class="card-text">
                            <b>Apply for Hostel</b><br>
                            Click here to pay hostel application fee.
                          </p>
                        </div>
                      </div>
                  </div>
                  </a>
                </div>
              </div>
            </section>
            </div>
            <div class="col-md-6">
            <section>
              <div class="container py-3">
                <div class="col-md-12 card" style="padding-left: 0px;padding-right: 0px;"
                      data-toggle="tooltip" data-placement="bottom" title="Just click this bar">
                  <a href="?pg=hostel-accomodation-payment" class="text-green">
                  <div class="row">
                      <div class="col-md-4 col-sm-4 text-center v-align py-4">
                        <img src="<?= BASE_URL ?>assets/icons/hostel.svg" alt="user_icon" width="50px" height="50px">
                      </div>
                      <div class="col-md-8 col-sm-8">
                        <div class="card-block px-3 py-3">
                          <p class="card-text">
                            <b>Pay for Accomodation</b><br>
                            Click here to pay for hostel accomodation.
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
          <div class="row">
            <div class="col-md-6">
            <section>
              <div class="container py-3">
                <div class="col-md-12 card" style="padding-left: 0px;padding-right: 0px;"
                      data-toggle="tooltip" data-placement="bottom" title="Just click this bar">
                  <a href="?pg=hostel-document" class="text-green">
                  <div class="row">
                      <div class="col-md-4 col-sm-4 text-center v-align py-4">
                        <img src="<?= BASE_URL ?>assets/icons/printer.svg" alt="user_icon" width="50px" height="50px">
                      </div>
                      <div class="col-md-8 col-sm-8">
                        <div class="card-block px-3 py-3">
                          <p class="card-text">
                            <b>Print Hostel Documents</b><br>
                            Click here to print hostel documents.
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
  </div>
</div>
