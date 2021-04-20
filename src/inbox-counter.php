<?php 
// include 'database.php';

  if (isset($_POST['inbox_job_seeker_counter'])) {
    $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
    $sql = ("UPDATE tb_msg_box_job_seeker SET is_viewed=:is_viewed WHERE job_seeker_id='{$_SESSION['employee_id']}'");
    $stmt = $db->prepare($sql);
    $stmt->bindValue('is_viewed', $_POST['inbox_job_seeker_counter']);
    $stmt->execute();
  }

  if (isset($_POST['inbox_hr_counter'])) {
    $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
    $sql = ("UPDATE tb_msg_box_hr SET is_viewed=:is_viewed WHERE hr_id='{$_SESSION['hr_id']}'");
    $stmt = $db->prepare($sql);
    $stmt->bindValue('is_viewed', $_POST['inbox_hr_counter']);
    $stmt->execute();
  }

  if (isset($_POST['inbox_company_counter'])) {
    $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
    $sql = ("UPDATE tb_msg_box_company SET is_viewed=:is_viewed WHERE company_id='{$_SESSION['company_id']}'");
    $stmt = $db->prepare($sql);
    $stmt->bindValue('is_viewed', $_POST['inbox_company_counter']);
    $stmt->execute();
  }

?>