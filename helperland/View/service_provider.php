<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>upcoming service</title>
    <link rel="stylesheet" href="./Asset/css/upcoming_service.css">
    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
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
    <!-- header -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top ">

        <div class="container-fluid">

            <a class="navbar-brand">
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
                        <li><a class="dropdown-item" href="<?= $base_url . '?controller=Helperland&function=service_provider&tablinks=dashboard_btn' ?>">My Dashbord</a></li>
                        <li><a class="dropdown-item" href="<?= $base_url . '?controller=Helperland&function=service_provider&tablinks=my_setting_btn' ?>">My Setting</a></li>
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
                            <a class="nav-link " href="<?= $base_url . '?controller=Helperland&function=service_provider&tablinks=dashboard_btn' ?>">Dashbord</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="<?= $base_url . '?controller=Helperland&function=service_provider&tablinks=new_service_btn' ?>">New Service Request</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="<?= $base_url . '?controller=Helperland&function=service_provider&tablinks=upcoming_service_btn' ?>">Upcoming Service</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="<?= $base_url . '?controller=Helperland&function=service_provider&tablinks=service_schedule_btn' ?>">Service Schedule</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="<?= $base_url . '?controller=Helperland&function=service_provider&tablinks=service_history_btn' ?>">Service History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="<?= $base_url . '?controller=Helperland&function=service_provider&tablinks=rating_btn' ?>">My Rating</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="<?= $base_url . '?controller=Helperland&function=service_provider&tablinks=block_btn' ?>">Block Customer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="<?= $base_url . '?controller=Helperland&function=service_provider&tablinks=my_setting_btn' ?>">My Setting</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="<?= $base_url . '?controller=Helperland&function=logout' ?>">Logout</a>
                        </li>
                        <hr class="d-lg-none">
                    </div>
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
            <button class="tablinks" onclick="upcoming_service(event, 'dashboard')" id="dashboard_btn">Dashboard</button>
            <button class="tablinks" onclick="upcoming_service(event, 'new_service_request')" id="new_service_btn">New Service Request</button>
            <button class="tablinks" onclick="upcoming_service(event, 'upcoming_services')" id="upcoming_service_btn">Upcoming Services</button>
            <button class="tablinks" onclick="upcoming_service(event, 'service_schedule')" id="service_schedule_btn">Service Schedule</button>
            <button class="tablinks" onclick="upcoming_service(event, 'service_history')" id="service_history_btn">Service History</button>
            <button class="tablinks" onclick="upcoming_service(event, 'my_ratings')" id="rating_btn">My Ratings</button>
            <button class="tablinks" onclick="upcoming_service(event, 'block_customer')" id="block_btn">Block Customer</button>
            <button class="tablinks" style="display: none;" onclick="upcoming_service(event, 'my_setting')" id="my_setting_btn">my_setting</button>
        </div>
        </div>

        <div id="dashboard" class="tabcontent">
            <h3>Dashboard</h3>
        </div>
        <div class="show_all_details"></div>
        <div id="new_service_request" class="tabcontent">

            <span><input type="checkbox" class="form-check-input" name="" id="checkboxpet" value="checkedValue" checked>
            </span>
            <span>Include pet at home</span>
            <div id="new_service_db" class="mt-3"></div>

        </div>
        <div id="upcoming_services" class="tabcontent">
        </div>
        <div id="service_schedule" class="tabcontent">
            <h3>Service Schedule</h3>
        </div>
        <div id="service_history" class="tabcontent">
            <span class="paymentStatus">Payment Status
            </span>
            <select name="payment" id="payment">
                <option value="all">All </option>
            </select>
            <button class="blue_button" id="export">Export</button>
            <div id="history_db"></div>
        </div>
        <div id="my_ratings" class="tabcontent">
            <span>Rating
            </span>
            <select name="rating">
                <option value="all">All </option>
            </select>
            <div id="rating"></div>
        </div>
        <div id="block_customer" class="tabcontent">
        </div>
        <div id="my_setting" class="tabcontent">
            <div>
                <ul class="nav nav-tabs nav-justified  mb-3" role="tablist" id="myTab11">
                    <li class="nav-item ">
                        <button class="nav-link active" id="nav-tab1" data-bs-toggle="tab" data-bs-target="#mysetting" role="tab">My Details</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" id="nav-tab3" data-bs-toggle="tab" data-bs-target="#password_change" role="tab">Change Password</button>
                    </li>
                </ul>

                <div class="tab-content" id="tab12">
                    <div class="tab-pane fade show active " id="mysetting" aria-labelledby="nav-tab1">
                        <div class="alert text-center d-none" id="user_error" role="alert">
                        </div>
                        <div class="row">
                            <div class="col-10">
                                <p>Account Status: <span style="color: green;">Active</span></p>
                                <p>Basic Details</p>
                                <hr>
                            </div>
                            <div class="col-2 profilepicture" id="1avtar" style="display: none;"><img src="./Asset/image/avatar-car.png" alt=".."></div>
                            <div class="col-2 profilepicture" id="2avtar" style="display: none;"><img src="./Asset/image/avatar-female.png" alt=".."></div>
                            <div class="col-2 profilepicture" id="3avtar" style="display: none;"><img src="./Asset/image/avatar-hat.png" alt=".."></div>
                            <div class="col-2 profilepicture" id="4avtar" style="display: none;"><img src="./Asset/image/avatar-iron.png" alt=".."></div>
                            <div class="col-2 profilepicture" id="5avtar" style="display: none;"><img src="./Asset/image/avatar-male.png" alt=".."></div>
                            <div class="col-2 profilepicture" id="6avtar" style="display: none;"><img src="./Asset/image/avatar-ship.png" alt=".."></div>

                        </div>

                        <form method="post">
                            <div class="row mb-3">
                                <div class="col-md-4 col-sm-12">
                                    <label for="firstname" class="form-label">First name</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First name">
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <label for="lastname" class="form-label">Last name</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last name">
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <label for="emailaddress" class="form-label">E-mail address</label>
                                    <input type="text" class="form-control" id="emailaddress" name="emailaddress" placeholder="E-mail address" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 col-sm-12">
                                    <label for="phonenumber" class="form-label">Mobile number</label>
                                    <div class="input-group">
                                        <div class="input-group-text">+49</div>
                                        <input type="text" class="form-control" name="phonenumber" placeholder="Mobile Number" maxlength="10" size="10" id="phonenumber" />
                                    </div>

                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="row birthdate">
                                        <label for="dateofbirth" class="form-label">Date of birth</label>
                                        <select class="form-select" id="dateofbirth" name="dateofbirth" style="max-width: 30%;">
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


                                        <select class="form-select" id="dateofmonth" name="monthofbirth" style="max-width: 35%;">
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

                                        <select class="form-select" id="yearofbirth" name="yearofbirth" style="max-width: 35%;">
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
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <label for="nationalityid" class="form-label">Nationality</label>
                                    <select class="form-select" id="nationalityid">
                                        <option value="1">Indian</option>
                                        <option value="2">American</option>
                                        <option value="3">German</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3 select-gender">
                                <p>Gender</p>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="gender1" value="1">
                                        <label class="form-check-label" for="gender1">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="gender2" value="2">
                                        <label class="form-check-label" for="gender2">Female</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="gender3" value="3">
                                        <label class="form-check-label" for="gender3">Rather Not To Say</label>
                                    </div>
                                </div>
                            </div>
                            <div class=select-avtar>
                                <p>Select Avtar</p>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="avtar" id="avtar1" value="1" checked>
                                        <label class="form-check-label" for="avtar1"><img src="./Asset/image/avatar-car.png" alt=".."></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="avtar" id="avtar2" value="2">
                                        <label class="form-check-label" for="avtar2"><img src="./Asset/image/avatar-female.png" alt=".."></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="avtar" id="avtar3" value="3">
                                        <label class="form-check-label" for="avtar3"><img src="./Asset/image/avatar-hat.png" alt=".."></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="avtar" id="avtar4" value="4">
                                        <label class="form-check-label" for="avtar4"><img src="./Asset/image/avatar-iron.png" alt=".."></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="avtar" id="avtar5" value="5">
                                        <label class="form-check-label" for="avtar5"><img src="./Asset/image/avatar-male.png" alt=".."></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="avtar" id="avtar6" value="6">
                                        <label class="form-check-label" for="avtar6"><img src="./Asset/image/avatar-ship.png" alt=".."></label>
                                    </div>
                                </div>
                            </div>
                            <p>My Address</p>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-md-4 col-sm-12">
                                    <label for="streetname" class="form-label">Street name</label>
                                    <input type="text" class="form-control invalid-input" name="streetname" placeholder="Street name" id="streetname" />
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <label for="housenumber" class="form-label">House number</label>
                                    <input type="text" class="form-control invalid-input" name="housenumber" placeholder="House number" id="housenumber" />
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <label for="postalcode" class="form-label">Postal Code</label>
                                    <input type="text" class="form-control invalid-input" name="postalcode" placeholder="Postal Code" id="pincode" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 col-sm-12">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control invalid-input" name="city" placeholder="City" id="city" />
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="blue_button" id="save_details"> Save</button>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="password_change" aria-labelledby="nav-tab3">
                        <div class="alert text-center d-none" id="password_error" role="alert">
                        </div>
                        <div class="row">
                            <form action="">
                                <div class="col-md-5 col-sm-11">
                                    <label for="oldpassword" class="form-label">Old Password</label>
                                    <input type="password" class="form-control" id="oldpassword" placeholder="Old Password">

                                </div>
                                <div class="col-md-5 col-sm-11">
                                    <label for="newpassword" class="form-label">New password</label>
                                    <input type="password" class="form-control" id="newpassword" placeholder="New Password">

                                </div>
                                <div class="col-md-5 col-sm-11">
                                    <label for="confirmpassword" class="form-label">Confirm password</label>
                                    <input type="password" class="form-control" id="confirmpassword" placeholder="Confirm Password">

                                </div>
                                <div>
                                    <button type="submit" class="blue_button" id="change_password">Save</button>
                                </div>
                            </form>
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

    <script src="./Asset/js/service_provider.js"></script>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.10/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>


    <?php
    include("service_provider_ajax.php");
    ?>

</body>

</html>