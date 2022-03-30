<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Home Page</title>
    <link rel="stylesheet" href="./Asset/css/home_style.css">
    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
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
    <div class="container-fluid  header-container " id="first">
        <nav class="navbar navbar-expand-lg navbar-light text-center">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="./Asset/image/logo-large.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="navbar-nav ms-auto">
                        <ul class="navbar-nav">
                            <li class="nav-item navborder">
                                <?php
                                if (isset($_SESSION['username'])) {
                                ?>
                                    <a class="nav-link  text-white" aria-current="page" href="<?= $base_url . '?controller=Helperland&function=book_service' ?>">Book a Cleaner</a>
                                <?php } ?>

                                <?php
                                if (!isset($_SESSION['username'])) {
                                ?>
                                    <a class="nav-link  text-white" aria-current="page" href="<?= $base_url . 'index.php#loginform' ?>">Book a Cleaner</a>
                                <?php } ?>

                            </li>
                            <li class="nav-item ">
                                <a class="nav-link text-white " href="<?= $base_url . '?controller=Helperland&function=prices' ?>">Prices</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link text-white " href="#">Our Guarantee</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link text-white " href="#">Blog</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link text-white " href="<?= $base_url . '?controller=Helperland&function=contact' ?>">Contact Us</a>
                            </li>
                            <li class="nav-item navborder ">
                                <a class="nav-link text-white" href="" data-bs-toggle="modal" data-bs-target="#loginform">Login</a>
                            </li>
                            <li class="nav-item navborder ">
                                <a class="nav-link text-white " href="<?= $base_url . '?controller=Helperland&function=become_a_pro' ?>">Become a Helper</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link dropdown-toggle " data-bs-toggle="dropdown " href="# "><img src="./Asset/image/ic-flag.png " alt="logo"></a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item " href="#">Australia</a></li>
                                    <li><a class="dropdown-item " href="# ">India</a></li>
                                    <li><a class="dropdown-item " href="# ">America</a></li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </nav>


        <!-- login form -->

        <div class="modal fade" id="loginform" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="loginform" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="staticBackdropLabel">
                            Login to your account
                        </h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert text-center d-none" id="loginerror" role="alert"> </div>
                        <form action="<?= $base_url . '?controller=Helperland&function=login' ?>" method="post">
                            <div class="login_input mb-3">
                                <input type="email" class="form-control shadow-none" id="loginemail" name="email" placeholder="Email" value="<?php if (isset($_COOKIE['emailcookie'])) {
                                                                                                                                                    echo $_COOKIE['emailcookie'];
                                                                                                                                                } ?>" />
                                <span><i class="login_icon fas fa-user"></i></span>
                            </div>

                            <div class="email-msg mails mb-2"> </div>
                            <div class="login_input mb-3">
                                <input type="password" class="form-control shadow-none" id="loginpassword" name="password" placeholder="Password" value="<?php if (isset($_COOKIE['passwordcookie'])) {
                                                                                                                                                                echo $_COOKIE['passwordcookie'];
                                                                                                                                                            } ?>" />
                                <span><i class="login_icon fas fa-lock-alt"></i></span>
                            </div>
                            <?php
                            if (isset($_SESSION['msg'])) {
                                echo $_SESSION['msg'];
                            } ?>

                            <div class="mb-3 form-check">
                                <?php if (isset($_COOKIE)) { ?>
                                    <input type="checkbox" class="form-check-input" id="Check1" name="remember" checked />
                                    <label class="form-check-label" for="Check1">Remember me</label>
                                <?php } ?>

                                <?php if (!isset($_COOKIE)) { ?>
                                    <input type="checkbox" class="form-check-input" id="Check1" name="remember" />
                                    <label class="form-check-label" for="Check1">Remember me</label>
                                <?php } ?>
                            </div>
                            <div class="text-center mb-4">
                                <button type="submit" class="btn btn_login">Login</button>
                            </div>
                            <div class="text-center">
                                <a href="" data-bs-toggle="modal" data-bs-target="#forgotform">Forgot Password?</a>
                                <p class="form-text">Don't have an account?</p>
                                <a href="<?= $base_url . '?controller=Helperland&function=customer_registration' ?>">Creat an account</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- forgot form -->

        <div class="modal fade" id="forgotform" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="forgotform" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="BackdropLabel">Forgot Password</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= $base_url . '?controller=registration&function=forgot' ?>" method="post">
                            <div class="mb-3">
                                <input type="email" class="form-control" name="email" placeholder="Email" />
                            </div>
                            <div class="text-center mb-4">
                                <button type="submit" class="btn btn_login">Send</button>
                            </div>
                            <div class="text-center">
                                <a href="" data-bs-toggle="modal" data-bs-target="#loginform">Login now</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>





        <section class="intro">
            <div>
                <div class="row lorem-text ">
                    <div class="col-4 align-self-start ">
                        <div>
                            <p class="text-header ">

                                DO not feel like housework?
                            </p>
                        </div>

                        <div class="text ">
                            <p>Great book now for Helperland and enjoy the benefits</p>
                            <p> <img src="./Asset/image/ic-check.png " alt=". "> Certified & insured helper</p>
                            <p> <img src="./Asset/image/ic-check.png " alt=". "> easy booking procedure</p>
                            <p> <img src="./Asset/image/ic-check.png " alt=". "> friendly customer service</p>
                            <p> <img src="./Asset/image/ic-check.png " alt=". "> secure online payment method</p>
                        </div>
                    </div>
                </div>
            </div>


            <div class=" text-center ">
                <a class="button-for-booking " href="<?= $base_url . 'index.php#loginform' ?>">Book a helper!</a>
            </div>


            <div class="row process text-center">

                <div class="col-md-6 col-lg-2">

                    <img src="./Asset/image/step-1.png " class="img-fluid " alt="... ">
                    <br>
                    <p class="process-text ">Enter your postcode</p>

                </div>

                <div class="col-md  col-lg-1 d-none d-lg-block ">

                    <img src="./Asset/image/step-arrow-1.png " class="img-fluid " alt="... ">
                    <br>


                </div>

                <div class="col-md-6 col-lg-2">

                    <img src="./Asset/image/step-2.png " class="img-fluid " alt="... ">
                    <br>
                    <p class="process-text ">Select your plan</p>

                </div>

                <div class="col-md col-lg-1 d-none d-lg-block ">

                    <img src="./Asset/image/step-arrow-1-copy.png " class="img-fluid " alt="... ">
                    <br>


                </div>

                <div class="col-md-6 col-lg-2">

                    <img src="./Asset/image/step-3.png " class="img-fluid " alt="... ">
                    <br>
                    <p class="process-text ">Pay securely online</p>

                </div>

                <div class="col-md col-lg-1 d-none d-lg-block ">

                    <img src="./Asset/image/step-arrow-1.png " class="img-fluid " alt="... ">
                    <br>


                </div>

                <div class="col-md-6 col-lg-2">

                    <img src="./Asset/image/step-4.png " class="img-fluid " alt="... ">
                    <br>
                    <p class="process-text ">Enjoy amazing service</p>

                </div>

            </div>
            <div class="text-center ">

                <img src="./Asset/image/group-18_5.png " class="img-fluid down-arrow " alt="... ">

            </div>
        </section>

    </div>

    <div class="container-fluid ">

        <div class="why-title text-center">
            <h2>Why Helperland</h2>
        </div>

        <div class="row why-row d-flex flex-row text-center">

            <div class="col-lg-4 col-sm-12  why-col ">
                <img src="./Asset/image/helper-img-1.png " class="img-fluid why-image ">
                <h3 class="why-text-title ">
                    Experience & Vetted Professionals
                </h3>
                <p class="why-text ">
                    dominate the industry in scale and scope with an adaptable, extensive network that consistently delivers exceptional results.

                </p>

            </div>

            <div class="col-lg-4 col-sm-12 why-col ">
                <img src="./Asset/image/group-23.png " class="img-fluid why-image ">
                <h3 class="why-text-title ">
                    Secure Online Payment
                </h3>
                <p class="why-text ">
                    Payment is processed securely online. Customers pay safely online and manage the booking.
                </p>

            </div>

            <div class="col-lg-4 col-sm-12 why-col ">
                <img src="./Asset/image/group-24.png " class="img-fluid why-image ">
                <h3 class="why-text-title ">
                    Dedicated Customer Service
                </h3>
                <p class="why-text ">
                    to our customers and are guided in all we do by their needs. The team is always happy to support you and offer all the information.

                </p>

            </div>

        </div>
    </div>


    <section class="bloginfo">
        <div class="container-fluid ">

            <div class="row info ">
                <div class="col-sm-12 col-lg-7">
                    <h3 class="info-title ">Lorem ipsum dolor sit amet, consectetur</h3>
                    <div class="info-info ">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nisi sapien, suscipit ut accumsan vitae, pulvinar ac libero.
                        </p>
                        <br>
                        <p>Aliquarm erat volutpat. nullam quis ex odio. Nam bibendum cursus purus, vel efficitur urna finibus vitae. Nullam finibus aliquet phaetra. morbi in sem dolor. Integer pretium hendrerit ante quis vehicula.
                        </p><br>
                        <p>Marius consequat ornare enim, sed lobortis quam ultrices sed. </p>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-5">
                    <img src="./Asset/image/group-36.png " class="img-fluid imgmix" alt=".. ">
                </div>
            </div>
        </div>

        <h3 class="info-title-blog text-center">
            Our Blog
        </h3>

        <div class="row row-cols-1 row-cols-md-3 g-4 card-container ">
            <div class="col ">
                <div class="card h-100 ">
                    <img class="card-img-top " src="./Asset/image/group-28.png " alt="Card image ">
                    <div class="card-body ">
                        <p class="card-title ">Lorem ipsum dolor sit amet</p>
                        <p class="card-date ">January 28, 2019</p>
                        <p class="card-text ">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed fermentum metus pulvinar aliquet.</p>
                        <p class="card-more ">Read the Post</p><img src="./Asset/image/shape-2.png " class="img-fluid " alt=".. ">
                    </div>

                </div>
            </div>
            <div class="col ">
                <div class="card h-100 ">
                    <img class="card-img-top " src="./Asset/image/group-29.png " alt="Card image ">
                    <div class="card-body ">
                        <p class="card-title ">Lorem ipsum dolor sit amet</p>
                        <p class="card-date ">January 28, 2019</p>
                        <p class="card-text ">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed fermentum metus pulvinar aliquet.</p>
                        <p class="card-more ">Read the Post</p><img src="./Asset/image/shape-2.png " class="img-fluid " alt=".. ">
                    </div>
                </div>
            </div>
            <div class="col ">
                <div class="card h-100 ">
                    <img class="card-img-top " src="./Asset/image/group-30.png " alt="Card image ">
                    <div class="card-body ">
                        <p class="card-title ">Lorem ipsum dolor sit amet</p>
                        <p class="card-date ">January 28, 2019</p>
                        <p class="card-text ">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed fermentum metus pulvinar aliquet.</p>
                        <p class="card-more ">Read the Post</p><img src="./Asset/image/shape-2.png " class="img-fluid " alt=".. ">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="customer-container ">
        <div>
            <h4 class="customer-title text-center"> What our Customers Say </h4>
        </div>

        <div class="mx-auto d-flex flex-wrap justify-content-center customer ">

            <div class="col-lg-3 mx-3 my-3 position-relative ">
                <div class="position-absolute " style="top:1rem; right: 1rem; z-index: 10; "><img src="./Asset/image/message.png " alt=" "></div>
                <div class="card d-flex flex-column p-3 " style="border-left: 3px solid #1d7a8c; ">

                    <div class="d-flex flex-row profile pt-4 mt-auto mb-2 ">
                        <img src="./Asset/image/group-31.png " alt=" " class="rounded-circle customer-image ">
                        <div class="d-flex flex-column ps-2 ">
                            <div class="customer-name ">
                                <h5>Lary Watson</h5>
                            </div>
                            <p class="text-muted customer-city ">Manchester</p>
                        </div>
                    </div>
                    <div class="customer-info ">
                        <p> Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magni dolores molestias veniam inventore itaque eius iure omnis. </p>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eveniet.</p>
                    </div>
                    <div><a href="# " class="customer-more ">Read the Post <img src="./Asset/image/shape-2.png " alt=" "></a></div>
                </div>
            </div>

            <div class="col-lg-3 mx-3 my-3 position-relative ">
                <div class="position-absolute " style="top:1rem; right: 1rem; z-index: 10; "><img src="./Asset/image/message.png " alt=" "></div>
                <div class="card d-flex flex-column p-3 " style="border-left: 3px solid #1d7a8c; ">

                    <div class="d-flex flex-row profile pt-4 mt-auto mb-2 ">
                        <img src="./Asset/image/group-32.png " alt=" " class="rounded-circle customer-image ">
                        <div class="d-flex flex-column ps-2 ">
                            <div class="customer-name ">
                                <h5>John Smith</h5>
                            </div>
                            <p class="text-muted customer-city ">Manchester</p>
                        </div>
                    </div>
                    <div class="customer-info ">
                        <p> Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magni dolores molestias veniam inventore itaque eius iure omnis. </p>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eveniet.</p>
                    </div>
                    <div><a href="# " class="customer-more ">Read the Post <img src="./Asset/image/shape-2.png " alt=" "></a></div>
                </div>
            </div>

            <div class="col-lg-3 mx-3 my-3 position-relative ">
                <div class="position-absolute " style="top:1rem; right: 1rem; z-index: 10; "><img src="./Asset/image/message.png " alt=" "></div>
                <div class="card d-flex flex-column p-3 " style="border-left: 3px solid #1d7a8c; ">

                    <div class="d-flex flex-row profile pt-4 mt-auto mb-2 ">
                        <img src="./Asset/image/group-33.png " alt=" " class="rounded-circle customer-image ">
                        <div class="d-flex flex-column ">
                            <div class="customer-name ">
                                <h5>Lars Johnson</h5>
                            </div>
                            <p class="text-muted customer-city ">Manchester</p>
                        </div>
                    </div>
                    <div class="customer-info ">
                        <p> Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magni dolores molestias veniam inventore itaque eius iure omnis. </p>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eveniet.</p>
                    </div>
                    <div><a href="# " class="customer-more ">Read the Post <img src="./Asset/image/shape-2.png " alt=" "></a></div>
                </div>
            </div>

        </div>
        <section class="our-news-letter">
            <div class="container text-center">
                <a href="#first" class="scroll-top"><img src="./Asset/image/forma-1.png" alt="up-arrow"></a>
                <a href="#first" class="message-boat"><img src="./Asset/image/layer-598.png" alt="message-boat"></a>
                <h5>GET OUR NEWSLETTER</h5>
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

    </section>

    <section>
        <div class="footer">
            <div class="container">
                <div class="row justify-content-center d-flex align-content-center">
                    <div class="col-lg-2 text-center">
                        <img src="./Asset/image/footer-logo.png" alt="">
                    </div>
                    <div class="col-lg-8">
                        <div class="footer-navbar text-center p-4">
                            <a class="footer-menu" href="<?= $base_url . '?controller=Helperland&function=Homepage' ?>">HOME</a>
                            <a class="footer-menu" href="<?= $base_url . '?controller=Helperland&function=about' ?>">ABOUT</a>
                            <a class="footer-menu" href="#">TESTIMONIALS</a>
                            <a class="footer-menu" href="<?= $base_url . '?controller=Helperland&function=faq' ?>">FAQS</a>
                            <a class="footer-menu" href="#">INSURANCE</a>
                            <a class="footer-menu" href="#">POLICY</a>
                            <a class="footer-menu" href="#">IMPRESSUM</a>
                        </div>
                    </div>
                    <div class="col-lg-2 text-center">
                        <a href="#"><img src="./Asset/image/ic-facebook.png" alt="fb" class="fb"></a>
                        <a href="#"><img src="./Asset/image/ic-instagram.png" alt="insta" class="insta"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-policy container-fluid text-center">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut feugiat nunc libero, ac malesuada ligula aliquam ac. <a href="# ">Privacy Policy</a><button class="btn btn-ok" id="button">ok!</button>
        </div>


    </section>

    <?php

    if (isset($_SESSION['message'])) { ?>
        <script>
            alert("email not exist");
        </script>
    <?php
    }
    ?>

    <?php

    if (isset($_SESSION['loginerror'])) {  ?>
        <script>
            errortype = <?php
                        echo  $_SESSION['loginerror']; ?>;
            if (errortype == 1) {
                $("#loginerror").removeClass("alert-success d-none").addClass("alert-danger").text("Your Account Is Not Activated. Please Try Again After Some Time");
            } else if (errortype == 2) {
                $("#loginerror").removeClass("alert-success d-none").addClass("alert-danger").text("Your Account Is Not Active.");
            }
        </script>
    <?php
    }
    ?>

    <?php
    if (isset($_SESSION['logout'])) {  ?>
        <script>
            logout = <?php
                        echo  $_SESSION['logout']; ?>;
            $(document).ready(function() {
                if (logout == 1) {
                    Swal.fire({
                        title: 'logout Successfully.',
                        text: '',
                        icon: 'success',
                        confirmButtonText: 'Done'
                    });
                }
            });
        </script>
    <?php
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.10/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js " integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB " crossorigin="anonymous "></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js " integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13 " crossorigin="anonymous "></script>
    <script src="./Asset/js/home_page.js"></script>
</body>

<?php
unset($_SESSION['msg']);
unset($_SESSION['message']);
unset($_SESSION['loginerror']);
unset($_SESSION['logout']);
?>

</html>