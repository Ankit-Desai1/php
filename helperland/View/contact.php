
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>contact</title>
    <link rel="stylesheet" href="./Asset/css/contact_style.css">
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
include("navbar.php");
?>

    <div>
        <img src="./Asset/image/group-16_2.png" class="img-fluid" alt="...">
    </div>

    <section class="contact-us text-center">
        <h1 class="title">Contact us</h1>
        <img src="./Asset/image/faq-seprator.png" class="img-fluid image-seprator" alt="...">
        <div class="container contact">
            <div class="row g-3">
                <div class="col-12 col-md-6 col-lg-4">
                    <img src="./Asset/image/forma-1_2.png" alt="...">
                    <p class="contact-info">1111 Lorem ipsum text 100, <br> Lorem ipsum AB</p>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <img src="./Asset/image/phone-call.png" alt="...">
                    <p class="contact-info">+49 (40) 123 56 7890 <br> +49 (40) 987 56 0000</p>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <img src="./Asset/image/vector-smart-object.png" alt="...">
                    <p class="contact-info">info@helperland.com</p>
                </div>
            </div>
            <hr>
        </div>
    </section>



    <div>
        <p class="title-form">Get in touch with us</p>

    </div>

    <section class="container">
        <form class="contact-form text-center " action= "<?= $base_url.'?controller=Helperland&function=contact_us'?>" method="post">
            <div class="row mb-3 ">
                <div class="col-lg-6 col-sm-12 mb-3">
                    <input type="text" class="form-control" placeholder="First name" name="firstname">
                </div>
                <div class="col-lg-6 col-sm-12">
                    <input type="text" class="form-control" placeholder="Last name" name="lastname">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-6 col-sm-12 mb-3">
                    <label class="visually-hidden" for="mobile-number"></label>
                    <div class="input-group">
                        <div class="input-group-text">+49</div>
                        <input type="text" class="form-control" id="mobile-number" placeholder="Mobile number" name="phonenumber">
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <input type="text" class="form-control" placeholder="Email address" name="email">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <select id="subject" class="form-select" name="subject">
                  <option selected value="subject">Subject</option>
                  <option value="subject2">subject2</option>
                </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <textarea class="form-control" placeholder="Write something.." name="message"></textarea>
                </div>
            </div>
            <button type="submit" class="btn border-btn">Submit</button>
        </form>
    </section>

    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3671.6980502384104!2d72.49824711491954!3d23.034856384946814!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e8352e403437b%3A0xdc9d4dae36889fb9!2z4Kqk4Kqk4KuN4Kq14Kq44KuL4Kqr4KuN4Kqf!5e0!3m2!1sgu!2sin!4v1639995853344!5m2!1sgu!2sin"
        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>


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

</body>

</html>
