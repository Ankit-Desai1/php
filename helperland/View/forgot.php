<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <title>forgot</title>
    <link rel="stylesheet" href="./Asset/css/forgot_style.css" />
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


    <section class="text-center">
        <h1 class="title">Forgot password</h1>
        <img src="../image/faq-seprator.png" class="img-fluid image-seprator" alt="..." />
    </section>

    <section class="forgot_form container">
        <form action="<?= $base_url . '?controller=registration&function=resetpassword&parameter=' . $id ?>" method="post">
            <div class="mb-3 mt-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password" name="password" />
                <div class="password-msg"></div>
            </div>
            <div class="mb-3">
                <label for="confirmpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmpassword" placeholder="Confirm Password" name="confirmpassword" />
                <div class="confirmpassword-msg"></div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn register_btn">Save</button>
            </div>
        </form>
    </section>

    <?php
    include("footer.php");
    ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="./Asset/js/register_validation.js"></script>
</body>

</html>