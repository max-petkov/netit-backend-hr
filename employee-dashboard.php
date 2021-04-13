<!-- Database is needed because to get the id session value and make logout and login required session -->
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
              <?php
              $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
              $sql = ("SELECT id, username, first_name, last_name, email, website, address FROM tb_job_seeker_profile WHERE id={$_SESSION['employee_id']}");
              $stmt = $db->query($sql);
              $stmt->execute();
              while ($row = $stmt->fetch()) :
                $job_seeker_username           = $row['username'];
                $job_seeker_first_name         = $row['first_name'];
                $job_seeker_last_name          = $row['last_name'];
                $job_seeker_email              = $row['email'];
                $job_seeker_website            = $row['website'];
                $job_seeker_address            = $row['address'];
              ?>
                <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <span id="greetings"></span>
                  <span id="greetings_first_name">
                    <?php echo $job_seeker_first_name; ?>
                  </span>
                </a>
                <ul id="job_seeker_navbar_data" class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                  <li class="dropdown-item xsm-text-class text-center">Your are logged in as<br><b id="employee_username" class="xsm-text-class"><?php echo $job_seeker_username; ?></b>
                  </li>
                  <div class="dropdown-divider"></div>
                  <li id="profile_button">
                    <a class="dropdown-item xsm-text-class" href="#">Edit Profile</a>
                  </li>
                  <li>
                    <a class="message_icon dropdown-item xsm-text-class" href="#">Messages</a>
                  </li>
                  <li id="addplication_button">
                    <a class="dropdown-item xsm-text-class" href="#">Applications</a>
                  </li>
                  <div class="dropdown-divider"></div>

                  <li class="dropdown-item xsm-text-class d-flex align-items-center">
                    <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                      <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                    </svg>
                    <span id="employee_first_name" class="me-1">
                      <?php echo $job_seeker_first_name; ?>
                    </span>
                    <span id="employee_last_name">
                      <?php echo $job_seeker_last_name; ?>
                    </span>
                  </li>
                  <li class="dropdown-item xsm-text-class d-flex align-items-center">
                    <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                      <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
                      <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                    </svg>
                    <span id="employee_address">
                      <?php echo $job_seeker_address; ?>
                    </span>
                  </li>
                  <li class="dropdown-item xsm-text-class d-flex align-items-center">
                    <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                      <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z" />
                    </svg>
                    <span id="employee_email">
                      <?php echo $job_seeker_email; ?>
                    </span>
                  </li>
                  <li class="dropdown-item xsm-text-class d-flex align-items-center">
                    <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link-45deg" viewBox="0 0 16 16">
                      <path d="M4.715 6.542L3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.001 1.001 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z" />
                      <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 0 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 0 0-4.243-4.243L6.586 4.672z" />
                    </svg>
                    <a href="<?php echo $job_seeker_website; ?>" target="_blank" class="text-decoration-none" id="employee_website">
                      <?php echo $job_seeker_website; ?>
                    </a>
                  </li>
                <?php
              endwhile;
              $db = null;
                ?>
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
            <a id="inbox_job_seeker_counter" href="#" class="message_icon nav-link d-flex align-items-center">
              <svg id="envelope_close" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="me-1 envelope_closed bi bi-envelope" viewBox="0 0 16 16">
                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z" />
              </svg>
              <svg id="envelope_open" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="me-1 d-none bi bi-envelope-open" viewBox="0 0 16 16">
                <path d="M8.47 1.318a1 1 0 0 0-.94 0l-6 3.2A1 1 0 0 0 1 5.4v.818l5.724 3.465L8 8.917l1.276.766L15 6.218V5.4a1 1 0 0 0-.53-.882l-6-3.2zM15 7.388l-4.754 2.877L15 13.117v-5.73zm-.035 6.874L8 10.083l-6.965 4.18A1 1 0 0 0 2 15h12a1 1 0 0 0 .965-.738zM1 13.117l4.754-2.852L1 7.387v5.73zM7.059.435a2 2 0 0 1 1.882 0l6 3.2A2 2 0 0 1 16 5.4V14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5.4a2 2 0 0 1 1.059-1.765l6-3.2z" />
              </svg>
              <?php
              $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
              $sql = ("SELECT inbox_msg, job_seeker_id, is_viewed FROM tb_msg_box_job_seeker WHERE inbox_msg IS NOT NULL AND is_viewed IS NULL AND job_seeker_id='{$_SESSION['employee_id']}'");
              $stmt = $db->query($sql);
              $stmt->execute();
              $result = $stmt->rowCount();
              ?>
              <span class="badge bg-danger rounded-pill"><?php echo $result; ?></span>
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
        $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
        $sql = ("SELECT a.*, b.id, b.username, c.id, c.first_name, c.last_name 
        FROM tb_msg_box_job_seeker AS a
        INNER JOIN tb_hr AS b
        ON b.id=a.hr_id
        INNER JOIN tb_job_seeker_profile AS c
        WHERE a.job_seeker_id ='{$_SESSION['employee_id']}'
        AND c.id='{$_SESSION['employee_id']}'
        AND inbox_msg IS NOT NULL
        AND sent_msg IS NULL
        ORDER BY a.id DESC");
        $stmt = $db->query($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_BOTH);
        ?>
        <?php foreach ($result as $value) : ?>
          <li class="js-inbox-li list-group-item pb-0">
            <div class="d-flex justify-content-between align-items-center">
              <p class="text-muted small">sent by <b class="text-dark"> <?php echo $value['username']; ?> </b></p>
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
                <!-- <button class="js-close-reply btn-close align-self-end"></button> -->
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
                    <input type="text" class="form-control form-control-sm" name="job_seeker_id" value="<?php echo "{$value['first_name']} {$value['last_name']}"; ?>" disabled>
                    <input type="hidden" value="<?php echo $_SESSION['employee_id']; ?>">
                  </div>
                  <div class="form-group mb-2">
                    <label for="to"> <b>To:</b></label>
                    <input type="email" class="form-control form-control-sm" name="hr_id" value="<?php echo $value['username']; ?>" disabled>
                    <input type="hidden" value="<?php echo $value['hr_id']; ?>">
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
                </form>
              </div>
            </div>
          </li>
        <?php endforeach; ?>
        <?php if ($stmt->rowCount() === 0) : ?>
          <h5>There are no inbox messages...</h5>
        <?php endif; ?>
      </ul>
      <ul id="sent_ul" class="list-group-flush p-0 pt-3">
        <?php
        $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
        $sql = ("SELECT a.*, b.id, b.username 
        FROM tb_msg_box_job_seeker AS a
        INNER JOIN tb_hr AS b
        ON b.id=a.hr_id
        WHERE a.job_seeker_id ='{$_SESSION['employee_id']}'
        AND inbox_msg IS NULL
        AND sent_msg IS NOT NULL
        ORDER BY a.id DESC");
        $stmt = $db->query($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <?php foreach ($result as $value) : ?>
          <li class="js-sent-li list-group-item pb-0">
            <div class="d-flex justify-content-between align-items-center">
              <p class="text-muted small">sent to <b class="text-dark"> <?php echo $value['username']; ?> </b></p>
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
        <?php if ($stmt->rowCount() === 0) : ?>
          <h5>There are no send messages...</h5>
        <?php endif; ?>
      </ul>
    </div>
  </div>


  <!-- Applications -->
  <div class="card shadow-lg p-3 mb-5 bg-body rounded application_box d-none">
    <div class="d-flex justify-content-between mt-3 mb-2 px-3">
      <h4 class="m-0">Applications:</h4>
      <button class="btn-close align-self-end"></button>
    </div>
    <ul id="applied_job_container" class="card-body list-group-flush">
      <?php $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
      $sql = ("SELECT a.*, b.* FROM tb_published_jobs AS a INNER JOIN tb_applied_jobs AS b WHERE b.job_id=a.id AND b.job_seeker_id={$_SESSION['employee_id']} AND is_applied='Y' ORDER BY b.applied_id DESC");
      $stmt = $db->prepare($sql);
      $stmt->execute();
      $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($row as $value) : ?>
        <li class="applied_job_data list-group-item">
          <div class="small text-muted d-flex align-items-center">
            <?php echo "<span class=\"me-1\">{$value['published_date']}</span> <span class=\"text-dark fw-bold fs-5\"> {$value['company_name']}</span>"; ?>
            <?php if ($value['frontend_tag'] != null || $value['frontend_tag'] != '') {
              echo "<span class=\"badge bg-secondary mx-1\"> {$value['frontend_tag']} </span>";
            }
            ?>
            <?php if ($value['backend_tag'] != null || $value['backend_tag'] != '') {
              echo "<span class=\"badge bg-dark mx-1\"> {$value['backend_tag']} </span>";
            }
            ?>
            <?php if ($value['fullstack_tag'] != null || $value['fullstack_tag'] != '') {
              echo "<span class=\"badge bg-success mx-1\"> {$value['fullstack_tag']} </span>";
            }
            ?>
            <?php if ($value['qa_tag'] != null || $value['qa_tag'] != '') {
              echo "<span class=\"badge bg-danger mx-1\"> {$value['qa_tag']} </span>";
            }
            ?>
            <?php if ($value['mobdev_tag'] != null || $value['mobdev_tag'] != '') {
              echo "<span class=\"badge bg-warning mx-1\"> {$value['mobdev_tag']} </span>";
            }
            ?>
            <?php if ($value['ux_ui_tag'] != null || $value['ux_ui_tag'] != '') {
              echo "<span class=\"badge bg-primary mx-1\"> {$value['ux_ui_tag']} </span>";
            }
            ?>
            <span class="badge bg-info mx-1"> <?php echo $value['job_time']; ?> </span>
          </div>
          <p class="mt-2"><?php echo $value['job_title']; ?></p>
          <p><b>Salary: </b><?php echo $value['job_salary']; ?> </p>
          <p class="m-0 d-none"> <?php echo $value['job_description']; ?> </p>
          <div class="d-flex">
            <button class="btn btn-primary btn-sm d-flex align-items-center me-2">
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

            </form>
            <input type="hidden" value="<?php echo $_SESSION['employee_id']; ?>">
            <input type="hidden" value="<?php echo $value['applied_id']; ?>">
            <input type="hidden" value="<?php echo $value['random_chars']; ?>">
          </div>
          <hr class="m-2">
        </li>
      <?php
      endforeach;
      $db = null;
      ?>
    </ul>
  </div>

  <!-- Edit profile -->
  <div class="card d-none profile_box shadow-lg p-3 mb-5 bg-body rounded">
    <div class="d-flex justify-content-end pt-2">

      <button class="btn-close"></button>
    </div>
    <div class="card-body pt-0">
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

        <?php
        $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
        $sql = ("SELECT id, username, first_name, last_name, email, website, short_introduction, address FROM tb_job_seeker_profile WHERE id={$_SESSION['employee_id']}");
        $stmt = $db->query($sql);
        $stmt->execute();

        while ($row = $stmt->fetch()) :
          $job_seeker_username           = $row['username'];
          $job_seeker_first_name         = $row['first_name'];
          $job_seeker_last_name          = $row['last_name'];
          $job_seeker_email              = $row['email'];
          $job_seeker_website            = $row['website'];
          $job_seeker_short_introduction = $row['short_introduction'];
          $job_seeker_address            = $row['address'];
        ?>
          <div>
            <div id="success_mess_validation"></div>
            <div class="form-group row mb-3 pe-0">
              <div class="form-group col-0 col-sm-6 pe-0 pe-sm-2">
                <label for="first_name">First name</label>
                <input type="text" class="successful-validation form-control form-control-sm" name="employee_first_name" value="<?php echo $job_seeker_first_name; ?>">
                <div></div>
              </div>
              <div class="form-group col-0 pe-0 col-sm-6">
                <label for="last_name">Last name</label>
                <input type="text" class="successful-validation form-control form-control-sm" name="employee_last_name" value="<?php echo $job_seeker_last_name; ?>">
                <div></div>
              </div>
            </div>

            <div class="form-group row mb-3 pe-0">
              <div class="form-group col-0 col-sm-6 pe-0 pe-sm-2">
                <label for="address_employee">Address</label>
                <input type="text" class="successful-validation form-control form-control-sm" name="address_employee" value="<?php echo $job_seeker_address; ?>">
                <div></div>
              </div>
              <div class="form-group col-0 col-sm-6 pe-0">
                <label for="website_employee">Website</label>
                <input type="text" class="successful-validation form-control form-control-sm" name="website_employee" value="<?php echo $job_seeker_website; ?>">
                <div></div>
              </div>
            </div>

            <div class="form-group row mb-3 pe-0">
              <div class="form-group col-0 col-sm-6 pe-0 pe-sm-2">
                <label for="username">Username</label>
                <input type="text" class="form-control form-control-sm" name="employee_username" value="<?php echo $job_seeker_username; ?>" disabled>
              </div>
              <div class="form-group col-0 col-sm-6 pe-0">
                <label for="email">Email</label>
                <input type="email" class="form-control form-control-sm" name="employee_email" value="<?php echo $job_seeker_email; ?>" disabled>
              </div>
            </div>
            <div class="form-group">
              <label for="short_introduction_employee">Short introduction</label>
              <textarea name="short_introduction" class="successful-validation form-control form-control-sm" rows="6"><?php echo $job_seeker_short_introduction; ?></textarea>
              <div></div>
            </div>
          <?php
        endwhile;
        $db = null;
          ?>
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
                  <div id="refresh_frontend_tag" class="card-subtitle text-center fw-bold"><?php echo published_job('frontend_tag', 'frontend'); ?></div>
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
                  <div id="refresh_backend_tag" class="card-subtitle text-center fw-bold"><?php echo published_job('backend_tag', 'backend'); ?></div>
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
                  <div id="refresh_fullstack_tag" class="card-subtitle text-center fw-bold"><?php echo published_job('fullstack_tag', 'fullstack'); ?></div>
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
                  <div id="refresh_qa_tag" class="card-subtitle text-center fw-bold"><?php echo published_job('qa_tag', 'qa'); ?></div>
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
                  <div id="refresh_mobdev_tag" class="card-subtitle text-center fw-bold"><?php echo published_job('mobdev_tag', 'mobdev'); ?></div>
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
                  <div id="refresh_ux_ui_tag" class="card-subtitle text-center fw-bold"><?php echo published_job('ux_ui_tag', 'ux/ui'); ?></div>
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
            <input id="search_by_title_company" type="text" class="form-control" placeholder="Search by job title...">
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

          $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');

          $sql = ("SELECT * FROM tb_published_jobs WHERE is_active='Y' ORDER BY published_date DESC");
          $stmt = $db->query($sql);
          $stmt->execute();
          $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
          foreach ($row as $value) : ?>
            <li class="job_li list-group-item py-3">
              <p class="text-muted mb-2">Published: <?php echo $value['published_date']; ?> by</p>
              <div class="d-flex align-items-center">
                <div class="mb-2 d-flex flex-column">
                  <h4 class="m-0">
                    <?php echo $value['company_name']; ?>
                  </h4>
                </div>
                <!-- <img src="https://www.logolynx.com/images/logolynx/2a/2ad00c896e94f1f42c33c5a71090ad5e.png" width="56px" alt=""> -->
              </div>
              <p class="m-0 fw-bold"> <?php echo $value['job_title']; ?> </p>
              <?php if ($value['frontend_tag'] != null || $value['frontend_tag'] != '') {
                echo "<span class=\"badge bg-secondary\"> {$value['frontend_tag']} </span>";
              }
              ?>
              <?php if ($value['backend_tag'] != null || $value['backend_tag'] != '') {
                echo "<span class=\"badge bg-dark\"> {$value['backend_tag']} </span>";
              }
              ?>
              <?php if ($value['fullstack_tag'] != null || $value['fullstack_tag'] != '') {
                echo "<span class=\"badge bg-success\"> {$value['fullstack_tag']} </span>";
              }
              ?>
              <?php if ($value['qa_tag'] != null || $value['qa_tag'] != '') {
                echo "<span class=\"badge bg-danger\"> {$value['qa_tag']} </span>";
              }
              ?>
              <?php if ($value['mobdev_tag'] != null || $value['mobdev_tag'] != '') {
                echo "<span class=\"badge bg-warning\"> {$value['mobdev_tag']} </span>";
              }
              ?>
              <?php if ($value['ux_ui_tag'] != null || $value['ux_ui_tag'] != '') {
                echo "<span class=\"badge bg-primary\"> {$value['ux_ui_tag']} </span>";
              }
              ?>
              <span class="badge bg-info"> <?php echo $value['job_time']; ?> </span>
              <p class="mt-2"><span class="fw-bold">Salary:</span> <?php echo $value['job_salary']; ?> </p>

              <div class="d-flex">
                <button class="btn btn-primary d-flex align-items-center btn-sm me-2">
                  <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
                    <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
                  </svg>
                  Read more
                </button>
                <?php
                $stmt2 = $db->query("SELECT applied_id, job_id, job_seeker_id, is_applied FROM tb_applied_jobs WHERE job_id='{$value['id']}' AND job_seeker_id='{$_SESSION['employee_id']}' AND is_applied='Y'");
                $stmt2->execute();
                $row2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                if ($stmt2->rowCount() === 0) : ?>
                  <button class="js-apply-job btn btn-success d-flex align-items-center btn-sm" value="<?php echo $value['id']; ?>">
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
              <p class="m-0 d-none"> <?php echo $value['job_description']; ?> </p>
              <div class="js-motivation-speech container d-none">
                <div class="card shadow rounded">
                  <div class="d-flex justify-content-between mt-3 mb-2 px-3">
                    <h4 class="m-0">Motivation speech:</h4>
                    <button class="btn-close align-self-end"></button>
                  </div>
                  <div class="card-body pb-3 pt-0">
                    <div id="apply_succ_mess"></div>
                    <div class="d-flex align-items-center mb-1">
                      <p class="text-muted m-0">Published: <?php echo $value['published_date']; ?> by</p>
                      <h5 class="m-0 ms-1"><?php echo $value['company_name']; ?></h5>
                      <!-- <img src="https://www.logolynx.com/images/logolynx/2a/2ad00c896e94f1f42c33c5a71090ad5e.png" width="56px" alt=""> -->
                    </div>
                    <p class="m-0"> <?php echo $value['job_title']; ?> </p>
                    <?php if ($value['frontend_tag'] != null || $value['frontend_tag'] != '') {
                      echo "<span class=\"badge bg-secondary\"> {$value['frontend_tag']} </span>";
                    }
                    ?>
                    <?php if ($value['backend_tag'] != null || $value['backend_tag'] != '') {
                      echo "<span class=\"badge bg-dark\"> {$value['backend_tag']} </span>";
                    }
                    ?>
                    <?php if ($value['fullstack_tag'] != null || $value['fullstack_tag'] != '') {
                      echo "<span class=\"badge bg-success\"> {$value['fullstack_tag']} </span>";
                    }
                    ?>
                    <?php if ($value['qa_tag'] != null || $value['qa_tag'] != '') {
                      echo "<span class=\"badge bg-danger\"> {$value['qa_tag']} </span>";
                    }
                    ?>
                    <?php if ($value['mobdev_tag'] != null || $value['mobdev_tag'] != '') {
                      echo "<span class=\"badge bg-warning\"> {$value['mobdev_tag']} </span>";
                    }
                    ?>
                    <?php if ($value['ux_ui_tag'] != null || $value['ux_ui_tag'] != '') {
                      echo "<span class=\"badge bg-primary\"> {$value['ux_ui_tag']} </span>";
                    }
                    ?>
                    <span class="badge bg-info"> <?php echo $value['job_time']; ?> </span>
                    <textarea name="motivational_speech" class="form-control mt-3" rows="10" placeholder="Why do you want to apply for this job?"></textarea>
                    <div id="motivation_speech_response_text"></div>
                    <button id="send_speech" class="btn btn-primary d-flex align-items-center mt-3">
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
  <script src="assets/js/script.js"></script>
  <script src="assets/js/ajax-employees.js"></script>
  <script src="assets/js/message.js"></script>
</body>

</html>