<?php session_start(); ?>
<?php include_once 'src/functions.php'; ?>
<?php include_once 'src/Profile.php'; ?>
<?php include_once 'src/Jobs.php'; ?>
<?php include_once 'src/Message.php'; ?>
<?php login_required($_SESSION['employee_id']); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/css/custom.css">
  <title>👾Monster HR | Dashboard</title>
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
              <?php
              $profile = new Profile;
              $profile->profile_data('tb_job_seeker_profile', $_SESSION['employee_id']);
              ?>
              <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span id="greetings"></span>
                <span id="greetings_first_name">
                  <?php echo $profile->name; ?>
                </span>
              </a>
              <ul id="job_seeker_navbar_data" class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                <li class="dropdown-item xsm-text-class text-center">Your are logged in as<br><b id="employee_username" class="xsm-text-class"><?php echo $profile->username; ?></b>
                </li>
                <div class="dropdown-divider"></div>
                <li id="profile_button">
                  <a class="dropdown-item xsm-text-class" href="#">Edit Profile</a>
                </li>
                <li>
                  <a class="js-message-icon dropdown-item xsm-text-class" href="#">Messages</a>
                </li>
                <li id="application_btn">
                  <a class="dropdown-item xsm-text-class" href="#">Applications</a>
                </li>
                <div class="dropdown-divider"></div>
                <li class="dropdown-item xsm-text-class d-flex align-items-center">
                  <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                  </svg>
                  <span id="employee_first_name" class="me-1">
                    <?php echo $profile->name; ?>
                  </span>
                  <span id="employee_last_name">
                    <?php echo $profile->last_name; ?>
                  </span>
                </li>
                <li class="dropdown-item xsm-text-class d-flex align-items-center">
                  <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                    <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
                    <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                  </svg>
                  <span id="employee_address">
                    <?php echo $profile->address; ?>
                  </span>
                </li>
                <li class="dropdown-item xsm-text-class d-flex align-items-center">
                  <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z" />
                  </svg>
                  <span id="employee_email">
                    <?php echo $profile->email; ?>
                  </span>
                </li>
                <li class="dropdown-item xsm-text-class d-flex align-items-center">
                  <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link-45deg" viewBox="0 0 16 16">
                    <path d="M4.715 6.542L3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.001 1.001 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z" />
                    <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 0 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 0 0-4.243-4.243L6.586 4.672z" />
                  </svg>
                  <a href="<?php echo $profile->website; ?>" target="_blank" class="text-decoration-none" id="employee_website">
                    <?php echo $profile->website; ?>
                  </a>
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
          <li id="inbox_job_seeker_counter_container" class="nav-item">
            <a id="inbox_job_seeker_counter" href="#" class="js-message-icon nav-link d-flex align-items-center">
              <svg id="envelope_close" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="me-1 envelope_closed bi bi-envelope" viewBox="0 0 16 16">
                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z" />
              </svg>
              <svg id="envelope_open" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="me-1 d-none bi bi-envelope-open" viewBox="0 0 16 16">
                <path d="M8.47 1.318a1 1 0 0 0-.94 0l-6 3.2A1 1 0 0 0 1 5.4v.818l5.724 3.465L8 8.917l1.276.766L15 6.218V5.4a1 1 0 0 0-.53-.882l-6-3.2zM15 7.388l-4.754 2.877L15 13.117v-5.73zm-.035 6.874L8 10.083l-6.965 4.18A1 1 0 0 0 2 15h12a1 1 0 0 0 .965-.738zM1 13.117l4.754-2.852L1 7.387v5.73zM7.059.435a2 2 0 0 1 1.882 0l6 3.2A2 2 0 0 1 16 5.4V14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5.4a2 2 0 0 1 1.059-1.765l6-3.2z" />
              </svg>
              <span class="badge bg-danger rounded-pill"><?php Message::count_inbox_msg('tb_msg_box_job_seeker', 'job_seeker_id', $_SESSION['employee_id']); ?></span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Message container -->
  <div class="js-message-box card shadow-lg px-3 rounded d-none">
    <div class="d-flex justify-content-between mt-3 mb-2 px-1 px-md-3">
      <h4 class="m-0">Messages:</h4>
      <button class="btn-close align-self-end"></button>
    </div>
    <div class="card-body p-1 p-md-3 pt-md-1">
      <ul class="nav nav-tabs">
        <li id="inbox_tab" class="nav-item hover-msg-box">
          <a class="nav-link active">Inbox</a>
        </li>
        <li id="sent_tab" class="nav-item hover-msg-box">
          <a class="nav-link">Sent</a>
        </li>
      </ul>
      <ul id="inbox_ul" class="list-group-flush p-0 pt-3">
        <?php
        $msg_box = new Message;
        $inbox = $msg_box->inbox_job_seeker();
        $inbox_data = $inbox->fetchAll(PDO::FETCH_BOTH);
        foreach ($inbox_data as $value) : ?>
          <li class="js-inbox-li list-group-item p-0">
            <div class="small"><?php echo $value['send_date']; ?></div>
            <div class="text-muted small mb-3">sent by <b class="text-dark"> <?php echo $value['username']; ?> </b></div>
            <div class="d-flex justify-content-between align-items-start">
              <p><b>Subject:</b><?php echo $value['subject']; ?></p>
              <span class="js-chevron ms-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                </svg>
              </span>
            </div>
            <p class="js-expand-text">
              <span class="fw-bold">Message: </span>
              <?php echo $value['inbox_msg']; ?>
            </p>
            <button class="js-reply-hr btn btn-primary btn-sm d-flex align-items-center mb-3">
              <span>Reply</span>
              <svg class="ms-2" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 16.987 16.557">
                <g id="send" transform="translate(0 -6.196)">
                  <g id="Group_216" data-name="Group 216" transform="translate(0 6.197)">
                    <path id="Path_22" data-name="Path 22" d="M16.809,13.7a1.78,1.78,0,0,0-.826-.826L2.556,6.375A1.78,1.78,0,0,0,.128,8.638l2.335,5.836L.128,20.311a1.78,1.78,0,0,0,2.428,2.264l13.427-6.5A1.78,1.78,0,0,0,16.809,13.7ZM2.039,21.505a.593.593,0,0,1-.809-.755L3.5,15.067H15.344ZM3.5,13.881,1.23,8.2a.593.593,0,0,1,.809-.753l13.305,6.436H3.5Z" transform="translate(0 -6.197)" fill="#fff" />
                  </g>
                </g>
              </svg>
            </button>
            <!-- REPLY MESSAGE -->
            <div class="js-message-job-seeker-box card shadow rounded mb-4 d-none">
              <div class="d-flex justify-content-between mt-3 mb-2 px-3">
                <h4 class="m-0">Send message:</h4>
                <span class="js-close-reply cursor-pointer transform-scale">
                  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                  </svg>
                </span>
              </div>
              <div class="card-body">
                <form method="POST">
                  <div class="js-scs-msg"></div>
                  <div class="form-group mb-2">
                    <label for="to"><b>From:</b></label>
                    <input type="text" class="form-control form-control-sm" value="<?php echo "{$value['first_name']} {$value['last_name']}"; ?>" disabled>
                    <input type="hidden" name="from" value="<?php echo $_SESSION['employee_id']; ?>">
                  </div>
                  <div class="form-group mb-2">
                    <label for="to"> <b>To:</b></label>
                    <input type="email" class="form-control form-control-sm" name="hr_id" value="<?php echo $value['username']; ?>" disabled>
                    <input type="hidden" name="to" value="<?php echo $value['hr_id']; ?>">
                  </div>
                  <div class="form-group mb-2">
                    <label for="subject"><b>Subject:</b></label>
                    <input type="text" class="form-control form-control-sm" name="subject">
                    <div></div>
                  </div>
                  <div class="form-group">
                    <label for="message"><b>Message:</b></label>
                    <textarea name="msg" class="form-control" rows="6"></textarea>
                    <div></div>
                  </div>
                  <button type="submit" class="js-submit-sending-msg-job-seeker btn btn-primary btn-sm d-flex align-items-center mt-3">
                    <span>Send</span>
                    <svg class="ms-2" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 16.987 16.557">
                      <g id="send" transform="translate(0 -6.196)">
                        <g id="Group_216" data-name="Group 216" transform="translate(0 6.197)">
                          <path id="Path_22" data-name="Path 22" d="M16.809,13.7a1.78,1.78,0,0,0-.826-.826L2.556,6.375A1.78,1.78,0,0,0,.128,8.638l2.335,5.836L.128,20.311a1.78,1.78,0,0,0,2.428,2.264l13.427-6.5A1.78,1.78,0,0,0,16.809,13.7ZM2.039,21.505a.593.593,0,0,1-.809-.755L3.5,15.067H15.344ZM3.5,13.881,1.23,8.2a.593.593,0,0,1,.809-.753l13.305,6.436H3.5Z" transform="translate(0 -6.197)" fill="#fff" />
                        </g>
                      </g>
                    </svg>
                  </button>
                </form>
              </div>
            </div>
          </li>
        <?php endforeach; ?>
        <?php echo ($inbox->rowCount() === 0) ? '<h5>There are no inbox messages...</h5>' : ''; ?>
      </ul>
      <ul id="sent_ul" class="list-group-flush p-0 pt-3">
        <?php
        $sent = $msg_box->sent_by_job_seeker();
        $sent_data = $sent->fetchAll(PDO::FETCH_ASSOC);
        foreach ($sent_data as $value) : ?>
          <li class="js-sent-li list-group-item pb-0">
            <div class="small"><?php echo $value['send_date']; ?></div>
            <div class="text-muted small mb-3">sent to <b class="text-dark"> <?php echo $value['username']; ?> </b></div>
            <div class="d-flex justify-content-between align-items-start">
              <p><b>Subject:</b><?php echo $value['subject']; ?></p>
              <span class="js-chevron ms-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                </svg>
              </span>
            </div>
            <p class="js-expand-text">
              <span class="fw-bold">Message: </span>
              <?php echo $value['sent_msg']; ?>
            </p>
          </li>
        <?php endforeach; ?>
        <?php echo ($sent->rowCount() === 0) ? '<h5>There are no sent messages...</h5>' : ''; ?>
      </ul>
    </div>
  </div>

  <!-- Applications -->
  <div class="card shadow-lg rounded application_box d-none px-1 px-md-2">
    <div class="d-flex justify-content-between mt-3 mb-2 px-3">
      <h4 class="m-0">Applications:</h4>
      <button class="btn-close align-self-end"></button>
    </div>
    <ul id="applied_job_container" class="card-body list-group-flush">
      <?php
      $job_data = new Job;
      foreach ($job_data->display_applied_jobs() as $value) : ?>
        <li class="applied_job_data list-group-item p-0">
          <div class="small text-muted">
            <?php echo "<div>{$value['published_date']}</div>" ?>
            <div class="d-flex align-items-center">
              <?php echo "<span class=\"text-dark fw-bold fs-5 me-1\"> {$value['company_name']}</span>"; ?>
              <?php echo (!$value['frontend_tag']) ? '' : "<span class=\"badge bg-color-light-blue me-1\"> {$value['frontend_tag']} </span>"; ?>
              <?php echo (!$value['backend_tag']) ? '' : "<span class=\"badge bg-color-light-gray text-dark me-1\"> {$value['backend_tag']} </span>"; ?>
              <?php echo (!$value['fullstack_tag']) ? '' : "<span class=\"badge bg-color-light-green me-1\"> {$value['fullstack_tag']} </span>"; ?>
              <?php echo (!$value['qa_tag']) ? '' : "<span class=\"badge bg-color-light-red me-1\"> {$value['qa_tag']} </span>"; ?>
              <?php echo (!$value['mobdev_tag']) ? '' : "<span class=\"badge bg-color-light-yellow text-dark me-1\"> {$value['mobdev_tag']} </span>"; ?>
              <?php echo (!$value['ux_ui_tag']) ? '' : "<span class=\"badge bg-color-light-purple me-1\"> {$value['ux_ui_tag']} </span>"; ?>
              <span class="badge bg-color-light-cyan  me-1"> <?php echo $value['job_time']; ?> </span>
            </div>
          </div>
          <p class="mt-2"><?php echo $value['job_title']; ?></p>
          <p><b>Salary: </b><?php echo $value['job_salary']; ?> </p>
          <p class="d-none"><b>Job description: </b> <?php echo $value['job_description']; ?> </p>
          <div class="d-flex">
            <button class="js-show-job-description btn btn-primary btn-sm d-flex align-items-center me-2">
              <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
                <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
              </svg>
              Read more
            </button>
            <button class="js-cancel-application btn btn-danger btn-sm d-flex align-items-center" value="<?php echo $value['job_id'] ?>">
              <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
                <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
              </svg>
              Reject
            </button>
            <input type="hidden" value="<?php echo $value['applied_id']; ?>">
          </div>
          <hr class="m-2">
        </li>
      <?php endforeach; ?>

    </ul>
  </div>

  <!-- Edit profile -->
  <div class="card d-none profile_box shadow-lg rounded">
    <div class="d-flex justify-content-end pt-3 pe-3">
      <button class="btn-close"></button>
    </div>
    <div class="card-body pt-0 pb-3">
      <form id="job_seeker_profile_form" method="POST" class="row edit-profile pb-1">
        <div class="ps-3 mb-3">
          <h4 class="card-text">Edit profile:</h4>
          <button type="submit" class="btn btn-primary btn-sm d-flex align-items-center">
            <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
              <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
            </svg>
            Save profile
          </button>
        </div>
        <div>
          <div class="js-success-msg"></div>
          <div class="form-group row mb-0 mb-0 mb-sm-2">
            <div class="form-group col-0 col-sm-6 mb-2 mb-sm-0">
              <label for="first_name">First name</label>
              <input type="text" class="successful-validation form-control form-control-sm" name="name" value="<?php echo $profile->name; ?>">
              <div></div>
            </div>
            <div class="form-group col-0 col-sm-6 mb-2 mb-sm-0">
              <label for="last_name">Last name</label>
              <input type="text" class="successful-validation form-control form-control-sm" name="last_name" value="<?php echo $profile->last_name; ?>">
              <div></div>
            </div>
          </div>
          <div class="form-group row mb-0 mb-sm-2">
            <div class="form-group col-0 col-sm-6 mb-2 mb-sm-0">
              <label for="address_employee">Address</label>
              <input type="text" class="successful-validation form-control form-control-sm" name="address" value="<?php echo $profile->address; ?>">
              <div></div>
            </div>
            <div class="form-group col-0 col-sm-6 mb-2 mb-sm-0">
              <label for="website_employee">Website</label>
              <input type="text" class="successful-validation form-control form-control-sm" name="website" value="<?php echo $profile->website; ?>">
              <div></div>
            </div>
          </div>
          <div class="form-group row mb-0 mb-sm-2">
            <div class="form-group col-0 col-sm-6 mb-2 mb-sm-0">
              <label for="username">Username</label>
              <input type="text" class="form-control form-control-sm" name="username" value="<?php echo $profile->username; ?>" disabled>
            </div>
            <div class="form-group col-0 col-sm-6 mb-2 mb-sm-0">
              <label for="email">Email</label>
              <input type="email" class="form-control form-control-sm" name="email" value="<?php echo $profile->email; ?>" disabled>
            </div>
          </div>
          <div class="form-group">
            <label for="short_introduction_employee">Short introduction</label>
            <textarea name="short_introduction" class="successful-validation form-control form-control-sm" rows="6"><?php echo $profile->short_introducion; ?></textarea>
            <div></div>
          </div>
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
          <div class="card mx-0 me-2 mx-sm-2 mt-4 mt-md-3">
            <div class="card-body p-2">
              <div class="card-title text-center">Frontend</div>
              <div class="card">
                <div class="card-body p-2">
                  <div class="card-subttile text-center small">Published jobs:</div>
                  <div id="refresh_frontend_tag" class="card-subtitle text-center fw-bold"><?php Job::count_published_job_tags('frontend_tag', 'frontend'); ?></div>
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
                  <div id="refresh_backend_tag" class="card-subtitle text-center fw-bold"><?php Job::count_published_job_tags('backend_tag', 'backend'); ?></div>
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
                  <div id="refresh_fullstack_tag" class="card-subtitle text-center fw-bold"><?php Job::count_published_job_tags('fullstack_tag', 'fullstack'); ?></div>
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
                  <div id="refresh_qa_tag" class="card-subtitle text-center fw-bold"><?php Job::count_published_job_tags('qa_tag', 'qa'); ?></div>
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
                  <div id="refresh_mobdev_tag" class="card-subtitle text-center fw-bold"><?php Job::count_published_job_tags('mobdev_tag', 'mobdev'); ?></div>
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
                  <div id="refresh_ux_ui_tag" class="card-subtitle text-center fw-bold"><?php Job::count_published_job_tags('ux_ui_tag', 'ux/ui'); ?></div>
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
            <input id="search_by_title_company" type="text" class="form-control" placeholder="Search by company name...">
          </div>
          <div class="order-1 order-sm-0 col-6 mt-3 col-sm-3 mt-sm-0 ps-sm-0 col-md-2">
            <select class="form-select" id="select_it_tag">
              <option class="text-dark" value="*">Sort by...</option>
              <option class="js-select-tag text-dark" value="frontend">Frontend</option>
              <option class="js-select-tag text-dark" value="backend">Backend</option>
              <option class="js-select-tag text-dark" value="fullstack">Fullstack</option>
              <option class="js-select-tag text-dark" value="qa">QA</option>
              <option class="js-select-tag text-dark" value="ux_ui">UX/UI</option>
              <option class="js-select-tag text-dark" value="mobdev">MobDev</option>
            </select>
          </div>
        </div>
        <ul id="published_job_list" class="list-group-flush ps-0">
          <?php
          foreach ($job_data->display_active_jobs_employee() as $value) : ?>
            <li class="js-job-li list-group-item py-3">
              <div class="text-muted me-2">Published: <?php echo $value['published_date']; ?> by </div>
              <div class="d-flex align-items-center flex-wrap mb-3">
                <?php if ($value['file_data'] !== null) : ?>
                  <img id="showcase_company_logo" src="data:<?php $value['file_mime']; ?>;base64,<?php echo base64_encode($value['file_data']); ?>" class="me-1" alt="uploaded-picture" width="32px">
                <?php endif; ?>
                <?php echo "<span class=\"fw-bold text-dark fs-5 me-2\">{$value['company_name']}</span>"; ?>
                <div>
                  <?php echo (!$value['frontend_tag']) ? '' : "<span class=\"badge bg-color-light-blue me-1\"> {$value['frontend_tag']} </span>"; ?>
                  <?php echo (!$value['backend_tag']) ? '' : "<span class=\"badge bg-color-light-gray text-dark me-1\"> {$value['backend_tag']} </span>"; ?>
                  <?php echo (!$value['fullstack_tag']) ? '' : "<span class=\"badge bg-color-light-green me-1\"> {$value['fullstack_tag']} </span>"; ?>
                  <?php echo (!$value['qa_tag']) ? '' : "<span class=\"badge bg-color-light-red me-1\"> {$value['qa_tag']} </span>"; ?>
                  <?php echo (!$value['mobdev_tag']) ? '' : "<span class=\"badge bg-color-light-yellow text-dark me-1\"> {$value['mobdev_tag']} </span>"; ?>
                  <?php echo (!$value['ux_ui_tag']) ? '' : "<span class=\"badge bg-color-light-purple me-1\"> {$value['ux_ui_tag']} </span>"; ?>
                  <span class="badge bg-color-light-cyan  me-1"> <?php echo $value['job_time']; ?> </span>
                </div>
              </div>
              <p class="mt-2"><b>Job title: </b> <?php echo $value['job_title']; ?> </p>
              <p class="mt-2"><span class="fw-bold">Salary:</span> <?php echo $value['job_salary']; ?> </p>
              <p class="js-job-description d-none mt-3"><span class="fw-bold">Description: </span> <?php echo $value['job_description']; ?> </p>
              <div class="d-flex">
                <button class="js-show-job-description btn btn-primary d-flex align-items-center btn-sm me-2">
                  <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
                    <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
                  </svg>
                  Read more
                </button>
                <?php if ($job_data->is_applied_btn($value[0]) === 0) : ?>
                  <button class="js-apply-job btn btn-success d-flex align-items-center btn-sm" value="<?php echo $value[0]; ?>">
                    <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
                      <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
                    </svg>
                    Apply
                  </button>
                  <input type="hidden" value="<?php echo $_SESSION['employee_id']; ?>">
                  <input type="hidden" value="<?php echo $value['random_chars']; ?>">
                <?php else : ?>
                  <button class="btn btn-success d-flex align-items-center btn-sm disabled">
                    Applied!
                  </button>
                <?php endif; ?>
              </div>
              <div class="js-motivation-speech container d-none">
                <div class="card shadow rounded">
                  <div class="d-flex justify-content-between mt-3 mb-2 px-3">
                    <h4 class="m-0">Motivation speech:</h4>
                    <button class="btn-close align-self-end"></button>
                  </div>
                  <div class="card-body pb-3 pt-0">
                    <div id="apply_succ_mess"></div>
                    <p class="text-muted m-0 mb-1">Published: <?php echo $value['published_date']; ?> by</p>
                    <div class="d-flex align-items-center mb-3">
                      <h5 class="m-0 me-1"><?php echo $value['company_name']; ?></h5>
                      <?php echo (!$value['frontend_tag']) ? '' : "<span class=\"badge bg-color-light-blue me-1\"> {$value['frontend_tag']} </span>"; ?>
                      <?php echo (!$value['backend_tag']) ? '' : "<span class=\"badge bg-color-light-gray text-dark me-1\"> {$value['backend_tag']} </span>"; ?>
                      <?php echo (!$value['fullstack_tag']) ? '' : "<span class=\"badge bg-color-light-green me-1\"> {$value['fullstack_tag']} </span>"; ?>
                      <?php echo (!$value['qa_tag']) ? '' : "<span class=\"badge bg-color-light-red me-1\"> {$value['qa_tag']} </span>"; ?>
                      <?php echo (!$value['mobdev_tag']) ? '' : "<span class=\"badge bg-color-light-yellow text-dark me-1\"> {$value['mobdev_tag']} </span>"; ?>
                      <?php echo (!$value['ux_ui_tag']) ? '' : "<span class=\"badge bg-color-light-purple me-1\"> {$value['ux_ui_tag']} </span>"; ?>
                      <span class="badge bg-color-light-cyan  me-1"> <?php echo $value['job_time']; ?> </span>
                    </div>
                    <p class="m-0"> <?php echo $value['job_title']; ?> </p>
                    <textarea name="motivational_speech" class="form-control mt-3" rows="10" placeholder="Why do you want to apply for this job?"></textarea>
                    <div></div>
                    <button class="js-send-speech btn btn-primary d-flex align-items-center mt-3">
                      Send
                      <svg class="ms-1" xmlns="http://www.w3.org/2000/svg" width="16.987" height="16.557" viewBox="0 0 16.987 16.557">
                        <g id="send" transform="translate(0 -6.196)">
                          <g id="Group_216" data-name="Group 216" transform="translate(0 6.197)">
                            <path id="Path_22" data-name="Path 22" d="M16.809,13.7a1.78,1.78,0,0,0-.826-.826L2.556,6.375A1.78,1.78,0,0,0,.128,8.638l2.335,5.836L.128,20.311a1.78,1.78,0,0,0,2.428,2.264l13.427-6.5A1.78,1.78,0,0,0,16.809,13.7ZM2.039,21.505a.593.593,0,0,1-.809-.755L3.5,15.067H15.344ZM3.5,13.881,1.23,8.2a.593.593,0,0,1,.809-.753l13.305,6.436H3.5Z" transform="translate(0 -6.197)" fill="#fff" />
                          </g>
                        </g>
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
            </li>
          <?php endforeach; ?>
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
  <script src="assets/js/functions.js"></script>
  <script src="assets/js/script.js"></script>
  <script src="assets/js/ajax-employees.js"></script>
  <script src="assets/js/message.js"></script>
</body>

</html>