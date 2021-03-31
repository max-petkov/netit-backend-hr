<?php 
include 'database.php';
if (isset($_SESSION['company_id'])) {
   
  $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
  $sql = ("SELECT id, username, company_name, frontend_branch, backend_branch, fullstack_branch, qa_branch, mobdev_branch, ux_ui_branch, company_description, email, website, address, slogan, company_history, company_mission FROM tb_company_profile WHERE id={$_SESSION['company_id']}");
  $stmt = $db->query($sql);
  $stmt->execute();

  $company_data = [];

  while ($row = $stmt->fetch()) {
    $json_company_data["id"]                  = $row["id"]; 
    $json_company_data["username"]            = $row["username"]; 
    $json_company_data["company_name"]        = $row["company_name"]; 
    $json_company_data["frontend_branch"]     = $row["frontend_branch"]; 
    $json_company_data["backend_branch"]      = $row["backend_branch"]; 
    $json_company_data["fullstack_branch"]    = $row["fullstack_branch"]; 
    $json_company_data["qa_branch"]           = $row["qa_branch"]; 
    $json_company_data["mobdev_branch"]       = $row["mobdev_branch"]; 
    $json_company_data["ux_ui_branch"]        = $row["ux_ui_branch"]; 
    $json_company_data["company_description"] = $row["company_description"]; 
    $json_company_data["email"]               = $row["email"];
    $json_company_data["website"]             = $row["website"];
    $json_company_data["address"]             = $row["address"];
    $json_company_data["slogan"]              = $row["slogan"];
    $json_company_data["company_history"]     = $row["company_history"];
    $json_company_data["company_mission"]     = $row["company_mission"];

  }
  $company_data['company_data'] = $json_company_data;
    echo json_encode($company_data);
  
} else {
  echo 'error';
}

?>