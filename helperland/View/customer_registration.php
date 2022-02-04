<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <title>contact</title>
    <link rel="stylesheet" href="./Asset/css/customer_registration_style.css" />
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
<?php 
include("header.php");
?>

    <section class="text-center">
        <h1 class="title">Creat an account</h1>
        <img src="./Asset/image/faq-seprator.png" class="img-fluid image-seprator" alt="..." />
    </section>

    <section class="registration_form container">
        <form action="<?=$base_url.'?controller=registration&function=customer'?>" method="post" id="signup">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" />
                    <div class="first-name-msg"></div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" />
                    <div class="last-name-msg"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail Address" />
                    <div class="email-msg"></div>
                    <?php
                    if(isset($_GET['status']) && $_GET['status']=='alert'){
                    echo $_SESSION['message'];
                     }
                ?>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="input-group">
                        <div class="input-group-text">+49</div>
                        <input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="Mobile Number" />
                    </div>
                    <div class="mobile-msg"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
                    <div class="password-msg"></div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" />
                    <div class="confirmpassword-msg"></div>
                </div>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="check1" name="checkbox" required />
                <label class="form-check-label">I have read the <a href="">privacy policy</a>
          </label>
            </div>
            <div class="text-center">
                <button type="submit" id="register_btn" class="btn register_btn">Register</button>
            </div>
            <div class="text-center mb-5">
                <p class="form-text">Already registered?<a href="index.php#loginform">Log in now</a></p>
            </div>
        </form>
    </section>

    <?php
        include("footer.php");
    ?>
        <?php
            if(isset($_GET['status']) && $_GET['status'] !=='alert'){?>
                <script>alert("Successfully register");</script>
        <?php 
        }    
        ?> 

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="./Asset/js/register_validation.js"></script>
    <?php
unset($_SESSION['message']);
?>
</body>

</html>

