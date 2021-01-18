<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <!-- <?= time();  ?> -->
    <link rel="stylesheet" href="styles/main.css?v=<?= time();  ?>">
    <title>Fin's Cuisine</title>
    <link rel="shortcut icon" href="admin/images/cutlery.png" />
</head>
<body style="background-color: #e6e6e6;">
    
    <div class="container">

        <!-- Navbar -->
        <nav class="row navbar navbar-expand-lg navbar-light bg-white rounded-bottom">
            <a href="index.php" class="navbar-brand ml-2 resto-tittle">
                <h2><b>Fin's Cuisine</b></h2>
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto mr-3">
                    <li class="nav-item mx-md-2">
                        <a href="index.php" class="nav-link active"><h5><b>Home</b></h5></a>
                    </li>
                    <li class="nav-item mx-md-2">
                        <a href="booking.php" class="nav-link"><h5>Reservation</h5></a>
                    </li>
                    <li class="nav-item mx-md-2">
                        <a href="contact.php" class="nav-link"><h5>Contact Us</h5></a>
                    </li>
                </ul>
            </div>
        </nav>    
    </div>

    <!-- Header -->
    <header class="text-center">
            <h1 class="text-white font-weight-bold">Enjoy your Dine <br>While we deserve The Fine </h1>
            <p class="text-white">Just click the button below <br> to start your journey</p>
            <div class="btn btn-getstarted"><a href="#bookingContent">Get Started</a></div>
    </header>

    <main>
        <div class="container">
            <section class="section-stats row justify-content-center" id="stats">
                <div class="col-4 col-md-2 stats-detail">
                    <h2>120</h2>
                    <p>Seats</p>
                </div>
                <div class="col-4 col-md-2 stats-detail">
                    <h2>5</h2>
                    <p>Ballrooms</p>
                </div>
                <div class="col-4 col-md-2 stats-detail">
                    <h2>500+</h2>
                    <p>Testimonial</p>
                </div>
            </section>
        </div>

        <section class="section-popular-food" id="food">
            <div class="container">
                <div class="row">
                    <div class="col text-center section-popular-food-heading">
                        <h1>Makanan Favorit</h1>
                        <p>Beberapa makanan favorit <br>
                            pilihan pelanggan setia kami.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-popular-content" id="foodContent">
            <div class="container">
                <div class="section-popular-image row justify-content-center">
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card-food text-center d-flex flex-column" style="background-image:url('img/soto.png');">
                            <div class="food-name">
                                Soto Ayam
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card-food text-center d-flex flex-column" style="background-image: url('img/nasi_goreng.jpg'); ">
                            <div class="food-name">
                                Nasi Goreng
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card-food text-center d-flex flex-column" style="background-image:url('img/ayam.jpg');">
                            <div class="food-name">
                                Ayam Goreng
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="card-food text-center d-flex flex-column" style="background-image:url('img/sate.jpg');">
                            <div class="food-name">
                                Sate Ayam
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-booking" id="food" style="background-color: #e6e6e6;">
            <div class="container">
                <div class="row">
                    <div class="col text-center section-booking-heading">
                        <h1><b>Booking Now</b></h1>
                        <p>Grab your seat before the other <br>
                            Just Clicking the button below.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-booking-content" id="bookingContent">
            <div class="container">
                <div class="section-booking-image row justify-content-left">
                    <div class="col-sm-1 col-md-1 col-lg-1">
                    </div>
                    <div class="col-sm-5 col-md-5 col-lg-5">
                        <div class="card-booking text-center d-flex flex-column" style="background-image: url('img/booking.jpg'); ">
                        </div>
                    </div>
                    
                    <div class="col-sm-5 col-md-5 col-lg-5" >
                        <div class="card-booking text-left d-flex flex-column" style="background-color: #e6e6e6;">
                            <h5>Silahkan tekan tombol dibawah ini untuk :</h5>
                            <ul>
                                <li>Reservasi Kursi</li>
                                <li>Ballroom Booking</li>
                            </ul>
                            <h6>or Contact Us for Customize</h6>
                            <div><a href="booking.php" class="btn btn-getstarted">Booking Now</a></div>
                        </div>
                    </div>
                    <div class="col-sm-1 col-md-1 col-lg-1">
                    </div>
                </div>
            </div>
        </section>

        <section class="section-networks" id="networks" style="background-color: #e6e6e6;">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h2>Payment Support</h2>
                        <p>Make sure to check this
                            <br>
                            before enjoying food at Fin's
                        </p>
                    </div>
                    <div class="col-md-8 text-center">
                        <img src="img/gopay.png" alt="logo partner" class="img-partners pr-4" width="180">
                        <img src="img/ovo.png" alt="logo partner" class="img-partners pr-4" width="180">
                        <img src="img/paypal.png" alt="logo partner" class="img-partners pr-4">
                        <img src="img/visa.png" alt="logo partner" class="img-partners">
                    </div>
                </div>
            </div>
        </section>

    </main>

    <div class="card-footer text-muted">
        <div class="container">
         <p class="text-footer text-center">Copyright &copy; 2020 <span> Fin's Cuisine</span> <a href="url" target="_blank">Indonesia</a> | <a1 href="url">Surabaya, Jawa TImur</a1></p>
         
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>