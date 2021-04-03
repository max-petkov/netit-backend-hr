<?php

include 'database.php';

if (isset($_POST['tag_list'])) {
  $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
  $sql = ("SELECT * FROM tb_published_jobs WHERE is_active='Y' AND {$_POST['tag_list']}_tag='{$_POST['tag_list']}' ORDER BY id DESC");
  $stmt = $db->query($sql);
  $stmt->execute();
  $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
  foreach ($row as $value) : ?>
    <li class="job-li list-group-item py-3">
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
    </li>
<?php endforeach;
} ?>

<?php
if (isset($_POST['ux_ui'])) {
  $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
  $sql = ("SELECT * FROM tb_published_jobs WHERE is_active='Y' AND {$_POST['ux_ui']}_tag='{$_POST['ux_ui_tag']}' ORDER BY id DESC");
  $stmt = $db->query($sql);
  $stmt->execute();
  $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
  foreach ($row as $value) : ?>
    <li class="job-li list-group-item py-3">
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
    </li>
<?php endforeach;
} ?>

<?php
if (isset($_POST['default_list'])) {
  $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
  $sql = ("SELECT {$_POST['default_list']} FROM tb_published_jobs WHERE is_active='Y' ORDER BY id DESC");
  $stmt = $db->query($sql);
  $stmt->execute();
  $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
  foreach ($row as $value) : ?>
    <li class="job-li list-group-item py-3">
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
    </li>
<?php endforeach;
} ?>

<?php
// Searching by title
if (!empty($_POST['search_by_job_title'])) {
  $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
  $sql = ("SELECT * FROM tb_published_jobs WHERE is_active='Y' AND job_title LIKE '{$_POST['search_by_job_title']}%' ORDER BY id DESC");
  $stmt = $db->query($sql);
  $stmt->execute();
  $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
  foreach ($row as $value) : ?>
    <li class="job-li list-group-item py-3">
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
    </li>
<?php endforeach;
} ?>



