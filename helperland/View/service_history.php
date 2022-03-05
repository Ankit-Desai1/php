<?php
if (isset($_SESSION['username'])) {
?>

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
        <link rel="stylesheet" href="./Asset/css/service_history.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <?php $base_url = 'http://localhost/php/helperland/'; ?>
        <script>
            var config = {
                routes: {
                    zone: "<?= $base_url ?>"
                }
            };
        </script>
    </head>

    <body>


        <nav class="navbar navbar-expand-lg navbar-dark fixed-top ">

            <div class="container-fluid">


                <a class="navbar-brand" asp-action="Index" asp-controller="Public">
                    <img src="./Asset/image/logo-small.png">
                </a>


                <?php
                if (isset($_SESSION['username'])) { ?>

                    <div class="notification position-relative nav-item order-lg-3 ">

                        <img src="./Asset/image/icon-notification.png" alt="">
                        <span class="badge rounded-circle position-absolute">2</span>
                    </div>

                    <div class="nav-item dropdown  order-lg-4 d-lg-block d-none " id="upcomingUser">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="./Asset/image/user.png" alt="">
                        </a>
                        <ul class="dropdown-menu dropdown dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li id="userWelcomeName">
                                Welcome,
                                <br />
                                <span id="UsernameNav"><?php echo $_SESSION['username'] ?> </span>
                            </li>
                            <li><a class="dropdown-item" href="<?= $base_url . '?controller=Helperland&function=service_history&tablinks=dashboardtab_btn' ?>">My Dashbord</a></li>
                            <li><a class="dropdown-item" href="<?= $base_url . '?controller=Helperland&function=service_history&tablinks=my_setting_btn' ?>">My Setting</a></li>
                            <li><a class="dropdown-item" href="<?= $base_url . '?controller=Helperland&function=logout' ?>">Logout</a></li>
                        </ul>
                    </div>

                <?php
                }
                ?>

                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="offcanvas offcanvas-end navbar-collapse menu " tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                    <ul class="navbar-nav navbar-content">

                        <div class="d-lg-none">
                            <li class="welcomeNav">
                                Welcome,
                                <span id="UsernameNav"><?php echo $_SESSION['username'] ?></span>
                            </li>

                            <hr class="d-lg-none">
                            <li class="nav-item">
                                <a class="nav-link " href="<?= $base_url . '?controller=Helperland&function=service_history&tablinks=dashboardtab_btn' ?>">Dashbord</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="<?= $base_url . '?controller=Helperland&function=service_history&tablinks=service_btn' ?>">Service History</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="<?= $base_url . '?controller=Helperland&function=service_history&tablinks=service_schedule_btn' ?>">Service Schedule</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="<?= $base_url . '?controller=Helperland&function=service_history&tablinks=favourite_btn' ?>">Favourite Pros</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="<?= $base_url . '?controller=Helperland&function=service_history&tablinks=invoice_btn' ?>"> Invoices </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link " href="<?= $base_url . '?controller=Helperland&function=service_history&tablinks=my_setting_btn' ?>">My Setting</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="<?= $base_url . '?controller=Helperland&function=logout' ?>">Logout</a>
                            </li>
                            <hr class="d-lg-none">
                        </div>

                        <li class="nav-item">
                            <a class="nav-link Btn bookNowBtn" href="<?= $base_url . '?controller=Helperland&function=book_service' ?>">Book now</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $base_url . '?controller=Helperland&function=prices' ?>">Prices & services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ">Warranty</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="<?= $base_url . '?controller=Helperland&function=contact' ?>">Contact </a>
                        </li>

                    </ul>

                </div>

            </div>

        </nav>








        <!-- header -->

        <!-- welcome start -->
        <section class="welcome">
            <h1>Welcome, <span><?php echo $_SESSION['username']; ?>!</span> </h1>
        </section>
        <!-- welcome end -->

        <!-- main page start -->

        <section class="main_service clearfix container">

            <div class="tab">
                <button class="tablinks" onclick="upcoming_service(event, 'dashboard')" id="dashboardtab_btn">Dashboard</button>
                <button class="tablinks" onclick="upcoming_service(event, 'service_history')" id="service_btn">Service
                    History</button>
                <button class="tablinks" onclick="upcoming_service(event, 'service_schedule')" id="service_schedule_btn">Service Schedule</button>
                <button class="tablinks" onclick="upcoming_service(event, 'favourite_pros')" id="favourite_btn">Favourite Pros</button>
                <button class="tablinks" onclick="upcoming_service(event, 'invoices')" id="invoice_btn">invoices</button>
                <button class="tablinks" onclick="upcoming_service(event, 'notifications')" id="notification_btn">Notifications</button>
                <button class="tablinks" style="display: none;" onclick="upcoming_service(event, 'my_setting')" id="my_setting_btn">my_setting</button>
            </div>
            </div>

            <div id="dashboard" class="tabcontent">

                <div class="clearfix">
                    <div>
                        <p class="alignleft">Current Service Requests</p>
                        <a href="<?= $base_url . '?controller=Helperland&function=book_service' ?>" type="button" class="alignright">Add new service request</a>
                        <!-- <button class="alignright">Add new service request</button> -->
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
                        <button class="alignright" id="export">Export</button>
                    </div>
                    <div id="dbrecord">
                    </div>
                </div>
            </div>

            <div class="modal" id="rate_serviceprovider" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="show_rating_model"></div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <h4 class="rateservicepro">
                                    Rate Your Service Provider
                                </h4>
                                <hr class="reschedulehr">

                                <div class="ontimearrival starratings ratingfortimearrival row ml-1">
                                    <p class="mr-2 ratingtxt">On Time Arrival</p>

                                    <span class="ratings1s ">
                                        <i class="fa fa-star " id="ontime1"></i>
                                        <i class="fa fa-star " id="ontime2"></i>
                                        <i class="fa fa-star " id="ontime3"></i>
                                        <i class="fa fa-star " id="ontime4"></i>
                                        <i class="fa fa-star " id="ontime5"></i>
                                        <span class="infomsg"></span>
                                    </span>
                                </div>

                                <div class="ontimearrival starratings ratingforfriendly row ml-1">
                                    <p class="mr-2 ratingtxt">Friendly</p>

                                    <span class="ratings2 ">
                                        <i class="fa fa-star " id="friendly1"></i>
                                        <i class="fa fa-star " id="friendly2"></i>
                                        <i class="fa fa-star " id="friendly3"></i>
                                        <i class="fa fa-star " id="friendly4"></i>
                                        <i class="fa fa-star " id="friendly5"></i>
                                        <span class="friendlymsg"></span>
                                    </span>
                                </div>

                                <div class="ontimearrival starratings ratingforquality row ml-1">
                                    <p class="mr-2 ratingtxt">Quality Of Service</p>

                                    <span class="ratings3 ">
                                        <i class="fa fa-star " id="quality1"></i>
                                        <i class="fa fa-star " id="quality2"></i>
                                        <i class="fa fa-star " id="quality3"></i>
                                        <i class="fa fa-star " id="quality4"></i>
                                        <i class="fa fa-star " id="quality5"></i>
                                        <span class="qualitymsg"></span>

                                    </span>
                                </div>

                                <div class="form-group givefeedback">
                                    <label for="feedbackcomment">Comments</label>
                                    <textarea class="form-control" id="feedbackcomment" rows="2"></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" data-bs-dismiss="modal" class="btn_cancel" id="confirm_rating">Submit</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>


            <div id="service_schedule" class="tabcontent">
                <h3>Service Schedule</h3>
            </div>
            <div id="favourite_pros" class="tabcontent">
                <div class="displayfavourite">
                </div>
            </div>
            <div id="invoices" class="tabcontent">
                <h3>Invoices</h3>
            </div>
            <div id="notifications" class="tabcontent">
                <h3>Notifications</h3>
            </div>
            <div id="my_setting" class="tabcontent">
                <div>
                    <ul class="nav nav-tabs nav-justified mb-3" role="tablist" id="myTab1111">
                        <li class="nav-item ">
                            <button class="nav-link active" id="nav-tab1" data-bs-toggle="tab" data-bs-target="#mysetting" role="tab">My Details</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="nav-tab2" data-bs-toggle="tab" data-bs-target="#address" role="tab">My Addresses</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="nav-tab3" data-bs-toggle="tab" data-bs-target="#password_change" role="tab">Change Password</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="tab12">
                        <div class="tab-pane fade show active " id="mysetting" aria-labelledby="nav-tab1">
                            <form method="post">
                                <div class="row mb-3">
                                    <div class="col-4">
                                        <label for="firstname" class="form-label">First name</label>
                                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First name">
                                        <div class="first-name-msg"></div>
                                    </div>
                                    <div class="col-4">
                                        <label for="lastname" class="form-label">Last name</label>
                                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last name">
                                        <div class="last-name-msg"></div>
                                    </div>
                                    <div class="col-4">
                                        <label for="emailaddress" class="form-label">E-mail address</label>
                                        <input type="text" class="form-control" id="emailaddress" name="emailaddress" placeholder="E-mail address" disabled>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-4">
                                        <label for="phonenumber" class="form-label">Mobile number</label>
                                        <div class="input-group">
                                            <div class="input-group-text">+49</div>
                                            <input type="text" class="form-control" name="phonenumber" placeholder="Mobile Number" maxlength="10" size="10" id="phonenumber" />
                                        </div>
                                        <div class="mobile-msg"></div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row birthdate">
                                            <label for="dateofbirth" class="form-label">Date of birth</label>
                                            <div class="col-4">
                                                <select class="form-select" id="dateofbirth" name="dateofbirth">
                                                    <option value="Day">Day</option>
                                                    <option value="01">01</option>
                                                    <option value="02">02</option>
                                                    <option value="03">03</option>
                                                    <option value="04">04</option>
                                                    <option value="05">05</option>
                                                    <option value="06">06</option>
                                                    <option value="07">07</option>
                                                    <option value="08">08</option>
                                                    <option value="09">09</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                    <option value="25">25</option>
                                                    <option value="26">26</option>
                                                    <option value="27">27</option>
                                                    <option value="28">28</option>
                                                    <option value="29">29</option>
                                                    <option value="30">30</option>
                                                    <option value="31">31</option>
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <select class="form-select" id="dateofmonth" name="monthofbirth">
                                                    <option value="Month">Month</option>
                                                    <option value="01">January</option>
                                                    <option value="02">February</option>
                                                    <option value="03">March</option>
                                                    <option value="04">April</option>
                                                    <option value="05">May</option>
                                                    <option value="06">June</option>
                                                    <option value="07">July</option>
                                                    <option value="08">August</option>
                                                    <option value="09">September</option>
                                                    <option value="10">October</option>
                                                    <option value="11">November</option>
                                                    <option value="12">December</option>
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <select class="form-select" id="yearofbirth" name="yearofbirth">
                                                    <option value="Year">Year</option>
                                                    <option value="2000">2000</option>
                                                    <option value="2001">2001</option>
                                                    <option value="2002">2002</option>
                                                    <option value="2003">2003</option>
                                                    <option value="2004">2004</option>
                                                    <option value="2005">2005</option>
                                                    <option value="2006">2006</option>
                                                    <option value="2007">2007</option>
                                                    <option value="2008">2008</option>
                                                    <option value="2009">2009</option>
                                                    <option value="2010">2010</option>
                                                    <option value="2011">2011</option>
                                                    <option value="2012">2012</option>
                                                    <option value="2013">2013</option>
                                                    <option value="2014">2014</option>
                                                    <option value="2015">2015</option>
                                                    <option value="2016">2016</option>
                                                    <option value="2017">2017</option>
                                                    <option value="2018">2018</option>
                                                    <option value="2019">2019</option>
                                                    <option value="2020">2020</option>
                                                    <option value="2021">2021</option>
                                                    <option value="2022">2022</option>
                                                </select>
                                            </div>
                                            <div class="date-error"></div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row ">
                                    <div class="col-4">
                                        <select class="form-select" id="languageid" name="languageid">
                                            <option value="1">English</option>
                                            <option value="2">Hindi</option>
                                            <option value="3">Gujarati</option>
                                            <option value="4">French</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="blue_button " id="save_details"> Save</button>
                                </div>
                            </form>

                        </div>
                        <div class="tab-pane fade" id="address" aria-labelledby="nav-tab2">
                            <div class="address" id="">
                                <div class="addressmsg"></div>
                                <table class="table tableaddress">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">Addresses</th>
                                            <th scope="col"> Actions</th>

                                        </tr>
                                    </thead>
                                    <tbody id="alladdress">

                                    </tbody>
                                </table>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#add_newaddress_model" class="blue_button mt-3 mb-2">add new address</button>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="password_change" aria-labelledby="nav-tab3">
                            <div class="passworderror bg-danger"></div>
                            <div class="row">
                                <form action="">
                                    <div class="col-5">
                                        <label for="oldpassword" class="form-label">Old Password</label>
                                        <input type="password" class="form-control invalid-input" id="oldpassword" placeholder="Old Password">
                                        <div class="old-password-msg mb-2"></div>
                                    </div>
                                    <div class="col-5">
                                        <label for="newpassword" class="form-label">New password</label>
                                        <input type="password" class="form-control invalid-input" id="newpassword" placeholder="New Password">
                                        <div class="password-msg mb-2"></div>
                                    </div>
                                    <div class="col-5">
                                        <label for="confirmpassword" class="form-label">Confirm password</label>
                                        <input type="password" class="form-control invalid-input" id="confirmpassword" placeholder="Confirm Password">
                                        <div class="cpassword-msg mb-2"></div>
                                    </div>
                                    <div>
                                        <button type="submit" class="blue_button" id="change_password" disabled>Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal" tabindex="-1" id="add_newaddress_model">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add New Address</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col-md-6 col-sm-12">
                                    <label for="streetname" class="form-label">Street name</label>
                                    <input type="text" class="form-control invalid-input" name="streetname" placeholder="Street name" id="streetname" />
                                    <div class="street-msg2"></div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="housenumber" class="form-label">House number</label>
                                    <input type="text" class="form-control invalid-input" name="housenumber" placeholder="House number" id="housenumber" />
                                    <div class="house-msg2"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6 col-sm-12">
                                    <label for="postalcode" class="form-label">Postal Code</label>
                                    <input type="text" class="form-control invalid-input" name="postalcode" placeholder="Postal Code" id="pincode" />
                                    <div class="postal_number2"></div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control invalid-input" name="city" placeholder="City" id="city" />
                                    <div class="city-msg2"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6 col-sm-12">
                                    <label for="mobile" class="form-label">Phone number</label>
                                    <div class="input-group">
                                        <div class="input-group-text">+49</div>
                                        <input type="tel" class="form-control invalid-input" name="mobile" maxlength="10" size="10" placeholder="Mobile Number" id="mobile" />
                                    </div>
                                    <div class="mobile-msg2"></div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" data-bs-dismiss="modal" class="btn_cancel" id="add_new_address" disabled>Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal" tabindex="-1" id="edit_address_model">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Address</h5>
                            <div class="mmmm"></div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col-md-6 col-sm-12">
                                    <label for="street_name" class="form-label">Street name</label>
                                    <input type="text" class="form-control" name="streetname" placeholder="Street name" id="street_name" />
                                    <div class="street-msg"></div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="house_number" class="form-label">House number</label>
                                    <input type="text" class="form-control" name="housenumber" placeholder="House number" id="house_number" />
                                    <div class="house-msg"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6 col-sm-12">
                                    <label for="postal_code" class="form-label">Postal Code</label>
                                    <input type="text" class="form-control" name="postalcode" placeholder="Postal Code" id="postal_code" />
                                    <div class="postal_number"></div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="location" class="form-label">City</label>
                                    <input type="text" class="form-control" name="city" placeholder="City" id="location" />
                                    <div class="city-msg"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6 col-sm-12">
                                    <label for="mobilenumber" class="form-label">Phone number</label>
                                    <div class="input-group">
                                        <div class="input-group-text">+49</div>
                                        <input type="tel" class="form-control" name="mobile" maxlength="10" size="10" placeholder="Mobile Number" id="mobilenumber" />
                                    </div>
                                    <div class="mobile-msg"></div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" data-bs-dismiss="modal" class="btn_cancel" id="editAddress">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal" tabindex="-1" id="delete_address_model">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Delete Address</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you Sure!! You Want To Delete It.</p>
                            <div class="text-center">
                                <button type="submit" data-bs-dismiss="modal" class="btn_cancel" id="confirm_delete_address">Yes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <!-- main page end -->





        <!-- footer start -->
        <?php
        include("footer.php");
        ?>

        <!-- footer end -->



        <script src="./Asset/js/service_history.js"></script>
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
        <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.10/dist/sweetalert2.all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
        <script>

        </script>

        <?php
        include("customer_ajax.php");
        ?>

    </body>

    </html>

<?php
}
?>