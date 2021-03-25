<?php 
include 'database.php';
include_once 'functions.php';

$db = new PDO("mysql:host=localhost;dbname=registered_users", "root", '');
// $sql = ("UPDATE tb_employees SET first_name='{$_POST['first_name']}', last_name='{$_POST['last_name']}', address='{$_POST['address']}', website='{$_POST['website']}', short_introduction='{$_POST['short_introduction']}' WHERE id='{$_SESSION['employee_id']}'");
$sql = ("UPDATE tb_employees SET first_name=:first_name, last_name=:last_name, address=:address, website=:website, short_introduction=:short_introduction WHERE id='{$_SESSION['employee_id']}'");



$stmt = $db->prepare($sql);
$stmt->bindValue(':first_name', $_POST['first_name']);
$stmt->bindValue(':last_name', $_POST['last_name']);
$stmt->bindValue(':address', $_POST['address']);
$stmt->bindValue(':website', $_POST['website']);
$stmt->bindValue(':short_introduction', $_POST['short_introduction']);

$stmt->execute();


// ТОДО Всяко самостоятелно да се ъпдейтва, да направя валидацията 
if (mb_strlen($_POST['first_name']) < 4                         ||  
mb_strlen($_POST['first_name']) > 49                            || 
!preg_match('/^[a-zA-Z\p{Cyrillic}]+$/u', $_POST['first_name']) ||
empty($_POST['first_name'])) {
  return false;

} else {
  


}

if (mb_strlen($_POST['last_name']) < 4                         ||  
mb_strlen($_POST['last_name']) > 49                            || 
!preg_match('/^[a-zA-Z\p{Cyrillic}]+$/u', $_POST['last_name']) ||
empty($_POST['last_name'])) {
  return false;
} else {
  
  


}







?>