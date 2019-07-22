
<div class="py-5" style="margin-top: 50px;">
  <div class="container">
      <div class="row">

        <?php include('inc/sidebar.php') ?>

        <div class="col-md-9">
          <div>
            <h3>Biodata</h3>
          </div>
          <div class="row">
            <div class="px-4">
              <br>
              <table class="table table-responsive" style="width: 100%; border: 0px;">
                <tr width="100px">
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Full Name:</span>
                  </td>
                  <th>
                    <?= $_SESSION['student_details']->surname ?> <?= $_SESSION['student_details']->firstname ?> <?= $_SESSION['student_details']->othername ?>
                  </th>
                </tr>
                <tr width="100px">
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Matric number:</span>
                  </td>
                  <th>
                    <?= $_SESSION['student_details']->matricnum ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Programme type:</span>
                  </td>
                  <th>
                    <?= $_SESSION['student_details']->programme_type ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Session:</span>
                  </td>
                  <th>
                    <?= $_SESSION['student_details']->entry_year ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">School:</span>
                  </td>
                  <th>
                    <?= $_SESSION['student_details']->School ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Department:</span>
                  </td>
                  <th>
                    <?= $_SESSION['student_details']->department ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Programme:</span>
                  </td>
                  <th>
                    <?= $_SESSION['student_details']->programme ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Sex:</span>
                  </td>
                  <th>
                    <?= $_SESSION['student_details']->sex ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Date of Birth:</span>
                  </td>
                  <th>
                    <?= $_SESSION['student_details']->dob ?>/<?= $_SESSION['student_details']->mob  ?>/<?= $_SESSION['student_details']->yob  ?>
                  </th>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Email:</span>
                  </td>
                  <th>
                    <?= $_SESSION['student_details']->email ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Phone:</span>
                  </td>
                  <th>
                    <?= $_SESSION['student_details']->phone ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Residential address:</span>
                  </td>
                  <th>
                    <?= $_SESSION['student_details']->address ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Place of Birth:</span>
                  </td>
                  <th>
                    <?= $_SESSION['student_details']->place_of_birth ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">State of Origin:</span>
                  </td>
                  <th>
                    <?= $_SESSION['student_details']->state_of_origin ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Local Goverment Area (LGA):</span>
                  </td>
                  <th>
                    <?= $_SESSION['student_details']->local_gov_area ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Parent / Guardian name:</span>
                  </td>
                  <th>
                    <?= $_SESSION['student_details']->parent_guardian ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Parent / Guardian address:</span>
                  </td>
                  <th>
                    <?= $_SESSION['student_details']->p_g_address ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Parent / Guardian phone:</span>
                  </td>
                  <th>
                    <?= $_SESSION['student_details']->p_g_phone ?>
                  </th>
                </tr>
              </table>
              <br>
              <!--a href="?pg=print-biodata" Class="btn btn-primary btn-md pull-right"><i class="fa fa-print"></i>&ensp;<b>Print</b></a-->
            </div>
          </div>
          <div class="row">

            <div class="col-md-6 col-sm-12 py-2">
              <a href="?pg=print-out-biodata" target="_blank" class="btn back-button btn-block"><i class="fa fa-print"></i>&ensp;<b>Print</b></a>
            </div>
            <div class="col-md-6 col-sm-12 text-right py-2">
              <a href="?pg=home" class="btn back-button btn-block"><i class="fa fa-arrow-left"></i>&ensp;<b>Go back</b></a>
            </div>

          </div>
          </div>
        </div>
    </div>
  </div>
</div>
