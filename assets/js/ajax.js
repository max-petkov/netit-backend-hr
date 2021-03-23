$(function() {

  // Getting and putting values from table employee
  $.ajax({
    url: 'src/json-employee-data.php',
    type: 'POST',
    dataType: 'json',
    success: function(response) {
      console.log(response);
      $('#employee_username').text(response.username);
      $('#employee_email').text(response.email);
      $('#employee_first_last_name').text(`${response.first_name} ${response.last_name}`);
      $('#greetings').append(`${response.first_name}!`);
      
    },
    error: function() {
      console.log('error');
    }
  })

})