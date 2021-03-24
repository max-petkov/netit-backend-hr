$(function() {
 
  // Update Profile
  // To make validation before ajax call for first_name, last_name, address, email & short_description
  $('button[name="submit_update"]').on('click', function(event) {
    event.preventDefault();
    let first_name = $('input[name="employee_first_name"]').val();
    let address = $('input[name="address_employee"]').val();
    $.ajax({
      url: './src/update-profile.php',
      type: 'POST',
      dataType: 'JSON',
      data: {
        first_name: first_name,
        address: address
      },
      success: function(response){
        $('#greetings_first_name').html(response.first_name);
        $('#employee_address').html(response.address);
        
      },
      error: function() {
        console.log('error');
      }

    })
   
  });

  // Fetching json data from json-employee-data.php
    $.ajax({
     url: './src/json-employee-data.php',
     type: 'POST',
     dataType: 'json',
     success: function(response) {
       console.log(response);
       // collapse menu data
       $('#employee_username').text(response.username);
       $('#employee_email').text(response.email);
       $('#employee_first_last_name').text(`${response.first_name} ${response.last_name}`);
       $('#greetings_first_name').append(`${response.first_name}!`);
       $('#employee_address').text(response.address);
       $('#employee_website').text(response.website);
 
       // Edit profile data
       $('input[name="employee_username"]').val(response.username);
       $('input[name="employee_email"]').val(response.email);
       $('input[name="employee_first_name"]').val(response.first_name);
       $('input[name="employee_last_name"]').val(response.last_name);
       $('input[name="address_employee"]').val(response.address);
       $('input[name="website_employee"]').val(response.website);
       $('input[name="short_introduction"]').text(response.short_introduction);
     },
     error: function() {
       console.log('error');
     }
   });
  


})