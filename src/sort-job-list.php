<?php
session_start();
include_once 'Database.php';
include_once 'Jobs.php';
global $pdo;
$applied_btn = new Job;

if (isset($_POST['tag_list'])) {
  $stmt = $pdo->prepare_query("SELECT a.*, b.id, b.file_mime, b.file_data FROM tb_published_jobs AS a INNER JOIN tb_company_profile AS b ON b.id=a.company_id WHERE a.is_active='Y' AND a.{$_POST['tag_list']}_tag='{$_POST['tag_list']}' ORDER BY a.published_date DESC");
  $result = $stmt->fetchAll(PDO::FETCH_BOTH);
  foreach ($result as $value) : ?>
    <li class="job_li list-group-item py-3">
      <div class="d-flex align-items-center">
        <span class="text-muted me-2">Published: <?php echo $value['published_date']; ?> by </span>
        <?php if ($value['file_data'] !== null) : ?>
          <img id="showcase_company_logo" src="data:<?php $value['file_mime']; ?>;base64,<?php echo base64_encode($value['file_data']); ?>" class="me-1" alt="uploaded-picture" width="32px">
        <?php endif; ?>
        <?php echo "<span class=\"fw-bold text-dark fs-5 me-2\">{$value['company_name']}</span>"; ?>
        <?php echo (!$value['frontend_tag']) ? '' : "<span class=\"badge bg-secondary me-1\"> {$value['frontend_tag']} </span>"; ?>
        <?php echo (!$value['backend_tag']) ? '' : "<span class=\"badge bg-dark me-1\"> {$value['backend_tag']} </span>"; ?>
        <?php echo (!$value['fullstack_tag']) ? '' : "<span class=\"badge bg-success me-1\"> {$value['fullstack_tag']} </span>"; ?>
        <?php echo (!$value['qa_tag']) ? '' : "<span class=\"badge bg-danger me-1\"> {$value['qa_tag']} </span>"; ?>
        <?php echo (!$value['mobdev_tag']) ? '' : "<span class=\"badge bg-warning me-1\"> {$value['mobdev_tag']} </span>"; ?>
        <?php echo (!$value['ux_ui_tag']) ? '' : "<span class=\"badge bg-primary me-1\"> {$value['ux_ui_tag']} </span>"; ?>
        <span class="badge bg-info me-1"> <?php echo $value['job_time']; ?> </span>
      </div>
      <p class="w-50 mt-2"><b>Job title: </b> <?php echo $value['job_title']; ?> </p>
      <p class="mt-2"><span class="fw-bold">Salary:</span> <?php echo $value['job_salary']; ?> </p>
      <p class="js-job-description d-none mt-3"> <?php echo $value['job_description']; ?> </p>
      <div class="d-flex">
        <button class="js-show-job-description btn btn-primary d-flex align-items-center btn-sm me-2">
          <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
            <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
          </svg>
          Read more
        </button>
        <?php if ($applied_btn->is_applied_btn($value[0]) === 0) : ?>
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
            <div class="d-flex align-items-center mb-1">
              <p class="text-muted m-0">Published: <?php echo $value['published_date']; ?> by</p>
              <h5 class="m-0 ms-1"><?php echo $value['company_name']; ?></h5>
            </div>
            <p class="m-0"> <?php echo $value['job_title']; ?> </p>
            <?php echo "<span class=\"fw-bold text-dark fs-5 me-2\">{$value['company_name']}</span>"; ?>
            <?php echo (!$value['frontend_tag']) ? '' : "<span class=\"badge bg-secondary me-1\"> {$value['frontend_tag']} </span>"; ?>
            <?php echo (!$value['backend_tag']) ? '' : "<span class=\"badge bg-dark me-1\"> {$value['backend_tag']} </span>"; ?>
            <?php echo (!$value['fullstack_tag']) ? '' : "<span class=\"badge bg-success me-1\"> {$value['fullstack_tag']} </span>"; ?>
            <?php echo (!$value['qa_tag']) ? '' : "<span class=\"badge bg-danger me-1\"> {$value['qa_tag']} </span>"; ?>
            <?php echo (!$value['mobdev_tag']) ? '' : "<span class=\"badge bg-warning me-1\"> {$value['mobdev_tag']} </span>"; ?>
            <?php echo (!$value['ux_ui_tag']) ? '' : "<span class=\"badge bg-primary me-1\"> {$value['ux_ui_tag']} </span>"; ?>
            <span class="badge bg-info"> <?php echo $value['job_time']; ?> </span>
            <textarea name="motivational_speech" class="form-control mt-3" rows="10" placeholder="Why do you want to apply for this job?"></textarea>
            <div id="motivation_speech_response_text"></div>
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
            <input type="hidden" name="apply_job" value="">
          </div>
        </div>
      </div>
    </li>
<?php endforeach;
} ?>

<?php if (isset($_POST['ux_ui'])) {
  $stmt = $pdo->prepare_query("SELECT a.*, b.id, b.file_mime, b.file_data 
  FROM tb_published_jobs AS a
  INNER JOIN tb_company_profile AS b
  ON b.id=a.company_id 
  WHERE a.is_active='Y'
  AND a.{$_POST['ux_ui']}_tag='{$_POST['ux_ui_tag']}'
  ORDER BY a.published_date DESC");
  $result = $stmt->fetchAll(PDO::FETCH_BOTH);
  foreach ($result as $value) : ?>
    <li class="job_li list-group-item py-3">
      <div class="d-flex align-items-center">
        <span class="text-muted me-2">Published: <?php echo $value['published_date']; ?> by </span>
        <?php if ($value['file_data'] !== null) : ?>
          <img id="showcase_company_logo" src="data:<?php $value['file_mime']; ?>;base64,<?php echo base64_encode($value['file_data']); ?>" class="me-1" alt="uploaded-picture" width="32px">
        <?php endif; ?>
        <?php echo "<span class=\"fw-bold text-dark fs-5 me-2\">{$value['company_name']}</span>"; ?>
        <?php echo (!$value['frontend_tag']) ? '' : "<span class=\"badge bg-secondary me-1\"> {$value['frontend_tag']} </span>"; ?>
        <?php echo (!$value['backend_tag']) ? '' : "<span class=\"badge bg-dark me-1\"> {$value['backend_tag']} </span>"; ?>
        <?php echo (!$value['fullstack_tag']) ? '' : "<span class=\"badge bg-success me-1\"> {$value['fullstack_tag']} </span>"; ?>
        <?php echo (!$value['qa_tag']) ? '' : "<span class=\"badge bg-danger me-1\"> {$value['qa_tag']} </span>"; ?>
        <?php echo (!$value['mobdev_tag']) ? '' : "<span class=\"badge bg-warning me-1\"> {$value['mobdev_tag']} </span>"; ?>
        <?php echo (!$value['ux_ui_tag']) ? '' : "<span class=\"badge bg-primary me-1\"> {$value['ux_ui_tag']} </span>"; ?>
        <span class="badge bg-info me-1"> <?php echo $value['job_time']; ?> </span>
      </div>
      <p class="w-50 mt-2"><b>Job title: </b> <?php echo $value['job_title']; ?> </p>
      <p class="mt-2"><span class="fw-bold">Salary:</span> <?php echo $value['job_salary']; ?> </p>
      <p class="js-job-description d-none mt-3"> <?php echo $value['job_description']; ?> </p>
      <div class="d-flex">
        <button class="js-show-job-description btn btn-primary d-flex align-items-center btn-sm me-2">
          <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
            <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
          </svg>
          Read more
        </button>
        <?php if ($applied_btn->is_applied_btn($value[0]) === 0) : ?>
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
            <div class="d-flex align-items-center mb-1">
              <p class="text-muted m-0">Published: <?php echo $value['published_date']; ?> by</p>
              <h5 class="m-0 ms-1"><?php echo $value['company_name']; ?></h5>
            </div>
            <p class="m-0"> <?php echo $value['job_title']; ?> </p>
            <?php echo "<span class=\"fw-bold text-dark fs-5 me-2\">{$value['company_name']}</span>"; ?>
            <?php echo (!$value['frontend_tag']) ? '' : "<span class=\"badge bg-secondary me-1\"> {$value['frontend_tag']} </span>"; ?>
            <?php echo (!$value['backend_tag']) ? '' : "<span class=\"badge bg-dark me-1\"> {$value['backend_tag']} </span>"; ?>
            <?php echo (!$value['fullstack_tag']) ? '' : "<span class=\"badge bg-success me-1\"> {$value['fullstack_tag']} </span>"; ?>
            <?php echo (!$value['qa_tag']) ? '' : "<span class=\"badge bg-danger me-1\"> {$value['qa_tag']} </span>"; ?>
            <?php echo (!$value['mobdev_tag']) ? '' : "<span class=\"badge bg-warning me-1\"> {$value['mobdev_tag']} </span>"; ?>
            <?php echo (!$value['ux_ui_tag']) ? '' : "<span class=\"badge bg-primary me-1\"> {$value['ux_ui_tag']} </span>"; ?>
            <span class="badge bg-info"> <?php echo $value['job_time']; ?> </span>
            <textarea name="motivational_speech" class="form-control mt-3" rows="10" placeholder="Why do you want to apply for this job?"></textarea>
            <div id="motivation_speech_response_text"></div>
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
            <input type="hidden" name="apply_job" value="">
          </div>
        </div>
      </div>
    </li>
<?php endforeach;
} ?>

<?php if (isset($_POST['default_list'])) {
  $stmt = $pdo->prepare_query("SELECT a.{$_POST['default_list']}, b.id, b.file_mime, b.file_data 
  FROM tb_published_jobs AS a
  INNER JOIN tb_company_profile AS b
  ON b.id=a.company_id 
  WHERE a.is_active='Y' 
  ORDER BY a.published_date DESC");
  $result = $stmt->fetchAll(PDO::FETCH_BOTH);
  foreach ($result as $value) : ?>
    <li class="job_li list-group-item py-3">
      <div class="d-flex align-items-center">
        <span class="text-muted me-2">Published: <?php echo $value['published_date']; ?> by </span>
        <?php if ($value['file_data'] !== null) : ?>
          <img id="showcase_company_logo" src="data:<?php $value['file_mime']; ?>;base64,<?php echo base64_encode($value['file_data']); ?>" class="me-1" alt="uploaded-picture" width="32px">
        <?php endif; ?>
        <?php echo "<span class=\"fw-bold text-dark fs-5 me-2\">{$value['company_name']}</span>"; ?>
        <?php echo (!$value['frontend_tag']) ? '' : "<span class=\"badge bg-secondary me-1\"> {$value['frontend_tag']} </span>"; ?>
        <?php echo (!$value['backend_tag']) ? '' : "<span class=\"badge bg-dark me-1\"> {$value['backend_tag']} </span>"; ?>
        <?php echo (!$value['fullstack_tag']) ? '' : "<span class=\"badge bg-success me-1\"> {$value['fullstack_tag']} </span>"; ?>
        <?php echo (!$value['qa_tag']) ? '' : "<span class=\"badge bg-danger me-1\"> {$value['qa_tag']} </span>"; ?>
        <?php echo (!$value['mobdev_tag']) ? '' : "<span class=\"badge bg-warning me-1\"> {$value['mobdev_tag']} </span>"; ?>
        <?php echo (!$value['ux_ui_tag']) ? '' : "<span class=\"badge bg-primary me-1\"> {$value['ux_ui_tag']} </span>"; ?>
        <span class="badge bg-info me-1"> <?php echo $value['job_time']; ?> </span>
      </div>
      <p class="w-50 mt-2"><b>Job title: </b> <?php echo $value['job_title']; ?> </p>
      <p class="mt-2"><span class="fw-bold">Salary:</span> <?php echo $value['job_salary']; ?> </p>
      <p class="js-job-description d-none mt-3"> <?php echo $value['job_description']; ?> </p>
      <div class="d-flex">
        <button class="js-show-job-description btn btn-primary d-flex align-items-center btn-sm me-2">
          <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
            <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
          </svg>
          Read more
        </button>
        <?php if ($applied_btn->is_applied_btn($value[0]) === 0) : ?>
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
            <div class="d-flex align-items-center mb-1">
              <p class="text-muted m-0">Published: <?php echo $value['published_date']; ?> by</p>
              <h5 class="m-0 ms-1"><?php echo $value['company_name']; ?></h5>
            </div>
            <p class="m-0"> <?php echo $value['job_title']; ?> </p>
            <?php echo "<span class=\"fw-bold text-dark fs-5 me-2\">{$value['company_name']}</span>"; ?>
            <?php echo (!$value['frontend_tag']) ? '' : "<span class=\"badge bg-secondary me-1\"> {$value['frontend_tag']} </span>"; ?>
            <?php echo (!$value['backend_tag']) ? '' : "<span class=\"badge bg-dark me-1\"> {$value['backend_tag']} </span>"; ?>
            <?php echo (!$value['fullstack_tag']) ? '' : "<span class=\"badge bg-success me-1\"> {$value['fullstack_tag']} </span>"; ?>
            <?php echo (!$value['qa_tag']) ? '' : "<span class=\"badge bg-danger me-1\"> {$value['qa_tag']} </span>"; ?>
            <?php echo (!$value['mobdev_tag']) ? '' : "<span class=\"badge bg-warning me-1\"> {$value['mobdev_tag']} </span>"; ?>
            <?php echo (!$value['ux_ui_tag']) ? '' : "<span class=\"badge bg-primary me-1\"> {$value['ux_ui_tag']} </span>"; ?>
            <span class="badge bg-info"> <?php echo $value['job_time']; ?> </span>
            <textarea name="motivational_speech" class="form-control mt-3" rows="10" placeholder="Why do you want to apply for this job?"></textarea>
            <div id="motivation_speech_response_text"></div>
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
            <input type="hidden" name="apply_job" value="">
          </div>
        </div>
      </div>
    </li>
<?php endforeach;
} ?>

<?php if (isset($_POST['search_by_company_name'])) {
  $stmt = $pdo->prepare_query("SELECT a.*, b.id, b.file_mime, b.file_data 
  FROM tb_published_jobs AS a
  INNER JOIN tb_company_profile AS b
  ON b.id=a.company_id 
  WHERE a.is_active='Y'
  AND a.company_name LIKE '{$_POST['search_by_company_name']}%'
  ORDER BY a.published_date DESC");
  $result = $stmt->fetchAll(PDO::FETCH_BOTH);
  foreach ($result as $value) : ?>
    <li class="job_li list-group-item py-3">
      <div class="d-flex align-items-center">
        <span class="text-muted me-2">Published: <?php echo $value['published_date']; ?> by </span>
        <?php if ($value['file_data'] !== null) : ?>
          <img id="showcase_company_logo" src="data:<?php $value['file_mime']; ?>;base64,<?php echo base64_encode($value['file_data']); ?>" class="me-1" alt="uploaded-picture" width="32px">
        <?php endif; ?>
        <?php echo "<span class=\"fw-bold text-dark fs-5 me-2\">{$value['company_name']}</span>"; ?>
        <?php echo (!$value['frontend_tag']) ? '' : "<span class=\"badge bg-secondary me-1\"> {$value['frontend_tag']} </span>"; ?>
        <?php echo (!$value['backend_tag']) ? '' : "<span class=\"badge bg-dark me-1\"> {$value['backend_tag']} </span>"; ?>
        <?php echo (!$value['fullstack_tag']) ? '' : "<span class=\"badge bg-success me-1\"> {$value['fullstack_tag']} </span>"; ?>
        <?php echo (!$value['qa_tag']) ? '' : "<span class=\"badge bg-danger me-1\"> {$value['qa_tag']} </span>"; ?>
        <?php echo (!$value['mobdev_tag']) ? '' : "<span class=\"badge bg-warning me-1\"> {$value['mobdev_tag']} </span>"; ?>
        <?php echo (!$value['ux_ui_tag']) ? '' : "<span class=\"badge bg-primary me-1\"> {$value['ux_ui_tag']} </span>"; ?>
        <span class="badge bg-info me-1"> <?php echo $value['job_time']; ?> </span>
      </div>
      <p class="w-50 mt-2"><b>Job title: </b> <?php echo $value['job_title']; ?> </p>
      <p class="mt-2"><span class="fw-bold">Salary:</span> <?php echo $value['job_salary']; ?> </p>

      <p class="js-job-description d-none mt-3"> <?php echo $value['job_description']; ?> </p>
      <div class="d-flex">
        <button class="js-show-job-description btn btn-primary d-flex align-items-center btn-sm me-2">
          <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
            <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
          </svg>
          Read more
        </button>
        <?php if ($applied_btn->is_applied_btn($value[0]) === 0) : ?>
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
            <div class="d-flex align-items-center mb-1">
              <p class="text-muted m-0">Published: <?php echo $value['published_date']; ?> by</p>
              <h5 class="m-0 ms-1"><?php echo $value['company_name']; ?></h5>
            </div>
            <p class="m-0"> <?php echo $value['job_title']; ?> </p>
            <?php echo "<span class=\"fw-bold text-dark fs-5 me-2\">{$value['company_name']}</span>"; ?>
            <?php echo (!$value['frontend_tag']) ? '' : "<span class=\"badge bg-secondary me-1\"> {$value['frontend_tag']} </span>"; ?>
            <?php echo (!$value['backend_tag']) ? '' : "<span class=\"badge bg-dark me-1\"> {$value['backend_tag']} </span>"; ?>
            <?php echo (!$value['fullstack_tag']) ? '' : "<span class=\"badge bg-success me-1\"> {$value['fullstack_tag']} </span>"; ?>
            <?php echo (!$value['qa_tag']) ? '' : "<span class=\"badge bg-danger me-1\"> {$value['qa_tag']} </span>"; ?>
            <?php echo (!$value['mobdev_tag']) ? '' : "<span class=\"badge bg-warning me-1\"> {$value['mobdev_tag']} </span>"; ?>
            <?php echo (!$value['ux_ui_tag']) ? '' : "<span class=\"badge bg-primary me-1\"> {$value['ux_ui_tag']} </span>"; ?>
            <span class="badge bg-info"> <?php echo $value['job_time']; ?> </span>
            <textarea name="motivational_speech" class="form-control mt-3" rows="10" placeholder="Why do you want to apply for this job?"></textarea>
            <div id="motivation_speech_response_text"></div>
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
            <input type="hidden" name="apply_job" value="">
          </div>
        </div>
      </div>
    </li>
<?php endforeach;
} ?>