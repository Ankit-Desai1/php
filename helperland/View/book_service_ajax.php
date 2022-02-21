<script>
    function ClickFunction(id) {
        document.getElementById(id).click();
    }

    function Disable(id) {
        document.getElementById(id).disabled = true;
    }

    function Clickable(id) {
        document.getElementById(id).disabled = false;
    }
    Disable('tab2btn');
    Disable('tab3btn');
    Disable('tab4btn');


    $("#check_availability").on("click", function() {

        // alert('it work');
        if ($.trim($('#postalcode').val()).length == 0) {
            var postalerror = "Postal Code is Required";
            $('#postal_err').text(postalerror);
        }
        if ($.trim($('#postalcode').val()).length == 6) {
            var postalerror = "";
            $('#postal_err').text(postalerror);
            var postal = $("#postalcode").val();
            $("#iframeloading").show();

            $.ajax({
                type: 'POST',
                url: "http://localhost/php/helperland/?controller=Helperland&function=check_postalcode",
                data: {
                    "postal": postal,
                },

                success: function(data) {
                    $("#iframeloading").hide();
                    if (data == 1) {
                        var pincode = $("#pincode").val(postal);

                        $.ajax({
                            type: 'POST',
                            url: "http://localhost/php/helperland/?controller=Helperland&function=city",
                            data: {
                                "postalcode": postal,
                            },
                            dataType: 'json',
                            success: function(data) {

                                $('#city').val(data[0]);

                                Clickable('tab2btn');
                                ClickFunction('tab2btn');
                            }
                        });
                    } else {
                        var response = "Postal Code Not Available";
                        $('#postal_err').text(response);
                    }

                }

            });

        } else {
            var postalerror = "Please Enter Valid Postal Code";
            $('#postal_err').text(postalerror);
        }
    })
    $("#schedule_plan").on("click", function(e) {
        e.preventDefault();


        var selectedbed = $("#selectedbed option:selected").val();
        var selectedbath = $("#selectedbath option:selected").val();
        var selectedtime = $("#selectedtime option:selected").text();
        var selecteddate = $.trim($("#selecteddate").val());
        var servicetime = $("#servicetime option:selected").val();
        var extrahours = "0";
        extrahours = parseFloat(extrahours);

        if ($(".extra1").css('display') == 'block') {
            extrahours = extrahours + 0.5;

        }
        if ($(".extra2").css('display') == 'block') {
            extrahours = extrahours + 0.5;

        }
        if ($(".extra3").css('display') == 'block') {
            extrahours = extrahours + 0.5;

        }
        if ($(".extra4").css('display') == 'block') {
            extrahours = extrahours + 0.5;

        }
        if ($(".extra5").css('display') == 'block') {
            extrahours = extrahours + 0.5;
        }
        // alert(extrahours);
        var servicehours = $('#basic_time').text();
        servicehours = parseFloat(servicehours);
        var SubTotal = $('#total_hours').text();
        SubTotal = parseFloat(SubTotal);
        var Discount = $('#discount').text();
        Discount = parseFloat(Discount);
        var TotalCost = $('#total_payment').text();
        TotalCost = parseFloat(TotalCost);
        var EffectiveCost = $('#effective_price').text();
        EffectiveCost = parseFloat(EffectiveCost);
        var comments = $.trim($("#comments").val());

        if ($('#havepet').is(":checked")) {
            var pets = "true";
        } else {
            var pets = "false";
        }
        Get_address();
        Clickable('tab3btn');
        ClickFunction('tab3btn');
    })


    $("#address_save").on("click", function(e) {
        e.preventDefault();
        var streetname = $.trim($("#streetname").val());
        var housenumber = $.trim($("#housenumber").val());
        var pincode = $.trim($("#pincode").val());
        var city = $.trim($("#city").val());
        var phonenumber = $.trim($("#phonenumber").val());

        <?php if (isset($_SESSION['username'])) { ?>

            var username = "<?php echo $_SESSION['username'] ?>";
            var userid = "<?php echo $_SESSION['userid']; ?>";
        <?php } ?>
        //alert(userid);

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
                "username": username,
            },

            success: function(data) {
                if (data) {
                    $('#add_address').show();
                    $('.address_form').hide();
                    Get_address();
                } else {
                    alert("Something went wrong. please enter detail.");
                }
            }
        });
    })



    function Get_address() {


        <?php if (isset($_SESSION['username'])) { ?>

            var username = "<?php echo $_SESSION['username'] ?>";
            userid = "<?php echo $_SESSION['userid']; ?>";
        <?php } ?>

        $.ajax({
            type: 'POST',
            url: "http://localhost/php/helperland/?controller=Helperland&function=Get_address",
            data: {
                "userid": userid,
            },
            // dataType: 'json',
            success: function(data) {
                $("#alladdress").html(data);
            }
        });
    }




    var Addressid;
    $('#select_address').click(function() {
        if ($('input[name="address"]:checked').length == 0) {
            alert('Please select an Address');
        } else {
            Addressid = $('input[name="address"]:checked').val();
        }
        Clickable('tab4btn');
        ClickFunction('tab4btn');
    });







    $('#complete_booking').click(function() {
        var payment = "payment successful";
        //alert(payment);

        <?php if (isset($_SESSION['username'])) { ?>
            username = "<?php echo $_SESSION['username'] ?>"
            userid = "<?php echo $_SESSION['userid']; ?>";
        <?php } ?>
        //extraservice {};
        servicehourrate = "10";
        servicestartdate = $.trim($("#booking_date").text()) + " " +
            $("#selectedtime option:selected").text();
        pincode = $("#postalcode").val();
        servicehours = $('#basic_time').text();
        servicehours = parseFloat(servicehours);
        SubTotal = $('#total_hours').text();
        SubTotal = parseFloat(SubTotal);
        extrahours = SubTotal - servicehours;
        Discount = $('#discount').text();
        TotalCost = $('#total_payment').text();
        comments = $.trim($("#comments").val());
        Addressid = $('input[name="address"]:checked').val();
        Extraservice = '';
        if ($(".extra1").css('display') == 'block') {
            Extraservice = Extraservice + [' Inside cabinets ,'];

        }
        if ($(".extra2").css('display') == 'block') {
            Extraservice = Extraservice + [' Inside fridge ,'];

        }
        if ($(".extra3").css('display') == 'block') {
            Extraservice = Extraservice + [' Inside oven ,'];

        }
        if ($(".extra4").css('display') == 'block') {
            Extraservice = Extraservice + [' Laundry wash & dry ,'];

        }
        if ($(".extra5").css('display') == 'block') {
            Extraservice = Extraservice + [' Interior windows'];
        }


        if ($('#havepet').is(":checked")) {
            pets = 1;
        } else {
            pets = 0;
        }
        AddServiceRequest();
    });


    $('#promocode').click(function() {
        var promocode_error = "Promocode Doesn't Exists";
        $('.promocode_error').text(promocode_error);
    });


    function AddServiceRequest() {
        Submit = ({
            "username": username,
            "userid": userid,
            "servicestartdate": servicestartdate,
            "zipcode": pincode,
            "servicehourrate": servicehourrate,
            "servicehours": servicehours,
            "extrahour": extrahours,
            "subtotal": SubTotal,
            "discount": Discount,
            "totalcost": TotalCost,
            "comments": comments,
            "addressid": Addressid,
            "haspets": pets,
            "extraservice": Extraservice,
        });

        $.ajax({
            type: 'POST',
            url: "http://localhost/php/helperland/?controller=Helperland&function=Service_request",
            data: Submit,
            // dataType: 'json',
            success: function(data) {
                console.log(data);
                if (data == 0) {

                    alert('data not inserted');

                } else {

                    $("#service_id").html(data);
                    //alert(data);

                }

            }
        });
    }
</script>