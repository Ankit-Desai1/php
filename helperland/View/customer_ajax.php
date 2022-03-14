<script>
    <?php if (isset($_SESSION['username'])) { ?>

        var username = "<?php echo $_SESSION['username'] ?>";
        var userid = "<?php echo $_SESSION['userid']; ?>";
    <?php } ?>

    $(document).ready(function() {
        page = 1;
        n = 5;
        load_data(page, n);

        function load_data(page, n) {
            $.ajax({
                type: 'POST',
                url: "http://localhost/php/helperland/?controller=Helperland&function=customer_data",
                data: {
                    page: page,
                    no: n,
                    "userid": userid
                },
                success: function(data) {
                    console.log(data);
                    $('#dbrecord').html(data);

                }
            })
        }
        $(document).on("change", "#serviceNo", function() {
            n = $("#serviceNo option:selected").val();
            load_data('1', n);
        });


        $(document).on("click", ".pagenumber-btn", function() {
            page = $(this).attr("id");
            load_data(page, n);
        })

    });

    $(document).on('click', '.rate', function() {
        id = $(this).attr("id");
        $('#all_detail').modal('hide');
        $.ajax({
            type: 'POST',
            url: "http://localhost/php/helperland/?controller=Helperland&function=get_rating",
            data: {
                serviceid: id,
            },
            success: function(data) {

                $('.show_rating_model').html(data);
                $('#rate_serviceprovider').modal('show');
                $('#confirm_rating').val(id);
            }
        })
    });
    $(document).ready(function() {
        $('#confirm_rating').on('click', function(e) {
            e.preventDefault();
            id = $('#confirm_rating').val();
            timearrival = parseFloat($('.infomsg').text());
            friendlyval = parseFloat($('.friendlymsg').text());

            qualityval = parseFloat($('.qualitymsg').val());
            ql = $('.qualitymsg').val();
            spid = $('#rate_serviceprovider .service-provider').attr('id');
            serviceid = $('#rate_serviceprovider .service-provider').attr('name');
            comment = $('#feedbackcomment').val();
            rating = (timearrival + friendlyval + qualityval) / 3;

            $.ajax({
                type: 'POST',
                url: "http://localhost/php/helperland/?controller=Helperland&function=apply_rating",
                data: {
                    serviceid: id,
                    rating: rating,
                    timearrival: timearrival,
                    friendlyval: friendlyval,
                    qualityval: qualityval,
                    ratingfrom: userid,
                    ratingto: spid,
                    comment: comment,
                },
                success: function(data) {
                    if (data == 2) {
                        Swal.fire({
                            title: 'You Have Already Provided Ratings For This Service',
                            text: 'Service Request Id : ' + serviceid,
                            icon: 'info',
                            confirmButtonText: 'Done'
                        });
                    }
                    if (data == 1) {
                        Swal.fire({
                            title: 'Rating Provided Successfully',
                            text: 'Service Request Id : ' + serviceid,
                            icon: 'success',
                            confirmButtonText: 'Done'
                        });
                    }
                    if (data == 0) {

                        Swal.fire({
                            title: 'Oops! Something Went Wrong',
                            text: 'Service Request Id : ' + serviceid,
                            icon: 'error',
                            confirmButtonText: 'Done'
                        });
                    }

                }
            })
        });
    });



    $(document).ready(function() {
        page = 1;
        n = 5;
        dashboard_data(page, n);


        function dashboard_data(page, n) {
            $.ajax({
                type: 'POST',
                url: "http://localhost/php/helperland/?controller=Helperland&function=dashboard_data",
                data: {
                    page: page,
                    no: n,
                    "userid": userid
                },
                success: function(data) {
                    //console.log(data);
                    $('#dashboard_content').html(data);
                }
            })
        }

        $(document).on("change", "#serviceNo", function() {
            n = $("#serviceNo option:selected").val();
            dashboard_data('1', n);
        });

        $(document).on("click", ".dashboard-btn", function() {
            var page = $(this).attr("id");
            dashboard_data(page, n);

        })

        $(document).on('click', '.cancel', function() {
            id = $(this).attr("id");
            $('#all_detail').modal('hide');
            $('#delete_model').modal('show');
            $('#confirm_delete').val(id);

        });
        $(document).on('click', '#confirm_delete', function() {

            id = $('#confirm_delete').val();
            // alert(id);
            $.ajax({
                type: 'POST',
                url: "http://localhost/php/helperland/?controller=Helperland&function=cancel_service",
                data: {
                    serviceid: id,
                },
                success: function(data) {
                    console.log(data);
                    // console.log("hello");
                    dashboard_data(page, n);
                }
            })
        });


        $(document).on('click', '.reschedule', function() {
            id = $(this).attr("id");
            $('#all_detail').modal('hide');
            $('#reschedule_model').modal('show');
            $('#confirm_reschedule').val(id);
            // alert(count);

        });
        $(document).on('click', '#confirm_reschedule', function() {

            id = $('#confirm_reschedule').val();
            servicestartdate = $.trim($('#selected_date').val()) + " " +
                $('#selected_time').val();

            $.ajax({
                type: 'POST',
                url: "http://localhost/php/helperland/?controller=Helperland&function=reschedule_service",
                data: {

                    serviceid: id,
                    servicestartdate: servicestartdate,
                },
                success: function(data) {
                    //console.log(data);
                    dashboard_data(page, n);
                }
            })
        });
    });

    $(document).on('click', '#dashboard_data_table', function(e) {
        var service_id = e.target.closest('tr').getAttribute('data-value');
        if (service_id != null && (e.target.classList != 'cancel' && e.target.classList != 'reschedule')) {
            $.ajax({
                type: 'POST',
                url: "http://localhost/php/helperland/?controller=Helperland&function=detail_of_service",
                data: {
                    "serviceid": service_id,
                    "userid": userid
                },
                success: function(data) {
                    //console.log(data);
                    $('.show_all_details').html(data);
                    $('#all_detail').modal('show');
                }
            })
        }
    });


    $(document).on('click', '.mobileview', function(e) {
        var service_id = e.target.closest('div .card-body').getAttribute('data-value');
        if (service_id != null && (e.target.classList != 'cancel' && e.target.classList != 'reschedule')) {
            $.ajax({
                type: 'POST',
                url: "http://localhost/php/helperland/?controller=Helperland&function=detail_of_service",
                data: {
                    "serviceid": service_id,
                    "userid": userid
                },
                success: function(data) {
                    //console.log(data);
                    $('.show_all_details').html(data);
                    $('#all_detail').modal('show');
                }
            })
        }
    });


    $(document).on('click', '#service_history_table', function(e) {
        var service_id = e.target.closest('tr').getAttribute('id');
        if (service_id != null && (e.target.classList != 'rate')) {
            $.ajax({
                type: 'POST',
                url: "http://localhost/php/helperland/?controller=Helperland&function=detail_of_service",
                data: {
                    "serviceid": service_id,
                    "userid": userid
                },
                success: function(data) {
                    //console.log(data);
                    $('.show_all_details').html(data);
                    $('#all_detail').modal('show');
                }
            })
        }
    });


    $(document).on('click', '.mobileview', function(e) {
        var service_id = e.target.closest('div .card-body').getAttribute('id');
        if (service_id != null && (e.target.classList != 'rate')) {
            $.ajax({
                type: 'POST',
                url: "http://localhost/php/helperland/?controller=Helperland&function=detail_of_service",
                data: {
                    "serviceid": service_id,
                    "userid": userid
                },
                success: function(data) {
                    //console.log(data);
                    $('.show_all_details').html(data);
                    $('#all_detail').modal('show');
                }
            })
        }
    });


    $(document).ready(function() {
        customer_details();

        function customer_details() {
            $.ajax({
                type: "POST",
                url: "http://localhost/php/helperland/?controller=Helperland&function=customer_details",
                data: {
                    userid: userid,
                },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    $('#firstname').val(data[0]);
                    $('#lastname').val(data[1]);
                    $('#emailaddress').val(data[2]);
                    $('#phonenumber').val(data[3]);
                    $('#dateofbirth').val(data[4]);
                    $('#dateofmonth').val(data[5]);
                    $('#yearofbirth').val(data[6]);
                    $('#languageid').val(data[7]);
                }
            });
        }
    });

    $(document).on('click', '#save_details', function(e) {
        e.preventDefault();
        userid = userid;
        firstname = $('#firstname').val();
        lastname = $('#lastname').val();
        phonenumber = $('#phonenumber').val();
        dateofbirth = $('#dateofbirth').val();
        monthofbirth = $('#dateofmonth').val();
        yearofbirth = $('#yearofbirth').val();
        language = $('#languageid').val();
        $.ajax({

            type: "POST",
            url: "http://localhost/php/helperland/?controller=Helperland&function=update_details",
            data: {
                userid: userid,
                firstname: firstname,
                lastname: lastname,
                phonenumber: phonenumber,
                dateofbirth: dateofbirth,
                monthofbirth: monthofbirth,
                yearofbirth: yearofbirth,
                language: language,
            },
            success: function(data) {
                if (data == 1) {
                    Swal.fire({
                        title: 'Your Detail is Updated.',
                        text: 'Service Request Id : ' + userid,
                        icon: 'success',
                        confirmButtonText: 'Done'
                    });
                }
                if (data == 0) {
                    Swal.fire({
                        title: 'Details Are Not Updated. Please Try Again.',
                        text: 'Service Request Id : ' + userid,
                        icon: 'error',
                        confirmButtonText: 'Done'
                    });
                }

            }
        });

    })


    $(document).on("click", "#change_password", function(e) {
        e.preventDefault();
        oldpassword = $("#oldpassword").val();
        newpassword = $("#newpassword").val();
        confirmpassword = $("#confirmpassword").val();
        firstname = $("#firstname").val();
        lastname = $("#lastname").val();
        modifiedby = firstname + " " + lastname;
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
                $("#iframeloading").hide();
                if (data == 1) {
                    $("#newpassword").val("");
                    $("#newpassword").removeClass('valid-input');
                    $("#currentpassword").val("");
                    $("#confirmpassword").val("");
                    $("#confirmpassword").removeClass('valid-input');

                    Swal.fire({
                        title: 'Your Password Has Been Updated Successfully',
                        text: '',
                        icon: 'success',
                        confirmButtonText: 'Done'
                    });
                }
                if (data == 0) {
                    $('.passworderror').text("Current Password is Invalid");
                    $('.passworderror').show();
                    setTimeout(function() {
                        $(".passworderror").hide();
                    }, 5000);
                }
                if (data == 2) {
                    $('.passworderror').text("Password Not Updated");
                    $('.passworderror').show();
                    setTimeout(function() {
                        $(".passworderror").hide();
                    }, 5000);
                }
            }
        });
    });


    $(document).ready(function() {
        get_address();

        function get_address() {
            $.ajax({
                type: 'POST',
                url: "http://localhost/php/helperland/?controller=Helperland&function=get_all_address",
                data: {
                    "userid": userid,
                },
                success: function(data) {
                    // console.log(data);
                    $("#alladdress").html(data);
                }
            });
        }



        $("#add_new_address").on("click", function(e) {
            e.preventDefault();
            var streetname = $.trim($("#streetname").val());
            var housenumber = $.trim($("#housenumber").val());
            var pincode = $.trim($("#pincode").val());
            var city = $.trim($("#city").val());
            var phonenumber = $.trim($("#mobile").val());


            $.ajax({
                type: 'POST',
                url: "http://localhost/php/helperland/?controller=Helperland&function=insert_address",
                data: {
                    "userid": userid,
                    "streetname": streetname,
                    "housenumber": housenumber,
                    "pincode": pincode,
                    "location": city,
                    "phonenumber": phonenumber,
                },

                success: function(data) {
                    console.log(data);
                    get_address();
                }
            });
        });


        $(document).on("click", ".edit_address", function(e) {
            addressid = $(this).attr("id");
            e.preventDefault();
            $('#editAddress').val(addressid);
            $.ajax({
                type: 'POST',
                url: "http://localhost/php/helperland/?controller=Helperland&function=get_address_value",
                data: {
                    "addressid": addressid,
                },
                dataType: "json",
                success: function(data) {
                    //console.log(data);
                    $("#street_name").val(data[0]);
                    $("#house_number").val(data[1]);
                    $("#postal_code").val(data[2]);
                    $("#location").val(data[3]);
                    $("#mobilenumber").val(data[4]);
                    $('#edit_address_model').modal('show');

                }
            });
        });



        $(document).on("click", "#editAddress", function() {

            addressid = $(this).val();
            var streetname = $.trim($("#street_name").val());
            var housenumber = $.trim($("#house_number").val());
            var pincode = $.trim($("#postal_code").val());
            var city = $.trim($("#location").val());
            var phonenumber = $.trim($("#mobilenumber").val());

            $.ajax({
                type: 'POST',
                url: "http://localhost/php/helperland/?controller=Helperland&function=update_address",
                data: {
                    "addressid": addressid,
                    "streetname": streetname,
                    "housenumber": housenumber,
                    "pincode": pincode,
                    "location": city,
                    "phonenumber": phonenumber,
                },
                success: function(data) {
                    console.log(data);
                    if (data == 1) {
                        Swal.fire({
                            title: 'Address Updated Successfully',
                            text: '',
                            icon: 'success',
                            confirmButtonText: 'Done'
                        });

                    } else {
                        $('.addressmsg').text("Please try again!!!");
                        $('.addressmsg').show();
                        setTimeout(function() {
                            $(".addressmsg").hide();
                        }, 5000);
                    }
                    get_address();
                }
            });
        });

        $(document).on("click", ".delete_address", function(e) {
            addressid = $(this).attr("id");
            e.preventDefault();
            $('#delete_address_model').modal('show');
            $('#confirm_delete_address').val(addressid);
        });

        $(document).on("click", "#confirm_delete_address", function(e) {
            e.preventDefault();
            addressid = $(this).val();
            $.ajax({
                type: 'POST',
                url: "http://localhost/php/helperland/?controller=Helperland&function=delete_address",
                data: {
                    "addressid": addressid,
                },
                success: function(data) {
                    console.log(data);
                    if (data != 1) {
                        alert('Failure...  Try Again.');

                    }
                    get_address();
                }
            });
        });

    });

    $(document).ready(function() {
        get_favourite_sp();

        function get_favourite_sp() {
            $.ajax({
                type: 'POST',
                url: "http://localhost/php/helperland/?controller=Helperland&function=get_fav_sp",
                data: {
                    'userid': userid,
                },
                success: function(data) {
                    //console.log(data);
                    $(".displayfavourite").html(data);
                    $("#dispaly_fav").html(data);
                }
            });
        }



        $(".displayfavourite").on("click", '.favourite_btn', function() {
            spid = $(this).attr('id');

            if ($(this).text() == "Favourite") {
                isfav = 1;
                $(this).text("UnFavourite");
            } else {
                isfav = 0;
                $(this).text("Favourite");
            }
            favourite();
        });

        $(".displayfavourite").on("click", '.block_btn', function() {
            spid = $(this).attr('id');
            if ($(this).text() == "Block") {
                isblock = 1;
                $(this).text("UnBlock");
            } else {
                isblock = 0;
                $(this).text("Block");
            }
            blocked();
        });


        function favourite() {
            $.ajax({
                type: "POST",
                url: "http://localhost/php/helperland/?controller=Helperland&function=favourite",
                data: {
                    'userid': userid,
                    'spid': spid,
                    'isfav': isfav,
                },
                success: function(data) {
                    get_favourite_sp();
                }
            });
        }

        function blocked() {
            $.ajax({
                type: "POST",
                url: "http://localhost/php/helperland/?controller=Helperland&function=block",
                data: {
                    'userid': userid,
                    'spid': spid,
                    'isblock': isblock,
                },
                success: function(data) {
                    get_favourite_sp();

                }
            });
        }

    });
</script>