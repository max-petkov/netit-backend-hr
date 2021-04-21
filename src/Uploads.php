<?php
    include_once 'Database.php';
class Upload
{
    public static function upload_file()
    {
        $data = [
            ':file_name' => $_FILES['img_file']['name'],
            ':file_type' => $_FILES['img_file']['type'],
            ':file_size' => $_FILES['img_file']['size'],
            ':file_data' => file_get_contents($_FILES['img_file']['tmp_name'])
        ];
        global $pdo;
        $sql = ("UPDATE tb_company_profile SET file_name=:file_name, file_mime=:file_type, file_size=:file_size, file_data=:file_data WHERE id='{$_SESSION['company_id']}'");
        $pdo->prepare_query($sql, $data);
    }
}
