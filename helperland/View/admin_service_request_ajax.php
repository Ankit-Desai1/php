<script>
    $(document).ready(function() {
        get_customer_name();
        get_sp_name();
        get_user();

    });


    function get_customer_name() {
        $.ajax({
            type: 'POST',
            url: "http://localhost/php/helperland/?controller=Helperland&function=get_customer_name",
            success: function(data) {
                $("#all_customer").append(data);
            }
        });
    }

    function get_sp_name() {
        $.ajax({
            type: 'POST',
            url: "http://localhost/php/helperland/?controller=Helperland&function=get_sp_name",
            success: function(data) {
                $("#all_serviceprovider").append(data);
            }
        });
    }

    $(document).ready(function() {
        postalcode = '';
        email = '';
        serviceid = '';
        customer = '';
        service_provider = '';
        status = '';
        startdate = '';
        enddate = '';
        page = 1;
        n = 10;

        all_service_data();

        function all_service_data() {

            $.ajax({
                type: 'POST',
                url: "http://localhost/php/helperland/?controller=Helperland&function=all_service_data",
                data: {
                    'page': page,
                    'n': n,
                    'serviceid': serviceid,
                    'customer': customer,
                    'service_provider': service_provider,
                    'status': status,
                    'startdate': startdate,
                    'enddate': enddate,
                    'postalcode': postalcode,
                    'email': email,
                },
                success: function(data) {
                    //console.log(data);
                    $('#service_request_table').html(data);
                }
            });
        }

        $(document).on('click', '#search', function() {
            serviceid = $('#service_id').val();
            postalcode = $('#Postal_Code').val();
            email = $('#email').val();
            Customer = $('#all_customer option:selected').text();
            Service_provider = $('#all_serviceprovider option:selected').text();
            status = $('#status option:selected').val();
            startdate = $('#start_date').val();
            enddate = $('#end_date').val();
            page = 1;
            n = 10;
            if (Customer == 'Customer') {
                customer = '';
            } else {
                customer = Customer;
            }
            if (Service_provider == 'Service provider') {
                service_provider = '';
            } else {
                service_provider = Service_provider;
            }
            if (status == 'Status') {
                status = '';
            } else {
                status = status;
            }
            if (startdate == '') {
                startdate = '';
            } else {
                startdate = startdate + ' 00:00:00.000';
            }
            if (enddate == '') {
                enddate = '';
            } else {
                enddate = enddate + ' 23:59:59.000';
            }
            all_service_data();
        });

        $(document).on('click', '.clearservice', function() {
            postalcode = '';
            email = '';
            serviceid = '';
            customer = '';
            service_provider = '';
            status = '';
            startdate = '';
            enddate = '';
            page = 1;
            n = 10;

            if (Customer == 'Customer') {
                customer = '';
            } else {
                customer = Customer;
            }
            if (Service_provider == 'Service provider') {
                service_provider = '';
            } else {
                service_provider = Service_provider;
            }
            if (status == 'Status') {
                status = '';
            } else {
                status = status;
            }
            all_service_data();
        });

        $(document).on("click", ".pagenumber-btn", function() {
            page = $(this).attr("id");
            all_service_data();
        });

        $(document).on("change", "#no_of_service", function() {
            page = 1;
            n = $("#no_of_service option:selected").val();
            all_service_data();
        });

        $(document).on("click", '.editservice', function() {
            service_id = $(this).attr('id');
            $('.update').val(service_id);
            $.ajax({
                type: "POST",
                url: "http://localhost/php/helperland/?controller=Helperland&function=get_edit_data",
                data: {
                    'serviceid': service_id,

                },
                dataType: "json",
                success: function(data) {
                    // console.log(data);
                    $('#serviceDate').val(data[0]);
                    $('#serviceTime').val(data[1]);
                    $('#streetName').val(data[2]);
                    $('#houseNo').val(data[3]);
                    $('#postalCode').val(data[4]);
                    $('#city').val(data[5]);
                    $('#IstreetName').val(data[2]);
                    $('#IhouseNo').val(data[3]);
                    $('#IpostalCode').val(data[4]);
                    $('#Icity').val(data[5]);
                    $('#editmodal').modal('show');

                }
            });

        });
        $(document).on("click", '.update', function() {
            service_id = $(this).val();
            street = $('#streetName').val();
            houseno = $('#houseNo').val();
            postalcode = $('#postalCode').val();
            city = $('#city').val();
            reason = $('#reason').val();
            servicestartdate = $.trim($('#serviceDate').val()) + " " + $('#serviceTime').val();
            window.setTimeout(function() {
                $('#edit_error').addClass('d-none');
            }, 5000);

            if (street == "") {
                $("#edit_error").removeClass("alert-success d-none").addClass("alert-danger").text("Street Name IS Required.");
                $("#streetName").focus();
            } else if (houseno == "") {
                $("#edit_error").removeClass("alert-success d-none").addClass("alert-danger").text("House Number is Required.");
                $("#houseNo").focus();
            } else if (postalcode == "") {
                $("#edit_error").removeClass("alert-success d-none").addClass("alert-danger").text("Postalcode is Required.");
                $("#postalCode").focus();
            } else if (postalcode.length != 6) {
                $("#edit_error").removeClass("alert-success d-none").addClass("alert-danger").text("Invalid postalcode.");
                $("#postalCode").focus();
            } else if (city == "") {
                $("#edit_error").removeClass("alert-success d-none").addClass("alert-danger").text("City is Required.");
                $("#city").focus();
            } else if (reason == "") {
                $("#edit_error").removeClass("alert-success d-none").addClass("alert-danger").text("Enter Reason For Reschedule.");
                $("#reason").focus();
            } else {
                $.blockUI({
                    message: ' <img src="./Asset/image/preloader.gif" alt="."> '
                });
                $('#editmodal').modal('hide');
                $.ajax({
                    type: "POST",
                    url: "http://localhost/php/helperland/?controller=Helperland&function=edit_service_data",
                    data: {
                        'serviceid': service_id,
                        'servicestartdate': servicestartdate,
                        'street': street,
                        'houseno': houseno,
                        'postalcode': postalcode,
                        'city': city,
                        'reason': reason,
                    },
                    success: function(data) {
                        //console.log(data);
                        $.unblockUI();
                        if (data == 0) {
                            Swal.fire({
                                title: '',
                                text: 'Service Request ' + service_id + ' Is Not Edited. Please try Again.',
                                icon: 'error',
                                confirmButtonText: 'Done'
                            });
                        }
                        if (data == 1) {
                            Swal.fire({
                                title: 'Service Edit & Reschedule Successfully.',
                                text: 'Service Request ' + service_id + ' Has Been Edited Successfully.',
                                icon: 'success',
                                confirmButtonText: 'Done'
                            });
                        }
                    }
                });
                all_service_data();
            }

        });

        $(document).on("click", '.refundservice', function() {
            service_id = $(this).attr('id');
            $('#refundmodal').modal('show');
            $('.refund').val(service_id);
            $.ajax({
                type: "POST",
                url: "http://localhost/php/helperland/?controller=Helperland&function=get_refund_data",
                data: {
                    'serviceid': service_id,

                },
                dataType: "json",
                success: function(data) {
                    // console.log(data);
                    $('.amount').html(data[0]);
                    $('.refundamount').html(data[1]);
                    $('.inbalance').html(data[2]);
                    $('#refundmodal').modal('show');

                }
            });
        });
        $(document).on('click', '.calculate_btn', function() {
            amount = parseFloat($('.inbalance').text());
            percentage = parseFloat($('#percentage').val());
            refund = (percentage / 100) * amount;
            $('#calculate').val(refund);
        });
        $(document).on("click", '.refund', function() {
            service_id = $(this).val();
            refund = $('#calculate').val();
            reason = $('#refundreason').val();

            window.setTimeout(function() {
                $('#refund_error').addClass('d-none');
            }, 5000);

            if (refund == "") {
                $("#refund_error").removeClass("alert-success d-none").addClass("alert-danger").text("Please Select Refund Amount.");
                $("#percentage").focus();
            } else if (reason == "") {
                $("#refund_error").removeClass("alert-success d-none").addClass("alert-danger").text("Enter Reason For Refund");
                $("#refundreason").focus();
            } else {

                $.ajax({
                    type: "POST",
                    url: "http://localhost/php/helperland/?controller=Helperland&function=refund_data",
                    data: {
                        'serviceid': service_id,
                        'refund': refund,
                    },
                    success: function(data) {
                        //console.log(data);
                        $('#refundmodal').modal('hide');
                        if (data == 0) {
                            Swal.fire({
                                title: 'Refund Fail.',
                                text: 'Service Request ' + service_id + ' Has Not Been Refunded.',
                                icon: 'error',
                                confirmButtonText: 'Done'
                            });
                        }
                        if (data == 1) {
                            Swal.fire({
                                title: 'Refund Success.',
                                text: 'Service Request ' + service_id + ' Has Been Refunded Successfully.',
                                icon: 'success',
                                confirmButtonText: 'Done'
                            });
                        }
                    }
                });
            }
        });
    });

    function get_user() {
        $.ajax({
            type: 'POST',
            url: "http://localhost/php/helperland/?controller=Helperland&function=get_user_name",
            success: function(data) {
                $("#all_user").append(data);
            }
        });
    }

    $(document).ready(function() {
        userName = '';
        userType = '';
        mobile = '';
        zipcode = '';
        emailaddress = '';
        startdate = '';
        enddate = '';
        page = 1;
        n = 10;

        all_user_data();

        function all_user_data() {

            $.ajax({
                type: 'POST',
                url: "http://localhost/php/helperland/?controller=Helperland&function=all_user_data",
                data: {
                    'page': page,
                    'n': n,
                    'userName': userName,
                    'userType': userType,
                    'mobile': mobile,
                    'zipcode': zipcode,
                    'email': emailaddress,
                    'startdate': startdate,
                    'enddate': enddate,
                },
                success: function(data) {
                    // console.log(data);
                    $('#user_table').html(data);
                }
            });
        }

        $(document).on('click', '#search_user', function() {
            userName = $('#all_user option:selected').text();
            userType = $('#user_type option:selected').val();
            mobile = $('#mobile').val();
            zipcode = $('#zipcode').val();
            emailaddress = $('#emailaddress').val();;
            startdate = $('#startdate').val();
            enddate = $('#enddate').val();
            page = 1;
            n = 10;

            if (userName == 'User Name') {
                userName = '';
            } else {
                userName = userName;
            }
            if (userType == 'User Type') {
                userType = '';
            } else {
                userType = userType;
            }
            if (startdate == '') {
                startdate = '';
            } else {
                startdate = startdate + ' 00:00:00.000';
            }
            if (enddate == '') {
                enddate = '';
            } else {
                enddate = enddate + ' 23:59:59.000';
            }
            all_user_data();
        });

        $(document).on('click', '.clearuser', function() {
            userType = '';
            mobile = '';
            zipcode = '';
            emailaddress = '';
            startdate = '';
            enddate = '';
            page = 1;
            n = 10;

            if (userName == 'User Name') {
                userName = '';
            } else {
                userName = userName;
            }
            if (userType == 'User Type') {
                userType = '';
            } else {
                userType = userType;
            }
            all_user_data();
        });

        $(document).on("click", ".user-btn", function() {
            page = $(this).attr("id");
            all_user_data();
        });

        $(document).on("change", "#no_of_user", function() {
            page = 1;
            n = $("#no_of_user option:selected").val();
            all_user_data();
        });

        $(document).on("click", ".activeDeactive", function() {
            user_id = $(this).attr("id");
            isactive = $(this).text();
            if (isactive == 'Deactive') {
                info = 'Deactivated'
                status = 1;
            } else {
                status = 0;
                info = 'Activated'
            }
            $.ajax({
                type: 'POST',
                url: "http://localhost/php/helperland/?controller=Helperland&function=change_user_status",
                data: {
                    'userid': user_id,
                    'status': status,
                },
                success: function(data) {
                    console.log(data);
                    if (data == 0) {
                        Swal.fire({
                            title: '',
                            text: 'User ' + user_id + ' Is Not ' + info + '. Please try Again.',
                            icon: 'error',
                            confirmButtonText: 'Done'
                        });
                    }
                    if (data == 1) {
                        Swal.fire({
                            title: '',
                            text: 'User ' + user_id + ' Is ' + info + ' Successfully.',
                            icon: 'success',
                            confirmButtonText: 'Done'
                        });
                    }
                    all_user_data();
                }
            });
        });
    });
</script>