<?php
    // Connect Database
    require 'functions.php';


    if(isset($_POST["sendMail"])){

        // Input Report (Success/Failed)
       if(mail_input_proccess($_POST) > 0){
           echo "<script>
                    alert('Data Berhasil Ditambahkan');
                    document.location.href = 'contact.php';
                </script>";
       }
       else{
           echo "<script>
                    alert('Data Gagal Ditambahkan');
                    document.location.href = 'contact.php';
                </script>";
       }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <!-- <?= time();  ?> -->
    <link rel="stylesheet" href="styles/main.css?v=<?= time();  ?>">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <script src="https://use.fontawesome.com/cc75a31cdc.js"></script>
    <title>Fin's Cuisine</title>
    <link rel="shortcut icon" href="admin/images/cutlery.png" />
    <style>
        body{
            background-image: url("img/backdrop.jpg");
            position: cover;
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body>
    
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
                        <a href="index.php" class="nav-link"><h5>Home</h5></a>
                    </li>
                    <li class="nav-item mx-md-2">
                        <a href="booking.php" class="nav-link"><h5>Reservation</h5></a>
                    </li>
                    <li class="nav-item mx-md-2">
                        <a href="contact.php" class="nav-link active"><h5><b>Contact Us</b></h5></a>
                    </li>
                </ul>
            </div>
        </nav>  
</div>


<!-- END Navbar -->

<main>
    <section class="section-details-header"></section>
    <section class="section-details-content">
                <div class="container">
                <div class="row">
                        <div class="col p-0">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.php">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        Contact
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 pl-lg-0">
                            <div class="card card-details mb-5">
                                <div class="row justify-content-center">
                                    <h1 class="mb-5"><b>Find Us!</b></h1>
                                    <div class="row">                           
                                        <div class="col-lg-1 offset-1 col-md-2 col-sm-2 col-2">
                                            <span style="font-size:30px;"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="col-lg-10 col-md-9 col-sm-9 col-9">
                                            <p>Jl. Rungkut Asri Timur gg. 13 E-41, <br>Surabaya, <br> Indonesia</p>
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d989.302097198095!2d112.78348212919951!3d-7.330477399669347!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fac6d152398b%3A0x102de173c8967136!2sJl.%20Rungkut%20Asri%20Timur%20XIII%20No.41%2C%20Rungkut%20Kidul%2C%20Kec.%20Rungkut%2C%20Kota%20SBY%2C%20Jawa%20Timur%2060293!5e0!3m2!1sid!2sid!4v1609819732480!5m2!1sid!2sid"  frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                        </div>

                                        <div class="col-lg-1 offset-1 col-md-2 col-sm-2 col-2">
                                            <span style="font-size:30px;"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="col-lg-10 col-md-9 col-sm-9 col-9">
                                            <p>Mr. Brown, <br>+62 089 7651 9956, <br> Mon-Fri, 09:00 - 21:00</p>   
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="col-lg-7 pl-lg-0">
                            <div class="card card-details mb-5">
                                <div class="row">
                                    <h1><b>Say Hello To Us!</b></h1>
                                    <p>For further inquiries, please feel free to contact us using the form below. We will get back to you as soon as possible.</p>
                                    <div class="col-lg-12 pl-lg-0">
                                        <form class="form" method="post" id="register-form">
                                            <div class="form-group">
                                                <label for="name">Customer Name</label>
                                                <input type="text" name="name" id="name" required style="width: 100%;" class="form-control"
                                                placeholder="Your Name"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" name="email" id="email" required style="width: 100%;" class="form-control"
                                                placeholder="Email"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Phone Number</label>
                                                <input type="text" name="phone" id="phone" required style="width: 100%;" class="form-control"
                                                placeholder="Phone Number"/>
                                            </div>
                                            <label for="category"
                                            class="sr-only">Malam</label>
                                            <select name="category" id="category" 
                                            class="custom-select mb-2 mr-sm-2" required>
                                            <option value="" disabled selected hidden>
                                                --- Categories --
                                            </option>
                                            <option value="question">
                                                Question
                                            </option>
                                            <option value="complaint">
                                                Complaint
                                            </option>
                                            <option value="suggestion">
                                                Suggestion
                                            </option>
                                            <option value="other">
                                                other
                                            </option>
                                        </select>
                                            <div class="form-group">
                                                <label for="message">Message</label>
                                                <!-- <input type="text" id="message" class="form-control" placeholder="Messages" style="width:100%;"> -->
                                                <textarea class="form-control" name="message" id="message" rows="10" placeholder="Message" style="width:100%;"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary" name="sendMail" id="sendMail">Send Messages</button>
                                        </form>
                                    </div>     
                                </div>
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
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>