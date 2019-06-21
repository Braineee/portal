<?php

$user = new User(); // curent user
$user->logout();
session_destroy();

redirect('?pg=login'); 
