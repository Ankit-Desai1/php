<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Book service</title>
    <link rel="stylesheet" href="./Asset/css/Book_service.css">
    <?php $base_url='http://localhost/php/helperland/'; ?>
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
if(isset($_SESSION['username'])){
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
                    <button class="tablinks" onclick="set_service(event, 'setup_service')"><img src="./Asset/image/setup-service.png" alt=".."> Setup service</button>
                    <button class="tablinks" onclick="set_service(event, 'schedule')" id="defaultOpen"><img src="./Asset/image/schedule.png" alt=".."> Schedule & Plan</button>
                    <button class="tablinks" onclick="set_service(event, 'your_details')"><img src="./Asset/image/details.png" alt=".."> Your Details</button>
                    <button class="tablinks" onclick="set_service(event, 'make_payment')"><img src="./Asset/image/payment.png" alt=".."> Make Payment</button>
                </div>
                <div id="setup_service" class="tabcontent">
                    <h2>Setup_Service</h2>
                </div>

                <div id="schedule" class="tabcontent schedule">
                    <h2>Select number of rooms and bath</h2>
                    <div class="row">
                        <div class="col-2">
                            <select class="form-select" aria-label="Default select example">
                        <option selected>1 bed</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                      </select>
                        </div>
                        <div class="col-2">
                            <select class="form-select" aria-label="Default select example">
                        <option selected>1 bath</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                      </select>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-6">
                            <h2>when do you need cleaner?</h2>
                            <div class="row">
                                <div class="col-4">
                                    <input type="date" class="form-control " placeholder="canlender">
                                </div>
                                <div class="col-4">
                                    <select class="form-select" aria-label="Default select example">
                                    <option selected>2:00 PM</option>
                                    <option value="1">2:00 PM</option>
                                    <option value="2">3:00 PM</option>
                                    <option value="3">4:00 PM</option>
                                  </select>
                                </div>
                            </div>

                        </div>
                        <div class="col-6">
                            <h2>how longer do you need your cleaner to stay? </h2>
                            <div class="col-4">
                                <select class="form-select" aria-label="Default select example">
                                <option selected>3.0 hrs</option>
                                <option value="3">3.0 hrs</option>
                                <option value="2">2.0 hrs</option>
                                <option value="1">1.0 hrs</option>
                              </select>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h2>Extra services</h2>
                    <div class="container extra_services">
                        <div class="row text-center">
                            <div class="col-sm">
                                <a href="#" class="btn"><img src="./Asset/image/3-green.png" alt="..."></a>
                                <p class="service">Inside cabinets</p>

                            </div>
                            <div class="col-sm">
                                <a href="#" class="btn"><img src="./Asset/image/5-green.png" alt="..."></a>
                                <p class="service">Inside fridge</p>

                            </div>
                            <div class="col-sm">

                                <a href="#" class="btn"><img src="./Asset/image/4-green.png" alt="..."></a>
                                <p class="service">Inside oven</p>

                            </div>
                            <div class="col-sm">
                                <a href="#" class="btn"><img src="./Asset/image/2-green.png" alt="..."></a>
                                <p class="service">Laundry wash & dry</p>

                            </div>
                            <div class="col-sm">

                                <a href="#" class="btn"><img src="./Asset/image/1-green.png" alt="..."></a>
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
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                      I have pets at home
                    </label>
                    </div>
                    <hr>
                    <button class="continue" type="submit">
                    Continue
                    </button>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">

                <div class="card">
                    <div class="card-header">
                        Payment Summary
                    </div>
                    <div class="card-body">
                        <p class="card-text">01/01/2018 @ 4:00 pm <br> 1 bed, 1 bath.</p>

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
                                    3 Hrs
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="card-text">
                                    Inside cabinets (extra)
                                </p>
                            </div>
                            <div class="col">
                                <p class="card-text text-end">
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
                                    3.5Hrs
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
                                    $87
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
                                    -$27
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
                                    $63
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
                                    $50.4
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
    <script src="./Asset/js/book_service.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>

<?php
}
?>

</html>