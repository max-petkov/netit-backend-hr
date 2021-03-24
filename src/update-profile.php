<?php 
include 'database.php';

$db = new PDO("mysql:host=localhost;dbname=registered_users", "root", '');

//ТОDO Да добавя останалите променливи
$sql = ("UPDATE tb_employees SET first_name='{$_POST['first_name']}', address='{$_POST['address']}' WHERE id='{$_SESSION['employee_id']}'");
$stmt = $db->prepare($sql);
$stmt->execute();
$result = $stmt->execute();

if ($result === true) {
  $data['address'] = $_POST['address'];
  $data['first_name'] = $_POST['first_name'];
  
}
echo json_encode($data);

?>