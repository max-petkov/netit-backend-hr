<?php
include 'database.php';
if (isset($_POST['update_published_job_id'])) :
  $db = new PDO("mysql:host=localhost;dbname=monster_hr_db", "root", '');
  $sql = ("SELECT * FROM tb_published_jobs WHERE company_id='{$_SESSION['company_id']}' and id='{$_POST['update_published_job_id']}' ORDER BY published_date DESC");
  $stmt = $db->query($sql);
  $stmt->execute();
  $result = $stmt->fetch();
  while ($row = $result) : ?>

    <div class="update_published_job_box container">
      <div class="card mx-auto shadow rounded p-3">
        <div class="d-flex justify-content-between mt-3 mb-2 px-3">
          <h4 class="m-0">Update job:</h4>
          <button class="btn-close align-self-end"></button>
        </div>
        <div class="card-body">
          <form id="update_published_job_form" method="POST" action="">
            <div id="update_publish_succ_mess"></div>
            <div class="form-group mb-3">
              <label for="job_title" class="fw-bold">Job title</label>
              <input type="text" name="update_job_title" class="form-control form-control-sm" value="<?php echo $row['job_title']; ?>">
              <p id="update_job_title_response_text"></p>
            </div>
            <div class="mb-3">
              <div class="form-group d-flex">
                <div class="form-group mb-3 order-1">
                  <label for="job_time" class="fw-bold">Job time</label>
                  <div class="form-group mt-1">
                    <!-- TODO FULL TIME PART TIME CHECK -->
                    <input type="checkbox" name="update_job_time[0]" class="job_time_length form-check-input" value="full time" <?php if (str_contains("{$row['job_time']}", 'full time')) {
                                                                                            echo 'checked';
                                                                                          } ?>>
                    <label for="job_title">Full time</label>
                  </div>
                  <input type="checkbox" name="update_job_time[1]" class="job_time_length form-check-input" value="part time" <?php if (str_contains("{$row['job_time']}", 'part time')) {
                                                                                            echo 'checked';
                                                                                          } ?>>
                  <label for="job_title">Part time</label>
                </div>

                <div class="me-4">
                  <div class="form-group">
                    <label for="it_branches" class="fw-bold">IT tag
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path d="M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                      </svg>
                    </label>
                    <div class="form-check mt-1">
                      <input id="frontend_checked_tag" type="checkbox" class="it_tag_length form-check-input" name="update_it_tag[0]" value="frontend" <?php if ($row['frontend_tag'] != null || $row['frontend_tag'] != '') {
                                                                                                                                                  echo 'checked';
                                                                                                                                                } ?>>
                      <label class="form-check-label" for="it_branch">Front-end Development</label>
                    </div>
                    <div class="form-check mb-2">
                      <input id="backend_checked_tag" type="checkbox" class="it_tag_length form-check-input" name="update_it_tag[1]" value="backend" <?php if ($row['backend_tag'] != null || $row['backend_tag'] != '') {
                                                                                                                                                echo 'checked';
                                                                                                                                              } ?>>
                      <label class="form-check-label" for="it_branch">Back-end Development</label>
                    </div>
                    <div class="form-check mb-2">
                      <input id="fullstack_checked_tag" type="checkbox" class="it_tag_length form-check-input" name="update_it_tag[2]" value="fullstack" <?php if ($row['fullstack_tag'] != null || $row['fullstack_tag'] != '') {
                                                                                                                                                    echo 'checked';
                                                                                                                                                  } ?>>
                      <label class="form-check-label" for="it_branch">Fullstack Development</label>
                    </div>
                    <div class="form-check mb-2">
                      <input id="qa_checked_tag" type="checkbox" class="it_tag_length form-check-input" name="update_it_tag[3]" value="qa" <?php if ($row['qa_tag'] != null || $row['qa_tag'] != '') {
                                                                                                                                      echo 'checked';
                                                                                                                                    } ?>>
                      <label class="form-check-label" for="it_branch">Quality Assurance</label>
                    </div>
                    <div class="form-check mb-2">
                      <input id="mobdev_checked_tag" type="checkbox" class="it_tag_length form-check-input" name="update_it_tag[4]" value="mobdev" <?php if ($row['mobdev_tag'] != null || $row['mobdev_tag'] != '') {
                                                                                                                                              echo 'checked';
                                                                                                                                            } ?>>
                      <label class="form-check-label" for="it_branch">Mobile Development</label>
                    </div>
                    <div class="form-check mb-2">
                      <input id="ux_ui_checked_tag" type="checkbox" class="it_tag_length form-check-input" name="update_it_tag[5]" value="ux/ui" <?php if ($row['ux_ui_tag'] != null || $row['ux_ui_tag'] != '') {
                                                                                                                                            echo 'checked';
                                                                                                                                          } ?>>
                      <label class="form-check-label" for="it_branch">UX/UI</label>
                    </div>
                  </div>
                </div>
              </div>
              <p id="update_job_tag_response_text" class="mb-0"></p>
              <p id="update_job_time_response_text" class="mb-0"></p>
            </div>
            <div class="form-group mb-3 d-flex">
              <div class="form-group me-3">
                <label for="" class="fw-bold">Salary:</label>
                <?php 
                function job_salary_replace_words($string){
                  $search = array('€', '$', 'per month', 'per year');
                  $replace = array('', '', '', '');
                  return str_replace($search, $replace, $string);
                }
                ?>
                <input type="text" class="form-control" name="update_job_salary" value="<?php echo job_salary_replace_words($row['job_salary']); ?>">
                <p id="update_salary_response_text" class="m-0"></p>
              </div>

              <div class="form-group me-3">
                <label for="job_salary_currency" class="fw-bold">Currency:</label>
                <div class="form-group me-2">
                  <input type="radio" class="form-check-input" name="update_currency" value="€" <?php if (str_contains("{$row['job_salary']}", '€')) {
                                                                                            echo 'checked';
                                                                                          } ?>>
                  <label for="euro_currency">€</label>
                </div>
                <div class="form-group">
                  <input type="radio" class="form-check-input" name="update_currency" value="$" <?php if (str_contains("{$row['job_salary']}", '$')) {
                                                                                            echo 'checked';
                                                                                          } ?>>
                  <label for="dollar_currency">$</label>
                </div>
                <p id="update_currency_response_text" class="m-0"></p>
              </div>

              <div class="form-group">
                <label for="job_salary_year_month" class="fw-bold">Month/Year:</label>
                <div class="form-group me-2">
                  <input type="radio" class="form-check-input" name="update_month_year_salary" value="per month" <?php if (str_contains("{$row['job_salary']}", 'per month')) {
                                                                                            echo 'checked';
                                                                                          } ?>>
                  <label for="month_salary">per month</label>
                </div>
                <div class="form-group">
                  <input type="radio" class="form-check-input" name="update_month_year_salary" value="per year" <?php if (str_contains("{$row['job_salary']}", 'per year')) {
                                                                                            echo 'checked';
                                                                                          } ?>>
                  <label for="year_salar">per year</label>
                </div>
                <p id="update_job_month_year_response_text" class="m-0"></p>
              </div>

            </div>
            <div class="form-group">
              <label for="job_description" class="fw-bold">Job Description</label>
              <!-- NEED TO ADD CKEDITOR -->
              <textarea name="update_job_description" rows="8" class="form-control"><?php echo $row['job_description']; ?></textarea>
              <p id="update_job_description_response_text" class="m-0"></p>
            </div>
            <button type="submit" name="update_publish_job_submit" class="btn btn-primary mt-3" value="<?php echo $row['id']; ?>">Update</button>
          </form>
        </div>
      </div>
    </div>
    <?php break; ?>
  <?php endwhile; ?>
<?php endif; ?>
