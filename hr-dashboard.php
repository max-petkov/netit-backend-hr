<?php session_start(); ?>
<?php include_once 'src/functions.php'; ?>
<?php include_once 'src/Profile.php'; ?>
<?php include_once 'src/Message.php'; ?>
<?php include_once 'src/Candidate.php'; ?>
<?php login_required($_SESSION['hr_id']); ?>

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
  <nav class="navbar navbar-dark bg-dark navbar-expand py-2">
    <div class="container flex-column flex-sm-row">
      <p class="calistoga-font navbar-brand text-white mb-0">Monster HR</p>
      <div class="d-flex">
        <!-- Collapse dropdown -->
        <div class="collapse navbar-collapse justify-content-end">
          <ul class="navbar-nav">
            <?php
            $profile_data = new Profile;
            $profile_data->hr_profile_data();
            ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span id="greetings"></span>
                <span id="greetings_first_name">
                  <?php echo $profile_data->name; ?> HR
                </span>
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                <li class="dropdown-item xsm-text-class text-center">Your are logged in as<br><b class="xsm-text-class"><?php echo $profile_data->username; ?></b>
                </li>
                <div class="dropdown-divider"></div>
                <li>
                  <a class="message_icon dropdown-item xsm-text-class" href="#">Messages</a>
                </li>
                <li>
                  <a id="open_sending_msg_container" class="dropdown-item xsm-text-class" href="#">
                    <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 16.987 16.557">
                      <g id="send" transform="translate(0 -6.196)">
                        <g id="Group_216" data-name="Group 216" transform="translate(0 6.197)">
                          <path id="Path_22" data-name="Path 22" d="M16.809,13.7a1.78,1.78,0,0,0-.826-.826L2.556,6.375A1.78,1.78,0,0,0,.128,8.638l2.335,5.836L.128,20.311a1.78,1.78,0,0,0,2.428,2.264l13.427-6.5A1.78,1.78,0,0,0,16.809,13.7ZM2.039,21.505a.593.593,0,0,1-.809-.755L3.5,15.067H15.344ZM3.5,13.881,1.23,8.2a.593.593,0,0,1,.809-.753l13.305,6.436H3.5Z" transform="translate(0 -6.197)" fill="#212529" />
                        </g>
                      </g>
                    </svg>Send Company message</a>
                </li>
                <div class="dropdown-divider"></div>
                <li class="dropdown-item xsm-text-class d-flex align-items-center">
                  <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                  </svg>
                  <span><?php echo $profile_data->name; ?> <b>HR</b></span>
                </li>
                <li class="dropdown-item xsm-text-class d-flex align-items-center">
                  <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                    <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
                    <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                  </svg>
                  <span><?php echo $profile_data->address; ?></span>
                </li>
                <li class="dropdown-item xsm-text-class d-flex align-items-center">
                  <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z" />
                  </svg>
                  <span><?php echo $profile_data->email; ?></span>
                </li>
                <li class="dropdown-item xsm-text-class d-flex align-items-center">
                  <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link-45deg" viewBox="0 0 16 16">
                    <path d="M4.715 6.542L3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.001 1.001 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z" />
                    <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 0 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 0 0-4.243-4.243L6.586 4.672z" />
                  </svg>
                  <a href="<?php echo $profile_data->website; ?>" target="_blank" class="text-decoration-none" id="employee_website">
                    <?php echo $profile_data->website; ?>
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
                <li class="dropdown-item xsm-text-class d-flex align-items-center">
                  <span id="date_time"></span>
                </li>
              </ul>
            </li>
          </ul>
        </div>

        <!-- message icon -->
        <ul class="navbar-nav">
          <li id="inbox_hr_counter_container" class="nav-item">
            <a id="inbox_hr_counter" href="#" class="message_icon nav-link d-flex align-items-center">
              <svg id="envelope_close" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="me-1 envelope_closed bi bi-envelope" viewBox="0 0 16 16">
                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z" />
              </svg>
              <svg id="envelope_open" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="me-1 d-none bi bi-envelope-open" viewBox="0 0 16 16">
                <path d="M8.47 1.318a1 1 0 0 0-.94 0l-6 3.2A1 1 0 0 0 1 5.4v.818l5.724 3.465L8 8.917l1.276.766L15 6.218V5.4a1 1 0 0 0-.53-.882l-6-3.2zM15 7.388l-4.754 2.877L15 13.117v-5.73zm-.035 6.874L8 10.083l-6.965 4.18A1 1 0 0 0 2 15h12a1 1 0 0 0 .965-.738zM1 13.117l4.754-2.852L1 7.387v5.73zM7.059.435a2 2 0 0 1 1.882 0l6 3.2A2 2 0 0 1 16 5.4V14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5.4a2 2 0 0 1 1.059-1.765l6-3.2z" />
              </svg>
              <span class="badge bg-danger rounded-pill"><?php Message::count_inbox_msg('tb_msg_box_hr', 'hr_id', $_SESSION['hr_id']); ?></span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Send Company message -->
  <div id="send_msg_company_box" class="js-send-msg-company-box card shadow rounded mb-4 d-none">
    <div class="d-flex justify-content-between mt-3 mb-2 px-3">
      <h4 class="m-0">Send message:</h4>
      <button class="btn-close align-self-end"></button>
    </div>
    <div class="card-body">
      <form method="POST">
        <?php
        $msg_data = new Message;
        $msg_data->get_msg_data();
        ?>
        <div class="js-scs-msg-send"></div>
        <div class="form-group mb-2">
          <label for="to"><b>From:</b></label>
          <input type="text" class="form-control form-control-sm" name="hr_username" value="<?php echo $msg_data->hr_username; ?>" disabled>
          <input type="hidden" value="<?php echo $msg_data->hr_id; ?>">
        </div>
        <div class="form-group mb-2">
          <label for="to"> <b>To:</b></label>
          <input type="email" class="form-control form-control-sm" name="company_name'" value="<?php echo $msg_data->company_username; ?>" disabled>
          <input type="hidden" value="<?php echo $msg_data->company_id; ?>">
        </div>
        <div class="form-group mb-2">
          <label for="subject"><b>Subject:</b></label>
          <input type="text" class="form-control form-control-sm" name="message_subject" value="">
          <div class="js-subject-response-text"></div>
        </div>
        <div class="form-group">
          <label for="message"><b>Message:</b></label>
          <textarea name="message" class="form-control" rows="6"></textarea>
          <div class="js-message-response-text"></div>
        </div>
        <button class="js-send-msg-hr-to-company btn btn-primary btn-sm d-flex align-items-center mt-3">
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

  <!-- Company showcase -->
  <div class="container mt-4">
    <div class="d-flex">
      <?php if ($profile_data->file_data !== null) : ?>
        <img id="showcase_company_logo" src="data:<?php $profile_data->file_mime; ?>;base64,<?php echo base64_encode($profile_data->file_data); ?>" class="me-2" alt="uploaded-picture" width="120px">
      <?php endif; ?>
      <div>
        <h1 id="showcase_company_name" class="m-0 display-4">
          <?php echo $profile_data->name; ?>
        </h1>
        <p id="showcase_company_slogan" class="lead mb-0"><?php echo $profile_data->slogan; ?></p>
        <div id="showcase_it_branches" class="badges mt-1">
          <div id="badge_it_container">
            <?php echo (!$profile_data->frontend) ? '' : "<span class=\"badge bg-secondary\"> {$profile_data->frontend} </span>"; ?>
            <?php echo (!$profile_data->backend) ? '' : "<span class=\"badge bg-dark\"> {$profile_data->backend} </span>"; ?>
            <?php echo (!$profile_data->fullstack) ? '' : "<span class=\"badge bg-success\"> {$profile_data->fullstack} </span>"; ?>
            <?php echo (!$profile_data->qa) ? '' : "<span class=\"badge bg-danger\"> {$profile_data->qa} </span>"; ?>
            <?php echo (!$profile_data->mobdev) ? '' : "<span class=\"badge bg-warning\"> {$profile_data->mobdev} </span>"; ?>
            <?php echo (!$profile_data->ux_ui) ? '' : "<span class=\"badge bg-primary\"> {$profile_data->ux_ui} </span>"; ?>
          </div>
        </div>
      </div>
    </div>
    <p id="showcase_company_description"><?php echo $profile_data->company_description; ?></p>
  </div>

  <!-- Applicants -->
  <div id="applicants_container" class="container-sm mt-4">
    <div id="applicants_data" class="card shadow-lg rounded">
      <div class="card-header">
        <h4 class="my-3">Applicants</h4>
        <ul class="nav nav-tabs card-header-tabs">
          <li class="nav-item">
            <a id="new_applicants_tab" href="hr-dashboard.php" class="nav-link active">New applicants (<?php Candidate::count_candidates(' IS NULL'); ?>)</a>
          </li>
          <li class="nav-item">
            <a id="approved_applicants_tab" href="hr-dashboard-approved.php" class="nav-link">Approved (<?php Candidate::count_candidates("='Y'"); ?>)</a>
          </li>
          <li class="nav-item">
            <a id="reject_applicants_tab" href="hr-dashboard-reject.php" class="nav-link">Reject (<?php Candidate::count_candidates("='N'"); ?>)</a>
          </li>
        </ul>
      </div>
      <div class="card-body">
        <table class="table table-hover">
          <thead class="table table-secondary">
            <tr class="">
              <th>#</th>
              <th>Published job</th>
              <th>Candidate profile</th>
              <th>Interviewed</th>
              <th>Approved</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $candidate = new Candidate;
            $new_candidate = $candidate->display_candidate(' IS NULL');
            $candidate_data = $new_candidate->fetchAll(PDO::FETCH_BOTH);
            foreach ($candidate_data as $key => $value) : ?>
              <tr class="js-applicants-data">
                <th scope="row" class="js-applicants-counter">
                  <?php echo $key + 1; ?>
                </th>
                <td class="w-50">
                  <p class="m-0 small"><span class="fw-bold">Date:</span> <?php echo $value['published_date']; ?></p>
                  <?php echo (!$value['frontend_tag']) ? '' : "<span class=\"badge bg-secondary me-1\"> {$value['frontend_tag']} </span>"; ?>
                  <?php echo (!$value['backend_tag']) ? '' : "<span class=\"badge bg-dark me-1\"> {$value['backend_tag']} </span>"; ?>
                  <?php echo (!$value['fullstack_tag']) ? '' : "<span class=\"badge bg-success me-1\"> {$value['fullstack_tag']} </span>"; ?>
                  <?php echo (!$value['qa_tag']) ? '' : "<span class=\"badge bg-danger me-1\"> {$value['qa_tag']} </span>"; ?>
                  <?php echo (!$value['mobdev_tag']) ? '' : "<span class=\"badge bg-warning me-1\"> {$value['mobdev_tag']} </span>"; ?>
                  <?php echo (!$value['ux_ui_tag']) ? '' : "<span class=\"badge bg-primary me-1\"> {$value['ux_ui_tag']} </span>"; ?>
                  <span class="badge bg-info"> <?php echo $value['job_time']; ?> </span>
                  <p class="m-0"><b>Title:</b> <?php echo $value['job_title']; ?></p>
                  <p class="mt-3 d-none">
                    <?php echo $value['job_description']; ?>
                  </p>
                  <button class="mt-3 me-3 btn btn-outline-primary btn-sm d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1 bi bi-chevron-double-right" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
                      <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
                    </svg>
                    Read more
                  </button>
                </td>
                <td class="w-50">
                  <p class="small mb-0"><b>Date: </b><?php echo $value['applied_date']; ?></p>
                  <p class="mb-2"><b>Name: </b><?php echo "{$value['first_name']} {$value['last_name']}";  ?></p>
                  <div class="js-job-seeker-toogle-btns d-flex mb-2">
                    <button class="me-3 btn btn-outline-primary btn-sm d-flex align-items-center">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1 bi bi-chevron-double-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
                        <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
                      </svg>
                      Motivation Speech
                    </button>
                    <button class="me-3 btn btn-outline-primary btn-sm d-flex align-items-center">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1 bi bi-chevron-double-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
                        <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
                      </svg>
                      View Profile
                    </button>
                    <button class="js-send-message-job-seeker btn btn-outline-primary btn-sm d-flex align-items-center">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1 bi bi-reply" viewBox="0 0 16 16">
                        <path d="M6.598 5.013a.144.144 0 0 1 .202.134V6.3a.5.5 0 0 0 .5.5c.667 0 2.013.005 3.3.822.984.624 1.99 1.76 2.595 3.876-1.02-.983-2.185-1.516-3.205-1.799a8.74 8.74 0 0 0-1.921-.306 7.404 7.404 0 0 0-.798.008h-.013l-.005.001h-.001L7.3 9.9l-.05-.498a.5.5 0 0 0-.45.498v1.153c0 .108-.11.176-.202.134L2.614 8.254a.503.503 0 0 0-.042-.028.147.147 0 0 1 0-.252.499.499 0 0 0 .042-.028l3.984-2.933zM7.8 10.386c.068 0 .143.003.223.006.434.02 1.034.086 1.7.271 1.326.368 2.896 1.202 3.94 3.08a.5.5 0 0 0 .933-.305c-.464-3.71-1.886-5.662-3.46-6.66-1.245-.79-2.527-.942-3.336-.971v-.66a1.144 1.144 0 0 0-1.767-.96l-3.994 2.94a1.147 1.147 0 0 0 0 1.946l3.994 2.94a1.144 1.144 0 0 0 1.767-.96v-.667z" />
                      </svg>
                      Send Message
                    </button>
                  </div>
                  <p class="d-none">
                    <?php echo $value['motivation_speech']; ?>
                  </p>
                  <!-- User profile -->
                  <div id="candidate_profile" class="d-none card shadow rounded">
                    <div class="d-flex justify-content-between mt-4">
                      <div class="ms-3">
                        <h4 class="card-text"><?php echo "{$value['first_name']}'s profile:"; ?></h4>
                        <button class="btn btn-primary btn-sm d-flex align-items-center">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1 bi bi-download" viewBox="0 0 16 16">
                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                          </svg>
                          Resume
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <p class="m-0"><b>Email: </b><?php echo $value['email']; ?></p>
                      <p class="m-0"><b>Website: </b>
                        <a href="<?php echo $value['website']; ?>" target="_blank"><?php echo $value['website']; ?></a>
                      </p>
                      <p class="m-0"><b>Short introduction:</b></p>
                      <p><?php echo $value['short_introduction']; ?></p>
                    </div>
                  </div>
                  <!-- SEND MESSAGE -->
                  <div class="js-message-job-seeker-box card shadow rounded d-none">
                    <div class="d-flex justify-content-between mt-3 mb-2 px-3">
                      <h4 class="m-0">Send message:</h4>
                      <button class="btn-close align-self-end"></button>
                    </div>
                    <div class="card-body">
                      <form method="POST">
                        <div class="js-scs-msg-send"></div>
                        <div class="form-group mb-2">
                          <label for="to"><b>From:</b></label>
                          <input type="text" class="form-control form-control-sm" name="hr_id" value="<?php echo $value[2]; ?>" disabled>
                          <input type="hidden" value="<?php echo $_SESSION['hr_id']; ?>">
                        </div>
                        <div class="form-group mb-2">
                          <label for="to"> <b>To:</b></label>
                          <input type="email" class="form-control form-control-sm" name="job_seeker_id" value="<?php echo $value['first_name']; ?>" disabled>
                          <input type="hidden" value="<?php echo $value['job_seeker_id']; ?>">
                        </div>
                        <div class="form-group mb-2">
                          <label for="subject"><b>Subject:</b></label>
                          <input type="text" class="form-control form-control-sm" name="message_subject" value="">
                          <div class="js-subject-response-text"></div>
                        </div>
                        <div class="form-group">
                          <label for="message"><b>Message:</b></label>
                          <textarea name="message" class="form-control" rows="6"></textarea>
                          <div class="js-message-response-text"></div>
                        </div>
                        <button class="js-submit-sending-msg-job-seeker btn btn-primary d-flex align-items-center mt-3">
                          <span>Send</span>
                          <svg class="ms-3" xmlns="http://www.w3.org/2000/svg" width="16.987" height="16.557" viewBox="0 0 16.987 16.557">
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
                </td>
                <td class="js-is-interviewed text-center">
                  <?php if ($value['is_interviewed'] === 'Y') : ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-check2-circle text-success" viewBox="0 0 16 16">
                      <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                      <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                    </svg>
                  <?php elseif ($value['is_interviewed'] === 'N') : ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-x-circle text-danger" viewBox="0 0 16 16">
                      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                      <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                    </svg>
                  <?php else : ?>
                    <div class="d-flex justify-content-center">
                      <button class="js-interview-answer btn btn-success btn-sm me-2" value="Y">Yes</button>
                      <button class="js-interview-answer btn btn-danger btn-sm" value="N">No</button>
                      <span class="tooltip-icon ms-3" data-bs-animation="false" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Your decision can't be reversed!">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                          <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                        </svg>
                      </span>
                      <input type="hidden" class="js-job-id" value="<?php echo $value['job_id']; ?>">
                      <input type="hidden" class="js-job-seeker-id" value="<?php echo $value['job_seeker_id']; ?>">
                    </div>
                  <?php endif; ?>
                </td>
                <td id="is_approved" class="text-center">
                  <div class="d-flex justify-content-center">
                    <button class="js-approve-answer btn btn-success btn-sm me-2" value="Y">Yes</button>
                    <button class="js-approve-answer btn btn-danger btn-sm" value="N">No</button>
                    <input type="hidden" class="js-job-id" value="<?php echo $value['job_id']; ?>">
                    <input type="hidden" class="js-job-seeker-id" value="<?php echo $value['job_seeker_id']; ?>">
                    <input type="hidden" class="js-candidate-name" name="candidate_name" value="<?php echo $value['first_name']; ?>">
                  </div>
                  <div class="js-confirm-approve"></div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?php echo ($new_candidate->rowCount() === 0) ? '<h5>There are no candidates...</h5>' : ''; ?>
      </div>
    </div>
  </div>

  <!-- Message container -->
  <div class="card shadow-lg p-3 mb-5 bg-body rounded message_box d-none">
    <div class="d-flex justify-content-between mt-3 mb-2 px-3">
      <h4 class="m-0">Messages:</h4>
      <button class="btn-close align-self-end"></button>
    </div>
    <div class="card-body">
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
        $inbox = $msg_box->inbox_hr();
        $inbox_data = $inbox->fetchAll(PDO::FETCH_BOTH);
        foreach ($inbox_data as $value) : ?>
          <li class="js-inbox-li list-group-item pb-0">
            <div class="d-flex justify-content-between align-items-center">
              <p class="text-muted small">sent by <b class="text-dark"> <?php echo "{$value['company_name']} {$value['first_name']} {$value['last_name']}"; ?> </b></p>
              <p class="small"><?php echo $value['send_date']; ?></p>
            </div>
            <div class="chevron_btn d-flex justify-content-between align-items-start">
              <p><b>Subject:</b><?php echo $value['subject']; ?></p>
              <span class="ms-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                </svg>
              </span>
            </div>
            <p class="chevron-expand-text">
              <?php echo $value['inbox_msg']; ?>
            </p>
            <?php if ($value['company_id'] !== null) : ?>
              <button class="js-reply-company btn btn-primary btn-sm d-flex align-items-center mb-3">
                <span>Reply</span>
                <svg class="ms-2" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 16.987 16.557">
                  <g id="send" transform="translate(0 -6.196)">
                    <g id="Group_216" data-name="Group 216" transform="translate(0 6.197)">
                      <path id="Path_22" data-name="Path 22" d="M16.809,13.7a1.78,1.78,0,0,0-.826-.826L2.556,6.375A1.78,1.78,0,0,0,.128,8.638l2.335,5.836L.128,20.311a1.78,1.78,0,0,0,2.428,2.264l13.427-6.5A1.78,1.78,0,0,0,16.809,13.7ZM2.039,21.505a.593.593,0,0,1-.809-.755L3.5,15.067H15.344ZM3.5,13.881,1.23,8.2a.593.593,0,0,1,.809-.753l13.305,6.436H3.5Z" transform="translate(0 -6.197)" fill="#fff" />
                    </g>
                  </g>
                </svg>
              </button>
            <?php else : ?>
              <button class="js-reply-job-seeker btn btn-primary btn-sm d-flex align-items-center mb-3">
                <span>Reply</span>
                <svg class="ms-2" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 16.987 16.557">
                  <g id="send" transform="translate(0 -6.196)">
                    <g id="Group_216" data-name="Group 216" transform="translate(0 6.197)">
                      <path id="Path_22" data-name="Path 22" d="M16.809,13.7a1.78,1.78,0,0,0-.826-.826L2.556,6.375A1.78,1.78,0,0,0,.128,8.638l2.335,5.836L.128,20.311a1.78,1.78,0,0,0,2.428,2.264l13.427-6.5A1.78,1.78,0,0,0,16.809,13.7ZM2.039,21.505a.593.593,0,0,1-.809-.755L3.5,15.067H15.344ZM3.5,13.881,1.23,8.2a.593.593,0,0,1,.809-.753l13.305,6.436H3.5Z" transform="translate(0 -6.197)" fill="#fff" />
                    </g>
                  </g>
                </svg>
              </button>
            <?php endif; ?>
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
                  <div class="js-scs-msg-send"></div>
                  <div class="form-group mb-2">
                    <label for="to"><b>From:</b></label>
                    <input type="text" class="form-control form-control-sm" name="reply_hr_id" value="<?php echo $value['username']; ?>" disabled>
                    <input type="hidden" value="<?php echo $_SESSION['hr_id']; ?>">
                  </div>
                  <div class="form-group mb-2">
                    <label for="to"> <b>To:</b></label>
                    <input type="email" class="form-control form-control-sm" name="reply_job_seeker_id'" value="<?php echo "{$value['company_name']} {$value['first_name']} {$value['last_name']}"; ?>" disabled>
                    <?php if ($value['company_id'] !== null) : ?>
                      <input type="hidden" value="<?php echo $value['company_id']; ?>">
                    <?php else : ?>
                      <input type="hidden" value="<?php echo $value['job_seeker_id']; ?>">
                    <?php endif; ?>
                  </div>
                  <div class="form-group mb-2">
                    <label for="subject"><b>Subject:</b></label>
                    <input type="text" class="form-control form-control-sm" name="message_subject" value="">
                    <div class="js-subject-response-text"></div>
                  </div>
                  <div class="form-group">
                    <label for="message"><b>Message:</b></label>
                    <textarea name="message" class="form-control" rows="6"></textarea>
                    <div class="js-message-response-text"></div>
                  </div>
                  <?php if ($value['company_id'] !== null) : ?>
                    <button class="js-submit-sending-msg-company btn btn-primary btn-sm d-flex align-items-center mt-3">
                      <span>Send</span>
                      <svg class="ms-2" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 16.987 16.557">
                        <g id="send" transform="translate(0 -6.196)">
                          <g id="Group_216" data-name="Group 216" transform="translate(0 6.197)">
                            <path id="Path_22" data-name="Path 22" d="M16.809,13.7a1.78,1.78,0,0,0-.826-.826L2.556,6.375A1.78,1.78,0,0,0,.128,8.638l2.335,5.836L.128,20.311a1.78,1.78,0,0,0,2.428,2.264l13.427-6.5A1.78,1.78,0,0,0,16.809,13.7ZM2.039,21.505a.593.593,0,0,1-.809-.755L3.5,15.067H15.344ZM3.5,13.881,1.23,8.2a.593.593,0,0,1,.809-.753l13.305,6.436H3.5Z" transform="translate(0 -6.197)" fill="#fff" />
                          </g>
                        </g>
                      </svg>
                    </button>
                  <?php else : ?>
                    <button class="js-submit-sending-msg-job-seeker btn btn-primary btn-sm d-flex align-items-center mt-3">
                      <span>Send</span>
                      <svg class="ms-2" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 16.987 16.557">
                        <g id="send" transform="translate(0 -6.196)">
                          <g id="Group_216" data-name="Group 216" transform="translate(0 6.197)">
                            <path id="Path_22" data-name="Path 22" d="M16.809,13.7a1.78,1.78,0,0,0-.826-.826L2.556,6.375A1.78,1.78,0,0,0,.128,8.638l2.335,5.836L.128,20.311a1.78,1.78,0,0,0,2.428,2.264l13.427-6.5A1.78,1.78,0,0,0,16.809,13.7ZM2.039,21.505a.593.593,0,0,1-.809-.755L3.5,15.067H15.344ZM3.5,13.881,1.23,8.2a.593.593,0,0,1,.809-.753l13.305,6.436H3.5Z" transform="translate(0 -6.197)" fill="#fff" />
                          </g>
                        </g>
                      </svg>
                    </button>
                  <?php endif; ?>
                </form>
              </div>
            </div>
          </li>
        <?php endforeach; ?>
        <?php echo ($inbox->rowCount() === 0) ? '<h5>There are no inbox messages...</h5>' : ''; ?>
      </ul>
      <ul id="sent_ul" class="list-group-flush p-0 pt-3">
        <?php
        $sent = $msg_box->sent_by_hr();
        $sent_data = $sent->fetchAll(PDO::FETCH_ASSOC);
        foreach ($sent_data as $value) : ?>
          <li class="js-sent-li list-group-item pb-0">
            <div class="d-flex justify-content-between align-items-center">
              <p class="text-muted small">sent to <b class="text-dark"> <?php echo "{$value['company_name']} {$value['first_name']} {$value['last_name']}"; ?> </b></p>
              <p class="small"><?php echo $value['send_date']; ?></p>
            </div>
            <div class="chevron_btn d-flex justify-content-between align-items-start">
              <p><b>Subject: </b><?php echo $value['subject']; ?></p>
              <span class="ms-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                </svg>
              </span>
            </div>
            <p class="chevron-expand-text">
              <?php echo $value['sent_msg']; ?>
            </p>
          </li>
        <?php endforeach; ?>
        <?php echo ($sent->rowCount() === 0) ? '<h5>There are no sent messages...</h5>' : ''; ?>
      </ul>
    </div>
  </div>
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
  <script src="assets/js/functions.js"></script>
  <script src="assets/js/ajax-hr.js"></script>
  <script src="assets/js/message.js"></script>
</body>

</html>