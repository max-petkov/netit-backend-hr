<?php
include_once 'functions.php';


session_start();

$host     = 'localhost';
$user     = 'root';
$db = 'registered_users';
$password = '';

$db_connection = mysqli_connect($host, $user, $password, $db);

if (!$db_connection) {
  die("Connection failed!:" . mysqli_connect_error());

} else {
  // echo "SUCCESSFUL CONNECTION!";

}



if (isset($_POST['submit_registration'])) {

  if (!empty($_POST['employee_username'])                                                                     && 
      preg_match('/^[a-zA-Z0-9\p{Cyrillic}\-]+$/u', $_POST['employee_username'])                              &&
      !empty($_POST['first_name'])                                                                            && 
      preg_match('/^[a-zA-Z\p{Cyrillic}]+$/u', $_POST['first_name'])                                          && 
      !empty($_POST['last_name'])                                                                             && 
      preg_match('/^[a-zA-Z\p{Cyrillic}]+$/u', $_POST['last_name'])                                           &&
      !empty($_POST['email'])                                                                                 && 
      filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)                                                      &&
      !empty($_POST['password'])                                                                              && 
      preg_match('/^[a-zA-Z0-9\p{Cyrillic}\-]+$/u', $_POST['password'])                                       && 
      !empty($_POST['confirm_password'])                                                                      && 
      $_POST['password'] == $_POST['confirm_password']                                                        &&
      mb_strlen($_POST['employee_username']) >= 4                                                             && 
      mb_strlen($_POST['employee_username']) <= 49                                                            &&
      mb_strlen($_POST['first_name'])        >= 4                                                             && 
      mb_strlen($_POST['first_name'])        <= 49                                                            &&
      mb_strlen($_POST['last_name'])         >= 4                                                             && 
      mb_strlen($_POST['last_name'])         <= 49                                                            &&
      mb_strlen($_POST['email'])             <= 254                                                           && 
      mb_strlen($_POST['password'])          >= 4                                                             && 
      mb_strlen($_POST['password'])          <= 49                                                            &&
      !checking_existing_username_email('tb_employees', 'username', $_POST['employee_username'])              && 
      !checking_existing_username_email('tb_companies', 'username', $_POST['employee_username'])              && 
      !checking_existing_username_email('tb_employees', 'email', $_POST['email'])                             && 
      !checking_existing_username_email('tb_companies', 'email', $_POST['email'])) {
      
      $stmt = $db_connection->prepare('INSERT INTO tb_employees(username, first_name, last_name, email, password) VALUES(?, ?, ?, ?, ?)');
      $stmt->bind_param('sssss', $username, $first_name, $last_name, $email, $password);

      $username   = $_POST['employee_username'];
      $first_name = $_POST['first_name'];
      $last_name  = $_POST['last_name'];
      $email      = $_POST['email'];
      $password   = $_POST['password'];

      $stmt->execute();
      $stmt->close();

      $_SESSION['success_message'] = 'Your account has been created successfully!';
      redirect_to('registration-form-employee.php');
      
  }
}


if (isset($_POST['submit_registration_company'])) {

  if (!empty($_POST['company_username'])                                                             && 
      preg_match('/^[a-zA-Z0-9\p{Cyrillic}\-]+$/u', $_POST['company_username'])                      &&
      !empty($_POST['company_name'])                                                                 && 
      preg_match('/^[a-zA-Z0-9\p{Cyrillic}\- ]+$/u', $_POST['company_name'])                         &&
      !empty($_POST['email'])                                                                        && 
      filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)                                             &&
      !empty($_POST['company_description'])                                                          && 
      preg_match('/^[a-zA-Z0-9\p{Cyrillic}\-\'!.,; ]+$/u', $_POST['company_description'])            &&
      !empty($_POST['it_branch'])                                                                    && 
      !empty($_POST['password'])                                                                     && 
      preg_match('/^[a-zA-Z0-9\p{Cyrillic}\-]+$/u', $_POST['password'])                              &&
      !empty($_POST['confirm_password'])                                                             && 
      $_POST['password'] == $_POST['confirm_password']                                               && 
      mb_strlen($_POST['company_username'])    >= 4                                                  && 
      mb_strlen($_POST['company_username'])    <= 49                                                 &&
      mb_strlen($_POST['company_name'])        >= 4                                                  && 
      mb_strlen($_POST['company_name'])        <= 254                                                && 
      mb_strlen($_POST['email'])               <= 254                                                && 
      mb_strlen($_POST['company_description']) >= 49                                                 && 
      mb_strlen($_POST['company_description']) <= 499                                                && 
      mb_strlen($_POST['password'])            >= 4                                                  && 
      mb_strlen($_POST['password'])            <= 49                                                 &&
      !checking_existing_username_email('tb_companies', 'username', $_POST['company_username'])      && 
      !checking_existing_username_email('tb_employees', 'username', $_POST['company_username'])      &&
      !checking_existing_username_email('tb_companies', 'email', $_POST['email'])                    && 
      !checking_existing_username_email('tb_employees', 'email', $_POST['email'])) {

        $company_username    = $_POST['company_username'];
        $company_name        = $_POST['company_name'];
        $frontend_branch     = $_POST['it_branch'][0];
        $backend_branch      = $_POST['it_branch'][1];
        $fullstack_branch    = $_POST['it_branch'][2];
        $qa_branch           = $_POST['it_branch'][3];
        $mobdev_branch       = $_POST['it_branch'][4];
        $ux_ui_branch        = $_POST['it_branch'][5];
        $company_description = $_POST['company_description'];
        $company_email       = $_POST['email'];
        $company_password    = $_POST['password'];

        $sql  = ('INSERT INTO tb_companies(username, company_name, frontend_branch, backend_branch, fullstack_branch, qa_branch, mobdev_branch, ux_ui_branch , company_description, email, password) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt = $db_connection->prepare($sql);
        $stmt->bind_param('sssssssssss', $company_username, $company_name, $frontend_branch, $backend_branch, $fullstack_branch, $qa_branch, $mobdev_branch, $ux_ui_branch, $company_description, $company_email, $company_password);

        $stmt->execute();
        $stmt->close();

        $_SESSION['success_message'] = 'Your account has been created successfully!';
        redirect_to('registration-form-company.php');
  }
}

if(isset($_POST['submit_login'])) {

  if(empty($_POST['username']) && empty($_POST['password'])) {
  $_SESSION['error_message'] = 'All fields must be filled out!';
  header('location: login.php');
  exit;
  
  } elseif (login_attempt('tb_companies', 'username', 'password', $_POST['username'], $_POST['password']) ||
            login_attempt('tb_employees', 'username', 'password', $_POST['username'], $_POST['password'])) {
    if (login_attempt('tb_employees', 'username', 'password', $_POST['username'], $_POST['password']) == true) {
      $_SESSION['employee_id'] = login_attempt('tb_employees', 'username', 'password', $_POST['username'], $_POST['password'])['id'];
      redirect_to('employee-dashboard.php');
    } else {
      $_SESSION['company_id'] = login_attempt('tb_companies', 'username', 'password', $_POST['username'], $_POST['password'])['id'];
      redirect_to('company-dashboard.php');
    }

  } else {
  $_SESSION['error_message'] = 'Incorrect username or password... Try again!';
  redirect_to('login.php');

  }
    
}
  

mysqli_close($db_connection);


?>