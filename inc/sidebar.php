<div class="col-md-3 col-sm-4">
  <div class="card mb-4 shadow-sm">
    <img class="card-img-top" src="<?= $_SESSION['applicant_picture'] ?>" alt="Card image cap" height="250px" width="150px;">
    <div class="card-body text-center">
      <p class="card-text">
        <a href="?pg=biodata"><h5><b><strong><?= $_SESSION['applicant_details']->Appnum ?></strong></b></h5></a>
      </p>
      <hr>
      <div class="text-center">
        <h6 class=""><b>
          <?= ucfirst($_SESSION['student_details']->Surname) ?>&nbsp;
          <?= ucfirst($_SESSION['student_details']->Firstname) ?>&nbsp;
          <?= ucfirst($_SESSION['student_details']->Othername) ?>&nbsp;
        </h6></b>
        <small class="text-muted"><?= $_SESSION['student_details']->Phone ?></small>
      </div>
    </div>
  </div>
  <hr>
  <div>
    <b><?= strtoupper($_SESSION['student_details']->Programme) ?></b>
  </div>
  <br>
  <div>
    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
    <b><?= strtolower($_SESSION['applicant_details']->EntrySession) ?></b>
  </div>
  <br>
  <div>
    <small>school fees status:</small><br>
    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
    <b><?php if(isset($_SESSION['school_fees_payment_status'])){
      if($_SESSION['school_fees_payment_status'] == 'NOT_PAID'){echo 'NOT PAID';}
      if($_SESSION['school_fees_payment_status'] == 'NOT_SET'){echo 'SCHOOL FEES NOT SET';}
      if($_SESSION['school_fees_payment_status'] == 'PAID_COMPLETE'){echo 'PAID COMPLETE';}
      if($_SESSION['school_fees_payment_status'] == 'NOT_COMPLETED'){echo 'NOT COMPLETED';}
      if($_SESSION['school_fees_payment_status'] == 'PAYMENT_NOT_DEFINED'){echo 'PAYMENT NOT DEFINED';}
      if($_SESSION['school_fees_payment_status'] == 'NOT_DEFINED'){echo 'NOT DEFINED';}
    }?></b>

  </div>
  <br>
  <div>
    <small>Matric generation status:</small><br>
    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
    <b>
      <?php
        if(isset($_SESSION['has_generate_matric'])){
          if($_SESSION['has_generate_matric'] == true){
            echo 'GENERATED';
          }else{
            echo 'NOT GENERATED';
          }
        }
      ?>
    </b>
  </div>
  <br>
  <br>
</div>
