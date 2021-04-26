$(function () {
  // Apply job
  $('body').on('click', '.js-apply-job', function () {
    let $apply_btn = $(this);
    let $job_seeker_id = $(this).next();
    let $random_chars = $(this).next().next();
    let $mot_speech = $apply_btn.closest('div').next();

    if (window.innerWidth <= 768) {
      $mot_speech.removeClass('d-none').animate({
        top: '0px',
        right: '0px',
        opacity: '1'
      }, 'fast', function () {
        $apply_btn.text('Waiting...').removeClass('btn-outline-success').addClass('btn-success disabled');
      });
    } else {
      $mot_speech.removeClass('d-none').animate({
        top: '0px',
        right: '32px',
        opacity: '1'
      }, 'fast', function () {
        $apply_btn.text('Waiting...').removeClass('btn-outline-success').addClass('btn-success disabled');
      });
    }

    $mot_speech.on('click', '.btn-close', function () {
      let $close_mot_speech = $(this).closest('.container');

      $close_mot_speech.animate({
        right: '-544px',
        opacity: '0'
      }, 'slow', function () {
        $close_mot_speech.addClass('d-none');
        $apply_btn.html(`
              <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
              <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
            </svg>
            Apply`).removeClass('disabled');
      });
    });

    $mot_speech.on('click', '.js-send-speech', function () {
      let $send_btn = $(this);
      let $success_msg = $(this).closest('.card-body').children('#apply_succ_mess');
      let $speech = $(this).closest('.js-motivation-speech');
      let $textarea = $(this).siblings('.form-control');
      let $proceed = true;

      if (string_length($textarea, 49, 999)) {
        invalid_response($textarea, 'Field must be more than 49 or less than 999 symbols!');
        $proceed = false;
      } else {
        valid_response($textarea);
      }

      if ($proceed) {
        $.ajax({
          url: 'src/publish-job.php',
          cache: false,
          method: 'post',
          data: {
            job_id: $apply_btn.val(),
            job_seeker_id: $job_seeker_id.val(),
            random_chars: $random_chars.val(),
            is_applied: 'Y',
            motivation_speech: $textarea.val(),
            apply_job: null
          },
          success: function () {
            $apply_btn.text('Applied!').removeClass('btn-outline-success').addClass('btn-success disabled');
            $send_btn.text('Success!').addClass('disabled');
            success_mot_speech($success_msg, $speech);
          }
        });
      }
    });
  });

  // Cancel applications
  $('#applied_job_container').on('click', '.js-cancel-application', function (e) {
    e.preventDefault();
    let $btn = $(this);
    let $applied_id = $btn.next().val();
    let $job_li = $('#published_job_list');

    $btn.text('Loading...').addClass('disabled');
    $.ajax({
      url: 'src/publish-job.php',
      method: 'post',
      data: {
        applied_id: $applied_id,
        cancel_application: null
      },
      success: function () {
        remove_element($btn.closest('li'), $job_li.load('employee-dashboard.php .js-job-li'));
      }
    });
  });

  // Sorting job list
  $('#select_it_tag').on("change", function () {
    let $option = $(this).val();
    let $job_li = $('#published_job_list');

    $job_li.html('Loading results...');
    if ($option === '*') {
      $.ajax({
        url: 'src/sort-job-list.php',
        method: 'post',
        data: {
          default_list: $option
        },
        success: function (response) {
          if (!$.trim(response)) {
            $job_li.html(`<h6>There are no published jobs...</h6>`);
          } else {
            $job_li.html($.trim(response));
          }
        }
      });
    } else if ($option === 'ux_ui') {
      $.ajax({
        url: 'src/sort-job-list.php',
        method: 'post',
        data: {
          ux_ui: $option,
          ux_ui_tag: 'ux/ui'
        },
        success: function (response) {
          if (!$.trim(response)) {
            $job_li.html(`<h6>There are no published jobs...</h6>`);
          } else {
            $job_li.html($.trim(response));
          }
        }
      });
    } else {
      $.ajax({
        url: 'src/sort-job-list.php',
        method: 'post',
        data: {
          tag_list: $option
        },
        success: function (response) {
          if (!$.trim(response)) {
            $job_li.html(`<h6>There are no published jobs...</h6>`);
          } else {
            $job_li.html($.trim(response));
          }
        }
      });
    }
  });

  // Search by title or company name
  $('#search_by_title_company').on('keyup', function () {
    let $string = $(this).val();
    let $job_list = $('#published_job_list');

    // Reseting job list when there is no input value
    if (!$string) {
      $.ajax({
        url: 'src/sort-job-list.php',
        method: 'post',
        data: {
          default_list: '*'
        },
        success: function (response) {
          if (!$.trim(response)) {
            $job_list.html(`<h6>There are no published jobs...</h6>`);
          } else {
            $job_list.html($.trim(response));
          }
        }
      });
    } else {
      $.ajax({
        url: 'src/sort-job-list.php',
        method: 'post',
        data: {
          search_by_company_name: $string
        },
        success: function (response) {
          if (!$.trim(response)) {
            $job_list.html(`<h6>There are no published jobs...</h6>`);
          } else {
            $job_list.html($.trim(response));
          }
        }
      });
    }
  });

  // Update employee profile 
  $('#job_seeker_profile_form').on('submit', function (e) {
    e.preventDefault();
    let $first_name = $('input[name="name"]');
    let $last_name = $('input[name="last_name"]');
    let $address = $('input[name="address"]');
    let $website = $('input[name="website"]');
    let $short_introduction = $('textarea[name="short_introduction"]');
    let $success_msg = $(this).children('div').next().children('.js-success-msg');
    let $greetings_fm = $('#greetings_first_name');
    let $nav_fm = $('#employee_first_name');
    let $nav_lm = $('#employee_last_name');
    let $nav_address = $('#employee_address');
    let $nav_web = $('#employee_website');
    let $proceed = true; // Proceed will tell ajax if everything is true proceed with ajax call if proceed is false don't make ajax call
    let $form_data = $(this).serializeArray();

    $form_data.push({
      name: 'update_employee', //It will be used as isset() at server side validation
      value: null
    });

    // First name
    if (empty($first_name)) {
      invalid_response($first_name, 'Field can\'t be empty!');
      $proceed = false;
    } else {
      if (string_length($first_name, 4, 49)) {
        invalid_response($first_name, 'Field must be more than 3 and less than 50 symbols!');
        $proceed = false;
      } else {
        valid_response($first_name);
      }
    }

    // Last name
    if (empty($last_name)) {
      invalid_response($last_name, 'Field can\'t be empty!');
      $proceed = false;
    } else {
      if (string_length($last_name, 4, 49)) {
        invalid_response($last_name, 'Field must be more than 3 and less than 50 symbols!');
        $proceed = false;
      } else {
        valid_response($last_name);
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

    // Short introduction
    if (empty($short_introduction)) {
      invalid_response($short_introduction, 'Field can\'t be empty or SAVE it like this!');

      $short_introduction.val(`  - 👋 Hi, I’m ...
  - 👀 I’m interested in ...
  - 🌱 I’m currently learning ...
  - 💞️ I’m looking to collaborate on ...
  - 📫 How to reach me ...`);
      $proceed = false;
    } else {
      if (string_length($short_introduction, 49, 999)) {
        invalid_response($short_introduction, 'Field must be more than 49 or less than 999 symbols OR you can SAVE it like this!');

        $short_introduction.val(`  - 👋 Hi, I’m ...
  - 👀 I’m interested in ...
  - 🌱 I’m currently learning ...
  - 💞️ I’m looking to collaborate on ...
  - 📫 How to reach me ...`);
        $proceed = false;
      } else {
        valid_response($short_introduction);
      }
    }

    if ($proceed) {
      $.ajax({
        url: 'src/update-profile.php',
        method: 'post',
        dataType: 'json',
        data: $form_data,
        success: function (response) {
          success_call($success_msg);
          $greetings_fm.html(`${response.name}`);
          $nav_fm.html(response.name);
          $nav_lm.html(response.last_name);
          $nav_address.html(response.address);
          $nav_web.html(response.website).attr('href', response.website);
        },
        error: function () {
          console.log('error');
        }
      });
    }
  });

  // Reset inbox counter
  $('body').on('click', '.js-message-icon', function () {
    let $envelope_icon_number = $(this).children('span').text();
    if ($envelope_icon_number !== '0') {
      $.ajax({
        url: 'src/message-controller.php',
        method: 'post',
        data: {
          inbox_job_seeker_counter: null,
          reset_counter: null
        },
        success: function () {
          $('#inbox_job_seeker_counter_container').load('employee-dashboard.php #inbox_job_seeker_counter');
        }
      });
    }
  });

  // Lazy load job list
  let $mincount = 10;
  let $maxcount = 20;
  $('#published_job_list li').slice(10).hide();
  $(window).on('scroll', function () {
    if ($(window).scrollTop() + $(window).height() >= $(document).height() - 400) {
      $('#published_job_list li').slice($mincount, $maxcount).show();
      $mincount = $mincount + 10;
      $maxcount = $maxcount + 10;
    }
  });

  // Refresh Application box
  $('body').on('click', '#application_btn', function () {
    $('#applied_job_container').load('employee-dashboard.php .applied_job_data');
  });
})