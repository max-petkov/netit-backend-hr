<?php include_once 'src/Jobs.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/css/custom.css">
  <title>👾Monster HR</title>
</head>

<body>
  <!-- Showcase -->
  <header>
    <nav class="navbar shadow-custom-navbar flex-wrap navbar-expand py-3 mb-5">
      <div class="container">
        <a href="homepage-company.php" class="calistoga-font navbar-brand text-dark fw-bold">Monster HR</a>
        <ul class="navbar-nav align-items-center d-flex">
          <li class="me-3">
            <a href="login.php" class="text-dark text-decoration-none fw-bold">Login</a>
          </li>
          <li>
            <a href="registration-form-company.php" class="btn btn-outline-primary">Create account</a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-md-6">
          <nav class="navbar navbar-expand my-4">
            <ul class="navbar-nav align-items-center justify-content-center">
              <li class="me-4">
                <a href="homepage-employee.php" class="text-decoration-none">Find a job</a>
              </li>
              <li>
                <a href="homepage-company.php" class="fw-bold fs-5">Hire a professional</a>
              </li>
            </ul>
          </nav>
          <h1 class="display-4">Find your perfect candidate</h1>
          <p class="lead mb-4">Cras convallis ultricies lacus ac lacinia. Curabitur lacinia, lacus interdum sollicitudin iaculis, dolor libero aliquet neque</p>
          <a href="login.php" class="btn btn-primary px-4 py-2">Find a professional</a>
        </div>
        <div class="d-none d-md-block col-md-6">
          <img src="assets/img/img-homepage-company.jpg" alt="success-image" class="img-fluid">
        </div>
      </div>
      <hr class="my-5">
    </div>
  </header>

  <!-- Card published jobs -->
  <div id="cards-job-container">
    <div class="d-flex justify-content-center flex-wrap">
      <div class="card mx-0 me-2 mx-sm-2 mt-4 mt-md-3">
        <div class="card-body p-2">
          <div class="card-title text-center">Frontend</div>
          <div class="card">
            <div class="card-body p-2">
              <div class="card-subttile text-center small">Published jobs:</div>
              <div class="card-subtitle text-center fw-bold"><?php Job::count_published_job_tags('frontend_tag', 'frontend'); ?></div>
            </div>
          </div>
        </div>
      </div>
      <div class="card mx-0 me-2 mx-sm-2 mt-4 mt-md-3">
        <div class="card-body p-2">
          <div class="card-title text-center">Backend</div>
          <div class="card">
            <div class="card-body p-2">
              <div class="card-subttile text-center small">Published jobs:</div>
              <div class="card-subtitle text-center fw-bold"><?php Job::count_published_job_tags('backend_tag', 'backend'); ?></div>
            </div>
          </div>
        </div>
      </div>
      <div class="card mx-0 me-2 mx-sm-2 mt-4 mt-md-3">
        <div class="card-body p-2">
          <div class="card-title text-center">Fullstack</div>
          <div class="card">
            <div class="card-body p-2">
              <div class="card-subttile text-center small">Published jobs:</div>
              <div class="card-subtitle text-center fw-bold"><?php Job::count_published_job_tags('fullstack_tag', 'fullstack'); ?></div>
            </div>
          </div>
        </div>
      </div>
      <div class="card mx-0 me-2 mx-sm-2 mt-4 mt-md-3">
        <div class="card-body p-2">
          <div class="card-title text-center">QA</div>
          <div class="card">
            <div class="card-body p-2">
              <div class="card-subttile text-center small">Published jobs:</div>
              <div class="card-subtitle text-center fw-bold"><?php Job::count_published_job_tags('qa_tag', 'qa'); ?></div>
            </div>
          </div>
        </div>
      </div>
      <div class="card mx-0 me-2 mx-sm-2 mt-4 mt-md-3">
        <div class="card-body p-2">
          <div class="card-title text-center">MobDev</div>
          <div class="card">
            <div class="card-body p-2">
              <div class="card-subttile text-center small">Published jobs:</div>
              <div class="card-subtitle text-center fw-bold"><?php Job::count_published_job_tags('mobdev_tag', 'mobdev'); ?></div>
            </div>
          </div>
        </div>
      </div>
      <div class="card mx-0 me-2 mx-sm-2 mt-4 mt-md-3">
        <div class="card-body p-2">
          <div class="card-title text-center">UX/UI</div>
          <div class="card">
            <div class="card-body p-2">
              <div class="card-subttile text-center small">Published jobs:</div>
              <div class="card-subtitle text-center fw-bold"><?php Job::count_published_job_tags('ux_ui_tag', 'ux/ui'); ?></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr class="my-4">
  </div>

  <!-- Used languages -->
  <section class="bg-dark py-5">
    <div class="container">
      <h3 class="fs-3 text-white text-underline text-center"><i>Platform made with:</i></h3>
      <div class="d-flex flex-wrap justify-content-center align-items-center">
        <div class="mx-2 mt-2 mt-md-0">
          <img src="assets/icons/html5-brands.svg" alt="" width="48px" height="64px" class="svg-bg-color">
        </div>
        <div class="mx-2 mt-2 mt-md-0">
          <img src="assets/icons/css3-alt-brands.svg" alt="" width="48px" height="64px" class="svg-bg-color">
        </div>
        <div class="mx-2 mt-2 mt-md-0">
          <img src="assets/icons/sass-brands.svg" alt="" width="64px" height="64px" class="svg-bg-color">
        </div>
        <div class="mx-2 mt-2 mt-md-0">
          <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#fff" class="bi bi-bootstrap" viewBox="0 0 16 16">
            <path d="M5.062 12h3.475c1.804 0 2.888-.908 2.888-2.396 0-1.102-.761-1.916-1.904-2.034v-.1c.832-.14 1.482-.93 1.482-1.816 0-1.3-.955-2.11-2.542-2.11H5.062V12zm1.313-4.875V4.658h1.78c.973 0 1.542.457 1.542 1.237 0 .802-.604 1.23-1.764 1.23H6.375zm0 3.762V8.162h1.822c1.236 0 1.887.463 1.887 1.348 0 .896-.627 1.377-1.811 1.377H6.375z" />
            <path d="M0 4a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4v8a4 4 0 0 1-4 4H4a4 4 0 0 1-4-4V4zm4-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V4a3 3 0 0 0-3-3H4z" />
          </svg>
        </div>
        <div class="mx-2 mt-2 mt-md-0">
          <img src="assets/icons/js-square-brands.svg" alt="" width="48px" height="64px" class="svg-bg-color">
        </div>
        <div class="mx-2 mt-2 mt-md-0">
          <img src="assets/icons/jquery-brand.svg" alt="" width="64px" height="64px" class="svg-bg-color">
        </div>
        <div class="mx-2 mt-2 mt-md-0">
          <img src="assets/icons/php-brands.svg" alt="" width="80px" height="64px" class="svg-bg-color">
        </div>
        <div class="mx-2 mt-2 mt-md-0 display-6 text-center text-white">
          <img src="assets/icons/database-solid.svg" alt="" width="48px" height="48px" class="svg-bg-color">
          <p class="fs-6 m-0">MySQL</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Team -->
  <section class="py-5">
    <div class="container">
      <h1 class="text-center mt-5">Meet the Creators</h1>
      <p class="text-center lead mx-auto mb-5">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quasi iusto dignissimos eius iste maxime ullam placeat vitae porro unde </p>
      <div class="row mb-5 justify-content-center">
        <div class="col-lg-3 col-md-6">
          <div class="card pt-4 pb-2">
            <img class="img-fluid rounded-circle mx-auto shadow-sm rounded" src="assets/img/profifle-pic.jpg" alt="profile-pic">
            <div class="card-body">
              <h3 class="text-center">Jon Doe</h3>
              <h5 class="text-muted text-center">Frontend Developer</h5>
              <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem ullam, suscipit quod ea non beatae. Lorem ipsum dolor sit amet.</p>
              <div class="social-links-card">
                <span><a href="https://www.facebook.com" target="_blank"><i class="fs-4 bi bi-facebook"></i></a></span>
                <span><a href="https://www.instagram.com" target="_blank"><i class="fs-4 ms-3 bi bi-instagram"></i></a></span>
                <span><a href="mailto:maxy.dp@abv.bg"><i class="fs-4 ms-3 bi bi-envelope"></i></a></span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 ">
          <div class="card pt-4 pb-2 mt-4 mt-sm-4 mt-md-0">
            <img class="img-fluid rounded-circle mx-auto shadow-sm rounded" src="assets/img/profifle-pic.jpg" alt="profile-pic">
            <div class="card-body">
              <h3 class="text-center">Jordan King</h3>
              <h5 class="text-muted text-center">Backend Developer</h5>
              <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem ullam, suscipit quod ea non beatae. Lorem ipsum dolor sit amet.</p>
              <div class="social-links-card">
                <span><a href="https://www.facebook.com" target="_blank"><i class="fs-4 bi bi-facebook"></i></a></span>
                <span><a href="https://www.instagram.com" target="_blank"><i class="fs-4 ms-3 bi bi-instagram"></i></a></span>
                <span><a href="mailto:maxy.dp@abv.bg"><i class="fs-4 ms-3 bi bi-envelope"></i></a></span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="card pt-4 pb-2 mt-4 mt-sm-4 mt-md-4 mt-lg-0">
            <img class="img-fluid rounded-circle mx-auto shadow-sm rounded" src="assets/img/profifle-pic.jpg" alt="profile-pic">
            <div class="card-body">
              <h3 class="text-center">Susam Williams</h3>
              <h5 class="text-muted text-center">Quality Assurance</h5>
              <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem ullam, suscipit quod ea non beatae. Lorem ipsum dolor sit amet.</p>
              <div class="social-links-card">
                <span><a href="https://www.facebook.com" target="_blank"><i class="fs-4 bi bi-facebook"></i></a></span>
                <span><a href="https://www.instagram.com" target="_blank"><i class="fs-4 ms-3 bi bi-instagram"></i></a></span>
                <span><a href="mailto:maxy.dp@abv.bg"><i class="fs-4 ms-3 bi bi-envelope"></i></a></span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="card pt-4 pb-2 mt-4 mt-sm-4 mt-md-4 mt-lg-0">
            <img class="img-fluid rounded-circle mx-auto shadow-sm rounded" src="assets/img/profifle-pic.jpg" alt="profile-pic">
            <div class="card-body">
              <h3 class="text-center">Frank Sifuentes</h3>
              <h5 class="text-muted text-center">UX/UI</h5>
              <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem ullam, suscipit quod ea non beatae. Lorem ipsum dolor sit amet.</p>
              <div class="social-links-card">
                <span><a href="https://www.facebook.com" target="_blank"><i class="fs-4 bi bi-facebook"></i></a></span>
                <span><a href="https://www.instagram.com" target="_blank"><i class="fs-4 ms-3 bi bi-instagram"></i></a></span>
                <span><a href="mailto:maxy.dp@abv.bg"><i class="fs-4 ms-3 bi bi-envelope"></i></a></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <footer class="bg-dark text-white py-4 mt-5">
    <div class="container">
      <p class="text-center text-white m-0">Made with ❤ by Maximilian Petkov</p>
      <hr class="mx-auto my-1" width="256px">
      <p class="text-center mb-0"><a href="mailto:maxy.dp@abv.bg" class="text-decoration-none text-white">maxy.dp@abv.bg</a></p>
    </div>
  </footer>
</body>

</html>