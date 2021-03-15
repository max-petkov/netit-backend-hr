<?php 

function success_message() {
  if (isset($_SESSION['success_message'])) {
    $output = "<div class=\"alert alert-success\">{$_SESSION['success_message']}</div>";
    $_SESSION['success_message'] = null;
    return $output;
  }
}

function error_message() {
  if (isset($_SESSION['error_message'])) {
    $output = "<div class=\"alert alert-danger\">{$_SESSION['error_message']}</div>";
    $_SESSION['error_message'] = null;
    return $output;
  }
}

?>
