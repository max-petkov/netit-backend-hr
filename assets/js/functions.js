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