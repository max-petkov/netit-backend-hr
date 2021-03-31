<?php 

function checking_existing_username_email($db_table_name, $db_username_or_email, $input_value) {
  $db_connection = new PDO('mysql:host=localhost;dbname=monster_hr_db', 'root', '');
  try {
    $db_connection = new PDO('mysql:host=localhost;dbname=monster_hr_db', 'root', '');
    $db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo 'CONNECTION 4 SUCCESS!';
  } catch (PDOException $th) {
    echo 'FAILED!: ' . $th->getMessage();
  }

  $sql  = "SELECT $db_username_or_email FROM $db_table_name WHERE {$db_username_or_email}=:{$db_username_or_email}";
  $stmt = $db_connection->prepare($sql);
  $stmt->bindValue(":{$db_username_or_email}", $input_value);
  $stmt->execute();
  
  $result = $stmt->rowCount();

  if ($result > 0) {
    return true;
  } else {
   return false;
  }

}


function login_attempt($db_table_name, $db_username, $db_password, $username_input_value, $password_input_value) {
  $db_connection = new PDO('mysql:host=localhost;dbname=monster_hr_db', 'root', '');
  try {
    $db_connection = new PDO('mysql:host=localhost;dbname=monster_hr_db', 'root', '');
    $db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo 'CONNECTION 5 SUCCESS!';
  } catch (PDOException $th) {
    echo 'Failed!:' . $th->getMessage();
  } 

  // $sql  = "SELECT * FROM {$db_table_name} WHERE BINARY {$db_username}=:{$db_username} AND BINARY {$db_password}=:{$db_password}";
  $sql  = "SELECT id, {$db_username}, {$db_password} FROM {$db_table_name} WHERE BINARY {$db_username}=:{$db_username} AND BINARY {$db_password}=:{$db_password}";
  $stmt = $db_connection->prepare($sql);
  $stmt->bindValue(":{$db_username}", $username_input_value);
  $stmt->bindValue(":{$db_password}", $password_input_value);
  $stmt->execute();

  $result = $stmt->rowCount();
  $get_user_data = $stmt->fetch();
 
  if ($result == 1) {
    // Getting user data after succesfull login  
    return $get_user_data;

  } else {
    return false;
  }


}


// Redirection url function 
function redirect_to($url){
header("location: {$url}");
exit;
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


function login_required($session_id) {
  if (isset($session_id)) {
    return true;
  } else {
    $_SESSION['error_message'] = 'Login required!';
    redirect_to('login.php');
  }
}

// Counting published jobs
// FOR NOW IT'S NOT COUNTING THE PUBLISHED JOBS BUT ONLY THE CHECKBOX VALUES WHICH THE COMPANIES SELECTED AFTER REGISTRATION
function published_job($tag_column, $tag_value) {
  $db = new PDO('mysql:host=localhost;dbname=monster_hr_db', 'root', '');
  try {
    $db = new PDO('mysql:host=localhost;dbname=monster_hr_db', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo 'Success';
  } catch (PDOException $th) {
    echo 'Fail!' . $th->getMessage();
  }

  $sql = ("SELECT {$tag_column}, is_active FROM tb_published_jobs WHERE {$tag_column}='{$tag_value}' AND is_active='Y'");
  $stmt = $db->query($sql);
  $stmt->execute();
  $result = $stmt->rowCount();

  echo $result;

  $db = null;
}

?>