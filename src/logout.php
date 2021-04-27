<?php 
include_once 'functions.php';
session_start();

$_SESSION['employee_id'] = null;
$_SESSION['company_id'] = null;
$_SESSION['hr_id'] = null;
$_SESSION['success_message'] = "Successfully logged out!";
redirect_to('../login.php');
session_destroy();
