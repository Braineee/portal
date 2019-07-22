<?php
// include the get courses to register
include('controller/GetResult.php');
?>
<div class="py-5" style="margin-top: 50px;">
  <div class="container">
    <div class="row">

      <?php include('inc/sidebar.php') ?>

      <div class="col-md-9">
        <div class="py-2">
          <h3>Print Result</h3>
          <hr>
        </div>
        <table class="table table-responsive table-striped" style="width: 100%; border: 0px;">
          <tr>
            <th>#</th>
            <th class='text-center'>Academic Session</th>
            <th class='text-center'>Semester</th>
            <th class='text-center'>Level</th>
            <th class='text-center'>CGPA</th>
            <th class='text-center'>GPA</th>
            <th class='text-center'>Option</th>
          </tr>
          <?php
            $counter = 1;
            if (count($lsit_of_availabe_result) > 0) {
              foreach ($lsit_of_availabe_result as $result) {
                echo"
                  <tr>
                    <td>". $counter ++ ."</td>
                    <td class='text-center'>{$result->ASession}</td>
                    <td class='text-center'>{$result->Semester} SEMESTER</td>
                    <td>{$result->SLevel}</td>
                    <td>{$result->Cgpa}</td>
                    <td>{$result->GPA}</td>
                    <td class='text-center'> 
                      <a class='btn btn-block back-button btn-sm' 
                        target='_blank'
                        data-toggle='tooltip' 
                        data-placement='bottom' 
                        title='View this result'
                        href='http://portal.yabatech.edu.ng/resultchecker/results.aspx?matno=".base64_encode($result->Matricno)."&level={$result->SLevel}&sem={$result->Semester}&acad={$result->ASession}'>
                        <i class='fa fa-eye'></i> 
                      </a> 
                    </td>
                  </tr>
                ";
              }
            } else {
              echo "
                <tr>
                  <td class='text-center'><img src='assets/img/svg/warning.svg' width='20px'></td>
                  <td colspan='6'>No result available online for you at the moment.</td>
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
