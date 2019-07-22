<?php
// get the list of urls available based on student status
if (!isset($_SESSION['get_access'])) {
	$_SESSION['get_access'] = null;
	$_SESSION['get_access'] = array();

	$get_access = DB_STUDENT::getInstance()->query("SELECT url FROM access_level WHERE {$_SESSION['student_status']} LIKE '1'");
	error_handler($get_access, $_SESSION['student_details']->matricnum, "Error occured on get_access query", "controller/CheckStudentStatus.php");
	if ($get_access->count() > 0) {
		foreach ($get_access->results() as $data) {
			array_push($_SESSION['get_access'], $data->url);
		}
	}
}

// check if access is not availabe and redirect to home page
if (!in_array($page_name, $_SESSION['get_access'])) {
	Session::flash('info', "Your access is restricted because you have been {$_SESSION['student_status']}");
	redirect('?pg=home');
	die();
}

