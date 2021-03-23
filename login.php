<?php include 'src/database.php' ?>
<?php include_once 'src/sessions.php' ?>
 

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/css/custom.css">
  <title>Login | Monster HR</title>
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
      <div class="col-lg-4 col-md-6 mx-auto">
        <h3 class="text-center mb-3">Monster HR</h3>
        <form action="login.php" class="" method="POST">
        <?php echo success_message(); ?>
        <?php echo error_message(); ?>
          <div class="form-group mb-3">
            <input type="text" class="form-control" name="username" placeholder="Username" value="">
          </div>
          <div class="form-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password" value="">
            </div>
            <div class="d-grid col-6 mx-auto">
              <input type="submit" name="submit_login" class="btn btn-primary" value="Login">
            </div>
          </form>
        <p class="small text-center mt-3">Dont't have an account? Create one as <a href="registration-form-employee.php">Candidate</a> or as <a href="registration-form-company.php">Company</a></p>
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