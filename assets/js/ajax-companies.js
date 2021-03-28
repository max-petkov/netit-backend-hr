
$(function () {

  // Update Company profile 
  $('#update_company_profile').on('click', function (event) {
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

    } else {
      if (company_name.hasClass('is-invalid')) {
        company_name.removeClass('is-invalid')
          .addClass('is-valid')
          .next()
          .removeClass('invalid-feedback')
          .addClass('valid-feedback')
          .text('Great!').show('slow');
      } else {
        company_name.addClass('is-valid')
          .next()
          .addClass('valid-feedback')
          .text('OK!').show('slow');
      }
      setTimeout(function () {
        if (company_name.hasClass('is-valid')) {
          company_name.removeClass('is-valid')
            .next().hide('slow');
        }
      }, 5000);
    }

    // SLOGAN
    if (slogan.val().trim().length > 49) {
      slogan.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback')
        .text('You need to put atleast 4 symbols and no more than 50!');
      proceed = false;

    } else {
      if (slogan.hasClass('is-invalid')) {
        slogan.removeClass('is-invalid')
          .addClass('is-valid')
          .next()
          .removeClass('invalid-feedback')
          .addClass('valid-feedback')
          .text('Great!').show('slow');
      } else {
        slogan.addClass('is-valid')
          .next()
          .addClass('valid-feedback')
          .text('OK!').show('slow');
      }
      setTimeout(function () {
        if (slogan.hasClass('is-valid')) {
          slogan.removeClass('is-valid')
            .next().hide('slow');
        }
      }, 5000);
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

    
    // IT BRANCHES
    // Checking how many checkboxes are checked with length 
    if ($('.checkbox_length:checked').length === 0) {
      $('#checkbox_response').append(`<span class="text-danger">You need to select atleast one branch!<span>`);
      proceed = false;
    } else{
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

    } else if (company_description.val().length > 499) {
      company_description.val();

      company_description.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback')
        .text('You need to put less than 500 symbols!');

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

    } else {
      if (company_description.hasClass('is-invalid')) {
        company_description.removeClass('is-invalid')
          .addClass('is-valid')
          .next()
          .removeClass('invalid-feedback')
          .addClass('valid-feedback')
          .text('Great!').show('slow');
      } else {
        company_description.addClass('is-valid')
          .next()
          .addClass('valid-feedback')
          .text('OK!').show('slow');
      }
      setTimeout(function () {
        if (company_description.hasClass('is-valid')) {
          company_description.removeClass('is-valid')
            .next().hide('slow');
        }
      }, 5000);
    }

    // COMPANY HISTORY
    if (company_history.val().length > 499) {


      company_history.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback')
        .text('You need to put less than 500 symbols!');

      setTimeout(function () {
        if (company_history.hasClass('is-invalid')) {
          company_history.removeClass('is-invalid')
            .next().removeClass('invalid-feedback').hide('slow');
        }
      }, 10000);

      proceed = false;

    } else {
      if (company_history.hasClass('is-invalid')) {
        company_history.removeClass('is-invalid')
          .addClass('is-valid')
          .next()
          .removeClass('invalid-feedback')
          .addClass('valid-feedback')
          .text('Great!').show('slow');
      } else {
        company_history.addClass('is-valid')
          .next()
          .addClass('valid-feedback')
          .text('OK!').show('slow');
      }
      setTimeout(function () {
        if (company_history.hasClass('is-valid')) {
          company_history.removeClass('is-valid')
            .next().hide('slow');
        }
      }, 5000);
    }

    // COMPANY MISSION
    if (company_mission.val().length > 254) {

      company_mission.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback')
        .text('You need to put less than 255 symbols!');

      setTimeout(function () {
        if (company_mission.hasClass('is-invalid')) {
          company_mission.removeClass('is-invalid')
            .next().removeClass('invalid-feedback').hide('slow');
        }
      }, 10000);

      proceed = false;

    } else {
      if (company_mission.hasClass('is-invalid')) {
        company_mission.removeClass('is-invalid')
          .addClass('is-valid')
          .next()
          .removeClass('invalid-feedback')
          .addClass('valid-feedback')
          .text('Great!').show('slow');
      } else {
        company_mission.addClass('is-valid')
          .next()
          .addClass('valid-feedback')
          .text('OK!').show('slow');
      }
      setTimeout(function () {
        if (company_mission.hasClass('is-valid')) {
          company_mission.removeClass('is-valid')
            .next().hide('slow');
        }
      }, 5000);
    }

    // AJAX
    if (proceed) {
      $.ajax({
        url: './src/update-company-profile.php',
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

          if (response.frontend_branch !== '') {
            $('#frontend_badge').addClass('badge bg-secondary').html(response.frontend_branch);
            $('#frontend_checked_status').prop('checked', true);
          } else {
            $('#frontend_badge').removeClass('badge bg-secondary').html('');
            
          }
          if (response.backend_branch !== '') {
            $('#backend_badge').addClass('badge bg-dark').html(response.backend_branch);
            $('#backend_checked_status').prop('checked', true);
          }else {
            $('#backend_badge').removeClass('badge bg-dark').html('');
          }
          if (response.fullstack_branch !== '') {
            $('#fullstack_badge').addClass('badge bg-success').html(response.fullstack_branch);
            $('#fullstack_checked_status').prop('checked', true);
          }else {
            $('#fullstack_badge').removeClass('badge bg-success').html('');
          }
          if (response.qa_branch !== '') {
            $('#qa_badge').addClass('badge bg-danger').html(response.qa_branch);
            $('#qa_checked_status').prop('checked', true);
          } else {
            $('#qa_badge').removeClass('badge bg-danger').html('');
          }
          if (response.mobdev_branch !== '') {
            $('#mobdev_badge').addClass('badge bg-warning').html(response.mobdev_branch);
            $('#mobdev_checked_status').prop('checked', true);
          } else {
            $('#mobdev_badge').removeClass('badge bg-warning').html('');
          }
          if (response.ux_ui_branch !== '') {
            $('#ux_ui_badge').addClass('badge bg-primary').html(response.ux_ui_branch);
            $('#ux_ui_checked_status').prop('checked', true);
          } else {
            $('#ux_ui_badge').removeClass('badge bg-primary').html('');
          }

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

  // Fetching json data from json-company-data.php
  $.ajax({
    url: 'src/json-company-data.php',
    dataType: 'json',
    success: function (response) {
      console.log(response);
      // collapse menu data
      $('#company_username').text(response.username);
      $('#company_email').text(response.email);
      $('#company_name').text(response.company_name);
      $('#greetings_company_name').append(`${response.company_name}!`);
      $('#company_address').text(response.address);
      $('#company_website').text(response.website);
      $('#company_website').attr('href', response.website);
      $('#showcase_company_name').text(response.company_name);
      $('#showcase_company_description').text(response.company_description);
      $('#showcase_company_slogan').text(response.slogan);
      $('#showcase_company_history').text(response.company_history);
      $('#showcase_company_mission').text(response.company_mission);

      if (response.frontend_branch !== '' && response.frontend_branch !== null) {
        $('#frontend_badge').addClass('badge bg-secondary').html(response.frontend_branch);
        $('#frontend_checked_status').prop('checked', true);
      }
      if (response.backend_branch !== '' && response.backend_branch !== null) {
        $('#backend_badge').addClass('badge bg-dark').html(response.backend_branch);
        $('#backend_checked_status').prop('checked', true);
      }
      if (response.fullstack_branch !== '' && response.fullstack_branch !== null) {
        $('#fullstack_badge').addClass('badge bg-success').html(response.fullstack_branch);
        $('#fullstack_checked_status').prop('checked', true);
      }
      if (response.qa_branch !== '' && response.qa_branch !== null) {
        $('#qa_badge').addClass('badge bg-danger').html(response.qa_branch);
        $('#qa_checked_status').prop('checked', true);
      }
      if (response.mobdev_branch !== '' && response.mobdev_branch !== null) {
        $('#mobdev_badge').addClass('badge bg-warning').html(response.mobdev_branch);
        $('#mobdev_checked_status').prop('checked', true);
      }
      if (response.ux_ui_branch !== '' && response.ux_ui_branch !== null) {
        $('#ux_ui_badge').addClass('badge bg-primary').html(response.ux_ui_branch);
        $('#ux_ui_checked_status').prop('checked', true);
      }

      // Edit profile data
      $('input[name="company_username"]').val(response.username);
      $('input[name="company_email"]').val(response.email);
      $('input[name="company_name"]').val(response.company_name);
      $('input[name="company_address"]').val(response.address);
      $('input[name="company_website"]').val(response.website);
      $('textarea[name="company_description"]').val(response.company_description);
      $('textarea[name="company_history"]').val(response.company_history);
      $('textarea[name="company_mission"]').val(response.company_mission);
      $('input[name="company_slogan"]').val(response.slogan);
    },
    error: function (jqXHR, text, errorThrown) {
      console.log(jqXHR + " " + text + " " + errorThrown);
    }

  });
});