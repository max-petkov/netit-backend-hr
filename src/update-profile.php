<?php
session_start();
include_once 'Profile.php';
include_once 'Validator.php';

if (isset($_POST['update_employee'])) {
    $changes = new Validator($_POST);
    $proceed = new Profile($_POST);

    if ($changes->is_valid()) {
        $proceed->update_profile();
        echo json_encode($_POST);
    }
}

if (isset($_POST['update_company'])) {
    $changes = new Validator($_POST);
    $proceed = new Profile($_POST);

    if ($changes->is_valid()) {
        $proceed->update_profile();
        echo json_encode($_POST);
    } 
}

