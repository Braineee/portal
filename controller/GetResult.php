<?php

// get the list of results to desplay
$get_all_results = DB_YABARES::getInstance()->query("SELECT * FROM ER5view WHERE matricno LIKE '{$_SESSION['student_details']->matricnum}'");
error_handler($get_all_results, $_SESSION['student_details']->matricnum, "Error occured on get_all_results query", "controller/GetResult.php");
$lsit_of_availabe_result = $get_all_results->results();

//var_dump($lsit_of_availabe_result);