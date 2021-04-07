<?php
include_once 'functions.php';


session_start();

$host     = 'localhost';
$user     = 'root';
$db = 'monster_hr_db';
$password = '';

$db_connection = mysqli_connect($host, $user, $password, $db);

if (!$db_connection) {
  die("Connection failed!:" . mysqli_connect_error());
} else {
  // echo "SUCCESSFUL CONNECTION!";

}

if (isset($_POST['submit_registration'])) {

  if (
    !empty($_POST['employee_username'])                                                                     &&
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
    !checking_existing_username_email('tb_job_seeker_profile', 'username', $_POST['employee_username'])              &&
    !checking_existing_username_email('tb_company_profile', 'username', $_POST['employee_username'])              &&
    !checking_existing_username_email('tb_job_seeker_profile', 'email', $_POST['email'])                             &&
    !checking_existing_username_email('tb_company_profile', 'email', $_POST['email'])
  ) {

    $stmt = $db_connection->prepare('INSERT INTO tb_job_seeker_profile(username, first_name, last_name, email, password) VALUES(?, ?, ?, ?, ?)');
    $stmt->bind_param('sssss', $username, $first_name, $last_name, $email, $password);

    $username   = $_POST['employee_username'];
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $email      = $_POST['email'];
    $password   = $_POST['password'];

    $stmt->execute();
    $stmt->close();

    $_SESSION['success_message'] = 'Your account has been created successfully!';
    redirect_to('login.php');
  }
}


if (isset($_POST['submit_registration_company'])) {
  if (
    !empty($_POST['company_username'])                                                             &&
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
    mb_strlen($_POST['company_description']) <= 999                                                &&
    mb_strlen($_POST['password'])            >= 4                                                  &&
    mb_strlen($_POST['password'])            <= 49                                                 &&
    !checking_existing_username_email('tb_company_profile', 'username', $_POST['company_username'])      &&
    !checking_existing_username_email('tb_job_seeker_profile', 'username', $_POST['company_username'])      &&
    !checking_existing_username_email('tb_company_profile', 'email', $_POST['email'])                    &&
    !checking_existing_username_email('tb_job_seeker_profile', 'email', $_POST['email'])
  ) {

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

    $sql  = ('INSERT INTO tb_company_profile(username, company_name, frontend_branch, backend_branch, fullstack_branch, qa_branch, mobdev_branch, ux_ui_branch , company_description, email, password) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt = $db_connection->prepare($sql);
    $stmt->bind_param('sssssssssss', $company_username, $company_name, $frontend_branch, $backend_branch, $fullstack_branch, $qa_branch, $mobdev_branch, $ux_ui_branch, $company_description, $company_email, $company_password);

    $stmt->execute();
    $stmt->close();

    $_SESSION['success_message'] = 'Your account has been created successfully!';
    redirect_to('login.php');
  }
}

// Insert HR into DB
if (isset($_POST['hr_username'])) {
  if (
    !empty($_POST['hr_username'])                                                             &&
    preg_match('/^[a-zA-Z0-9\p{Cyrillic}\-]+$/u', $_POST['hr_username'])                      &&                                                                          
    !empty($_POST['hr_email'])                                                                        &&
    filter_var($_POST['hr_email'], FILTER_VALIDATE_EMAIL)                                            &&
    !empty($_POST['hr_password'])                                                                     &&
    preg_match('/^[a-zA-Z0-9-]+$/u', $_POST['hr_password'])                              &&
    !empty($_POST['hr_confirm_password'])                                                             &&
    $_POST['hr_password'] == $_POST['hr_confirm_password']                                               &&
    mb_strlen($_POST['hr_username'])    >= 4                                                  &&
    mb_strlen($_POST['hr_username'])    <= 49                                                 &&
    mb_strlen($_POST['hr_email'])       <= 254                                                &&
    mb_strlen($_POST['hr_password'])            >= 4                                                  &&
    mb_strlen($_POST['hr_password'])            <= 49                                                 &&
    !checking_existing_username_email('tb_company_profile', 'username', $_POST['hr_username'])      &&
    !checking_existing_username_email('tb_job_seeker_profile', 'username', $_POST['hr_username'])      &&
    !checking_existing_username_email('tb_company_profile', 'email', $_POST['hr_email'])                    &&
    !checking_existing_username_email('tb_job_seeker_profile', 'email', $_POST['hr_email'])
  ) {

    $hr_username    = $_POST['hr_username'];
    $hr_email      = $_POST['hr_email'];
    $hr_password    = $_POST['hr_password'];

    $sql  = ('INSERT INTO tb_hr(company_id, username, email, password) VALUES(?, ?, ?, ?)');
    $stmt = $db_connection->prepare($sql);
    $stmt->bind_param('ssss', $_SESSION['company_id'], $hr_username, $hr_email, $hr_password);
    $stmt->execute();
    $stmt->close();

  }
}

if (isset($_POST['submit_login'])) {

  if (empty($_POST['username']) && empty($_POST['password'])) {
    $_SESSION['error_message'] = 'All fields must be filled out!';
    header('location: login.php');
    exit;
  } elseif (
    login_attempt('tb_company_profile', 'username', 'password', $_POST['username'], $_POST['password']) ||
    login_attempt('tb_job_seeker_profile', 'username', 'password', $_POST['username'], $_POST['password'])
  ) {
    if (login_attempt('tb_job_seeker_profile', 'username', 'password', $_POST['username'], $_POST['password']) == true) {
      $_SESSION['employee_id'] = login_attempt('tb_job_seeker_profile', 'username', 'password', $_POST['username'], $_POST['password'])['id'];
      redirect_to('employee-dashboard.php');
    } else {
      $_SESSION['company_id'] = login_attempt('tb_company_profile', 'username', 'password', $_POST['username'], $_POST['password'])['id'];
      redirect_to('company-dashboard.php');
    }
  } else {
    $_SESSION['error_message'] = 'Incorrect username or password... Try again!';
    redirect_to('login.php');
  }
}


mysqli_close($db_connection);

// Update job_seeker profile via ajax
if (isset($_POST['first_name'])) {

  if (
    mb_strlen($_POST['first_name']) > 4                                                                                      &&
    mb_strlen($_POST['first_name']) < 49                                                                                         &&
    preg_match('/^[a-zA-Z\p{Cyrillic}]+$/u', $_POST['first_name'])                                                               &&
    !empty($_POST['first_name'])                                                                                                 &&
    mb_strlen($_POST['last_name']) > 4                                                                                           &&
    mb_strlen($_POST['last_name']) < 49                                                                                          &&
    preg_match('/^[a-zA-Z\p{Cyrillic}]+$/u', $_POST['last_name'])                                                                &&
    !empty($_POST['last_name'])                                                                                                  &&
    mb_strlen($_POST['address']) < 49                                                                                            &&
    preg_match('/^[a-zA-Z0-9-,\'. \p{Cyrillic}]+$/u', $_POST['address'])                                                         &&
    !empty($_POST['address'])                                                                                                    &&
    mb_strlen($_POST['website']) < 49                                                                                            &&
    preg_match('/(-)|(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/', $_POST['website']) &&
    !empty($_POST['website'])                                                                                                    &&
    mb_strlen($_POST['short_introduction']) > 49                                                                                 &&
    mb_strlen($_POST['short_introduction']) < 999                                                                                &&
    !empty($_POST['short_introduction'])
  ) {

    $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
    $sql = ("UPDATE tb_job_seeker_profile SET first_name=:first_name, last_name=:last_name, address=:address, website=:website, short_introduction=:short_introduction WHERE id='{$_SESSION['employee_id']}'");
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':first_name', $_POST['first_name']);
    $stmt->bindValue(':last_name', $_POST['last_name']);
    $stmt->bindValue(':address', $_POST['address']);
    $stmt->bindValue(':website', $_POST['website']);
    $stmt->bindValue(':short_introduction', $_POST['short_introduction']);

    $stmt->execute();

    $json_data['first_name']         = $_POST['first_name'];
    $json_data['last_name']          = $_POST['last_name'];
    $json_data['address']            = $_POST['address'];
    $json_data['website']            = $_POST['website'];
    $json_data['short_introduction'] = $_POST['short_introduction'];

    echo json_encode($json_data);
  }
}

// Delete job application
if (isset($_POST['cancel_job_id'])) {
  $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
  $sql = ("DELETE FROM tb_applied_jobs WHERE applied_id='{$_POST['applied_id']}' AND job_seeker_id='{$_SESSION['employee_id']}'");
  $stmt = $db->query($sql);
  $stmt->execute();
  echo 'Successful delete!';
}

// Update company profile via ajax
if (isset($_POST['company_name'])) {
  if (
    mb_strlen($_POST['company_name']) > 4                                                                                       ||
    mb_strlen($_POST['company_name']) < 254                                                                                          ||
    preg_match('/^[a-zA-Z0-9- \p{Cyrillic}]+$/u', $_POST['company_name'])                                                               ||
    !empty($_POST['company_name'])                                                                                                   ||
    mb_strlen($_POST['slogan']) < 49                                                                                           ||
    mb_strlen($_POST['address']) < 49                                                                                             ||
    preg_match('/^[a-zA-Z0-9-,\'. \p{Cyrillic}]+$/u', $_POST['address'])                                                         ||
    !empty($_POST['address'])                                                                                                      ||
    mb_strlen($_POST['website']) < 49                                                                                             ||
    preg_match('/(-)|(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/', $_POST['website']) ||
    !empty($_POST['website'])                                                                                                      ||
    mb_strlen($_POST['company_description']) > 49                                                                                  ||
    mb_strlen($_POST['company_description']) < 999                                                                                 ||
    empty($_POST['company_description']) ||
    preg_match('/^[a-zA-Z0-9-\'!.,; \p{Cyrillic}]+$/u', $_POST['company_description']) ||
    mb_strlen($_POST['company_history']) < 999 ||
    mb_strlen($_POST['company_mission']) < 999
  ) {
    $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
    $sql = ("UPDATE tb_company_profile SET company_name=:company_name, slogan=:slogan, address=:address, website=:website, company_description=:company_description, company_history=:company_history, company_mission=:company_mission, frontend_branch=:frontend_branch, backend_branch=:backend_branch, fullstack_branch=:fullstack_branch, qa_branch=:qa_branch, mobdev_branch=:mobdev_branch, ux_ui_branch=:ux_ui_branch WHERE id='{$_SESSION['company_id']}'");
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':company_name', $_POST['company_name']);
    $stmt->bindValue(':slogan', $_POST['slogan']);
    $stmt->bindValue(':address', $_POST['address']);
    $stmt->bindValue(':website', $_POST['website']);
    $stmt->bindValue(':company_description', $_POST['company_description']);
    $stmt->bindValue(':company_history', $_POST['company_history']);
    $stmt->bindValue(':company_mission', $_POST['company_mission']);
    $stmt->bindValue(':frontend_branch', $_POST['frontend_branch']);
    $stmt->bindValue(':backend_branch', $_POST['backend_branch']);
    $stmt->bindValue(':fullstack_branch', $_POST['fullstack_branch']);
    $stmt->bindValue(':qa_branch', $_POST['qa_branch']);
    $stmt->bindValue(':mobdev_branch', $_POST['mobdev_branch']);
    $stmt->bindValue(':ux_ui_branch', $_POST['ux_ui_branch']);

    $stmt->execute();

    $json_data['company_name']         = $_POST['company_name'];
    $json_data['slogan']          = $_POST['slogan'];
    $json_data['address']            = $_POST['address'];
    $json_data['website']            = $_POST['website'];
    $json_data['company_description'] = $_POST['company_description'];
    $json_data['company_history'] = $_POST['company_history'];
    $json_data['company_mission'] = $_POST['company_mission'];
    $json_data['frontend_branch'] = $_POST['frontend_branch'];
    $json_data['backend_branch'] = $_POST['backend_branch'];
    $json_data['fullstack_branch'] = $_POST['fullstack_branch'];
    $json_data['qa_branch'] = $_POST['qa_branch'];
    $json_data['mobdev_branch'] = $_POST['mobdev_branch'];
    $json_data['ux_ui_branch'] = $_POST['ux_ui_branch'];

    echo json_encode($json_data);
  }
}

// Make published job in-active
if (isset($_POST['published_job_id'])) {
  $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
  $sql = ("UPDATE tb_published_jobs SET is_active=:is_active WHERE company_id='{$_SESSION['company_id']}' AND id='{$_POST['published_job_id']}'");
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':is_active', $_POST['is_active']);
  $stmt->execute();
  echo 'Job is in-active!';
}

// Activate published job
if (isset($_POST['activate_published_job_id'])) {
  $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
  $sql = ("UPDATE tb_published_jobs SET is_active=:is_active, published_date=:published_date WHERE company_id='{$_SESSION['company_id']}' AND id='{$_POST['activate_published_job_id']}'");
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':is_active', $_POST['is_active']);
  $stmt->bindValue(':published_date', $_POST['published_date']);
  $stmt->execute();
  echo 'Activate successful!';
}

// Update published job
if (isset($_POST['update_publish_job_submit'])) {
  if (
    mb_strlen($_POST['job_title']) > 20 &&
    mb_strlen($_POST['job_title']) < 254 &&
    // TODO ADDING !EMPTY IT_TAG AND JOB_TIME
    !preg_match('/[a-zA-Z)(*&^%$#@!)]/', $_POST['job_salary']) &&
    !empty($_POST['salary_currency']) &&
    !empty($_POST['salary_month_year']) &&
    mb_strlen($_POST['job_description']) > 49 &&
    mb_strlen($_POST['job_description']) < 999
  ) {

    $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
    $sql = ("UPDATE tb_published_jobs SET published_date=:published_date, job_title=:job_title, job_time=:job_time, frontend_tag=:frontend_tag, backend_tag=:backend_tag, fullstack_tag=:fullstack_tag, qa_tag=:qa_tag, mobdev_tag=:mobdev_tag, ux_ui_tag=:ux_ui_tag, job_salary=:job_salary, job_description=:job_description WHERE company_id='{$_SESSION['company_id']}' AND id='{$_POST['update_publish_job_submit']}'");

    $published_date = date('Y-m-d');
    $job_title = $_POST['job_title'];
    $job_time = $_POST['job_fulltime'] . ' ' . $_POST['job_part_time'];
    $frontend_tag = $_POST['frontend_tag'];
    $backend_tag = $_POST['backend_tag'];
    $fullstack_tag = $_POST['fullstack_tag'];
    $qa_tag = $_POST['qa_tag'];
    $mobdev_tag = $_POST['mobdev_tag'];
    $ux_ui_tag = $_POST['ux_ui_tag'];
    $job_salary = $_POST['job_salary'] . $_POST['salary_currency'] . ' ' . $_POST['salary_month_year'];
    $job_description = $_POST['job_description'];

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':published_date', $published_date);
    $stmt->bindValue(':job_title', $job_title);
    $stmt->bindValue(':job_time', $job_time);
    $stmt->bindValue(':frontend_tag', $frontend_tag);
    $stmt->bindValue(':backend_tag', $backend_tag);
    $stmt->bindValue(':fullstack_tag', $fullstack_tag);
    $stmt->bindValue(':qa_tag', $qa_tag);
    $stmt->bindValue(':mobdev_tag', $mobdev_tag);
    $stmt->bindValue(':ux_ui_tag', $ux_ui_tag);
    $stmt->bindValue(':job_salary', $job_salary);
    $stmt->bindValue(':job_description', $job_description);
    $stmt->execute();

    echo 'Update Successful!';
  }
}

// Delete Published job
if (isset($_POST['delete_published_job_id'])) {
  $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
  $sql = ("DELETE FROM tb_published_jobs WHERE id='{$_POST['delete_published_job_id']}' AND company_id='{$_SESSION['company_id']}'");
  $stmt = $db->query($sql);
  $stmt->execute();
  echo 'Successful delete!';
}
