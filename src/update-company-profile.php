<?php 
include 'database.php';
 
// Update company profile via ajax
if (mb_strlen($_POST['company_name']) < 4                                                                                       ||  
mb_strlen($_POST['company_name']) > 254                                                                                          || 
!preg_match('/^[a-zA-Z0-9- \p{Cyrillic}]+$/u', $_POST['company_name'])                                                               ||
empty($_POST['company_name'])                                                                                                   ||                       
mb_strlen($_POST['slogan']) > 49                                                                                           || 
mb_strlen($_POST['address']) > 49                                                                                             ||
!preg_match('/^[a-zA-Z0-9-,\'. \p{Cyrillic}]+$/u', $_POST['address'])                                                         ||
empty($_POST['address'])                                                                                                      ||
mb_strlen($_POST['website']) > 49                                                                                             || 
!preg_match('/(-)|(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/', $_POST['website']) || 
empty($_POST['website'])                                                                                                      || 
mb_strlen($_POST['company_description']) < 49                                                                                  ||
mb_strlen($_POST['company_description']) > 499                                                                                 ||
empty($_POST['company_description']) || 
!preg_match('/^[a-zA-Z0-9-\'!.,; \p{Cyrillic}]+$/u', $_POST['company_description']) ||
mb_strlen($_POST['company_history']) > 499 ||
mb_strlen($_POST['company_mission']) > 254) {

  return false;

} else {
  $db = new PDO("mysql:host=localhost;dbname=registered_users", "root", '');
  $sql = ("UPDATE tb_companies SET company_name=:company_name, slogan=:slogan, address=:address, website=:website, company_description=:company_description, company_history=:company_history, company_mission=:company_mission, frontend_branch=:frontend_branch, backend_branch=:backend_branch, fullstack_branch=:fullstack_branch, qa_branch=:qa_branch, mobdev_branch=:mobdev_branch, ux_ui_branch=:ux_ui_branch WHERE id='{$_SESSION['company_id']}'");
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':company_name', $_POST['company_name']);
  $stmt->bindValue(':slogan', $_POST['slogan']);
  $stmt->bindValue(':address', $_POST['address']);
  $stmt->bindValue(':website', $_POST['website']);
  $stmt->bindValue(':company_description', $_POST['company_description']);
  $stmt->bindValue(':company_history', $_POST['company_history']);
  $stmt->bindValue(':company_mission', $_POST['company_mission']);
  $stmt->bindValue(':frontend_branch', $_POST['frontend_branch']);
  $stmt->bindValue(':backend_branch', $_POST['backend_branch']);
  $stmt->bindValue(':fullstack_branch', $_POST['fullstack_branch']);
  $stmt->bindValue(':qa_branch', $_POST['qa_branch']);
  $stmt->bindValue(':mobdev_branch', $_POST['mobdev_branch']);
  $stmt->bindValue(':ux_ui_branch', $_POST['ux_ui_branch']);

  $stmt->execute();
  
  $json_data['company_name']         = $_POST['company_name'];
  $json_data['slogan']          = $_POST['slogan'];
  $json_data['address']            = $_POST['address'];
  $json_data['website']            = $_POST['website'];
  $json_data['company_description'] = $_POST['company_description'];
  $json_data['company_history'] = $_POST['company_history'];
  $json_data['company_mission'] = $_POST['company_mission'];
  $json_data['frontend_branch'] = $_POST['frontend_branch'];
  $json_data['backend_branch'] = $_POST['backend_branch'];
  $json_data['fullstack_branch'] = $_POST['fullstack_branch'];
  $json_data['qa_branch'] = $_POST['qa_branch'];
  $json_data['mobdev_branch'] = $_POST['mobdev_branch'];
  $json_data['ux_ui_branch'] = $_POST['ux_ui_branch'];

  echo json_encode($json_data);


}

