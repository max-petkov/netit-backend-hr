<?php session_start(); ?>
<?php include_once 'src/Candidate.php'; ?>

<!--Rejected applicants -->
<div id="applicants_container" class="container-sm mt-4">
  <div id="applicants_data" class="card table-responsive shadow rounded">
    <div class="card-header w-1400px">
      <h4 class="my-3">Applicants</h4>
      <ul class="nav nav-tabs card-header-tabs">
        <li class="nav-item">
          <a id="new_applicants_tab" href="hr-dashboard.php" class="nav-link">New applicants (<?php Candidate::count_candidates(' IS NULL'); ?>)</a>
        </li>
        <li class="nav-item">
          <a id="approved_applicants_tab" href="hr-dashboard-approved.php" class="nav-link">Approved (<?php Candidate::count_candidates("='Y'"); ?>)</a>
        </li>
        <li class="nav-item">
          <a id="reject_applicants_tab" href="hr-dashboard-reject.php" class="nav-link active">Reject (<?php Candidate::count_candidates("='N'"); ?>)</a>
        </li>
      </ul>
    </div>
    <div class="card-body w-1400px">
      <table class="table table-hover">
        <thead class="table table-danger">
          <tr>
            <th>#</th>
            <th>Published job</th>
            <th>Candidate profile</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $candidate = new Candidate;
          $rejected_candidate = $candidate->display_candidate("='N'");
          $candidate_data = $rejected_candidate->fetchAll(PDO::FETCH_BOTH);
          foreach ($candidate_data as $key => $value) : ?>
            <tr class="js-applicants-data">
              <th scope="row">
                <?php echo $key + 1; ?>
              </th>
              <td class="w-50">
                <p class="m-0 small"><span class="fw-bold">Published date :</span> <?php echo $value['published_date']; ?></p>
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
                <p class="mt-3 d-none"><b>Description: </b> <?php echo $value['job_description']; ?></p>
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
                  <button class="js-send-message-job-seeker btn btn-outline-primary btn-sm d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1 bi bi-reply" viewBox="0 0 16 16">
                      <path d="M6.598 5.013a.144.144 0 0 1 .202.134V6.3a.5.5 0 0 0 .5.5c.667 0 2.013.005 3.3.822.984.624 1.99 1.76 2.595 3.876-1.02-.983-2.185-1.516-3.205-1.799a8.74 8.74 0 0 0-1.921-.306 7.404 7.404 0 0 0-.798.008h-.013l-.005.001h-.001L7.3 9.9l-.05-.498a.5.5 0 0 0-.45.498v1.153c0 .108-.11.176-.202.134L2.614 8.254a.503.503 0 0 0-.042-.028.147.147 0 0 1 0-.252.499.499 0 0 0 .042-.028l3.984-2.933zM7.8 10.386c.068 0 .143.003.223.006.434.02 1.034.086 1.7.271 1.326.368 2.896 1.202 3.94 3.08a.5.5 0 0 0 .933-.305c-.464-3.71-1.886-5.662-3.46-6.66-1.245-.79-2.527-.942-3.336-.971v-.66a1.144 1.144 0 0 0-1.767-.96l-3.994 2.94a1.147 1.147 0 0 0 0 1.946l3.994 2.94a1.144 1.144 0 0 0 1.767-.96v-.667z" />
                    </svg>
                    Send Message
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
                <!-- SEND MESSAGE -->
                <div class="js-message-job-seeker-box card shadow rounded d-none">
                  <div class="d-flex justify-content-between mt-3 mb-2 px-3">
                    <h4 class="m-0">Send message:</h4>
                    <button class="btn-close align-self-end"></button>
                  </div>
                  <div class="card-body">
                    <form method="POST">
                      <div class="js-scs-msg"></div>
                      <div class="form-group mb-2">
                        <label for="to"><b>From:</b></label>
                        <input type="text" class="form-control form-control-sm" value="<?php echo $value[2]; ?>" disabled>
                        <input type="hidden" name="from" value="<?php echo $_SESSION['hr_id']; ?>">
                      </div>
                      <div class="form-group mb-2">
                        <label for="to"> <b>To:</b></label>
                        <input type="email" class="form-control form-control-sm" value="<?php echo $value['first_name']; ?>" disabled>
                        <input type="hidden" name="to" value="<?php echo $value['job_seeker_id']; ?>">
                      </div>
                      <div class="form-group mb-2">
                        <label for="subject"><b>Subject:</b></label>
                        <input type="text" class="form-control form-control-sm" name="subject" value="">
                      </div>
                      <div class="form-group">
                        <label for="message"><b>Message:</b></label>
                        <textarea name="msg" class="form-control" rows="6"></textarea>
                      </div>
                      <button type="submit" class="js-submit-sending-msg-job-seeker btn btn-primary d-flex align-items-center mt-3">
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
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?php echo ($rejected_candidate->rowCount() === 0) ? '<h5>There are no candidates...</h5>' : ''; ?>
    </div>
  </div>
</div>