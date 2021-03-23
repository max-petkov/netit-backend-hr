<?php 
include 'src/database.php';
include_once 'src/functions.php';
include_once 'src/sessions.php';

// The session value from id will be removed
$_SESSION['employee_id'] = null;
$_SESSION['success_message'] = "Successfully logged out!";
redirect_to('login.php');
session_destroy();

?>