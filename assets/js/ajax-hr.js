$(function(){
  // Getting response after interview
  $('.js-applicants-data').on('click', '.js-interview-answer', function(){
    $btn_answer = $(this);
    if ($btn_answer.val() === 'Y') {
      $btn_answer.closest('#is_interviewed').html('OK!');
    }
    if ($btn_answer.val() === 'N') {
      $btn_answer.closest('#is_interviewed').html('NOPE');
    }
  });

})