// jQuery
$(function () {

  let message_box = $('.js-message-box');
  let application_open = $('#application_btn');
  let application_box = $('.application_box');
  let profile_open = $('#profile_button');
  let profile_box = $('.profile_box');
  let $publish_job_open = $('#publish_job_button');
  let $publish_job_box = $('.publish_job_box');
  let $hr_open = $('#hr_button');
  let $hr_box = $('.js_hr_box');
  let $open_sending_form = $('#open_sending_msg_container');
  let $sending_msg_hr_box = $('#send_msg_hr_box');
  let $sending_msg_company_box = $('#send_msg_company_box');
  let $open_upload_img = $('#open_upload_img');
  let $upload_img_box = $('.js-upload-logo-box');
  let $sent_tab = $('#sent_tab');
  let all_boxes = $('.js-message-box, .application_box, .profile_box, .publish_job_box, .js-update-publish-job-form, .js_hr_box, .js-send-msg-hr-box, .js-send-msg-company-box, .js-upload-logo-box ');


  if (window.innerWidth > 768) {
    show_box_lg_screen(profile_open, profile_box); // Profile box
    show_box_lg_screen(application_open, application_box); // Application box
    show_box_lg_screen($publish_job_open, $publish_job_box); // Publish box
    show_box_lg_screen($hr_open, $hr_box); // HR box
    show_box_lg_screen($open_sending_form, $sending_msg_hr_box); // Sending msg box from HR
    show_box_lg_screen($open_sending_form, $sending_msg_company_box); // Sending msg box from company
    show_box_lg_screen($open_upload_img, $upload_img_box); // Upload img

    // Message box
    $('body').on('click', '.js-message-icon', function () {
      if (message_box.hasClass('d-none')) {
        message_box.removeClass('d-none').animate({
          top: '49px',
          right: '32px',
          opacity: '1'
        }, 'fast', function () {
          if (message_box.height() > 768) {
            message_box.addClass('js-h-600px js-overflow-y-scroll');
          }
        });
      }
    });
  }

  if (window.innerWidth <= 768) {
    show_box_sm_screen(profile_open, profile_box); // Profile box
    show_box_sm_screen(application_open, application_box); // Application box
    show_box_sm_screen($publish_job_open, $publish_job_box); // Publish box
    show_box_sm_screen($hr_open, $hr_box); // HR box
    show_box_sm_screen($open_sending_form, $sending_msg_hr_box); // Sending msg box from HR
    show_box_sm_screen($open_sending_form, $sending_msg_company_box); // Sending msg box from HR
    show_box_sm_screen($open_upload_img, $upload_img_box); // Upload img

    // Message box
    $('body').on('click', '.js-message-icon', function () {
      if (message_box.hasClass('d-none')) {
        message_box.removeClass('d-none').animate({
          top: '49px',
          right: '1px',
          opacity: '1'
        }, 'fast', function () {
          if (message_box.height() > 768) {
            message_box.addClass('js-h-600px js-overflow-y-scroll');
          }
        });
      }
    });
  }

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
      $read_description.removeClass('btn-outline-primary js-show-job-description')
        .addClass('btn-outline-secondary js-close-job-description')
        .text('Close');
    });

  });

  $('body').on('click', '.js-close-job-description', function () {
    $read_description = $(this);
    $job_description = $(this).closest('div').prev();

    $job_description.slideUp('slow', function () {
      $read_description.removeClass('btn-outline-secondary js-close-job-description')
        .addClass('btn-outline-primary js-show-job-description')
        .html(`<svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
         <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
         <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
       </svg>
       Read more`);
    });
  });

  //  Read motivation speech
  $('body').on('click', '.js-read-mot-speech', function () {
    $read_description = $(this);
    $job_description = $(this).closest('div').next();

    $job_description.removeClass('d-none').slideDown('slow', function () {
      $read_description.removeClass('btn-outline-primary js-read-mot-speech')
        .addClass('btn-outline-secondary js-close-mot-speech')
        .text('Close');
    });

  });

  $('body').on('click', '.js-close-mot-speech', function () {
    $read_description = $(this);
    $job_description = $(this).closest('div').next();

    $job_description.slideUp('slow', function () {
      $read_description.removeClass('btn-outline-secondary js-close-mot-speech')
        .addClass('btn-outline-primary js-read-mot-speech')
        .html(`<svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
         <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
         <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
       </svg>
       Read more`);
    });
  });

  //  View candidate profile
  $('body').on('click', '.js-view-candidate-profile', function () {
    $read_description = $(this);
    $job_description = $(this).closest('div').siblings('.js-candidate-profile');

    $job_description.removeClass('d-none').slideDown('slow', function () {
      $read_description.removeClass('btn-outline-primary js-view-candidate-profile')
        .addClass('btn-outline-secondary js-close-candidate-profile ')
        .text('Close');
    });

  });

  $('body').on('click', '.js-close-candidate-profile ', function () {
    $read_description = $(this);
    $job_description = $(this).closest('div').siblings('.js-candidate-profile');

    $job_description.slideUp('slow', function () {
      $read_description.removeClass('btn-outline-secondary js-close-candidate-profile ')
        .addClass('btn-outline-primary js-view-candidate-profile')
        .html(`<svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
         <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
         <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
       </svg>
       Read more`);
    });
  });

  // Bootstrap 5 tooltip FYI-> data-bs-animation="false" will prevent from dissapering the tooltip after multiple hovers
  $('body').tooltip({
    boundary: 'window',
    selector: '[data-bs-toggle="tooltip"]'
  });

  //  Approved candidates company dashboard
  $('#approved_candidates').on('click', function () {
    $('#candidates_container').fadeIn('fast', function () {
      $('#candidates_container').removeClass('d-none');
    });
  });

  $('.js-close-approved-candidates').on('click', function () {
    $('#candidates_container').fadeOut('slow');
  });
})