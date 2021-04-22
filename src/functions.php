<?php 
// Redirection url function 
function redirect_to($url){
header("location: {$url}");
exit;
}

function login_required($session_id) {
  if (isset($session_id)) {
    return true;
  } else {
    $_SESSION['error_message'] = 'Login required!';
    redirect_to('login.php');
  }
}

