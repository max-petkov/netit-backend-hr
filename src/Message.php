<?php
include_once 'Database.php';

class Message
{
    private $post_data;

    function __construct($data)
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

    // Message counter & data

    // Reset inbox counter after opening the message box
}
