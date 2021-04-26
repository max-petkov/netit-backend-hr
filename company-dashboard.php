<?php session_start(); ?>
<?php include_once 'src/functions.php'; ?>
<?php include_once 'src/Profile.php'; ?>
<?php include_once 'src/Jobs.php'; ?>
<?php include_once 'src/Message.php'; ?>
<?php include_once 'src/Candidate.php'; ?>
<?php login_required($_SESSION['company_id']); ?>

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
            <li class="nav-item dropdown">
              <?php
              $profile = new Profile;
              $profile->profile_data('tb_company_profile', $_SESSION['company_id']);
              ?>
              <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span id="greetings"></span>
                <span id="greetings_company_name">
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
                <li id="upload_img_btn">
                  <a id="open_upload_img" class="dropdown-item xsm-text-class" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1 bi bi-upload" viewBox="0 0 16 16">
                      <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                      <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z" />
                    </svg>
                    Upload logo</a>
                </li>
                <li>
                  <a class="js-message-icon dropdown-item xsm-text-class" href="#">Messages</a>
                </li>
                <li>
                  <a id="open_sending_msg_container" class="dropdown-item xsm-text-class" href="#">
                    <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 16.987 16.557">
                      <g id="send" transform="translate(0 -6.196)">
                        <g id="Group_216" data-name="Group 216" transform="translate(0 6.197)">
                          <path id="Path_22" data-name="Path 22" d="M16.809,13.7a1.78,1.78,0,0,0-.826-.826L2.556,6.375A1.78,1.78,0,0,0,.128,8.638l2.335,5.836L.128,20.311a1.78,1.78,0,0,0,2.428,2.264l13.427-6.5A1.78,1.78,0,0,0,16.809,13.7ZM2.039,21.505a.593.593,0,0,1-.809-.755L3.5,15.067H15.344ZM3.5,13.881,1.23,8.2a.593.593,0,0,1,.809-.753l13.305,6.436H3.5Z" transform="translate(0 -6.197)" fill="#212529" />
                        </g>
                      </g>
                    </svg>Send HR message</a>
                </li>
                <div class="dropdown-divider"></div>
                <li id="publish_job_button">
                  <a class="dropdown-item xsm-text-class d-flex align-items-center" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1 bi bi-upload" viewBox="0 0 16 16">
                      <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                      <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z" />
                    </svg>
                    <span>Publish job</span>
                  </a>
                </li>
                <li>
                  <a id="approved_candidates" class="dropdown-item xsm-text-class" href="#">Approved candidates</a>
                </li>
                <li>
                  <a id="hr_button" class="dropdown-item xsm-text-class" href="#"><b>Create HR account</b></a>
                </li>
                <div class="dropdown-divider"></div>

                <li class="dropdown-item xsm-text-class d-flex align-items-center">
                  <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                  </svg>
                  <span id="company_name" class="me-1">
                    <?php echo $profile->name;; ?>
                  </span>
                </li>
                <li class="dropdown-item xsm-text-class d-flex align-items-center">
                  <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                    <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
                    <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                  </svg>
                  <span id="company_address">
                    <?php echo $profile->address; ?>
                  </span>
                </li>
                <li class="dropdown-item xsm-text-class d-flex align-items-center">
                  <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z" />
                  </svg>
                  <span id="company_email">
                    <?php echo $profile->email; ?>
                  </span>
                </li>
                <li class="dropdown-item xsm-text-class d-flex align-items-center">
                  <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link-45deg" viewBox="0 0 16 16">
                    <path d="M4.715 6.542L3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.001 1.001 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z" />
                    <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 0 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 0 0-4.243-4.243L6.586 4.672z" />
                  </svg>
                  <a href="<?php echo $profile->website; ?>" target="_blank" class="text-decoration-none" id="company_website">
                    <?php echo $profile->website; ?>
                  </a>
                </li>
                <div class="dropdown-divider"></div>
                <li id="profile_button">
                  <a class="dropdown-item xsm-text-class d-flex align-items-center" href="src/logout.php">
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
          <li id="inbox_company_counter_container" class="nav-item">
            <a id="inbox_company_counter" href="#" class="js-message-icon nav-link d-flex align-items-center">
              <svg id="envelope_close" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="me-1 envelope_closed bi bi-envelope" viewBox="0 0 16 16">
                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z" />
              </svg>
              <svg id="envelope_open" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="me-1 d-none bi bi-envelope-open" viewBox="0 0 16 16">
                <path d="M8.47 1.318a1 1 0 0 0-.94 0l-6 3.2A1 1 0 0 0 1 5.4v.818l5.724 3.465L8 8.917l1.276.766L15 6.218V5.4a1 1 0 0 0-.53-.882l-6-3.2zM15 7.388l-4.754 2.877L15 13.117v-5.73zm-.035 6.874L8 10.083l-6.965 4.18A1 1 0 0 0 2 15h12a1 1 0 0 0 .965-.738zM1 13.117l4.754-2.852L1 7.387v5.73zM7.059.435a2 2 0 0 1 1.882 0l6 3.2A2 2 0 0 1 16 5.4V14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5.4a2 2 0 0 1 1.059-1.765l6-3.2z" />
              </svg>
              <span class="badge bg-danger rounded-pill"><?php Message::count_inbox_msg('tb_msg_box_company', 'company_id', $_SESSION['company_id']); ?></span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Message container -->
  <div class="js-message-box card shadow-lg rounded d-none">
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
        $inbox = $msg_box->inbox_company();
        $inbox_data = $inbox->fetchAll(PDO::FETCH_BOTH);
        foreach ($inbox_data as $value) : ?>
          <li class="js-inbox-li list-group-item pb-0">
            <div class="d-flex justify-content-between align-items-center">
              <p class="text-muted small">sent by <b class="text-dark"> <?php echo $value['username']; ?> </b></p>
              <p class="small"><?php echo $value['send_date']; ?></p>
            </div>
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
            <button class="js-reply-from-company-to-hr btn btn-primary btn-sm d-flex align-items-center mb-3">
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
                    <input type="text" class="form-control form-control-sm" value="<?php echo $value['company_name']; ?>" disabled>
                    <input type="hidden" name="from" value="<?php echo $_SESSION['company_id']; ?>">
                  </div>
                  <div class="form-group mb-2">
                    <label for="to"> <b>To:</b></label>
                    <input type="email" class="form-control form-control-sm" value="<?php echo $value['username']; ?>" disabled>
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
                  <button type="submit" class="js-submit-sending-from-company-to-hr btn btn-primary btn-sm d-flex align-items-center mt-3">
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
        $sent = $msg_box->sent_by_company();
        $sent_data = $sent->fetchAll(PDO::FETCH_ASSOC);
        foreach ($sent_data as $value) : ?>
          <li class="js-sent-li list-group-item pb-0">
            <div class="d-flex justify-content-between align-items-center">
              <p class="text-muted small">sent to <b class="text-dark"> <?php echo $value['username']; ?> </b></p>
              <p class="small"><?php echo $value['send_date']; ?></p>
            </div>
            <div class="d-flex justify-content-between align-items-start">
              <p class="text-break"><b>Subject:</b><?php echo $value['subject']; ?></p>
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

  <!-- Send HR message -->
  <div id="send_msg_hr_box" class="js-send-msg-hr-box js-send-msg-box-md card shadow rounded mb-4 d-none">
    <div class="d-flex justify-content-between mt-3 mb-2 px-3">
      <h4 class="m-0">Send message:</h4>
      <button class="btn-close align-self-end"></button>
    </div>
    <div class="card-body">
      <form id="msg_from_company_to_hr" method="POST">
        <?php
        $msg_data = new Message;
        $msg_data->get_msg_data();
        ?>
        <div class="js-scs-msg"></div>
        <div class="form-group mb-2">
          <label for="to"><b>From:</b></label>
          <input type="text" class="form-control form-control-sm" value="<?php echo $msg_data->company_username; ?>" disabled>
          <input type="hidden" name="from" value="<?php echo $msg_data->company_id; ?>">
        </div>
        <div class="form-group mb-2">
          <label for="to"> <b>To:</b></label>
          <input type="text" class="form-control form-control-sm" value="<?php echo $msg_data->hr_username; ?>" disabled>
          <input type="hidden" name="to" value="<?php echo $msg_data->hr_id; ?>">
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
        <button type="submit" class="js-send-msg-company-to-hr btn btn-primary btn-sm d-flex align-items-center mt-3">
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

  <!-- Edit profile -->
  <div class="card d-none profile_box shadow-lg p-3 mb-5 bg-body rounded">
    <div class="d-flex justify-content-end pt-2">
      <button class="btn-close"></button>
    </div>
    <div class="card-body pt-0 px-0 px-md-2">
      <form id="update_company_profile" method="POST" class="row edit-profile pb-3">
        <div class="ps-3 mb-3">
          <h4 class="card-text">Edit profile:</h4>
          <button class="btn btn-primary btn-sm d-flex align-items-center">
            <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
              <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
            </svg>
            Save profile
          </button>
        </div>
        <div id="success_mess_validation"></div>
        <div class="form-group row mb-0 mb-sm-2 pe-0">
          <div class="form-group col-0 col-sm-6 pe-0 pe-sm-2 mb-2 mb-sm-0">
            <label for="first_name">Company name</label>
            <input type="text" class="form-control form-control-sm" name="name" value="<?php echo $profile->name;; ?>">
            <div></div>
          </div>
          <div class="form-group col-0 pe-0 col-sm-6 mb-2 mb-sm-0">
            <label for="last_name">Slogan</label>
            <input type="text" class="form-control form-control-sm" name="slogan" placeholder="Write company slogan..." value="<?php echo $profile->slogan; ?>">
            <div></div>
          </div>
        </div>

        <div class="form-group row mb-0 mb-sm-2 pe-0">
          <div class="form-group col-0 col-sm-6 pe-0 pe-sm-2 mb-2 mb-sm-0">
            <label for="address_employee">Address</label>
            <input type="text" class="form-control form-control-sm" name="address" value="<?php echo $profile->address; ?>">
            <div></div>
          </div>
          <div class="form-group col-0 col-sm-6 pe-0 mb-2 mb-sm-0">
            <label for="website_employee">Website</label>
            <input type="text" class="form-control form-control-sm" name="website" value="<?php echo $profile->website; ?>">
            <div></div>
          </div>
        </div>

        <div class="form-group row mb-0 mb-sm-2 pe-0">
          <div class="form-group col-0 col-sm-6 pe-0 pe-sm-2 mb-2 mb-sm-0">
            <label for="username">Username</label>
            <input type="text" class="form-control form-control-sm" name="username" value="<?php echo $profile->username; ?>" disabled>
          </div>
          <div class="form-group col-0 col-sm-6 pe-0 mb-2 mb-sm-0">
            <label for="email">Email</label>
            <input type="email" class="form-control form-control-sm" name="email" value="<?php echo $profile->email; ?>" disabled>
          </div>
        </div>
        <div class="company_branches">
          <div class="form-group">
            <label for="it_branches">IT branches</label>
            <p id="checkbox_response" class="mb-2"></p>
            <div class="form-check my-2">
              <input id="frontend_checked_status" type="checkbox" class="js-checkbox-length form-check-input" name="frontend" value="frontend" <?php echo (!$profile->frontend) ? '' : 'checked'; ?>>
              <label class="form-check-label" for="it_branch">Front-end Development</label>
            </div>
            <div class="form-check mb-2">
              <input id="backend_checked_status" type="checkbox" class="js-checkbox-length form-check-input" name="backend" value="backend" <?php echo (!$profile->backend) ? '' : 'checked'; ?>>
              <label class="form-check-label" for="it_branch">Back-end Development</label>
            </div>
            <div class="form-check mb-2">
              <input id="fullstack_checked_status" type="checkbox" class="js-checkbox-length form-check-input" name="fullstack" value="fullstack" <?php echo (!$profile->fullstack) ? '' : 'checked'; ?>>
              <label class="form-check-label" for="it_branch">Fullstack Development</label>
            </div>
            <div class="form-check mb-2">
              <input id="qa_checked_status" type="checkbox" class="js-checkbox-length form-check-input" name="qa" value="qa" <?php echo (!$profile->qa) ? '' : 'checked'; ?>>
              <label class="form-check-label" for="it_branch">Quality Assurance</label>
            </div>
            <div class="form-check mb-2">
              <input id="mobdev_checked_status" type="checkbox" class="js-checkbox-length form-check-input" name="mobdev" value="mobdev" <?php echo (!$profile->mobdev) ? '' : 'checked'; ?>>
              <label class="form-check-label" for="it_branch">Mobile Development</label>
            </div>
            <div class="form-check mb-2">
              <input id="ux_ui_checked_status" type="checkbox" class="js-checkbox-length form-check-input" name="ux/ui" value="ux/ui" <?php echo (!$profile->ux_ui) ? '' : 'checked'; ?>>
              <label class="form-check-label" for="it_branch">UX/UI</label>
            </div>
          </div>
        </div>
        <div class="form-group mb-2">
          <label for="company_description">Company description</label>
          <textarea name="company_description" class="form-control form-control-sm" rows="4"><?php echo $profile->company_description; ?></textarea>
          <div></div>
        </div>
        <div class="form-group mb-2">
          <label for="company_history">Company history</label>
          <textarea name="company_history" class="form-control form-control-sm" rows="4" placeholder="Write company history..."><?php echo $profile->company_history; ?></textarea>
          <div></div>
        </div>
        <div class="form-group mb-2">
          <label for="company_mission">Company mission</label>
          <textarea name="company_mission" class="form-control form-control-sm" rows="4" placeholder="Write company mission..."><?php echo $profile->company_mission; ?></textarea>
          <div></div>
        </div>
      </form>
    </div>
  </div>

  <!-- Upload logo image -->
  <?php if ($profile->file_mime !== null) : ?>
    <div class="js-upload-logo-box card shadow rounded">
      <div class="d-flex justify-content-between mt-3 mb-2 px-3">
        <h4 class="m-0">Upload logo:</h4>
        <button class="btn-close align-self-end"></button>
      </div>
      <div id="change_container" class="card-body">
        <div id="changed_data">
          <img id="showcase_company_logo" src="data:<?php $profile->file_mime; ?>;base64,<?php echo base64_encode($profile->file_data); ?>" class="me-2" alt="uploaded-picture" width="80px">
          <div class="mt-3">
            <button id="change_logo" class="btn btn-primary btn-sm">Change</button>
            <button id="close_change_logo" class="btn btn-secondary btn-sm d-none ms-1">Close</button>
            <div></div>
          </div>
        </div>
      </div>
    </div>
  <?php else : ?>
    <div class="js-upload-logo-box card  shadow rounded">
      <div class="d-flex justify-content-between mt-3 mb-2 px-3">
        <h4 class="m-0">Upload logo:</h4>
        <button class="btn-close align-self-end"></button>
      </div>
      <div class="card-body">
        <form id="upload_company_img" method="POST" enctype="multipart/form-data">
          <div class="form-group mb-3 d-flex flex-column">
            <input type="file" class="form-control-file" name="img_file">
            <div></div>
            <small class="form-text form-muted">Max 3mb size</small>
          </div>
          <input type="hidden" name="upload_file">
          <input type="submit" id="submit_upload" name="upload_file" class="btn btn-primary btn-sm" value="Upload">
        </form>
      </div>
    </div>
  <?php endif; ?>

  <!-- Create HR acc-->
  <div class="js_hr_box js-create-hr-xsm-box card col-8 mx-auto shadow rounded">
    <div class="d-flex justify-content-between mt-3 mb-2 px-3">
      <h4 class="m-0">Create HR account:</h4>
      <button class="btn-close align-self-end"></button>
    </div>
    <div class="card-body">
      <form id="hr_acc_form" method="POST" action="company-dashboard.php">
        <div id="hr_succ_mess"></div>
        <div class="form-group mb-2">
          <label for="hr_account">Username</label>
          <input id="hr_username" type="text" name="username" class="form-control form-control-sm">
          <div></div>
        </div>
        <div class="form-group mb-2">
          <label for="hr_account">Email</label>
          <input id="hr_email" type="text" name="email" class="form-control form-control-sm">
          <div></div>
        </div>
        <div class="form-group mb-2">
          <label for="hr_account">Password</label>
          <input type="password" name="password" class="form-control form-control-sm">
          <div></div>
        </div>
        <div class="form-group mb-3">
          <label for="hr_account">Confirm password</label>
          <input type="password" name="confirm_password" class="form-control form-control-sm">
          <div></div>
        </div>
        <input type="submit" value="Submit" class="btn btn-primary">
      </form>
    </div>
  </div>

  <!-- Publish job -->
  <div class="d-none publish_job_box">
    <div class="card mx-auto shadow rounded p-3">
      <div class="d-flex justify-content-between mt-3 mb-2 px-3">
        <h4 class="m-0">Publish job:</h4>
        <button class="btn-close align-self-end"></button>
      </div>
      <div class="card-body px-0 px-sm-3">
        <form id="publish_form" method="POST" action="company-dashboard.php">
          <div id="publish_succ_mess"></div>
          <div class="form-group mb-3">
            <label for="job_title" class="fw-bold">Job title</label>
            <input type="text" name="job_title" class="form-control form-control-sm">
            <div></div>
          </div>
          <div class="mb-3">
            <div class="form-group d-flex flex-column flex-sm-row">
              <div class="form-group mb-0 mb-sm-2 order-1">
                <label for="job_time" class="fw-bold">Job time</label>
                <div class="form-group mt-1">
                  <input type="checkbox" name="job_fulltime" class="job_time_length form-check-input" value="full time">
                  <label for="job_title">Full time</label>
                </div>
                <input type="checkbox" name="job_part_time" class="job_time_length form-check-input" value="part time">
                <label for="job_title">Part time</label>
              </div>

              <div class="me-4">
                <div class="form-group">
                  <label for="it_branches" class="fw-bold">IT tag
                    <span class="tooltip-icon" data-bs-animation="false" data-bs-toggle="tooltip" data-bs-placement="bottom" title="IT tag will help candidates to find your publish easy!">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                      </svg>
                    </span>
                  </label>
                  <div class="form-check mt-1">
                    <input id="frontend_checked_tag" type="checkbox" class="it_tag_length form-check-input" name="frontend" value="frontend">
                    <label class="form-check-label" for="it_branch">Front-end Development</label>
                  </div>
                  <div class="form-check mb-2">
                    <input id="backend_checked_tag" type="checkbox" class="it_tag_length form-check-input" name="backend" value="backend">
                    <label class="form-check-label" for="it_branch">Back-end Development</label>
                  </div>
                  <div class="form-check mb-2">
                    <input id="fullstack_checked_tag" type="checkbox" class="it_tag_length form-check-input" name="fullstack" value="fullstack">
                    <label class="form-check-label" for="it_branch">Fullstack Development</label>
                  </div>
                  <div class="form-check mb-2">
                    <input id="qa_checked_tag" type="checkbox" class="it_tag_length form-check-input" name="qa" value="qa">
                    <label class="form-check-label" for="it_branch">Quality Assurance</label>
                  </div>
                  <div class="form-check mb-2">
                    <input id="mobdev_checked_tag" type="checkbox" class="it_tag_length form-check-input" name="mobdev" value="mobdev">
                    <label class="form-check-label" for="it_branch">Mobile Development</label>
                  </div>
                  <div class="form-check mb-2">
                    <input id="ux_ui_checked_tag" type="checkbox" class="it_tag_length form-check-input" name="ux/ui" value="ux/ui">
                    <label class="form-check-label" for="it_branch">UX/UI</label>
                  </div>
                </div>
              </div>
            </div>
            <p id="job_tag_response_text" class="mb-0"></p>
            <p id="job_time_response_text" class="mb-0"></p>
          </div>
          <div class="form-group mb-3 d-flex flex-column flex-sm-row">
            <div class="form-group me-0 me-sm-3 mb-2 mb-sm-0">
              <label for="" class="fw-bold">Salary:</label>
              <input type="text" class="form-control" name="salary">
              <div></div>
            </div>
            <div class="form-group me-0 me-sm-3 mb-2 mb-sm-0">
              <label for="job_salary_currency" class="fw-bold">Currency:</label>
              <div class="form-group me-2">
                <input type="radio" class="form-check-input" name="currency" value="€">
                <label for="euro_currency">€</label>
              </div>
              <div class="form-group">
                <input type="radio" class="form-check-input" name="currency" value="$">
                <label for="dollar_currency">$</label>
              </div>
              <p id="currency_response_text" class="m-0"></p>
            </div>
            <div class="form-group">
              <label for="job_salary_year_month" class="fw-bold">Month/Year:</label>
              <div class="form-group me-2">
                <input type="radio" class="form-check-input" name="month_year_salary" value="per month">
                <label for="month_salary">per month</label>
              </div>
              <div class="form-group">
                <input type="radio" class="form-check-input" name="month_year_salary" value="per year">
                <label for="year_salar">per year</label>
              </div>
              <p id="job_month_year_response_text" class="m-0"></p>
            </div>
          </div>
          <div class="form-group">
            <label for="job_description" class="fw-bold">Job Description</label>
            <textarea name="description" rows="8" class="form-control"></textarea>
            <div></div>
          </div>
          <input type="submit" value="Publish" class="btn btn-primary mt-3">
          <input type="hidden" name="username" value="<?php echo $profile->username; ?>">
          <input type="hidden" name="name" value="<?php echo $profile->name; ?>">
          <input type="hidden" name="email" value="<?php echo $profile->email; ?>">
        </form>
      </div>
    </div>
  </div>

  <!-- Company showcase -->
  <section class="container mt-4 my-md-5">
    <div class="row">
      <div class="col-0 col-md-9 mx-auto">
        <div class="mb-3 d-flex">
          <di id="showcase_container">
            <div id="showcase_data">
              <div class="d-flex">
                <?php if ($profile->file_data !== null) : ?>
                  <img id="showcase_company_logo" src="data:<?php $profile->file_mime; ?>;base64,<?php echo base64_encode($profile->file_data); ?>" class="me-2" alt="uploaded-picture" width="64px">
                <?php endif; ?>
                <h1 id="showcase_company_name" class="m-0 display-5">
                  <?php echo $profile->name; ?>
                  <p id="showcase_company_slogan" class="lead mb-0"><?php echo $profile->slogan; ?></p>
                </h1>
              </div>
              <div id="showcase_it_branches" class="badges mt-1">
                <div id="badge_it_container" classt="small">
                  <?php echo (!$profile->frontend) ? '' : "<span class=\"badge bg-color-light-blue me-1\"> {$profile->frontend} </span>"; ?>
                  <?php echo (!$profile->backend) ? '' : "<span class=\"badge bg-color-light-gray text-dark me-1\"> {$profile->backend} </span>"; ?>
                  <?php echo (!$profile->fullstack) ? '' : "<span class=\"badge bg-color-light-green me-1\"> {$profile->fullstack} </span>"; ?>
                  <?php echo (!$profile->qa) ? '' : "<span class=\"badge bg-color-light-red me-1\"> {$profile->qa} </span>"; ?>
                  <?php echo (!$profile->mobdev) ? '' : "<span class=\"badge bg-color-light-yellow text-dark me-1\"> {$profile->mobdev} </span>"; ?>
                  <?php echo (!$profile->ux_ui) ? '' : "<span class=\"badge bg-color-light-purple me-1\"> {$profile->ux_ui} </span>"; ?>
                </div>
              </div>
            </div>
          </di>
        </div>
        <p id="showcase_company_description"><?php echo $profile->company_description; ?></p>
        <ul class="mb-0">
          <li>
            <span><b>Company history:</b></span>
            <p id="showcase_company_history"><?php echo $profile->company_history; ?></p>
          </li>
          <li>
            <span><b>Company mission:</b></span>
            <p id="showcase_company_mission"><?php echo $profile->company_mission; ?></p>
          </li>
        </ul>
      </div>
    </div>
  </section>

  <!-- Approved candidates -->
  <div id="candidates_container" class="container-fluid my-4 d-none">
    <div id="candidates_data" class="card table-responsive shadow rounded">
      <div class="card-header d-flex align-items-center justify-content-between w-1400px">
        <h4 class="my-3">Approved candidates</h4>
        <span class="js-close-approved-candidates cursor-pointer">
          <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
          </svg>
        </span>
      </div>
      <div class="card-body">
        <table class="table table-hover w-1400px">
          <thead class="table table-success">
            <tr class="">
              <th>#</th>
              <th>Published job</th>
              <th>Candidate profile</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $candidate = new Candidate;
            $approved_candidate = $candidate->display_approved_candidates_on_company_dshb();
            $candidate_data = $approved_candidate->fetchAll(PDO::FETCH_BOTH);
            foreach ($candidate_data as $key => $value) : ?>
              <tr class="js-applicants-data">
                <th scope="row">
                  <?php echo $key + 1; ?>
                </th>
                <td class="w-50">
                  <p class="m-0 small"><span class="fw-bold">Published date: </span> <?php echo $value['published_date']; ?></p>
                  <div class="mb-3">
                    <?php echo (!$value['frontend_tag']) ? '' : "<span class=\"badge bg-color-light-blue me-1\"> {$value['frontend_tag']} </span>"; ?>
                    <?php echo (!$value['backend_tag']) ? '' : "<span class=\"badge bg-color-light-gray text-dark me-1\"> {$value['backend_tag']} </span>"; ?>
                    <?php echo (!$value['fullstack_tag']) ? '' : "<span class=\"badge bg-color-light-green me-1\"> {$value['fullstack_tag']} </span>"; ?>
                    <?php echo (!$value['qa_tag']) ? '' : "<span class=\"badge bg-color-light-red me-1\"> {$value['qa_tag']} </span>"; ?>
                    <?php echo (!$value['mobdev_tag']) ? '' : "<span class=\"badge bg-color-light-yellow text-dark me-1\"> {$value['mobdev_tag']} </span>"; ?>
                    <?php echo (!$value['ux_ui_tag']) ? '' : "<span class=\"badge bg-color-light-purple me-1\"> {$value['ux_ui_tag']} </span>"; ?>
                    <span class="badge bg-color-light-cyan  me-1"> <?php echo $value['job_time']; ?> </span>
                  </div>
                  <p class="m-0"><b>Title:</b> <?php echo $value['job_title']; ?></p>
                  <p class="mt-3 d-none"><b>Description: </b><?php echo $value['job_description']; ?></p>
                  <div>
                    <button class="js-show-job-description btn btn-outline-primary btn-sm d-flex align-items-center mt-3 me-3">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1 bi bi-chevron-double-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
                        <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
                      </svg>
                      Read more
                    </button>
                  </div>
                </td>
                <td class="w-50">
                  <p class="small mb-0"><b>Applied date: </b><?php echo $value['applied_date']; ?></p>
                  <p class="mb-2"><b>Name: </b><?php echo "{$value['first_name']} {$value['last_name']}";  ?></p>
                  <div class="js-job-seeker-toogle-btns d-flex mb-2">
                    <button class="js-read-mot-speech me-3 btn btn-outline-primary btn-sm d-flex align-items-center">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1 bi bi-chevron-double-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
                        <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
                      </svg>
                      Motivation Speech
                    </button>
                    <button class="js-view-candidate-profile me-3 btn btn-outline-primary btn-sm d-flex align-items-center">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1 bi bi-chevron-double-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
                        <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
                      </svg>
                      View Profile
                    </button>
                  </div>
                  <p class="d-none"><b>Motivation speech: </b><?php echo $value['motivation_speech']; ?></p>
                  <!-- User profile -->
                  <div class="js-candidate-profile d-none card shadow rounded">
                    <h4 class="card-text ms-3 my-3"><?php echo "{$value['first_name']}'s profile:"; ?></h4>
                    <div class="card-body pt-0">
                      <p class="m-0"><b>Email: </b><?php echo $value['email']; ?></p>
                      <p class="m-0"><b>Website: </b>
                        <a href="<?php echo $value['website']; ?>" target="_blank"><?php echo $value['website']; ?></a>
                      </p>
                      <p class="m-0"><b>Short introduction:</b></p>
                      <p><?php echo $value['short_introduction']; ?></p>
                    </div>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?php echo ($approved_candidate->rowCount() === 0) ? '<h5>There are no candidates...</h5>' : ''; ?>
      </div>
    </div>
  </div>

  <!-- View published jobs -->
  <section class="container">
    <div class="card shadow rounded">
      <div id="published_job_tab_container" class="card-header">
        <ul id="load_published_job_tab_container" class="nav nav-tabs card-header-tabs">
          <?php $job_data = new Job; ?>
          <li class="nav-item">
            <a id="active_jobs" href="company-dashboard.php" class="nav-link active px-2 px-sm-3">Active jobs (<?php echo $job_data->count_active_inactive_jobs('Y'); ?>)</a>
          </li>
          <li class="nav-item">
            <a id="in_active_jobs" href="company-dashboard-in-active-jobs.php" class="nav-link px-2 px-sm-3">In-active jobs (<?php echo $job_data->count_active_inactive_jobs('N'); ?>)</a>
          </li>
        </ul>
      </div>
      <div class="card-body px-0 px-sm-3">
        <ul id="view_published_jobs" class="list-group-flush ps-0 ps-sm-3">
          <?php foreach ($job_data->display_jobs_company('Y') as $value) : ?>
            <li class="job-li list-group-item py-3">
              <div class="text-muted">Published date: <?php echo $value['published_date']; ?></div>
              <div class="mb-3">
                <?php echo (!$value['frontend_tag']) ? '' : "<span class=\"badge bg-color-light-blue me-1\"> {$value['frontend_tag']} </span>"; ?>
                <?php echo (!$value['backend_tag']) ? '' : "<span class=\"badge bg-color-light-gray text-dark me-1\"> {$value['backend_tag']} </span>"; ?>
                <?php echo (!$value['fullstack_tag']) ? '' : "<span class=\"badge bg-color-light-green me-1\"> {$value['fullstack_tag']} </span>"; ?>
                <?php echo (!$value['qa_tag']) ? '' : "<span class=\"badge bg-color-light-red me-1\"> {$value['qa_tag']} </span>"; ?>
                <?php echo (!$value['mobdev_tag']) ? '' : "<span class=\"badge bg-color-light-yellow text-dark me-1\"> {$value['mobdev_tag']} </span>"; ?>
                <?php echo (!$value['ux_ui_tag']) ? '' : "<span class=\"badge bg-color-light-purple me-1\"> {$value['ux_ui_tag']} </span>"; ?>
                <span class="badge bg-color-light-cyan  me-1"> <?php echo $value['job_time']; ?> </span>
              </div>
              <p id="update_job_title" class="m-0"><b>Title: </b><?php echo $value['job_title']; ?></p>
              <p class="mt-2"><span class="fw-bold">Salary:</span> <?php echo $value['job_salary']; ?> </p>
              <p class="d-none"><b>Job description: </b> <?php echo $value['job_description']; ?></p>
              <div class="d-flex">
                <button class="js-show-job-description btn btn-outline-primary d-flex align-items-center btn-sm me-2">
                  <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
                    <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
                  </svg>
                  Read more
                </button>
                <button class="js-remove-published-job btn btn-outline-danger d-flex align-items-center btn-sm me-2" value="<?php echo $value['id']; ?>" data-bs-animation="false" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Your publish will be in-active!">
                  Turn off
                </button>
              </div>
            </li>
          <?php endforeach; ?>
          <?php echo ($job_data->count_active_inactive_jobs('Y') === 0) ? "<h6>There are no published jobs...</h6>" : ''; ?>
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
  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="assets/js/script.js"></script>
  <script src="assets/js/functions.js"></script>
  <script src="assets/js/ajax-companies.js"></script>
  <script src="assets/js/message.js"></script>
</body>

</html>