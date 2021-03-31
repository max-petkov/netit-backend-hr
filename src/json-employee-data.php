<?php 
include 'database.php';
if (isset($_SESSION['employee_id'])) {
   
  $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
  $sql = ("SELECT id, username, first_name, last_name, email, website, short_introduction, address FROM tb_job_seeker_profile WHERE id={$_SESSION['employee_id']}");
  $stmt = $db->query($sql);
  $stmt->execute();

  while ($row = $stmt->fetch()) {
    $data['id']                 = $row['id']; 
    $data['username']           = $row['username']; 
    $data['first_name']         = $row['first_name']; 
    $data['last_name']          = $row['last_name']; 
    $data['email']              = $row['email'];
    $data['website']            = $row['website'];
    $data['short_introduction'] = $row['short_introduction']; 
    $data['address']            = $row['address'];
    
  }

  echo json_encode($data);
  
  
}

?>