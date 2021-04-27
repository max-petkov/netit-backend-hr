$(function () {

  // Update Company profile 
  $('#update_company_profile').on('submit', function (e) {
    e.preventDefault();
    let $company_name = $('input[name="name"]');
    let $slogan = $('input[name="slogan"]');
    let $address = $('input[name="address"]');
    let $website = $('input[name="website"]');
    let $company_description = $('textarea[name="company_description"]');
    let $company_history = $('textarea[name="company_history"]');
    let $company_mission = $('textarea[name="company_mission"]');
    let $nav_name = $('#company_name');
    let $greeting_name = $('#greetings_company_name');
    let $nav_address = $('#company_address');
    let $nav_website = $('#company_website');
    let $showcase_name = $('#showcase_company_name');
    let $showcase_desciption = $('#showcase_company_description');
    let $showcase_slogan = $('#showcase_company_slogan');
    let $showcase_history = $('#showcase_company_history');
    let $showcase_mission = $('#showcase_company_mission');
    let $showcase_branches = $('#showcase_it_branches');
    let $scs_msg = $('#success_mess_validation');
    let $checked_boxes = $('.js-checkbox-length:checked');
    let $response_boxes = $('#checkbox_response');
    let $proceed = true;
    let $form_data = $(this).serializeArray();
    $form_data.push({
      name: 'update_company',
      value: null
    });

    // Company name
    if (empty($company_name)) {
      invalid_response($company_name, 'Field can\'t be empty!');
      $proceed = false;
    } else {
      if (string_length($company_name, 4, 49)) {
        invalid_response($company_name, 'Field must be more than 3 and less than 50 symbols!');
        $proceed = false;
      } else {
        valid_response($company_name);
      }
    }

    // Address
    if (string_length($address, 0, 49)) {
      invalid_response($address, 'Field must be less than 50 symbols!');
      $proceed = false;
    } else {
      valid_response($address);
    }

    // Website
    if (string_length($website, 0, 49)) {
      invalid_response($website, 'Field must be less than 50 symbols!');
      $proceed = false;
    } else {
      if (no_match($website, /(-)|(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/)) {
        invalid_response($website, 'Your website must start with https://, http:// or ftp:// OR you can SAVE it like this!');
        $website.val('-');
        $proceed = false;
      } else {
        valid_response($website);
      }
    }

    // Slogan
    if (string_length($slogan, 0, 49)) {
      invalid_response($slogan, 'Your slogan must be less than 50 symbols!')
      $proceed = false;
    } else {
      valid_response($slogan);
    }

    // IT branches
    if (checkbox_radio_length($checked_boxes)) {
      checkbox_radio_invalid_response($response_boxes, 'You need to select atleast one branch!');
      $proceed = false;
    } else {
      $response_boxes.text('');
    }

    // Company description
    if (empty($company_description)) {
      invalid_response($company_description, 'Field can\'t be empty!');
      $proceed = false;
    } else {
      if (string_length($company_description, 49, 999)) {
        invalid_response($company_description, 'Field must be more than 49 and less than 1000 symbols!');
        $proceed = false;
      } else {
        valid_response($company_description);
      }
    }

    // Company history
    if (string_length($company_history, 0, 999)) {
      invalid_response($company_history, 'Field must be less than 1000 symbols!');
      $proceed = false;
    } else {
      valid_response($company_history);
    }

    // Company mission
    if (string_length($company_mission, 0, 999)) {
      invalid_response($company_mission, 'Field must be less than 1000 symbols!');
      $proceed = false;
    } else {
      valid_response($company_mission);
    }

    if ($proceed) {
      $.ajax({
        url: './src/update-profile.php',
        method: 'post',
        dataType: 'json',
        data: $form_data,
        success: function (response) {
          success_call($scs_msg);
          $nav_name.html(response.name);
          $greeting_name.html(`${response.name}`);
          $nav_address.html(response.address);
          $nav_website.html(response.website).attr('href', response.website);
          $showcase_name.text(response.name);
          $showcase_desciption.html(response.company_description);
          $showcase_slogan.html(response.slogan);
          $showcase_history.html(response.company_history);
          $showcase_mission.html(response.company_mission);
          $showcase_branches.load('company-dashboard.php #badge_it_container');
        },
        error: function () {
          console.log('error');
        }
      });
    }
  });

  // Upload image
  $('#upload_company_img').on('submit', function (e) {
    e.preventDefault();
    let $img = new FormData($(this)[0]);

    $.ajax({
      url: 'src/upload-file.php',
      method: 'post',
      processData: false,
      contentType: false,
      data: $img,
      success: function () {
        $('#showcase_container').load('company-dashboard.php #showcase_data');
      },
      error: function () {
        console.log('error');
      }
    });
  });

  // Change image
  $('body').on('click', '#change_logo', function () {
    let $form = $(this).siblings('div');
    let $close_btn = $(this).next();

    $close_btn.removeClass('d-none');
    $form.slideDown('slow').html(`<form id="upload_company_img" class="mt-3 method="POST" enctype="multipart/form-data">
    <div class="form-group mb-3">
      <input type="file" class="form-control-file" name="img_file">
      <div></div>
      <small class="form-text form-muted">Max 3mb size</small>
    </div>
    <input type="hidden" name="upload_file">
    <input type="submit" id="submit_upload" class="btn btn-primary btn-sm" value="Upload">
  </form>`);

    $('body').on('click', '#close_change_logo', function () {
      $form.slideUp('slow');
      $close_btn.addClass('d-none');
    });

    $('#upload_company_img').on('submit', function (e) {
      e.preventDefault();
      let img = new FormData($(this)[0]);

      $.ajax({
        url: 'src/upload-file.php',
        method: 'post',
        processData: false,
        contentType: false,
        data: img,
        success: function () {
          $('#showcase_container').load('company-dashboard.php #showcase_data');
          $('#change_container').load('company-dashboard.php #changed_data');
        },
        error: function () {
          console.log('error');
        }
      })
    });
  });

  // Publish job ajax
  $('#publish_form').on('submit', function (e) {
    e.preventDefault();
    let $job_title = $('input[name="job_title"]');
    let $checked_job_time = $('.job_time_length:checked');
    let $job_time_response = $('#job_time_response_text');
    let $checked_boxes = $('.it_tag_length:checked');
    let $checkbox_response = $('#job_tag_response_text');
    let $job_salary = $('input[name="salary"]');
    let $checked_currency = $('input[name="currency"]:checked');
    let $currency_response = $('#currency_response_text');
    let $checked_month_year = $('input[name="month_year_salary"]:checked');
    let $job_month_year_response = $('#job_month_year_response_text');
    let $job_description = $('textarea[name="description"]');
    let $proceed = true;
    let $scs_msg = $('#publish_succ_mess');
    let $form_data = $(this).serializeArray();
    $form_data.push({
      name: 'publish_job',
      value: null
    });

    // Job title
    if (empty($job_title)) {
      invalid_response($job_title, 'Field can not be empty!');
      $proceed = false;
    } else {
      if (string_length($job_title, 20, 254)) {
        invalid_response($job_title, 'Field must be more than 19 and less than 255 symbols!');
        $proceed = false;
      } else {
        valid_response($job_title);
      }
    }

    // IT tags
    if (checkbox_radio_length($checked_boxes)) {
      checkbox_radio_invalid_response($checkbox_response, 'You need to select atleast one tag!');
      $proceed = false;
    } else {
      $checkbox_response.text('');
    }

    // Job time
    if (checkbox_radio_length($checked_job_time)) {
      checkbox_radio_invalid_response($job_time_response, 'You need to choose between Fulltime or Part time!');
      $proceed = false;
    } else {
      $job_time_response.text('');
    }

    // Job salary
    if (!no_match($job_salary, /[a-zA-Z)(*&^%$#@!)]/)) {
      invalid_response($job_salary, 'You can put only [0-9,-.]!');
      $proceed = false
    } else {
      if (empty($job_salary)) {
        invalid_response($job_salary, 'Field can not be empty!')
        $proceed = false;
      } else {
        valid_response($job_salary);
      }
    }

    // Salary currency
    if (checkbox_radio_length($checked_currency)) {
      checkbox_radio_invalid_response($currency_response, 'Field is required!');
      $proceed = false;
    } else {
      $currency_response.text('');
    }

    // Month / Year salary
    if (checkbox_radio_length($checked_month_year)) {
      checkbox_radio_invalid_response($job_month_year_response, 'Field is required!');
      $proceed = false;
    } else {
      $job_month_year_response.text('');
    }

    // Job description
    if (empty($job_description)) {
      invalid_response($job_description, 'Field can not be empty!');
      $proceed = false;
    } else {
      if (string_length($job_description, 49, 999)) {
        invalid_response($job_description, 'Field must be more that 48 and less than 1000 symbols!');
        $proceed = false;
      } else {
        valid_response($job_description);
      }
    }

    if ($proceed) {
      $.ajax({
        url: 'src/publish-job.php',
        method: 'POST',
        data: $form_data,
        success: function () {
          success_call($scs_msg);
          $('#view_published_jobs').load('company-dashboard.php .job-li');
          $('#published_job_tab_container').load('company-dashboard.php #load_published_job_tab_container');
        },
        error: function (jqXHR, text, errorThrown) {
          console.log(jqXHR + " " + text + " " + errorThrown);
        },
      });
    }
  });

  // Turn off published job
  $('#view_published_jobs').on('click', '.js-remove-published-job', function () {
    let $published_job_id = $(this);
    let $job_ul = $('#view_published_jobs');
    let $job_li = $published_job_id.closest('li');

    $published_job_id.html('Loading...').addClass('disabled');

    $.ajax({
      url: 'src/publish-job.php',
      method: 'post',
      data: {
        published_job_id: $published_job_id.val(),
        is_active: 'N',
        set_inactive: null
      },
      success: function () {
        $job_li.fadeOut('slow', function () {
          $job_li.remove();
          $('#published_job_tab_container').load('company-dashboard.php #load_published_job_tab_container');
          if ($('#view_published_jobs li') === 0) {
            $job_ul.html(`<h6>There are no published jobs...</h6>`);
          }
        });
      }
    });
  });

  // Turn on published job
  $('#view_published_jobs').on('click', '#activate_published_job', function () {
    let $published_job_id = $(this);
    let $job_li = $published_job_id.closest('li');
    let $job_ul = $('#view_published_jobs');
    let $published_date = `${new Date().getFullYear()}-${adding_zeros_time(new Date().getMonth() + 1)}-${adding_zeros_time(new Date().getDate())}`;

    $published_job_id.html('Loading...').addClass('disabled');

    $.ajax({
      url: 'src/publish-job.php',
      method: 'post',
      data: {
        published_job_id: $published_job_id.val(),
        published_date: $published_date,
        is_active: 'Y',
        set_active: null
      },
      success: function () {
        $job_li.fadeOut('slow', function () {
          $job_li.remove();
          $('#published_job_tab_container').load('company-dashboard-in-active-jobs.php #load_published_job_tab_container');
          if ($('#view_published_jobs li').length === 0) {
            $job_ul.html(`<h6>There are no published jobs...</h6>`);
          }
        });
      }
    });
  });

  // Remove published job from database
  $('#view_published_jobs').on('click', '.js-remove-job-from-db', function () {
    let $job_li = $(this).closest('li');
    let $job_ul = $('#view_published_jobs');
    let $job_id = $(this).children('input');
    let $confirm_window = $(this).closest('div').next();

    $confirm_window.slideDown('slow').addClass('card border-primary mt-3')
      .html(`<div class="card-body">
      <h5 class="mb-3">Are you sure you want to delete this announcement?</h5>
      <button id="delete_confirmed" class="btn btn-primary btn-sm">Yes, proceed!</button>
      <button id="close_confirm_container" class="btn btn-secondary btn-sm">Close</button>
    </div>`);

    $(document).on('mouseup', function (e) {
      if (!$(e.target).closest($confirm_window).length && $confirm_window.is(':visible')) {
        $confirm_window.slideUp('slow');
      }
    });

    $confirm_window.on('click', '#delete_confirmed', function () {
      $.ajax({
        url: 'src/publish-job.php',
        method: 'post',
        data: {
          published_job_id: $job_id.val(),
          delete_job: null
        },
        success: function () {
          $job_li.fadeOut('slow', function () {
            $job_li.remove();
            $('#published_job_tab_container').load('company-dashboard-in-active-jobs.php #load_published_job_tab_container');
            if ($('#view_published_jobs li').length === 0) {
              $job_ul.html(`<h6>There are no published jobs...</h6>`);
            }
          });
        },
        error: function () {
          console.log('error');
        }
      })
    });
    $confirm_window.on('click', '#close_confirm_container', function () {
      $confirm_window.slideUp('fast');
    })
  });

  // Toggle between job tabs
  $('body').on('click', '#in_active_jobs', function (e) {
    e.preventDefault();
    if ($('#active_jobs').hasClass('active')) {
      $('#active_jobs').removeClass('active');
      $(this).addClass('active');
      $('#view_published_jobs').load('company-dashboard-in-active-jobs.php .job-li');
    }
  });

  $('body').on('click', '#active_jobs', function (e) {
    e.preventDefault();
    if ($('#in_active_jobs').hasClass('active')) {
      $('#in_active_jobs').removeClass('active');
      $(this).addClass('active');
      $('#view_published_jobs').load('company-dashboard.php .job-li');
    }
  });

  // Create HR account
  $('#hr_acc_form').on('submit', function (e) {
    e.preventDefault();
    let $username = $('#hr_username');
    let $email = $('#hr_email');
    let $password = $('input[name="password"]');
    let $confirm_password = $('input[name="confirm_password"]');
    let $scs_msg = $('#hr_succ_mess');
    let $proceed = true;
    let $form_data = $(this).serializeArray();

    $form_data.push({
      name: 'register_hr',
      value: null
    })

    $.ajax({
      url: 'src/create-profile.php',
      method: 'post',
      data: $form_data,
      success: function (response) {

        // HR username
        if (empty($username)) {
          invalid_response($username, 'Field can not be empty!');
          $proceed = false;
        } else {
          if (string_length($username, 4, 49)) {
            invalid_response($username, 'Field must have more than 3 and less than 50 symbols!');
            $proceed = false;
          } else {
            if (response.indexOf('username is taken') >= 0) {
              invalid_response($username, 'Username already exist!');
              $proceed = false;
            } else {
              valid_response($username);
            }
          }
        }

        // HR email
        if (empty($email)) {
          invalid_response($email, 'Field can not be empty!');
          $proceed = false;
        } else {
          if (string_length($email, 0, 254)) {
            invalid_response($email, 'Field must have more than 3 and less than 255 symbols!');
            $proceed = false;
          } else {
            if (response.indexOf('email is taken') >= 0) {
              invalid_response($email, 'Email already exist!');
              $proceed = false;
            } else {
              if (no_match($email, /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
                invalid_response($email, 'Invalid format... example@mail.com!');
                $proceed = false;
              } else {
                valid_response($email);
              }
            }
          }
        }

        // HR password
        if (empty($password)) {
          invalid_response($password, 'Field can not be empty!');
          $proceed = false;
        } else {
          if (string_length($password, 4, 49)) {
            invalid_response($password, 'Field must have more than 3 and less than 50 symbols!');
            $proceed = false;
          } else {
            valid_response($password);
          }
        }

        // HR confirm password
        if (empty($confirm_password)) {
          invalid_response($confirm_password, 'Field can not be empty!');
          $proceed = false;
        } else {
          if (match_password($password, $confirm_password)) {
            invalid_response($confirm_password, 'Passwords must match!');
            $proceed = false;
          } else {
            valid_response($confirm_password);
          }
        }

        if ($proceed) {
          $.ajax({
            url: 'src/create-profile.php',
            method: 'post',
            data: $form_data,
            success: function () {
              success_call($scs_msg);
            }
          });
        }
      }
    });
  });

  // Update inbox counter
  $('body').on('click', '.js-message-icon', function () {
    let $envelope_icon_number = $(this).children('span').text();
    let $inbox = $('#inbox_company_counter_container');

    if ($envelope_icon_number !== '0') {
      $.ajax({
        url: 'src/message-controller.php',
        method: 'post',
        data: {
          inbox_company_counter: null,
          reset_counter: null
        },
        success: function () {
          $inbox.load('company-dashboard.php #inbox_company_counter');
        }
      });
    }
  });
});