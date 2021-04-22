<?php include 'src/Jobs.php'; ?>
<?php session_start(); ?>

<!-- View in-active published jobs -->
<div class="container">
  <div class="card shadow rounded">
    <div id="published_job_tab_container" class="card-header">
      <ul id="load_published_job_tab_container" class="nav nav-tabs card-header-tabs">
        <?php $job_data = new Job; ?>
        <li class="nav-item">
          <a id="active_jobs" href="company-dashboard.php" class="nav-link">Active jobs (<?php echo $job_data->count_active_inactive_jobs('Y'); ?>)</a>
        </li>
        <li class="nav-item">
          <a id="in_active_jobs" href="company-dashboard-in-active-jobs.php" class="nav-link active">In-active jobs (<?php echo $job_data->count_active_inactive_jobs('N'); ?>)</a>
        </li>
      </ul>
    </div>
    <div class="card-body">
      <ul id="view_published_jobs" class="list-group-flush">
        <?php $job_data = new Job; ?>
        <?php foreach ($job_data->display_jobs_company('N') as $value) : ?>
          <li class="job-li list-group-item py-3">
            <p class="text-muted mb-2">Published: <?php echo $value['published_date']; ?></p>
            <div class="d-flex align-items-center">
            </div>
            <p id="update_job_title" class="m-0 fw-bold"> <?php echo $value['job_title']; ?> </p>
            <span class="badges mt-1">
              <?php echo (!$value['frontend_tag']) ? '' : "<span class=\"badge bg-secondary me-1\"> {$value['frontend_tag']} </span>"; ?>
              <?php echo (!$value['backend_tag']) ? '' : "<span class=\"badge bg-dark me-1\"> {$value['backend_tag']} </span>"; ?>
              <?php echo (!$value['fullstack_tag']) ? '' : "<span class=\"badge bg-success me-1\"> {$value['fullstack_tag']} </span>"; ?>
              <?php echo (!$value['qa_tag']) ? '' : "<span class=\"badge bg-danger me-1\"> {$value['qa_tag']} </span>"; ?>
              <?php echo (!$value['mobdev_tag']) ? '' : "<span class=\"badge bg-warning me-1\"> {$value['mobdev_tag']} </span>"; ?>
              <?php echo (!$value['ux_ui_tag']) ? '' : "<span class=\"badge bg-primary me-1\"> {$value['ux_ui_tag']} </span>"; ?>
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
        <?php echo ($job_data->count_active_inactive_jobs('N') === 0) ? "<h6>There are no published jobs...</h6>" : ''; ?>
      </ul>
    </div>
  </div>
</div>