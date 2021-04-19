<?php include 'src/create-profile.php'; ?>

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
          <h4 class="text-center">For Employees</h4>
          <p class="text-muted text-center mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, mollitia!</p>
          <div class="form-group mb-3">
            <input type="text" class="form-control <?php echo $validator->style_input['username'] ?? ''; ?>" name="username" placeholder="Username" value="<?php echo $_POST['username'] ?? ''; ?>">
            <?php echo $validator->error_msg['username'] ?? ''; ?>
            <?php echo $validator->succ_msg['username'] ?? ''; ?>
          </div>
          <div class="form-group mb-3">
            <input type="text" class="form-control <?php echo $validator->style_input['name'] ?? ''; ?>" name="name" placeholder="First Name" value="<?php echo $_POST['name'] ?? ''; ?>">
            <?php echo $validator->error_msg['name'] ?? ''; ?>
            <?php echo $validator->succ_msg['name'] ?? ''; ?>
          </div>
          <div class="form-group mb-3">
            <input type="text" class="form-control <?php echo $validator->style_input['last_name'] ?? ''; ?>" name="last_name" placeholder="Last Name" value="<?php echo $_POST['last_name'] ?? ''; ?>">
            <?php echo $validator->error_msg['last_name'] ?? ''; ?>
            <?php echo $validator->succ_msg['last_name'] ?? ''; ?>
          </div>
          <div class="form-group mb-3">
            <input type="email" class="form-control <?php echo $validator->style_input['email'] ?? ''; ?>" name="email" placeholder="Email" value="<?php echo $_POST['email'] ?? ''; ?>">
            <?php echo $validator->error_msg['email'] ?? ''; ?>
            <?php echo $validator->succ_msg['email'] ?? ''; ?>
          </div>
          <div class="form-group mb-3">
            <input type="password" class="form-control <?php echo $validator->style_input['password'] ?? ''; ?>" name="password" placeholder="Password" value="<?php echo $_POST['password'] ?? ''; ?>">
            <?php echo $validator->error_msg['password'] ?? ''; ?>
            <?php echo $validator->succ_msg['password'] ?? ''; ?>
          </div>
          <div class="form-group mb-4">
            <input type="password" class="form-control <?php echo $validator->style_input['confirm_password'] ?? ''; ?>" name="confirm_password" placeholder="Confirm Password" value="<?php echo $_POST['confirm_password'] ?? ''; ?>">
            <?php echo $validator->error_msg['confirm_password'] ?? ''; ?>
            <?php echo $validator->succ_msg['confirm_password'] ?? ''; ?>
          </div>
          <div class="d-grid col-6 mx-auto">
            <input type="submit" name="register_employee" class="btn btn-primary px-4">
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
      <p class="text-center mb-0"><a href="mailto:maxy.dp@abv.bg" class="text-decoration-none text-white">maxy.dp@abv.bg</a></p>
    </div>
  </footer>
</body>

</html>