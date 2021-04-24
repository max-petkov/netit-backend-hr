// jQuery
$(function () {

  let message_box = $('.js-message-box');
  let application_open = $('#addplication_button');
  let application_box = $('.application_box');
  let profile_open = $('#profile_button');
  let profile_box = $('.profile_box');
  let $publish_job_open = $('#publish_job_button');
  let $publish_job_box = $('.publish_job_box');
  let $hr_open = $('#hr_button');
  let $hr_box = $('.js_hr_box');
  let $open_sending_msg_hr = $('#open_sending_msg_container');
  let $sending_msg_hr_box = $('#send_msg_hr_box');
  let $sending_msg_company_box = $('#send_msg_company_box');
  let $open_upload_img = $('#open_upload_img');
  let $upload_img_box = $('.js-upload-logo-box');
  let $sent_tab = $('#sent_tab');
  let all_boxes = $('.js-message-box, .application_box, .profile_box, .publish_job_box, .js-update-publish-job-form, .js_hr_box, .js-send-msg-hr-box, .js-send-msg-company-box, .js-upload-logo-box ');

  // Message icon click event
  $('body').on('click', '.js-message-icon', function () {
    if (message_box.hasClass('d-none')) {
      message_box.removeClass('d-none').animate({
        right: '32px',
        opacity: '1'
      }, 'fast');
    }
  });

  //  Change message icon on hover
  $('body').on('mouseenter', '.js-message-icon', function () {
    let $envelope_open = $(this).find('#envelope_open');
    let $envelope_close = $(this).find('#envelope_close');

    $envelope_close.addClass('d-none');
    $envelope_open.removeClass('d-none');
  });

  $('body').on('mouseleave', '.js-message-icon', function () {
    let $envelope_open = $(this).find('#envelope_open');
    let $envelope_close = $(this).find('#envelope_close');

    $envelope_open.addClass('d-none');
    $envelope_close.removeClass('d-none');
  });

  // Text expanding on message
  $('.js-expand-text').slideUp();
  $('body').on('click', '.js-chevron', function () {
    let $chevron = $(this);
    let $msg = $(this).closest('.d-flex').next();

    $chevron.toggleClass('chevron-animation-open');
    $msg.slideToggle();
  });

  // Application box
  application_open.on('click', function () {
    if (application_box.hasClass('d-none')) {
      application_box.removeClass('d-none').animate({
        right: '32px',
        opacity: '1'
      }, 'fast');
      $('#applied_job_container').load('employee-dashboard.php .applied_job_data');
    }
  });

  // Profile box
  profile_open.on('click', function () {
    if (profile_box.hasClass('d-none')) {
      profile_box.removeClass('d-none').animate({
        right: '32px',
        opacity: '1'
      }, 'fast');
    }
  });

  // Publish job box
  $publish_job_open.on('click', function () {
    if ($publish_job_box.hasClass('d-none')) {
      $publish_job_box.removeClass('d-none').animate({
        right: '32px',
        opacity: '1'
      }, 'fast');
    }
  });

  // HR box
  $hr_open.on('click', function () {
    if ($hr_box.hasClass('d-none')) {
      $hr_box.removeClass('d-none').animate({
        right: '32px',
        opacity: '1'
      }, 'fast');
    }
  });

  // Sending msg HR box
  $open_sending_msg_hr.on('click', function () {
    if ($sending_msg_hr_box.hasClass('d-none')) {
      $sending_msg_hr_box.removeClass('d-none').animate({
        right: '32px',
        opacity: '1'
      }, 'fast');
    }
  });

  // Sending msg Company box
  $open_sending_msg_hr.on('click', function () {
    if ($sending_msg_company_box.hasClass('d-none')) {
      $sending_msg_company_box.removeClass('d-none').animate({
        right: '32px',
        opacity: '1'
      }, 'fast');
    }
  });

  $open_upload_img.on('click', function () {
    if ($upload_img_box.hasClass('d-none')) {
      $upload_img_box.removeClass('d-none').animate({
        right: '32px',
        opacity: '1'
      }, 'fast');
    }
  });

  // Close app, mess, profile on clicking the X
  $('.btn-close').on('click', function () {
    (all_boxes).animate({
      right: '-544px',
      opacity: '0'
    }, 'slow', function () {
      $(this).addClass('d-none');
    })
  });


  // Close mess, app, profile boxes when clicking outside
  $(document).on('mouseup', function (e) {
    if (!$(e.target).closest(all_boxes).length && all_boxes.is(':visible')) {
      all_boxes.animate({
        right: '-544px',
        opacity: '0'
      }, 'slow', function () {
        $(this).addClass('d-none');
      });
    }
  });

  //  Message box tabs
  $sent_tab.closest('.nav').siblings('#sent_ul').slideUp();
  $sent_tab.on('click', function () {
    $sent_tab.closest('.nav')
      .siblings('#inbox_ul')
      .slideUp(function () {
        $sent_tab.prev().children('a').removeClass('active');
        $sent_tab.children('a').addClass('active');
        $sent_tab.closest('.nav').siblings('#sent_ul').slideDown();
      })
  });

  $('#inbox_tab').on('click', function () {
    $inbox_tab = $('#inbox_tab');
    $inbox_tab.closest('.nav')
      .siblings('#sent_ul')
      .slideUp(function () {
        $inbox_tab.next().children('a').removeClass('active');
        $inbox_tab.children('a').addClass('active');
        $inbox_tab.closest('.nav').siblings('#inbox_ul').slideDown();
      })
  });

  //  Show job description
  $('body').on('click', '.js-show-job-description', function () {
    $read_description = $(this);
    $job_description = $(this).closest('div').prev();

    $job_description.removeClass('d-none').slideDown('slow', function () {
      $read_description.removeClass('btn-primary js-show-job-description')
        .addClass('btn-secondary js-close-job-description')
        .text('Close');
    });

  });

  $('body').on('click', '.js-close-job-description', function () {
    $read_description = $(this);
    $job_description = $(this).closest('div').prev();

    $job_description.slideUp('slow', function () {
      $read_description.removeClass('btn-secondary js-close-job-description')
        .addClass('btn-primary js-show-job-description')
        .html(`<svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
         <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
         <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
       </svg>
       Read more`);
    });
  });

  // If there are no results on employee-dashboard published jobs
  if ($('#published_job_list li').length === 0) {
    $('#published_job_list').html(`<h6>There are no published jobs...</h6>`);
  }

  // Bootstrap 5 tooltip FIY-> data-bs-animation="false" will prevent from dissapering the tooltip after multiple hovers
  $('body').tooltip({
    boundary: 'window',
    selector: '[data-bs-toggle="tooltip"]'
  });

  //  Approved candidates company dashboard
  $('#approved_candidates').on('click', function () {
    $('#candidates_container').fadeIn('slow', function () {
      $('#candidates_container').removeClass('d-none');
    });
  });

  $('.js-close-approved-candidates').on('click', function () {
    $('#candidates_container').fadeOut('slow');
  })


})