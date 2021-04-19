<?php
include_once 'Database.php';

class Validator
{
    public $error_msg = [];
    public $succ_msg = [];
    public $style_input = [];
    public $check_box = [];
    private $post_data;

    function __construct($data)
    {
        $this->post_data = $data;
    }

    public function validate_username()
    {
        if ($this->empty_field($this->post_data['username'])) {
            $this->error_msg['username'] = '<div class="invalid-feedback">Field can not be empty!</div>';
            $this->style_input['username'] = 'is-invalid';
        } else {
            if ($this->count_symbols_input($this->post_data['username'])) {
                $this->error_msg['username'] = '<div class="invalid-feedback">More than 4 and less than 49!</div>';
                $this->style_input['username'] = 'is-invalid';
            } else {
                if ($this->existing_acc($this->post_data['username'])) {
                    $this->error_msg['username'] = '<div class="invalid-feedback">Username exists!</div>';
                    $this->style_input['username'] = 'is-invalid';
                } else {
                    $this->succ_msg['username'] = '<div class="valid-feedback">Great!</div>';
                    $this->style_input['username'] = 'is-valid';
                }
            }
        }
    }

    public function validate_name()
    {
        if ($this->empty_field($this->post_data['name'])) {
            $this->error_msg['name'] = '<div class="invalid-feedback">Field can not be empty!</div>';
            $this->style_input['name'] = 'is-invalid';
        } else {
            if ($this->count_symbols_input($this->post_data['name'])) {
                $this->error_msg['name'] = '<div class="invalid-feedback">More than 4 and less than 49!</div>';
                $this->style_input['name'] = 'is-invalid';
            } else {
                $this->succ_msg['name'] = "<div class=\"valid-feedback\">Hello, {$this->post_data['name']}!</div>";
                $this->style_input['name'] = 'is-valid';
            }
        }
    }

    public function validate_last_name()
    {
        if ($this->empty_field($this->post_data['last_name'])) {
            $this->error_msg['last_name'] = '<div class="invalid-feedback">Field can not be empty!</div>';
            $this->style_input['last_name'] = 'is-invalid';
        } else {
            if ($this->count_symbols_input($this->post_data['last_name'])) {
                $this->error_msg['last_name'] = '<div class="invalid-feedback">More than 4 and less than 49!</div>';
                $this->style_input['last_name'] = 'is-invalid';
            } else {
                $this->succ_msg['last_name'] = "<div class=\"valid-feedback\">OK!</div>";
                $this->style_input['last_name'] = 'is-valid';
            }
        }
    }

    public function validate_email()
    {
        if ($this->empty_field($this->post_data['email'])) {
            $this->error_msg['email'] = '<div class="invalid-feedback">Field can not be empty!</div>';
            $this->style_input['email'] = 'is-invalid';
        } else {
            if ($this->count_symbols_input($this->post_data['email'])) {
                $this->error_msg['email'] = '<div class="invalid-feedback">Email must be less than 49 symbols!</div>';
                $this->style_input['email'] = 'is-invalid';
            } else {
                if ($this->existing_email($this->post_data['email'])) {
                    $this->error_msg['email'] = '<div class="invalid-feedback">Email exists!</div>';
                    $this->style_input['email'] = 'is-invalid';
                } else {
                    if ($this->email_format($this->post_data['email'])) {
                        $this->error_msg['email'] = '<div class="invalid-feedback">Invalid email format... example@mail.com!</div>';
                        $this->style_input['email'] = 'is-invalid';
                    } else {
                        $this->succ_msg['email'] = '<div class="valid-feedback">Perfect!</div>';
                        $this->style_input['email'] = 'is-valid';
                    }
                }
            }
        }
    }

    public function validate_password()
    {
        if ($this->empty_field($this->post_data['password'])) {
            $this->error_msg['password'] = '<div class="invalid-feedback">Field can not be empty!</div>';
            $this->style_input['password'] = 'is-invalid';
        } else {
            if ($this->count_symbols_input($this->post_data['password'])) {
                $this->error_msg['password'] = '<div class="invalid-feedback">More than 4 and less than 49!</div>';
                $this->style_input['password'] = 'is-invalid';
            } else {
                $this->succ_msg['password'] = "<div class=\"valid-feedback\">So far, so good!</div>";
                $this->style_input['password'] = 'is-valid';
            }
        }
    }

    public function validate_confirm_password()
    {
        if ($this->empty_field($this->post_data['confirm_password'])) {
            $this->error_msg['confirm_password'] = '<div class="invalid-feedback">Field can not be empty!</div>';
            $this->style_input['confirm_password'] = 'is-invalid';
        } else {
            if ($this->confirm_pass($this->post_data['password'], $this->post_data['confirm_password'])) {
                $this->error_msg['confirm_password'] = '<div class="invalid-feedback">Passwords must match!</div>';
                $this->style_input['confirm_password'] = 'is-invalid';
            } else {
                $this->succ_msg['confirm_password'] = "<div class=\"valid-feedback\">Perfect!</div>";
                $this->style_input['confirm_password'] = 'is-valid';
            }
        }
    }

    public function validate_description()
    {
        if ($this->empty_field($this->post_data['company_description'])) {
            $this->error_msg['description'] = '<div class="invalid-feedback">Field can not be empty!</div>';
            $this->style_input['description'] = 'is-invalid';
        } else {
            if ($this->count_symbols_textarea($this->post_data['company_description'])) {
                $this->error_msg['description'] = '<div class="invalid-feedback">Field must be more than 50 and less than 1000 symbols!</div>';
                $this->style_input['description'] = 'is-invalid';
            } else {
                $this->succ_msg['description'] = '<div class="valid-feedback">Great!</div>';
                $this->style_input['description'] = 'is-valid';
            }
        }
    }

    public function validate_branches()
    {

        if (empty($this->post_data['it_branch'])) {
            $this->error_msg['branch'] = '<div class="text-danger">You need to check atleast one branch!</div>';
        } else {
            $this->valid_branch($this->post_data['it_branch']);
        }
    }

    public function is_valid()
    {
        if (
            $this->error_msg['username'] == '' &&
            $this->error_msg['name'] == '' &&
            $this->error_msg['last_name'] == '' &&
            $this->error_msg['email'] == '' &&
            $this->error_msg['password'] == '' &&
            $this->error_msg['company_description'] == '' &&
            $this->error_msg['it_branch'] == ''
        ) {
            return true;
        }
    }


    // Empty input
    public function empty_field($value)
    {
        if (empty(trim($value))) {
            return true;
        }
    }

    // Input string lenght
    private function count_symbols_input($value)
    {
        if (mb_strlen(trim($value)) < 4 || mb_strlen(trim($value)) > 49) {
            return true;
        }
    }

    // Textarea string lenght
    private function count_symbols_textarea($value)
    {
        if (mb_strlen(trim($value)) < 49 || mb_strlen(trim($value)) > 999) {
            return true;
        }
    }

    // Email format
    private function email_format($value)
    {
        if (!filter_var(trim($value), FILTER_VALIDATE_EMAIL)) {
            return true;
        }
    }

    // Password confirm
    private function confirm_pass($value1, $value2)
    {
        if (trim($value1) != trim($value2)) {
            return true;
        }
    }

    // Valid branches 
    public function valid_branch($array)
    {
        if (in_array('frontend', $array)) {
            $this->check_box['frontend'] = 'checked';
            $this->style_input['frontend'] = 'is-valid';
        }

        if (in_array('backend', $array)) {
            $this->check_box['backend'] = 'checked';
            $this->style_input['backend'] = 'is-valid';
        }

        if (in_array('fullstack', $array)) {
            $this->check_box['fullstack'] = 'checked';
            $this->style_input['fullstack'] = 'is-valid';
        }

        if (in_array('qa', $array)) {
            $this->check_box['qa'] = 'checked';
            $this->style_input['qa'] = 'is-valid';
        }

        if (in_array('mobdev', $array)) {
            $this->check_box['mobdev'] = 'checked';
            $this->style_input['mobdev'] = 'is-valid';
        }

        if (in_array('ux/ui', $array)) {
            $this->check_box['ux/ui'] = 'checked';
            $this->style_input['ux/ui'] = 'is-valid';
        }
    }

    // Existing username
    private function existing_acc($value)
    {
        if (
            $this->existing_value('username', 'tb_job_seeker_profile', $value) ||
            $this->existing_value('username', 'tb_company_profile', $value) ||
            $this->existing_value('username', 'tb_hr', $value)
        ) {
            return true;
        }
    }

    // Existing email
    private function existing_email($value)
    {
        if (
            $this->existing_value('email', 'tb_job_seeker_profile', $value) ||
            $this->existing_value('email', 'tb_company_profile', $value) ||
            $this->existing_value('email', 'tb_hr', $value)
        ) {
            return true;
        }
    }

    private function existing_value($db_col, $db_tb, $value)
    {
        global $pdo;
        $data = [":{$db_col}" => $value];
        $sql  = ("SELECT $db_col FROM $db_tb WHERE {$db_col}=:{$db_col}");
        $stmt = $pdo->prepare_query($sql, $data);
        $result = $stmt->rowCount();

        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Validate login
    public function login()
    {
        if (
            $this->find_acc_pass('tb_job_seeker_profile', 'username', 'password', $this->post_data['username'], $this->post_data['password']) ||
            $this->find_acc_pass('tb_company_profile', 'username', 'password', $this->post_data['username'], $this->post_data['password']) ||
            $this->find_acc_pass('tb_hr', 'username', 'password', $this->post_data['username'], $this->post_data['password'])
        ) {
            $this->login_job_seeker();
            $this->login_company();
            $this->login_hr();
        }
    }

    private function login_job_seeker()
    {

        if ($this->find_acc_pass('tb_job_seeker_profile', 'username', 'password', $this->post_data['username'], $this->post_data['password']) === true) {
            $_SESSION['employee_id'] = $this->find_acc_pass('tb_job_seeker_profile', 'username', 'password', $this->post_data['username'], $this->post_data['password'])['id'];
        }
    }

    private function login_company()
    {
        if ($this->find_acc_pass('tb_company_profile', 'username', 'password', $this->post_data['username'], $this->post_data['password']) === true) {
            $_SESSION['company_id'] = $this->find_acc_pass('tb_company_profile', 'username', 'password', $this->post_data['username'], $this->post_data['password'])['id'];
        }
    }

    private function login_hr()
    {
        if ($this->find_acc_pass('tb_hr', 'username', 'password', $this->post_data['username'], $this->post_data['password']) === true) {
            $_SESSION['hr_id'] = $this->find_acc_pass('tb_hr', 'username', 'password', $this->post_data['username'], $this->post_data['password'])['id'];
        }
    }

    private function find_acc_pass($db_tb, $db_username, $db_password, $username_val, $pass_val)
    {
        global $pdo;
        $data = [
            ":{$db_username}" => $username_val,
            ":{$db_password}" => $pass_val,
        ];
        $sql  = ("SELECT id, {$db_username}, {$db_password} FROM {$db_tb} 
                  WHERE BINARY {$db_username}=:{$db_username} 
                  AND BINARY {$db_password}=:{$db_password} LIMIT 1");
        $stmt = $pdo->prepare_query($sql, $data);

        $result = $stmt->rowCount();
        $data = $stmt->fetch();
        if ($result === 1) {
            if ($db_tb === 'tb_job_seeker_profile') {
                redirect_to('employee-dashboard.php');
            }

            if ($db_tb === 'tb_company_profile') {
                redirect_to('company-dashboard.php');
            }

            if ($db_tb === 'tb_hr') {
                redirect_to('hr-dashboard.php');
            }
            return $data;
        } else {
            return false;
        }
    }
}
