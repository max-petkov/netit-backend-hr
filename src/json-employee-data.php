<?php 
include 'database.php';
if (isset($_SESSION['employee_id'])) {
  
  $db = new PDO("mysql:host=localhost;dbname=registered_users", "root", '');
  $sql = ("SELECT id, username, first_name, last_name, email FROM tb_employees WHERE id={$_SESSION['employee_id']}");
  $result = $db->query($sql)->fetch();
  
  while ($row = $result) {
    $data['username'] = $row['username']; 
    $data['first_name'] = $row['first_name']; 
    $data['last_name'] = $row['last_name']; 
    $data['email'] = $row['email']; 
    break;
  }

  echo json_encode($data);
  
  
}

?>