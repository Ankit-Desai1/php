
    <section class="header" id="first">
        <div class="container-fluid" style="background-color: #A3A3A3;">
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
                                <li class="nav-item navonlyborder">
                                    <a class="nav-link text-white" href="<?= $base_url.'?controller=Helperland&function=prices'?>">Prices & Services</a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link text-white " href="#">Warrenty</a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link text-white " href="#">Blog</a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link text-white " href="<?= $base_url.'?controller=Helperland&function=contact'?>">Contact</a>
                                </li>
                                <li class="nav-item navborder">
                                    <a class="nav-link text-white " href="<?= $base_url.'index.php#loginform'?>">Login</a>
                                </li>
                                <li class="nav-item navborder">
                                    <a class="nav-link text-white " href="<?=$base_url.'?controller=Helperland&function=become_a_pro'?>">Become a Helper</a>
                                </li>

                            </ul>

                        </div>
                    </div>
                </div>
            </nav>
        </div>

    </section>
