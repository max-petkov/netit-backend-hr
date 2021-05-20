<?php
include_once 'Validator.php';
if (isset($_POST['login_user'])) {
    if (empty($_POST['username']) && empty($_POST['password'])) {
        $_SESSION['error_message'] = 'You must fill the required fields!';
    } else {
        if (Validator::one_user_only()) {
            $_SESSION['error_message'] = 'Only one account can be logged in!';
        } else {
            $profile  = new Profile($_POST);
            if (!$profile->login()) {
                $_SESSION['error_message'] = 'Incorrect username or password!';
            } else {
                $profile->login();
            }
        }
    }
}
