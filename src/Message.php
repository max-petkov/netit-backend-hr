<?php
include_once 'Database.php';

class Message
{
    private $post_data;
    public $company_username;
    public $hr_username;
    public $hr_id;
    public $company_id;

    function __construct($data = null)
    {
        $this->post_data = $data;
    }

    public function send_msg_to_employee()
    {
        global $pdo;
        $msg_data = [date('Y-m-d'), $this->post_data['from'], $this->post_data['to'], $this->post_data['subject'], $this->post_data['msg']];

        $pdo->prepare_query("INSERT INTO tb_msg_box_job_seeker(send_date, hr_id, job_seeker_id, subject, inbox_msg) VALUES(?, ?, ?, ?, ?)", $msg_data);
        $pdo->prepare_query("INSERT INTO tb_msg_box_hr(send_date, hr_id, job_seeker_id, subject, sent_msg) VALUES(?, ?, ?, ?, ?)", $msg_data);
    }

    public function send_msg_to_company()
    {
        global $pdo;
        $msg_data = [date('Y-m-d'), $this->post_data['from'], $this->post_data['to'], $this->post_data['subject'], $this->post_data['msg']];

        $pdo->prepare_query("INSERT INTO tb_msg_box_company(send_date, hr_id, company_id, subject, inbox_msg) VALUES(?, ?, ?, ?, ?)", $msg_data);
        $pdo->prepare_query("INSERT INTO tb_msg_box_hr(send_date, hr_id, company_id, subject, sent_msg) VALUES(?, ?, ?, ?, ?)", $msg_data);
    }

    public function send_msg_to_hr_from_employee()
    {
        global $pdo;
        $msg_data = [date('Y-m-d'), $this->post_data['from'], $this->post_data['to'], $this->post_data['subject'], $this->post_data['msg']];

        $pdo->prepare_query("INSERT INTO tb_msg_box_hr(send_date, job_seeker_id, hr_id, subject, inbox_msg) VALUES(?, ?, ?, ?, ?)", $msg_data);
        $pdo->prepare_query("INSERT INTO tb_msg_box_job_seeker(send_date, job_seeker_id, hr_id, subject, sent_msg) VALUES(?, ?, ?, ?, ?)", $msg_data);
    }

    public function send_msg_to_hr_from_company()
    {
        global $pdo;
        $msg_data = [date('Y-m-d'), $this->post_data['from'], $this->post_data['to'], $this->post_data['subject'], $this->post_data['msg']];

        $pdo->prepare_query("INSERT INTO tb_msg_box_hr(send_date, company_id, hr_id, subject, inbox_msg) VALUES(?, ?, ?, ?, ?)", $msg_data);
        $pdo->prepare_query("INSERT INTO tb_msg_box_company(send_date, company_id, hr_id, subject, sent_msg) VALUES(?, ?, ?, ?, ?)", $msg_data);
    }

    public static function count_inbox_msg($tb_msg_box, $col_id, $session_id)
    {
        global $pdo;
        $sql = ("SELECT inbox_msg, $col_id, is_viewed FROM $tb_msg_box WHERE inbox_msg IS NOT NULL AND is_viewed IS NULL AND $col_id='{$session_id}'");
        $stmt = $pdo->prepare_query($sql);
        $result = $stmt->rowCount();
        echo $result;
    }

    public function inbox_job_seeker()
    {
        global $pdo;
        $sql = ("SELECT a.*, b.id, b.username, c.id, c.first_name, c.last_name 
        FROM tb_msg_box_job_seeker AS a
        INNER JOIN tb_hr AS b
        ON b.id=a.hr_id
        INNER JOIN tb_job_seeker_profile AS c
        WHERE a.job_seeker_id ='{$_SESSION['employee_id']}'
        AND c.id='{$_SESSION['employee_id']}'
        AND inbox_msg IS NOT NULL
        AND sent_msg IS NULL
        ORDER BY a.id DESC");
        $result = $pdo->prepare_query($sql);
        return $result;
    }

    public function sent_by_job_seeker()
    {
        global $pdo;
        $sql = ("SELECT a.*, b.id, b.username 
        FROM tb_msg_box_job_seeker AS a
        INNER JOIN tb_hr AS b
        ON b.id=a.hr_id
        WHERE a.job_seeker_id ='{$_SESSION['employee_id']}'
        AND inbox_msg IS NULL
        AND sent_msg IS NOT NULL
        ORDER BY a.id DESC");
        $result = $pdo->prepare_query($sql);
        return $result;
    }

    public function inbox_company()
    {
        global $pdo;
        $sql = ("SELECT a.*, b.id, b.username, c.id, c.company_name
        FROM tb_msg_box_company AS a
        INNER JOIN tb_hr AS b
        ON b.id=a.hr_id
        INNER JOIN tb_company_profile AS c
        WHERE a.company_id ='{$_SESSION['company_id']}'
        AND c.id='{$_SESSION['company_id']}'
        AND inbox_msg IS NOT NULL
        AND sent_msg IS NULL
        ORDER BY a.id DESC");
        $result = $pdo->prepare_query($sql);
        return $result;
    }

    public function sent_by_company()
    {
        global $pdo;
        $sql = ("SELECT a.*, b.id, b.username 
        FROM tb_msg_box_company AS a
        INNER JOIN tb_hr AS b
        ON b.id=a.hr_id
        WHERE a.company_id ='{$_SESSION['company_id']}'
        AND inbox_msg IS NULL
        AND sent_msg IS NOT NULL
        ORDER BY a.id DESC");
        $result = $pdo->prepare_query($sql);
        return $result;
    }

    public function get_msg_data()
    {
        global $pdo;

        if (isset($_SESSION['company_id'])) {
            $stmt = $pdo->prepare_query("SELECT a.id, a.username, b.id, b.company_id, b.username
            FROM tb_company_profile AS a
            INNER JOIN tb_hr AS b
            ON b.company_id=a.id
            WHERE a.id='{$_SESSION['company_id']}'");
            while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
                $this->company_username = $row[1];
                $this->company_id = $_SESSION['company_id'];
                $this->hr_username = $row['username'];
                $this->hr_id = $row['id'];
            }
        }

        if (isset($_SESSION['hr_id'])) {
            $stmt = $pdo->prepare_query("SELECT a.id, a.company_id, a.username, b.id, b.company_name
            FROM tb_hr AS a
            INNER JOIN tb_company_profile AS b
            ON b.id=a.company_id
            WHERE a.id='{$_SESSION['hr_id']}'");
            while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
                $this->company_username = $row['company_name'];
                $this->company_id = $row['company_id'];
                $this->hr_username = $row['username'];
                $this->hr_id = $_SESSION['hr_id'];
            }
        }
    }

    public function reset_inbox_counter()
    {
        global $pdo;
        $data = [
            'is_viewed' => 'Y'
        ];
        if (isset($_POST['inbox_job_seeker_counter'])) {
            $pdo->prepare_query("UPDATE tb_msg_box_job_seeker SET is_viewed=:is_viewed WHERE job_seeker_id='{$_SESSION['employee_id']}'", $data);
        }

        if (isset($_POST['inbox_hr_counter'])) {
            $pdo->prepare_query("UPDATE tb_msg_box_hr SET is_viewed=:is_viewed WHERE hr_id='{$_SESSION['hr_id']}'", $data);
        }

        if (isset($_POST['inbox_company_counter'])) {
            $pdo->prepare_query("UPDATE tb_msg_box_company SET is_viewed=:is_viewed WHERE company_id='{$_SESSION['company_id']}'", $data);
        }
    }
}
