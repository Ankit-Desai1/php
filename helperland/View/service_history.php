<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Service History</title>
    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="../Asset/css/service_history.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- header -->
    <div class="container-fluid sticky" style="background-color: #A3A3A3;">
        <nav class="navbar navbar-expand-lg navbar-light text-center">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="../image/logo-large.png" class=" img-fluid header-image" alt="" ;></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="navbar-nav ms-auto">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">Book Now</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">Prices & services</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">Warrenty</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#">Contact</a>
                            </li>
                            <li class="nav-items dropdownbtn">
                                <a class="nav-link" href="#"> <img src="../image/user.png" alt="..."> <img src="../image/sp-arrow-down.png" class="img-fluid" alt="..."> </a>
                                <div class="dropdown-content">
                                    <p>Welcome, <br>Ankit Desai</p>
                                    <hr>
                                    <a href="#">My Dashboard</a>
                                    <a href="#mysetting">My Setting </a>
                                    <a href="#">Logout</a>
                                </div>
                            </li>

                        </ul>

                    </div>
                </div>
                <div class="notification position-relative nav-item">

                    <img src="../image/icon-notification.png" alt="">
                    <span class="badge rounded-circle position-absolute">2</span>
                </div>


            </div>
    </div>
    </nav>
    </div>
    <!-- header -->

    <!-- welcome start -->
    <section class="welcome">
        <h1>Welcome, <span>Ankit!</span> </h1>
    </section>
    <!-- welcome end -->

    <!-- main page start -->

    <section class="main_service clearfix">
        <div class="hamburger">
            <span class="v-bar"></span>
            <span class="v-bar"></span>
            <span class="v-bar"></span>

        </div>
        <div class="tab">
            <button class="tablinks" onclick="upcoming_service(event, 'dashboard')">Dashboard</button>
            <button class="tablinks" onclick="upcoming_service(event, 'service_history')" id="defaultOpen">Service
                History</button>
            <button class="tablinks" onclick="upcoming_service(event, 'service_schedule')">Service Schedule</button>
            <button class="tablinks" onclick="upcoming_service(event, 'favourite_pros')">Favourite Pros</button>
            <button class="tablinks" onclick="upcoming_service(event, 'invoices')">invoices</button>
            <button class="tablinks" onclick="upcoming_service(event, 'notifications')">Notifications</button>

        </div>
        </div>

        <div id="dashboard" class="tabcontent">

            <div class="clearfix">
                <div>
                    <p class="alignleft">Current Service Requests</p>
                    <button class="alignright">Add new service request</button>
                </div>
                <div id="dashboard_content">
                </div>
            </div>
        </div>

        <!-- -----------------------------------delete model---------------------- -->

        <div class="modal" tabindex="-1" id="delete_model">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cancel Service Request</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="comment" class="form-label">Why you want to cancel the service request?</label>
                        <textarea class="form-control" id="comment" rows="3"></textarea>
                        <div class="text-center">
                            <button type="submit" data-bs-dismiss="modal" class="btn_cancel" id="confirm_delete">Cancel Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="show_all_details">
        </div>

        <!-- <div class="modal" tabindex="-1" id="all_detail">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Service Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>start date</p>
                        <p>Duration: <span>3.5</span> </p>
                        <hr>
                        <p>Service id: <span>2</span></p>
                        <p>Extras: <span>inside friedge</span> </p>
                        <p>Net Amount: <span>75</span> </p>
                        <hr>
                        <p>Service Address:</p>
                        <p>Billing Address: same as cleaninng address</p>
                        <p>phone:</p>
                        <p>Email:</p>
                        <hr>
                        <p>Comments</p>
                        <hr>
                        <div class="text-center">
                            <button class="reschedule" id="' . $row['ServiceRequestId'] . '">Reschedule</button><button class="cancel" id="' . $row['ServiceRequestId'] . '">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->



        <div class="modal" tabindex="-1" id="reschedule_model">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reschedule Service Request</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Select New Date & Time</p>
                        <div class="row">
                            <div class="col-6"> <input type="text" class="form-control " placeholder="calender" id="selected_date"></div>
                            <div class="col-6"><select class="form-select" id="selected_time">
                                    <option selected value="9:00">9:00</option>
                                    <option value="9:30">9:30</option>
                                    <option value="10:00">10:00</option>
                                    <option value="10:30">10:30</option>
                                    <option value='11:00'>11:00</option>
                                    <option value='11:30'>11:30</option>
                                    <option value='12:00'>12:00</option>
                                    <option value='12:30'>12:30</option>
                                    <option value='13:00'>13:00</option>
                                    <option value='13:30'>13:30</option>
                                    <option value='14:00'>14:00</option>
                                    <option value='14:30'>14:30</option>
                                    <option value='15:00'>15:00</option>
                                    <option value='15:30'>15:30</option>
                                    <option value='16:00'>16:00</option>
                                    <option value='16:30'>16:30</option>
                                    <option value='17:00'>17:00</option>
                                    <option value='17:30'>17:30</option>
                                    <option value='18:00'>18:00</option>
                                </select></div>
                        </div>
                        <div class="text-center">
                            <button type="submit" data-bs-dismiss="modal" class="btn_cancel" id="confirm_reschedule">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="service_history" class="tabcontent">
            <div class="clearfix">

                <div>
                    <p class="alignleft"> Service History</p>
                    <button class="alignright">Export</button>
                </div>
                <div id="dbrecord">
                </div>
                <!-- <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Service Details <img src="../image/sort.png" alt="..."></th>
                            <th scope="col"> Service Provider<img src="../image/sort.png" alt="..."></th>
                            <th scope="col"> Payment <img src="../image/sort.png" alt="..."></th>
                            <th scope="col"> Status <img src="../image/sort.png" alt="..."></th>
                            <th scope="col"> Rate SP </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table> -->




                <!-- <div class="card mobileview clearfix" style="width: 100%;">
                    <div class="card-body">
                        <span><img src="../image/calendar.png" alt="calender"><span class="date">31/03/2018</span> 12:00-18:00
                        </span>
                        <hr>
                        <div class="cap-icon"><img src="../image/cap.png" alt=".."></div>Lyum Watson
                        <div>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span>4</span>
                        </div>
                        <hr>
                        <p class="price">€63 </p>
                        <hr>
                        <div class="text-center"><button class="completed">completed</button></div>
                        <hr>
                        <div class="text-center"><button class="rate">Rate SP</button></div>
                    </div>
                    <div class="card-body">
                        <span><img src="../image/calendar.png" alt="calender"><span class="date">31/03/2018</span> 12:00-18:00
                        </span>
                        <hr>
                        <div class="cap-icon"><img src="../image/cap.png" alt=".."></div>Lyum Watson
                        <div>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span>4</span>
                        </div>
                        <hr>
                        <p class="price">€63 </p>
                        <hr>
                        <div class="text-center"><button class="cancelled">cancelled</button></div>
                        <hr>
                        <div class="text-center"><button class="rate">Rate SP</button></div>
                    </div>
                    <div class="card-body">
                        <span><img src="../image/calendar.png" alt="calender"><span class="date">31/03/2018</span> 12:00-18:00
                        </span>
                        <hr>
                        <div class="cap-icon"><img src="../image/cap.png" alt=".."></div>Lyum Watson
                        <div>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span>4</span>
                        </div>
                        <hr>
                        <p class="price">€63 </p>
                        <hr>
                        <div class="text-center"><button class="completed">completed</button></div>
                        <hr>
                        <div class="text-center"><button class="rate">Rate SP</button></div>
                    </div>
                </div>-->
            </div>

        </div>

        <!-- <div class="pagenumber">
                <div class="pagenumber-left">
                    <p>Show</p>
                    <div class="dropdown">
                        10
                    </div>
                    <p>entries</p>
                    <p style="margin-left: 8px;">Total Record: 55</p>
                </div>
                <div class="pagenumber-right">
                    <div class="pagenumber-btn">
                        <img src="../Asset/image/first-page.png" alt="">
                    </div>
                    <div class="pagenumber-btn">
                        <img src="../Asset/image/keyboard-right-arrow-button-copy.png" alt="">
                    </div>
                    <div class="pagenumber-btn " id="1">
                        1
                    </div>
                    <div class="pagenumber-btn" id="2">
                        2
                    </div>
                    <div class="pagenumber-btn" id="3">
                        3
                    </div>
                    <div class="pagenumber-btn" id="4">
                        4
                    </div>
                    <div class="pagenumber-btn">
                        <img class="transform_btn" src="../Asset/image/keyboard-right-arrow-button-copy.png" alt="">
                    </div>
                    <div class="pagenumber-btn">
                        <img class="transform_btn" src="../Asset/image/first-page.png" alt="">
                    </div>
                </div>
            </div>
        </div> -->

        <!-- 

        <div id="mysetting">
            <form action="">
                <div class="row">
                    <div class="col-4">
                        <label for="firstname" class="form-label">First name</label>
                        <input type="text" class="form-control" id="firstname" placeholder="First name">
                    </div>
                    <div class="col-4">
                        <label for="lastname" class="form-label">Last name</label>
                        <input type="text" class="form-control" id="lastname" placeholder="Last name">
                    </div>
                    <div class="col-4">
                        <label for="emailaddress" class="form-label">E-mail address</label>
                        <input type="text" class="form-control" id="emailaddress" placeholder="E-mail address">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label for="phonenumber" class="form-label">Mobile number</label>
                        <div class="input-group">
                            <div class="input-group-text">+49</div>
                            <input type="text" class="form-control" name="phonenumber" placeholder="Mobile Number" id="phonenumber" />
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="dob" class="form-label">date of birth</label>
                        <input type="date" class="form-control" id="dob">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-4">
                        <select class="form-select">
                            <option selected value="english">English</option>
                            <option value="hindi">Hindi</option>
                            <option value="gujarati">Gujarati</option>
                            <option value="french">French</option>
                        </select>
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="rate"> Save</button>
                </div>
            </form>
        </div>


        <div class="address" id="address">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Addresses</th>
                        <th scope="col"> Actions</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-label="Addresses">
                            <p>Address: <span> 99, xyz, vga</span></p>
                            <p>AMobile: <span> 9989652356</span></p>
                        </td>
                        <td data-label="Actions">
                            <img src="" alt="">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="password_change">
            <form action="">
                <div class="col-4">
                    <label for="oldpassword" class="form-label">Old Password</label>
                    <input type="password" class="form-control" id="oldpassword" placeholder="Old Password">
                </div>
                <div class="col-4">
                    <label for="newpassword" class="form-label">New password</label>
                    <input type="password" class="form-control" id="newpassword" placeholder="New Password">
                </div>
                <div class="col-4">
                    <label for="confirmpassword" class="form-label">Confirm password</label>
                    <input type="password" class="form-control" id="confirmpassword" placeholder="Confirm Password">
                </div>
                <div>
                    <button type="submit" class="rate">Save</button>
                </div>
            </form>
        </div>
 -->


        <!-- <div class="pagenumber">
            <div class="pagenumber-left">
                <p>Show</p>
                <div class="dropdown">
                    10
                </div>
                <p>entries</p>
                <p style="margin-left: 8px;">Total Record: 55</p>
            </div>
            <div class="pagenumber-right">
                <div class="pagenumber-btn">
                    <img src="../image/first-page.png" alt="">
                </div>
                <div class="pagenumber-btn">
                    <img src="../image/keyboard-right-arrow-button-copy.png" alt="">
                </div>
                <div class="pagenumber-btn " id="1">
                    1
                </div>
                <div class="pagenumber-btn" id="2">
                    2
                </div>
                <div class="pagenumber-btn" id="3">
                    3
                </div>
                <div class="pagenumber-btn" id="4">
                    4
                </div>
                <div class="pagenumber-btn">
                    <img class="transform_btn" src="../image/keyboard-right-arrow-button-copy.png" alt="">
                </div>
                <div class="pagenumber-btn">
                    <img class="transform_btn" src="../image/first-page.png" alt="">
                </div>
            </div>
        </div> -->


        <div id="service_schedule" class="tabcontent">
            <h3>Service Schedule</h3>
        </div>
        <div id="favourite_pros" class="tabcontent">
            <h3>Favourite Pros</h3>
        </div>
        <div id="invoices" class="tabcontent">
            <h3>Invoices</h3>
        </div>
        <div id="notifications" class="tabcontent">
            <h3>Notifications</h3>
        </div>
    </section>

    <!-- main page end -->





    <!-- footer start -->
    <div class="footer">
        <div class="container">
            <div class="row footer-start justify-content-center d-flex align-content-center">
                <div class="col-lg-2 text-center">
                    <img src="../image/footer-logo.png" alt="">
                </div>
                <div class="col-lg-8">
                    <div class="footer-navbar text-center p-4">
                        <a class="footer-menu" href="#">HOME</a>
                        <a class="footer-menu" href="#">ABOUT</a>
                        <a class="footer-menu" href="#">TESTIMONIALS</a>
                        <a class="footer-menu" href="#">FAQS</a>
                        <a class="footer-menu" href="#">INSURANCE</a>
                        <a class="footer-menu" href="#">POLICY</a>
                        <a class="footer-menu" href="#">IMPRESSUM</a>
                    </div>
                </div>
                <div class="col-lg-2 text-center">
                    <a href="#"><img src="../image/ic-facebook.png" alt="fb" class="fb"></a>
                    <a href="#"><img src="../image/ic-instagram.png" alt="insta" class="insta"></a>
                </div>
            </div>
            <div class="row">
                <hr>
                <div class="text-center footer-end">

                    <p>©2018 Helperland. All rights reserved. Terms and Conditions | Privacy Policy</p>
                </div>
            </div>
        </div>
    </div>

    <!-- footer end -->



    <script src="../Asset/js/service_history.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            <?php if (isset($_SESSION['username'])) { ?>

                var username = "<?php echo $_SESSION['username'] ?>";
                var userid = "<?php echo $_SESSION['userid']; ?>";
            <?php } ?>

            load_data();
            // var no = 5;
            // $("#no_of_service").on("change", function() {
            //     no = $(this).val();
            //     alert(no);
            //     load_data(page);
            // });

            function load_data(page) {
                $.ajax({
                    type: 'POST',
                    url: "http://localhost/php/helperland/?controller=Helperland&function=customer_data",
                    data: {
                        page: page,
                        //no: no,
                        // "userid": userid
                    },
                    success: function(data) {
                        console.log(data);
                        // console.log("hello");
                        $('#dbrecord').html(data);
                    }
                })
            }
            // $("#no_of_service").on("change", function() {
            //     var no = $(this).val();
            //     alert(no);
            //     load_data(page);
            // });
            $(document).on("click", ".pagenumber-btn", function() {
                var page = $(this).attr("id");

                load_data(page);
            })

            $('#dbrecord').on('click', '.rate', function() {
                id = $(this).attr("id");
                $('#delete_model').modal('show');
                document.querySelector('.deleteid').innerHTML = id;

            });
            $(document).on('click', '#confirm_delete', function() {
                //alert(id);
                id = $('.deleteid').text();
                console.log(id);
                load_data();
            });
        });



        $(document).ready(function() {
            <?php if (isset($_SESSION['username'])) { ?>

                var username = "<?php echo $_SESSION['username'] ?>";
                var userid = "<?php echo $_SESSION['userid']; ?>";
            <?php } ?>

            dashboard_data();
            // var no = 5;
            // $("#no_of_service").on("change", function() {
            //     no = $(this).val();
            //     alert(no);
            //     load_data(page);
            // });

            function dashboard_data(page) {
                $.ajax({
                    type: 'POST',
                    url: "http://localhost/php/helperland/?controller=Helperland&function=dashboard_data",
                    data: {
                        page: page,
                        //no: no,
                        // "userid": userid
                    },
                    success: function(data) {
                        console.log(data);
                        // console.log("hello");
                        $('#dashboard_content').html(data);
                    }
                })
            }
            // $("#no_of_service").on("change", function() {
            //     var no = $(this).val();
            //     alert(no);
            //     load_data(page);
            // });
            $(document).on("click", ".pagenumber-btn", function() {
                var page = $(this).attr("id");

                dashboard_data(page);

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
                        //no: no,
                        // "userid": userid
                    },
                    success: function(data) {
                        console.log(data);
                        // console.log("hello");
                        dashboard_data();
                    }
                })
            });


            $(document).on('click', '.reschedule', function() {
                id = $(this).attr("id");

                $('#reschedule_model').modal('show');
                $('#all_detail').modal('hide');
                $('#confirm_reschedule').val(id);

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
                        //no: no,
                        // "userid": userid
                    },
                    success: function(data) {
                        console.log(data);
                        // console.log("hello");
                        dashboard_data();
                    }
                })


            });

        });


        $(document).on('click', '.show_all_detail', function() {

            id = $(this).attr("id");
            alert(id);

            $.ajax({
                type: 'POST',
                url: "http://localhost/php/helperland/?controller=Helperland&function=detail_of_service",
                data: {
                    serviceid: id,
                    //no: no,
                    // "userid": userid
                },
                success: function(data) {
                    // console.log(data);
                    // console.log("hello");
                    // alert('hello');
                    // alert(data);
                    $('.show_all_details').html(data);
                    // show_all_details
                    $('#all_detail').modal('show');
                }
            })
        });
    </script>

</body>

</html>