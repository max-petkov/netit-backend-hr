$(function () {
  
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
      if (response.frontend_branch !== null) {
        $('#showcase_it_branches').append(`<span class="badge bg-secondary me-2">${response.frontend_branch}</span>`);
      }
      if (response.backend_branch !== null) {
        $('#showcase_it_branches').append(`<span class="badge bg-dark me-2">${response.backend_branch}</span>`);
      }
      if (response.fullstack_branch !== null) {
        $('#showcase_it_branches').append(`<span class="badge bg-success me-2">${response.fullstack_branch}</span>`);
      }
      if (response.qa_branch !== null) {
        $('#showcase_it_branches').append(`<span class="badge bg-danger me-2">${response.qa_branch}</span>`);
      }
      if (response.mobdev_branch !== null) {
        $('#showcase_it_branches').append(`<span class="badge bg-warning me-2">${response.mobdev_branch}</span>`);
      }
      if (response.ux_ui_branch !== null) {
        $('#showcase_it_branches').append(`<span class="badge bg-primary me-2">${response.ux_ui_branch}</span>`);
      }

      // Edit profile data
      $('input[name="company_username"]').val(response.username);
      $('input[name="company_email"]').val(response.email);
      $('input[name="company_name"]').val(response.company_name);
      $('input[name="company_address"]').val(response.address);
      $('input[name="company_website"]').val(response.website);
      $('textarea[name="company_description"]').val(response.company_description);
      $('textarea[name="company_slogan"]').val(response.slogan);
      $('textarea[name="company_history"]').val(response.company_history);
      $('textarea[name="company_mission"]').val(response.company_mission);
    },
    error: function (jqXHR, text, errorThrown) {
      console.log(jqXHR + " " + text + " " + errorThrown);
  }

  });
});