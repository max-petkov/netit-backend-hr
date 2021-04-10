<?php
if(isset($_POST['approve_candidate'])){
  $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
  $sql = ("UPDATE tb_applied_jobs SET is_approved=:is_approved WHERE job_seeker_id='{$_POST['job_seeker_id']}' AND job_id='{$_POST['job_id']}'");
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':is_approved', $_POST['approve_candidate']);
  $stmt->execute();
}

if(isset($_POST['reject_candidate'])){
  $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
  $sql = ("UPDATE tb_applied_jobs SET is_approved=:is_approved WHERE job_seeker_id='{$_POST['job_seeker_id']}' AND job_id='{$_POST['job_id']}'");
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':is_approved', $_POST['reject_candidate']);
  $stmt->execute();
}

if(isset($_POST['interviewed_yes'])){
  $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
  $sql = ("UPDATE tb_applied_jobs SET is_interviewed=:is_interviewed WHERE job_seeker_id='{$_POST['job_seeker_id']}' AND job_id='{$_POST['job_id']}'");
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':is_interviewed', $_POST['interviewed_yes']);
  $stmt->execute();
}

if(isset($_POST['interviewed_no'])){
  $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
  $sql = ("UPDATE tb_applied_jobs SET is_interviewed=:is_interviewed WHERE job_seeker_id='{$_POST['job_seeker_id']}' AND job_id='{$_POST['job_id']}'");
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':is_interviewed', $_POST['interviewed_no']);
  $stmt->execute();
}
