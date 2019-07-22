<?php
$_SESSION['course_registration_status'] = "NOT_REGISTERED";

// query to get the status
$query_get_reg_stat = "
    SELECT status FROM vw_registration_display WHERE
    matricno LIKE '{$_SESSION['student_details']->matricnum}' AND
    a_sessionid LIKE '{$_SESSION['current_academic_session']->SessionID}' AND
    semesterid LIKE '{$_SESSION['current_semester']->SemesterID}' 
";

// Run the query
$get_reg_status_query = DB_STUDENT::getInstance()->query($query_get_reg_stat);
error_handler($get_reg_status_query, $_SESSION['student_details']->matricnum, "Error occured on query_get_reg_stat query", "controller/CheckCourseRegStatus.php");

// if the student has registered 
if ($get_reg_status_query->count() >= 1) {

    // flag the status a registered
    $_SESSION['course_registration_status'] = "REGISTERED";

    // flag the student as registered
    $get_reg_status_query->first()->status == '1' ? 
    $_SESSION['course_registration_submittion'] = "SUBMITTED" : $_SESSION['course_registration_submittion'] = "NOT_SUBMITTED";

    // get the list of coures registered
    $get_list_of_courses_query = "
        SELECT * FROM vw_registration WHERE 
        matricno LIKE '{$_SESSION['student_details']->matricnum}' AND 
        a_sessionid = '{$_SESSION['current_academic_session']->SessionID}' AND  
        semesterid = '{$_SESSION['current_semester']->SemesterID}'
    ";

    // Run the query
    $get_reg_status_query = DB_STUDENT::getInstance()->query($get_list_of_courses_query);
    error_handler($get_reg_status_query, $_SESSION['student_details']->matricnum, "Error occured on get_list_of_courses_query query", "controller/CheckCourseRegStatus.php");

    // get the courses
    if ($get_reg_status_query->count() > 0) {
        $_SESSION['course_registration_details'] = $get_reg_status_query->results();
    } else {
        $_SESSION['course_registration_details'] = "ERR";
    }

}
