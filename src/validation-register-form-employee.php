<?php 
include_once 'functions.php';

$employee_username         = '';
$employee_username         = '';
$employee_first_name       = '';
$employee_last_name        = '';
$employee_email            = '';
$employee_password         = '';
$employee_confirm_password = '';

$input_value_employee_username         = '';
$input_value_employee_first_name       = '';
$input_value_employee_last_name        = '';
$input_value_employee_email            = '';
$input_value_employee_password         = '';
$input_value_employee_confirm_password = '';

$error_message_username         = '';
$error_message_first_name       = '';
$error_message_last_name        = '';
$error_message_email            = '';
$error_message_password         = '';
$error_message_confirm_password = '';

$error_input_class_username         = '';
$error_input_class_first_name       = '';
$error_input_class_last_name        = '';
$error_input_class_email            = '';
$error_input_class_password         = '';
$error_input_class_confirm_password = '';

$success_message_username         = '';
$success_message_first_name       = '';
$success_message_last_name        = '';
$success_message_email            = '';
$success_message_password         = '';
$success_message_confirm_password = '';

$success_input_class_username         = '';
$success_input_class_first_name       = '';
$success_input_class_last_name        = '';
$success_input_class_email            = '';
$success_input_class_password         = '';
$success_input_class_confirm_password = '';

 if(isset($_POST['submit_registration'])) {



  // Username Validate
  if (empty($_POST['employee_username'])) {
    $error_message_username        = "<div class=\"invalid-feedback\"><i>You must fill the required field...</i></div>";
    $error_input_class_username    = 'is-invalid';
    $input_value_employee_username = $_POST['employee_username'];

  } elseif (!preg_match('/^[a-zA-Z0-9\p{Cyrillic}\-]+$/u', $_POST['employee_username'])) {
    $error_message_username        = "<div class=\"invalid-feedback\"><i>You can use only letters, numbers and dashes - ...</i></div>";
    $error_input_class_username    = 'is-invalid';
    $input_value_employee_username = $_POST['employee_username'];

  } elseif (mb_strlen($_POST['employee_username']) < 4) {
    $error_message_username        = "<div class=\"invalid-feedback\"><i>You need to have at least 4 characters...</i></div>";
    $error_input_class_username    = 'is-invalid';
    $input_value_employee_username = $_POST['employee_username'];

  } elseif (mb_strlen($_POST['employee_username']) > 49) {
    $error_message_username        = "<div class=\"invalid-feedback\"><i>You can put no more than 50 characters...</i></div>";
    $error_input_class_username    = 'is-invalid';
    $input_value_employee_username = $_POST['employee_username'];

  } elseif (checking_existing_username_email('tb_job_seeker_profile', 'username', $_POST['employee_username']) || checking_existing_username_email('tb_company_profile', 'username', $_POST['employee_username'])) {
    $error_message_username        = "<div class=\"invalid-feedback\"><i>Username already exists... Choose another one!</i></div>";
    $error_input_class_username    = 'is-invalid';
    $input_value_employee_username = $_POST['employee_username'];

  } else {
    $input_value_employee_username = $_POST['employee_username'];
    $success_input_class_username  = 'is-valid';
    $success_message_username      = "<div class=\"valid-feedback\"><i>Great!</i></div>";

  }

  // First Name Validate
  if (empty($_POST['first_name'])) {
    $error_message_first_name        = "<div class=\"invalid-feedback\"><i>You must fill the required field...</i></div>";
    $error_input_class_first_name    = 'is-invalid';
    $input_value_employee_first_name = $_POST['first_name'];

  } elseif (!preg_match('/^[a-zA-Z\p{Cyrillic}]+$/u', $_POST['first_name'])) {
    $error_message_first_name        = "<div class=\"invalid-feedback\"><i>Use only letters...</i></div>";
    $error_input_class_first_name    = 'is-invalid';
    $input_value_employee_first_name = $_POST['first_name'];

  } elseif (mb_strlen($_POST['first_name']) < 4) {
    $error_message_first_name        = "<div class=\"invalid-feedback\"><i>You need to have at least 4 characters...</i></div>";
    $error_input_class_first_name    = 'is-invalid';
    $input_value_employee_first_name = $_POST['first_name'];

  } elseif (mb_strlen($_POST['first_name']) > 49) {
    $error_message_first_name        = "<div class=\"invalid-feedback\"><i>You can put no more than 50 characters...</i></div>";
    $error_input_class_first_name    = 'is-invalid';
    $input_value_employee_first_name = $_POST['first_name'];
    
  } else {
    $input_value_employee_first_name = $_POST['first_name'];
    $success_input_class_first_name  = 'is-valid';
    $success_message_first_name      = "<div class=\"valid-feedback\"><i>Hello, {$_POST['first_name']}!</i></div>";

  }

  // Last Name Validate
  if (empty($_POST['last_name'])) {
    $error_message_last_name        = "<div class=\"invalid-feedback\"><i>You must fill the required field...</i></div>";
    $error_input_class_last_name    = 'is-invalid';
    $input_value_employee_last_name = $_POST['last_name'];

  } elseif (!preg_match('/^[a-zA-Z\p{Cyrillic}]+$/u', $_POST['last_name'])) {
    $input_value_employee_last_name = $_POST['last_name'];
    $error_input_class_last_name    = 'is-invalid';
    $error_message_last_name        = "<div class=\"invalid-feedback\"><i>Use only letters...</i></div>";

  } elseif (mb_strlen($_POST['last_name']) < 4) {
    $error_message_last_name        = "<div class=\"invalid-feedback\"><i>You need to have at least 4 characters...</i></div>";
    $error_input_class_last_name    = 'is-invalid';
    $input_value_employee_last_name = $_POST['last_name'];

  } elseif (mb_strlen($_POST['last_name']) > 49) {
    $error_message_last_name        = "<div class=\"invalid-feedback\"><i>You can put no more than 50 characters...</i></div>";
    $error_input_class_last_name    = 'is-invalid';
    $input_value_employee_last_name = $_POST['last_name'];
    
  } else {
    $input_value_employee_last_name = $_POST['last_name'];
    $success_input_class_last_name  = 'is-valid';
    $success_message_last_name      = "<div class=\"valid-feedback\"><i>Great!</i></div>";

  }

  // Email Validate
  if (empty($_POST['email'])) {
    $error_message_email        = "<div class=\"invalid-feedback\"><i>You must fill the required field...</i></div>";
    $error_input_class_email    = 'is-invalid';
    $input_value_employee_email = $_POST['email'];

  } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $input_value_employee_email = $_POST['email'];
    $error_input_class_email    = 'is-invalid';
    $error_message_email        = "<div class=\"invalid-feedback\"><i>Invalid email format... Try again!</i></div>";

  } elseif (mb_strlen($_POST['email']) > 254) {
    $error_message_email        = "<div class=\"invalid-feedback\"><i>You can put no more than 255 characters...</i></div>";
    $error_input_class_email    = 'is-invalid';
    $input_value_employee_email = $_POST['email'];
    
  } elseif (checking_existing_username_email('tb_job_seeker_profile', 'email', $_POST['email']) || checking_existing_username_email('tb_company_profile', 'email', $_POST['email'])) {
    $error_message_email        = "<div class=\"invalid-feedback\"><i>Email is already taken... Try another one!</i></div>";
    $error_input_class_email    = 'is-invalid';
    $input_value_employee_email = $_POST['email'];

  } else {
    $input_value_employee_email = $_POST['email'];
    $success_input_class_email  = 'is-valid';
    $success_message_email      = "<div class=\"valid-feedback\"><i>OK!</i></div>";

  }

  // Password validate
  if (empty($_POST['password'])) {
    $error_message_password        = "<div class=\"invalid-feedback\"><i>You must fill the required field...</i></div>";
    $error_input_class_password    = 'is-invalid';
    $input_value_employee_password = $_POST['password'];

  } elseif (!preg_match('/^[a-zA-Z0-9\p{Cyrillic}\-]+$/u', $_POST['password'])) {
    $input_value_employee_password = $_POST['password'];
    $error_input_class_password    = 'is-invalid';
    $error_message_password        = "<div class=\"invalid-feedback\"><i>You can use only letters, numbers and dashes - ...</i></div>";

  } elseif (mb_strlen($_POST['password']) < 4) {
    $error_message_password        = "<div class=\"invalid-feedback\"><i>You need to have at least 4 characters...</i></div>";
    $error_input_class_password    = 'is-invalid';
    $input_value_employee_password = $_POST['password'];

  } elseif (mb_strlen($_POST['password']) > 49) {
    $error_message_password        = "<div class=\"invalid-feedback\"><i>You can put no more than 50 characters...</i></div>";
    $error_input_class_password    = 'is-invalid';
    $input_value_employee_password = $_POST['password'];
    
  } else {
    $input_value_employee_password = $_POST['password'];
    $success_input_class_password  = 'is-valid';
    $success_message_password      = "<div class=\"valid-feedback\"><i>Great! Now you need to confirm it...</i></div>";

  }
  
  if (empty($_POST['confirm_password'])) {
    $error_message_confirm_password        = "<div class=\"invalid-feedback\"><i>You must fill the required field...</i></div>";
    $error_input_class_confirm_password    = 'is-invalid';
    $input_value_employee_confirm_password = $_POST['confirm_password'];

  } elseif ($_POST['password'] != $_POST['confirm_password']) {
    $input_value_employee_confirm_password = $_POST['confirm_password'];
    $error_input_class_confirm_password    = 'is-invalid';
    $error_message_confirm_password        = "<div class=\"invalid-feedback\"><i>Passwords must match... Try again!</i></div>";

  } else {
    $input_value_employee_confirm_password = $_POST['confirm_password'];
    $success_input_class_confirm_password  = 'is-valid';
    $success_message_confirm_password      = "<div class=\"valid-feedback\"><i>So far, so good!</i></div>";

  }

 }

?>