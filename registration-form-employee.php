<?php include 'src/validation-register-form-employee.php'; ?>
<?php include 'src/database.php'; ?>
<?php include 'src/sessions.php'; ?>
<?php include_once 'src/functions.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/css/custom.css">
  <title>Register | Employee</title>
</head>
<body>
  <nav class="navbar shadow-custom-navbar navbar-expand-sm py-3 mb-5">
    <div class="container">
      <a href="homepage-employee.php" class="calistoga-font navbar-brand text-dark fw-bold">Monster HR</a>
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
          <i class="fs-5 fw-bold me-4"><a href="registration-form-employee.php">Candidate</a></i>
          <i><a href="registration-form-company.php" class="text-decoration-none">Company</a></i>
        </div>
        <form action="registration-form-employee.php" class="mt-5" method="POST">
          <?php echo success_message(); ?>
          <h4 class="text-center">For Employees</h4>
          <p class="text-muted text-center mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, mollitia!</p>
          <div class="form-group mb-3">
            <input type="text" class="form-control <?php echo $success_input_class_username; echo $error_input_class_username; ?>" name="employee_username" placeholder="Username" value="<?php echo $input_value_employee_username ?>">
            <?php echo $error_message_username; ?>
            <?php echo $success_message_username; ?>
          </div>
          <div class="form-group mb-3">
            <input type="text" class="form-control <?php echo $success_input_class_first_name; echo $error_input_class_first_name; ?>" name="first_name" placeholder="First Name" value="<?php echo $input_value_employee_first_name; ?>">
            <?php echo $error_message_first_name; ?>
            <?php echo $success_message_first_name; ?>
          </div>
          <div class="form-group mb-3">
            <input type="text" class="form-control <?php echo $success_input_class_last_name; echo $error_input_class_last_name; ?>" name="last_name" placeholder="Last Name" value="<?php echo $input_value_employee_last_name; ?>">
            <?php echo $error_message_last_name; ?>
            <?php echo $success_message_last_name; ?>
          </div>
          <div class="form-group mb-3">
            <input type="email" class="form-control <?php echo $success_input_class_email; echo $error_input_class_email; ?>" name="email" placeholder="Email" value="<?php echo $input_value_employee_email; ?>">
            <?php echo $error_message_email; ?>
            <?php echo $success_message_email; ?>
          </div>
          <div class="form-group mb-3">
            <input type="password" class="form-control <?php echo $success_input_class_password; echo $error_input_class_password; ?>" name="password" placeholder="Password" value="<?php echo $input_value_employee_password; ?>">
            <?php echo $error_message_password; ?>
            <?php echo $success_message_password; ?>
          </div>
          <div class="form-group mb-4">
            <input type="password" class="form-control <?php echo $success_input_class_confirm_password; echo $error_input_class_confirm_password; ?>" name="confirm_password" placeholder="Confirm Password" value="<?php echo $input_value_employee_confirm_password; ?>">
            <?php echo $error_message_confirm_password; ?>
            <?php echo $success_message_confirm_password; ?>
          </div>
          <div class="d-grid col-6 mx-auto">
            <input type="submit" name="submit_registration" class="btn btn-primary px-4">
          </div>
          <p class="small text-center mt-3">Already have an account? Login <a href="login.php">here</a></p>
        </form>
      </div>
    </div>
  </div>
  <footer class="bg-dark text-white py-4 mt-5">
    <div class="container">
      <p class="text-center text-white m-0">Made with ❤ by Maximilian Petkov</p>
      <hr class="mx-auto my-1" width="256px">
      <p class="text-center mb-0"><a href="mailto:maxy.dp@abv.bg"
          class="text-decoration-none text-white">maxy.dp@abv.bg</a></p>
    </div>
  </footer>
</body>
</html>