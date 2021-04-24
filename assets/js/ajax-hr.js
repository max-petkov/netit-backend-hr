$(function () {
  // Interview candidate
  $('.js-applicants-data').on('click', '.js-interview-answer', function () {
    let $btn = $(this);
    let $interviewed_btns = $(this).closest('.d-flex');
    let $job_id = $(this).siblings('.js-job-id');
    let $job_seeker_id = $(this).siblings('.js-job-seeker-id');
    let $btn_container = $(this).closest('.js-is-interviewed');

    if ($btn.val() === 'Y') {
      $.ajax({
        url: 'src/candidate-status.php',
        method: 'post',
        data: {
          candidate_status: null,
          interviewed_yes: $btn.val(),
          job_id: $job_id.val(),
          job_seeker_id: $job_seeker_id.val()
        },
        success: function () {
          $interviewed_btns.fadeOut('slow', function () {
            $btn_container.html(`<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-check2-circle text-success" viewBox="0 0 16 16">
            <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
            <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
          </svg>`);
          });
        }
      });
    }

    if ($btn.val() === 'N') {
      $.ajax({
        url: 'src/candidate-status.php',
        method: 'post',
        data: {
          candidate_status: null,
          interviewed_no: $btn.val(),
          job_id: $job_id.val(),
          job_seeker_id: $job_seeker_id.val()
        },
        success: function () {
          $interviewed_btns.fadeOut('slow', function () {
            $btn_container.html(`<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-x-circle text-danger" viewBox="0 0 16 16">
              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
              <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>`);
          });
        }
      });
    }
  });

  // Approve applicant 
  $('body').on('click', '.js-approve-answer', function () {
    let $btn = $(this);
    let $approved_btns = $('.js-approve-answer');
    let $candidate_name = $(this).siblings('.js-candidate-name').val();
    let $job_id = $(this).siblings('.js-job-id');
    let $job_seeker_id = $(this).siblings('.js-job-seeker-id');
    let $candidate_row = $(this).closest('.js-applicants-data');
    let $refresh_table = $('#applicants_container');
    let $confirm_window = $btn.closest('.d-flex').next();

    $approved_btns.addClass('disabled');
    $confirm_window.on('click', '#close_confirm_approve_box', function () {
      $confirm_window.animate({
        right: '-544px',
        opacity: '0'
      }, 'fast', function () {
        $approved_btns.removeClass('disabled')
      });
    });

    if ($btn.val() === 'Y') {
      $confirm_window.animate({
        right: '32px',
        opacity: '1'
      }, 'fast', function () {
        $confirm_window.addClass('card border-primary shadow rounded')
          .html(`<div class="card-body">
        <h5 class="mb-3">${$candidate_name} will go into <u>approved</u> tab! Do you want to proceed?</h5>
        <button id="approve_candidate" class="btn btn-primary btn-sm" value="Y">Yes, proceed!</button>
        <button id="close_confirm_approve_box" class="btn btn-secondary btn-sm" value="N">Close</button>
        </div>`);
      });

      $confirm_window.on('click', '#approve_candidate', function () {
        $.ajax({
          url: 'src/candidate-status.php',
          method: 'post',
          data: {
            candidate_status: null,
            approve_candidate: $btn.val(),
            job_id: $job_id.val(),
            job_seeker_id: $job_seeker_id.val()
          },
          success: function () {
            remove_element($candidate_row, $refresh_table.load('hr-dashboard.php #applicants_data'));
          }
        });
      });
    }

    if ($btn.val() === 'N') {
      $confirm_window.animate({
        right: '32px',
        opacity: '1'
      }, 'fast', function () {
        $confirm_window.addClass('card border-primary shadow rounded')
          .html(`<div class="card-body">
        <h5 class="mb-3">${$candidate_name} will go into <u>rejected</u> tab! Do you want to proceed?</h5>
        <button id="approve_candidate" class="btn btn-primary btn-sm" value="Y">Yes, proceed!</button>
        <button id="close_confirm_approve_box" class="btn btn-secondary btn-sm" value="N">Close</button>
        </div>`);
      });

      $confirm_window.on('click', '#approve_candidate', function () {
        $.ajax({
          url: 'src/candidate-status.php',
          method: 'post',
          data: {
            candidate_status: null,
            reject_candidate: $btn.val(),
            job_id: $job_id.val(),
            job_seeker_id: $job_seeker_id.val()
          },
          success: function () {
            remove_element($candidate_row, $refresh_table.load('hr-dashboard.php #applicants_data'));
          }
        });
      });
    }
  });

  // Applicants nav-tabs
  let $applicants = $('#applicants_container');

  $('body').on('click', '#new_applicants_tab', function (e) {
    e.preventDefault();
    $applicants.load('hr-dashboard.php #applicants_data')
  });

  $('body').on('click', '#approved_applicants_tab', function (e) {
    e.preventDefault();
    $applicants.load('hr-dashboard-approved.php #applicants_data')
  });

  $('body').on('click', '#reject_applicants_tab', function (e) {
    e.preventDefault();
    $applicants.load('hr-dashboard-reject.php #applicants_data')
  });

  // Reset inbox counter
  $('body').on('click', '.message_icon', function () {
    let $envelope_icon_number = $(this).children('span').text();

    if ($envelope_icon_number !== '0') {
      $.ajax({
        url: 'src/message-controller.php',
        method: 'post',
        data: {
          inbox_hr_counter: null,
          reset_counter: null
        },
        success: function () {
          $('#inbox_hr_counter_container').load('hr-dashboard.php #inbox_hr_counter');
        }
      });
    }
  });
})