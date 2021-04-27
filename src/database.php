<?php

class Database
{
    private $dsn = 'mysql:host=localhost;dbname=monster_hr_db';
    private $username = 'root';
    private $passwd = '';
    public $db_connection;

    function __construct()
    {
        $this->open_db_connection();
    }

    public function open_db_connection()
    {
        $this->db_connection = new PDO($this->dsn, $this->username, $this->passwd);
        try {
            $this->db_connection = new PDO($this->dsn, $this->username, $this->passwd);
            $this->db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo 'Success';
        } catch (PDOException $th) {
            echo 'Fail!' . $th->getMessage();
        }
    }

    public function prepare_query($sql, $value = null)
    {
        $result = $this->db_connection->prepare($sql);
        $result->execute($value);
        return $result;
    }
}

$pdo = new Database;
