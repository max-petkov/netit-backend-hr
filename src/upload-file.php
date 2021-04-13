<?php 
include 'database.php';
if(isset($_SESSION['company_id'])){
  $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
  $file_name = $_FILES['img_file']['name']; 
  $file_type = $_FILES['img_file']['type']; 
  $file_size = $_FILES['img_file']['size'];
  $file_data = file_get_contents($_FILES['img_file']['tmp_name']);
  $sql = ("UPDATE tb_company_profile SET file_name=:file_name, file_mime=:file_type, file_size=:file_size, file_data=:file_data WHERE id='{$_SESSION['company_id']}'");
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':file_name', $file_name);
  $stmt->bindValue(':file_type', $file_type);
  $stmt->bindValue(':file_size', $file_size);
  $stmt->bindValue(':file_data', $file_data);
  $stmt->execute();

  echo 'Successfully uploaded!';
}

?>