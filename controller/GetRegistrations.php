<?php
// get the list of course registration
$query_get_list_of_registration = "
    SELECT Distinct * FROM vw_registration_display WHERE 
    MatricNo LIKE '{$_SESSION['student_details']->matricnum}' AND 
    Status = '1' ORDER BY RegistrationDisplayID DESC
";
$get_the_list_of_registrations = DB_STUDENT::getInstance()->query($query_get_list_of_registration);
error_handler($get_the_list_of_registrations, $_SESSION['student_details']->matricnum, "Error occured on query_get_list_of_registration query", "controller/GetRegistrations.php");
$_list_of_registration = $get_the_list_of_registrations->results();