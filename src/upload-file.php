<?php 
session_start();
include_once 'Uploads.php';

if(isset($_POST['upload_file'])){
    Upload::upload_file();
}


?>