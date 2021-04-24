$(function () {

  // Sending message from HR to candidate
  $('body').on('click', '.js-send-message-job-seeker', function () {
    $btn = $(this);
    $send_btns = $('.js-send-message-job-seeker');
    $msg_box = $(this).closest('.js-job-seeker-toogle-btns').siblings('.js-message-job-seeker-box');
    $form = $msg_box.children('.card-body').children('form');

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

  // Send msg from company to HR
  $('body').on('click', '.js-send-msg-company-to-hr', function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    $submit_btn = $(this);
    $scs_msg = $(this).closest('form').children('.js-scs-msg-send');
    $from = $(this).prev().prev().prev().prev().children('input[type="hidden"]');
    $to = $(this).prev().prev().prev().children('input[type="hidden"]');
    $subject = $(this).prev().prev().children('input[name="message_subject"]');
    $subject_response_txt = $(this).prev().prev().children('.js-subject-response-text');
    $message = $(this).prev().children('textarea[name="message"]');
    $message_response_txt = $(this).prev().children('.js-message-response-text');
    $proceed = true;


    if ($subject.val().trim().length < 24 || $subject.val().trim().length > 254) {
      $subject_response_txt.show('fast');
      $subject.addClass('is-invalid');
      $subject_response_txt.addClass('text-danger')
        .html('Field must be more than 24 and less than 255 symbols!');
      if ($subject_response_txt.hasClass('text-success') && $subject.hasClass('is-valid')) {
        $subject.removeClass('is-valid').addClass('is-invalid');
        $subject_response_txt.removeClass('text-success')
          .addClass('text-danger')
          .html('Field must be more than 24 and less than 255 symbols!');
      }
      $proceed = false;
    } else {
      $subject_response_txt.show('fast');
      $subject.addClass('is-valid');
      $subject_response_txt.addClass('text-success')
        .html('OK!');
      if ($subject_response_txt.hasClass('text-danger') && $subject.hasClass('is-invalid')) {
        $subject.removeClass('is-invalid').addClass('is-valid');
        $subject_response_txt.removeClass('text-danger')
          .addClass('text-success')
          .html('OK!');
      }
      setTimeout(function () {
        $subject_response_txt.hide('fast');
      }, 5000)
    }

    if ($message.val().trim().length < 24 || $message.val().trim().length > 999) {
      $message_response_txt.show('fast');
      $message.addClass('is-invalid');
      $message_response_txt.addClass('text-danger')
        .html('Field must be more than 24 and less than 1000 symbols!');
      if ($message_response_txt.hasClass('text-success') && $message.hasClass('is-valid')) {
        $message.removeClass('is-valid').addClass('is-invalid');
        $message_response_txt.removeClass('text-success')
          .addClass('text-danger')
          .html('Field must be more than 24 and less than 1000 symbols!');
      }
      $proceed = false;
    } else {
      $message_response_txt.show('fast');
      $message.addClass('is-valid');
      $message_response_txt.addClass('text-success')
        .html('OK!');
      if ($message_response_txt.hasClass('text-danger') && $message.hasClass('is-invalid')) {
        $message.removeClass('is-invalid').addClass('is-valid');
        $message_response_txt.removeClass('text-danger')
          .addClass('text-success')
          .html('OK!');
      }
      setTimeout(function () {
        $message_response_txt.hide('fast');
      }, 5000)
    }

    if ($proceed) {
      $.ajax({
        url: 'src/message-controller.php',
        method: 'post',
        data: {
          from: $from.val(),
          to: $to.val(),
          subject: $subject.val(),
          msg: $message.val(),
          company_to_hr: null
        },
        success: function () {
          $scs_msg.slideDown('slow').addClass('alert alert-success').text('Message send successful!');
          setTimeout(function () {
            $scs_msg.slideUp('slow');
            $('.chevron-expand-text').slideUp();
          }, 1500);
          $('#sent_ul').load('company-dashboard.php .js-sent-li');
        }
      });
    }
  });

  // Send msg from HR to company
  $('body').on('click', '.js-send-msg-hr-to-company', function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();
    $submit_btn = $(this);
    $scs_msg = $(this).closest('form').children('.js-scs-msg-send');
    $from = $(this).prev().prev().prev().prev().children('input[type="hidden"]');
    $to = $(this).prev().prev().prev().children('input[type="hidden"]');
    $subject = $(this).prev().prev().children('input[name="message_subject"]');
    $subject_response_txt = $(this).prev().prev().children('.js-subject-response-text');
    $message = $(this).prev().children('textarea[name="message"]');
    $message_response_txt = $(this).prev().children('.js-message-response-text');
    $proceed = true;


    if ($subject.val().trim().length < 24 || $subject.val().trim().length > 254) {
      $subject_response_txt.show('fast');
      $subject.addClass('is-invalid');
      $subject_response_txt.addClass('text-danger')
        .html('Field must be more than 24 and less than 255 symbols!');
      if ($subject_response_txt.hasClass('text-success') && $subject.hasClass('is-valid')) {
        $subject.removeClass('is-valid').addClass('is-invalid');
        $subject_response_txt.removeClass('text-success')
          .addClass('text-danger')
          .html('Field must be more than 24 and less than 255 symbols!');
      }
      $proceed = false;
    } else {
      $subject_response_txt.show('fast');
      $subject.addClass('is-valid');
      $subject_response_txt.addClass('text-success')
        .html('OK!');
      if ($subject_response_txt.hasClass('text-danger') && $subject.hasClass('is-invalid')) {
        $subject.removeClass('is-invalid').addClass('is-valid');
        $subject_response_txt.removeClass('text-danger')
          .addClass('text-success')
          .html('OK!');
      }
      setTimeout(function () {
        $subject_response_txt.hide('fast');
      }, 5000)
    }

    if ($message.val().trim().length < 24 || $message.val().trim().length > 999) {
      $message_response_txt.show('fast');
      $message.addClass('is-invalid');
      $message_response_txt.addClass('text-danger')
        .html('Field must be more than 24 and less than 1000 symbols!');
      if ($message_response_txt.hasClass('text-success') && $message.hasClass('is-valid')) {
        $message.removeClass('is-valid').addClass('is-invalid');
        $message_response_txt.removeClass('text-success')
          .addClass('text-danger')
          .html('Field must be more than 24 and less than 1000 symbols!');
      }
      $proceed = false;
    } else {
      $message_response_txt.show('fast');
      $message.addClass('is-valid');
      $message_response_txt.addClass('text-success')
        .html('OK!');
      if ($message_response_txt.hasClass('text-danger') && $message.hasClass('is-invalid')) {
        $message.removeClass('is-invalid').addClass('is-valid');
        $message_response_txt.removeClass('text-danger')
          .addClass('text-success')
          .html('OK!');
      }
      setTimeout(function () {
        $message_response_txt.hide('fast');
      }, 5000)
    }

    if ($proceed) {
      $.ajax({
        url: 'src/message-controller.php',
        method: 'post',
        data: {
          from: $from.val(),
          to: $to.val(),
          subject: $subject.val(),
          msg: $message.val(),
          hr_to_company: null
        },
        success: function () {
          $scs_msg.slideDown('slow').addClass('alert alert-success').text('Message send successful!');
          setTimeout(function () {
            $scs_msg.slideUp('slow');
            $('.chevron-expand-text').slideUp();
          }, 1500);
          $('#sent_ul').load('hr-dashboard.php .js-sent-li');
        }
      });
    }
  });

  // Reply msg from employee to hr
  $('body').on('click', '.js-reply-hr', function () {
    $open_btn = $(this);
    $open_msg_box = $(this).siblings('.js-message-job-seeker-box');

    $('.js-reply-hr').addClass('disabled');
    $open_btn.addClass('disabled').text('Waiting...');

    $open_msg_box.removeClass('d-none').slideDown('slow');
    $open_msg_box.on('click', '.js-close-reply', function () {
      $open_msg_box.slideUp('slow', function () {
        $('.js-reply-hr').removeClass('disabled');
        $open_btn.removeClass('disabled').html(`Reply<svg class="ms-1" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 16.987 16.557">
        <g id="send" transform="translate(0 -6.196)">
          <g id="Group_216" data-name="Group 216" transform="translate(0 6.197)">
            <path id="Path_22" data-name="Path 22" d="M16.809,13.7a1.78,1.78,0,0,0-.826-.826L2.556,6.375A1.78,1.78,0,0,0,.128,8.638l2.335,5.836L.128,20.311a1.78,1.78,0,0,0,2.428,2.264l13.427-6.5A1.78,1.78,0,0,0,16.809,13.7ZM2.039,21.505a.593.593,0,0,1-.809-.755L3.5,15.067H15.344ZM3.5,13.881,1.23,8.2a.593.593,0,0,1,.809-.753l13.305,6.436H3.5Z" transform="translate(0 -6.197)" fill="#fff" />
          </g>
        </g>
      </svg>`);
        $open_msg_box.addClass('d-none');
      });
    });

    // After second message send ajax multiplies by 2 and so on... so to fix this stopImmediatePropagation()
    $('body').on('click', '.js-submit-sending-msg-job-seeker', function (e) {
      e.preventDefault();
      e.stopImmediatePropagation();
      $submit_btn = $(this);
      $scs_msg = $(this).closest('form').children('.js-scs-msg-send');
      $from = $(this).prev().prev().prev().prev().children('input[type="hidden"]');
      $to = $(this).prev().prev().prev().children('input[type="hidden"]');
      $subject = $(this).prev().prev().children('input[name="message_subject"]');
      $subject_response_txt = $(this).prev().prev().children('.js-subject-response-text');
      $message = $(this).prev().children('textarea[name="message"]');
      $message_response_txt = $(this).prev().children('.js-message-response-text');
      $proceed = true;


      if ($subject.val().trim().length < 24 || $subject.val().trim().length > 254) {
        $subject_response_txt.show('fast');
        $subject.addClass('is-invalid');
        $subject_response_txt.addClass('text-danger')
          .html('Field must be more than 24 and less than 255 symbols!');
        if ($subject_response_txt.hasClass('text-success') && $subject.hasClass('is-valid')) {
          $subject.removeClass('is-valid').addClass('is-invalid');
          $subject_response_txt.removeClass('text-success')
            .addClass('text-danger')
            .html('Field must be more than 24 and less than 255 symbols!');
        }
        $proceed = false;
      } else {
        $subject_response_txt.show('fast');
        $subject.addClass('is-valid');
        $subject_response_txt.addClass('text-success')
          .html('OK!');
        if ($subject_response_txt.hasClass('text-danger') && $subject.hasClass('is-invalid')) {
          $subject.removeClass('is-invalid').addClass('is-valid');
          $subject_response_txt.removeClass('text-danger')
            .addClass('text-success')
            .html('OK!');
        }
        setTimeout(function () {
          $subject_response_txt.hide('fast');
        }, 5000)
      }

      if ($message.val().trim().length < 24 || $message.val().trim().length > 999) {
        $message_response_txt.show('fast');
        $message.addClass('is-invalid');
        $message_response_txt.addClass('text-danger')
          .html('Field must be more than 24 and less than 1000 symbols!');
        if ($message_response_txt.hasClass('text-success') && $message.hasClass('is-valid')) {
          $message.removeClass('is-valid').addClass('is-invalid');
          $message_response_txt.removeClass('text-success')
            .addClass('text-danger')
            .html('Field must be more than 24 and less than 1000 symbols!');
        }
        $proceed = false;
      } else {
        $message_response_txt.show('fast');
        $message.addClass('is-valid');
        $message_response_txt.addClass('text-success')
          .html('OK!');
        if ($message_response_txt.hasClass('text-danger') && $message.hasClass('is-invalid')) {
          $message.removeClass('is-invalid').addClass('is-valid');
          $message_response_txt.removeClass('text-danger')
            .addClass('text-success')
            .html('OK!');
        }
        setTimeout(function () {
          $message_response_txt.hide('fast');
        }, 5000)
      }

      if ($proceed) {
        $.ajax({
          url: 'src/message-controller.php',
          method: 'post',
          data: {
            from: $from.val(),
            to: $to.val(),
            subject: $subject.val(),
            msg: $message.val(),
            employee_to_hr: null
          },
          success: function () {
            $scs_msg.slideDown('slow').addClass('alert alert-success').text('Message send successful!');
            setTimeout(function () {
              $scs_msg.slideUp('slow', function () {
                $open_msg_box.slideUp('slow', function () {
                  $('.js-reply-hr').removeClass('disabled');
                  $open_btn.removeClass('disabled').html(`Reply<svg class="ms-1" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 16.987 16.557">
                  <g id="send" transform="translate(0 -6.196)">
                    <g id="Group_216" data-name="Group 216" transform="translate(0 6.197)">
                      <path id="Path_22" data-name="Path 22" d="M16.809,13.7a1.78,1.78,0,0,0-.826-.826L2.556,6.375A1.78,1.78,0,0,0,.128,8.638l2.335,5.836L.128,20.311a1.78,1.78,0,0,0,2.428,2.264l13.427-6.5A1.78,1.78,0,0,0,16.809,13.7ZM2.039,21.505a.593.593,0,0,1-.809-.755L3.5,15.067H15.344ZM3.5,13.881,1.23,8.2a.593.593,0,0,1,.809-.753l13.305,6.436H3.5Z" transform="translate(0 -6.197)" fill="#fff" />
                    </g>
                  </g>
                </svg>`);
                  $open_msg_box.addClass('d-none');
                  $('.chevron-expand-text').slideUp();
                });
              });
            }, 2000);
            $('#sent_ul').load('employee-dashboard.php .js-sent-li');
          }
        });
      }
    });
  });

  // Reply msg from HR to candidate
  $('body').on('click', '.js-reply-job-seeker', function () {
    $open_btn = $(this);
    $open_msg_box = $(this).siblings('.js-message-job-seeker-box');

    $('.js-reply-job-seeker').addClass('disabled');
    $('.js-reply-company').addClass('disabled');
    $open_btn.addClass('disabled').text('Waiting...');

    $open_msg_box.removeClass('d-none').slideDown('slow');
    $open_msg_box.on('click', '.js-close-reply', function () {
      $open_msg_box.slideUp('slow', function () {
        $('.js-reply-job-seeker').removeClass('disabled');
        $('.js-reply-company').removeClass('disabled');
        $open_btn.removeClass('disabled').html(`Reply<svg class="ms-1" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 16.987 16.557">
        <g id="send" transform="translate(0 -6.196)">
          <g id="Group_216" data-name="Group 216" transform="translate(0 6.197)">
            <path id="Path_22" data-name="Path 22" d="M16.809,13.7a1.78,1.78,0,0,0-.826-.826L2.556,6.375A1.78,1.78,0,0,0,.128,8.638l2.335,5.836L.128,20.311a1.78,1.78,0,0,0,2.428,2.264l13.427-6.5A1.78,1.78,0,0,0,16.809,13.7ZM2.039,21.505a.593.593,0,0,1-.809-.755L3.5,15.067H15.344ZM3.5,13.881,1.23,8.2a.593.593,0,0,1,.809-.753l13.305,6.436H3.5Z" transform="translate(0 -6.197)" fill="#fff" />
          </g>
        </g>
      </svg>`);
        $open_msg_box.addClass('d-none');
      });
    });

    // After second message send ajax multiplies by 2 and so on... so to fix this stopImmediatePropagation()
    $('body').on('click', '.js-submit-sending-msg-job-seeker', function (e) {
      e.preventDefault();
      e.stopImmediatePropagation();
      $submit_btn = $(this);
      $scs_msg = $(this).closest('form').children('.js-scs-msg-send');
      $from = $(this).prev().prev().prev().prev().children('input[type="hidden"]');
      $to = $(this).prev().prev().prev().children('input[type="hidden"]');
      $subject = $(this).prev().prev().children('input[name="message_subject"]');
      $subject_response_txt = $(this).prev().prev().children('.js-subject-response-text');
      $message = $(this).prev().children('textarea[name="message"]');
      $message_response_txt = $(this).prev().children('.js-message-response-text');
      $proceed = true;


      if ($subject.val().trim().length < 24 || $subject.val().trim().length > 254) {
        $subject_response_txt.show('fast');
        $subject.addClass('is-invalid');
        $subject_response_txt.addClass('text-danger')
          .html('Field must be more than 24 and less than 255 symbols!');
        if ($subject_response_txt.hasClass('text-success') && $subject.hasClass('is-valid')) {
          $subject.removeClass('is-valid').addClass('is-invalid');
          $subject_response_txt.removeClass('text-success')
            .addClass('text-danger')
            .html('Field must be more than 24 and less than 255 symbols!');
        }
        $proceed = false;
      } else {
        $subject_response_txt.show('fast');
        $subject.addClass('is-valid');
        $subject_response_txt.addClass('text-success')
          .html('OK!');
        if ($subject_response_txt.hasClass('text-danger') && $subject.hasClass('is-invalid')) {
          $subject.removeClass('is-invalid').addClass('is-valid');
          $subject_response_txt.removeClass('text-danger')
            .addClass('text-success')
            .html('OK!');
        }
        setTimeout(function () {
          $subject_response_txt.hide('fast');
        }, 5000)
      }

      if ($message.val().trim().length < 24 || $message.val().trim().length > 999) {
        $message_response_txt.show('fast');
        $message.addClass('is-invalid');
        $message_response_txt.addClass('text-danger')
          .html('Field must be more than 24 and less than 1000 symbols!');
        if ($message_response_txt.hasClass('text-success') && $message.hasClass('is-valid')) {
          $message.removeClass('is-valid').addClass('is-invalid');
          $message_response_txt.removeClass('text-success')
            .addClass('text-danger')
            .html('Field must be more than 24 and less than 1000 symbols!');
        }
        $proceed = false;
      } else {
        $message_response_txt.show('fast');
        $message.addClass('is-valid');
        $message_response_txt.addClass('text-success')
          .html('OK!');
        if ($message_response_txt.hasClass('text-danger') && $message.hasClass('is-invalid')) {
          $message.removeClass('is-invalid').addClass('is-valid');
          $message_response_txt.removeClass('text-danger')
            .addClass('text-success')
            .html('OK!');
        }
        setTimeout(function () {
          $message_response_txt.hide('fast');
        }, 5000)
      }

      if ($proceed) {
        $.ajax({
          url: 'src/message-controller.php',
          method: 'post',
          data: {
            from: $from.val(),
            to: $to.val(),
            subject: $subject.val(),
            msg: $message.val(),
            hr_to_employee: null
          },
          success: function () {
            $scs_msg.slideDown('slow').addClass('alert alert-success').text('Message send successful!');
            setTimeout(function () {
              $scs_msg.slideUp('slow', function () {
                $open_msg_box.slideUp('slow', function () {
                  $('.js-reply-job-seeker').removeClass('disabled');
                  $('.js-reply-job-company').removeClass('disabled');
                  $open_btn.removeClass('disabled').html(`Reply<svg class="ms-1" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 16.987 16.557">
                  <g id="send" transform="translate(0 -6.196)">
                    <g id="Group_216" data-name="Group 216" transform="translate(0 6.197)">
                      <path id="Path_22" data-name="Path 22" d="M16.809,13.7a1.78,1.78,0,0,0-.826-.826L2.556,6.375A1.78,1.78,0,0,0,.128,8.638l2.335,5.836L.128,20.311a1.78,1.78,0,0,0,2.428,2.264l13.427-6.5A1.78,1.78,0,0,0,16.809,13.7ZM2.039,21.505a.593.593,0,0,1-.809-.755L3.5,15.067H15.344ZM3.5,13.881,1.23,8.2a.593.593,0,0,1,.809-.753l13.305,6.436H3.5Z" transform="translate(0 -6.197)" fill="#fff" />
                    </g>
                  </g>
                </svg>`);
                  $open_msg_box.addClass('d-none');
                  $('.chevron-expand-text').slideUp();
                });
              });
            }, 2000);
            $('#sent_ul').load('hr-dashboard.php .js-sent-li');
          }
        });
      }
    });
  });

  // Reply msg from HR to company
  $('body').on('click', '.js-reply-company', function () {
    $open_btn = $(this);
    $open_msg_box = $(this).siblings('.js-message-job-seeker-box');

    $('.js-reply-company').addClass('disabled');
    $('.js-reply-job-seeker').addClass('disabled');
    $open_btn.addClass('disabled').text('Waiting...');

    $open_msg_box.removeClass('d-none').slideDown('slow');
    $open_msg_box.on('click', '.js-close-reply', function () {
      $open_msg_box.slideUp('slow', function () {
        $('.js-reply-company').removeClass('disabled');
        $('.js-reply-job-seeker').removeClass('disabled');
        $open_btn.removeClass('disabled').html(`Reply<svg class="ms-1" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 16.987 16.557">
        <g id="send" transform="translate(0 -6.196)">
          <g id="Group_216" data-name="Group 216" transform="translate(0 6.197)">
            <path id="Path_22" data-name="Path 22" d="M16.809,13.7a1.78,1.78,0,0,0-.826-.826L2.556,6.375A1.78,1.78,0,0,0,.128,8.638l2.335,5.836L.128,20.311a1.78,1.78,0,0,0,2.428,2.264l13.427-6.5A1.78,1.78,0,0,0,16.809,13.7ZM2.039,21.505a.593.593,0,0,1-.809-.755L3.5,15.067H15.344ZM3.5,13.881,1.23,8.2a.593.593,0,0,1,.809-.753l13.305,6.436H3.5Z" transform="translate(0 -6.197)" fill="#fff" />
          </g>
        </g>
      </svg>`);
        $open_msg_box.addClass('d-none');
      });
    });

    // After second message send ajax multiplies by 2 and so on... so to fix this stopImmediatePropagation()
    $('body').on('click', '.js-submit-sending-msg-company', function (e) {
      e.preventDefault();
      e.stopImmediatePropagation();
      $submit_btn = $(this);
      $scs_msg = $(this).closest('form').children('.js-scs-msg-send');
      $from = $(this).prev().prev().prev().prev().children('input[type="hidden"]');
      $to = $(this).prev().prev().prev().children('input[type="hidden"]');
      $subject = $(this).prev().prev().children('input[name="message_subject"]');
      $subject_response_txt = $(this).prev().prev().children('.js-subject-response-text');
      $message = $(this).prev().children('textarea[name="message"]');
      $message_response_txt = $(this).prev().children('.js-message-response-text');
      $proceed = true;


      if ($subject.val().trim().length < 24 || $subject.val().trim().length > 254) {
        $subject_response_txt.show('fast');
        $subject.addClass('is-invalid');
        $subject_response_txt.addClass('text-danger')
          .html('Field must be more than 24 and less than 255 symbols!');
        if ($subject_response_txt.hasClass('text-success') && $subject.hasClass('is-valid')) {
          $subject.removeClass('is-valid').addClass('is-invalid');
          $subject_response_txt.removeClass('text-success')
            .addClass('text-danger')
            .html('Field must be more than 24 and less than 255 symbols!');
        }
        $proceed = false;
      } else {
        $subject_response_txt.show('fast');
        $subject.addClass('is-valid');
        $subject_response_txt.addClass('text-success')
          .html('OK!');
        if ($subject_response_txt.hasClass('text-danger') && $subject.hasClass('is-invalid')) {
          $subject.removeClass('is-invalid').addClass('is-valid');
          $subject_response_txt.removeClass('text-danger')
            .addClass('text-success')
            .html('OK!');
        }
        setTimeout(function () {
          $subject_response_txt.hide('fast');
        }, 5000)
      }

      if ($message.val().trim().length < 24 || $message.val().trim().length > 999) {
        $message_response_txt.show('fast');
        $message.addClass('is-invalid');
        $message_response_txt.addClass('text-danger')
          .html('Field must be more than 24 and less than 1000 symbols!');
        if ($message_response_txt.hasClass('text-success') && $message.hasClass('is-valid')) {
          $message.removeClass('is-valid').addClass('is-invalid');
          $message_response_txt.removeClass('text-success')
            .addClass('text-danger')
            .html('Field must be more than 24 and less than 1000 symbols!');
        }
        $proceed = false;
      } else {
        $message_response_txt.show('fast');
        $message.addClass('is-valid');
        $message_response_txt.addClass('text-success')
          .html('OK!');
        if ($message_response_txt.hasClass('text-danger') && $message.hasClass('is-invalid')) {
          $message.removeClass('is-invalid').addClass('is-valid');
          $message_response_txt.removeClass('text-danger')
            .addClass('text-success')
            .html('OK!');
        }
        setTimeout(function () {
          $message_response_txt.hide('fast');
        }, 5000)
      }

      if ($proceed) {
        $.ajax({
          url: 'src/message-controller.php',
          method: 'post',
          data: {
            from: $from.val(),
            to: $to.val(),
            subject: $subject.val(),
            msg: $message.val(),
            hr_to_company: null
          },
          success: function () {
            $scs_msg.slideDown('slow').addClass('alert alert-success').text('Message send successful!');
            setTimeout(function () {
              $scs_msg.slideUp('slow', function () {
                $open_msg_box.slideUp('slow', function () {
                  $('.js-reply-company').removeClass('disabled');
                  $('.js-reply-job-seeker').removeClass('disabled');
                  $open_btn.removeClass('disabled').html(`Reply<svg class="ms-1" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 16.987 16.557">
                  <g id="send" transform="translate(0 -6.196)">
                    <g id="Group_216" data-name="Group 216" transform="translate(0 6.197)">
                      <path id="Path_22" data-name="Path 22" d="M16.809,13.7a1.78,1.78,0,0,0-.826-.826L2.556,6.375A1.78,1.78,0,0,0,.128,8.638l2.335,5.836L.128,20.311a1.78,1.78,0,0,0,2.428,2.264l13.427-6.5A1.78,1.78,0,0,0,16.809,13.7ZM2.039,21.505a.593.593,0,0,1-.809-.755L3.5,15.067H15.344ZM3.5,13.881,1.23,8.2a.593.593,0,0,1,.809-.753l13.305,6.436H3.5Z" transform="translate(0 -6.197)" fill="#fff" />
                    </g>
                  </g>
                </svg>`);
                  $open_msg_box.addClass('d-none');
                  $('.chevron-expand-text').slideUp();
                });
              });
            }, 2000);
            $('#sent_ul').load('hr-dashboard.php .js-sent-li');
          }
        });
      }
    });
  });

  // Reply message from company to hr
  $('body').on('click', '.js-reply-from-company-to-hr', function () {
    $open_btn = $(this);
    $open_msg_box = $(this).siblings('.js-message-job-seeker-box');

    $('.js-reply-from-company-to-hr').addClass('disabled');
    $open_btn.addClass('disabled').text('Waiting...');

    $open_msg_box.removeClass('d-none').slideDown('slow');
    $open_msg_box.on('click', '.js-close-reply', function () {
      $open_msg_box.slideUp('slow', function () {
        $('.js-reply-from-company-to-hr').removeClass('disabled');
        $open_btn.removeClass('disabled').html(`Reply<svg class="ms-1" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 16.987 16.557">
        <g id="send" transform="translate(0 -6.196)">
          <g id="Group_216" data-name="Group 216" transform="translate(0 6.197)">
            <path id="Path_22" data-name="Path 22" d="M16.809,13.7a1.78,1.78,0,0,0-.826-.826L2.556,6.375A1.78,1.78,0,0,0,.128,8.638l2.335,5.836L.128,20.311a1.78,1.78,0,0,0,2.428,2.264l13.427-6.5A1.78,1.78,0,0,0,16.809,13.7ZM2.039,21.505a.593.593,0,0,1-.809-.755L3.5,15.067H15.344ZM3.5,13.881,1.23,8.2a.593.593,0,0,1,.809-.753l13.305,6.436H3.5Z" transform="translate(0 -6.197)" fill="#fff" />
          </g>
        </g>
      </svg>`);
        $open_msg_box.addClass('d-none');
      });
    });

    // After second message send ajax multiplies by 2 and so on... so to fix this stopImmediatePropagation()
    $('body').on('click', '.js-submit-sending-from-company-to-hr', function (e) {
      e.preventDefault();
      e.stopImmediatePropagation();
      $submit_btn = $(this);
      $scs_msg = $(this).closest('form').children('.js-scs-msg-send');
      $from = $(this).prev().prev().prev().prev().children('input[type="hidden"]');
      $to = $(this).prev().prev().prev().children('input[type="hidden"]');
      $subject = $(this).prev().prev().children('input[name="message_subject"]');
      $subject_response_txt = $(this).prev().prev().children('.js-subject-response-text');
      $message = $(this).prev().children('textarea[name="message"]');
      $message_response_txt = $(this).prev().children('.js-message-response-text');
      $proceed = true;


      if ($subject.val().trim().length < 24 || $subject.val().trim().length > 254) {
        $subject_response_txt.show('fast');
        $subject.addClass('is-invalid');
        $subject_response_txt.addClass('text-danger')
          .html('Field must be more than 24 and less than 255 symbols!');
        if ($subject_response_txt.hasClass('text-success') && $subject.hasClass('is-valid')) {
          $subject.removeClass('is-valid').addClass('is-invalid');
          $subject_response_txt.removeClass('text-success')
            .addClass('text-danger')
            .html('Field must be more than 24 and less than 255 symbols!');
        }
        $proceed = false;
      } else {
        $subject_response_txt.show('fast');
        $subject.addClass('is-valid');
        $subject_response_txt.addClass('text-success')
          .html('OK!');
        if ($subject_response_txt.hasClass('text-danger') && $subject.hasClass('is-invalid')) {
          $subject.removeClass('is-invalid').addClass('is-valid');
          $subject_response_txt.removeClass('text-danger')
            .addClass('text-success')
            .html('OK!');
        }
        setTimeout(function () {
          $subject_response_txt.hide('fast');
        }, 5000)
      }

      if ($message.val().trim().length < 24 || $message.val().trim().length > 999) {
        $message_response_txt.show('fast');
        $message.addClass('is-invalid');
        $message_response_txt.addClass('text-danger')
          .html('Field must be more than 24 and less than 1000 symbols!');
        if ($message_response_txt.hasClass('text-success') && $message.hasClass('is-valid')) {
          $message.removeClass('is-valid').addClass('is-invalid');
          $message_response_txt.removeClass('text-success')
            .addClass('text-danger')
            .html('Field must be more than 24 and less than 1000 symbols!');
        }
        $proceed = false;
      } else {
        $message_response_txt.show('fast');
        $message.addClass('is-valid');
        $message_response_txt.addClass('text-success')
          .html('OK!');
        if ($message_response_txt.hasClass('text-danger') && $message.hasClass('is-invalid')) {
          $message.removeClass('is-invalid').addClass('is-valid');
          $message_response_txt.removeClass('text-danger')
            .addClass('text-success')
            .html('OK!');
        }
        setTimeout(function () {
          $message_response_txt.hide('fast');
        }, 5000)
      }

      if ($proceed) {
        $.ajax({
          url: 'src/message-controller.php',
          method: 'post',
          data: {
            from: $from.val(),
            to: $to.val(),
            subject: $subject.val(),
            msg: $message.val(),
            company_to_hr: null
          },
          success: function () {
            $scs_msg.slideDown('slow').addClass('alert alert-success').text('Message send successful!');
            setTimeout(function () {
              $scs_msg.slideUp('slow', function () {
                $open_msg_box.slideUp('slow', function () {
                  $('.js-reply-from-company-to-hr').removeClass('disabled');
                  $open_btn.removeClass('disabled').html(`Reply<svg class="ms-1" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 16.987 16.557">
                  <g id="send" transform="translate(0 -6.196)">
                    <g id="Group_216" data-name="Group 216" transform="translate(0 6.197)">
                      <path id="Path_22" data-name="Path 22" d="M16.809,13.7a1.78,1.78,0,0,0-.826-.826L2.556,6.375A1.78,1.78,0,0,0,.128,8.638l2.335,5.836L.128,20.311a1.78,1.78,0,0,0,2.428,2.264l13.427-6.5A1.78,1.78,0,0,0,16.809,13.7ZM2.039,21.505a.593.593,0,0,1-.809-.755L3.5,15.067H15.344ZM3.5,13.881,1.23,8.2a.593.593,0,0,1,.809-.753l13.305,6.436H3.5Z" transform="translate(0 -6.197)" fill="#fff" />
                    </g>
                  </g>
                </svg>`);
                  $open_msg_box.addClass('d-none');
                  $('.chevron-expand-text').slideUp();
                });
              });
            }, 2000);
            $('#sent_ul').load('company-dashboard.php .js-sent-li');
          }
        });
      }
    });
  });

})