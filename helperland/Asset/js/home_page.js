$(document).ready(function() {
    $('#button').click(function() {
        $('.footer-policy').hide();
    });

});


$(document).ready(function() {

    if (window.location.href.indexOf('#loginform') != -1) {

        $('#loginform').modal('show');

        $('#loginform .close').click(function() {
            window.location.href = "";
        });

    }
    if (window.location.href.indexOf('#forgotform') != -1) {
        $('#forgotform').modal('show');
    }

});


$(document).ready(function() {
    //   Login email
    $('#loginemail').on('input', function() {
        var emailAddress = $(this).val();
        var validEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (emailAddress.length == 0) {
            $('.email-msg').addClass('invalid-msg').text('Email is required');
            $(this).addClass('invalid-input').removeClass('valid-input');
        } else if (!validEmail.test(emailAddress)) {
            $('.email-msg').addClass('invalid-msg').text('Invalid Email Address');
            $(this).addClass('invalid-input').removeClass('valid-input');
        } else {
            $('.email-msg').empty();
            $(this).addClass('valid-input').removeClass('invalid-input');
        }

    });
});



$(document).ready(function() {
    // Forgot email verification
    $('#forgotemail').on('input', function() {
        var emailAddress = $(this).val();
        var validEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (emailAddress.length == 0) {
            $('.email-msg').addClass('invalid-msg').text('Email is required');
            $(this).addClass('invalid-input').removeClass('valid-input');
        } else if (!validEmail.test(emailAddress)) {
            $('.email-msg').addClass('invalid-msg').text('Invalid Email Address');
            $(this).addClass('invalid-input').removeClass('valid-input');
        } else {
            $('.email-msg').empty();
            $(this).addClass('valid-input').removeClass('invalid-input');
        }

    });
});