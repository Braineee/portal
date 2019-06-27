<div class="col-md-3 col-sm-4">
  <div class="card mb-4 shadow-sm">
    <img class="card-img-top" src="<?= $_SESSION['student_passport'] ?>" alt="Card image cap" height="250px" width="150px;">
    <div class="card-body text-center">
      <p class="card-text">
        <a href="?pg=biodata"><h5><b><strong><?= $_SESSION['student_details']->matricnum ?></strong></b></h5></a>
      </p>
      <hr>
      <div class="text-center">
        <h6 class=""><b>
          <?= ucfirst($_SESSION['student_details']->surname) ?>&nbsp;
          <?= ucfirst($_SESSION['student_details']->firstname) ?>&nbsp;
          <?= ucfirst($_SESSION['student_details']->othername) ?>&nbsp;
        </h6></b>
        <small class="text-muted"><?= $_SESSION['student_details']->phone ?></small>
      </div>
    </div>
  </div>
  <hr>
  <div>
    <b><?= strtoupper($_SESSION['student_details']->programme) ?></b>
  </div>
  <br>
  <div>
    <small>academic session:</small><br>
    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
    <b><?= strtolower($_SESSION['student_details']->acadsession) ?></b>
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
      if($_SESSION['school_fees_payment_status'] == 'PAID_COMPLETE_HALF'){echo 'PAID HALF';}
    }?></b>

  </div>
  <br>
  <div>
    <small>Course registration status:</small><br>
    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
    <b>
      <?php
      ?>
    </b>
  </div>
  <br>
  <br>
</div>
