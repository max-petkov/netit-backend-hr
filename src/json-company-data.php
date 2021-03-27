<?php 
include 'database.php';
if (isset($_SESSION['company_id'])) {
   
  $db = new PDO("mysql:host=localhost;dbname=registered_users", "root", '');
  $sql = ("SELECT id, username, company_name, company_it_branches, company_description, email, website, address, slogan, company_history, company_mission FROM tb_companies WHERE id={$_SESSION['company_id']}");
  $result = $db->query($sql)->fetch();
  
  while ($row = $result) {
    $json_data["username"]            = $row["username"]; 
    $json_data["company_name"]        = $row["company_name"]; 
    $json_data["company_it_branches"] = $row["company_it_branches"]; 
    $json_data["company_description"] = $row["company_description"]; 
    $json_data["email"]               = $row["email"];
    $json_data["website"]             = $row["website"];
    $json_data["address"]             = $row["address"];
    $json_data["slogan"]              = $row["slogan"];
    $json_data["company_history"]     = $row["company_history"];
    $json_data["company_mission"]     = $row["company_mission"];
    
    // Има break, защото се увеличава loading time на сайта и не го отваря
    break;
    
  }
    echo json_encode($json_data);

  
  
} else {
  echo 'error';
}

?>