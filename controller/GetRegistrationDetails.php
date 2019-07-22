<?php
if (!isset($_GET['session']) OR !isset($_GET['semester'])) :
    Session::flash('info', 'Please select a course registration to print.');
    redirect('?pg=print-courses-registered');
    die();
endif;

// decrypt the details
$_sessionid = tpyrcne($_GET['session'], 'd');
$_semesterid = tpyrcne($_GET['semester'], 'd');

// get the list of course registration
$query_get_list_of_registration_details = "
    SELECT * FROM vw_registration WHERE 
    MatricNo LIKE '{$_SESSION['student_details']->matricnum}' AND 
    A_SessionID LIKE '{$_sessionid}' AND
    SemesterID LIKE '{$_semesterid}' 
";
$get_the_list_of_registrations_details = DB_STUDENT::getInstance()->query($query_get_list_of_registration_details);
error_handler($get_the_list_of_registrations_details, $_SESSION['student_details']->matricnum, "Error occured on query_get_list_of_registration_details query", "controller/GetRegistrationDetails.php");
$_list_of_registrations_details = $get_the_list_of_registrations_details->results();

