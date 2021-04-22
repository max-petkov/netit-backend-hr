$(function () {

  // Apply job
  $('body').on('click', '.js-apply-job', function () {
    $apply_button = $(this);
    $apply_button.closest('div')
      .next()
      .removeClass('d-none').animate({
        top: '0px',
        right: '32px',
        opacity: '1'
      }, 'fast', function () {
        $apply_button.text('Waiting...').addClass('disabled')
      });

    $('.job_li').on('click', '.btn-close', function () {
      $close_motivation_speech_container = $(this).closest('.container');

      $close_motivation_speech_container.animate({
        right: '-544px',
        opacity: '0'
      }, 'slow', function () {
        $close_motivation_speech_container.addClass('d-none');
        if ($(this).closest('.job_li').children('.d-flex').children('.js-apply-job').text() !== 'Applied!') {
          $(this).closest('.job_li').children('.d-flex').children('.js-apply-job').html(`
            <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
            <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
          </svg>
          Apply`).removeClass('disabled');
        }
      });
    });


    $('body').on('click', '.js-send-speech', function (event) {
      event.preventDefault();
      event.stopImmediatePropagation();
      $send_speech = $(this);
      $proceed = true;

      if ($send_speech.prev().prev().val().trim().length < 49 || $send_speech.prev().prev().val().trim().length > 999) {
        $send_speech.prev().show('fast');
        $send_speech.prev().prev().addClass('is-invalid');
        $send_speech.prev().addClass('text-danger')
          .html('Field must be more than 49 and less than 1000 symbols!');
        if ($send_speech.prev().hasClass('text-success') && $send_speech.prev().prev().hasClass('is-valid')) {
          $send_speech.prev().prev().removeClass('is-valid').addClass('is-invalid');
          $send_speech.prev().removeClass('text-success')
            .addClass('text-danger')
            .html('Field must be more than 49 and less than 1000 symbols!');
        }
        $proceed = false;
      } else {
        $send_speech.prev().show('fast');
        $send_speech.prev().prev().addClass('is-valid');
        $send_speech.prev().addClass('text-success')
          .html('OK!');
        if ($send_speech.prev().hasClass('text-danger') && $send_speech.prev().prev().hasClass('is-invalid')) {
          $send_speech.prev().prev().removeClass('is-invalid').addClass('is-valid');
          $send_speech.prev().removeClass('text-danger')
            .addClass('text-success')
            .html('OK!');
        }
        setTimeout(function () {
          $send_speech.prev().hide('fast');
        }, 5000)
      }

      if ($proceed) {
        $.ajax({
          url: 'src/publish-job.php',
          method: 'post',
          data: {
            job_id: $apply_button.val(),
            job_seeker_id: $apply_button.next().val(),
            random_chars: $apply_button.next().next().val(),
            is_applied: 'Y',
            motivation_speech: $send_speech.prev().prev().val(),
            apply_job: $(this).next().val()
          },
          success: function () {
            $apply_button.text('Applied!').addClass('disabled');
            $send_speech.text('SUCCESS!').addClass('disabled');

            $send_speech.closest('.card-body').children('#apply_succ_mess').slideDown('slow').addClass('alert alert-success').text('Apply successful!');
            setTimeout(function () {
              $send_speech.closest('.card-body').children('#apply_succ_mess').slideUp('slow', function () {
                $send_speech.closest('.js-motivation-speech').animate({
                  right: '-544px',
                  opacity: '0'
                }, 'slow', function () {
                  $send_speech.closest('.js-motivation-speech').addClass('d-none');
                });
              });
            }, 2000);
          }
        });
      }
    });
  });

  // Cancel applications
  $('#applied_job_container').on('click', '.js-cancel-application', function (e) {
    e.preventDefault();
    $cancel_application_button = $(this);
    $cancel_application_button.text('Loading...').addClass('disabled');

    $.ajax({
      url: 'src/publish-job.php',
      method: 'post',
      data: {
        applied_id: $cancel_application_button.next().val(),
        cancel_application: $(this).next().next().val()
      },
      success: function () {
        $cancel_application_button.closest('li').fadeOut('slow', function () {
          $cancel_application_button.closest('li').remove();
          $('#published_job_list').load('employee-dashboard.php .job_li');
        })
      }
    });
  });

  // Sorting job list
  $('#select_it_tag').on("change", function () {
    $('#published_job_list').html('Loading results...');
    if ($(this).val() === '*') {
      $.ajax({
        url: 'src/sort-job-list.php',
        method: 'post',
        data: {
          default_list: $(this).val()
        },
        success: function (response) {
          if (!$.trim(response)) {
            $('#published_job_list').html(`<h6>There are no published jobs...</h6>`);
          } else {
            $('#published_job_list').html($.trim(response));
          }
        }
      });
    } else if ($(this).val() === 'ux_ui') {
      $.ajax({
        url: 'src/sort-job-list.php',
        method: 'post',
        data: {
          ux_ui: $(this).val(),
          ux_ui_tag: 'ux/ui'
        },
        success: function (response) {
          if (!$.trim(response)) {
            $('#published_job_list').html(`<h6>There are no published jobs...</h6>`);
          } else {
            $('#published_job_list').html($.trim(response));
          }
        }
      });
    } else {
      $.ajax({
        url: 'src/sort-job-list.php',
        method: 'post',
        data: {
          tag_list: $(this).val()
        },
        success: function (response) {
          if (!$.trim(response)) {
            $('#published_job_list').html(`<h6>There are no published jobs...</h6>`);
          } else {
            $('#published_job_list').html($.trim(response));
          }
        }
      });
    }
  });

  // Search by title or company name
  $('#search_by_title_company').on('keyup', function () {
    // Reseting job when there is no input value
    if (!$(this).val()) {
      $.ajax({
        url: 'src/sort-job-list.php',
        method: 'post',
        data: {
          default_list: '*'
        },
        success: function (response) {
          if (!$.trim(response)) {
            $('#published_job_list').html(`<h6>There are no published jobs...</h6>`);
          } else {
            $('#published_job_list').html($.trim(response));
          }
        }
      });
    } else {
      $.ajax({
        url: 'src/sort-job-list.php',
        method: 'post',
        data: {
          search_by_company_name: $(this).val()
        },
        success: function (response) {
          if (!$.trim(response)) {
            $('#published_job_list').html(`<h6>There are no published jobs...</h6>`);
          } else {
            $('#published_job_list').html($.trim(response));
          }
        }
      })

    }
  });

  // Update Employee profile 
  $('#job_seeker_profile_form').on('submit', function (event) {
    event.preventDefault();
    let first_name = $('input[name="name"]');
    let last_name = $('input[name="last_name"]');
    let address = $('input[name="address"]');
    let website = $('input[name="website"]');
    let short_introduction = $('textarea[name="short_introduction"]');
    let proceed = true; // Proceed will tell ajax if everything is true proceed with ajax call if proceed is false don't make ajax call
    let $form_data = $(this).serializeArray();

    $form_data.push({
      name: 'update_employee', //It will be used as isset() at server side validation
      value: null
    });


    // FIRST NAME
    if (first_name.val().trim() == '') {
      first_name.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback').text('Field can\'t be empty!');
      proceed = false;

    } else if (!first_name.val().trim().match(/^[a-zA-Z\u0400-\u04FF]+$/u)) {
      first_name.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback')
        .text('You can use only letters');
      proceed = false;

    } else if (first_name.val().trim().length < 4 || first_name.val().trim().length > 49) {
      first_name.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback')
        .text('You need to put atleast 4 symbols and no more than 50!');
      proceed = false;

    }

    // LAST NAME
    if (last_name.val().trim() == '') {
      last_name.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback').text('Field can\'t be empty!');
      proceed = false;

    } else if (!last_name.val().trim().match(/^[a-zA-Z\u0400-\u04FF]+$/u)) {
      last_name.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback')
        .text('You can use only letters and single quotes');
      proceed = false;

    } else if (last_name.val().trim().length < 4 || last_name.val().trim().length > 49) {
      last_name.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback')
        .text('You need to put atleast 4 symbols and no more than 50!');
      proceed = false;

    }

    // ADDRESS
    if (address.val().trim().length > 49) {
      address.val('-');
      $('#employee_address').html('-');

      address.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback')
        .text('You can put no more than 50 symbols or SAVE it like this!');

      setTimeout(function () {
        if (address.hasClass('is-invalid')) {
          address.removeClass('is-invalid')
            .next().removeClass('invalid-feedback').hide('slow');
        }
      }, 10000);
      proceed = false;

    } else if (address.val() == '') {
      address.val('-');
      $('#employee_address').html('-');

      address.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback')
        .text('Field can not be empty or SAVE it like this!');

      setTimeout(function () {
        if (address.hasClass('is-invalid')) {
          address.removeClass('is-invalid')
            .next().removeClass('invalid-feedback').hide('slow');
        }
      }, 10000);
      proceed = false;

    } else if (!address.val().match(/^[a-zA-Z0-9\u0400-\u04FF-,'. ]+$/gu)) {
      address.val('-');
      $('#employee_address').html('-');

      address.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback')
        .text('You can use a-z A-Z a-я А-Я 0-9 ,\'- or SAVE it like this!');

      setTimeout(function () {
        if (address.hasClass('is-invalid')) {
          address.removeClass('is-invalid')
            .next().removeClass('invalid-feedback').hide('slow');
        }
      }, 10000);
      proceed = false;

    }

    // WEBSITE
    if (website.val() == '') {
      website.val('-');
      $('#employee_website').html('-');

      website.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback')
        .text('Field can not be empty or SAVE it like this!');

      setTimeout(function () {
        if (website.hasClass('is-invalid')) {
          website.removeClass('is-invalid')
            .next().removeClass('invalid-feedback').hide('slow');
        }

      }, 10000);
      proceed = false;

    } else if (website.val().length > 49) {
      website.val('-');
      $('#employee_website').html('-');

      website.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback')
        .text('You can put no more than 50 symbols or you can SAVE it like this!');

      setTimeout(function () {
        if (website.hasClass('is-invalid')) {
          website.removeClass('is-invalid')
            .next().removeClass('invalid-feedback').hide('slow');
        }
      }, 10000);

      proceed = false;

    } else if (!website.val().match(/(-)|(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/)) {
      website.val('-');
      $('#employee_website').html('-');

      website.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback')
        .text('Your website must start with https://, http:// or ftp:// or you can SAVE it like this');

      setTimeout(function () {
        if (website.hasClass('is-invalid')) {
          website.removeClass('is-invalid')
            .next().removeClass('invalid-feedback').hide('slow');
        }
      }, 10000);

      proceed = false;

    }

    // Short introduction
    if (short_introduction.val() == '') {
      short_introduction.val(`  - 👋 Hi, I’m ...
  - 👀 I’m interested in ...
  - 🌱 I’m currently learning ...
  - 💞️ I’m looking to collaborate on ...
  - 📫 How to reach me ...`);

      short_introduction.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback')
        .text('Field can not be empty or SAVE it like this!');

      setTimeout(function () {
        if (short_introduction.hasClass('is-invalid')) {
          short_introduction.removeClass('is-invalid')
            .next().removeClass('invalid-feedback').hide('slow');
        }
      }, 10000);

      proceed = false;

    } else if (short_introduction.val().length > 999) {
      short_introduction.val(`  - 👋 Hi, I’m ...
  - 👀 I’m interested in ...
  - 🌱 I’m currently learning ...
  - 💞️ I’m looking to collaborate on ...
  - 📫 How to reach me ...`);

      short_introduction.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback')
        .text('You can put no more than 999 symbols or SAVE it like this!');

      setTimeout(function () {
        if (short_introduction.hasClass('is-invalid')) {
          short_introduction.removeClass('is-invalid')
            .next().removeClass('invalid-feedback').hide('slow');
        }
      }, 10000);

      proceed = false;

    } else if (short_introduction.val().length < 49) {

      short_introduction.val(`  - 👋 Hi, I’m ...
  - 👀 I’m interested in ...
  - 🌱 I’m currently learning ...
  - 💞️ I’m looking to collaborate on ...
  - 📫 How to reach me ...`);

      short_introduction.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback')
        .text('You need to have more than 50 symbols or SAVE it like this!');

      setTimeout(function () {
        if (short_introduction.hasClass('is-invalid')) {
          short_introduction.removeClass('is-invalid')
            .next().removeClass('invalid-feedback').hide('slow');
        }
      }, 10000);

      proceed = false;
    }

    // AJAX
    if (proceed) {
      $.ajax({
        url: 'src/update-profile.php',
        method: 'post',
        dataType: 'json',
        data: $form_data,
        success: function (response) {
          $('#success_mess_validation').slideDown('slow').addClass('alert alert-success').text('Update successful!');
          setTimeout(function () {
            $('#success_mess_validation').slideUp('slow');
          }, 2000);
          $('#greetings_first_name').html(`${response.name}`);
          $('#employee_first_name').html(response.name);
          $('#employee_last_name').html(response.last_name);
          $('#employee_address').html(response.address);
          $('#employee_website').attr('href', response.website);
          $('#employee_website').html(response.website);
        },
        error: function () {
          console.log('error');
        }
      });
    }
  });

  // Update inbox counter
  $('body').on('click', '.message_icon', function () {
    if ($(this).children('span').text() !== '0') {
      $.ajax({
        url: 'src/inbox-counter.php',
        method: 'post',
        data: {
          inbox_job_seeker_counter: 'Y'
        },
        success: function () {
          $('#inbox_job_seeker_counter_container').load('employee-dashboard.php #inbox_job_seeker_counter');
        }
      });
    }
  });

  $("#published_job_list li").slice(10).hide();
  let mincount = 10;
  let maxcount = 20;
  $(window).on('scroll', function () {
    if ($(window).scrollTop() + $(window).height() >= $(document).height() - 400) {
      $("#published_job_list li").slice(mincount, maxcount).show();
      mincount = mincount + 10;
      maxcount = maxcount + 10;
    }
  });
})