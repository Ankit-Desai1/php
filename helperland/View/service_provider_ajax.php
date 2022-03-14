<script>
    <?php if (isset($_SESSION['username'])) { ?>

        var username = "<?php echo $_SESSION['username'] ?>";
        var userid = "<?php echo $_SESSION['userid']; ?>";
    <?php } ?>

    // ------------------NEW SERVICE AJAX----------------------

    $(document).ready(function() {
        page = 1;
        n = 5;
        pet = 1;

        new_service_data(page, n, pet);

        function new_service_data(page, n, pet) {
            $.ajax({
                type: 'POST',
                url: "http://localhost/php/helperland/?controller=Helperland&function=new_service_data",
                data: {
                    page: page,
                    no: n,
                    pet: pet,
                    userid: userid,
                },
                success: function(data) {
                    //console.log(data);
                    $('#new_service_db').html(data);

                }
            })
        }
        $(document).on('click', 'input[type="checkbox"]', function() {
            if ($(this).prop("checked") == true) {
                pet = 1;
            } else if ($(this).prop("checked") == false) {
                pet = 0;
            }
            new_service_data('1', n, pet);
        });

        $(document).on("change", "#serviceNo", function() {
            n = $("#serviceNo option:selected").val();
            new_service_data('1', n, pet);
        });


        $(document).on("click", ".new-btn", function() {
            page = $(this).attr("id");
            new_service_data(page, n, pet);
        });

        $(document).on('click', '.accept', function() {

            serviceid = $(this).attr('id');


            $.ajax({
                type: 'POST',
                url: "http://localhost/php/helperland/?controller=Helperland&function=accept_sp_service",
                data: {
                    'username': username,
                    'userid': userid,
                    'serviceid': serviceid,
                },
                success: function(data) {
                    console.log(data);
                    if (data == 0) {
                        Swal.fire({
                            title: 'Service Already Accepted.',
                            text: 'Service Request ' + serviceid + ' Is Already Accepted.',
                            icon: 'info',
                            confirmButtonText: 'Done'
                        });
                    }
                    if (data == 1) {
                        Swal.fire({
                            title: 'Service Accepted Successfully.',
                            text: 'Service Request ' + serviceid + ' Has Been Accepted Successfully.',
                            icon: 'success',
                            confirmButtonText: 'Done'
                        });
                    }
                    if (data == 2) {
                        Swal.fire({
                            title: 'Error',
                            text: 'Service Request ' + serviceid + ' Is Not Accepted, Please Try Again',
                            icon: 'error',
                            confirmButtonText: 'Done'
                        });
                    }
                    if (data > 2) {
                        Swal.fire({
                            title: 'Time Conflict',
                            text: 'Another service request #' + data + ' has already been assigned which has time overlap with this service request. You can’t pick this one!”',
                            icon: 'info',
                            confirmButtonText: 'Done'
                        });
                    }
                    new_service_data('1', n, pet);
                }
            })
        });

    });


    // ---------------------UPCOMING SERVICE AJAX-----------------


    $(document).ready(function() {
        page = 1;
        n = 5;

        upcoming_service_data(page, n);

        function upcoming_service_data(page, n) {
            $.ajax({
                type: 'POST',
                url: "http://localhost/php/helperland/?controller=Helperland&function=upcoming_service_data",
                data: {
                    page: page,
                    no: n,
                    userid: userid,
                },
                success: function(data) {
                    //console.log(data);
                    $('#upcoming_services').html(data);
                }
            })
        }

        $(document).on("change", "#upcoming_service_no", function() {
            n = $("#upcoming_service_no option:selected").val();
            upcoming_service_data('1', n);
        });


        $(document).on("click", ".upcoming-btn", function() {
            page = $(this).attr("id");
            upcoming_service_data(page, n);
        });


        $(document).on('click', '.complete', function() {

            id = $(this).attr('id');
            $.ajax({
                type: 'POST',
                url: "http://localhost/php/helperland/?controller=Helperland&function=complete_sp_service",
                data: {
                    serviceid: id,
                },
                success: function(data) {
                    upcoming_service_data('1', n);
                    if (data == 1) {
                        Swal.fire({
                            title: 'Your Service Status is Updated.',
                            text: 'Service Request ' + userid + ' Is Completed.',
                            icon: 'success',
                            confirmButtonText: 'Done'
                        });
                    } else {
                        Swal.fire({
                            title: 'Your Service Status is Not Updated.',
                            text: 'Service Request ' + userid + 'Is Not Completed, Please Try Again.',
                            icon: 'error',
                            confirmButtonText: 'Done'
                        });
                    }
                }
            })
        });

        $(document).on('click', '.cancel', function() {

            id = $(this).attr('id');
            $.ajax({
                type: 'POST',
                url: "http://localhost/php/helperland/?controller=Helperland&function=cancel_sp_service",
                data: {
                    serviceid: id,
                },
                success: function(data) {
                    upcoming_service_data('1', n);
                    if (data == 1) {
                        Swal.fire({
                            title: 'Your Service Is cancelled.',
                            text: 'Service Request ' + id + ' Has Been Cancelled Successfully.',
                            icon: 'success',
                            confirmButtonText: 'Done'
                        });
                    } else {
                        Swal.fire({
                            title: 'Your Service Is Not Cancelled.',
                            text: 'Service Request ' + id + 'Has Not Been Cancelled, Please Try Again.',
                            icon: 'error',
                            confirmButtonText: 'Done'
                        });
                    }
                }
            })
        });

    });



    // --------------------- SERVICE HISTORY AJAX-----------------


    $(document).ready(function() {
        page = 1;
        n = 5;

        service_history_data(page, n);

        function service_history_data(page, n) {
            $.ajax({
                type: 'POST',
                url: "http://localhost/php/helperland/?controller=Helperland&function=service_history_data",
                data: {
                    page: page,
                    no: n,
                    userid: userid,
                },
                success: function(data) {
                    //console.log(data);
                    $('#history_db').html(data);
                }
            })
        }

        $(document).on("change", "#service_history_no", function() {
            n = $("#service_history_no option:selected").val();
            service_history_data('1', n);
        });


        $(document).on("click", ".history-btn", function() {
            page = $(this).attr("id");
            service_history_data(page, n);
        });
    });



    // --------------------- Rating AJAX-----------------


    $(document).ready(function() {
        page = 1;
        n = 5;

        rating_data(page, n);

        function rating_data(page, n) {
            $.ajax({
                type: 'POST',
                url: "http://localhost/php/helperland/?controller=Helperland&function=rating_data",
                data: {
                    page: page,
                    no: n,
                    userid: userid,
                },
                success: function(data) {
                    //console.log(data);
                    $('#rating').html(data);
                }
            })
        }

        $(document).on("change", "#rating_no", function() {
            n = $("#rating_no option:selected").val();
            rating_data('1', n);
        });


        $(document).on("click", ".rating-btn", function() {
            page = $(this).attr("id");
            rating_data(page, n);
        });
    });




    // --------------------- Block/Unblock AJAX-----------------


    $(document).ready(function() {
        page = 1;
        n = 5;

        block_data(page, n);

        function block_data(page, n) {
            $.ajax({
                type: 'POST',
                url: "http://localhost/php/helperland/?controller=Helperland&function=block_data",
                data: {
                    page: page,
                    no: n,
                    userid: userid,
                },
                success: function(data) {
                    // console.log(data);
                    $('#block_customer').html(data);
                }
            })
        }

        $(document).on("change", "#block_no", function() {
            n = $("#rating_no option:selected").val();
            block_data('1', n);
        });


        $(document).on("click", ".block-btn", function() {
            page = $(this).attr("id");
            block_data(page, n);
        });

        $("#block_customer").on("click", '.block_btn', function() {
            customerid = $(this).attr('id');
            if ($(this).text() == "Block") {
                isblock = 1;
                $(this).text("UnBlock");
            } else {
                isblock = 0;
                $(this).text("Block");
            }
            blocked();
        });

        function blocked() {
            $.ajax({
                type: "POST",
                url: "http://localhost/php/helperland/?controller=Helperland&function=block",
                data: {
                    'username': username,
                    'userid': userid,
                    'spid': customerid,
                    'isblock': isblock,
                },
                success: function(data) {
                    block_data(page, n);

                }
            });
        }
    });



    //------------------------My Setting Ajax------------------------

    $(document).ready(function() {
        sp_details();
        sp_address();

        function sp_details() {
            $.ajax({
                type: "POST",
                url: "http://localhost/php/helperland/?controller=Helperland&function=customer_details",
                data: {
                    userid: userid,
                },
                dataType: "json",
                success: function(data) {
                    // console.log(data);
                    $('#firstname').val(data[0]);
                    $('#lastname').val(data[1]);
                    $('#emailaddress').val(data[2]);
                    $('#phonenumber').val(data[3]);
                    $('#dateofbirth').val(data[4]);
                    $('#dateofmonth').val(data[5]);
                    $('#yearofbirth').val(data[6]);
                    $('#nationalityid').val(data[8]);
                    $('input[name=gender]').val([data[9]]);
                    $('input[name=avtar]').val([data[10]]);
                    document.getElementById(data[10] + "avtar").style.display = "block";
                }
            });
        }

        function sp_address() {
            $.ajax({
                type: "POST",
                url: "http://localhost/php/helperland/?controller=Helperland&function=get_sp_address",
                data: {
                    'userid': userid,
                },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    $('#streetname').val(data[0]);
                    $('#housenumber').val(data[1]);
                    $('#pincode').val(data[2]);
                    $('#city').val(data[3]);
                }
            });
        }

        $(document).on("click", "#save_details", function(e) {
            e.preventDefault();
            firstname = $('#firstname').val();
            lastname = $('#lastname').val();
            phonenumber = $('#phonenumber').val();
            email = $('#emailaddress').val();
            dateofbirth = $('#dateofbirth').val();
            monthofbirth = $('#dateofmonth').val();
            yearofbirth = $('#yearofbirth').val();
            nationalityid = $('#nationalityid').val();
            gender = $('input[name=gender]:checked').val();
            avtar = $('input[name=avtar]:checked').val();
            streetname = $.trim($("#streetname").val());
            housenumber = $.trim($("#housenumber").val());
            pincode = $.trim($("#pincode").val());
            city = $.trim($("#city").val());
            window.setTimeout(function() {
                $('#user_error').addClass('d-none');
            }, 5000);
            validNumber = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;
            if (firstname == "") {
                $("#user_error").removeClass("alert-success d-none").addClass("alert-danger").text("First name is Required.");
                $("#firstname").focus();
            } else if (lastname == "") {
                $("#user_error").removeClass("alert-success d-none").addClass("alert-danger").text("Last name is Required.");
                $("#lastname").focus();
            } else if (phonenumber == "") {
                $("#user_error").removeClass("alert-success d-none").addClass("alert-danger").text("Mobile Number is Required.");
                $("#phonenumber").focus();
            } else if (phonenumber.length != 10 && !validNumber.test(phonenumber)) {
                $("#user_error").removeClass("alert-success d-none").addClass("alert-danger").text("Invalid Mobile Number.");
                $("#phonenumber").focus();
            } else if (monthofbirth == "Month") {
                $("#user_error").removeClass("alert-success d-none").addClass("alert-danger").text("Invalid Date Of Birth");
                $("#dateofmonth").focus();
            } else if (dateofbirth == "Day") {
                $("#user_error").removeClass("alert-success d-none").addClass("alert-danger").text("Invalid Date Of Birth.");
                $("#dateofbirth").focus();
            } else if (yearofbirth == "Year") {
                $("#user_error").removeClass("alert-success d-none").addClass("alert-danger").text("Invalid Date Of Birth");
                $("#yearofbirth").focus();
            } else if (nationalityid == "") {
                $("#user_error").removeClass("alert-success d-none").addClass("alert-danger").text("Nationality is Required.");
                $("#nationalityid").focus();
            } else if (streetname == "") {
                $("#user_error").removeClass("alert-success d-none").addClass("alert-danger").text("Streetname is Required.");
                $("#streetname").focus();
            } else if (housenumber == "") {
                $("#user_error").removeClass("alert-success d-none").addClass("alert-danger").text("House Numberis Required.");
                $("#housenumber").focus();
            } else if (pincode == "") {
                $("#user_error").removeClass("alert-success d-none").addClass("alert-danger").text("Pincodeis Required.");
                $("#pincode").focus();
            } else if (city == "") {
                $("#user_error").removeClass("alert-success d-none").addClass("alert-danger").text("City is Required.");
                $("#city").focus();
            } else if (pincode.length != 6) {
                $("#password_error").removeClass("alert-success d-none").addClass("alert-danger").text("Invalid Pincode.");
                $("#pincode").focus();
            } else {
                $.ajax({
                    type: 'POST',
                    url: "http://localhost/php/helperland/?controller=Helperland&function=update_sp_details",
                    data: {
                        "userid": userid,
                        "firstname": firstname,
                        "lastname": lastname,
                        "email": email,
                        "phonenumber": phonenumber,
                        "dateofbirth": dateofbirth,
                        "monthofbirth": monthofbirth,
                        "yearofbirth": yearofbirth,
                        "nationalityid": nationalityid,
                        "gender": gender,
                        "avtar": avtar,
                        "streetname": streetname,
                        "housenumber": housenumber,
                        "pincode": pincode,
                        "city": city,
                    },

                    success: function(data) {
                        //console.log(data);
                        sp_details();
                        sp_address();
                        if (data == 1) {
                            Swal.fire({
                                title: 'Your Detail is Updated.',
                                text: '',
                                icon: 'success',
                                confirmButtonText: 'Done'
                            });
                        }
                        if (data == 0) {
                            Swal.fire({
                                title: 'Details Are Not Updated. Please Try Again.',
                                text: '',
                                icon: 'error',
                                confirmButtonText: 'Done'
                            });
                        }
                    }
                });
            }
        });
    });

    $(document).on("click", "#change_password", function(e) {
        e.preventDefault();
        oldpassword = $("#oldpassword").val();
        newpassword = $("#newpassword").val();
        confirmpassword = $("#confirmpassword").val();
        firstname = $("#firstname").val();
        lastname = $("#lastname").val();
        modifiedby = firstname + " " + lastname;

        window.setTimeout(function() {
            $('#password_error').addClass('d-none');
        }, 5000);
        var paswordtest = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).{6,14}$/;

        if (oldpassword == "" && newpassword == "" && confirmpassword == "") {
            $("#password_error").removeClass("alert-success d-none").addClass("alert-danger").text("All Fields are Required.");
            $("#oldpassword").focus();
        } else if (oldpassword == "") {
            $("#password_error").removeClass("alert-success d-none").addClass("alert-danger").text("Old password is Required.");
            $("#oldpassword").focus();
        } else if (newpassword == "") {
            $("#password_error").removeClass("alert-success d-none").addClass("alert-danger").text("New password is Required.");
            $("#newpassword").focus();
        } else if (!paswordtest.test(newpassword)) {
            $("#password_error").removeClass("alert-success d-none").addClass("alert-danger").text("Password must contain at least 1 capital letter, 1 small letter, 1 number and one special character. Password length must be in between 6 to 14 characters.");
            $("#newpassword").focus();
        } else if (confirmpassword == "") {
            $("#password_error").removeClass("alert-success d-none").addClass("alert-danger").text("Confirm password is Required.");
            $("#confirmpassword").focus();
        } else if (newpassword != confirmpassword) {
            $("#password_error").removeClass("alert-success d-none").addClass("alert-danger").text("New Password and Confirm Password must be match.");
            $("#confirmpassword").focus();
        } else {
            $.ajax({
                type: "POST",
                url: "http://localhost/php/helperland/?controller=Helperland&function=change_password",
                data: {
                    'userid': userid,
                    'oldpassword': oldpassword,
                    'newpassword': newpassword,
                    'confirmpassword': confirmpassword,
                    'modifiedby': modifiedby,
                },
                success: function(data) {
                    if (data == 1) {
                        $("#password_error").removeClass("alert-danger d-none").addClass("alert-success").text("Your Password Has Been Updated Successfully");
                    }
                    if (data == 0) {
                        $("#password_error").removeClass("alert-success d-none").addClass("alert-danger").text("Current Password is Invalid.");
                    }
                    if (data == 2) {
                        $("#password_error").removeClass("alert-success d-none").addClass("alert-danger").text("Password Not Updated please Try Again...");
                    }
                }
            });
        }
    });

    $(document).on('click', '#new_service_data_table', function(e) {
        var service_id = e.target.closest('tr').getAttribute('id');
        var pincode = e.target.closest('tr').getAttribute('data-value');
        if (service_id != null && e.target.classList != ('blue_button accept')) {
            $.ajax({
                type: 'POST',
                url: "http://localhost/php/helperland/?controller=Helperland&function=detail_of_all_services",
                data: {
                    "serviceid": service_id,
                },
                success: function(data) {
                    // console.log(data);
                    $('.show_all_details').html(data);
                    getMap(pincode);
                    $('#all_detail').modal('show');
                }
            })
        }
    });

    $(document).on('click', '#upcoming_service_data_table', function(e) {
        var service_id = e.target.closest('tr').getAttribute('id');
        var pincode = e.target.closest('tr').getAttribute('data-value');
        if (service_id != null && (e.target.classList != ('blue_button complete') && e.target.classList != ('cancel'))) {
            $.ajax({
                type: 'POST',
                url: "http://localhost/php/helperland/?controller=Helperland&function=detail_of_all_services",
                data: {
                    "serviceid": service_id,
                },
                success: function(data) {
                    // console.log(data);
                    $('.show_all_details').html(data);
                    getMap(pincode);
                    $('#all_detail').modal('show');

                }
            })
        }
    });

    $(document).on('click', '#service_history_data_table', function(e) {
        var service_id = e.target.closest('tr').getAttribute('id');
        var pincode = e.target.closest('tr').getAttribute('data-value');
        $.ajax({
            type: 'POST',
            url: "http://localhost/php/helperland/?controller=Helperland&function=detail_of_all_services",
            data: {
                "serviceid": service_id,
            },
            success: function(data) {
                // console.log(data);
                $('.show_all_details').html(data);
                getMap(pincode);
                $('#all_detail').modal('show');
            }
        })
    });

    $(document).on('click', '#new_service_card', function(e) {
        var service_id = e.target.closest('div .card-body').getAttribute('id');
        var pincode = e.target.closest('div .card-body').getAttribute('data-value');
        if (service_id != null && e.target.classList != ('blue_button accept')) {
            $.ajax({
                type: 'POST',
                url: "http://localhost/php/helperland/?controller=Helperland&function=detail_of_all_services",
                data: {
                    "serviceid": service_id,
                },
                success: function(data) {
                    // console.log(data);
                    getMap(pincode);
                    $('.show_all_details').html(data);
                    $('#all_detail').modal('show');

                }
            })
        }
    });

    $(document).on('click', '#upcoming_service_card', function(e) {
        var service_id = e.target.closest('div .card-body').getAttribute('id');
        var pincode = e.target.closest('div .card-body').getAttribute('data-value');
        if (service_id != null && (e.target.classList != ('blue_button complete') && e.target.classList != ('cancel'))) {
            $.ajax({
                type: 'POST',
                url: "http://localhost/php/helperland/?controller=Helperland&function=detail_of_all_services",
                data: {
                    "serviceid": service_id,
                },
                success: function(data) {
                    // console.log(data);
                    getMap(pincode);
                    $('.show_all_details').html(data);
                    $('#all_detail').modal('show');

                }
            })
        }
    });

    $(document).on('click', '#service_history_card', function(e) {
        var service_id = e.target.closest('div .card-body').getAttribute('id');
        var pincode = e.target.closest('div .card-body').getAttribute('data-value');
        $.ajax({
            type: 'POST',
            url: "http://localhost/php/helperland/?controller=Helperland&function=detail_of_all_services",
            data: {
                "serviceid": service_id,
            },
            success: function(data) {
                // console.log(data);
                getMap(pincode);
                $('.show_all_details').html(data);
                $('#all_detail').modal('show');
            }
        })

    });

    function getMap(zipcode) {

        var embed = "<iframe width='100%25' height='100%25'  frameborder='0'  scrolling='no' marginheight='0' marginwidth='0'     src='https://maps.google.com/maps?&amp;q=" +
            encodeURIComponent(zipcode) +
            "&amp;output=embed'><a href='https://www.gps.ie/car-satnav-gps/'>sat navs</a></iframe>";

        $('#map').html(embed);

    }
</script>