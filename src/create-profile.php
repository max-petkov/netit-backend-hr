<?php
include_once 'functions.php';
include_once 'Validator.php';
include_once 'Profile.php';
session_start();

// Create job seeker profile
if (isset($_POST['register_employee'])) {
  $validator = new Validator($_POST);
  $validator->validate_username();
  $validator->validate_name();
  $validator->validate_last_name();
  $validator->validate_email();
  $validator->validate_password();
  $validator->validate_confirm_password();

  if ($validator->is_valid()) {
    $profile = new Profile($_POST);
    $profile->create_profile();
  }
}

// Create company profile
if (isset($_POST['register_company'])) {
  $validator = new Validator($_POST);
  $validator->validate_username();
  $validator->validate_name();
  $validator->validate_email();
  $validator->validate_branches();
  $validator->validate_description();
  $validator->validate_password();
  $validator->validate_confirm_password();

  if ($validator->is_valid()) {
    $profile = new Profile($_POST);
    $profile->create_profile();
  }
}
