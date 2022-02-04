$(document).ready(function() {

    $('#firstname').on('input', function() {
        var firstName = $(this).val();
        var validName = /^[a-zA-Z ]*$/;
        if (firstName.length == 0) {
            $('.first-name-msg').addClass('invalid-msg').text("First Name is required");
            $(this).addClass('invalid-input').removeClass('valid-input');

        } else if (!validName.test(firstName)) {
            $('.first-name-msg').addClass('invalid-msg').text('only characters & Whitespace are allowed');
            $(this).addClass('invalid-input').removeClass('valid-input');

        } else {
            $('.first-name-msg').empty();
            $(this).addClass('valid-input').removeClass('invalid-input');
        }
    });

    $('#lastname').on('input', function() {
        var lastName = $(this).val();
        var validName = /^[a-zA-Z ]*$/;
        if (lastName.length == 0) {
            $('.last-name-msg').addClass('invalid-msg').text("Last Name is required");
            $(this).addClass('invalid-input').removeClass('valid-input');

        } else if (!validName.test(lastName)) {
            $('.last-name-msg').addClass('invalid-msg').text('only characters & Whitespace are allowed');
            $(this).addClass('invalid-input').removeClass('valid-input');

        } else {
            $('.last-name-msg').empty();
            $(this).addClass('valid-input').removeClass('invalid-input');
        }
    });
    //   email
    $('#email').on('input', function() {
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

    //   Phone Number validation
    $('#phonenumber').on('input', function() {
        var mobileNum = $(this).val();
        var validNumber = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;
        if (mobileNum.length == 0) {
            $('.mobile-msg').addClass('invalid-msg').text('Mobile Number is required');
            $(this).addClass('invalid-input').removeClass('valid-input');
        } else if (!validNumber.test(mobileNum)) {
            $('.mobile-msg').addClass('invalid-msg').text('Invalid Mobile Number');
            $(this).addClass('invalid-input').removeClass('valid-input');
        } else {
            $('.mobile-msg').empty();
            $(this).addClass('valid-input').removeClass('invalid-input');
        }

    });

    // Password Validation
    $('#password').on('input', function() {
        var password = $(this).val();
        var confirmpassword = $('#confirmpassword').val();
        var uppercasePassword = /(?=.*?[A-Z])/;
        var lowercasePassword = /(?=.*?[a-z])/;
        var digitPassword = /(?=.*?[0-9])/;
        var spacesPassword = /^$|\s+/;
        var symbolPassword = /(?=.*?[#?!@$%^&*-])/;
        var minEightPassword = /.{8,}/;
        if (password.length == 0) {
            $('.password-msg').addClass('invalid-msg').text('Password is required');
            $(this).addClass('invalid-input').removeClass('valid-input');
        } else if (!uppercasePassword.test(password)) {
            $('.password-msg').addClass('invalid-msg').text('At least one Uppercase');
            $(this).addClass('invalid-input').removeClass('valid-input');
        } else if (!lowercasePassword.test(password)) {
            $('.password-msg').addClass('invalid-msg').text('At least one Lowercase');
            $(this).addClass('invalid-input').removeClass('valid-input');
        } else if (!digitPassword.test(password)) {
            $('.password-msg').addClass('invalid-msg').text('At least one digit');
            $(this).addClass('invalid-input').removeClass('valid-input');
        } else if (!symbolPassword.test(password)) {
            $('.password-msg').addClass('invalid-msg').text('At least one special character');
            $(this).addClass('invalid-input').removeClass('valid-input');
        } else if (spacesPassword.test(password)) {
            $('.password-msg').addClass('invalid-msg').text('Whitespaces are not allowed');
            $(this).addClass('invalid-input').removeClass('valid-input');
        } else if (!minEightPassword.test(password)) {
            $('.password-msg').addClass('invalid-msg').text('Minimum length 8');
            $(this).addClass('invalid-input').removeClass('valid-input');
        } else if (confirmpassword.length > 0) {
            if (password != confirmpassword) {
                $('.confirmpassword-msg').addClass('invalid-msg').text('must be matched');
                $('#confirmpassword').addClass('invalid-input').removeClass('valid-input');
            } else {
                $('.confirmpassword-msg').empty();
                $('#confirmpassword').addClass('valid-input').removeClass('invalid-input');
            }
            $('#password').addClass('valid-input').removeClass('invalid-input');
            $('.password-msg').empty();
        } else {
            $('.password-msg').empty();
            $(this).addClass('valid-input').removeClass('invalid-input');
        }
    });
    // valiadtion for Confirm Password
    $('#confirmpassword').on('input', function() {
        var password = $('#password').val();
        var confirmpassword = $(this).val();
        if (confirmpassword.length == 0) {
            $('.confirmpassword-msg').addClass('invalid-msg').text('Confirm password is required');
            $(this).addClass('invalid-input').removeClass('valid-input');
        } else if (confirmpassword != password) {
            $('.confirmpassword-msg').addClass('invalid-msg').text('must be matched');
            $(this).addClass('invalid-input').removeClass('valid-input');
        } else {
            $('.confirmpassword-msg').empty();
            $(this).addClass('valid-input').removeClass('invalid-input');
        }
    });

    // validation to submit the form
    $('input').on('input', function(e) {
        if ($('input[type=checkbox]:checked').length == 1) {
            if ($('#signup').find('.valid-input').length == 6) {
                $('#register_btn').removeAttr('disabled');

            }
        } else {
            e.preventDefault();
            $('#register_btn').attr('disabled', 'disabled')

        }

    });

});