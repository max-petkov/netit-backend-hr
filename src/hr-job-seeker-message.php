<?php 
if (isset($_POST['inbox_msg_job_seeker'])) {
  $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
  // Insert into job seeker input box
  $sql = ("INSERT INTO tb_msg_box_job_seeker(send_date, hr_id, job_seeker_id, subject, inbox_msg) VALUES(:send_date, :hr_id, :job_seeker_id, :subject, :inbox_msg)");
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':send_date', date('Y-m-d'));
  $stmt->bindValue(':hr_id', $_POST['from']);
  $stmt->bindValue(':job_seeker_id', $_POST['to']);
  $stmt->bindValue(':subject', $_POST['subject']);
  $stmt->bindValue(':inbox_msg', $_POST['inbox_msg_job_seeker']);
  $stmt->execute();
  // Insert into HR sent box
  $sql = ("INSERT INTO tb_msg_box_hr(send_date, hr_id, job_seeker_id, subject, sent_msg) VALUES(:send_date, :hr_id, :job_seeker_id, :subject, :sent_msg)");
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':send_date', date('Y-m-d'));
  $stmt->bindValue(':hr_id', $_POST['from']);
  $stmt->bindValue(':job_seeker_id', $_POST['to']);
  $stmt->bindValue(':subject', $_POST['subject']);
  $stmt->bindValue(':sent_msg', $_POST['inbox_msg_job_seeker']);
  $stmt->execute();
}

if (isset($_POST['inbox_msg_hr'])) {
  $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
  // Insert into HR input box 
  $sql = ("INSERT INTO tb_msg_box_hr(send_date, hr_id, job_seeker_id, subject, inbox_msg) VALUES(:send_date, :hr_id, :job_seeker_id, :subject, :inbox_msg)");
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':send_date', date('Y-m-d'));
  $stmt->bindValue(':job_seeker_id', $_POST['from']);
  $stmt->bindValue(':hr_id', $_POST['to']);
  $stmt->bindValue(':subject', $_POST['subject']);
  $stmt->bindValue(':inbox_msg', $_POST['inbox_msg_hr']);
  $stmt->execute();
  // Insert into job seeker sent box
  $sql = ("INSERT INTO tb_msg_box_job_seeker(send_date, hr_id, job_seeker_id, subject, sent_msg) VALUES(:send_date, :hr_id, :job_seeker_id, :subject, :sent_msg)");
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':send_date', date('Y-m-d'));
  $stmt->bindValue(':job_seeker_id', $_POST['from']);
  $stmt->bindValue(':hr_id', $_POST['to']);
  $stmt->bindValue(':subject', $_POST['subject']);
  $stmt->bindValue(':sent_msg', $_POST['inbox_msg_hr']);
  $stmt->execute();
}

?>