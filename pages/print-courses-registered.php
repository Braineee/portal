<?php
// include the get courses to register
include('controller/GetRegistrations.php');
?>
<div class="py-5" style="margin-top: 50px;">
  <div class="container">
      <div class="row">

        <?php include('inc/sidebar.php') ?>

        <div class="col-md-9">
          <div class="py-2">
            <h3>Print course registration</h3>
            <hr>
          </div>
          <h6 class="text-danger">Select a course form</h6>
            <table class="table table-responsive table-striped" style="width: 100%; border: 0px;">
              <tr>
                  <th>#</th>
                  <th class='text-center'>Academic Session</th>
                  <th class='text-center'>Level</th>
                  <th class='text-center'>Semester</th>
                  <th class='text-center'>Option</th>
              </tr>
              <?php
                $counter = 1;
                if (count($_list_of_registration) > 0) {
                    foreach ($_list_of_registration as $registration) {
                        echo"
                            <tr>
                                <td>". $counter ++ ."</td>
                                <td class='text-center'>{$registration->Session}</td>
                                <td class='text-center'>{$registration->Level}</td>
                                <td>{$registration->Semester}</td>
                                <td class='text-center'> 
                                    <a class='btn btn-block back-button btn-sm' 
                                        target='_blank'
                                        href='?pg=print-out-course-reg&session=".tpyrcne($registration->A_SessionID, 'e')."&semester=".tpyrcne($registration->SemesterID, 'e')."'>
                                        <i class='fa fa-print'></i>&ensp; Print
                                    </a> 
                                </td>
                            </tr>
                        ";
                    }
                } else {
                    echo "
                        <tr>
                            <td>
                             <td colspan='5'>This course is not available for this semester, kindly see your course adviser for more info.</td>
                            </td>
                        </tr>
                    ";
                }
             ?>
            </table>
            <hr>
            <div class="row">
              <div class="col-md-4 col-sm-12 py-2">
                <a href="?pg=course-registration" class="btn btn-block back-button"
                data-toggle="tooltip" data-placement="top" title="You haven't submitted your registration, please do.">
                <i class="fa fa-arrow-left"></i>&ensp;<b>Go back</b></a>
              </div>
            </div>
        </div>
    </div>
  </div>
</div>
<script src="<?php echo BASE_URL; ?>ajax/submit-course-registration.js"></script>
