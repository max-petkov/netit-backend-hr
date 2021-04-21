<?php
include_once 'functions.php';
include_once 'Validator.php';
include_once 'Profile.php';
session_start();

// Create job seeker profile
if (isset($_POST['register_employee'])) {
  $check = new Validator($_POST);
  $check->validate_username();
  $check->validate_name();
  $check->validate_last_name();
  $check->validate_email();
  $check->validate_password();
  $check->validate_confirm_password();

  if ($check->is_valid()) {
    $proceed = new Profile($_POST);
    $proceed->create_profile();
  }
}

// Create company profile
if (isset($_POST['register_company'])) {
  $check = new Validator($_POST);
  $check->validate_username();
  $check->validate_name();
  $check->validate_email();
  $check->validate_branches();
  $check->validate_description();
  $check->validate_password();
  $check->validate_confirm_password();

  if ($check->is_valid()) {
    $proceed = new Profile($_POST);
    $proceed->create_profile();
  }
}
