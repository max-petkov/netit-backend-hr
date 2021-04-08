<?php
include_once 'functions.php';

if (isset($_POST['check_existing_username'])) {
  if (
    checking_existing_username_email('tb_job_seeker_profile', 'username', $_POST['check_existing_username']) ||
    checking_existing_username_email('tb_company_profile', 'username', $_POST['check_existing_username']) ||
    checking_existing_username_email('tb_hr', 'username', $_POST['check_existing_username'])
  ) {
    echo 'username is taken ';
  }
}
if (isset($_POST['check_existing_email'])) {
  if (
    checking_existing_username_email('tb_job_seeker_profile', 'email', $_POST['check_existing_email']) ||
    checking_existing_username_email('tb_company_profile', 'email', $_POST['check_existing_email']) ||
    checking_existing_username_email('tb_hr', 'email', $_POST['check_existing_email'])
  ) {
    echo 'email is taken';
  }
}
