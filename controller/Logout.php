<?php
require_once ("../config/Config.php");
require_once (ROOT_PATH . "core/init.php");

$user = new User(); // curent user
$user->logout();
session_destroy();
exit(json_encode(['success' => true]));
