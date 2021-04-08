   // Time & Date
   function adding_zeros_time(data) {
     if (data <= 9) {
       data = '0' + data;
     }
     return data;
   }

   function digital_clock() {
     let d = new Date();
     let h = d.getHours();
     let min = d.getMinutes();
     let s = d.getSeconds();
     let m = d.getMonth();
     let date = d.getDate();
     let y = d.getFullYear();
     let date_time = document.getElementById('date_time');
     let month_array = ['Jan', 'Feb', 'March', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Noem', 'Dec'];

     date_time.innerHTML =
       `<p class="mb-0"><b>Today is: </b>${date} ${month_array[m]} ${y}</p> <p class="text-center mb-0">${adding_zeros_time(h)} : ${adding_zeros_time(min)} : ${adding_zeros_time(s)}</p>`;
     setTimeout(digital_clock, 1000);
   }

   digital_clock();

   // Greetings
   let d = new Date();
   let h = d.getHours();
   let greetings = document.getElementById('greetings');

   if (h >= 0 && h <= 11) {
     greetings.innerHTML = 'Good morning, ';

   } else if (h >= 12 && h <= 17) {
     greetings.innerHTML = `Good afternoon, `;

   } else if (h >= 18 && h <= 23) {
     greetings.innerHTML = `Good evening, `;

   }

   // jQuery
   $(function () {

     let message_box = $('.message_box');
     let message_icon = $('.message_icon');
     let application_open = $('#addplication_button');
     let application_box = $('.application_box');
     let profile_open = $('#profile_button');
     let profile_box = $('.profile_box');
     let $publish_job_open = $('#publish_job_button');
     let $publish_job_box = $('.publish_job_box');
     let $hr_open = $('#hr_button');
     let $hr_box = $('.js_hr_box');
     let all_boxes = $('.message_box, .application_box, .profile_box, .publish_job_box, .js-update-publish-job-form, .js_hr_box');

     // Message box 
     message_icon.on({
       'click': function () {
         if (message_box.hasClass('d-none')) {
           message_box.removeClass('d-none').animate({
             right: '32px',
             opacity: '1'
           }, 'fast');
         }
       },

       'mouseenter': function () {
         $(this).find('#envelope_close').addClass('d-none');
         $(this).find('#envelope_open').removeClass('d-none');
       },

       'mouseleave': function () {
         $(this).find('#envelope_open').addClass('d-none');
         $(this).find('#envelope_close').removeClass('d-none');
       },


     });

     // Text expanding on message
     $('.chevron-expand-text').slideUp();

     $('.chevron_btn').on('click', function () {

       $(this).find('span').toggleClass('chevron-animation-open');

       $(this).next().slideToggle();

     });

     // Application box
     application_open.on('click', function () {
       if (application_box.hasClass('d-none')) {
         application_box.removeClass('d-none').animate({
           right: '32px',
           opacity: '1'
         }, 'fast');
         $('#applied_job_container').load('employee-dashboard.php .applied_job_data');
       }
     });

     // Profile box
     profile_open.on('click', function () {
       if (profile_box.hasClass('d-none')) {
         profile_box.removeClass('d-none').animate({
           right: '32px',
           opacity: '1'
         }, 'fast');
       }
     });

     // Publish job box
     $publish_job_open.on('click', function () {
       if ($publish_job_box.hasClass('d-none')) {
         $publish_job_box.removeClass('d-none').animate({
           right: '32px',
           opacity: '1'
         }, 'fast');
       }
     });

     // HR box
     $hr_open.on('click', function () {
       if ($hr_box.hasClass('d-none')) {
         $hr_box.removeClass('d-none').animate({
           right: '32px',
           opacity: '1'
         }, 'fast');
       }
     });

     // Close app, mess, profile on clicking the X
     $('.btn-close').on('click', function () {
       (all_boxes).animate({
         right: '-544px',
         opacity: '0'
       }, 'slow', function () {
         $(this).addClass('d-none');
       })
     });


     // Close mess, app, profile boxes when clicking outside
     $(document).on('mouseup', function (e) {
       if (!$(e.target).closest(all_boxes).length && all_boxes.is(':visible')) {
         all_boxes.animate({
           right: '-544px',
           opacity: '0'
         }, 'slow', function () {
           $(this).addClass('d-none');
         });
       }
     });

     // If there are no results on employee-dashboard published jobs
     if ($('#published_job_list li').length === 0) {
       $('#published_job_list').html(`<h6>There are no published jobs...</h6>`);
     }

    // Bootstrap 5 tooltip FIY-> data-bs-animation="false" will prevent from dissapering the tooltip after multiple hovers
    $('[data-bs-toggle="tooltip"]').tooltip('enable', {boundary: 'window'});

     
   })