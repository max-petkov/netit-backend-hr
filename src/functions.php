<?php 

function checking_existing_username_email($db_table_name, $db_username, $input_value) {

  $database_connection = new PDO('mysql:host=localhost;dbname=registered_users', 'root', '');
  try {
    $database_connection = new PDO('mysql:host=localhost;dbname=registered_users', 'root', '');
    $database_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'CONNECTION 4 SUCCESS!';
  } catch (PDOException $th) {
    echo 'FAILED!: ' . $th->getMessage();
  }

  $sql  = "SELECT $db_username FROM $db_table_name WHERE {$db_username}=:{$db_username}";
  $stmt = $database_connection->prepare($sql);
  $stmt->bindValue(":{$db_username}", $input_value);
  $stmt->execute();
  
  $result = $stmt->rowCount();

  if ($result > 0) {
    return true;
  } else {
   return false;
  }

  $database_connection = null;
}

// Display selected IT Branches
function checkbox_array_display() {
  if(isset($_POST['submit_registration_company'])) {

    echo "You have selected:";

    if(!empty($_POST['it_branch'])){
      foreach ($_POST['it_branch'] as $branches_selected){
       echo "{$branches_selected};";
      } 
    }
  }
}
// checkbox_array_display();

?>