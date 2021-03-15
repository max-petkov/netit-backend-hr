<?php include 'src/validation-register-form-company.php'; ?>
<?php include 'src/database.php'; ?>
<?php include_once 'src/functions.php'; ?>
<?php include 'src/sessions.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/custom.css">
  <title>Register | Company</title>
</head>
<body>
  <nav class="navbar shadow-custom-navbar navbar-expand-sm py-3 mb-5">
    <div class="container">
      <a href="homepage-company.php" class="navbar-brand text-dark fw-bold">Monster HR</a>
      <ul class="navbar-nav align-items-center">
        <li class="me-3">
          <a href="login.php" class="text-dark text-decoration-none fw-bold">Login</a>
        </li>
        <li>
          <a href="registration-form-employee.php" class="btn btn-outline-primary">Create account</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container">
    <div class="row">
      <div class="col-lg-5 col-md-6 mx-auto">
        <div class="d-flex mb-4 align-items-center">
          <i class=""><a href="registration-form-employee.php" class="text-decoration-none">Candidate</a></i>
          <i class="fs-5 fw-bold ms-4"><a href="registration-form-company.php">Company</a></i>
        </div>
        <form action="registration-form-company.php" method="POST">
        <?php echo success_message(); ?>
          <h4 class="text-center">For Companies</h4>
          <p class="text-muted text-center mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, mollitia!</p>
          <div class="form-group mb-3">
            <input type="text" class="form-control <?php echo $success_input_class_company_username; echo $error_input_class_company_username; ?>" name="company_username" placeholder="Username" value="<?php echo $input_value_company_username ?>">
            <?php echo $error_message_company_username; ?>
            <?php echo $success_message_company_username; ?>
          </div>
          <div class="form-group mb-3">
            <input type="text" class="form-control <?php echo $success_input_class_company_name; echo $error_input_class_company_name; ?>" name="company_name" placeholder="Company Name" value="<?php echo $input_value_company_name; ?>">
            <?php echo $error_message_company_name; ?>
            <?php echo $success_message_company_name; ?>
          </div>
          <div class="form-group mb-3">
            <input type="email" class="form-control <?php echo $success_input_class_email; echo $error_input_class_email; ?>" name="email" placeholder="Email" value="<?php echo $input_value_company_email; ?>">
            <?php echo $error_message_email; ?>
            <?php echo $success_message_email; ?>
          </div>
          <div class="form-group mb-3">
            <h4>IT Branches:</h4>
            <div class="form-check mb-2">
              <input type="checkbox" class="form-check-input <?php echo $success_class_check_front_end; ?>" name="it_branch[]" value="Front-end Development" <?php echo $success_check_front_end; ?>>
              <label class="form-check-label" for="it_branch">Front-end Development</label>
            </div>
            <div class="form-check mb-2">
              <input type="checkbox" class="form-check-input <?php echo $success_class_check_back_end; ?>" name="it_branch[]" value="Back-end Development" <?php echo $success_check_back_end; ?>>
              <label class="form-check-label" for="it_branch">Back-end Development</label>
            </div>
            <div class="form-check mb-2">
              <input type="checkbox" class="form-check-input <?php echo $success_class_check_fullstack; ?>" name="it_branch[]" value="Fullstack Development" <?php echo $success_check_fullstack; ?>>
              <label class="form-check-label" for="it_branch">Fullstack Development</label>
            </div>
            <div class="form-check mb-2">
              <input type="checkbox" class="form-check-input <?php echo $success_class_check_qa; ?>" name="it_branch[]" value="Quality Assurance" <?php echo $success_check_qa; ?>>
              <label class="form-check-label" for="it_branch">Quality Assurance</label>
            </div>
            <div class="form-check mb-2">
              <input type="checkbox" class="form-check-input <?php echo $success_class_check_mob_dev; ?>" name="it_branch[]" value="Mobile Development" <?php echo $success_check_mob_dev; ?>>
              <label class="form-check-label" for="it_branch">Mobile Development</label>
            </div>
            <div class="form-check mb-2">
              <input type="checkbox" class="form-check-input <?php echo $success_class_check_ux_ui; ?>" name="it_branch[]" value="UX/UI" <?php echo $success_check_ux_ui; ?>>
              <label class="form-check-label" for="it_branch">UX/UI</label>
            </div>
            <?php echo $error_message_company_branch; ?>
          </div>
          <div class="form-group mb-3">
            <textarea class="form-control <?php echo $success_input_class_company_description; echo $error_input_class_company_description; ?>" name="company_description" id="company_description" rows="5" placeholder="Company Description"><?php echo $input_value_company_description; ?></textarea>
            <?php echo $error_message_company_description; ?>
            <?php echo $success_message_company_description; ?>
          </div>
          <div class="form-group mb-3">
            <input type="password" class="form-control <?php echo $success_input_class_password; echo $error_input_class_password; ?>" name="password" placeholder="Password" value="<?php echo $input_value_password; ?>">
            <?php echo $error_message_password; ?>
            <?php echo $success_message_password; ?>
          </div>
          <div class="form-group">
            <input type="password" class="form-control <?php echo $success_input_class_confirm_password; echo $error_input_class_confirm_password; ?>" name="confirm_password" placeholder="Confirm Password" value="<?php echo $input_value_confirm_password; ?>">
            <?php echo $error_message_confirm_password; ?>
            <?php echo $success_message_confirm_password; ?>
          </div>
          <div class="d-grid col-6 mx-auto">
            <input type="submit" name="submit_registration_company" class="btn btn-primary mt-4">
          </div>
          <p class="small text-center mt-3">Already have an account? Login <a href="login.php">here</a></p>
        </form>
      </div>
    </div>
  </div>
  <footer class="bg-dark text-white p-4 mt-5">
    <div class="container">
      <p class="text-center text-white m-0">PLATFORM MADE BY ...  WITH ... :</p>
    </div>
  </footer>
</body>
</html>