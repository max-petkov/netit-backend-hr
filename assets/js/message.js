$(function () {

  // Sending message from HR to candidate
  $('body').on('click', '.js-send-message-job-seeker', function () {
    let $btn = $(this);
    let $send_btns = $('.js-send-message-job-seeker');
    let $msg_box = $(this).closest('.js-job-seeker-toogle-btns').siblings('.js-message-job-seeker-box');
    let $form = $msg_box.children('.card-body').children('form');

    $send_btns.addClass('disabled');
    $btn.addClass('disabled').text('Waiting...');
    $msg_box.removeClass('d-none').slideDown('slow');

    $msg_box.on('click', '.btn-close', function () {
      $msg_box.slideUp('slow', function () {
        $send_btns.removeClass('disabled');
        $btn.removeClass('disabled').html(`<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1 bi bi-reply" viewBox="0 0 16 16">
        <path d="M6.598 5.013a.144.144 0 0 1 .202.134V6.3a.5.5 0 0 0 .5.5c.667 0 2.013.005 3.3.822.984.624 1.99 1.76 2.595 3.876-1.02-.983-2.185-1.516-3.205-1.799a8.74 8.74 0 0 0-1.921-.306 7.404 7.404 0 0 0-.798.008h-.013l-.005.001h-.001L7.3 9.9l-.05-.498a.5.5 0 0 0-.45.498v1.153c0 .108-.11.176-.202.134L2.614 8.254a.503.503 0 0 0-.042-.028.147.147 0 0 1 0-.252.499.499 0 0 0 .042-.028l3.984-2.933zM7.8 10.386c.068 0 .143.003.223.006.434.02 1.034.086 1.7.271 1.326.368 2.896 1.202 3.94 3.08a.5.5 0 0 0 .933-.305c-.464-3.71-1.886-5.662-3.46-6.66-1.245-.79-2.527-.942-3.336-.971v-.66a1.144 1.144 0 0 0-1.767-.96l-3.994 2.94a1.147 1.147 0 0 0 0 1.946l3.994 2.94a1.144 1.144 0 0 0 1.767-.96v-.667z" />
        </svg>
        Send Message`);
        $msg_box.addClass('d-none');
      });
    });

    $form.on('submit', function (e) {
      e.preventDefault();
      let $scs_msg = $(this).children('.js-scs-msg');
      let $subject = $(this).children('.form-group').children('input[name="subject"]');
      let $msg = $(this).children('.form-group').children('textarea[name="msg"]');
      let $proceed = true;
      let $form_data = $(this).serializeArray();

      $form_data.push({
        name: 'hr_to_employee',
        value: null
      });

      if (empty($subject)) {
        invalid_response($subject, 'Field can\'t be empty!');
        $proceed = false;
      } else {
        if (string_length($subject, 4, 254)) {
          invalid_response($subject, 'Field must be more than 3 and less than 255 symbols!');
          $proceed = false;
        } else {
          valid_response($subject);
        }
      }

      if (empty($msg)) {
        invalid_response($msg, 'Field can\'t be empty!');
        $proceed = false;
      } else {
        if (string_length($msg, 4, 999)) {
          invalid_response($msg, 'Field must be more than 3 and less than 1000 symbols!');
          $proceed = false;
        } else {
          valid_response($msg);
        }
      }

      if ($proceed) {
        $.ajax({
          url: 'src/message-controller.php',
          method: 'post',
          data: $form_data,
          success: function () {
            success_send_msg($scs_msg, $msg_box, $btn, $send_btns, $('#sent_ul').load('hr-dashboard.php .js-sent-li'));
          }
        });
      }
    });
  });

  // Sending msg from company to HR
  $('#msg_from_company_to_hr').on('submit', function (e) {
    e.preventDefault();
    let $scs_msg = $(this).children('.js-scs-msg');
    let $msg_box = $(this).closest('#send_msg_hr_box');
    let $subject = $(this).children('.form-group').children('input[name="subject"]');
    let $msg = $(this).children('.form-group').children('textarea[name="msg"]');
    let $proceed = true;
    let $form_data = $(this).serializeArray();

    $form_data.push({
      name: 'company_to_hr',
      value: null
    });

    if (empty($subject)) {
      invalid_response($subject, 'Field can\'t be empty!');
      $proceed = false;
    } else {
      if (string_length($subject, 4, 254)) {
        invalid_response($subject, 'Field must be more than 3 and less than 255 symbols!');
        $proceed = false;
      } else {
        valid_response($subject);
      }
    }

    if (empty($msg)) {
      invalid_response($msg, 'Field can\'t be empty!');
      $proceed = false;
    } else {
      if (string_length($msg, 4, 999)) {
        invalid_response($msg, 'Field must be more than 3 and less than 1000 symbols!');
        $proceed = false;
      } else {
        valid_response($msg);
      }
    }

    if ($proceed) {
      $.ajax({
        url: 'src/message-controller.php',
        method: 'post',
        data: $form_data,
        success: function () {
          nav_msg_scs($msg_box, $scs_msg, $('#sent_ul').load('company-dashboard.php .js-sent-li'));
        }
      });
    }
  });

  // Sending msg from HR to company
  $('#msg_from_hr_to_company').on('submit', function (e) {
    e.preventDefault();
    let $scs_msg = $(this).children('.js-scs-msg');
    let $msg_box = $(this).closest('#send_msg_company_box');
    let $subject = $(this).children('.form-group').children('input[name="subject"]');
    let $msg = $(this).children('.form-group').children('textarea[name="msg"]');
    let $proceed = true;
    let $form_data = $(this).serializeArray();

    $form_data.push({
      name: 'hr_to_company',
      value: null
    });

    if (empty($subject)) {
      invalid_response($subject, 'Field can\'t be empty!');
      $proceed = false;
    } else {
      if (string_length($subject, 4, 254)) {
        invalid_response($subject, 'Field must be more than 3 and less than 255 symbols!');
        $proceed = false;
      } else {
        valid_response($subject);
      }
    }

    if (empty($msg)) {
      invalid_response($msg, 'Field can\'t be empty!');
      $proceed = false;
    } else {
      if (string_length($msg, 4, 999)) {
        invalid_response($msg, 'Field must be more than 3 and less than 1000 symbols!');
        $proceed = false;
      } else {
        valid_response($msg);
      }
    }

    if ($proceed) {
      $.ajax({
        url: 'src/message-controller.php',
        method: 'post',
        data: $form_data,
        success: function () {
          nav_msg_scs($msg_box, $scs_msg, $('#sent_ul').load('hr-dashboard.php .js-sent-li'));
        }
      });
    }
  });

  // Reply msg from candidate to hr
  $('body').on('click', '.js-reply-hr', function () {
    let $btn = $(this);
    let $reply_btns = $('.js-reply-hr');
    let $msg_box = $(this).siblings('.js-message-job-seeker-box');
    let $form = $msg_box.children('.card-body').children('form');

    $reply_btns.addClass('disabled');
    $btn.addClass('disabled').text('Waiting...');
    $msg_box.removeClass('d-none').slideDown('slow');

    $msg_box.on('click', '.js-close-reply', function () {
      $msg_box.slideUp('slow', function () {
        $reply_btns.removeClass('disabled');
        $btn.removeClass('disabled').html(`Reply<svg class="ms-1" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 16.987 16.557">
        <g id="send" transform="translate(0 -6.196)">
          <g id="Group_216" data-name="Group 216" transform="translate(0 6.197)">
            <path id="Path_22" data-name="Path 22" d="M16.809,13.7a1.78,1.78,0,0,0-.826-.826L2.556,6.375A1.78,1.78,0,0,0,.128,8.638l2.335,5.836L.128,20.311a1.78,1.78,0,0,0,2.428,2.264l13.427-6.5A1.78,1.78,0,0,0,16.809,13.7ZM2.039,21.505a.593.593,0,0,1-.809-.755L3.5,15.067H15.344ZM3.5,13.881,1.23,8.2a.593.593,0,0,1,.809-.753l13.305,6.436H3.5Z" transform="translate(0 -6.197)" fill="#fff" />
          </g>
        </g>
      </svg>`);
        $msg_box.addClass('d-none');
      });
    });

    $form.on('submit', function (e) {
      e.preventDefault();
      let $proceed = true;
      let $scs_msg = $(this).children('.js-scs-msg');
      let $subject = $(this).children('.form-group').children('input[name="subject"]');
      let $msg = $(this).children('.form-group').children('textarea[name="msg"]');
      let $form_data = $(this).serializeArray();

      $form_data.push({
        name: 'employee_to_hr',
        value: null
      });

      if (empty($subject)) {
        invalid_response($subject, 'Field can\'t be empty!');
        $proceed = false;
      } else {
        if (string_length($subject, 4, 254)) {
          invalid_response($subject, 'Field must be more than 3 and less than 255 symbols!');
          $proceed = false;
        } else {
          valid_response($subject);
        }
      }

      if (empty($msg)) {
        invalid_response($msg, 'Field can\'t be empty!');
        $proceed = false;
      } else {
        if (string_length($msg, 4, 999)) {
          invalid_response($msg, 'Field must be more than 3 and less than 1000 symbols!');
          $proceed = false;
        } else {
          valid_response($msg);
        }
      }

      if ($proceed) {
        $.ajax({
          url: 'src/message-controller.php',
          method: 'post',
          data: $form_data,
          success: function () {
            success_reply_msg($scs_msg, $msg_box, $btn, $reply_btns, $('#sent_ul').load('employee-dashboard.php .js-sent-li'));
          }
        });
      }
    });
  });

  // Reply msg from HR to candidate
  $('body').on('click', '.js-reply-job-seeker', function () {
    let $btn = $(this);
    let $reply_btns = $('.js-reply-job-seeker');
    let $msg_box = $(this).siblings('.js-message-job-seeker-box');
    let $form = $msg_box.children('.card-body').children('form');

    $reply_btns.addClass('disabled');
    $btn.addClass('disabled').text('Waiting...');
    $msg_box.removeClass('d-none').slideDown('slow');

    $msg_box.on('click', '.js-close-reply', function () {
      $msg_box.slideUp('slow', function () {
        $reply_btns.removeClass('disabled');
        $btn.removeClass('disabled').html(`Reply<svg class="ms-1" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 16.987 16.557">
        <g id="send" transform="translate(0 -6.196)">
          <g id="Group_216" data-name="Group 216" transform="translate(0 6.197)">
            <path id="Path_22" data-name="Path 22" d="M16.809,13.7a1.78,1.78,0,0,0-.826-.826L2.556,6.375A1.78,1.78,0,0,0,.128,8.638l2.335,5.836L.128,20.311a1.78,1.78,0,0,0,2.428,2.264l13.427-6.5A1.78,1.78,0,0,0,16.809,13.7ZM2.039,21.505a.593.593,0,0,1-.809-.755L3.5,15.067H15.344ZM3.5,13.881,1.23,8.2a.593.593,0,0,1,.809-.753l13.305,6.436H3.5Z" transform="translate(0 -6.197)" fill="#fff" />
          </g>
        </g>
      </svg>`);
        $msg_box.addClass('d-none');
      });
    });

    $form.on('submit', function (e) {
      e.preventDefault();
      let $proceed = true;
      let $scs_msg = $(this).children('.js-scs-msg');
      let $subject = $(this).children('.form-group').children('input[name="subject"]');
      let $msg = $(this).children('.form-group').children('textarea[name="msg"]');
      let $form_data = $(this).serializeArray();

      $form_data.push({
        name: 'hr_to_employee',
        value: null
      });

      if (empty($subject)) {
        invalid_response($subject, 'Field can\'t be empty!');
        $proceed = false;
      } else {
        if (string_length($subject, 4, 254)) {
          invalid_response($subject, 'Field must be more than 3 and less than 255 symbols!');
          $proceed = false;
        } else {
          valid_response($subject);
        }
      }

      if (empty($msg)) {
        invalid_response($msg, 'Field can\'t be empty!');
        $proceed = false;
      } else {
        if (string_length($msg, 4, 999)) {
          invalid_response($msg, 'Field must be more than 3 and less than 1000 symbols!');
          $proceed = false;
        } else {
          valid_response($msg);
        }
      }

      if ($proceed) {
        $.ajax({
          url: 'src/message-controller.php',
          method: 'post',
          data: $form_data,
          success: function () {
            success_reply_msg($scs_msg, $msg_box, $btn, $reply_btns, $('#sent_ul').load('hr-dashboard.php .js-sent-li'));
          }
        });
      }
    });
  });

  // Reply msg from HR to company
  $('body').on('click', '.js-reply-company', function () {
    let $btn = $(this);
    let $reply_btns = $('.js-reply-company');
    let $msg_box = $(this).siblings('.js-message-job-seeker-box');
    let $form = $msg_box.children('.card-body').children('form');

    $reply_btns.addClass('disabled');
    $btn.addClass('disabled').text('Waiting...');
    $msg_box.removeClass('d-none').slideDown('slow');

    $msg_box.on('click', '.js-close-reply', function () {
      $msg_box.slideUp('slow', function () {
        $reply_btns.removeClass('disabled');
        $btn.removeClass('disabled').html(`Reply<svg class="ms-1" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 16.987 16.557">
        <g id="send" transform="translate(0 -6.196)">
          <g id="Group_216" data-name="Group 216" transform="translate(0 6.197)">
            <path id="Path_22" data-name="Path 22" d="M16.809,13.7a1.78,1.78,0,0,0-.826-.826L2.556,6.375A1.78,1.78,0,0,0,.128,8.638l2.335,5.836L.128,20.311a1.78,1.78,0,0,0,2.428,2.264l13.427-6.5A1.78,1.78,0,0,0,16.809,13.7ZM2.039,21.505a.593.593,0,0,1-.809-.755L3.5,15.067H15.344ZM3.5,13.881,1.23,8.2a.593.593,0,0,1,.809-.753l13.305,6.436H3.5Z" transform="translate(0 -6.197)" fill="#fff" />
          </g>
        </g>
      </svg>`);
        $msg_box.addClass('d-none');
      });
    });

    $form.on('submit', function (e) {
      e.preventDefault();
      let $proceed = true;
      let $scs_msg = $(this).children('.js-scs-msg');
      let $subject = $(this).children('.form-group').children('input[name="subject"]');
      let $msg = $(this).children('.form-group').children('textarea[name="msg"]');
      let $form_data = $(this).serializeArray();

      $form_data.push({
        name: 'hr_to_company',
        value: null
      });

      if (empty($subject)) {
        invalid_response($subject, 'Field can\'t be empty!');
        $proceed = false;
      } else {
        if (string_length($subject, 4, 254)) {
          invalid_response($subject, 'Field must be more than 3 and less than 255 symbols!');
          $proceed = false;
        } else {
          valid_response($subject);
        }
      }

      if (empty($msg)) {
        invalid_response($msg, 'Field can\'t be empty!');
        $proceed = false;
      } else {
        if (string_length($msg, 4, 999)) {
          invalid_response($msg, 'Field must be more than 3 and less than 1000 symbols!');
          $proceed = false;
        } else {
          valid_response($msg);
        }
      }

      if ($proceed) {
        $.ajax({
          url: 'src/message-controller.php',
          method: 'post',
          data: $form_data,
          success: function () {
            success_reply_msg($scs_msg, $msg_box, $btn, $reply_btns, $('#sent_ul').load('hr-dashboard.php .js-sent-li'));
          }
        });
      }
    });
  });

  // Reply msg from company to HR
  $('body').on('click', '.js-reply-from-company-to-hr', function () {
    let $btn = $(this);
    let $reply_btns = $('.js-reply-from-company-to-hr');
    let $msg_box = $(this).siblings('.js-message-job-seeker-box');
    let $form = $msg_box.children('.card-body').children('form');

    $reply_btns.addClass('disabled');
    $btn.addClass('disabled').text('Waiting...');
    $msg_box.removeClass('d-none').slideDown('slow');

    $msg_box.on('click', '.js-close-reply', function () {
      $msg_box.slideUp('slow', function () {
        $reply_btns.removeClass('disabled');
        $btn.removeClass('disabled').html(`Reply<svg class="ms-1" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 16.987 16.557">
        <g id="send" transform="translate(0 -6.196)">
          <g id="Group_216" data-name="Group 216" transform="translate(0 6.197)">
            <path id="Path_22" data-name="Path 22" d="M16.809,13.7a1.78,1.78,0,0,0-.826-.826L2.556,6.375A1.78,1.78,0,0,0,.128,8.638l2.335,5.836L.128,20.311a1.78,1.78,0,0,0,2.428,2.264l13.427-6.5A1.78,1.78,0,0,0,16.809,13.7ZM2.039,21.505a.593.593,0,0,1-.809-.755L3.5,15.067H15.344ZM3.5,13.881,1.23,8.2a.593.593,0,0,1,.809-.753l13.305,6.436H3.5Z" transform="translate(0 -6.197)" fill="#fff" />
          </g>
        </g>
      </svg>`);
        $msg_box.addClass('d-none');
      });
    });

    $form.on('submit', function (e) {
      e.preventDefault();
      let $proceed = true;
      let $scs_msg = $(this).children('.js-scs-msg');
      let $subject = $(this).children('.form-group').children('input[name="subject"]');
      let $msg = $(this).children('.form-group').children('textarea[name="msg"]');
      let $form_data = $(this).serializeArray();

      $form_data.push({
        name: 'company_to_hr',
        value: null
      });

      if (empty($subject)) {
        invalid_response($subject, 'Field can\'t be empty!');
        $proceed = false;
      } else {
        if (string_length($subject, 4, 254)) {
          invalid_response($subject, 'Field must be more than 3 and less than 255 symbols!');
          $proceed = false;
        } else {
          valid_response($subject);
        }
      }

      if (empty($msg)) {
        invalid_response($msg, 'Field can\'t be empty!');
        $proceed = false;
      } else {
        if (string_length($msg, 4, 999)) {
          invalid_response($msg, 'Field must be more than 3 and less than 1000 symbols!');
          $proceed = false;
        } else {
          valid_response($msg);
        }
      }

      if ($proceed) {
        $.ajax({
          url: 'src/message-controller.php',
          method: 'post',
          data: $form_data,
          success: function () {
            success_reply_msg($scs_msg, $msg_box, $btn, $reply_btns, $('#sent_ul').load('company-dashboard.php .js-sent-li'));
          }
        });
      }
    });
  });
})