<?php
include_once 'Database.php';

class Job
{
    private $post_data;

    function __construct($data = null)
    {
        $this->post_data = $data;
    }

    public function publish_job()
    {
        global $pdo;
        $job_data = [
            ':published_date' => date('Y-m-d'),
            ':company_id' => $_SESSION['company_id'],
            ':company_username' => $this->post_data['username'],
            ':company_name' => $this->post_data['name'],
            ':company_email' => $this->post_data['email'],
            ':job_title' => $this->post_data['job_title'],
            ':job_time' => $this->post_data['job_fulltime'] ?? '' . ' ' . $this->post_data['job_part_time'] ?? '',
            ':frontend_tag' => $this->post_data['frontend'] ?? '',
            ':backend_tag' => $this->post_data['backend'] ?? '',
            ':fullstack_tag' => $this->post_data['fullstack'] ?? '',
            ':qa_tag' => $this->post_data['qa'] ?? '',
            ':mobdev_tag' => $this->post_data['mobdev'] ?? '',
            ':ux_ui_tag' => $this->post_data['ux/ui'] ?? '',
            ':job_salary' => $this->post_data['salary'] . $this->post_data['currency'] . ' ' . $this->post_data['month_year_salary'],
            ':job_description' => $this->post_data['description'],
            ':random_chars' => bin2hex(random_bytes(16))
        ];

        $sql = ("INSERT INTO tb_published_jobs(published_date, company_id, company_username, company_name, company_email, job_title, job_time, frontend_tag, backend_tag , fullstack_tag, qa_tag, mobdev_tag, ux_ui_tag, job_salary, job_description, random_chars) 
                 VALUES(:published_date, :company_id, :company_username, :company_name, :company_email, :job_title, :job_time, :frontend_tag, :backend_tag, :fullstack_tag, :qa_tag, :mobdev_tag, :ux_ui_tag, :job_salary, :job_description, :random_chars)");
        $pdo->prepare_query($sql, $job_data);
    }

    public function display_active_jobs_employee()
    {
        global $pdo;
        $stmt = $pdo->prepare_query("SELECT a.*, b.id, b.file_mime, b.file_data 
        FROM tb_published_jobs AS a
        INNER JOIN tb_company_profile AS b
        ON b.id=a.company_id 
        WHERE a.is_active='Y' 
        ORDER BY a.published_date DESC");
        $result = $stmt->fetchAll(PDO::FETCH_BOTH);
        return $result;
    }

    public function display_applied_jobs()
    {
        global $pdo;
        $stmt = $pdo->prepare_query("SELECT a.*, b.* FROM tb_published_jobs AS a 
        INNER JOIN tb_applied_jobs AS b 
        WHERE b.job_id=a.id AND b.job_seeker_id={$_SESSION['employee_id']} AND is_applied='Y' ORDER BY b.applied_id DESC");
        $result = $stmt->fetchAll(PDO::FETCH_BOTH);
        return $result;
    }

    public function display_jobs_company($is_active)
    {
        global $pdo;
        $stmt = $pdo->prepare_query("SELECT * FROM tb_published_jobs WHERE is_active='{$is_active}' AND company_id='{$_SESSION['company_id']}' ORDER BY published_date DESC");
        $result = $stmt->fetchAll(PDO::FETCH_BOTH);
        return $result;
    }

    public function count_active_inactive_jobs($is_active)
    {
        global $pdo;
        $stmt = $pdo->prepare_query("SELECT * FROM tb_published_jobs WHERE is_active='{$is_active}' AND company_id='{$_SESSION['company_id']}' ORDER BY published_date DESC");
        $result = $stmt->rowCount();
        return $result;
    }

    public function set_job_inactive()
    {
        global $pdo;
        $data = [
            ':is_active' => $this->post_data['is_active']
        ];
        $sql = ("UPDATE tb_published_jobs SET is_active=:is_active WHERE company_id='{$_SESSION['company_id']}' AND id='{$this->post_data['published_job_id']}'");
        $pdo->prepare_query($sql, $data);
    }

    public function set_job_active()
    {
        global $pdo;
        $data = [
            ':is_active' => $this->post_data['is_active'],
            ':published_date' => $this->post_data['published_date'],
        ];
        $sql = ("UPDATE tb_published_jobs SET is_active=:is_active, published_date=:published_date 
        WHERE company_id='{$_SESSION['company_id']}' AND id='{$this->post_data['published_job_id']}'");
        $pdo->prepare_query($sql, $data);
    }

    public function delete_job()
    {
        global $pdo;
        $sql = ("DELETE FROM tb_published_jobs WHERE id='{$_POST['published_job_id']}' AND company_id='{$_SESSION['company_id']}'");
        $pdo->prepare_query($sql);
    }

    public function apply_job()
    {
        global $pdo;
        $apply_data = [
            ':applied_date' => date('Y-m-d'),
            ':job_id' => $this->post_data['job_id'],
            ':job_seeker_id' => $this->post_data['job_seeker_id'],
            ':is_applied' => $this->post_data['is_applied'],
            ':motivation_speech' => $this->post_data['motivation_speech']
        ];
        $sql = ("INSERT INTO tb_applied_jobs(applied_date, job_id, job_seeker_id, is_applied, motivation_speech) 
                VALUES(:applied_date, :job_id, :job_seeker_id, :is_applied, :motivation_speech)");
        $pdo->prepare_query($sql, $apply_data);
    }


    public function is_applied_btn($job_id)
    {
        global $pdo;
        $sql = ("SELECT applied_id, job_id, job_seeker_id, is_applied FROM tb_applied_jobs WHERE job_id='{$job_id}' AND job_seeker_id='{$_SESSION['employee_id']}' AND is_applied='Y'");
        $stmt = $pdo->prepare_query($sql);
        $result = $stmt->rowCount();
        return $result;
    }

    public function cancel_application()
    {
        if (isset($this->post_data['cancel_application'])) {
            global $pdo;
            $sql = ("DELETE FROM tb_applied_jobs WHERE applied_id='{$this->post_data['applied_id']}' AND job_seeker_id='{$_SESSION['employee_id']}'");
            $pdo->prepare_query($sql);
        }
    }

    public static function count_published_job_tags($col_tag, $tag_val)
    {
        global $pdo;
        $stmt = $pdo->prepare_query("SELECT {$col_tag}, is_active FROM tb_published_jobs WHERE {$col_tag}='{$tag_val}' AND is_active='Y'");
        $result = $stmt->rowCount();
        echo $result;
    }
}
