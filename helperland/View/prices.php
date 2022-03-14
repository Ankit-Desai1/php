<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Price</title>
    <link rel="stylesheet" href="./Asset/css/prices_style.css">
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
    <?php
    include("navbar.php");
    ?>
    <div>
        <img src="./Asset/image/group-18.png" class="img-fluid" alt="...">
    </div>

    <section class="prices-services">
        <div>
            <h1 class="title-price text-center">Prices</h1>

        </div>

        <div class="text-center">
            <img src="./Asset/image/faq-seprator.png" class="img-fluid image-seprator" alt="...">
        </div>

        <div class="card card-price">
            <div class="card-header">
                One Time
            </div>
            <div class="card-body">
                <span class="price">€20</span><span class="price-hour">/hr</span>
                <div class="card-info">
                    <p><img src="./Asset/image/forma-1_5.png" alt="...">Lower prices</p>
                    <p><img src="./Asset/image/forma-1_5.png" alt="...">Easy online & secure payment</p>
                    <p><img src="./Asset/image/forma-1_5.png" alt="...">Easy amendment</p>
                </div>

            </div>
        </div>


        <hr class="container">

        <div>
            <h2 class="title-price text-center">Extra Services</h2>

        </div>

        <div class="text-center">
            <img src="./Asset/image/faq-seprator.png" class="img-fluid image-seprator" alt="...">
        </div>

        <div class="container">
            <div class="row text-center">
                <div class="col-sm">
                    <a href="#" class="btn"><img src="./Asset/image/3.png" alt="..."></a>
                    <p class="service">Inside cabinets</p>
                    <p class="service-time">30 minutes</p>
                </div>
                <div class="col-sm">
                    <a href="#" class="btn"><img src="./Asset/image/5.png" alt="..."></a>
                    <p class="service">Inside fridge</p>
                    <p class="service-time">30 minutes</p>
                </div>
                <div class="col-sm">

                    <a href="#" class="btn"><img src="./Asset/image/4.png" alt="..."></a>
                    <p class="service">Inside oven</p>
                    <p class="service-time">30 minutes</p>
                </div>
                <div class="col-sm">
                    <a href="#" class="btn"><img src="./Asset/image/2.png" alt="..."></a>
                    <p class="service">Laundry wash & dry</p>
                    <p class="service-time">30 minutes</p>
                </div>
                <div class="col-sm">

                    <a href="#" class="btn"><img src="./Asset/image/1.png" alt="..."></a>
                    <p class="service">Interior windows</p>
                    <p class="service-time">30 minutes</p>
                </div>
            </div>
        </div>

    </section>

    <section class="what-imcluded">

        <div class="container-fluid service-include">
            <div>
                <p class="title-include">What we include in cleaning</p>

            </div>

            <div class="text-center">
                <img src="./Asset/image/faq-seprator.png" class="img-fluid image-seprator" alt="...">
            </div>

            <div class="container">
                <div class="row g-3 card-service">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card">
                            <img src="./Asset/image/group-18_3.png" alt="...">
                            <div class="card-body">
                                <p class="card-title">Bedroom and Living Room</p>
                                <p class="card-text"><img src="./Asset/image/right-arrow.png" alt="">Dust all accessible surfaces</p>
                                <p class="card-text"><img src="./Asset/image/right-arrow.png" alt="">Wipe down all mirrors and glass fixtures</p>
                                <p class="card-text"><img src="./Asset/image/right-arrow.png" alt="">Clean all floor surfaces</p>
                                <p class="card-text"><img src="./Asset/image/right-arrow.png" alt="">Take out garbage and recycling</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card">
                            <img src="./Asset/image/group-18_4.png" alt="...">
                            <div class="card-body">
                                <p class="card-title">Bathrooms</p>
                                <p class="card-text"><img src="./Asset/image/right-arrow.png" alt="">Wash and sanitize the toilet, shower, tub, sink</p>
                                <p class="card-text"><img src="./Asset/image/right-arrow.png" alt="">Dust all accessible surfaces</p>
                                <p class="card-text"><img src="./Asset/image/right-arrow.png" alt="">Wipe down all mirrors and glass fixtures</p>
                                <p class="card-text"><img src="./Asset/image/right-arrow.png" alt="">Clean all floor surfaces</p>
                                <p class="card-text"><img src="./Asset/image/right-arrow.png" alt="">Take out garbage and recycling</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card">
                            <img src="./Asset/image/group-18_2.png" alt="...">
                            <div class="card-body">
                                <p class="card-title">Kitchen</p>
                                <p class="card-text"><img src="./Asset/image/right-arrow.png" alt="">Dust all accessible surfaces</p>
                                <p class="card-text"><img src="./Asset/image/right-arrow.png" alt="">Empty sink and load up dishwasher</p>
                                <p class="card-text"><img src="./Asset/image/right-arrow.png" alt="">Wipe down exterior of stove, oven and fridge</p>
                                <p class="card-text"><img src="./Asset/image/right-arrow.png" alt="">Clean all floor surfaces</p>
                                <p class="card-text"><img src="./Asset/image/right-arrow.png" alt="">Take out garbage and recycling</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="why-helperland">
        <div>
            <h3 class="title-include">Why Helperland</h3>

        </div>

        <div class="text-center">
            <img src="./Asset/image/faq-seprator.png" class="img-fluid image-seprator" alt="...">
        </div>

        <div class="container">
            <div class="row g-3 card-service">
                <div class="col-12 col-md-6 col-lg-4 col-left">
                    <p class="why-title">Experienced and vetted professionals</p>
                    <p class="why-text">dominate the industry in scale and scope with <br> an adaptable, extensive network that <br> consistently delivers exceptional results.</p>

                    <p class="why-title">Dedicated customer service</p>
                    <p class="why-text">to our customers and are guided in all we do <br> by their needs. The team is always happy to <br> support you and offer all the information. <br> you need.</p>
                </div>

                <div class="col-12 col-md-6 col-lg-4 text-center">
                    <img src="./Asset/image/the-best-img-1.png" alt="...">
                </div>

                <div class="col-12 col-md-6 col-lg-4 col-right">
                    <p class="why-title">Every cleaning is insured</p>
                    <p class="why-text">and seek to provide exceptional service and <br> engage in proactive behavior. We‘d be happy <br> to clean your homes.</p>

                    <p class="why-title">Secure online payment</p>
                    <p class="why-text">Payment is processed securely online. <br> Customers pay safely online and manage <br> the booking.</p>
                </div>
            </div>

            <section class="our-news-letter">
                <div class="container text-center">
                    <a href="#first" class="top"><img src="./Asset/image/forma-1.png" alt="up-arrow"></a>
                    <a href="#first" class="message"><img src="./Asset/image/layer-598.png" alt="message"></a>
                    <h3>GET OUR NEWSLETTER</h3>
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
        </div>
    </section>


    <?php
    include("footer.php");
    ?>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>

</html>