$(function () {

  // Update Company profile 
  $('#update_company_profile').on('submit', function (event) {
    event.preventDefault();
    let company_name = $('input[name="company_name"]');
    let slogan = $('input[name="company_slogan"]');
    let address = $('input[name="company_address"]');
    let website = $('input[name="company_website"]');
    let company_description = $('textarea[name="company_description"]');
    let company_history = $('textarea[name="company_history"]');
    let company_mission = $('textarea[name="company_mission"]');
    let frontend_branch = $('input[name="it_branch[0]"]');
    let backend_branch = $('input[name="it_branch[1]"]');
    let fullstack_branch = $('input[name="it_branch[2]"]');
    let qa_branch = $('input[name="it_branch[3]"]');
    let mobdev_branch = $('input[name="it_branch[4]"]');
    let ux_ui_branch = $('input[name="it_branch[5]"]');

    // Proceed will tell ajax if everything is true proceed with ajax call if proceed is false don't make ajax call
    let proceed = true;

    // COMPANY NAME
    if (company_name.val().trim() == '') {
      company_name.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback').text('Field can\'t be empty!');
      proceed = false;

    } else if (!company_name.val().trim().match(/^[a-zA-Z0-9- \u0400-\u04FF]+$/u)) {
      company_name.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback')
        .text('You can use only letters');
      proceed = false;

    } else if (company_name.val().trim().length < 4 || company_name.val().trim().length > 254) {
      company_name.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback')
        .text('You need to put atleast 4 symbols and no more than 255!');
      proceed = false;

    }

    // SLOGAN
    if (slogan.val().trim().length > 49) {
      slogan.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback')
        .text('You need to put atleast 4 symbols and no more than 50!');
      proceed = false;

    }

    // ADDRESS
    if (address.val().trim().length > 49) {
      address.val('-');
      $('#company_address').html('-');

      address.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback')
        .text('You can put no more than 50 symbols or leave it like this!');

      setTimeout(function () {
        if (address.hasClass('is-invalid')) {
          address.removeClass('is-invalid')
            .next().removeClass('invalid-feedback').hide('slow');
        }
      }, 10000);
      proceed = false;

    } else if (address.val() == '') {
      address.val('-');
      $('#company_address').html('-');

      address.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback')
        .text('Field can not be empty or leave it like this!');

      setTimeout(function () {
        if (address.hasClass('is-invalid')) {
          address.removeClass('is-invalid')
            .next().removeClass('invalid-feedback').hide('slow');
        }
      }, 10000);
      proceed = false;

    } else if (!address.val().match(/^[a-zA-Z0-9\u0400-\u04FF-,'. ]+$/gu)) {
      address.val('-');
      $('#company_address').html('-');

      address.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback')
        .text('You can use a-z A-Z a-я А-Я 0-9 ,\'- or leave it like this!');

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
      $('#company_website').html('-');

      website.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback')
        .text('Field can not be empty or leave it like this!');

      setTimeout(function () {
        if (website.hasClass('is-invalid')) {
          website.removeClass('is-invalid')
            .next().removeClass('invalid-feedback').hide('slow');
        }

      }, 10000);
      proceed = false;

    } else if (website.val().length > 49) {
      website.val('-');
      $('#company_website').html('-');

      website.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback')
        .text('You can put no more than 50 symbols or you can leave it like this!');

      setTimeout(function () {
        if (website.hasClass('is-invalid')) {
          website.removeClass('is-invalid')
            .next().removeClass('invalid-feedback').hide('slow');
        }
      }, 10000);

      proceed = false;

    } else if (!website.val().match(/(-)|(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/)) {
      website.val('-');
      $('#company_website').html('-');

      website.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback')
        .text('Your website must start with https://, http:// or ftp:// or you can leave it like this');

      setTimeout(function () {
        if (website.hasClass('is-invalid')) {
          website.removeClass('is-invalid')
            .next().removeClass('invalid-feedback').hide('slow');
        }
      }, 10000);

      proceed = false;

    }

    // IT BRANCHES
    // Checking how many checkboxes are checked with length 
    if ($('.checkbox_length:checked').length === 0) {
      $('#checkbox_response').show('fast');
      $('#checkbox_response').addClass('text-danger').text('You need to select atleast one branch');
      proceed = false;
    } else {
      $('#checkbox_response').show('fast');
      if ($('#checkbox_response').hasClass('text-danger')) {
        $('#checkbox_response').removeClass('text-danger')
          .addClass('text-success');
      }
      $('#checkbox_response').text(`Great! You have selected ${$('.checkbox_length:checked').length} branches!`);
      setTimeout(function () {
        $('#checkbox_response').hide('fast');
      }, 5000)
      if ($.inArray('frontend', frontend_branch) && frontend_branch.is(':checked')) {
        frontend_branch.val('frontend');
      } else {
        frontend_branch.val('');
      }

      if ($.inArray('backend', backend_branch) && backend_branch.is(':checked')) {
        backend_branch.val('backend');
      } else {
        backend_branch.val('');
      }

      if ($.inArray('fullstack', fullstack_branch) && fullstack_branch.is(':checked')) {
        fullstack_branch.val('fullstack');
      } else {
        fullstack_branch.val('');
      }

      if ($.inArray('qa', qa_branch) && qa_branch.is(':checked')) {
        qa_branch.val('qa');
      } else {
        qa_branch.val('');
      }

      if ($.inArray('mobdev', mobdev_branch) && mobdev_branch.is(':checked')) {
        mobdev_branch.val('mobdev');
      } else {
        mobdev_branch.val('');
      }

      if ($.inArray('ux/ui', ux_ui_branch) && ux_ui_branch.is(':checked')) {
        ux_ui_branch.val('ux/ui');
      } else {
        ux_ui_branch.val('');
      }

    }

    // COMPANY DESCRIPTION
    if (company_description.val() == '') {
      company_description.val();

      company_description.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback')
        .text('Field can not be empty!');

      setTimeout(function () {
        if (company_description.hasClass('is-invalid')) {
          company_description.removeClass('is-invalid')
            .next().removeClass('invalid-feedback').hide('slow');
        }
      }, 10000);

      proceed = false;

    } else if (!company_description.val().match(/^[a-zA-Z0-9\u0400-\u04FF-'!.,; ]+$/gu)) {
      company_description.val('-');

      company_description.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback')
        .text('You can use a-z A-Z a-я А-Я 0-9 ,\'-!;.');

      setTimeout(function () {
        if (company_description.hasClass('is-invalid')) {
          address.removeClass('is-invalid')
            .next().removeClass('invalid-feedback').hide('slow');
        }
      }, 10000);
      proceed = false;

    } else if (company_description.val().length > 999) {
      company_description.val();

      company_description.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback')
        .text('You need to put less than 999 symbols!');

      setTimeout(function () {
        if (company_description.hasClass('is-invalid')) {
          company_description.removeClass('is-invalid')
            .next().removeClass('invalid-feedback').hide('slow');
        }
      }, 10000);

      proceed = false;

    } else if (company_description.val().length < 49) {

      company_description.val();

      company_description.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback')
        .text('You need to have more than 50 symbols!');

      setTimeout(function () {
        if (company_description.hasClass('is-invalid')) {
          company_description.removeClass('is-invalid')
            .next().removeClass('invalid-feedback').hide('slow');
        }
      }, 10000);

      proceed = false;

    }

    // COMPANY HISTORY
    if (company_history.val().length > 999) {


      company_history.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback')
        .text('You need to put less than 999 symbols!');

      setTimeout(function () {
        if (company_history.hasClass('is-invalid')) {
          company_history.removeClass('is-invalid')
            .next().removeClass('invalid-feedback').hide('slow');
        }
      }, 10000);

      proceed = false;

    }

    // COMPANY MISSION
    if (company_mission.val().length > 999) {

      company_mission.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback')
        .text('You need to put less than 999 symbols!');

      setTimeout(function () {
        if (company_mission.hasClass('is-invalid')) {
          company_mission.removeClass('is-invalid')
            .next().removeClass('invalid-feedback').hide('slow');
        }
      }, 10000);

      proceed = false;

    }
    if (proceed) {
      $.ajax({
        url: './src/database.php',
        type: 'POST',
        dataType: 'JSON',
        data: {
          company_name: company_name.val(),
          slogan: slogan.val(),
          address: address.val(),
          website: website.val(),
          company_description: company_description.val(),
          company_history: company_history.val(),
          company_mission: company_mission.val(),
          frontend_branch: frontend_branch.val(),
          backend_branch: backend_branch.val(),
          fullstack_branch: fullstack_branch.val(),
          qa_branch: qa_branch.val(),
          mobdev_branch: mobdev_branch.val(),
          ux_ui_branch: ux_ui_branch.val()

        },
        success: function (response) {
          $('#success_mess_validation').slideDown('slow').addClass('alert alert-success').text('Update successful!');
          setTimeout(function () {
            $('#success_mess_validation').slideUp('slow');
          }, 2000);
          $('#company_name').html(response.company_name);
          $('#greetings_company_name').html(`${response.company_name}!`);
          $('#company_address').html(response.address);
          $('#company_website').html(response.website);
          $('#company_website').attr('href', response.website);
          $('#showcase_company_name').text(response.company_name);
          $('#showcase_company_description').html(response.company_description);
          $('#showcase_company_slogan').html(response.slogan);
          $('#showcase_company_history').html(response.company_history);
          $('#showcase_company_mission').html(response.company_mission);
          $('#showcase_it_branches').load('company-dashboard.php #badge_it_container');

          company_name.val(response.company_name);
          address.val(response.address);
          website.val(response.website);
          company_description.val(response.company_description);
          slogan.val(response.slogan);
          company_history.val(response.company_history);
          company_mission.val(response.company_mission);
        },
        error: function () {
          console.log('error');
        }
      });
    }

  });

  // Publish job ajax
  $('#publish_form').on('submit', function (event) {
    event.preventDefault();
    let job_title = $('input[name="job_title"]');
    let job_title_response_text = $('#job_title_response_text');
    let job_fulltime = $('input[name="job_time[0]"');
    let job_part_time = $('input[name="job_time[1]"');
    let job_time_response_text = $('#job_time_response_text');
    let frontend_tag = $('input[name="it_tag[0]"]');
    let backend_tag = $('input[name="it_tag[1]"]');
    let fullstack_tag = $('input[name="it_tag[2]"]');
    let qa_tag = $('input[name="it_tag[3]"]');
    let mobdev_tag = $('input[name="it_tag[4]"]');
    let ux_ui_tag = $('input[name="it_tag[5]"]');
    let job_tag_response_text = $('#job_tag_response_text');
    let job_salary = $('input[name="job_salary"]');
    let salary_response_text = $('#salary_response_text');
    let salary_currency = $('input[name="currency"]:checked');
    let currency_response_text = $('#currency_response_text');
    let salary_month_year = $('input[name="month_year_salary"]:checked');
    let job_month_year_response_text = $('#job_month_year_response_text');
    let job_description = $('textarea[name="job_description"]');
    let job_description_response_text = $('#job_description_response_text');
    let proceed = true;

    // Job title
    if (job_title.val().trim().length < 20 || job_title.val().trim().length > 254) {
      job_title_response_text.show('fast');
      job_title.addClass('is-invalid');
      job_title_response_text.addClass('text-danger')
        .html('You need to put more than 20 symbols or less than 255!');

      if (job_title_response_text.hasClass('text-success') && job_title.hasClass('is-valid')) {
        job_title.removeClass('is-valid').addClass('is-invalid');
        job_title_response_text.removeClass('text-success')
          .addClass('text-danger')
          .html('You need to put more than 20 symbols or less than 255!');
      }

      proceed = false;
    } else {
      job_title_response_text.show('fast');
      job_title.addClass('is-valid');
      job_title_response_text.addClass('text-success')
        .html('OK!');
      if (job_title_response_text.hasClass('text-danger') && job_title.hasClass('is-invalid')) {
        job_title.removeClass('is-invalid').addClass('is-valid');
        job_title_response_text.removeClass('text-danger')
          .addClass('text-success')
          .html('OK!');
      }

      setTimeout(function () {
        job_title_response_text.hide('fast');
      }, 5000)
    }

    // IT tag
    if ($('.it_tag_length:checked').length === 0) {
      job_tag_response_text.show('fast');
      job_tag_response_text.addClass('text-danger').text('You need to select atleast one tag... This will help applicants to find more easy your publish!');

      proceed = false;
    } else {
      job_tag_response_text.show('fast');
      if (job_tag_response_text.hasClass('text-danger')) {
        job_tag_response_text.removeClass('text-danger')
          .addClass('text-success');
      }
      job_tag_response_text.text(`Great! You have selected ${$('.it_tag_length:checked').length} tag/tags!`);
      setTimeout(function () {
        job_tag_response_text.hide('fast');
      }, 5000);

      if ($.inArray('frontend', frontend_tag) && frontend_tag.is(':checked')) {
        frontend_tag.val('frontend');
      } else {
        frontend_tag.val('');
      }

      if ($.inArray('backend', backend_tag) && backend_tag.is(':checked')) {
        backend_tag.val('backend');
      } else {
        backend_tag.val('');
      }

      if ($.inArray('fullstack', fullstack_tag) && fullstack_tag.is(':checked')) {
        fullstack_tag.val('fullstack');
      } else {
        fullstack_tag.val('');
      }

      if ($.inArray('qa', qa_tag) && qa_tag.is(':checked')) {
        qa_tag.val('qa');
      } else {
        qa_tag.val('');
      }

      if ($.inArray('mobdev', mobdev_tag) && mobdev_tag.is(':checked')) {
        mobdev_tag.val('mobdev');
      } else {
        mobdev_tag.val('');
      }

      if ($.inArray('ux/ui', ux_ui_tag) && ux_ui_tag.is(':checked')) {
        ux_ui_tag.val('ux/ui');
      } else {
        ux_ui_tag.val('');
      }

    }

    // Job time
    if ($('.job_time_length:checked').length === 0) {
      job_time_response_text.show('fast');
      job_time_response_text.addClass('text-danger').text('You need to choose between Fulltime or Part time or you can choose both!');

      proceed = false;
    } else {
      job_time_response_text.show('fast');
      if (job_time_response_text.hasClass('text-danger')) {
        job_time_response_text.removeClass('text-danger')
          .addClass('text-success');
      }
      job_time_response_text.text(`Great! Now People will know how many hourse will work per day!`);
      setTimeout(function () {
        job_time_response_text.hide('fast');
      }, 5000);

      if ($.inArray('full time', job_fulltime) && job_fulltime.is(':checked')) {
        job_fulltime.val('full time');
      } else {
        job_fulltime.val('');
      }

      if ($.inArray('part time', job_part_time) && job_part_time.is(':checked')) {
        job_part_time.val('part time');
      } else {
        job_part_time.val('');
      }
    }

    // Job Salary
    if (job_salary.val().match(/[a-zA-Z)(*&^%$#@!)]/) || job_salary.val() == '') {

      salary_response_text.show('fast');
      job_salary.addClass('is-invalid');
      salary_response_text.addClass('text-danger')
        .html('You can put only [0-9,-.]!');

      if (salary_response_text.hasClass('text-success') && job_salary.hasClass('is-valid')) {
        job_salary.removeClass('is-valid').addClass('is-invalid');
        salary_response_text.removeClass('text-success')
          .addClass('text-danger')
          .html('You can put only [0-9,-.]!');
      }

      proceed = false;
    } else {
      salary_response_text.show('fast');
      job_salary.addClass('is-valid');
      salary_response_text.addClass('text-success')
        .html('OK!');
      if (salary_response_text.hasClass('text-danger') && job_salary.hasClass('is-invalid')) {
        job_salary.removeClass('is-invalid').addClass('is-valid');
        salary_response_text.removeClass('text-danger')
          .addClass('text-success')
          .html('OK!');
      }

      setTimeout(function () {
        salary_response_text.hide('fast');
      }, 5000)
    }

    // Salary currency
    if (salary_currency.length === 0) {
      currency_response_text.show('fast');
      currency_response_text.addClass('text-danger').text('Field is required!');

      proceed = false;
    } else {
      currency_response_text.show('fast');
      if (currency_response_text.hasClass('text-danger')) {
        currency_response_text.removeClass('text-danger')
          .addClass('text-success');
      }

      currency_response_text.text('OK!');
      setTimeout(function () {
        currency_response_text.hide('fast');
      }, 5000);
    }

    // Salary month year 
    if (salary_month_year.length === 0) {
      job_month_year_response_text.show('fast');
      job_month_year_response_text.addClass('text-danger').text('Field is required!');

      proceed = false;
    } else {
      job_month_year_response_text.show('fast');
      if (job_month_year_response_text.hasClass('text-danger')) {
        job_month_year_response_text.removeClass('text-danger')
          .addClass('text-success');
      }

      job_month_year_response_text.text('OK!');
      setTimeout(function () {
        job_month_year_response_text.hide('fast');
      }, 5000);
    }

    // Job description
    if (job_description.val().trim().length < 49 || job_description.val().trim().length > 999) {
      job_description_response_text.show('fast');
      job_description.addClass('is-invalid');
      job_description_response_text.addClass('text-danger')
        .html('You need to put more than 50 symbols or less than 999!');

      if (job_description_response_text.hasClass('text-success') && job_description.hasClass('is-valid')) {
        job_description.removeClass('is-valid').addClass('is-invalid');
        job_description_response_text.removeClass('text-success')
          .addClass('text-danger')
          .html('You need to put more than 20 symbols or less than 255!');
      }

      proceed = false;
    } else {
      job_description_response_text.show('fast');
      job_description.addClass('is-valid');
      job_description_response_text.addClass('text-success')
        .html('OK!');
      if (job_description_response_text.hasClass('text-danger') && job_description.hasClass('is-invalid')) {
        job_description.removeClass('is-invalid').addClass('is-valid');
        job_description_response_text.removeClass('text-danger')
          .addClass('text-success')
          .html('OK!');
      }

      setTimeout(function () {
        job_description_response_text.hide('fast');
      }, 5000)
    }

    if (proceed) {
      $.ajax({
        url: 'src/publish-job.php',
        method: 'POST',
        cache: 'false',
        data: {
          job_company_id: $('input[name="secret_number"]').val(),
          job_company_username: $('input[name="company_username"]').val(),
          job_company_name: $('input[name="company_name"]').val(),
          job_company_email: $('input[name="company_email"]').val(),
          job_title: job_title.val(),
          job_fulltime: job_fulltime.val(),
          job_part_time: job_part_time.val(),
          frontend_tag: frontend_tag.val(),
          backend_tag: backend_tag.val(),
          fullstack_tag: fullstack_tag.val(),
          qa_tag: qa_tag.val(),
          mobdev_tag: mobdev_tag.val(),
          ux_ui_tag: ux_ui_tag.val(),
          job_salary: job_salary.val(),
          salary_currency: salary_currency.val(),
          salary_month_year: salary_month_year.val(),
          job_description: job_description.val()

        },
        success: function () {

          $('#publish_succ_mess').show('fast');
          $('#publish_succ_mess').addClass('alert alert-success').html('Publish successful!')

          setTimeout(function () {
            $('#publish_succ_mess').hide('fast');
          }, 5000)
        },
        error: function (jqXHR, text, errorThrown) {
          console.log(jqXHR + " " + text + " " + errorThrown);
        },
      });
    }

  });

  // Remove published job
  $('#view_published_jobs').on('click', '#remove_published_job', function () {
    $published_job_id = $(this);
    $published_job_id.html('Loading...').addClass('disabled');
    $.ajax({
      url: 'src/database.php',
      method: 'post',
      data: {
        published_job_id: $published_job_id.val(),
        is_active: 'N'
      },
      success: function () {
        $published_job_id.closest('li').fadeOut('slow', function () {
          $published_job_id.closest('li').remove();
        })
      }
    });
  });

  $('#view_published_jobs').on('click', '#activate_published_job', function () {
    $activate_published_job_id = $(this);
    $activate_published_job_id.html('Loading...').addClass('disabled');
    let $published_date = `${new Date().getFullYear()}-${adding_zeros_time(new Date().getMonth() + 1)}-${adding_zeros_time(new Date().getDate())}`;
    $.ajax({
      url: 'src/database.php',
      method: 'post',
      data: {
        activate_published_job_id: $activate_published_job_id.val(),
        published_date: $published_date,
        is_active: 'Y'
      },
      success: function () {
        $activate_published_job_id.closest('li').fadeOut('slow', function () {
          $activate_published_job_id.closest('li').remove();
        })
      }
    });
  });

  // Update published job
  $('#view_published_jobs').on('click', '#update_published_job', function(){
    $published_job_id = $(this).val();
    $update_job_form_container = $('.js-update-publish-job-form');

    $.ajax({
      url: 'src/update_published_job.php',
      method: 'post',
      data: {
        update_published_job_id: $published_job_id
      },
      success: function(response){
        $update_job_form_container.html(`${response}`);
        if ($update_job_form_container.hasClass('d-none')) {
          $update_job_form_container.removeClass('d-none').animate({
            top: '50%',
            right: '32px',
            opacity: '1'
          }, 'fast');
        }
      }
    });

    $update_job_form_container.on('click', '.btn-close', function () {
      $update_job_form_container.animate({
        right: '-544px',
        opacity: '0'
      }, 'slow', function () {
        $(this).addClass('d-none');
      })
    });

  });

});