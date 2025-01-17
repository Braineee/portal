<?php
require_once("../config/Config.php");
require_once(ROOT_PATH . "core/init.php");


if (empty($_SESSION['student_token'])) {
    $_SESSION['student_token'] = bin2hex(random_bytes(32));
}

header('Content-Type: application/json');

$headers = apache_request_headers();
if (isset($headers['CsrfToken'])) {
    if (!hash_equals($headers['CsrfToken'], $_SESSION['student_token'])) {
        exit(json_encode(['error' => 'Wrong CSRF token.']));
    }
} else {
    exit(json_encode(['error' => 'No CSRF token.']));
}

if (!isset($_POST)) {
    exit(json_encode(['error' => 'input was not found.']));
    die();
}

// get registration display status
$query_get_registration_display = "
    SELECT * FROM registration_display WHERE 
    matricno LIKE '{$_SESSION['student_details']->matricnum}' AND
    a_sessionid LIKE '{$_SESSION['current_academic_session']->SessionID}' AND
    semesterid LIKE '{$_SESSION['current_semester']->SemesterID}' AND 
    Status LIKE '1'
";
$get_registration_display = DB_STUDENT::getInstance()->query($query_get_registration_display);
error_handler($get_registration_display, $_SESSION['student_details']->matricnum, "Error occured on query_get_registration_display query", "controller/UnlockCourseRegistration.php");
if ($get_registration_display->count() > 0) {

    $unlock_count = 0;

    // check if unlock count has been used up
    if ($get_registration_display->first()->UnlockCount == 3) {
        exit(json_encode(['error' => 'used_up']));
        die();
    }  else {
        $unlock_count = $get_registration_display->first()->UnlockCount + 1;
    }

    // update the status of the registration
    $query_update_registration_display = "
        UPDATE registration_display SET Status = '0', UnlockCount = {$unlock_count} WHERE
        matricno LIKE '{$_SESSION['student_details']->matricnum}' AND
        a_sessionid LIKE '{$_SESSION['current_academic_session']->SessionID}' AND
        semesterid LIKE '{$_SESSION['current_semester']->SemesterID}' AND 
        Status LIKE '1'
    ";
    $update_registration_display = DB_STUDENT::getInstance()->query($query_update_registration_display);
    error_handler($update_registration_display, $_SESSION['student_details']->matricnum, "Error occured on query_update_registration_display query", "controller/UnlockCourseRegistration.php");

    // return a success message
    if ($update_registration_display->error() == false) {
        include('CheckCourseRegStatus.php');
        exit(json_encode(['success' => true]));
    } else {
        exit(json_encode(['error' => 'there was a problem submitting your registration']));
    }
} else {
    exit(json_encode(['error' => 'not_submited']));
}
