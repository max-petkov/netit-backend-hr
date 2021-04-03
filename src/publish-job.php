<?php 
// Publish job
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
if (mb_strlen($_POST['job_title']) > 20 &&
      mb_strlen($_POST['job_title']) < 254 &&
  // TODO ADDING !EMPTY IT_TAG AND JOB_TIME
      !preg_match('/[a-zA-Z)(*&^%$#@!)]/', $_POST['job_salary']) &&
      !empty($_POST['salary_currency']) &&
      !empty($_POST['salary_month_year']) &&
      mb_strlen($_POST['job_description']) > 49 &&
      mb_strlen($_POST['job_description']) < 999) {

        $published_date = date('m.d.Y');
        $company_id = $_POST['job_company_id'];
        $company_username = $_POST['job_company_username'];
        $company_name = $_POST['job_company_name'];
        $company_email = $_POST['job_company_email'];
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
        $random_chars =  bin2hex(random_bytes(16));

        $sql  = ('INSERT INTO tb_published_jobs(published_date, company_id, company_username, company_name, company_email, job_title, job_time, frontend_tag, backend_tag , fullstack_tag, qa_tag, mobdev_tag, ux_ui_tag, job_salary, job_description, random_chars) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt = $db_connection->prepare($sql);
        $stmt->bind_param('ssssssssssssssss', $published_date, $company_id, $company_username, $company_name, $company_email, $job_title, $job_time, $frontend_tag, $backend_tag, $fullstack_tag, $qa_tag, $mobdev_tag, $ux_ui_tag, $job_salary, $job_description, $random_chars);
        $stmt->execute();
        
        
  }  else {
    echo 'error';
  }




?>