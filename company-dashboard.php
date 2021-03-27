<?php include 'src/database.php'; ?>
<?php include_once 'src/functions.php'; ?>
<?php login_required($_SESSION['company_id']); ?>
<?php 

?>

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
  <nav class="navbar navbar-dark bg-dark navbar-expand py-2">
    <div class="container flex-column flex-sm-row">
      <p class="calistoga-font navbar-brand text-white mb-0">Monster HR</p>
      <div class="d-flex">
        <!-- Collapse dropdown -->
        <div class="collapse navbar-collapse justify-content-end">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span id="greetings"></span> <span id="greetings_company_name"></span>
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                <li class="dropdown-item xsm-text-class text-center">Your are logged in as<br><b id="company_username" class="xsm-text-class"></b>
                </li>
                <div class="dropdown-divider"></div>
                <li id="profile_button">
                  <a class="dropdown-item xsm-text-class" href="#">Edit Profile</a>
                </li>
                <li>
                  <a class="message_icon dropdown-item xsm-text-class" href="#">Messages<span class="badge rounded-pill bg-danger ms-1">3</span>
                  </a>
                </li>
                <div class="dropdown-divider"></div>
                <li id="publish_job_button">
                  <a class="dropdown-item xsm-text-class d-flex align-items-center" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1 bi bi-upload" viewBox="0 0 16 16">
                      <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                      <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z" />
                    </svg>
                    <span>Publish a job</span>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item xsm-text-class" href="#">View candidates</a>
                </li>
                <li>
                  <a class="dropdown-item xsm-text-class" href="#"><b>Create HR account</b></a>
                </li>
                <div class="dropdown-divider"></div>
                <li class="dropdown-item xsm-text-class d-flex align-items-center">
                  <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                  </svg>
                  <span id="company_name"></span>
                </li>
                <li class="dropdown-item xsm-text-class d-flex align-items-center">
                  <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                    <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
                    <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                  </svg>
                  <span id="company_address"></span>
                </li>
                <li class="dropdown-item xsm-text-class d-flex align-items-center">
                  <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z" />
                  </svg>
                  <span id="company_email"></span>
                </li>
                <li class="dropdown-item xsm-text-class d-flex align-items-center">
                  <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link-45deg" viewBox="0 0 16 16">
                    <path d="M4.715 6.542L3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.001 1.001 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z" />
                    <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 0 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 0 0-4.243-4.243L6.586 4.672z" />
                  </svg>
                  <span id="company_website"></span>
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
                  <span id="date_time"></span>
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
            <p class="text-muted small">sent by <b class="text-dark">HR</b></p>
            <p class="small">03.13.2021</p>
          </div>
          <div class="chevron_btn d-flex justify-content-between align-items-start">
            <p><b>Subject:</b> Lorem ipsum dolor sit amet consectetur adipisicing elit. A, saepe.</p>
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
            <p><b>Subject:</b> Lorem ipsum dolor sit amet consectetur adipisicing elit. A, saepe.</p>
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
            <p><b>Subject:</b> Lorem ipsum dolor sit amet consectetur adipisicing elit. A, saepe.</p>
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


  <!-- Edit profile -->
  <div class="card d-none profile_box shadow-lg p-3 mb-5 bg-body rounded">
    <div class="d-flex justify-content-between mt-4">
      <div class="ms-3">
        <h4 class="card-text">Edit profile:</h4>
        <button id="update_company_profile" class="btn btn-primary btn-sm d-flex align-items-center">
          <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
          </svg>
          Update profile
        </button>
      </div>
      <button class="btn-close me-3"></button>
    </div>
    <div class="card-body">
      <form method="POST" class="row edit-profile pb-3">

        <div class="form-group row mb-3 pe-0">
          <div class="form-group col-0 col-sm-6 pe-0 pe-sm-2">
            <label for="first_name">Company name</label>
            <input type="text" class="form-control form-control-sm" name="company_name">
          </div>
          <div class="form-group col-0 pe-0 col-sm-6">
            <label for="last_name">Slogan</label>
            <input type="text" class="form-control form-control-sm" name="company_slogan" placeholder="Write company slogan...">
          </div>
        </div>

        <div class="form-group row mb-3 pe-0">
          <div class="form-group col-0 col-sm-6 pe-0 pe-sm-2">
            <label for="address_employee">Address</label>
            <input type="text" class="form-control form-control-sm" name="company_address">
          </div>
          <div class="form-group col-0 col-sm-6 pe-0">
            <label for="website_employee">Website</label>
            <input type="text" class="form-control form-control-sm" name="company_website">
          </div>
        </div>

        <div class="form-group row mb-3 pe-0">
          <div class="form-group col-0 col-sm-6 pe-0 pe-sm-2">
            <label for="username">Username</label>
            <input type="text" class="form-control form-control-sm" name="company_username" disabled>
          </div>
          <div class="form-group col-0 col-sm-6 pe-0">
            <label for="email">Email</label>
            <input type="email" class="form-control form-control-sm" name="company_email" disabled>
          </div>
        </div>
        <div class="company_branches">
          <div class="form-group mb-3">
            <label for="it_branches">IT branches</label>
            <div class="form-check my-2">
              <input type="checkbox" class="form-check-input" name="it_branch[]" value="frontend">
              <label class="form-check-label" for="it_branch">Front-end Development</label>
            </div>
            <div class="form-check mb-2">
              <input type="checkbox" class="form-check-input" name="it_branch[]" value="backend">
              <label class="form-check-label" for="it_branch">Back-end Development</label>
            </div>
            <div class="form-check mb-2">
              <input type="checkbox" class="form-check-input" name="it_branch[]" value="fullstack">
              <label class="form-check-label" for="it_branch">Fullstack Development</label>
            </div>
            <div class="form-check mb-2">
              <input type="checkbox" class="form-check-input" name="it_branch[]" value="qa">
              <label class="form-check-label" for="it_branch">Quality Assurance</label>
            </div>
            <div class="form-check mb-2">
              <input type="checkbox" class="form-check-input" name="it_branch[]" value="mobdev">
              <label class="form-check-label" for="it_branch">Mobile Development</label>
            </div>
            <div class="form-check mb-2">
              <input type="checkbox" class="form-check-input" name="it_branch[]" value="ux/ui">
              <label class="form-check-label" for="it_branch">UX/UI</label>
            </div>
          </div>
        </div>
        <div class="form-group mb-3 d-flex flex-column">
        <label for="company_img" class="mb-1">Company Logo</label>
        <input type="file" class="form-control-file">
        <small class="form-text form-muted">Max 3mb size</small>
        </div>
        <div class="form-group mb-3">
          <label for="company_description">Company description</label>
          <textarea name="company_description" class="form-control form-control-sm" rows="4"></textarea>
        </div>
        <div class="form-group mb-3">
          <label for="company_history">Company history</label>
          <textarea name="company_history" class="form-control form-control-sm" rows="4" placeholder="Write company history..."></textarea>
        </div>
        <div class="form-group mb-3">
          <label for="company_mission">Company mission</label>
          <textarea name="company_mission" class="form-control form-control-sm" rows="4" placeholder="Write company mission..."></textarea>
        </div>
      </form>
    </div>
  </div>

  <!-- HR -->
  <div class="container mt-4 d-none">
    <div class="row">
      <div class="card col-8 mx-auto">
        <div class="d-flex justify-content-between mt-3 mb-2 px-3">
          <h4 class="m-0">Create HR account:</h4>
          <button class="btn-close align-self-end"></button>
        </div>
        <div class="card-body">
          <form action="#">
            <div class="form-group mb-2">
              <label for="hr_account">Username</label>
              <input type="text" name="hr_username" class="form-control form-control-sm">
            </div>
            <div class="form-group mb-2">
              <label for="hr_account">Email</label>
              <input type="email" name="hr_email" class="form-control form-control-sm">
            </div>
            <div class="form-group mb-2">
              <label for="hr_account">Password</label>
              <input type="password" name="password" class="form-control form-control-sm">
            </div>
            <div class="form-group mb-3">
              <label for="hr_account">Confirm password</label>
              <input type="password" name="confirm_password" class="form-control form-control-sm">
            </div>
            <input type="submit" name="submit_hr_acc" value="Submit" class="btn btn-primary">
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- View candidates -->
  <div class="container mt-4 d-none">
    <div class="row">
      <div class="card col-8 mx-auto">
        <div class="d-flex justify-content-between mt-3 mb-2 px-3">
          <h4 class="m-0">View candidates:</h4>
          <button class="btn-close align-self-end"></button>
        </div>
        <div class="card-body">
          <table class="table">
            <thead class="table">
              <tr class="">
                <th>#</th>
                <th>Name</th>
                <th>Short description</th>
                <th>Resume</th>
                <th>Approved/Disapproved</th>
              </tr>
            </thead>
            <tbody>
              <tr class="table-success">
                <th>1</th>
                <td>Ivan</td>
                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores consequatur quae sequi fuga animi.
                  Minima?</td>
                <td><button class="btn btn-outline-primary btn-sm d-flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1 bi bi-download" viewBox="0 0 16 16">
                      <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                      <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                    </svg>
                    Download
                  </button>
                </td>
                <td class="text-center">Approved</td>
              </tr>
              <tr class="table-danger">
                <th>2</th>
                <td>Georgi</td>
                <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laudantium eveniet eaque tenetur voluptas
                  exercitationem quia accusantium voluptatum iure ducimus eum?</td>
                <td><button class="btn btn-outline-primary btn-sm d-flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1 bi bi-download" viewBox="0 0 16 16">
                      <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                      <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                    </svg>
                    Download
                  </button>
                </td>
                <td class="text-center">Disapproved</td>
              </tr>
              <tr class="table-danger">
                <th>3</th>
                <td>Petur</td>
                <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laudantium eveniet eaque tenetur voluptas
                  exercitationem quia accusantium voluptatum iure ducimus eum?</td>
                <td><button class="btn btn-outline-primary btn-sm d-flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1 bi bi-download" viewBox="0 0 16 16">
                      <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                      <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                    </svg>
                    Download
                  </button>
                </td>
                <td class="text-center">Disapproved</td>
              </tr>
              <tr class="table-success">
                <th>4</th>
                <td>Stoil</td>
                <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laudantium eveniet eaque tenetur voluptas
                  exercitationem quia accusantium voluptatum iure ducimus eum?</td>
                <td><button class="btn btn-outline-primary btn-sm d-flex">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1 bi bi-download" viewBox="0 0 16 16">
                      <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                      <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                    </svg>
                    Download
                  </button>
                </td>
                <td class="text-center">Approved</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>



  <!-- Publish a job -->
  <div class="container mt-4 d-none">
    <div class="row">
      <div class="card col-8 mx-auto">
        <div class="d-flex justify-content-between mt-3 mb-2 px-3">
          <h4 class="m-0">Publish a job:</h4>
          <button class="btn-close align-self-end"></button>
        </div>
        <div class="card-body">

          <form method="POST" action="#">
            <div class="form-group mb-3">
              <label for="job_title">Job title</label>
              <input type="text" name="job_title" class="form-control form-control-sm">
            </div>

            <div class="form-group d-flex mb-3">

              <div class="form-group mb-3 order-1">
                <label for="">Job time</label>
                <div class="form-group mt-1">
                  <input type="checkbox" name="job_title" name="job_hours" class="form-check-input" value="Full time">
                  <label for="job_title">Full time</label>
                </div>
                <input type="checkbox" name="job_title" name="job_hours" class="form-check-input" value="Part time">
                <label for="job_title">Part time</label>
              </div>

              <div class="company_branches me-4">
                <div class="form-group">
                  <label for="it_branches">IT branches</label>
                  <div class="form-check mt-1">
                    <input type="checkbox" class="form-check-input" name="it_branch[]" value="Front-end Development">
                    <label class="form-check-label" for="it_branch">Front-end Development</label>
                  </div>
                  <div class="form-check mb-2">
                    <input type="checkbox" class="form-check-input" name="it_branch[]" value="Back-end Development">
                    <label class="form-check-label" for="it_branch">Back-end Development</label>
                  </div>
                  <div class="form-check mb-2">
                    <input type="checkbox" class="form-check-input" name="it_branch[]" value="Fullstack Development">
                    <label class="form-check-label" for="it_branch">Fullstack Development</label>
                  </div>
                  <div class="form-check mb-2">
                    <input type="checkbox" class="form-check-input" name="it_branch[]" value="Quality Assurance">
                    <label class="form-check-label" for="it_branch">Quality Assurance</label>
                  </div>
                  <div class="form-check mb-2">
                    <input type="checkbox" class="form-check-input" name="it_branch[]" value="Mobile Development">
                    <label class="form-check-label" for="it_branch">Mobile Development</label>
                  </div>
                  <div class="form-check mb-2">
                    <input type="checkbox" class="form-check-input" name="it_branch[]" value="UX/UI">
                    <label class="form-check-label" for="it_branch">UX/UI</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="job_description">Job Description</label>
              <textarea name="job_description" id="" cols="30" rows="8" class="form-control">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nobis aspernatur voluptas fugiat alias, vel optio deserunt deleniti asperiores perferendis porro omnis quisquam, velit fuga perspiciatis ipsa quo reprehenderit quaerat quasi iusto consectetur labore ullam temporibus. Commodi obcaecati, quibusdam saepe assumenda itaque nulla voluptates aut deserunt quod, beatae harum a maiores eligendi repellat repudiandae quidem ipsam. Ea, totam corporis. Soluta recusandae tempora totam, inventore corporis rerum minima vitae quae eligendi officiis nihil? Optio quia veritatis doloremque autem ipsum dolore eum labore et officia nisi, libero dignissimos dolorum ullam necessitatibus totam nam quo nihil, fugiat error voluptate. Nam ipsa quis voluptatum in?</textarea>
            </div>
            <input type="submit" class="btn btn-primary mt-3" value="Publish">
          </form>
        </div>
      </div>
    </div>
  </div>


  <!-- Company showcase -->
  <section class="container mt-4 my-md-5">
    <div class="row">
      <div class="col-0 col-md-9 mx-auto">
        <div class="mb-3 d-flex">
          <img id="showcase_company_logo" src="https://www.logolynx.com/images/logolynx/2a/2ad00c896e94f1f42c33c5a71090ad5e.png" class="me-1" width="80px" alt="">
          <div class="d-flex flex-column">
            <h1 id="showcase_company_name" class="m-0 display-4">
            </h1>
            <p id="showcase_company_slogan" class="lead mb-0"></p>
            <div id="showcase_it_branches" class="badges mt-1"></div>
          </div>
        </div>

        <p id="showcase_company_description"></p>
        <ul class="mb-0">
          <li id="showcase_company_history" class="d-none"></li>
          <li id="showcase_company_mission" class="d-none"></li>
        </ul>
      </div>
    </div>
  </section>


  <footer class="bg-dark text-white py-3 mt-5">
    <div class="container">
      <p class="text-center text-white m-0">Made with ❤ by Maximilian Petkov</p>
      <hr class="mx-auto my-1" width="256px">
      <p class="text-center mb-0"><a href="mailto:maxy.dp@abv.bg" class="text-decoration-none text-white">maxy.dp@abv.bg</a></p>
    </div>
  </footer>

  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="assets/js/script.js"></script>
  <script src="assets/js/ajax-companies.js"></script>

</body>

</html>