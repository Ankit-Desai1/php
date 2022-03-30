function upcoming_service(evt, service) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(service).style.display = "block";
    evt.currentTarget.className += " active";
}


$(document).ready(function() {
    var vtab_id = 'dashboardtab_btn';
    var temp_url = new URLSearchParams(window.location.search);
    var new_url = temp_url.toString();
    if (new_url.includes('tablinks=')) {
        var hashtag = new_url.lastIndexOf('=');
        vtab_id = new_url.substring(hashtag + 1, new_url.length);
    }
    document.getElementById(vtab_id).click();
});

document.getElementById('export').addEventListener('click', () => {

    var type = 'xlsx';
    var data = document.getElementById('service_history_table');
    var file = XLSX.utils.table_to_book(data, { sheet: "sheet1" });
    XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });
    XLSX.writeFile(file, 'ServiceHistory.' + type);
});

$(document).ready(function() {

    $("#selected_date").datepicker({
        dateFormat: "yy/mm/dd",
        minDate: "+1d"
    });

});



$(document).ready(function() {

    $(".fa-star").css("color", "silver");

    $("#rate_serviceprovider").hover(function() {
        $("#ontime1").hover(function() {
            $("#ontime2,#ontime3,#ontime4,#ontime5").css("color", "silver");
            $("#ontime1").css("color", "#ECB91C");
            $(".infomsg").text("1");
        });
        $("#ontime2").hover(function() {
            $("#ontime3,#ontime4,#ontime5").css("color", "silver");
            $("#ontime1,#ontime2").css("color", "#ECB91C");
            $(".infomsg").text("2");
        });
        $("#ontime3").hover(function() {
            $("#ontime4,#ontime5").css("color", "silver");
            $("#ontime1,#ontime2,#ontime3").css("color", "#ECB91C");
            $(".infomsg").text("3");
        });

        $("#ontime4").hover(function() {
            $("#ontime5").css("color", "silver");
            $("#ontime1,#ontime2,#ontime3,#ontime4").css("color", "#ECB91C");
            $(".infomsg").text("4");
        });

        $("#ontime5").hover(function() {
            $("#ontime1,#ontime2,#ontime3,#ontime4,#ontime5").css("color", "#ECB91C");
            $(".infomsg").text("5");
        });

        $("#friendly1").hover(function() {
            $("#friendly2,#friendly3,#friendly4,#friendly5").css("color", "silver");
            $("#friendly1").css("color", "#ECB91C");
            $(".friendlymsg").text("1");
        });
        $("#friendly2").hover(function() {
            $("#friendly3,#friendly4,#friendly5").css("color", "silver");
            $("#friendly1,#friendly2").css("color", "#ECB91C");
            $(".friendlymsg").text("2");
        });
        $("#friendly3").hover(function() {
            $("#friendly4,#friendly5").css("color", "silver");
            $("#friendly1,#friendly2,#friendly3").css("color", "#ECB91C");
            $(".friendlymsg").text("3");
        });

        $("#friendly4").hover(function() {
            $("#friendly5").css("color", "silver");
            $("#friendly1,#friendly2,#friendly3,#friendly4").css("color", "#ECB91C");
            $(".friendlymsg").text("4");
        });

        $("#friendly5").hover(function() {
            $("#friendly1,#friendly2,#friendly3,#friendly4,#friendly5").css("color", "#ECB91C");
            $(".friendlymsg").text("5");
        });

        $("#quality1").hover(function() {
            $("#quality2,#quality3,#quality4,#quality5").css("color", "silver");
            $("#quality1").css("color", "#ECB91C");
            $(".qualitymsg").text("1");
            $(".qualitymsg").val("1");
        });
        $("#quality2").hover(function() {
            $("#quality3,#quality4,#quality5").css("color", "silver");
            $("#quality1,#quality2").css("color", "#ECB91C");
            $(".qualitymsg").text("2");
            $(".qualitymsg").val("2");
        });
        $("#quality3").hover(function() {
            $("#quality4,#quality5").css("color", "silver");
            $("#quality1,#quality2,#quality3").css("color", "#ECB91C");
            $(".qualitymsg").text("3");
            $(".qualitymsg").val("3");
        });

        $("#quality4").hover(function() {
            $("#quality5").css("color", "silver");
            $("#quality1,#quality2,#quality3,#quality4").css("color", "#ECB91C");
            $(".qualitymsg").text("4");
            $(".qualitymsg").val("4");
        });

        $("#quality5").hover(function() {
            $("#quality1,#quality2,#quality3,#quality4,#quality5").css("color", "#ECB91C");
            $(".qualitymsg").text("5");
            $(".qualitymsg").val("5");
        });
    });


    $("#rate_serviceprovider").on("click", function() {
        $(".ratingfortimearrival").on("click", function() {

            $("#ontime1").click(function() {
                $("#ontime2,#ontime3,#ontime4,#ontime5").css("color", "silver");
                $("#ontime1").css("color", "#ECB91C");
                $(".infomsg").text("1");
            });
            $("#ontime2").click(function() {
                $("#ontime3,#ontime4,#ontime5").css("color", "silver");
                $("#ontime1,#ontime2").css("color", "#ECB91C");
                $(".infomsg").text("2");
            });
            $("#ontime3").click(function() {
                $("#ontime4,#ontime5").css("color", "silver");
                $("#ontime1,#ontime2,#ontime3").css("color", "#ECB91C");
                $(".infomsg").text("3");
            });

            $("#ontime4").click(function() {
                $("#ontime5").css("color", "silver");
                $("#ontime1,#ontime2,#ontime3,#ontime4").css("color", "#ECB91C");
                $(".infomsg").text("4");
            });

            $("#ontime5").click(function() {
                $("#ontime1,#ontime2,#ontime3,#ontime4,#ontime5").css("color", "#ECB91C");
                $(".infomsg").text("5");
            });

        });

        $(".ratingforfriendly").on("click", function() {

            $("#friendly1").click(function() {
                $("#friendly2,#friendly3,#friendly4,#friendly5").css("color", "silver");
                $("#friendly1").css("color", "#ECB91C");
                $(".friendlymsg").text("1");
            });
            $("#friendly2").click(function() {
                $("#friendly3,#friendly4,#friendly5").css("color", "silver");
                $("#friendly1,#friendly2").css("color", "#ECB91C");
                $(".friendlymsg").text("2");
            });
            $("#friendly3").click(function() {
                $("#friendly4,#friendly5").css("color", "silver");
                $("#friendly1,#friendly2,#friendly3").css("color", "#ECB91C");
                $(".friendlymsg").text("3");
            });

            $("#friendly4").click(function() {
                $("#friendly5").css("color", "silver");
                $("#friendly1,#friendly2,#friendly3,#friendly4").css("color", "#ECB91C");
                $(".friendlymsg").text("4");
            });

            $("#friendly5").click(function() {
                $("#friendly1,#friendly2,#friendly3,#friendly4,#friendly5").css("color", "#ECB91C");
                $(".friendlymsg").text("5");
            });
        });
        $(".ratingforquality").on("click", function() {

            $("#quality1").click(function() {
                $("#quality2,#quality3,#quality4,#quality5").css("color", "silver");
                $("#quality1").css("color", "#ECB91C");
                $(".qualitymsg").text("1");
                $(".qualitymsg").val("1");
            });
            $("#quality2").click(function() {
                $("#quality3,#quality4,#quality5").css("color", "silver");
                $("#quality1,#quality2").css("color", "#ECB91C");
                $(".qualitymsg").text("2");
                $(".qualitymsg").val("2");
            });
            $("#quality3").click(function() {
                $("#quality4,#quality5").css("color", "silver");
                $("#quality1,#quality2,#quality3").css("color", "#ECB91C");
                $(".qualitymsg").text("3");
                $(".qualitymsg").val("3");
            });

            $("#quality4").click(function() {
                $("#quality5").css("color", "silver");
                $("#quality1,#quality2,#quality3,#quality4").css("color", "#ECB91C");
                $(".qualitymsg").text("4");
                $(".qualitymsg").val("4");
            });

            $("#quality5").click(function() {
                $("#quality1,#quality2,#quality3,#quality4,#quality5").css("color", "#ECB91C");
                $(".qualitymsg").text("5");
                $(".qualitymsg").val("5");
            });


        });
    })
});



$(document).ready(function() {

    // Street Validation
    $('#streetname').on('input', function() {
        var lastName = $(this).val();
        var validName = /^[a-zA-Z]*$/;;
        if (lastName.length == 0) {
            $('.street-msg2').addClass('invalid-msg').text("Street is required");
            $(this).addClass('invalid-input').removeClass('valid-input');

        } else if (!validName.test(lastName)) {
            $('.street-msg2').addClass('invalid-msg').text('White Space and Number Are not Allowed');
            $(this).addClass('invalid-input').removeClass('valid-input');
        } else {
            $('.street-msg2').empty();
            $(this).addClass('valid-input').removeClass('invalid-input');
        }
    });

    //   city validation
    $('#city').on('input', function() {
        var city = $(this).val();
        var validName = /^[a-zA-Z]*$/;;
        if (city.length == 0) {
            $('.city-msg2').addClass('invalid-msg').text("Street is required");
            $(this).addClass('invalid-input').removeClass('valid-input');

        } else if (!validName.test(city)) {
            $('.city-msg2').addClass('invalid-msg').text('White Space and Number Are not Allowed');
            $(this).addClass('invalid-input').removeClass('valid-input');
        } else {
            $('.city-msg2').empty();
            $(this).addClass('valid-input').removeClass('invalid-input');
        }
    });

    //   Phone Number validation
    $('#mobile').on('input', function() {
        var mobileNum = $(this).val();
        var validNumber = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;
        if (mobileNum.length == 0) {
            $('.mobile-msg2').addClass('invalid-msg').text('Mobile Number is required');
            $(this).addClass('invalid-input').removeClass('valid-input');
        } else if (!validNumber.test(mobileNum)) {
            $('.mobile-msg2').addClass('invalid-msg').text('Invalid Mobile Number');
            $(this).addClass('invalid-input').removeClass('valid-input');
        } else {
            $('.mobile-msg2').empty();
            $(this).addClass('valid-input').removeClass('invalid-input');
        }
    });
    // Postal Code Validation
    $('#pincode').on('input', function() {

        if ($.trim($('#pincode').val()).length == 0) {
            $(this).addClass('invalid-input').removeClass('valid-input');
            $('.postal_number2').addClass('invalid-msg').text("Postal Code is Required");
        } else if ($.trim($('#pincode').val()).length != 6) {
            $(this).addClass('invalid-input').removeClass('valid-input');
            $('.postal_number2').addClass('invalid-msg').text("Enter Valid Postal Code");
        } else {
            $('.postal_number2').empty();
            $(this).addClass('valid-input').removeClass('invalid-input');
        }
    });
    //   house Number validation
    $('#housenumber').on('input', function() {
        var houseNum = $(this).val();
        var validNumber = /^\d*$/;
        if (houseNum.length == 0) {
            $('.house-msg2').addClass('invalid-msg').text('House Number is required');
            $(this).addClass('invalid-input').removeClass('valid-input');
        } else if (!validNumber.test(houseNum)) {
            $('.house-msg2').addClass('invalid-msg').text('Enter Valid House Number');
            $(this).addClass('invalid-input').removeClass('valid-input');
        } else {
            $('.house-msg2').empty();
            $(this).addClass('valid-input').removeClass('invalid-input');
        }
    });

    // validation to submit the form
    $('#add_newaddress_model').on('input', function(e) {

        if ($('#add_newaddress_model').find('.invalid-input').length > 0) {

            $('#add_new_address').prop('disabled', true);
            $('#add_new_address').css('cursor', 'not-allowed');
        } else {
            $('#add_new_address').prop('disabled', false);
            $('#add_new_address').css('cursor', 'pointer');
        }

    });

});






$(document).ready(function() {

    // Street Validation
    $('#street_name').on('input', function() {
        var lastName = $(this).val();
        var validName = /^[a-zA-Z]*$/;;
        if (lastName.length == 0) {
            $('.street-msg').addClass('invalid-msg').text("Street is required");
            $(this).addClass('invalid-input').removeClass('valid-input');

        } else if (!validName.test(lastName)) {
            $('.street-msg').addClass('invalid-msg').text('White Space and Number Are not Allowed');
            $(this).addClass('invalid-input').removeClass('valid-input');
        } else {
            $('.street-msg').empty();
            $(this).addClass('valid-input').removeClass('invalid-input');
        }
    });

    //   city validation
    $('#location').on('input', function() {
        var city = $(this).val();
        var validName = /^[a-zA-Z]*$/;;
        if (city.length == 0) {
            $('.city-msg').addClass('invalid-msg').text("Street is required");
            $(this).addClass('invalid-input').removeClass('valid-input');

        } else if (!validName.test(city)) {
            $('.city-msg').addClass('invalid-msg').text('White Space and Number Are not Allowed');
            $(this).addClass('invalid-input').removeClass('valid-input');
        } else {
            $('.city-msg').empty();
            $(this).addClass('valid-input').removeClass('invalid-input');
        }
    });

    //   Phone Number validation
    $('#mobilenumber').on('input', function() {
        var mobileNum = $(this).val();
        var validNumber = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;
        if (mobileNum.length == 0) {
            $('.mobile-msg').addClass('invalid-msg').text('Mobile Number is required');
            $(this).addClass('invalid-input').removeClass('valid-input');
        } else if (!validNumber.test(mobileNum)) {
            $('.mobile-msg').addClass('invalid-msg').text('Invalid Mobile Number');
            $(this).addClass('invalid-input').removeClass('valid-input');
        } else if (mobileNum.length != 10) {
            $('.mobile-msg').addClass('invalid-msg').text('Mobile Number Must be 10 Digit');
            $(this).addClass('invalid-input').removeClass('valid-input');
        } else {
            $('.mobile-msg').empty();
            $(this).addClass('valid-input').removeClass('invalid-input');
        }
    });
    // Postal Code Validation
    $('#postal_code').on('input', function() {

        if ($.trim($('#pincode').val()).length == 0) {
            $(this).addClass('invalid-input').removeClass('valid-input');
            $('.postal_number').addClass('invalid-msg').text("Postal Code is Required");
        } else if ($.trim($('#pincode').val()).length != 6) {
            $(this).addClass('invalid-input').removeClass('valid-input');
            $('.postal_number').addClass('invalid-msg').text("Enter Valid Postal Code");
        } else {
            $('.postal_number').empty();
            $(this).addClass('valid-input').removeClass('invalid-input');
        }
    });
    //   house Number validation
    $('#house_number').on('input', function() {
        var houseNum = $(this).val();
        var validNumber = /^\d*$/;
        if (houseNum.length == 0) {
            $('.house-msg').addClass('invalid-msg').text('House Number is required');
            $(this).addClass('invalid-input').removeClass('valid-input');
        } else if (!validNumber.test(houseNum)) {
            $('.house-msg').addClass('invalid-msg').text('Enter Valid House Number');
            $(this).addClass('invalid-input').removeClass('valid-input');
        } else {
            $('.house-msg').empty();
            $(this).addClass('valid-input').removeClass('invalid-input');
        }
    });

    // validation to submit the form
    $('#edit_address_model').on('input', function(e) {

        if ($('#edit_address_model').find('.invalid-input').length > 0) {

            $('#editAddress').prop('disabled', true);
            $('#editAddress').css('cursor', 'not-allowed');
        } else {
            $('#editAddress').prop('disabled', false);
            $('#editAddress').css('cursor', 'pointer');
        }

    });

});