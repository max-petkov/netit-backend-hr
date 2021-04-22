<?php
session_start();
include_once 'Jobs.php';
include_once 'Validator.php';

if (isset($_POST['publish_job'])) {
  $check = new Validator($_POST);
  $check->validate_job_title();
  $check->validate_branches();
  $check->validate_work_time();
  $check->validate_salary();
  $check->validate_currency();
  $check->validate_month_year_salary();
  $check->validate_job_description();

  if ($check->is_valid()) {
    $proceed = new Job($_POST);
    $proceed->publish_job();
  }
}

if (isset($_POST['set_inactive'])) {
  $proceed = new Job($_POST);
  $proceed->set_job_inactive();
}

if (isset($_POST['set_active'])) {
  $proceed = new Job($_POST);
  $proceed->set_job_active();
}

if (isset($_POST['delete_job'])) {
  $proceed = new Job($_POST);
  $proceed->delete_job();
}

if (isset($_POST['apply_job'])) {
  $check = new Validator($_POST);
  $check->validate_motivation_speech();
  $check->validate_hidden_fields();

  if ($check->is_valid()) {
    $proceed = new Job($_POST);
    $proceed->apply_job();
  }
}

if (isset($_POST['cancel_application'])) {
  $proceed = new Job($_POST);
  $proceed->cancel_application();
}
