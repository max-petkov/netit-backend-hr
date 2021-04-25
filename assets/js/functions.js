function empty($val) {
    if (!$val.val().trim()) {
        return true;
    }
}

function string_length($val, $min, $max) {
    if ($val.val().trim().length < $min || $val.val().trim().length > $max) {
        return true;
    }
}

function no_match($val, $regex) {
    if (!$val.val().trim().match($regex)) {
        return true;
    }
}

function checkbox_radio_length($element_length) {
    if ($element_length.length === 0) {
        return true;
    }
}

function match_password($pass, $conf_pass) {
    if ($pass.val().trim() !== $conf_pass.val().trim()) {
        return true;
    }
}

function checkbox_radio_invalid_response($element, $text) {
    $element.addClass('text-danger').text($text);
}

function invalid_response($element, $response) {
    $element.addClass('is-invalid')
        .next()
        .addClass('invalid-feedback').text($response);
}

function valid_response($element) {
    $element.removeClass('is-invalid').addClass('is-valid')
        .next()
        .text('');
    setTimeout(function () {
        $element.removeClass('is-valid')
    }, 2000);
}

function success_call($element) {
    $element.slideDown('slow').addClass('alert alert-success').text('Success!');
    setTimeout(function () {
        $element.slideUp('slow');
    }, 2000);
}

function remove_element($element, $load_ajax) {
    $element.fadeOut('slow', function () {
        $element.remove();
        $load_ajax;
    });
}

function success_mot_speech($success_msg, $mot_speech) {
    $success_msg.slideDown('slow').addClass('alert alert-success').text('Success!');
    setTimeout(function () {
        $success_msg.slideUp('slow', function () {
            $mot_speech.animate({
                right: '-544px',
                opacity: '0'
            }, 'slow', function () {
                $mot_speech.addClass('d-none');
            });
        });
    }, 2000);
}

function success_send_msg($success_msg, $msg_box, $btn, $send_btns, $ajax_load) {
    $success_msg.slideDown('slow').addClass('alert alert-success').text('Message send successful!');
    setTimeout(function () {
        $success_msg.slideUp('slow', function () {
            $msg_box.slideUp('slow', function () {
                $send_btns.removeClass('disabled');
                $btn.removeClass('disabled').html(`<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1 bi bi-reply" viewBox="0 0 16 16">
              <path d="M6.598 5.013a.144.144 0 0 1 .202.134V6.3a.5.5 0 0 0 .5.5c.667 0 2.013.005 3.3.822.984.624 1.99 1.76 2.595 3.876-1.02-.983-2.185-1.516-3.205-1.799a8.74 8.74 0 0 0-1.921-.306 7.404 7.404 0 0 0-.798.008h-.013l-.005.001h-.001L7.3 9.9l-.05-.498a.5.5 0 0 0-.45.498v1.153c0 .108-.11.176-.202.134L2.614 8.254a.503.503 0 0 0-.042-.028.147.147 0 0 1 0-.252.499.499 0 0 0 .042-.028l3.984-2.933zM7.8 10.386c.068 0 .143.003.223.006.434.02 1.034.086 1.7.271 1.326.368 2.896 1.202 3.94 3.08a.5.5 0 0 0 .933-.305c-.464-3.71-1.886-5.662-3.46-6.66-1.245-.79-2.527-.942-3.336-.971v-.66a1.144 1.144 0 0 0-1.767-.96l-3.994 2.94a1.147 1.147 0 0 0 0 1.946l3.994 2.94a1.144 1.144 0 0 0 1.767-.96v-.667z" />
              </svg>
              Send Message`);
                $msg_box.addClass('d-none');
                $('.js-expand-text').slideUp();
            });
        });
    }, 2000);
    $ajax_load;
}

function success_reply_msg($success_msg, $msg_box, $btn, $send_btns, $ajax_load) {
    $success_msg.slideDown('slow').addClass('alert alert-success').text('Message send successful!');
    setTimeout(function () {
        $success_msg.slideUp('slow', function () {
            $msg_box.slideUp('slow', function () {
                $send_btns.removeClass('disabled');
                $btn.removeClass('disabled').html(`Reply<svg class="ms-1" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 16.987 16.557">
                <g id="send" transform="translate(0 -6.196)">
                  <g id="Group_216" data-name="Group 216" transform="translate(0 6.197)">
                    <path id="Path_22" data-name="Path 22" d="M16.809,13.7a1.78,1.78,0,0,0-.826-.826L2.556,6.375A1.78,1.78,0,0,0,.128,8.638l2.335,5.836L.128,20.311a1.78,1.78,0,0,0,2.428,2.264l13.427-6.5A1.78,1.78,0,0,0,16.809,13.7ZM2.039,21.505a.593.593,0,0,1-.809-.755L3.5,15.067H15.344ZM3.5,13.881,1.23,8.2a.593.593,0,0,1,.809-.753l13.305,6.436H3.5Z" transform="translate(0 -6.197)" fill="#fff" />
                  </g>
                </g>
              </svg>`);
                $msg_box.addClass('d-none');
                $('.js-expand-text').slideUp();
            });
        });
    }, 2000);
    $ajax_load;
}

function nav_msg_scs($msg_box, $success_msg, $ajax_load) {
    $success_msg.slideDown('slow').addClass('alert alert-success').text('Apply successful!');
    setTimeout(function () {
        $success_msg.slideUp('slow', function () {
            $msg_box.animate({
                right: '-544px',
                opacity: '0'
            }, 'slow', function () {
                $msg_box.addClass('d-none');
            });
        });
        $('.js-expand-text').slideUp();
    }, 2000);
    $ajax_load;
}

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

function greetings() {
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
}
greetings();

function show_box_lg_screen($trigger_btn, $box) {
    $trigger_btn.on('click', function () {
        if ($box.hasClass('d-none')) {
            $box.removeClass('d-none').animate({
                right: '32px',
                opacity: '1'
            }, 'fast', function () {
                if ($box.height() > 768) {
                    $box.addClass('js-h-600px js-overflow-y-scroll');
                }
            });
        }
    });
}

function show_box_sm_screen($trigger_btn, $box) {
    $trigger_btn.on('click', function () {
        if ($box.hasClass('d-none')) {
            $box.removeClass('d-none').animate({
                right: '1px',
                opacity: '1'
            }, 'fast', function () {
                if ($box.height() > 768) {
                    $box.addClass('js-h-600px js-overflow-y-scroll');
                }
            });
        }
    });
}