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

//extract the data from post
extract($_POST);

// check if the passport file is not empty
if ($_FILES['passport']['name'] == "" || $_FILES['passport']['size'] == 0) {
    exit(json_encode(['error' => true, 'message' => 'Please upload your passport']));
    die();
}

// check the extension
$extension = pathinfo($_FILES['passport']['name'], PATHINFO_EXTENSION);
if ($extension != "jpg" && $extension != "png" && $extension != "PNG" && $extension != "JPG") {
    exit(json_encode(['error' => true, 'message' => 'This passport format is not supported, please upload passport with a .JPG or PNG format']));
    die();
}

// check the passport size
list($len, $bre, ) = getimagesize($_FILES['passport']['tmp_name']);
if ($len > 150 || $bre > 150) {
    exit(json_encode(['error' => true, 'message' => 'Please upload a passport with a size of 150X150px']));
    die();
}

//check if the student have not submitted a passport before
$get_previous_upload = DB_STUDENT::getInstance()->get('student_passport', array('StudentID', '=', $_SESSION['student_details']->matricnum));
error_handler($get_previous_upload, $_SESSION['student_details']->matricnum, "Error occured on get_previous_upload query", "controller/UploadPassport.php");
if ($get_previous_upload->count() > 0) {
    exit(json_encode(['error' => true, 'message' => 'Your passport has been uploaded previously.']));
    die();
}

// sanitze the input
$phone = sanitize($matric_number, 'int');
$email = sanitize($email, 'string');

// check phone and the email
if ($phone == "" && $email == "") {
    exit(json_encode(['error' => true, 'message' => 'Please enter your email and your phone number']));
    die();
}

// check the phone number size
if (strlen($phone) > 11) {
    exit(json_encode(['error' => true, 'message' => 'Please enter a valid phone number']));
    die();
}

try{
    // get the relative path
    $_path_programme = str_replace(' ', '', $_SESSION['student_details']->programme);
    $_path_session = str_replace('/', '', $_SESSION['student_details']->entry_year);
    $full_path = $_path_programme.$_path_session;

    // initialize the directory to store the passport
    $directory = "passport_db/";
    $path = $full_path.'/';
    $new_path = $directory . $path;

    // check if the destination exist previously
    if (is_dir($new_path)) {
        $passport_name = str_replace('/', '', $_SESSION['student_details']->matricnum);
        $file_name = $passport_name.".".pathinfo($_FILES['passport']['name'], PATHINFO_EXTENSION);// Save the PDF file with the title
        $tmp = $_FILES['passport']['tmp_name'];// get the temporary name of the PDF file
        $file_path = $new_path.$file_name;
        move_uploaded_file($tmp, $file_path);
    } else {
        //create the directory
        mkdir($new_path);
        $passport_name = str_replace('/', '', $_SESSION['student_details']->matricnum);
        $file_name = $passport_name.".".pathinfo($_FILES['passport']['name'], PATHINFO_EXTENSION);// Save the PDF file with the title
        $tmp = $_FILES['passport']['tmp_name'];// get the temporary name of the PDF file
        $file_path = $new_path.$file_name;
        move_uploaded_file($tmp, $file_path);
    }

    // save the student passport upload data
    function save_student_data_to_student_passport_table($file_name) {
        $save_passport_upload = new Crud();
        return $save_passport_upload->create('student_passport', array(
            "StudentID" => $_SESSION['student_details']->matricnum,
            "Passport" => $file_name,
            "Programme" => $full_path,
            "DateUploaded" => date('Y-m-d'),
            "SessionID" => $_SESSION['current_academic_session']->SessionID
        ));
    }

    // save the student email and phone number
    function save_student_phone_and_email($email, $phone) {
        $save_email_phone = new Crud();
        return $save_email_phone->update('student_record', 'matricnum', $_SESSION['student_details']->matricnum, array(
            "CurrentEmail" => $email,
            "CurrentPhoneNo" => $phone,
        ));
    } 

    if (save_student_data_to_student_passport_table($file_name) && save_student_data_to_student_passport_table($email, $phone)):
        exit(json_encode(['success' => true, 'message' => 'Your passport has been uploaded successfully']));
        die();
    else:
        exit(json_encode(['error' => true, 'message' => 'There was an error uploading your passport']));
        die();
    endif;

} catch (Exception $e) {
    die($e->getMessage());
}



