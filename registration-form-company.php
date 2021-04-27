<?php include 'src/create-profile.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/css/custom.css">
  <title>👾Register | Company</title>
</head>

<body>
  <nav class="navbar shadow-custom-navbar navbar-expand-sm py-3 mb-5">
    <div class="container">
      <a href="homepage-company.php" class="calistoga-font navbar-brand text-dark fw-bold">Monster HR</a>
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
          <h4 class="text-center">For Companies</h4>
          <p class="text-muted text-center mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, mollitia!</p>
          <div class="form-group mb-3">
            <input type="text" class="form-control <?php echo $check->style_input['username'] ?? ''; ?>" name="username" placeholder="Username" value="<?php echo $_POST['username'] ?? ''; ?>">
            <?php echo $check->error_msg['username'] ?? ''; ?>
            <?php echo $check->succ_msg['username'] ?? ''; ?>
          </div>
          <div class="form-group mb-3">
            <input type="text" class="form-control <?php echo $check->style_input['name'] ?? ''; ?>" name="name" placeholder="Company Name" value="<?php echo $_POST['name'] ?? ''; ?>">
            <?php echo $check->error_msg['name'] ?? ''; ?>
            <?php echo $check->succ_msg['name'] ?? ''; ?>
          </div>
          <div class="form-group mb-3">
            <input type="email" class="form-control <?php echo $check->style_input['email'] ?? ''; ?>" name="email" placeholder="Email" value="<?php echo $_POST['email'] ?? ''; ?>">
            <?php echo $check->error_msg['email'] ?? ''; ?>
            <?php echo $check->succ_msg['email'] ?? ''; ?>
          </div>
          <div class="form-group mb-3">
            <h4>IT Branches:</h4>
            <div class="form-check mb-2">
              <input type="checkbox" class="form-check-input <?php echo $check->style_input['frontend'] ?? ''; ?>" name="frontend" value="frontend" <?php echo $check->check_box['frontend'] ?? ''; ?>>
              <label class="form-check-label" for="it_branch">Front-end Development</label>
            </div>
            <div class="form-check mb-2">
              <input type="checkbox" class="form-check-input <?php echo $check->style_input['backend'] ?? ''; ?>" name="backend" value="backend" <?php echo $check->check_box['backend'] ?? ''; ?>>
              <label class="form-check-label" for="it_branch">Back-end Development</label>
            </div>
            <div class="form-check mb-2">
              <input type="checkbox" class="form-check-input <?php echo $check->style_input['fullstack'] ?? ''; ?>" name="fullstack" value="fullstack" <?php echo $check->check_box['fullstack'] ?? ''; ?>>
              <label class="form-check-label" for="it_branch">Fullstack Development</label>
            </div>
            <div class="form-check mb-2">
              <input type="checkbox" class="form-check-input <?php echo $check->style_input['qa'] ?? ''; ?>" name="qa" value="qa" <?php echo $check->check_box['qa'] ?? ''; ?>>
              <label class="form-check-label" for="it_branch">Quality Assurance</label>
            </div>
            <div class="form-check mb-2">
              <input type="checkbox" class="form-check-input <?php echo $check->style_input['mobdev'] ?? ''; ?>" name="mobdev" value="mobdev" <?php echo $check->check_box['mobdev'] ?? ''; ?>>
              <label class="form-check-label" for="it_branch">Mobile Development</label>
            </div>
            <div class="form-check mb-2">
              <input type="checkbox" class="form-check-input <?php echo $check->style_input['ux/ui'] ?? ''; ?>" name="ux/ui" value="ux/ui" <?php echo $check->check_box['ux/ui'] ?? ''; ?>>
              <label class="form-check-label" for="it_branch">UX/UI</label>
            </div>
            <?php echo $error['branch'] ?? ''; ?>
            <?php echo $check->error_msg['branch'] ?? ''; ?>
          </div>
          <div class="form-group mb-3">
            <textarea class="form-control <?php echo $check->style_input['description'] ?? ''; ?>" name="company_description" id="company_description" rows="5" placeholder="Company Description"><?php echo $_POST['company_description'] ?? ''; ?></textarea>
            <?php echo $check->error_msg['description'] ?? ''; ?>
            <?php echo $check->succ_msg['description'] ?? ''; ?>
          </div>
          <div class="form-group mb-3">
            <input type="password" class="form-control <?php echo $check->style_input['password'] ?? ''; ?>" name="password" placeholder="Password" value="<?php echo $_POST['password'] ?? ''; ?>">
            <?php echo $check->error_msg['password'] ?? ''; ?>
            <?php echo $check->succ_msg['password'] ?? ''; ?>
          </div>
          <div class="form-group">
            <input type="password" class="form-control <?php echo $check->style_input['confirm_password'] ?? ''; ?>" name="confirm_password" placeholder="Confirm Password" value="<?php echo $_POST['confirm_password'] ?? ''; ?>">
            <?php echo $check->error_msg['confirm_password'] ?? ''; ?>
            <?php echo $check->succ_msg['confirm_password'] ?? ''; ?>
          </div>
          <div class="d-grid col-6 mx-auto">
            <input type="submit" name="register_company" class="btn btn-primary mt-4">
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