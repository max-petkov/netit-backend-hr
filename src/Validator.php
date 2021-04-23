<?php
include_once 'Database.php';

class Validator
{
    public $error_msg = [];
    public $succ_msg = [];
    public $style_input = [];
    public $check_box = [];
    private $post_data;

    function __construct($data = null)
    {
        $this->post_data = $data;
    }

    public function validate_username()
    {
        if ($this->empty_field($this->post_data['username'])) {
            $this->error_msg['username'] = '<div class="invalid-feedback">Field can not be empty!</div>';
            $this->style_input['username'] = 'is-invalid';
            return false;
        } else {
            if ($this->count_symbols_input($this->post_data['username'], 4)) {
                $this->error_msg['username'] = '<div class="invalid-feedback">More than 4 and less than 49!</div>';
                $this->style_input['username'] = 'is-invalid';
                return false;
            } else {
                if ($this->existing_acc($this->post_data['username'])) {
                    $this->error_msg['username'] = '<div class="invalid-feedback">Username exists!</div>';
                    $this->style_input['username'] = 'is-invalid';
                    if (isset($this->post_data['register_hr']) && $this->existing_acc($this->post_data['username'])) {
                        echo 'username is taken';
                    }
                    return false;
                } else {
                    $this->succ_msg['username'] = '<div class="valid-feedback">Great!</div>';
                    $this->style_input['username'] = 'is-valid';
                    return true;
                }
            }
        }
    }

    public function validate_name()
    {
        if ($this->empty_field($this->post_data['name'])) {
            $this->error_msg['name'] = '<div class="invalid-feedback">Field can not be empty!</div>';
            $this->style_input['name'] = 'is-invalid';
            return false;
        } else {
            if ($this->count_symbols_input($this->post_data['name'], 4)) {
                $this->error_msg['name'] = '<div class="invalid-feedback">More than 4 and less than 49!</div>';
                $this->style_input['name'] = 'is-invalid';
                return false;
            } else {
                $this->succ_msg['name'] = "<div class=\"valid-feedback\">Hello, {$this->post_data['name']}!</div>";
                $this->style_input['name'] = 'is-valid';
                return true;
            }
        }
    }

    public function validate_last_name()
    {
        if ($this->empty_field($this->post_data['last_name'])) {
            $this->error_msg['last_name'] = '<div class="invalid-feedback">Field can not be empty!</div>';
            $this->style_input['last_name'] = 'is-invalid';
            return false;
        } else {
            if ($this->count_symbols_input($this->post_data['last_name'], 4)) {
                $this->error_msg['last_name'] = '<div class="invalid-feedback">More than 4 and less than 49!</div>';
                $this->style_input['last_name'] = 'is-invalid';
                return false;
            } else {
                $this->succ_msg['last_name'] = "<div class=\"valid-feedback\">OK!</div>";
                $this->style_input['last_name'] = 'is-valid';
                return true;
            }
        }
    }

    public function validate_email()
    {
        if ($this->empty_field($this->post_data['email'])) {
            $this->error_msg['email'] = '<div class="invalid-feedback">Field can not be empty!</div>';
            $this->style_input['email'] = 'is-invalid';
            return false;
        } else {
            if ($this->count_symbols_input($this->post_data['email'])) {
                $this->error_msg['email'] = '<div class="invalid-feedback">Email must be less than 49 symbols!</div>';
                $this->style_input['email'] = 'is-invalid';
                return false;
            } else {
                if ($this->existing_email($this->post_data['email'])) {
                    $this->error_msg['email'] = '<div class="invalid-feedback">Email exists!</div>';
                    $this->style_input['email'] = 'is-invalid';
                    if (isset($this->post_data['register_hr']) && $this->existing_email($this->post_data['email'])) {
                        echo 'email is taken';
                    }
                    return false;
                } else {
                    if ($this->email_format($this->post_data['email'])) {
                        $this->error_msg['email'] = '<div class="invalid-feedback">Invalid email format... example@mail.com!</div>';
                        $this->style_input['email'] = 'is-invalid';
                        return false;
                    } else {
                        $this->succ_msg['email'] = '<div class="valid-feedback">Perfect!</div>';
                        $this->style_input['email'] = 'is-valid';
                        return true;
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
            return false;
        } else {
            if ($this->count_symbols_input($this->post_data['password'], 4)) {
                $this->error_msg['password'] = '<div class="invalid-feedback">More than 4 and less than 49!</div>';
                $this->style_input['password'] = 'is-invalid';
                return false;
            } else {
                $this->succ_msg['password'] = "<div class=\"valid-feedback\">So far, so good!</div>";
                $this->style_input['password'] = 'is-valid';
                return true;
            }
        }
    }

    public function validate_confirm_password()
    {
        if ($this->empty_field($this->post_data['confirm_password'])) {
            $this->error_msg['confirm_password'] = '<div class="invalid-feedback">Field can not be empty!</div>';
            $this->style_input['confirm_password'] = 'is-invalid';
            return false;
        } else {
            if ($this->confirm_pass($this->post_data['password'], $this->post_data['confirm_password'])) {
                $this->error_msg['confirm_password'] = '<div class="invalid-feedback">Passwords must match!</div>';
                $this->style_input['confirm_password'] = 'is-invalid';
                return false;
            } else {
                $this->succ_msg['confirm_password'] = "<div class=\"valid-feedback\">Perfect!</div>";
                $this->style_input['confirm_password'] = 'is-valid';
                return true;
            }
        }
    }

    public function validate_description()
    {
        if ($this->empty_field($this->post_data['company_description'])) {
            $this->error_msg['description'] = '<div class="invalid-feedback">Field can not be empty!</div>';
            $this->style_input['description'] = 'is-invalid';
            return false;
        } else {
            if ($this->count_symbols_textarea($this->post_data['company_description'], 49)) {
                $this->error_msg['description'] = '<div class="invalid-feedback">Field must be more than 50 and less than 1000 symbols!</div>';
                $this->style_input['description'] = 'is-invalid';
                return false;
            } else {
                $this->succ_msg['description'] = '<div class="valid-feedback">Great!</div>';
                $this->style_input['description'] = 'is-valid';
                return true;
            }
        }
    }

    public function validate_branches()
    {

        if ($this->validate_branch() === false) {
            $this->error_msg['branch'] = '<div class="text-danger">You need to check atleast one branch!</div>';
            return false;
        } else {
            $this->valid_branch();
            return true;
        }
    }

    // Valid branches 
    public function valid_branch()
    {
        if (!empty($this->post_data['frontend'])) {
            $this->check_box['frontend'] = 'checked';
            $this->style_input['frontend'] = 'is-valid';
        }

        if (!empty($this->post_data['backend'])) {
            $this->check_box['backend'] = 'checked';
            $this->style_input['backend'] = 'is-valid';
        }

        if (!empty($this->post_data['fullstack'])) {
            $this->check_box['fullstack'] = 'checked';
            $this->style_input['fullstack'] = 'is-valid';
        }

        if (!empty($this->post_data['qa'])) {
            $this->check_box['qa'] = 'checked';
            $this->style_input['qa'] = 'is-valid';
        }

        if (!empty($this->post_data['mobdev'])) {
            $this->check_box['mobdev'] = 'checked';
            $this->style_input['mobdev'] = 'is-valid';
        }

        if (!empty($this->post_data['ux/ui'])) {
            $this->check_box['ux/ui'] = 'checked';
            $this->style_input['ux/ui'] = 'is-valid';
        }
    }

    public function validate_address()
    {
        if ($this->empty_field($this->post_data['address'])) {
            return false;
        } else {
            if ($this->count_symbols_input($this->post_data['address'])) {
                return false;
            } else {
                return true;
            }
        }
    }

    public function validate_website()
    {
        if ($this->empty_field($this->post_data['website'])) {
            return false;
        } else {
            if ($this->count_symbols_input($this->post_data['website'])) {
                return false;
            } else {
                if (!preg_match('/(-)|(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/', $this->post_data['website'])) {
                    return false;
                } else {
                    return true;
                }
            }
        }
    }

    public function validate_short_introduction()
    {
        if ($this->empty_field($this->post_data['short_introduction'])) {
            return false;
        } else {
            if ($this->count_symbols_textarea($this->post_data['short_introduction'])) {
                return false;
            } else {
                return true;
            }
        }
    }

    public function validate_slogan()
    {
        if ($this->count_symbols_input($this->post_data['slogan'])) {
            return false;
        } else {
            return true;
        }
    }

    public function validate_history()
    {
        if ($this->count_symbols_textarea($this->post_data['company_history'])) {
            return false;
        } else {
            return true;
        }
    }

    public function validate_mission()
    {
        if ($this->count_symbols_textarea($this->post_data['company_mission'])) {
            return false;
        } else {
            return true;
        }
    }

    public function validate_job_title()
    {
        if ($this->empty_field($this->post_data['job_title'])) {
            return false;
        } else {
            if ($this->string_length($this->post_data['job_title'], 20, 254)) {
                return false;
            } else {
                return true;
            }
        }
    }

    public function validate_job_description()
    {
        if ($this->empty_field($this->post_data['description'])) {
            return false;
        } else {
            if ($this->count_symbols_textarea($this->post_data['description'], 49)) {
                return false;
            } else {
                return true;
            }
        }
    }

    public function validate_work_time()
    {
        if (empty($this->post_data['job_fulltime']) && empty($this->post_data['job_part_time'])) {
            return false;
        } else {
            return true;
        }
    }

    public function validate_currency()
    {
        if (empty($this->post_data['currency'])) {
            return false;
        } else {
            return true;
        }
    }

    public function validate_month_year_salary()
    {
        if (empty($this->post_data['month_year_salary'])) {
            return false;
        } else {
            return true;
        }
    }

    public function validate_salary()
    {
        if ($this->empty_field($this->post_data['salary'])) {
            return false;
        } else {
            if (preg_match('/[a-zA-Z)(*&^%$#@!)]/', $this->post_data['salary'])) {
                return false;
            } else {
                return true;
            }
        }
    }

    public function validate_motivation_speech()
    {
        if ($this->empty_field($this->post_data['motivation_speech'])) {
            return false;
        } else {
            if ($this->count_symbols_textarea($this->post_data['motivation_speech'], 49)) {
                return false;
            } else {
                return true;
            }
        }
    }

    public function validate_hidden_fields()
    {
        if ($this->has_employee_applied() === 0 && $this->existing_published_job_random_chars() === 1) {
            return true;
        } else {
            return false;
        }
    }

    public function validate_from()
    {
        if (empty($this->post_data['from'])) {
            return false;
        } else {
            return true;
        }
    }
    public function validate_to()
    {
        if (empty($this->post_data['to'])) {
            return false;
        } else {
            return true;
        }
    }

    public function validate_subject_msg()
    {
        if ($this->empty_field($this->post_data['subject'])) {
            return false;
        } else {
            if ($this->string_length($this->post_data['subject'], 20, 254)) {
                return false;
            } else {
                return true;
            }
        }
    }

    public function validate_msg()
    {
        if ($this->empty_field($this->post_data['msg'])) {
            return false;
        } else {
            if ($this->string_length($this->post_data['msg'], 49, 999)) {
                return false;
            } else {
                return true;
            }
        }
    }

    public function is_valid()
    {
        if (isset($this->post_data['register_employee'])) {
            if (
                $this->validate_username() === true &&
                $this->validate_name() === true &&
                $this->validate_last_name() === true &&
                $this->validate_email() === true &&
                $this->validate_password() === true &&
                $this->validate_confirm_password() === true
            ) {
                return true;
            }
        }

        if (isset($this->post_data['update_employee'])) {
            if (
                $this->validate_name() === true &&
                $this->validate_last_name() === true &&
                $this->validate_address() === true &&
                $this->validate_website() === true &&
                $this->validate_short_introduction() === true
            ) {
                return true;
            }
        }

        if (isset($this->post_data['register_company'])) {
            if (
                $this->validate_username() === true &&
                $this->validate_name() === true &&
                $this->validate_email() === true &&
                $this->validate_password() === true &&
                $this->validate_confirm_password() === true &&
                $this->validate_description() === true &&
                $this->validate_branches() === true
            ) {
                return true;
            }
        }

        if (isset($this->post_data['update_company'])) {
            if (
                $this->validate_name() === true &&
                $this->validate_address() === true &&
                $this->validate_website() === true &&
                $this->validate_slogan() === true &&
                $this->validate_description() === true &&
                $this->validate_history() === true &&
                $this->validate_mission() === true &&
                $this->validate_branch() === true
            ) {
                return true;
            }
        }

        if (isset($this->post_data['register_hr'])) {
            if (
                $this->validate_username() === true &&
                $this->validate_email() === true &&
                $this->validate_password() === true &&
                $this->validate_confirm_password() === true
            ) {
                return true;
            }
        }

        if (isset($this->post_data['publish_job'])) {
            if (
                $this->validate_job_title() === true &&
                $this->validate_branches() === true &&
                $this->validate_work_time() === true &&
                $this->validate_salary() === true &&
                $this->validate_currency() === true &&
                $this->validate_month_year_salary() === true &&
                $this->validate_job_description() === true
            ) {
                return true;
            }
        }

        if (isset($this->post_data['update_job'])) {
            if (
                $this->validate_job_title() === true &&
                $this->validate_branches() === true &&
                $this->validate_work_time() === true &&
                $this->validate_salary() === true &&
                $this->validate_currency() === true &&
                $this->validate_month_year_salary() === true &&
                $this->validate_job_description() === true
            ) {
                return true;
            }
        }

        if (isset($this->post_data['apply_job'])) {
            if (
                $this->validate_hidden_fields() === true &&
                $this->validate_motivation_speech() === true &&
                $_SESSION['employee_id'] === $this->post_data['job_seeker_id']
            ) {
                return true;
            }
        }

        if (isset($this->post_data['hr_to_employee'])) {
            if (
                $this->validate_from() === true &&
                $this->validate_to() === true &&
                $this->validate_subject_msg() === true &&
                $this->validate_msg() === true
            ) {
                return true;
            }
        }

        if (isset($this->post_data['hr_to_company'])) {
            if (
                $this->validate_from() === true &&
                $this->validate_to() === true &&
                $this->validate_subject_msg() === true &&
                $this->validate_msg() === true
            ) {
                return true;
            }
        }

        if (isset($this->post_data['employee_to_hr'])) {
            if (
                $this->validate_from() === true &&
                $this->validate_to() === true &&
                $this->validate_subject_msg() === true &&
                $this->validate_msg() === true
            ) {
                return true;
            }
        }

        if (isset($this->post_data['company_to_hr'])) {
            if (
                $this->validate_from() === true &&
                $this->validate_to() === true &&
                $this->validate_subject_msg() === true &&
                $this->validate_msg() === true
            ) {
                return true;
            }
        }
    }

    // Empty input
    private function empty_field($value)
    {
        if (empty(trim($value))) {
            return true;
        }
    }

    // NEW length counter
    private function string_length($value, $min = null, $max = null)
    {
        if (mb_strlen(trim($value)) < $min || mb_strlen(trim($value)) > $max) {
            return true;
        }
    }

    // Input string length
    private function count_symbols_input($value, $min = null)
    {
        if (mb_strlen(trim($value)) < $min || mb_strlen(trim($value)) > 49) {
            return true;
        }
    }

    // Textarea string length
    private function count_symbols_textarea($value, $min = null)
    {
        if (mb_strlen(trim($value)) < $min || mb_strlen(trim($value)) > 999) {
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

    // Branch validation on update
    private function validate_branch()
    {
        if (
            empty($this->post_data['frontend']) &&
            empty($this->post_data['backend']) &&
            empty($this->post_data['fullstack']) &&
            empty($this->post_data['qa']) &&
            empty($this->post_data['mobdev']) &&
            empty($this->post_data['ux/ui'])
        ) {
            return false;
        } else {
            return true;
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

    // Security when appling to job
    private function existing_published_job_random_chars()
    {
        global $pdo;
        $data = [
            ':id' => $this->post_data['job_id'],
            ':random_chars' => $this->post_data['random_chars']
        ];
        $sql = ("SELECT id, random_chars FROM tb_published_jobs WHERE id=:id AND random_chars=:random_chars LIMIT 1");
        $stmt = $pdo->prepare_query($sql, $data);
        $result = $stmt->rowCount();
        return $result;
    }

    private function has_employee_applied()
    {
        global $pdo;
        $data = [
            ':job_id' => $this->post_data['job_id'],
            ':job_seeker_id' => $this->post_data['job_seeker_id'],
            ':is_applied' => $this->post_data['is_applied']
        ];
        $sql = ("SELECT * FROM tb_applied_jobs WHERE job_id=:job_id AND job_seeker_id=:job_seeker_id AND is_applied=:is_applied");
        $stmt = $pdo->prepare_query($sql, $data);
        $result = $stmt->rowCount();
        return $result;
    }
}
