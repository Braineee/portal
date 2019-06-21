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
  $_SESSION['student_details'] = $student->data();
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

// include the header file
if(strpos($page_name, 'print') === false ){
include(ROOT_PATH . "inc/head.php");
}

if($page_name != 'login'){
  if(strpos($page_name, 'print') === false ){
    //include the navbar
    include(ROOT_PATH . "inc/navbar.php");
  }
}

//check the school fees status
if($page_name != 'login' && $page_name != 'logout'){
  if(!isset($_SESSION['school_fees_payment_status'])){
    include('controller/CheckSchoolFeesStatus.php');
  }
}


//check the file
$filename = ROOT_PATH ."pages/" . $page_name . ".php";

if (file_exists($filename)) {
    // Pass the $page_name to the include path bellow
    include(ROOT_PATH . "pages/". $page_name .".php");
}else{
    include(ROOT_PATH . "pages/not-found.php");
}

if($page_name != 'login'){
  if(strpos($page_name, 'print') === false ){
    //include footer
    include(ROOT_PATH . "inc/footer.php");
  }
}
