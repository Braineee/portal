<?php
$EBPORTAL_SESSION = $_SESSION['current_academic_session']->SessionID + 31;

// get the reciept number
$query_get_the_reciept_number = "
    SELECT receiptnum FROM schoolfees WHERE 
    matricnum LIKE '{$_SESSION['student_details']->matricnum}' AND 
    SessionID = {$EBPORTAL_SESSION};
";
$get_the_reciept_number = DB_EBPORTAL::getInstance()->query($query_get_the_reciept_number);
error_handler($get_the_reciept_number, $_SESSION['student_details']->matricnum, "Error occured on query_get_the_reciept_number query", "controller/GetSchoolfeesBreakDown.php");
if ($get_the_reciept_number->count() > 0):
    $_receipt_number = $get_the_reciept_number->first()->receiptnum;
endif;


//var_dump($get_the_reciept_number);


// get the ptacronym
$FT = array(1, 3, 5, 6);// programme type ids for fulltime
$PT = array(2, 4, 7, 8);// programme type ids for parttime
$_pt_acronym = "";

if (in_array($_SESSION['student_details']->ProgrammeTypeID, $FT)):
    $_pt_acronym = 'FT';
elseif (in_array($_SESSION['student_details']->ProgrammeTypeID, $PT)) :
    $_pt_acronym = 'PT';
endif;

// get the real level 
if ($_SESSION['student_details']->Real_Level == 'ND 1') {
    $level_ = 'ND I';
} elseif ($_SESSION['student_details']->Real_Level == 'ND 2') {
    $level_ = 'ND II';
} elseif ($_SESSION['student_details']->Real_Level == 'ND 3') {
    $level_ = 'ND III';
} elseif ($_SESSION['student_details']->Real_Level == 'HND 1') {
    $level_ = 'HND I';
} elseif ($_SESSION['student_details']->Real_Level == 'HND 2') {
    $level_ = 'HND II';
} elseif ($_SESSION['student_details']->Real_Level == 'HND 3') {
    $level_ = 'HND III';
} elseif ($_SESSION['student_details']->Real_Level == 'BSC 1') {
    $level_ = 'BSC I';
} elseif ($_SESSION['student_details']->Real_Level == 'BSC 2') {
    $level_ = 'BSC II';
} elseif ($_SESSION['student_details']->Real_Level == 'BSC 3') {
    $level_ = 'BSC III';
} elseif ($_SESSION['student_details']->Real_Level == 'BSC 4') {
    $level_ = 'BSC IV';
} elseif ($_SESSION['student_details']->Real_Level == 'CERT 1') {
    $level_ = 'CERT I';
} elseif ($_SESSION['student_details']->Real_Level == 'CERT 2') {
    $level_ = 'CERT II';
} elseif ($_SESSION['student_details']->Real_Level == 'CERT 3') {
    $level_ = 'CERT III';
}

// get the reciept breakdown
$query_get_break_down = "
    SELECT * FROM vw_SchoolFeesBreakDown WHERE 
    schoolName like '{$_SESSION['student_details']->School}' AND 
    SessionID = {$EBPORTAL_SESSION} AND 
    ptAcronym like '{$_pt_acronym}' AND 
    LevelName like '{$level_}'
";
$get_break_down = DB_EBPORTAL::getInstance()->query($query_get_break_down);
error_handler($get_break_down, $_SESSION['student_details']->matricnum, "Error occured on query_get_break_down query", "controller/GetSchoolfeesBreakDown.php");
if ($get_break_down->count() > 0):
    $_school_fees_break_down_list = $get_the_reciept_number->results();
endif;

// conver amount to words
$string = convertNumberToWord($_SESSION['amount_paid_by_student']);





