<?php
include_once 'Message.php';
include_once 'Validator.php';

if (isset($_POST['hr_to_employee'])) {
    $check = new Validator($_POST);
    $check->validate_from();
    $check->validate_to();
    $check->validate_subject_msg();
    $check->validate_msg();

    if ($check->is_valid()) {
        $proceed = new Message($_POST);
        $proceed->send_msg_to_employee();
        echo 'Message sent to employee';
    }
}

if (isset($_POST['hr_to_company'])) {
    $check = new Validator($_POST);
    $check->validate_from();
    $check->validate_to();
    $check->validate_subject_msg();
    $check->validate_msg();

    if ($check->is_valid()) {
        $proceed = new Message($_POST);
        $proceed->send_msg_to_company();
        echo 'Message sent to company';
    }
}

if (isset($_POST['employee_to_hr'])) {
    $check = new Validator($_POST);
    $check->validate_from();
    $check->validate_to();
    $check->validate_subject_msg();
    $check->validate_msg();

    if ($check->is_valid()) {
        $proceed = new Message($_POST);
        $proceed->send_msg_to_hr_from_employee();
        echo 'Message sent to hr from employee';
    }
}

if (isset($_POST['company_to_hr'])) {
    $check = new Validator($_POST);
    $check->validate_from();
    $check->validate_to();
    $check->validate_subject_msg();
    $check->validate_msg();

    if ($check->is_valid()) {
        $proceed = new Message($_POST);
        $proceed->send_msg_to_hr_from_company();
        echo 'Message sent to hr from company';
    }
}
