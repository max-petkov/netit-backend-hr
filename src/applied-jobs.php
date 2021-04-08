<?php
include 'database.php';

$db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');

$sql = ("SELECT id, random_chars FROM tb_published_jobs WHERE id=:id AND random_chars=:random_chars ");
$stmt = $db->prepare($sql);
$stmt->bindValue(':id', $_POST['job_id']);
$stmt->bindValue(':random_chars', $_POST['random_chars']);
$stmt->execute();

$sql2 = ("SELECT * FROM tb_applied_jobs WHERE job_id=:job_id AND job_seeker_id=:job_seeker_id AND is_applied=:is_applied");
$stmt2 = $db->prepare($sql2);
$stmt2->bindValue(':job_id', $_POST['job_id']);
$stmt2->bindValue(':job_seeker_id', $_POST['job_seeker_id']);
$stmt2->bindValue(':is_applied', $_POST['is_applied']);
$stmt2->execute();

if (
  $stmt->rowCount() === 1 && $stmt2->rowCount() === 0 &&
  $_SESSION['employee_id'] === $_POST['job_seeker_id'] &&
  mb_strlen($_POST['motivation_speech']) >= 49 &&
  mb_strlen($_POST['motivation_speech']) <= 999
) {
  $sql = ("INSERT INTO tb_applied_jobs(job_id, job_seeker_id, is_applied, motivation_speech) VALUES(:job_id, :job_seeker_id, :is_applied, :motivation_speech)");
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':job_id', $_POST['job_id']);
  $stmt->bindValue(':job_seeker_id', $_POST['job_seeker_id']);
  $stmt->bindValue(':is_applied', $_POST['is_applied']);
  $stmt->bindValue(':motivation_speech', $_POST['motivation_speech']);
  $stmt->execute();
} else {
  echo 'Scammer... Don\'t change input values!';
}
