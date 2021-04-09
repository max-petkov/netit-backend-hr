$(function () {
  // Getting response after interview
  $('.js-applicants-data').on('click', '.js-interview-answer', function () {
    $btn_answer = $(this);
    if ($btn_answer.val() === 'Y') {
      $btn_answer.closest('.d-flex').fadeOut('slow', function () {
        $btn_answer.closest('#is_interviewed')
          .html(`<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-check2-circle text-success" viewBox="0 0 16 16">
        <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
        <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
      </svg>`);
      })
    }
    if ($btn_answer.val() === 'N') {
      $btn_answer.closest('.d-flex').fadeOut('slow', function () {
        $btn_answer.closest('#is_interviewed')
          .html(`<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-x-circle text-danger" viewBox="0 0 16 16">
          <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
          <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
        </svg>`);
      })
    }
  });

  // Getting response after approve
  $('.js-applicants-data').on('click', '.js-approve-answer', function () {
    $btn_answer = $(this);
    $btn_confirm_answer = $btn_answer.closest('.d-flex').next();

    if ($btn_answer.val() === 'Y') {
      $btn_confirm_answer.animate({
        right: '32px',
        opacity: '1'
      }, 'fast', function () {
        $btn_confirm_answer.addClass('card border-primary shadow rounded')
          .html(`<div class="card-body">
        <h5 class="mb-3">Candidate will go into <u>approved</u> tab! Do you want to proceed?</h5>
        <button id="approve_candidate" class="btn btn-primary btn-sm" value="Y">Yes, proceed!</button>
        <button id="close_confirm_approve_box" class="btn btn-secondary btn-sm" value="N">Close</button>
        </div>`);
      });

      $btn_confirm_answer.on('click', '#approve_candidate', function () {
        $(this).closest('.js-applicants-data').fadeOut('slow', function () {
          $(this).closest('#is_approved').remove();
        })
      });

      $btn_confirm_answer.on('click', '#close_confirm_approve_box', function () {
        $(this).closest('.js-confirm-approve').animate({
          right: '-544px',
          opacity: '0'
        }, 'fast');
      });
    }

    if ($btn_answer.val() === 'N') {
      $btn_confirm_answer.animate({
        right: '32px',
        opacity: '1'
      }, 'fast', function () {
        $btn_confirm_answer.addClass('card border-primary shadow rounded')
          .html(`<div class="card-body">
        <h5 class="mb-3">Candidate will go into <u>disapproved</u> tab! Do you want to proceed?</h5>
        <button id="approve_candidate" class="btn btn-primary btn-sm" value="Y">Yes, proceed!</button>
        <button id="close_confirm_approve_box" class="btn btn-secondary btn-sm" value="N">Close</button>
        </div>`);
      });

      $btn_confirm_answer.on('click', '#approve_candidate', function () {
        $(this).closest('.js-applicants-data').fadeOut('slow', function () {
          $(this).closest('#is_approved').remove();
        })
      });

      $btn_confirm_answer.on('click', '#close_confirm_approve_box', function () {
        $(this).closest('.js-confirm-approve').animate({
          right: '-544px',
          opacity: '0'
        }, 'fast');
      });
    }

  });
})