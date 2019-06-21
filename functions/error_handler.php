<?php

// error handler function
function error_handler($query_object, $matricnumber, $message, $env){
    if (!is_object($query_object)) {
        $log = new Logger(ROOT_PATH ."error_log.html");
        $log->setTimestamp("D M d 'y h.i A");
        $log->putLog("\n ENV($env), e->object, e->message: {$message} >> ".$query_object->error_message().">> ".$matricnumber);
        die("<br><br><a href='?pg=home' class='btn btn-success'>Goto homepage</a>");
    }
    if ($query_object->error() == true) {
        $log = new Logger(ROOT_PATH ."error_log.html");
        $log->setTimestamp("D M d 'y h.i A");
        $log->putLog("\n ENV($env), e->query, e->message: {$message} >>".$query_object->error_message()[2].">> ".$matricnumber);
        die("<br><br><a href='?pg=home' class='btn btn-success'>Goto homepage</a>");
    }
}