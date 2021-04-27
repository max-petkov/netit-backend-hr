<?php
include_once 'Database.php';

class Candidate
{
    private $post_data;

    function __construct($data = null)
    {
        $this->post_data = $data;
    }

    public static function count_candidates($candidate)
    {
        global $pdo;
        $sql = ("SELECT a.*, b.id, b.username, c.*, d.*, e.* 
        FROM tb_hr AS a 
        INNER JOIN tb_company_profile AS b 
        ON b.id=a.company_id
        INNER JOIN tb_published_jobs AS c 
        ON c.company_id=b.id
        INNER JOIN tb_applied_jobs AS d
        ON d.job_id = c.id
        INNER JOIN tb_job_seeker_profile AS e
        ON d.job_seeker_id = e.id
        WHERE  a.id='{$_SESSION['hr_id']}'
        AND d.is_approved{$candidate}");

        $stmt = $pdo->prepare_query($sql);
        echo $stmt->rowCount();
    }

    public function display_candidate($candidate)
    {
        global $pdo;
        $sql = ("SELECT a.*, b.id, b.username, c.*, d.*, e.* 
        FROM tb_hr AS a 
        INNER JOIN tb_company_profile AS b 
        ON b.id=a.company_id
        INNER JOIN tb_published_jobs AS c 
        ON c.company_id=b.id
        INNER JOIN tb_applied_jobs AS d
        ON d.job_id = c.id
        INNER JOIN tb_job_seeker_profile AS e
        ON d.job_seeker_id = e.id
        WHERE  a.id='{$_SESSION['hr_id']}'
        AND d.is_approved{$candidate}");

        return $pdo->prepare_query($sql);
    }

    public function display_approved_candidates_on_company_dshb()
    {
        global $pdo;
        $sql = ("SELECT a.*, b.id, b.username, c.*, d.*, e.* 
        FROM tb_hr AS a 
        INNER JOIN tb_company_profile AS b 
        ON b.id=a.company_id
        INNER JOIN tb_published_jobs AS c 
        ON c.company_id=b.id
        INNER JOIN tb_applied_jobs AS d
        ON d.job_id = c.id
        INNER JOIN tb_job_seeker_profile AS e
        ON d.job_seeker_id = e.id
        WHERE  b.id='{$_SESSION['company_id']}'
        AND d.is_approved='Y'");

        return $pdo->prepare_query($sql);
    }

    public function update_status()
    {
        global $pdo;
        if (isset($this->post_data['approve_candidate'])) {
            $data = [':is_approved' => $this->post_data['approve_candidate']];
            $sql = ("UPDATE tb_applied_jobs SET is_approved=:is_approved WHERE job_seeker_id='{$this->post_data['job_seeker_id']}' AND job_id='{$this->post_data['job_id']}' LIMIT 1");
            $pdo->prepare_query($sql, $data);
            echo 'is approved';
        }

        if (isset($this->post_data['reject_candidate'])) {
            $data = [':is_approved' => $this->post_data['reject_candidate']];
            $sql = ("UPDATE tb_applied_jobs SET is_approved=:is_approved WHERE job_seeker_id='{$this->post_data['job_seeker_id']}' AND job_id='{$this->post_data['job_id']}' LIMIT 1");
            $pdo->prepare_query($sql, $data);
            echo 'is not approved';
        }

        if (isset($this->post_data['interviewed_yes'])) {
            $data = [':is_interviewed' => $this->post_data['interviewed_yes']];
            $sql = ("UPDATE tb_applied_jobs SET is_interviewed=:is_interviewed WHERE job_seeker_id='{$this->post_data['job_seeker_id']}' AND job_id='{$this->post_data['job_id']}' LIMIT 1");
            $pdo->prepare_query($sql, $data);
            echo 'is interviewed';
        }

        if (isset($this->post_data['interviewed_no'])) {
            $data = [':is_interviewed' => $this->post_data['interviewed_no']];
            $sql = ("UPDATE tb_applied_jobs SET is_interviewed=:is_interviewed WHERE job_seeker_id='{$this->post_data['job_seeker_id']}' AND job_id='{$this->post_data['job_id']}' LIMIT 1");
            $pdo->prepare_query($sql, $data);
            echo 'is not interviewed';
        }
    }
}
