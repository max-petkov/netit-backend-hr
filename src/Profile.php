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

    // Create profile
    public function create_profile()
    {
        global $pdo;
        if (isset($this->post_data['register_employee'])) {
            $employee_data = [
                ':username' => $this->post_data['username'],
                ':first_name' => $this->post_data['name'],
                ':last_name' => $this->post_data['last_name'],
                ':email' => $this->post_data['email'],
                ':password' => $this->post_data['password'],
            ];
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
                ':frontend_branch' => $this->post_data['frontend'],
                ':backend_branch' => $this->post_data['backend'],
                ':fullstack_branch' => $this->post_data['fullstack'],
                ':qa_branch' => $this->post_data['qa'],
                ':mobdev_branch' => $this->post_data['mobdev'],
                ':ux_ui_branch' => $this->post_data['ux/ui'],
                ':company_description' => $this->post_data['company_description'],
                ':email' => $this->post_data['email'],
                ':password' => $this->post_data['password'],
            ];
            $sql = ("INSERT INTO tb_company_profile(username, company_name, frontend_branch, backend_branch, fullstack_branch, qa_branch, mobdev_branch, ux_ui_branch , company_description, email, password) 
                     VALUES(:username, :company_name, :frontend_branch, :backend_branch, :fullstack_branch, :qa_branch, :mobdev_branch, :ux_ui_branch, :company_description, :email, :password)");
            $pdo->prepare_query($sql, $company_data);

            $_SESSION['success_message'] = 'Account created successfully!';
            redirect_to('login.php');
        }

        if (isset($this->post_data['register_hr'])) {
            $hr_data = [
                ':company_id' => $_SESSION['company_id'],
                ':username' => $this->post_data['username'],
                ':email' => $this->post_data['email'],
                ':password' => $this->post_data['password'],
            ];
            $sql = ("INSERT INTO tb_hr(company_id, username, email, password) 
                     VALUES(:company_id, :username, :email, :password)");
            $pdo->prepare_query($sql, $hr_data);
        }
    }

    // Login profile
    public function login()
    {
        $this->login_job_seeker();
        $this->login_company();
        $this->login_hr();
    }

    // Update profile
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

    // Get profile data
    public function profile_data($tb_profile, $session_id)
    {
        return $this->profile_query("SELECT * FROM $tb_profile WHERE id=$session_id");
    }

    public function hr_profile_data()
    {
        $sql = ("SELECT a.*, b.id, b.company_name, b.address, b.website, b.slogan, b.frontend_branch, b.backend_branch, b.fullstack_branch, b.qa_branch, b.mobdev_branch, b.ux_ui_branch, b.company_description, b.file_mime, b.file_data 
        FROM tb_hr AS a 
        INNER JOIN tb_company_profile AS b 
        ON a.company_id=b.id 
        WHERE a.id='{$_SESSION['hr_id']}'");
        return $this->profile_query($sql);
    }


    // Private methods
    private function login_job_seeker()
    {
        if ($this->match_username_pass('tb_job_seeker_profile', 'username', 'password', $this->post_data['username'], $this->post_data['password'])) {
            global $pdo;
            $sql = ("SELECT id, username, password FROM tb_job_seeker_profile 
                     WHERE username='{$this->post_data['username']}' 
                     AND password='{$this->post_data['password']}' LIMIT 1");
            $stmt = $pdo->prepare_query($sql);
            while ($row = $stmt->fetch()) {
                $_SESSION['employee_id'] = $row['id'];
            }
            redirect_to('employee-dashboard.php');
        }
    }

    private function login_company()
    {
        if ($this->match_username_pass('tb_company_profile', 'username', 'password', $this->post_data['username'], $this->post_data['password']) === true) {
            global $pdo;
            $sql = ("SELECT id, username, password FROM tb_company_profile 
                     WHERE username='{$this->post_data['username']}' 
                     AND password='{$this->post_data['password']}' LIMIT 1");
            $stmt = $pdo->prepare_query($sql);
            while ($row = $stmt->fetch()) {
                $_SESSION['company_id'] = $row['id'];
            }
            redirect_to('company-dashboard.php');
        }
    }

    private function login_hr()
    {
        if ($this->match_username_pass('tb_hr', 'username', 'password', $this->post_data['username'], $this->post_data['password']) === true) {
            global $pdo;
            $sql = ("SELECT id, username, password FROM tb_hr 
                     WHERE username='{$this->post_data['username']}' 
                     AND password='{$this->post_data['password']}' LIMIT 1");
            $stmt = $pdo->prepare_query($sql);
            while ($row = $stmt->fetch()) {
                $_SESSION['hr_id'] = $row['id'];
            }
            redirect_to('hr-dashboard.php');
        }
    }

    private function match_username_pass($db_tb, $db_username, $db_password, $username_val, $pass_val)
    {
        global $pdo;
        $sql  = ("SELECT id, {$db_username}, {$db_password} FROM {$db_tb} 
                  WHERE BINARY {$db_username}='{$username_val}' 
                  AND BINARY {$db_password}='{$pass_val}' LIMIT 1");
        $stmt = $pdo->prepare_query($sql);

        if ($stmt->rowCount() === 1) {
            return true;
        } else {
            return false;
        }
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
            if (isset($_SESSION['hr_id'])) {
                $this->username = $row['username'];
                $this->name = $row['company_name'];
                $this->email = $row['email'];
                $this->address = $row['address'];
                $this->website = $row['website'];
                $this->company_description = $row['company_description'];
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
