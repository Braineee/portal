<?php
//get the configuration for the local server
require_once ("config/Config.php");
require_once (ROOT_PATH . "core/init.php");

if (!isset($_GET["pg"]) || $_GET["pg"] == ""){
    $_GET["pg"] = "login";
}

$student = new User();

if($student->isLoggedin()){
  // Get the user data
  $_SESSION['student_details'] = $_SESSION['student_data'];
}else{
  if($_GET["pg"] != 'verify'){
    // go to the login page if the user is not logged in
    $_GET["pg"] = "login";
  }
}

// Check if pg exits
if (isset($_GET["pg"])){
    //If pg exists, assign its value to $page_name
    $page_name = $_GET["pg"];
}

if (stripos($page_name, 'print-out') === false):
  // include the header file
  include(ROOT_PATH . "inc/head.php");
endif;

if ($page_name != 'login' AND stripos($page_name, 'print-out') === false):
  //include the navbar
  include(ROOT_PATH . "inc/navbar.php");
endif;

if ($page_name != 'login' AND $page_name != 'logout'):

  // check the school fees status
  if (!isset($_SESSION['school_fees_payment_status'])) {
    include('controller/CheckSchoolFeesStatus.php');
  }

  // check the extra fee status
  if (!isset($_SESSION['extra_payment'])) {
    include('controller/CheckExtraFeesStatus.php');
  }

  // check the registration status
  if (!isset($_SESSION['course_registration_status'])) {
    include('controller/CheckCourseRegStatus.php');
  }

  // check the hostel status
  if ((!isset($_SESSION['hostel_status'])) AND ($_SESSION['is_full_time'] == true)) {
    include('controller/CheckHostelStatus.php');
  }

  // check the access previledges
  include('controller/CheckStudentStatus.php');

endif;

//check the file
$filename = ROOT_PATH ."pages/" . $page_name . ".php";

if (file_exists($filename)):
    // Pass the $page_name to the include path bellow
    include(ROOT_PATH . "pages/". $page_name .".php");
else:
    include(ROOT_PATH . "pages/not-found.php");
endif;


if($page_name != 'login'):
  //include footer
  include(ROOT_PATH . "inc/footer.php");
endif;
