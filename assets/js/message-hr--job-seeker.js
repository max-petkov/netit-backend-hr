$(function () {
  $('body').on('click', '.js-send-message-job-seeker', function () {
    $open_btn = $(this);
    $open_msg_box = $(this).closest('.js-job-seeker-toogle-btns').siblings('.js-message-job-seeker-box');

    $('.js-send-message-job-seeker').addClass('disabled');
    $open_btn.addClass('disabled').text('Waiting...');

    $open_msg_box.removeClass('d-none').slideDown('slow');
    $open_msg_box.on('click', '.btn-close', function () {
      $open_msg_box.slideUp('slow', function () {
        $('.js-send-message-job-seeker').removeClass('disabled');
        $open_btn.removeClass('disabled').html(`<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1 bi bi-reply" viewBox="0 0 16 16">
        <path d="M6.598 5.013a.144.144 0 0 1 .202.134V6.3a.5.5 0 0 0 .5.5c.667 0 2.013.005 3.3.822.984.624 1.99 1.76 2.595 3.876-1.02-.983-2.185-1.516-3.205-1.799a8.74 8.74 0 0 0-1.921-.306 7.404 7.404 0 0 0-.798.008h-.013l-.005.001h-.001L7.3 9.9l-.05-.498a.5.5 0 0 0-.45.498v1.153c0 .108-.11.176-.202.134L2.614 8.254a.503.503 0 0 0-.042-.028.147.147 0 0 1 0-.252.499.499 0 0 0 .042-.028l3.984-2.933zM7.8 10.386c.068 0 .143.003.223.006.434.02 1.034.086 1.7.271 1.326.368 2.896 1.202 3.94 3.08a.5.5 0 0 0 .933-.305c-.464-3.71-1.886-5.662-3.46-6.66-1.245-.79-2.527-.942-3.336-.971v-.66a1.144 1.144 0 0 0-1.767-.96l-3.994 2.94a1.147 1.147 0 0 0 0 1.946l3.994 2.94a1.144 1.144 0 0 0 1.767-.96v-.667z" />
        </svg>
        Send Message`);
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
          url: 'src/hr-job-seeker-message.php',
          method: 'post',
          data: {
            from: $from.val(),
            to: $to.val(),
            subject: $subject.val(),
            inbox_msg_job_seeker: $message.val()
          },
          success: function () {
            $scs_msg.slideDown('slow').addClass('alert alert-success').text('Message send successful!');
            setTimeout(function () {
              $scs_msg.slideUp('slow', function () {
                $open_msg_box.slideUp('slow', function () {
                  $('.js-send-message-job-seeker').removeClass('disabled');
                  $open_btn.removeClass('disabled').html(`<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1 bi bi-reply" viewBox="0 0 16 16">
                  <path d="M6.598 5.013a.144.144 0 0 1 .202.134V6.3a.5.5 0 0 0 .5.5c.667 0 2.013.005 3.3.822.984.624 1.99 1.76 2.595 3.876-1.02-.983-2.185-1.516-3.205-1.799a8.74 8.74 0 0 0-1.921-.306 7.404 7.404 0 0 0-.798.008h-.013l-.005.001h-.001L7.3 9.9l-.05-.498a.5.5 0 0 0-.45.498v1.153c0 .108-.11.176-.202.134L2.614 8.254a.503.503 0 0 0-.042-.028.147.147 0 0 1 0-.252.499.499 0 0 0 .042-.028l3.984-2.933zM7.8 10.386c.068 0 .143.003.223.006.434.02 1.034.086 1.7.271 1.326.368 2.896 1.202 3.94 3.08a.5.5 0 0 0 .933-.305c-.464-3.71-1.886-5.662-3.46-6.66-1.245-.79-2.527-.942-3.336-.971v-.66a1.144 1.144 0 0 0-1.767-.96l-3.994 2.94a1.147 1.147 0 0 0 0 1.946l3.994 2.94a1.144 1.144 0 0 0 1.767-.96v-.667z" />
                  </svg>
                  Send Message`);
                  $open_msg_box.addClass('d-none');
                });
              });
            }, 2000);
          }
        });
      }

    });
  });
})