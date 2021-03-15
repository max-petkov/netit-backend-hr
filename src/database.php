<?php

session_start();

$host     = 'localhost';
$user     = 'root';
$database = 'registered_users';
$password = '';

$database_connection = mysqli_connect($host, $user, $password, $database);

if (!$database_connection) {
  die("Connection failed!:" . mysqli_connect_error());

} else {
  echo "SUCCESSFUL CONNECTION!";

}



if (isset($_POST['submit_registration'])) {

  if (!empty($_POST['employee_username'])                                                                     && 
      preg_match('/^[a-zA-Z0-9\p{Cyrillic}-]+$/u', $_POST['employee_username']) &&
      !empty($_POST['first_name'])                                                                            && 
      preg_match('/^[a-zA-Z\p{Cyrillic}]+$/', $_POST['first_name'])                                                   && 
      !empty($_POST['last_name'])                                                                             && 
      preg_match('/^[a-zA-Z\p{Cyrillic}]+$/', $_POST['last_name'])                                                    &&
      !empty($_POST['email'])                                                                                 && 
      filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)                                                      &&
      !empty($_POST['password'])                                                                              && 
      preg_match('/^[a-zA-Z0-9\p{Cyrillic}-]+$/u', $_POST['password'])          && 
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
      !checking_existing_username_email('employees', 'username', $_POST['employee_username'])                 && 
      !checking_existing_username_email('companies', 'username', $_POST['employee_username'])                 && 
      !checking_existing_username_email('employees', 'email', $_POST['email'])                                && 
      !checking_existing_username_email('companies', 'email', $_POST['email'])) {
      
      $stmt = $database_connection->prepare('INSERT INTO employees(username, first_name, last_name, email, password) VALUES(?, ?, ?, ?, ?)');
      $stmt->bind_param('sssss', $username, $first_name, $last_name, $email, $password);

      $username   = $_POST['employee_username'];
      $first_name = $_POST['first_name'];
      $last_name  = $_POST['last_name'];
      $email      = $_POST['email'];
      $password   = $_POST['password'];

      $stmt->execute();
      $stmt->close();

      $_SESSION['success_message'] = 'Your account has been created successfully!';
      header('location: registration-form-employee.php');
      exit;
      
  }

  

}


if (isset($_POST['submit_registration_company'])) {

  if (!empty($_POST['company_username'])                                                             && 
      preg_match('/^[a-zA-Z0-9\p{Cyrillic}-]+$/u', $_POST['company_username'])                      &&
      !empty($_POST['company_name'])                                                                 && 
      preg_match('/^[a-zA-Z0-9\p{Cyrillic}- ]+$/u', $_POST['company_name'])                         &&
      !empty($_POST['email'])                                                                        && 
      filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)                                             &&
      !empty($_POST['company_description'])                                                          && 
      preg_match('/^[a-zA-Z0-9\p{Cyrillic}\-\'!.; ]+$/u', $_POST['company_description'])             &&
      !empty($_POST['it_branch'])                                                                    && 
      !empty($_POST['password'])                                                                     && 
      preg_match('/^[a-zA-Z0-9\p{Cyrillic}-]+$/u', $_POST['password'])                              &&
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
      !checking_existing_username_email('companies', 'username', $_POST['company_username'])         && 
      !checking_existing_username_email('employees', 'username', $_POST['company_username'])         &&
      !checking_existing_username_email('companies', 'email', $_POST['email'])                       && 
      !checking_existing_username_email('employees', 'email', $_POST['email'])) {

        $company_username    = $_POST['company_username'];
        $company_name        = $_POST['company_name'];
        $company_it_branches = $_POST['it_branch'];
        $company_description = $_POST['company_description'];
        $company_email       = $_POST['email'];
        $company_password    = $_POST['password'];

        $sql  = ('INSERT INTO companies(username, company_name, company_it_branches, company_description, email, password) VALUES(?, ?, ?, ?, ?, ?)');
        $stmt = $database_connection->prepare($sql);
        $stmt->bind_param('ssssss', $company_username, $company_name, $company_it_branches, $company_description, $company_email, $company_password);

        $stmt->execute();
        $stmt->close();

        $_SESSION['success_message'] = 'Your account has been created successfully!';
        header('location: registration-form-company.php');
        exit;


  }
}


mysqli_close($database_connection);


?>