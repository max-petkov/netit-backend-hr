<?php
session_start();
include_once 'Profile.php';
include_once 'Validator.php';

if (isset($_POST['update_employee'])) {
    $profile = new Validator($_POST);
    $update = new Profile($_POST);

    if ($profile->is_valid()) {
        $update->update_profile();
        echo json_encode($_POST);
    }
}

if (isset($_POST['update_company'])) {
    $profile = new Validator($_POST);
    $update = new Profile($_POST);

    if ($profile->is_valid()) {
        $update->update_profile();
        echo json_encode($_POST);
    }
}
