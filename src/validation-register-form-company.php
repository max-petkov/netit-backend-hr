<?php 
include_once 'functions.php';

$company_username         = '';
$company_name             = '';
$company_email            = '';
$company_description      = '';
$company_branch           = '';
$company_password         = '';
$company_confirm_password = '';

$input_value_company_username    = '';
$input_value_company_name        = '';
$input_value_company_email       = '';
$input_value_company_description = '';
$input_value_password            = '';
$input_value_confirm_password    = '';

$error_message_company_username    = '';
$error_message_company_name        = '';
$error_message_email               = '';
$error_message_company_description = '';
$error_message_company_branch      = '';
$error_message_password            = '';
$error_message_confirm_password    = '';

$error_input_class_company_username    = '';
$error_input_class_company_name        = '';
$error_input_class_email               = '';
$error_input_class_company_description = '';
$error_input_class_company_branch      = '';
$error_input_class_password            = '';
$error_input_class_confirm_password    = '';

$success_message_company_username    = '';
$success_message_company_name        = '';
$success_message_email               = '';
$success_message_company_description = '';
$success_message_password            = '';
$success_message_confirm_password    = '';

$success_input_class_company_username    = '';
$success_input_class_company_name        = '';
$success_input_class_email               = '';
$success_input_class_company_description = '';
$success_input_class_password            = '';
$success_input_class_confirm_password    = '';

$success_class_check_front_end = '';
$success_class_check_back_end  = '';
$success_class_check_fullstack = '';
$success_class_check_qa        = '';
$success_class_check_mob_dev   = '';
$success_class_check_ux_ui     = '';

$success_check_front_end = '';
$success_check_back_end  = '';
$success_check_fullstack = '';
$success_check_qa        = '';
$success_check_mob_dev   = '';
$success_check_ux_ui     = '';




// TODO --> VALIDATION EXISTANCE & CONVERTING ARRAY INTO A STRING FOR CHECKBOX CUZ VALUES ARE GETTING AS ARRAY IN MYSQL;

 if(isset($_POST['submit_registration_company'])) {
  
  // Username validation
  if (empty($_POST['company_username'])) {
    $error_message_company_username     = "<div class=\"invalid-feedback\"><i>You must fill the required field...</i></div>";
    $error_input_class_company_username = 'is-invalid';
    $input_value_company_username       = $_POST['company_username'];

  } elseif (!preg_match('/^[a-zA-Z0-9\p{Cyrillic}\-]+$/u', $_POST['company_username'])) {
    $error_message_company_username     = "<div class=\"invalid-feedback\"><i>You can use only letters, numbers and dashes - ....</i></div>";
    $error_input_class_company_username = 'is-invalid';
    $input_value_company_username       = $_POST['company_username'];

  } elseif (checking_existing_username_email('tb_companies', 'username', $_POST['company_username']) || checking_existing_username_email('tb_employees', 'username', $_POST['company_username'])) {
    $error_message_company_username     = "<div class=\"invalid-feedback\"><i>Username already exists... Try another one!</i></div>";
    $error_input_class_company_username = 'is-invalid';
    $input_value_company_username       = $_POST['company_username'];

  } elseif (mb_strlen($_POST['company_username']) < 4) {
    $error_message_company_username     = "<div class=\"invalid-feedback\"><i>Must be more than 3 characters</i></div>";
    $error_input_class_company_username = 'is-invalid';
    $input_value_company_username       = $_POST['company_username'];

  } elseif (mb_strlen($_POST['company_username']) > 49) {
    $error_message_company_username     = "<div class=\"invalid-feedback\"><i>Must be lower than 50 characters</i></div>";
    $error_input_class_company_username = 'is-invalid';
    $input_value_company_username       = $_POST['company_username'];

  } else {
    $input_value_company_username         = $_POST['company_username'];
    $success_input_class_company_username = 'is-valid';
    $success_message_company_username     = "<div class=\"valid-feedback\"><i>Great!</i></div>";

  }

  // Company name validation
  if (empty($_POST['company_name'])) {
    $error_message_company_name     = "<div class=\"invalid-feedback\"><i>You must fill the required field...</i></div>";
    $error_input_class_company_name = 'is-invalid';
    $input_value_company_name       = $_POST['company_name'];

  } elseif (!preg_match('/^[a-zA-Z0-9\p{Cyrillic}\- ]+$/u', $_POST['company_name'])) {
    $error_message_company_name     = "<div class=\"invalid-feedback\"><i>You can use only letters, numbers and white space...</i></div>";
    $error_input_class_company_name = 'is-invalid';
    $input_value_company_name       = $_POST['company_name'];

  } elseif (mb_strlen($_POST['company_name']) < 4) {
    $error_message_company_name     = "<div class=\"invalid-feedback\"><i>Must be more than 3 characters</i></div>";
    $error_input_class_company_name = 'is-invalid';
    $input_value_company_name       = $_POST['company_name'];

  } elseif (mb_strlen($_POST['company_name']) > 254) {
    $error_message_company_name     = "<div class=\"invalid-feedback\"><i>Must be lower than 255 characters</i></div>";
    $error_input_class_company_name = 'is-invalid';
    $input_value_company_name       = $_POST['company_name'];

  } else {
    $input_value_company_name         = $_POST['company_name'];
    $success_input_class_company_name = 'is-valid';
    $success_message_company_name     = "<div class=\"valid-feedback\"><i>Hello, {$_POST['company_name']}!</i></div>";

  }

  // Email validation
  if (empty($_POST['email'])) {
    $error_message_email       = "<div class=\"invalid-feedback\"><i>You must fill the required field...</i></div>";
    $error_input_class_email   = 'is-invalid';
    $input_value_company_email = $_POST['email'];

  } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $input_value_company_email = $_POST['email'];
    $error_input_class_email   = 'is-invalid';
    $error_message_email       = "<div class=\"invalid-feedback\"><i>Invalid email format... Try again!</i></div>";

  } elseif (checking_existing_username_email('tb_companies', 'email', $_POST['email']) || checking_existing_username_email('tb_employees', 'email', $_POST['email'])) {
    $input_value_company_email = $_POST['email'];
    $error_input_class_email   = 'is-invalid';
    $error_message_email       = "<div class=\"invalid-feedback\"><i>Email is already been taken... Try another one!</i></div>";

  } elseif (mb_strlen($_POST['email']) > 254) {
    $error_message_email     = "<div class=\"invalid-feedback\"><i>Must be lower than 255 characters</i></div>";
    $error_input_class_email = 'is-invalid';
    $input_value_email       = $_POST['email'];

  } else {
    $input_value_company_email = $_POST['email'];
    $success_input_class_email = 'is-valid';
    $success_message_email     = "<div class=\"valid-feedback\"><i>OK!</i></div>";

  }
 
  // Company description validation
  if (empty($_POST['company_description'])) {
    $error_message_company_description     = "<div class=\"invalid-feedback\"><i>You must fill the required field...</i></div>";
    $error_input_class_company_description = 'is-invalid';
    $input_value_company_description       = $_POST['company_description'];

  } elseif (!preg_match('/^[a-zA-Z0-9\p{Cyrillic}\-\'!.,; ]+$/u', $_POST['company_description'])) {
    $error_message_company_description     = "<div class=\"invalid-feedback\"><i>You can use only letters, numbers and white space...</i></div>";
    $error_input_class_company_description = 'is-invalid';
    $input_value_company_description       = $_POST['company_description'];

  } elseif (mb_strlen($_POST['company_description']) < 49) {
    $error_message_company_description     = "<div class=\"invalid-feedback\"><i>Must be more than 49 characters</i></div>";
    $error_input_class_company_description = 'is-invalid';
    $input_value_company_description       = $_POST['company_description'];

  }elseif (mb_strlen($_POST['company_description']) > 499) {
    $error_message_company_description     = "<div class=\"invalid-feedback\"><i>Must be lower than 500 characters</i></div>";
    $error_input_class_company_description = 'is-invalid';
    $input_value_company_description       = $_POST['company_description'];

  } else {
    $input_value_company_description         = $_POST['company_description'];
    $success_input_class_company_description = 'is-valid';
    $success_message_company_description     = "<div class=\"valid-feedback\"><i>Good to know!</i></div>";

  }

  // IT Branch validation
  if (empty($_POST['it_branch'])) {
    $error_message_company_branch     = "<i class=\"text-danger\">You need to check at least one branch...</i>";
    $error_input_class_company_branch = 'is-invalid';
  } else {

    if(in_array('Front-end Development', $_POST['it_branch'])) {
      $success_check_front_end       = 'checked';
      $success_class_check_front_end = 'is-valid';
    }

    if(in_array('Back-end Development', $_POST['it_branch'])) {
      $success_check_back_end       = 'checked';
      $success_class_check_back_end = 'is-valid';
    } 

    if(in_array('Fullstack Development', $_POST['it_branch'])) {
      $success_check_fullstack       = 'checked';
      $success_class_check_fullstack = 'is-valid';
    } 

    if(in_array('Quality Assurance', $_POST['it_branch'])) {
      $success_check_qa       = 'checked';
      $success_class_check_qa = 'is-valid';
    } 

    if(in_array('Mobile Development', $_POST['it_branch'])) {
      $success_check_mob_dev       = 'checked';
      $success_class_check_mob_dev = 'is-valid';
    } 

    if(in_array('UX/UI', $_POST['it_branch'])) {
      $success_check_ux_ui       = 'checked';
      $success_class_check_ux_ui = 'is-valid';
    } 
    
  }

  // Password validation
  if (empty($_POST['password'])) {
    $error_message_password     = "<div class=\"invalid-feedback\"><i>You must fill the required field...</i></div>";
    $error_input_class_password = 'is-invalid';
    $input_value_password       = $_POST['password'];

  } elseif (!preg_match('/^[a-zA-Z0-9\p{Cyrillic}\-]+$/u', $_POST['password'])) {
    $input_value_password       = $_POST['password'];
    $error_input_class_password = 'is-invalid';
    $error_message_password     = "<div class=\"invalid-feedback\"><i>You can use only letters, numbers and dashes - ...</i></div>";

  } elseif (mb_strlen($_POST['password']) < 4) {
    $error_message_password     = "<div class=\"invalid-feedback\"><i>Must be more than 3 characters</i></div>";
    $error_input_class_password = 'is-invalid';
    $input_value_password       = $_POST['password'];

  } elseif (mb_strlen($_POST['password']) > 49) {
    $error_message_password     = "<div class=\"invalid-feedback\"><i>Must be lower than 50 characters</i></div>";
    $error_input_class_password = 'is-invalid';
    $input_value_password       = $_POST['password'];

  }else {
    $input_value_password = $_POST['password'];
    $success_input_class_password = 'is-valid';
    $success_message_password     = "<div class=\"valid-feedback\"><i>Great! Now you need to confirm it...</i></div>";

  }

  if (empty($_POST['confirm_password'])) {
    $error_message_confirm_password     = "<div class=\"invalid-feedback\"><i>You must fill the required field...</i></div>";
    $error_input_class_confirm_password = 'is-invalid';
    $input_value_confirm_password       = $_POST['confirm_password'];

  } elseif ($_POST['password'] != $_POST['confirm_password']) {
    $input_value_confirm_password       = $_POST['confirm_password'];
    $error_input_class_confirm_password = 'is-invalid';
    $error_message_confirm_password     = "<div class=\"invalid-feedback\"><i>Passwords must match... Try again!</i></div>";

  } else {
    $input_value_confirm_password = $_POST['confirm_password'];
    $success_input_class_confirm_password  = 'is-valid';
    $success_message_confirm_password      = "<div class=\"valid-feedback\"><i>Password confirmed!</i></div>";
    

  }

 }

?>