<?php 
include 'database.php';


if (mb_strlen($_POST['first_name']) < 4                                                                                   ||  
mb_strlen($_POST['first_name']) > 49                                                                                      || 
!preg_match('/^[a-zA-Z\p{Cyrillic}]+$/u', $_POST['first_name'])                                                           ||
empty($_POST['first_name'])                                                                                               ||  
mb_strlen($_POST['last_name']) < 4                                                                                        ||                       
mb_strlen($_POST['last_name']) > 49                                                                                       || 
!preg_match('/^[a-zA-Z\p{Cyrillic}]+$/u', $_POST['last_name'])                                                            ||
empty($_POST['last_name'])                                                                                                ||
mb_strlen($_POST['address']) > 49                                                                                         ||
!preg_match('/^[a-zA-Z0-9-,\' \p{Cyrillic}]+$/u', $_POST['address'])                                                      ||
empty($_POST['address'])                                                                                                  ||
mb_strlen($_POST['website']) > 49                                                                                         || 
!preg_match('/(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/', $_POST['website']) || 
!preg_match('/[-{1}]/', $_POST['website'])                                                                                ||
empty($_POST['website'])                                                                                                  || 
mb_strlen($_POST['short_introduction']) < 49                                                                              ||
mb_strlen($_POST['short_introduction']) > 500                                                                             ||
empty($_POST['short_introduction'])) {

  return true;

} else {
  $db = new PDO("mysql:host=localhost;dbname=registered_users", "root", '');
  $sql = ("UPDATE tb_employees SET first_name=:first_name, last_name=:last_name, address=:address, website=:website, short_introduction=:short_introduction WHERE id='{$_SESSION['employee_id']}'");
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':first_name', $_POST['first_name']);
  $stmt->bindValue(':last_name', $_POST['last_name']);
  $stmt->bindValue(':address', $_POST['address']);
  $stmt->bindValue(':website', $_POST['website']);
  $stmt->bindValue(':short_introduction', $_POST['short_introduction']);

  $stmt->execute();
  
  $json_data['first_name']         = $_POST['first_name'];
  $json_data['last_name']          = $_POST['last_name'];
  $json_data['address']            = $_POST['address'];
  $json_data['website']            = $_POST['website'];
  $json_data['short_introduction'] = $_POST['short_introduction'];

  echo json_encode($json_data);


}

