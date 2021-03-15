<?php 

function success_message_registration() {
  if (isset($_SESSION['success_message'])) {
    $output = "<div class=\"alert alert-success\">{$_SESSION['success_message']}</div>";
    $_SESSION['success_message'] = null;
    return $output;
  }
}

?>
