<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Book service</title>
    <link rel="stylesheet" href="./Asset/css/Book_service.css">
    <?php $base_url = 'http://localhost/php/helperland/'; ?>
    <script>
        var config = {
            routes: {
                zone: "<?= $base_url ?>"
            }
        };
    </script>

    <style>

    </style>
</head>
<?php
if (isset($_SESSION['username'])) {
?>

    <body>

        <?php
        include("navbar.php");
        ?>



        <div>
            <img src="./Asset/image/book-service-banner.jpg" class="img-fluid" alt="...">
        </div>

        <section class="prices-services">
            <div>
                <h1 class="title text-center">Set up your cleaning services</h1>

            </div>

            <div class="text-center">
                <img src="./Asset/image/faq-seprator.png" class="img-fluid image-seprator" alt="...">
            </div>

        </section>

        <section class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 clearfix">

                    <div class="tab">
                        <button class="tablinks" onclick="set_service(event, 'form1')" id="defaultopen"><img src="./Asset/image/setupservice.png" alt=".."> <span class="btnforcontent"> Setup service</span></button>
                        <button class="tablinks" onclick="set_service(event, 'form2')" id="tab2btn"><img src="./Asset/image/schedule.png" alt=".."><span class="btnforcontent"> Schedule & Plan</span></button>
                        <button class="tablinks" onclick="set_service(event, 'form3')" id="tab3btn"><img src="./Asset/image/details.png" alt=".."><span class="btnforcontent"> Your Details</span></button>
                        <button class="tablinks" onclick="set_service(event, 'form4')" id="tab4btn"><img src="./Asset/image/payment.png" alt=".."><span class="btnforcontent"> Make Payment</span></button>
                    </div>


                    <!-- 
----------------------------------Enter postal-------------------------------------- -->

                    <div id="form1" class="tabcontent">
                        <div class="mt-3">
                            <label for="postalcode" class="form-label">Enter your postal code</label>
                        </div>
                        <div>
                            <input type="text" id="postalcode" placeholder="Enter Your Postal code">
                            <button type="submit" class="checkavailability" id="check_availability">Check
                                Availability</button>
                        </div>
                        <div id="postal_err"></div>
                    </div>



                    <!-- ---------------- --------------------------- schedule & plan ------------------------------- -->

                    <div id="form2" class="tabcontent schedule">
                        <h2>Select number of rooms and bath</h2>
                        <div class="row">
                            <div class="col-2">
                                <select class="form-select" aria-label="Default select example" id="selectedbed">
                                    <option selected value="1">1 bed</option>
                                    <option value="2">2 bed</option>
                                    <option value="3">3 bed</option>
                                    <option value="4">4 bed</option>
                                    <option value="5">5 bed</option>
                                </select>
                            </div>
                            <div class="col-2">
                                <select class="form-select" aria-label="Default select example" id="selectedbath">
                                    <option selected value="1">1 bath</option>
                                    <option value="2">2 bath</option>
                                    <option value="3">3 bath</option>
                                    <option value="4">4 bath</option>
                                    <option value="5">5 bath</option>
                                </select>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-6">
                                <h2>when do you need cleaner?</h2>
                                <div class="row">
                                    <div class="col-5">
                                        <input type="text" class="form-control " placeholder="calender" id="selected_date">
                                    </div>
                                    <div class="col-4">
                                        <select class="form-select" aria-label="Default select example" id="selectedtime">
                                            <option selected value="9">9:00</option>
                                            <option value="9.5">9:30</option>
                                            <option value="10">10:00</option>
                                            <option value="10.5">10:30</option>
                                            <option value='11'>11:00</option>
                                            <option value='11'>11:00</option>
                                            <option value='11.5'>11:30</option>
                                            <option value='12'>12:00</option>
                                            <option value='12.5'>12:30</option>
                                            <option value='13'>13:00</option>
                                            <option value='13.5'>13:30</option>
                                            <option value='14'>14:00</option>
                                            <option value='14.5'>14:30</option>
                                            <option value='15'>15:00</option>
                                            <option value='15.5'>15:30</option>
                                            <option value='16'>16:00</option>
                                            <option value='16.5'>16:30</option>
                                            <option value='17'>17:00</option>
                                            <option value='17.5'>17:30</option>
                                            <option value='18'>18:00</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="col-6">
                                <h2>how longer do you need your cleaner to stay? </h2>
                                <div class="col-4">
                                    <select class="form-select" aria-label="Default select example" id="servicetime">
                                        <option selected value="3">3.0 hrs</option>
                                        <option value="4">4.0 hrs</option>
                                        <option value="5">5.0 hrs</option>
                                        <option value="6">6.0 hrs</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <h2>Extra services</h2>


                        <div class="container extra_services">
                            <div class="row text-center">
                                <div class="col-sm">
                                    <input type="checkbox" id="InsideCabinat" class="hiddencheckbox" onclick="extrabtnclick(id,3)">
                                    <label for="InsideCabinat" class="btn"><img src="./Asset/image/3.png" id="InsideCabinatImg" alt="..."></label>
                                    <p class="service">Inside cabinets</p>

                                </div>
                                <div class="col-sm">
                                    <input type="checkbox" id="InsideFridge" class="hiddencheckbox" onclick="extrabtnclick(id,5)">
                                    <label for="InsideFridge" class="btn"><img src="./Asset/image/5.png" id="InsideFridgeImg" alt="..."></label>

                                    <p class="service">Inside fridge</p>

                                </div>
                                <div class="col-sm">
                                    <input type="checkbox" id="InsideOven" class="hiddencheckbox" onclick="extrabtnclick(id,4)">
                                    <label for="InsideOven" class="btn"><img src="./Asset/image/4.png" id="InsideOvenImg" alt="..."></label>

                                    <p class="service">Inside oven</p>

                                </div>
                                <div class="col-sm">
                                    <input type="checkbox" id="InsideLaundry" class="hiddencheckbox" onclick="extrabtnclick(id,2)">
                                    <label for="InsideLaundry" class="btn"><img src="./Asset/image/2.png" id="InsideLaundryImg" alt="..."></label>

                                    <p class="service">Laundry wash & dry</p>

                                </div>
                                <div class="col-sm">
                                    <input type="checkbox" id="InsideWindow" class="hiddencheckbox" onclick="extrabtnclick(id,1)">
                                    <label for="InsideWindow" class="btn"><img src="./Asset/image/1.png" id="InsideWindowImg" alt="..."></label>
                                    <p class="service">Interior windows</p>

                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="comments">
                            <label for="comments" class="form-label">Comments</label>
                            <textarea class="form-control" id="comments" rows="3"></textarea>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="havepet">
                            <label class="form-check-label" for="havepet">
                                I have pets at home
                            </label>
                        </div>
                        <hr>
                        <button class="continue" type="submit" id="schedule_plan">
                            Continue
                        </button>
                    </div>

                    <!-- 
<------------------------------ your detail tab-------------------------------->

                    <div id="form3" class="tabcontent">
                        <p>Please select your age:</p>
                        <div class="addresserror "></div>
                        <div id="alladdress"></div>
                        <button class="btn add_address" id="add_address">+ Add New
                            Address</button>
                        <form class="address_form" method="POST" id="new_address">
                            <div class="row mb-3">
                                <div class="col-md-6 col-sm-12">
                                    <label for="streetname" class="form-label">Street name</label>
                                    <input type="text" class="form-control" name="streetname" placeholder="Street name" id="streetname" />
                                    <div class="err-street"></div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="housenumber" class="form-label">House number</label>
                                    <input type="text" class="form-control" name="housenumber" placeholder="House number" id="housenumber" />
                                    <div class="err-houseno"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6 col-sm-12">
                                    <label for="postalcode" class="form-label">Postal Code</label>
                                    <input type="text" class="form-control" name="postalcode" placeholder="Postal Code" disabled id="pincode" />
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" name="city" placeholder="City" id="city" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6 col-sm-12">
                                    <label for="phonenumber" class="form-label">Phone number</label>
                                    <div class="input-group">
                                        <div class="input-group-text">+49</div>
                                        <input type="text" class="form-control" name="phonenumber" placeholder="Mobile Number" id="phonenumber" />
                                    </div>
                                    <div class="err-mobile"></div>
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="btn save" id="address_save">Save</button>
                                <button type="btn" class="btn cancel" id="cancel">Cancel</button>
                            </div>
                        </form>
                        <hr>
                        <button class="continue" type="submit" id="select_address">
                            Continue
                        </button>
                    </div>

                    <!-- 
--------------------------MAke Payment--------------------------------- -->


                    <div id="form4" class="tabcontent make_payment">
                        <h2>Pay Secuerly with Helperland Payment Gateway! </h2>
                        <label for="promo">Promo code (Optional)</label>
                        <div class="flex">
                            <input type="text" placeholder="Promo code (Optional)" id="promo">
                            <button type="submit" class="apply-btn" id="promocode">Apply</button>
                        </div>
                        <div class="promocode_error text-danger"></div>
                        <hr>
                        <div class="terms_check">
                            <input type="checkbox" id="payment_term"> I accepted terms and conditions, the cancellation policy and the privacy policy. I confirm that Helperland starts to execute the contract before the expiry of the withdrawal period and I lose my right of withdrawal
                            as a consumer with full performance of the contract.
                        </div>
                        <hr>
                        <button class="continue" type="submit" id="complete_booking" data-bs-toggle="modal" data-bs-target="#confirmform">
                            Complete Booking
                        </button>
                    </div>
                </div>

                <div class="modal fade" id="confirmform" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="forgotform" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="service_status">
                                    <i class="fas fa-badge-check"></i>
                                    <p>you service has been submited successfully</p>
                                    <p>Service ID: <span id="service_id"></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 
--------------------------------payment summary card---------------------------------------- -->

                <div class="col-lg-4 col-md-12">

                    <div class="card">
                        <div class="card-header">
                            Payment Summary
                        </div>
                        <div class="card-body">
                            <p class="card-text"><span id="booking_date"></span> @ <span id="booking_time">9:00</span> <br> <span id="booking_bed">1</span> bed, <span id="booking_bath">1</span> bath.</p>

                            <h3 class="card-text">
                                Duration
                            </h3>
                            <div class="row">
                                <div class="col">
                                    <p class="card-text">
                                        Basic
                                    </p>
                                </div>
                                <div class="col">
                                    <p class="card-text text-end">
                                        <span id="basic_time">3</span> Hrs
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p class="card-text extra1" id="extra3" style="display: none;">
                                        Inside cabinets (extra)
                                    </p>
                                    <p class="card-text extra2" id="extra5" style="display: none;">
                                        Inside fridge (extra)
                                    </p>
                                    <p class="card-text extra3" id="extra4" style="display: none;">
                                        Inside oven (extra)
                                    </p>
                                    <p class="card-text extra4" id="extra2" style="display: none;">
                                        Laundry wash & wash(extra)
                                    </p>
                                    <p class="card-text extra5" id="extra1" style="display: none;">
                                        Interior windows (extra)
                                    </p>
                                </div>
                                <div class="col">
                                    <p class="card-text text-end" id="extra31" style="display: none;">
                                        30 Min
                                    </p>
                                    <p class="card-text text-end" id="extra51" style="display: none;">
                                        30 Min
                                    </p>
                                    <p class="card-text text-end" id="extra41" style="display: none;">
                                        30 Min
                                    </p>
                                    <p class="card-text text-end" id="extra21" style="display: none;">
                                        30 Min
                                    </p>
                                    <p class="card-text text-end" id="extra11" style="display: none;">
                                        30 Min
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col">
                                    <p class="card-text total_time">
                                        Total Service Time
                                    </p>
                                </div>
                                <div class="col">
                                    <p class="card-text text-end price">
                                        <span id="total_hours">3</span>Hrs
                                    </p>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col">
                                    <p class="card-text">
                                        Per cleaning
                                    </p>
                                </div>
                                <div class="col">
                                    <p class="card-text text-end price">
                                        $<span id="total_price">75</span>
                                    </p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <p class="card-text">
                                        Discount
                                    </p>
                                </div>
                                <div class="col">
                                    <p class="card-text text-end price">
                                        -$ <span id="discount">0</span>
                                    </p>
                                </div>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col">
                                    <p class="card-text total_payment">
                                        Total Payment
                                    </p>
                                </div>
                                <div class="col">
                                    <p class="card-text text-end total_price">
                                        $ <span id="total_payment">75</span>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p class="card-text">
                                        Effective Price
                                    </p>
                                </div>
                                <div class="col">
                                    <p class="card-text text-end effective_price">
                                        $ <span id="effective_price">75</span>
                                    </p>
                                </div>
                            </div>
                            <p class="card-text saving">*You will save 20% according to §35a EStG.</p>
                        </div>
                        <div class="card-footer">
                            <img src="./Asset/image/smiley.png" alt=".."> See what is always included
                        </div>
                    </div>

                    <div class="suggestion">
                        <h3 class="text-center">
                            Questions?
                        </h3>
                        <div class="que">
                            <a class="large-content" data-bs-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <img src="./Asset/image/right-arrow.png" alt=""> Which Helperland professional will come to my place?
                            </a>
                            <div class="collapse" id="collapseExample1">
                                <div class="small-content">
                                    ans.
                                </div>
                            </div>
                        </div>
                        <div class="que">
                            <a class="large-content" data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <img src="./Asset/image/right-arrow.png" alt=""> Which Helperland professional will come to my place?
                            </a>
                            <div class="collapse" id="collapseExample2">
                                <div class="small-content">
                                    ans.
                                </div>
                            </div>
                        </div>
                        <div class="que">

                            <a class="large-content" data-bs-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <img src="./Asset/image/right-arrow.png" alt=""> Which Helperland professional will come to my place?
                            </a>
                            <div class="collapse" id="collapseExample3">
                                <div class="small-content">
                                    ans.
                                </div>
                            </div>
                        </div>
                        <div class="que">

                            <a class="large-content" data-bs-toggle="collapse" href="#collapseExample4" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <img src="./Asset/image/right-arrow.png" alt=""> Which Helperland professional will come to my place?
                            </a>
                            <div class="collapse" id="collapseExample4">
                                <div class="small-content">
                                    ans.
                                </div>
                            </div>
                        </div>
                        <div class="que">

                            <a class="large-content" data-bs-toggle="collapse" href="#collapseExample5" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <img src="./Asset/image/right-arrow.png" alt=""> Which Helperland professional will come to my place?
                            </a>
                            <div class="collapse" id="collapseExample5">
                                <div class="small-content">
                                    ans.
                                </div>
                            </div>
                        </div>
                        <div class="more">

                            <a href="#"> For more help</a>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section class="our-news-letter">
            <div class="container text-center">
                <h2>GET OUR NEWSLETTER</h2>
                <div class="form-row d-flex justify-content-center align-items-center">
                    <div class="form-group">
                        <label for="email" style="display: none;">YOUR EMAIL</label>
                        <input type="text" placeholder="YOUR EMAIL" id="email" class="form-control">
                    </div>
                    <div class="btn-wrapper">
                        <button class="submit">Submit</button>
                    </div>
                </div>
            </div>
        </section>

        <?php
        include("footer.php");
        ?>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
        <script src="./Asset/js/book_service.js?v=1"></script>

        <?php
        include("book_service_ajax.php");
        ?>
    </body>

<?php
}
?>

</html>