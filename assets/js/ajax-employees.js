$(function () {

  // Getting job_seeker_id value from response.id & passing it to apply_job
    let job_seeker_id = '';

    // Fetching json data from json-employee-data.php
    $.ajax({
      url: './src/json-employee-data.php',
      dataType: 'json',
      method: 'post',
      cache: 'false',
      success: function (response) {
        console.log(response);
        job_seeker_id = response.id;
        // collapse menu data
        $('#employee_username').text(response.username);
        $('#employee_email').text(response.email);
        $('#employee_first_name').text(response.first_name);
        $('#employee_last_name').text(response.last_name);
        $('#greetings_first_name').append(`${response.first_name}!`);
        $('#employee_address').text(response.address);
        $('#employee_website').text(response.website);
        $('#employee_website').attr('href', response.website);
  
        // Edit profile data
        $('input[name="employee_username"]').val(response.username);
        $('input[name="employee_email"]').val(response.email);
        $('input[name="employee_first_name"]').val(response.first_name);
        $('input[name="employee_last_name"]').val(response.last_name);
        $('input[name="address_employee"]').val(response.address);
        $('input[name="website_employee"]').val(response.website);
        $('textarea[name="short_introduction"]').val(response.short_introduction);
      },
      error: function () {
        console.log('error');
      }
    });

       // Getting id value from dynamically created button
       $(document).on('click', '#apply_job', function() {
        console.log($(this).val());
        $.ajax({
          url: 'src/applied-jobs.php',
          method: 'post',
          data:{
            job_id: $(this).val(),
            job_seeker_id: job_seeker_id
          },
          success: function() {
            $(this).removeClass('btn-warning').addClass('btn-success').html('Applied!');
          }
        })
  
      });

    // Refreshing job list elements and lazy load list items
    (function refresh_content(){
      $('#published_job_list').load('employee-dashboard.php #published_job_list', setTimeout(refresh_content, 5000), function() {
        $("#published_job_list li").slice(10).hide();
        let mincount = 10;
        let maxcount = 20;
        $(window).on('scroll', function() {
          if ($(window).scrollTop() + $(window).height() >= $(document).height() - 400) {
            $("#published_job_list li").slice(mincount, maxcount).show();
            mincount = mincount+10;
            maxcount = maxcount+10;
          }
        });
      });
    })();

    // REFRESH JOB COUNTER on every 5 seconds
    (function refresh_frontend_tag_counter(){
      $('#refresh_frontend_tag').load('employee-dashboard.php #refresh_frontend_tag', setTimeout(refresh_frontend_tag_counter, 5000));
    })();

    (function refresh_backend_tag_counter(){
      $('#refresh_backend_tag').load('employee-dashboard.php #refresh_backend_tag', setTimeout(refresh_backend_tag_counter, 5000));
    })();

    (function refresh_fullstack_tag_counter(){
      $('#refresh_fullstack_tag').load('employee-dashboard.php #refresh_fullstack_tag', setTimeout(refresh_fullstack_tag_counter, 5000));
    })();

    (function refresh_qa_tag_counter(){
      $('#refresh_qa_tag').load('employee-dashboard.php #refresh_qa_tag', setTimeout(refresh_qa_tag_counter, 5000));
    })();

    (function refresh_mobdev_tag_counter(){
      $('#refresh_mobdev_tag').load('employee-dashboard.php #refresh_mobdev_tag', setTimeout(refresh_mobdev_tag_counter, 5000));
    })();

    (function refresh_ux_ui_tag_counter(){
      $('#refresh_ux_ui_tag').load('employee-dashboard.php #refresh_ux_ui_tag', setTimeout(refresh_ux_ui_tag_counter, 5000));
    })();

  // Update Employee profile 
  $('button[name="submit_update"]').on('click', function () {
    
    let first_name = $('input[name="employee_first_name"]');
    let last_name = $('input[name="employee_last_name"]');
    let address = $('input[name="address_employee"]');
    let website = $('input[name="website_employee"]');
    let short_introduction = $('textarea[name="short_introduction"]');

    // Proceed will tell ajax if everything is true proceed with ajax call if proceed is false don't make ajax call
    let proceed = true;
    
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

    } else {
      if (first_name.hasClass('is-invalid')) {
        first_name.removeClass('is-invalid')
          .addClass('is-valid')
          .next()
          .removeClass('invalid-feedback')
          .addClass('valid-feedback')
          .text('Great!').show('slow');
      } else {
        first_name.addClass('is-valid')
          .next()
          .addClass('valid-feedback')
          .text('OK!').show('slow');
      }
      setTimeout(function () {
        if (first_name.hasClass('is-valid')) {
          first_name.removeClass('is-valid')
            .next().hide('slow');
        }
      }, 5000);
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

    } else {
      if (last_name.hasClass('is-invalid')) {
        last_name.removeClass('is-invalid')
          .addClass('is-valid')
          .next()
          .removeClass('invalid-feedback')
          .addClass('valid-feedback')
          .text('Great!').show('slow');
      } else {
        last_name.addClass('is-valid')
          .next()
          .addClass('valid-feedback')
          .text('OK!').show('slow');
      }
      setTimeout(function () {
        if (last_name.hasClass('is-valid')) {
          last_name.removeClass('is-valid')
            .next().hide('slow');
        }
      }, 5000);
    }
    
    // ADDRESS
    if (address.val().trim().length > 49) {
      address.val('-');
      $('#employee_address').html('-');

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
      $('#employee_address').html('-');

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
      $('#employee_address').html('-');

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

    } else {
      if (address.hasClass('is-invalid')) {
        address.removeClass('is-invalid')
          .addClass('is-valid')
          .next()
          .removeClass('invalid-feedback')
          .addClass('valid-feedback')
          .text('Great!').show('slow');
      } else {
        address.addClass('is-valid')
          .next()
          .addClass('valid-feedback')
          .text('OK!').show('slow');
      }
      setTimeout(function () {
        if (address.hasClass('is-valid')) {
          address.removeClass('is-valid')
            .next().hide('slow');
        }
      }, 5000);
    }
    
    // WEBSITE
    if (website.val() == '') {
      website.val('-');
      $('#employee_website').html('-');

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
      $('#employee_website').html('-');

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
      $('#employee_website').html('-');

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

    } else {
      if (website.hasClass('is-invalid')) {
        website.removeClass('is-invalid')
          .addClass('is-valid')
          .next()
          .removeClass('invalid-feedback')
          .addClass('valid-feedback')
          .text('Great!').show('slow');
      } else {
        website.addClass('is-valid')
          .next()
          .addClass('valid-feedback')
          .text('OK!').show('slow');
      }
      setTimeout(function () {
        if (website.hasClass('is-valid')) {
          website.removeClass('is-valid')
            .next().hide('slow');
        }
      }, 5000);
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
        .text('Field can not be empty or leave it like this!');

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
        .text('You can put no more than 999 symbols or leave it like this!');

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
        .text('You need to have more than 50 symbols or leave it like this!');

      setTimeout(function () {
        if (short_introduction.hasClass('is-invalid')) {
          short_introduction.removeClass('is-invalid')
            .next().removeClass('invalid-feedback').hide('slow');
        }
      }, 10000);

      proceed = false;

    } else {
      if (short_introduction.hasClass('is-invalid')) {
        short_introduction.removeClass('is-invalid')
          .addClass('is-valid')
          .next()
          .removeClass('invalid-feedback')
          .addClass('valid-feedback')
          .text('Great!').show('slow');
      } else {
        short_introduction.addClass('is-valid')
          .next()
          .addClass('valid-feedback')
          .text('OK!').show('slow');
      }
      setTimeout(function () {
        if (short_introduction.hasClass('is-valid')) {
          short_introduction.removeClass('is-valid')
            .next().hide('slow');
        }
      }, 5000);
    }

      // AJAX
      if (proceed) {
        $.ajax({
          url: './src/update-employee-profile.php',
          type: 'POST',
          dataType: 'JSON',
          data: {
            last_name: last_name.val(),
            first_name: first_name.val(),
            address: address.val(),
            website: website.val(),
            short_introduction: short_introduction.val()
          },
          success: function (response) {
            $('#success_mess_validation').slideDown('slow').addClass('alert alert-success').text('Update successful!');
            setTimeout(function(){
              $('#success_mess_validation').slideUp('slow');

            }, 2000);

            $('#greetings_first_name').html(`${response.first_name}!`);
            $('#employee_first_name').html(response.first_name);
            $('#employee_last_name').html(response.last_name);
            $('#employee_address').html(response.address);
            $('#employee_website').attr('href', response.website);
            $('#employee_website').html(response.website);
    
            first_name.val(response.first_name);
            last_name.val(response.last_name);
            address.val(response.address);
            website.val(response.website);
            short_introduction.val(response.short_introduction);
          },
          error: function () {
            console.log('error');
          }
        });
      }

  });

 
  
})