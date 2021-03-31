<?php 
$db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
$sql = ("INSERT INTO tb_applied_jobs(job_id, job_seeker_id) VALUES(:job_id, :job_seeker_id)"); 
$stmt = $db->prepare($sql);
$stmt->bindValue(':job_id', $_POST['job_id']);
$stmt->bindValue(':job_seeker_id', $_POST['job_seeker_id']);
$stmt->execute();

?>