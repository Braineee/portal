 <div class="py-5" style="margin-top: 50px;">
    <div class="container">
        <div class="row">

          <?php include('inc/sidebar.php') ?>

          <div class="col-md-9">
            <!-- error -->
            <?php include ('functions/notification.php'); ?>
            <!-- /error -->
            <div class="">
              <h3>Upload passport</h3>
              <hr>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 text-center">
                <span class="text-danger">
                    <i class="fa fa-info-circle"></i>&ensp;
                    <small>Click on the avatar to upload your passport, please note that your passport must be clear and have a red background and should be of the size 150px by 150px.</small>
                </span><br><br>
                <img 
                    src="<?= $_SESSION['student_passport'] ?>" 
                    id="display_"
                    width="200px" 
                    alt="avatar"
                    data-toggle="tooltip" data-placement="top" title="Click on this avartar to upload your passport"
                    > <br><br>
                <input type="file" style="display:none;" id="student_passport" name="student_passport" alt="student_passport">
                <?php
                    if (isset($_SESSION['student_has_passport']) && $_SESSION['student_has_passport'] == false) {
                ?>
                    <button class="btn  back-button"><i class="fa fa-upload"></i>&ensp; Upload this passport</button>
                <?php
                    }
                ?>
              </div>
            </div>
            <br>
            <br>
            <div class="">
              <h3>Change password</h3>
              <hr>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-12 offset-md-3 text-center">
                <span class="text-danger">
                    <i class="fa fa-info-circle"></i>&ensp;
                    <small>Remember, your current password is your surname if you haven't changed it previously.</small>
                </span>
                <br><br>
                <form>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Enter your current password here.">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Enter your new password here.">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Enter your new password again here .">
                    </div>
                    <br>
                    <button type="submit" class="btn back-button"><i class="fa fa-save"></i>&ensp;Change Password</button>
                </form>
              </div>
            </div>
            <br>
        </div>
      </div>
    <script src="<?php echo BASE_URL; ?>ajax/upload-passport.js"></script>
