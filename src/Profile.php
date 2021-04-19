<?php
include_once 'Database.php';

class Profile
{
    private $post_data;

    public function __construct($data)
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
}
