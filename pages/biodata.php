
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
                    <?= $_SESSION['applicant_details']->Surname ?> <?= $_SESSION['applicant_details']->Firstname ?> <?= $_SESSION['applicant_details']->Othername ?>
                  </th>
                </tr>
                <tr width="100px">
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Application number:</span>
                  </td>
                  <th>
                    <?= $_SESSION['applicant_details']->Appnum ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Programme type:</span>
                  </td>
                  <th>
                    <?= $_SESSION['applicant_details']->PTName ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Session:</span>
                  </td>
                  <th>
                    <?= $_SESSION['applicant_details']->EntrySession ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">School:</span>
                  </td>
                  <th>
                    <?= $_SESSION['applicant_details']->SchoolName ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Department:</span>
                  </td>
                  <th>
                    <?= $_SESSION['applicant_details']->PNName ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Programme:</span>
                  </td>
                  <th>
                    <?= $_SESSION['applicant_details']->program ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Entry year:</span>
                  </td>
                  <th>
                    <?= $_SESSION['applicant_details']->EntrySession ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Sex:</span>
                  </td>
                  <th>
                    <?= $_SESSION['applicant_details']->Sex ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Date of Birth:</span>
                  </td>
                  <th>
                    <?= $_SESSION['applicant_details']->DOB ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Email:</span>
                  </td>
                  <th>
                    <?= $_SESSION['applicant_details']->Email ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Phone:</span>
                  </td>
                  <th>
                    <?= $_SESSION['applicant_details']->Phone ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Residential address:</span>
                  </td>
                  <th>
                    <?= $_SESSION['applicant_details']->Address ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Place of Birth:</span>
                  </td>
                  <th>
                    <?= $_SESSION['applicant_details']->POBName ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">State of Origin:</span>
                  </td>
                  <th>
                    <?= $_SESSION['applicant_details']->StateName ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Local Goverment Area (LGA):</span>
                  </td>
                  <th>
                    <?= $_SESSION['applicant_details']->LGAName ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Next of Kin (NOK):</span>
                  </td>
                  <th>
                    <?= $_SESSION['applicant_details']->NOK ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Next of Kin Phone:</span>
                  </td>
                  <th>
                    <?= $_SESSION['applicant_details']->NOKPhone ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Parent / Guardian name:</span>
                  </td>
                  <th>
                    <?= $_SESSION['applicant_details']->PGName ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Parent / Guardian address:</span>
                  </td>
                  <th>
                    <?= $_SESSION['applicant_details']->PGAddress ?>
                  </th>
                </tr>
                <tr>
                  <td>
                    <img src="<?= BASE_URL ?>assets/icons/status.svg" alt="user_icon" width="20px" height="20px"> &ensp;
                    <span class="text-muted">Parent / Guardian phone:</span>
                  </td>
                  <th>
                    <?= $_SESSION['applicant_details']->PGPhone ?>
                  </th>
                </tr>
              </table>
              <br>
              <!--a href="?pg=print-biodata" Class="btn btn-primary btn-md pull-right"><i class="fa fa-print"></i>&ensp;<b>Print</b></a-->
            </div>
          </div>
          <div class="row">

            <div class="col-md-6 col-sm-12 py-2">
              <a href="?pg=print-biodata" target="_blank" class="btn back-button btn-md"><i class="fa fa-print"></i>&ensp;<b>Print</b></a>
            </div>
            <div class="col-md-6 col-sm-12 text-right py-2">
              <a href="?pg=home" class="btn back-button"><i class="fa fa-arrow-left"></i>&ensp;<b>Go back</b></a>
            </div>

          </div>
          </div>
        </div>
    </div>
  </div>
</div>
