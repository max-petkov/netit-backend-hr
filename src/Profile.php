<?php
include_once 'Database.php';

class Profile
{
    private $post_data;
    public $username;
    public $name;
    public $last_name;
    public $email;
    public $address;
    public $website;
    public $short_introducion;
    public $company_description;
    public $company_mission;
    public $company_history;
    public $slogan;
    public $frontend;
    public $backend;
    public $fullstack;
    public $qa;
    public $mobdev;
    public $ux_ui;
    public $file_mime;
    public $file_data;

    public function __construct($data = null)
    {
        $this->post_data = $data;
    }

    public function create_profile()
    {
        if (isset($this->post_data['register_employee'])) {
            $employee_data = [
                ':username' => $this->post_data['username'],
                ':first_name' => $this->post_data['name'],
                ':last_name' => $this->post_data['last_name'],
                ':email' => $this->post_data['email'],
                ':password' => $this->post_data['password'],
            ];
            global $pdo;
            $sql = ("INSERT INTO tb_job_seeker_profile(username, first_name, last_name, email, password) 
                     VALUES(:username, :first_name, :last_name, :email, :password)");
            $pdo->prepare_query($sql, $employee_data);
            $_SESSION['success_message'] = 'Account created successfully!';
            redirect_to('login.php');
        }

        if (isset($this->post_data['register_company'])) {
            $company_data = [
                ':username' => $this->post_data['username'],
                ':company_name' => $this->post_data['name'],
                ':frontend_branch' => $this->post_data['it_branch[0]'],
                ':backend_branch' => $this->post_data['it_branch[1]'],
                ':fullstack_branch' => $this->post_data['it_branch[2]'],
                ':qa_branch' => $this->post_data['it_branch[3]'],
                ':mobdev_branch' => $this->post_data['it_branch[4]'],
                ':ux_ui_branch' => $this->post_data['it_branch[5]'],
                ':company_description' => $this->post_data['company_description'],
                ':email' => $this->post_data['email'],
                ':password' => $this->post_data['password'],
            ];
            global $pdo;
            $sql = ("INSERT INTO tb_company_profile(username, company_name, frontend_branch, backend_branch, fullstack_branch, qa_branch, mobdev_branch, ux_ui_branch , company_description, email, password) 
                     VALUES(:username, :company_name, :frontend_branch, :backend_branch, :fullstack_branch, :qa_branch, :mobdev_branch, :ux_ui_branch, :company_description, :email, :password)");
            $pdo->prepare_query($sql, $company_data);

            $_SESSION['success_message'] = 'Account created successfully!';
            redirect_to('login.php');
        }
    }

    public function update_profile()
    {
        if (isset($this->post_data['update_employee'])) {
            $employee_data = [
                ':first_name' => $this->post_data['name'],
                ':last_name' => $this->post_data['last_name'],
                ':address' => $this->post_data['address'],
                ':website' => $this->post_data['website'],
                ':short_introduction' => $this->post_data['short_introduction']
            ];
            global $pdo;
            $sql = ("UPDATE tb_job_seeker_profile 
                     SET first_name=:first_name, last_name=:last_name, address=:address, website=:website, short_introduction=:short_introduction 
                     WHERE id='{$_SESSION['employee_id']}'");
            $pdo->prepare_query($sql, $employee_data);
        }
        if (isset($this->post_data['update_company'])) {
            $company_data = [
                ':company_name' => $this->post_data['name'],
                ':slogan' => $this->post_data['slogan'],
                ':address' => $this->post_data['address'],
                ':website' => $this->post_data['website'],
                ':company_description' => $this->post_data['company_description'],
                ':company_history' => $this->post_data['company_history'],
                ':company_mission' => $this->post_data['company_mission'],
                ':frontend_branch' => $this->post_data['frontend'] ?? '',
                ':backend_branch' => $this->post_data['backend'] ?? '',
                ':fullstack_branch' => $this->post_data['fullstack'] ?? '',
                ':qa_branch' => $this->post_data['qa'] ?? '',
                ':mobdev_branch' => $this->post_data['mobdev'] ?? '',
                ':ux_ui_branch' => $this->post_data['ux/ui'] ?? ''
            ];
            global $pdo;
            $sql = ("UPDATE tb_company_profile 
                     SET company_name=:company_name, slogan=:slogan, address=:address, website=:website, company_description=:company_description, company_history=:company_history, company_mission=:company_mission, frontend_branch=:frontend_branch, backend_branch=:backend_branch, fullstack_branch=:fullstack_branch, qa_branch=:qa_branch, mobdev_branch=:mobdev_branch, ux_ui_branch=:ux_ui_branch 
                     WHERE id='{$_SESSION['company_id']}'");
            $pdo->prepare_query($sql, $company_data);
        }
    }

    public function profile_data($tb_profile, $session_id)
    {
        return $this->profile_query("SELECT * FROM $tb_profile WHERE id=$session_id");
    }

    private function profile_query($sql)
    {
        global $pdo;
        $stmt = $pdo->prepare_query($sql);
        while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
            if (isset($_SESSION['employee_id'])) {
                $this->username = $row['username'];
                $this->name = $row['first_name'];
                $this->last_name = $row['last_name'];
                $this->email = $row['email'];
                $this->address = $row['address'];
                $this->website = $row['website'];
                $this->short_introducion = $row['short_introduction'];
            }
            if (isset($_SESSION['company_id'])) {
                $this->username = $row['username'];
                $this->name = $row['company_name'];
                $this->email = $row['email'];
                $this->address = $row['address'];
                $this->website = $row['website'];
                $this->company_description = $row['company_description'];
                $this->company_mission = $row['company_mission'];
                $this->company_history = $row['company_history'];
                $this->slogan = $row['slogan'];
                $this->frontend = $row['frontend_branch'];
                $this->backend = $row['backend_branch'];
                $this->fullstack = $row['fullstack_branch'];
                $this->mobdev = $row['mobdev_branch'];
                $this->qa = $row['qa_branch'];
                $this->ux_ui = $row['ux_ui_branch'];
                $this->file_mime = $row['file_mime'];
                $this->file_data = $row['file_data'];
            }
        }
    }
}
