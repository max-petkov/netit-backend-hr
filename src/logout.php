<?php 
include 'database.php';
include_once 'functions.php';
include_once 'sessions.php';

// The session value from id will be removed
$_SESSION['employee_id']     = null;
$_SESSION['company_id']      = null;
$_SESSION['hr_id']      = null;
$_SESSION['success_message'] = "Successfully logged out!";
redirect_to('../login.php');
session_destroy();
