<!-- Database is needed because to get the id sessian value and make logout and login required session -->
<?php include 'src/database.php'; ?>
<?php include_once 'src/functions.php'; ?>
<?php login_required($_SESSION['employee_id']); ?>

<!DOCTYPE html>
<html lang="en">
 
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/css/custom.css">
  <title>Monster HR | Dashboard</title>
</head>

<body>
  <!-- Navigation bar -->
  <nav class="navbar navbar-dark bg-dark navbar-expand">
    <div class="container flex-column flex-sm-row">
      <p class="calistoga-font navbar-brand text-white mb-0">Monster HR</p>
      <div class="d-flex">
        <!-- Collapse dropdown -->
        <div class="collapse navbar-collapse justify-content-end">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <span id="greetings"></span> <span id="greetings_first_name"></span>
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                <li class="dropdown-item xsm-text-class text-center">Your are logged in as<br><b id="employee_username" class="xsm-text-class"></b>
                </li>
                <div class="dropdown-divider"></div>
                <li id="profile_button">
                  <a class="dropdown-item xsm-text-class" href="#">Edit Profile</a>
                </li>
                <li>
                  <a class="message_icon dropdown-item xsm-text-class" href="#">Messages<span class="badge rounded-pill bg-danger ms-1">3</span>
                  </a>
                </li>
                <li id="addplication_button">
                  <a class="dropdown-item xsm-text-class" href="#">Applications</a>
                </li>

                <li>
                  <a class="dropdown-item xsm-text-class d-flex align-items-center" href="#">
                    <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                      <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                      <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                    </svg>
                    Resume
                  </a>
                </li>
                <div class="dropdown-divider"></div>

                <li class="dropdown-item xsm-text-class d-flex align-items-center">
                  <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                  </svg>
                  <span id="employee_first_name" class="me-1"></span><span id="employee_last_name"></span>
                </li>
                <li class="dropdown-item xsm-text-class d-flex align-items-center">
                  <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                    <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
                    <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                  </svg>
                  <span id="employee_address"></span>
                </li>
                <li class="dropdown-item xsm-text-class d-flex align-items-center">
                  <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z" />
                  </svg>
                  <span id="employee_email"></span>
                </li>
                <li class="dropdown-item xsm-text-class d-flex align-items-center">
                  <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link-45deg" viewBox="0 0 16 16">
                    <path d="M4.715 6.542L3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.001 1.001 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z" />
                    <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 0 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 0 0-4.243-4.243L6.586 4.672z" />
                  </svg>
                  <a href="#" target="_blank" class="text-decoration-none" id="employee_website"></a>
                </li>
                <div class="dropdown-divider"></div>
                <li id="profile_button">
                  <a id="logout_employee" class="dropdown-item xsm-text-class d-flex align-items-center" href="src/logout.php">
                    <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                      <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                    </svg>
                    <b>Logout</b>
                  </a>
                </li>
                <div class="dropdown-divider"></div>
                <li class="dropdown-item xsm-text-class d-flex align-items-center justify-content-center">
                  <span id="date_time">

                  </span>
                </li>
              </ul>
            </li>
          </ul>
        </div>

        <!-- message icon -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="#" class="message_icon nav-link d-flex align-items-center">
              <svg id="envelope_close" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="me-1 envelope_closed bi bi-envelope" viewBox="0 0 16 16">
                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z" />
              </svg>
              <svg id="envelope_open" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="me-1 d-none bi bi-envelope-open" viewBox="0 0 16 16">
                <path d="M8.47 1.318a1 1 0 0 0-.94 0l-6 3.2A1 1 0 0 0 1 5.4v.818l5.724 3.465L8 8.917l1.276.766L15 6.218V5.4a1 1 0 0 0-.53-.882l-6-3.2zM15 7.388l-4.754 2.877L15 13.117v-5.73zm-.035 6.874L8 10.083l-6.965 4.18A1 1 0 0 0 2 15h12a1 1 0 0 0 .965-.738zM1 13.117l4.754-2.852L1 7.387v5.73zM7.059.435a2 2 0 0 1 1.882 0l6 3.2A2 2 0 0 1 16 5.4V14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5.4a2 2 0 0 1 1.059-1.765l6-3.2z" />
              </svg>
              <span class="badge bg-danger rounded-pill">3</span>
            </a>
          </li>
        </ul>

      </div>


    </div>
  </nav>

  <!-- Message container -->


  <div class="card shadow-lg p-3 mb-5 bg-body rounded message_box d-none">
    <div class="d-flex justify-content-between mt-3 mb-2 px-3">
      <h4 class="m-0">Messages:</h4>
      <button class="btn-close align-self-end"></button>
    </div>

    <div class="card-body">
      <ul class="list-group-flush p-0 pt-3">
        <li class="list-group-item pb-0">
          <div class="d-flex justify-content-between align-items-center">
            <p class="text-muted small">sent by <b class="text-dark">Medics Prosperity</b></p>
            <p class="small">03.13.2021</p>
          </div>
          <div class="chevron_btn d-flex justify-content-between align-items-start">
            <p><b>Theme:</b> Lorem ipsum dolor sit amet consectetur adipisicing elit. A, saepe.</p>
            <span class="ms-1">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
              </svg>
            </span>
          </div>
          <p class="chevron-expand-text">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae veniam beatae, quibusdam, est ex itaque
            accusantium ea aut similique impedit vel, ullam cupiditate odio! Sequi.
          </p>
        </li>
        <li class="list-group-item pb-0">
          <div class="d-flex justify-content-between align-items-center">
            <p class="text-muted small">sent by <b class="text-dark">Family Studio</b></p>
            <p class="small">03.13.2021</p>
          </div>
          <div class="chevron_btn d-flex justify-content-between align-items-start">
            <p><b>Theme:</b> Lorem ipsum dolor sit amet consectetur adipisicing elit. A, saepe.</p>
            <span class="ms-1">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
              </svg>
            </span>
          </div>
          <p class="chevron-expand-text">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex quasi eveniet nobis maxime eos reprehenderit
            neque quibusdam! Labore commodi error illum laborum, rerum praesentium sint?
          </p>
        </li>
        <li class="list-group-item pb-0">
          <div class="d-flex justify-content-between align-items-center">
            <p class="text-muted small">sent by <b class="text-dark">Artromedika</b></p>
            <p class="small">03.13.2021</p>
          </div>
          <div class="chevron_btn d-flex justify-content-between align-items-start">
            <p><b>Theme:</b> Lorem ipsum dolor sit amet consectetur adipisicing elit. A, saepe.</p>
            <span class="ms-1">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
              </svg>
            </span>
          </div>
          <p class="chevron-expand-text">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex quasi eveniet nobis maxime eos reprehenderit
            neque quibusdam! Labore commodi error illum laborum, rerum praesentium sint?
          </p>
        </li>
      </ul>
    </div>

  </div>


  <!-- Applications -->
  <div class="card shadow-lg p-3 mb-5 bg-body rounded application_box d-none">
    <div class="d-flex justify-content-between mt-3 mb-2 px-3">
      <h4 class="m-0">Applications:</h4>
      <button class="btn-close align-self-end"></button>
    </div>
    <div class="card-body">
      <span class="small text-muted">
        03.10.2020 <b class="fs-6 text-dark">Artromedica</b>
      </span>
      <p class="mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores blanditiis a dolorum vel,
        molestias exercitationem.</p>
      <p><b>Salary:</b> 10 000 - 15 000$</p>
      <button class="btn btn-primary btn-sm d-flex align-items-center">
        <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
          <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
        </svg>
        Read more
      </button>
    </div>
    <hr class="m-2">

    <div class="card-body">
      <span class="small text-muted">
        03.10.2020 <b class="fs-6 text-dark">Family Studio</b>
      </span>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio obcaecati ab placeat perferendis expedita vel
        eligendi magni quidem ad, in minus, earum doloribus reprehenderit dicta.</p>
      <p><b>Salary:</b> 10 000 - 15 000$</p>
      <button class="btn btn-primary btn-sm d-flex align-items-center">
        <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
          <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
        </svg>
        Read more
      </button>
    </div>
    <hr class="m-2">

    <div class="card-body">
      <span class="small text-muted">
        03.10.2020 <b class="fs-6 text-dark">Medics Prosperity</b>
      </span>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio obcaecati ab placeat perferendis expedita vel
        eligendi magni quidem ad, in minus, earum doloribus reprehenderit dicta.</p>
      <p><b>Salary:</b> 10 000 - 15 000$</p>
      <button class="btn btn-primary btn-sm d-flex align-items-center">
        <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
          <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
        </svg>
        Read more
      </button>
    </div>
    <hr class="m-2">
  </div>

  <!-- Edit profile -->
  <div class="card d-none profile_box shadow-lg p-3 mb-5 bg-body rounded">
    <div class="d-flex justify-content-between px-0 mt-2">
      <div class="ms-3">
        <h4 class="card-text">Edit profile:</h4>
        <button name="submit_update" class="btn btn-primary btn-sm d-flex align-items-center">
          <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
          </svg>
          Update profile
        </button>
      </div>
      <button class="btn-close me-3"></button>
    </div>
    <div class="card-body">
      <form method="POST" class="row edit-profile pb-1">
        <div id="success_mess_validation"></div>
        <div class="form-group row mb-3 pe-0">
          <div class="form-group col-0 col-sm-6 pe-0 pe-sm-2">
            <label for="first_name">First name</label>
            <input type="text" class="successful-validation form-control form-control-sm" name="employee_first_name">
            <div></div>
          </div>
          <div class="form-group col-0 pe-0 col-sm-6">
            <label for="last_name">Last name</label>
            <input type="text" class="successful-validation form-control form-control-sm" name="employee_last_name">
            <div></div>
          </div>
        </div>

        <div class="form-group row mb-3 pe-0">
          <div class="form-group col-0 col-sm-6 pe-0 pe-sm-2">
            <label for="address_employee">Address</label>
            <input type="text" class="successful-validation form-control form-control-sm" name="address_employee">
            <div></div>
          </div>
          <div class="form-group col-0 col-sm-6 pe-0">
            <label for="website_employee">Website</label>
            <input type="text" class="successful-validation form-control form-control-sm" name="website_employee">
            <div></div>
          </div>
        </div>

        <div class="form-group row mb-3 pe-0">
          <div class="form-group col-0 col-sm-6 pe-0 pe-sm-2">
            <label for="username">Username</label>
            <input type="text" class="form-control form-control-sm" name="employee_username" disabled>
          </div>
          <div class="form-group col-0 col-sm-6 pe-0">
            <label for="email">Email</label>
            <input type="email" class="form-control form-control-sm" name="employee_email" disabled>
          </div>
        </div>

        <div class="form-group d-flex flex-column mb-3">
          <label for="resume" class="file">Attach resume:</label>
          <input type="file" class="form-control-file">
          <small class="form-text form-muted">Max 3mb size</small>
        </div>

        <div class="form-group">
          <label for="short_introduction_employee">Short introduction</label>
          <textarea name="short_introduction" class="successful-validation form-control form-control-sm" rows="6">
            <span id="textarea_default_text">- 👋 Hi, I’m ...
  - 👀 I’m interested in ...
  - 🌱 I’m currently learning ...
  - 💞️ I’m looking to collaborate on ...
  - 📫 How to reach me ...</span>
          </textarea>
          <div></div>
        </div>
      </form>
    </div>
  </div>

  <!-- Published jobs -->
  <section id="published-jobs">
    <div class="container">
      <h2 class="text-center mt-4">Latest jobs</h2>
      <!-- Cards job container -->
      <div id="cards-job-container">
        <div class="d-flex justify-content-center flex-wrap">

          <div class="card mx-0 mx-sm-2 mt-4 mt-md-3">
            <div class="card-body p-2">
              <div class="card-title text-center">Frontend</div>
              <div class="card">
                <div class="card-body p-2">
                  <div class="card-subttile text-center small">Published jobs:</div>
                  <div class="card-subtitle text-center fw-bold">122</div>
                </div>
              </div>
            </div>
          </div>

          <div class="card mx-0 mx-sm-2 mt-4 mt-md-3">
            <div class="card-body p-2">
              <div class="card-title text-center">Backend</div>
              <div class="card">
                <div class="card-body p-2">
                  <div class="card-subttile text-center small">Published jobs:</div>
                  <div class="card-subtitle text-center fw-bold">95</div>
                </div>
              </div>
            </div>
          </div>

          <div class="card mx-0 mx-sm-2 mt-4 mt-md-3">
            <div class="card-body p-2">
              <div class="card-title text-center">Fullstack</div>
              <div class="card">
                <div class="card-body p-2">
                  <div class="card-subttile text-center small">Published jobs:</div>
                  <div class="card-subtitle text-center fw-bold">32</div>
                </div>
              </div>
            </div>
          </div>

          <div class="card mx-0 mx-sm-2 mt-4 mt-md-3">
            <div class="card-body p-2">
              <div class="card-title text-center">QA</div>
              <div class="card">
                <div class="card-body p-2">
                  <div class="card-subttile text-center small">Published jobs:</div>
                  <div class="card-subtitle text-center fw-bold">201</div>
                </div>
              </div>
            </div>
          </div>

          <div class="card mx-0 mx-sm-2 mt-4 mt-md-3">
            <div class="card-body p-2">
              <div class="card-title text-center">MobDev</div>
              <div class="card">
                <div class="card-body p-2">
                  <div class="card-subttile text-center small">Published jobs:</div>
                  <div class="card-subtitle text-center fw-bold">300</div>
                </div>
              </div>
            </div>
          </div>

          <div class="card mx-0 mx-sm-2 mt-4 mt-md-3">
            <div class="card-body p-2">
              <div class="card-title text-center">UX/UI</div>
              <div class="card">
                <div class="card-body p-2">
                  <div class="card-subttile text-center small">Published jobs:</div>
                  <div class="card-subtitle text-center fw-bold">71</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr class="my-4">
      </div>

      <!-- Jobs lists -->
      <div id="list-jobs">
        <div class="row search-bar my-4">
          <div class="col-sm-8 col-md-6">
            <input type="text" class="form-control" placeholder="Search job...">
          </div>
          <div class="order-1 order-sm-0 col-6 mt-3 col-sm-3 mt-sm-0 ps-sm-0 col-md-2">
            <select class="form-select" name="it_branches" id="it_branches">
              <option class="text-dark" selected>Sort by...</option>
              <option class="text-dark" value="">Frontend</option>
              <option class="text-dark" value="">Backend</option>
              <option class="text-dark" value="">Fullstack</option>
              <option class="text-dark" value="">QA</option>
              <option class="text-dark" value="">UX/UI</option>
              <option class="text-dark" value="">Mob Develmp</option>
            </select>
          </div>
        </div>
        <ul class="list-group-flush ps-0">
          <li class="list-group-item px-2">
            <p class="text-muted mb-3">Published: 03.10.2021 by</p>
            <div class="mb-3 d-flex align-items-center">
              <div class="d-flex flex-column me-1">
                <h4 class="m-0">
                  Medics Prosperity
                </h4>
                <span class="badges mt-1">
                  <span class="badge bg-danger rounded-pill">ux/ui</span>
                  <span class="badge bg-primary rounded-pill">frontend</span>
                  <span class="badge bg-secondary rounded-pill">backend</span>
                </span>
              </div>
              <img src="https://www.logolynx.com/images/logolynx/2a/2ad00c896e94f1f42c33c5a71090ad5e.png" width="56px" alt="">
            </div>
            <p> Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laboriosam pariatur libero reiciendis
              doloremque in magni atque consequuntur, laudantium, maxime rerum, id ratione alias consectetur
              maiores?
              Quaerat atque earum cum dolorem? Quasi corporis illo dolorem ut unde quibusdam ipsa minima architecto
              inventore, possimus reprehenderit labore ad harum itaque voluptatibus dolorum libero.
            </p>
            <button href="#" class="btn btn-primary d-flex align-items-center btn-sm mb-2">
              <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
                <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
              </svg>
              Read more
            </button>
          </li>
          <li class="list-group-item px-2">
            <p class="text-muted mb-2">Published: 03.10.2021 by</p>
            <div class="mb-4">
              <h4 class="m-0">
                <span>Artromedica</span>
                <img src="https://seeklogo.com/images/H/health-care-logo-9EFC79AFAC-seeklogo.com.png" width="48px" alt="">
              </h4>
              <span class="badge bg-danger rounded-pill">ux/ui</span>
              <span class="badge bg-primary rounded-pill">frontend</span>
              <span class="badge bg-dark rounded-pill">mobdev</span>
            </div>
            <p> Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laboriosam pariatur libero reiciendis
              doloremque in magni atque consequuntur, laudantium, maxime rerum, id ratione alias consectetur
              maiores?
              Quaerat atque earum cum dolorem? Quasi corporis illo dolorem ut unde quibusdam ipsa minima architecto
              inventore, possimus reprehenderit labore ad harum itaque voluptatibus dolorum libero.
            </p>
            <button href="#" class="btn btn-primary d-flex align-items-center btn-sm mb-2">
              <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
                <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
              </svg>
              Read more
            </button>
          </li>
          <li class="list-group-item px-2">
            <p class="text-muted mb-2">Published: 03.10.2021 by</p>
            <div class="mb-4">
              <h4 class="m-0">
                <span>Family Studio</span>
                <img src="https://seeklogo.com/images/S/Stevens_Healthcare-logo-5F0F02A23C-seeklogo.com.png" width="48px" alt="">
              </h4>
              <span class="badge bg-info rounded-pill">QA</span>
              <span class="badge bg-primary rounded-pill">frontend</span>
              <span class="badge bg-warning rounded-pill">backend</span>
            </div>
            <p> Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laboriosam pariatur libero reiciendis
              doloremque in magni atque consequuntur, laudantium, maxime rerum, id ratione alias consectetur
              maiores?
              Quaerat atque earum cum dolorem? Quasi corporis illo dolorem ut unde quibusdam ipsa minima architecto
              inventore, possimus reprehenderit labore ad harum itaque voluptatibus dolorum libero.
            </p>
            <button href="#" class="btn btn-primary d-flex align-items-center btn-sm mb-2">
              <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
                <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
              </svg>
              Read more
            </button>
          </li>
        </ul>

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

  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="assets/js/script.js"></script>
  <script src="assets/js/ajax-employees.js"></script>
</body>

</html>