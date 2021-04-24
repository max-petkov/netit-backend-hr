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
    $element.slideDown('slow').addClass('alert alert-success').text('Update successful!');
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
    $success_msg.slideDown('slow').addClass('alert alert-success').text('Apply successful!');
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