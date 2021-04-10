<?php include 'src/database.php'; ?>

<!-- View in-active published jobs -->
<div class="container">
  <div class="card">
    <div id="published_job_tab_container" class="card-header">
      <ul id="load_published_job_tab_container" class="nav nav-tabs card-header-tabs">
        <?php
        $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
        $sql2 = ("SELECT * FROM tb_published_jobs WHERE is_active='Y' AND company_id='{$_SESSION['company_id']}' ORDER BY published_date DESC");
        $stmt2 = $db->query($sql2);
        $stmt2->execute();
        $row2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <li class="nav-item"><a id="active_jobs" href="company-dashboard.php" class="nav-link">Active jobs (<?php echo $stmt2->rowCount(); ?>)</a></li>
        <?php
        $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
        $sql = ("SELECT * FROM tb_published_jobs WHERE is_active='N' AND company_id='{$_SESSION['company_id']}' ORDER BY published_date DESC");
        $stmt = $db->query($sql);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <li class="nav-item"><a id="in_active_jobs" href="company-dashboard-in-active-jobs.php" class="nav-link active">In-active jobs (<?php echo $stmt->rowCount(); ?>)</a></li>
      </ul>
    </div>
    <div class="card-body">
      <ul id="view_published_jobs" class="list-group-flush">
        <?php foreach ($row as $value) : ?>
          <li class="job-li list-group-item py-3">
            <p class="text-muted mb-2">Published: <?php echo $value['published_date']; ?></p>
            <div class="d-flex align-items-center">
            </div>
            <p id="update_job_title" class="m-0 fw-bold"> <?php echo $value['job_title']; ?> </p>
            <span class="badges mt-1">

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
              <div class="d-flex justify-content-between">
                <div class="d-flex">
                  <button class="btn btn-primary d-flex align-items-center btn-sm me-2">
                    <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
                      <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
                    </svg>
                    Read more
                  </button>
                  <button id="update_published_job" class="js-update-in-active-publish btn btn-warning d-flex align-items-center btn-sm me-2" value="<?php echo $value['id']; ?>">
                    Make changes
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="ms-1 bi bi-pencil-square" viewBox="0 0 16 16">
                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                    </svg>
                  </button>
                  <button id="activate_published_job" class="btn btn-success d-flex align-items-center btn-sm me-2" value="<?php echo $value['id']; ?>" data-bs-animation="false" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Your publish will be active!">
                    Turn on
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="ms-1 bi bi-check2-circle" viewBox="0 0 16 16">
                      <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                      <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                    </svg>
                  </button>
                </div>
                <!-- BS5 alpha3 have tooltip problem a multiple hover and dissappears so data-bs-animation="false" will make a workaround -->
                <span id="remove_completely_from_db" class="tooltip-icon" data-bs-animation="false" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Your publish will be DELETED!">
                  <input type="hidden" value="<?php echo $value['id']; ?>">
                  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="text-danger ms-1 bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                  </svg>
                </span>
              </div>
              <div id="confirm_delete_published_job"></div>
              <p class="m-0 d-none"> <?php echo $value['job_description']; ?> </p>
          </li>
        <?php endforeach; ?>
        <?php
          if ($stmt->rowCount() === 0) {
            echo "<h6 class=\"job-li\">There are no published jobs...</h6>";
          }
          ?>
      </ul>
    </div>
  </div>
</div>
