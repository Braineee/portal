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

//get the post valuess
extract($_POST);

// initialize the variable
$_STUDENT_ON_REG_DISPLAY = false;
$_STUDENT_HAS_REGISTERED_COURSES = false;
$_COURSE_INSERTED_SUCCESSFULLY = false;
$_REGISTRATION_INSERTED_SUCCESSFULLY = false;

// get registration display status
$query_get_registration_display = "
    SELECT * FROM registration_display WHERE 
    matricno LIKE '{$_SESSION['student_details']->matricnum}' AND
    a_sessionid LIKE '{$_SESSION['current_academic_session']->SessionID}' AND
    semesterid LIKE '{$_SESSION['current_semester']->SemesterID}'
";
$get_registration_display = DB_STUDENT::getInstance()->query($query_get_registration_display);
error_handler($get_registration_display, $_SESSION['student_details']->matricnum, "Error occured on query_get_registration_display query", "controller/SaveCourseRegistration.php");
if ($get_registration_display->count() > 0) {
    $_STUDENT_ON_REG_DISPLAY = true;
}

// get the previous registered course
$query_get_courses_registed = "
    SELECT * FROM registration WHERE
    matricno LIKE '{$_SESSION['student_details']->matricnum}' AND
    a_sessionid LIKE '{$_SESSION['current_academic_session']->SessionID}' AND
    semesterid LIKE '{$_SESSION['current_semester']->SemesterID}'
";
$get_registration_courses = DB_STUDENT::getInstance()->query($query_get_courses_registed);
error_handler($get_registration_courses, $_SESSION['student_details']->matricnum, "Error occured on get_registration_courses query", "controller/SaveCourseRegistration.php");
if ($get_registration_courses->count() > 0) {
    $_STUDENT_HAS_REGISTERED_COURSES = true;
}

// This function deletes previous registered courses
function deletePreviousCourseReg () {
    $query_delete_previous_course_reg = "
        DELETE FROM registration WHERE 
        matricno LIKE '{$_SESSION['student_details']->matricnum}' AND
        a_sessionid LIKE '{$_SESSION['current_academic_session']->SessionID}' AND
        semesterid LIKE '{$_SESSION['current_semester']->SemesterID}'
    ";
    $delete_previous_course_reg = DB_STUDENT::getInstance()->query($query_delete_previous_course_reg);
    error_handler($delete_previous_course_reg, $_SESSION['student_details']->matricnum, "Error occured on query_delete_previous_course_reg query", "controller/SaveCourseRegistration.php");

    if ($delete_previous_course_reg->error() == false) {
        return false;
    } else {
        return true;
    }
}

// this function insert selected course into the registration table
function insertCoursesToRegistration ($courseId, $courseCode, $courseUnit) {
    $insert_to_registration = new CrudStudent();
    return $insert_to_registration
    ->create('registration', array(
        'MatricNo' => $_SESSION['student_details']->matricnum,
        'A_SessionID' => $_SESSION['current_academic_session']->SessionID,
        'SemesterID' => $_SESSION['current_semester']->SemesterID,
        'ProgrammeTypeID' => $_SESSION['student_details']->ProgrammeTypeID,
        'ProgrammeID' => $_SESSION['student_details']->ProgrammeTypeID,
        'LevelID' => $_SESSION['student_details']->level,
        'DeptID' => $_SESSION['student_details']->DepartmentID,
        'ProgrammeID2' => $_SESSION['student_details']->ProgrammeID,
        'CourseCode' => $courseCode,
        'CourseId' => $courseId,
        'CourseUnit' => $courseUnit,
        'DateCreated' => date('Y-m-d'),
        'TimeCreated' => date('H:i:s'),
        'AStatus' => '1',
    ));
}

// this function creates a new details for student in  registration_display
function createRegistrationDisplay () {
    $insert_to_registration_display = new CrudStudent();
    return $insert_to_registration_display
    ->create('registration_display', array(
        'MatricNo' => $_SESSION['student_details']->matricnum,
        'A_SessionID' => $_SESSION['current_academic_session']->SessionID,
        'SemesterID' => $_SESSION['current_semester']->SemesterID,
        'ProgrammeTypeID' => $_SESSION['student_details']->ProgrammeTypeID,
        'LevelID' => $_SESSION['student_details']->level,
        'Status' => '0',
        'AStatus' => '1',
        'UnlockCount' => '0',
        'DepartmentID' => $_SESSION['student_details']->DepartmentID,
        'SchoolID' => $_SESSION['student_details']->SchoolID,
        'ProgrammeID' => $_SESSION['student_details']->ProgrammeID,
        'DateCreated' => date('Y-m-d'),
        'TimeCreated' => date('H:i:s'),
    ));
}

// deletd the course registration
if ($_STUDENT_HAS_REGISTERED_COURSES == true) {
    $_STUDENT_HAS_REGISTERED_COURSES = deletePreviousCourseReg();
}

// insert the new course
if ($_STUDENT_HAS_REGISTERED_COURSES == false) {
    for($i=0;$i<count($CoursesID);$i++) { 
        if (isset($_SESSION['is_test']) && $_SESSION['is_test'] == true) :// remove this on  live
          $disable = DB_STUDENT::getInstance()->query('ALTER TABLE registration DISABLE TRIGGER insteadofregistration'); 
        endif;
        $_COURSE_INSERTED_SUCCESSFULLY = insertCoursesToRegistration($CoursesID[$i], $CoursesCode[$i], $CoursesUnit[$i]);
        if (isset($_SESSION['is_test']) && $_SESSION['is_test'] == true) :// remove this on  live
          $disable = DB_STUDENT::getInstance()->query('ALTER TABLE registration ENABLE TRIGGER insteadofregistration');
        endif;
    }
}

// insert into registration display if not there
if ($_COURSE_INSERTED_SUCCESSFULLY == true) {
    if ($_STUDENT_ON_REG_DISPLAY == false) {
        $_STUDENT_ON_REG_DISPLAY = createRegistrationDisplay(); 
    }
} 

// check if the process was successfull
if (($_COURSE_INSERTED_SUCCESSFULLY == true) && ($_STUDENT_ON_REG_DISPLAY == true)) {
    include ('CheckCourseRegStatus.php');
    exit(json_encode(['success' => true]));
} else {
    exit(json_encode(['error' => 'An error occured while saving your courses']));
}