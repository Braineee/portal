<?php
// the lack of the programme id 
// would affect the student department, school and programmw
// check the programme id
if ($_SESSION['student_data']->ProgrammeID == "") {
    // initialize the fixed variable
    $_programme_id_is_fixed = false;

    // Get the programme
    $sTest = $_SESSION['student_data']->programme;

    // get the first letter of the programme
    $first_letter = $sTest[0];

    // if the student is either hnd or ond
    if ($first_letter == "N" || $first_letter == "H") {
        preg_match("/\(([^\)]*)\)/", $sTest, $aMatches);
        $programme = $aMatches[1];
        //do_alert($programme);
    }
    
    // if the student is a BSC
    if ($first_letter == "B") {
        //do_alert($first_letter);
        //do_alert($sTest);
        $pro = substr($sTest, 8, -9);
        //do_alert($pro);
        preg_match("/\(([^\)]*)\)/", $pro, $aMatches);
        $programme = $aMatches[1];
        //do_alert($programme);
    }

    try {
        // get the related programme
        $get_programme_id = DB_student::getInstance()
        ->query("SELECT * FROM programme WHERE programme like '$programme'");
        error_handler($get_programme_id, $_SESSION['student_data']->matricnum, "Programme ID could not be located(EE)" ,"controller/ValidateStudentData.php");


        if ($get_programme_id->count() > 0) {
            // update query
            $query = "
                UPDATE student_record 
                SET ProgrammeID = {$get_programme_id->first()->ProgrammeID} 
                WHERE matricnum = '{$_SESSION['student_data']->matricnum}'
            ";

            // update the programme id by running the query
            $update_programme_id = DB_student::getInstance()->query($query);
            error_handler($update_programme_id, $_SESSION['student_data']->matricnum, "Programme ID could not be updated", "controller/ValidateStudentData.php");

            // log the changes
            if ($update_programme_id->error() == false) {
                $log = new Logger(ROOT_PATH ."system_update_log.html");
                $log->setTimestamp("D M d 'y h.i A");
                $log->putLog("Programme ID was updated for {$_SESSION['student_data']->matricnum}");

                $_programme_id_is_fixed = true;
            }
        }

        // check if the issue was fixed
        if ($_programme_id_is_fixed == false) {
            exit(json_encode(['error' => 'There seems to be an error with your programme, please visit CITM or CITM HELPDESK']));
            die();
        }

    } catch(Exception $e){
        die($e->getMessage());
    }
}

