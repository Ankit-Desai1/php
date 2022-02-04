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
    <title>Become a pro</title>
    <link rel="stylesheet" href="./Asset/css/Become-a-pro_style.css">
    <?php $base_url='http://localhost/php/helperland/'; ?>
    <script>
  var config = {
        routes: {
            zone: "<?= $base_url ?>"
        }
    };
  </script>
</head>

<body>

    <section class="container-fluid  header-container">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light text-center">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#"><img src="./Asset/image/logo-large.png" class="header-img" alt="" ;></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <div class="navbar-nav ms-auto">
                        <ul class="navbar-nav">
                            <li class="nav-item navborder">
                                <?php
                                if(isset($_SESSION['username'])){
                                ?>
                                <a class="nav-link  text-white" aria-current="page" href="<?= $base_url.'?controller=Helperland&function=book_service'?>">Book a Cleaner</a>
                                <?php } ?>

                                <?php
                                if(!isset($_SESSION['username'])){
                                ?>
                                <a class="nav-link  text-white" aria-current="page" href="<?= $base_url.'index.php#loginform'?>">Book a Cleaner</a>
                                <?php } ?>
                            
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link text-white " href="<?= $base_url.'?controller=Helperland&function=prices'?>">Prices</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link text-white " href="#">Our Guarantee</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link text-white " href="#">Blog</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link text-white " href="<?= $base_url.'?controller=Helperland&function=contact'?>">Contact Us</a>
                            </li>
                            <li class="nav-item navborder ">
                                <a class="nav-link text-white" href="<?= $base_url.'index.php#loginform'?>">Login</a>
                            </li>
                            <li class="nav-item navborder ">
                                <a class="nav-link text-white " href="<?=$base_url.'?controller=Helperland&function=become_a_pro'?>">Become a Helper</a>
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
        </div>
        

        <form class="Register-form container-fluid" id="signup" action="<?=$base_url.'?controller=registration&function=register'?>" method="post">
            <h1>Register Now!</h1>
            <div class=" mb-3">
                <input type="text" class="form-control" id="firstname" placeholder="First name" name="firstname" required>
                <div class="first-name-msg"></div>
            </div>
            <div class=" mb-3">
                <input type="text" class="form-control" id="lastname" placeholder="Last name" name="lastname" required>
                <div class="last-name-msg"></div>
            </div>
            <div class=" mb-3">
                <input type="email" class="form-control" id="email" placeholder="Email Address" name="email" required>
                <div class="email-msg"></div>
                <?php
                    if(isset($_GET['status']) && $_GET['status']=='alert'){
                    echo $_SESSION['message'];
                     }
                ?>
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <div class="input-group-text">+49</div>
                    <input type="text" class="form-control" id="phonenumber" placeholder="Mobile number" name="phonenumber" required>
                </div>
                <div class="mobile-msg"></div>
            </div>
            <div class=" mb-3">
                <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                <div class="password-msg"></div>
            </div>
            <div class=" mb-3">
                <input type="password" class="form-control" id="confirmpassword" placeholder="Confirm Password" name="confirmpassword" required>
                <div class="confirmpassword-msg"></div>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Send me newsletters from Helperland
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" >
                <label class="form-check-label" for="flexCheckChecked">
                    I accept <a href="#"> terms and conditions</a> & <a href="#">privacy policy</a> 
                </label>
            </div>
            <div class="text-center">

                <button type="submit" id="btn_register" class="btn border-btn">Get Started <img src="./Asset/image/arrow-white.png" alt=".."></button>
            </div>
        </form>
        <div class=" text-center">
            <a href="#"><img src="./Asset/image/group-18_5.png" class="img-fluid down-arrow" alt="..."></a>
        </div>
    </section>

    <section class=" container-fluid how-it-works">
        <h2>How it works</h2>
        <div class="row mb-3">
            <div class="col-sm-12 col-lg-7">
                <h3>Register yourself</h3>
                <p> Provide your basic information to register yourself as a service provider.</p>
                <a href="#">Read more <img src="./Asset/image/shape-2.png" alt=""></a>
            </div>
            <div class="col-sm-12 col-lg-5">
                <img src="./Asset/image/group-18-1.png" class="img-fluid" alt="..">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-12 col-lg-5">
                <img src="./Asset/image/group-18-2.png" class="img-fluid" alt="">
            </div>
            <div class="col-sm-12 col-lg-7 ">
                <h3>Get service request</h3>
                <p>You will get service request from customers depend on service area and profile.</p>
                <a href="#">Read more <img src="./Asset/image/shape-2.png" alt=""></a>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-12 col-lg-7">
                <h3>Complete service</h3>
                <p>Accept service request from your customers and complete your work.</p>
                <a href="#">Read more <img src="./Asset/image/shape-2.png" alt=""></a>
            </div>
            <div class="col-sm-12 col-lg-5">
                <img src="./Asset/image/group-18-3.png" class="img-fluid" alt="...">
            </div>
        </div>

        <section class="our-news-letter">
            <div class="container text-center">
                <h2>GET OUR NEWSLETTER</h2>
                <div class="form-row d-flex justify-content-center align-items-center">
                    <div class="form-group">
                        <label for="email" style="display: none;">YOUR EMAIL</label>
                        <input type="text" placeholder="YOUR EMAIL" id="emailid" class="form-control">
                    </div>
                    <div class="btn-wrapper">
                        <button class="submit">Submit</button>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <?php 
include("footer.php");
?>
        <?php
            if(isset($_GET['status']) && $_GET['status']=='success'){?>
                <script>alert("you successfully register. Wait untill your request approved." );</script>
        <?php 
        }    
        ?> 

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="./Asset/js/register_validation.js"></script>
    
    <?php
unset($_SESSION['msg']);
unset($_SESSION['message']);
?>
</body>

</html>