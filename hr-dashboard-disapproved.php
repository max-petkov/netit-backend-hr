<?php include 'src/database.php'; ?>
<?php include_once 'src/functions.php'; ?>
<?php login_required($_SESSION['hr_id']); ?>

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
            <?php
            $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
            $sql = ("SELECT a.*, b.id, b.company_name, b.address, b.website, b.slogan, b.frontend_branch, b.backend_branch, b.fullstack_branch, b.qa_branch, b.mobdev_branch, b.ux_ui_branch, b.company_description 
            FROM tb_hr AS a 
            INNER JOIN tb_company_profile AS b 
            ON a.company_id=b.id 
            WHERE a.id={$_SESSION['hr_id']}");
            $stmt = $db->query($sql);
            $stmt->execute();
            while ($row = $stmt->fetch()) :
              $hr_username = $row['username'];
              $hr_email = $row['email'];
              $company_name = $row['company_name'];
              $company_website = $row['website'];
              $company_address = $row['address'];
              $company_description = $row['company_description'];
              $slogan = $row['slogan'];
              $frontend_branch = $row['frontend_branch'];
              $backend_branch = $row['backend_branch'];
              $fullstack_branch = $row['fullstack_branch'];
              $qa_branch = $row['qa_branch'];
              $mobdev_branch = $row['mobdev_branch'];
              $ux_ui_branch = $row['ux_ui_branch'];
            ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <span id="greetings"></span>
                  <span id="greetings_first_name">
                    <?php echo $company_name; ?>
                  </span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
                  <li class="dropdown-item xsm-text-class text-center">Your are logged in as<br><b class="xsm-text-class"><?php echo $hr_username; ?></b>
                  </li>
                  <div class="dropdown-divider"></div>
                  <li>
                    <a class="message_icon dropdown-item xsm-text-class" href="#">Messages<span class="badge rounded-pill bg-danger ms-1">3</span>
                    </a>
                  </li>
                  <div class="dropdown-divider"></div>
                  <li class="dropdown-item xsm-text-class d-flex align-items-center">
                    <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                      <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                    </svg>
                    <span><?php echo $company_name; ?></span>
                  </li>
                  <li class="dropdown-item xsm-text-class d-flex align-items-center">
                    <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                      <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z" />
                      <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                    </svg>
                    <span><?php echo $company_address; ?></span>
                  </li>
                  <li class="dropdown-item xsm-text-class d-flex align-items-center">
                    <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                      <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z" />
                    </svg>
                    <span><?php echo $hr_email; ?></span>
                  </li>
                  <li class="dropdown-item xsm-text-class d-flex align-items-center">
                    <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-link-45deg" viewBox="0 0 16 16">
                      <path d="M4.715 6.542L3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1.001 1.001 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4.018 4.018 0 0 1-.128-1.287z" />
                      <path d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 0 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 0 0-4.243-4.243L6.586 4.672z" />
                    </svg>
                    <a href="<?php echo $company_website; ?>" target="_blank" class="text-decoration-none" id="employee_website">
                      <?php echo $company_website; ?>
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


  <!-- Company showcase -->
  <div class="container mt-4">
    <div class="mb-2">
      <h1 id="showcase_company_name" class="m-0 display-6">
        <?php echo $company_name; ?>
      </h1>
      <p id="showcase_company_slogan" class="lead mb-0"><?php echo $slogan; ?></p>
      <div id="showcase_it_branches" class="badges mt-1">
        <div id="badge_it_container">

          <?php if ($frontend_branch != null || $frontend_branch != '') {
                echo "<span class=\"badge bg-secondary\"> {$frontend_branch} </span>";
              }
          ?>
          <?php if ($backend_branch != null || $backend_branch != '') {
                echo "<span class=\"badge bg-dark\"> {$backend_branch} </span>";
              }
          ?>
          <?php if ($fullstack_branch != null || $fullstack_branch != '') {
                echo "<span class=\"badge bg-success\"> {$fullstack_branch} </span>";
              }
          ?>
          <?php if ($qa_branch != null || $qa_branch != '') {
                echo "<span class=\"badge bg-danger\"> {$qa_branch} </span>";
              }
          ?>
          <?php if ($mobdev_branch != null || $mobdev_branch != '') {
                echo "<span class=\"badge bg-warning\"> {$mobdev_branch} </span>";
              }
          ?>
          <?php if ($ux_ui_branch != null || $ux_ui_branch != '') {
                echo "<span class=\"badge bg-primary\"> {$ux_ui_branch} </span>";
              }
          ?>
        </div>
      </div>
    </div>
    <p id="showcase_company_description"><?php echo $company_description; ?></p>
    <!-- <img src="https://www.logolynx.com/images/logolynx/2a/2ad00c896e94f1f42c33c5a71090ad5e.png" class="me-1" width="80px" alt=""> -->
  </div>
<?php endwhile; ?>
<!-- Applicants -->
<div class="container-sm mt-4">
  <div class="card shadow-lg rounded">
    <div class="card-header">
      <h4 class="my-3">Applicants</h4>
      <ul class="nav nav-tabs card-header-tabs">
        <?php
        $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
        $sql3 = ("SELECT a.*, b.id, b.username, c.*, d.*, e.* 
          FROM tb_hr AS a 
          INNER JOIN tb_company_profile AS b 
          ON b.id=a.company_id
          INNER JOIN tb_published_jobs AS c 
          ON c.company_id=b.id
          INNER JOIN tb_applied_jobs AS d
          ON d.job_id = c.id
          INNER JOIN tb_job_seeker_profile AS e
          ON d.job_seeker_id = e.id
          WHERE  a.id='{$_SESSION['hr_id']}'
          AND d.is_approved IS null 
          AND d.is_interviewed IS null");
        $stmt3 = $db->query($sql3);
        $stmt3->execute();
        ?>
        <li class="nav-item">
          <a href="hr-dashboard.php" class="nav-link">New applicants (<?php echo $stmt3->rowCount(); ?>)</a>
        </li>
        <?php
        $sql2 = ("SELECT a.*, b.id, b.username, c.*, d.*, e.* 
          FROM tb_hr AS a 
          INNER JOIN tb_company_profile AS b 
          ON b.id=a.company_id
          INNER JOIN tb_published_jobs AS c 
          ON c.company_id=b.id
          INNER JOIN tb_applied_jobs AS d
          ON d.job_id = c.id
          INNER JOIN tb_job_seeker_profile AS e
          ON d.job_seeker_id = e.id
          WHERE  a.id='{$_SESSION['hr_id']}'
          AND d.is_approved='Y'");
        $stmt2 = $db->query($sql2);
        $stmt2->execute();
        ?>
        <li class="nav-item">
          <a href="hr-dashboard-approved.php" class="nav-link">Approved (<?php echo $stmt2->rowCount(); ?>)</a>
        </li>
        <?php
        $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
        $sql = ("SELECT a.*, b.id, b.username, c.*, d.*, e.* 
          FROM tb_hr AS a 
          INNER JOIN tb_company_profile AS b 
          ON b.id=a.company_id
          INNER JOIN tb_published_jobs AS c 
          ON c.company_id=b.id
          INNER JOIN tb_applied_jobs AS d
          ON d.job_id = c.id
          INNER JOIN tb_job_seeker_profile AS e
          ON d.job_seeker_id = e.id
          WHERE  a.id='{$_SESSION['hr_id']}'
          AND d.is_approved='N'");
        $stmt = $db->query($sql);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <li class="nav-item">
          <a href="hr-dashboard-disapproved.php" class="nav-link active">Disapproved (<?php echo $stmt->rowCount(); ?>)</a>
        </li>
      </ul>
    </div>
    <div class="card-body">
      <table class="table table-hover">
        <thead class="table">
          <tr class="">
            <th>#</th>
            <th>Published job</th>
            <th>Candidate profile</th>
            <th>Interviewed</th>
            <th>Approved</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($row as $key => $value) : ?>
            <tr class="js-applicants-data">
              <th scope="row">
                <?php echo $key + 1; ?>
              </th>
              <td class="w-50">
                <p class="m-0 small"><span class="fw-bold">Date:</span> <?php echo $value['published_date']; ?></p>
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
                <div class="d-flex mb-2">
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
                  <button class="btn btn-outline-primary btn-sm d-flex align-items-center">
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
                <div class="d-none card shadow rounded">
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
                <div class="card shadow p-3 mb-5 bg-body rounded d-none">
                  <div class="d-flex justify-content-between mt-4">
                    <div class="ms-3">
                      <h4 class="card-text">Send message:</h4>

                    </div>
                  </div>
                  <div class="card-body">
                    <form action="#">
                      <div class="form-group mb-2">
                        <label for="to">From:</label>
                        <input type="email" class="form-control form-control-sm" name="" value="$company_email" disabled>
                      </div>
                      <div class="form-group mb-2">
                        <label for="to">To:</label>
                        <input type="email" class="form-control form-control-sm" name="" value="$candidate_email" disabled>
                      </div>
                      <div class="form-group mb-2">
                        <label for="subject">Subject:</label>
                        <input type="text" class="form-control form-control-sm" name="" value="Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit, vitae.">
                      </div>
                      <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea name="" id="" class="form-control" rows="6">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos labore amet, saepe unde asperiores, nemo eos adipisci laboriosam doloribus perspiciatis commodi consectetur, a aperiam molestiae!
                        </textarea>
                      </div>
                      <input type="submit" class="btn btn-primary mt-3" value="Send message">
                    </form>
                  </div>
                </div>
              </td>
              <td id="is_interviewed" class="text-center">
                <div class="d-flex justify-content-center">
                  <button class="js-interview-answer btn btn-success btn-sm me-2" value="Y">Yes</button>
                  <button class="js-interview-answer btn btn-danger btn-sm" value="N">No</button>
                </div>
              </td>
              <td id="is_approved" class="text-center">
                <div class="d-flex justify-content-center">
                  <button class="js-approve-answer btn btn-success btn-sm me-2" value="Y">Yes</button>
                  <button class="js-approve-answer btn btn-danger btn-sm" value="N">No</button>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?php if ($stmt->rowCount() === 0) : ?>
        <td>
          <h5>There are no applicants...</h5>
        </td>
      <?php endif; ?>
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

<footer class="bg-dark text-white py-3 mt-5">
  <div class="container">
    <p class="text-center text-white m-0">Made with ❤ by Maximilian Petkov</p>
    <hr class="mx-auto my-1" width="256px">
    <p class="text-center mb-0"><a href="mailto:maxy.dp@abv.bg" class="text-decoration-none text-white">maxy.dp@abv.bg</a></p>
  </div>
</footer>

<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="assets/js/ajax-hr.js"></script>
<script src="assets/js/script.js"></script>

</body>

</html>