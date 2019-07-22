<?php
$_is_extra_year_student = false;
$_maximum_unit_to_be_register = 0;
$_carry_over_courses_details = array();
$_current_courses_details = array();

// GET THE MAXIMUM UNIT
$get_maximum_units = DB_STUDENT::getInstance()
->get('course_max_unit_setup', array('ProgrammeTypeID','=',$_SESSION['student_details']->ProgrammeTypeID));
error_handler($get_maximum_units, $_SESSION['student_details']->matricnum, "Error occured on get_maximum_units query", "controller/GetCoursesToRegister.php");
$_maximum_unit_to_be_register = $get_maximum_units->first()->MaxUnit;

// CHECK IF STUDENT HAS CARRIED OVER ANY COURSE
$query_check_carry_over = "
    SELECT * FROM summary_table_2 WHERE 
    Remark LIKE '%CO%' AND 
    MatricNo LIKE '{$_SESSION['student_details']->matricnum}' AND 
    A_SessionID LIKE '{$_SESSION['current_academic_session']->SessionID}' AND
    SemesterID LIKE '{$_SESSION['current_semester']->SemesterID}'
";
$check_if_carry_over = DB_STUDENT::getInstance()->query($query_check_carry_over);
error_handler($check_if_carry_over, $_SESSION['student_details']->matricnum, "Error occured on query_check_carry_over query", "controller/GetCoursesToRegister.php");

// CHECK IF THE STUDENT IS AN EXTRA YEAR STUDENT
if ($check_if_carry_over->count() > 0) {
    $check_if_carry_over->first()->SStatus == 'C' ? $_is_extra_year_student = true : $_is_extra_year_student = false;
}

// GET THE LIST OF CARRIED OVER COURSES
if ($check_if_carry_over->count() > 0) {
    foreach ($check_if_carry_over->results() as $details) {
        $extract = substr($details->Remark, strpos($details->Remark, ":") + 1);
    }

    $_list_of_carry_over_course_code = explode(',', $extract);

    for($i=0; $i<count($_list_of_carry_over_course_code); $i++) {
        $course_code = str_replace(' ','',$_list_of_carry_over_course_code[$i]);
        $query_get_carry_over_details = "
            SELECT * FROM courses WHERE 
            CourseCode LIKE '{$course_code}' AND
            A_SessionID LIKE '{$_SESSION['current_academic_session']->SessionID}' AND 
            SemesterID LIKE '{$_SESSION['current_semester']->SemesterID}' AND 
            ProgrammeTypeID LIKE '{$_SESSION['student_details']->ProgrammeTypeID}' AND 
            ProgrammeID LIKE '{$_SESSION['student_details']->ProgrammeID}' AND 
            AStatus LIKE '1'
        ";
        $get_the_course_details = DB_STUDENT::getInstance()->query($query_get_carry_over_details);
        error_handler($get_the_course_details, $_SESSION['student_details']->matricnum, "Error occured on query_get_carry_over_details query", "controller/GetCoursesToRegister.php");
        if ($get_the_course_details->count() > 0) {
            array_push($_carry_over_courses_details, $get_the_course_details->results());
        } else {
            array_push($_carry_over_courses_details, $course_code);
        }
    }
}

// GET THE LIST OF COURSES FOR CURRENT SEMESTER 
$query_check_current_sementer_courses = "
    SELECT * FROM courses WHERE 
    A_SessionID LIKE '{$_SESSION['current_academic_session']->SessionID}' AND 
    SemesterID LIKE '{$_SESSION['current_semester']->SemesterID}' AND 
    ProgrammeTypeID LIKE '{$_SESSION['student_details']->ProgrammeTypeID}' AND 
    LevelID = '{$_SESSION['student_details']->level}' AND 
    ProgrammeID LIKE '{$_SESSION['student_details']->ProgrammeID}' AND 
    AStatus LIKE '1'
";
$get_current_sementer_courses = DB_STUDENT::getInstance()->query($query_check_current_sementer_courses);
error_handler($get_current_sementer_courses, $_SESSION['student_details']->matricnum, "Error occured on get_current_sementer_courses query", "controller/GetCoursesToRegister.php");
$_current_courses_details = $get_current_sementer_courses->results();

