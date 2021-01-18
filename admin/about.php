<?php
// session_destroy();
    session_start();

    if(!isset($_SESSION["login_FinsResto"])){
        header("Location: login.php");
        exit;
    }

    // Connect Database
    require 'functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Fin's Cuisine</title>
    <link rel="shortcut icon" href="images/cutlery.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Font Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body style="background-color : #1a1a1a;">
<?php
        if(isset($_SESSION["success_FinsResto"]) && $_SESSION["success_FinsResto"] != ''){
            $username = $_SESSION["success_FinsResto"];
            $getaddress = query("SELECT data_name FROM admin_resto WHERE user_username = '$username'");
        }
    ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="index.php"><img src="images/cutlery.png" class="card-img m-2" style="width: 35px;" alt="..."></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item mt-1 active">
        <a class="nav-link" href="index.php"><h5>Fin's Cuisine</h5></a>
      </li>
      <li class="nav-item mt-2">
        <a class="nav-link" href="index.php"><h6>Admin : <?= $username?></h6><span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item mt-2 active">
        <a class="nav-link" href="about.php"><h6>Employee</h6></a>
      </li>
      <li class="nav-item mt-2">
        <a class="nav-link" href="contact.php"><h6>Mail</h6></a>
      </li>
    </ul>
    <a href="logout.php" class="btn btn-primary" role="button">Logout</a>
    
  </div>
</nav>
    <!-- Sing in  Form -->
    <section class="sign-in">
            <div class="container">
                <div class="signin-content" id="signin" style="margin-top: 80px;">
                    <div class="signin-image">
                        <figure><img src="images/Almamater.JPG" alt="sing up image"></figure>
                        <div class="social-login">
                            <span class="social-label">Muhammad Luthfirrohman</span>
                            <ul class="socials">
                                <li><a href="https://scholar.google.com/citations?user=4spRnH4AAAAJ&hl=id&authuser=1"><i class="display-flex-center zmdi zmdi-accounts"></i></a></li>
                                <li><a href="mailto:18081010132@student.upnjatim.ac.id"><i class="display-flex-center zmdi zmdi-local-post-office"></i></a></li>
                                <li><a href="https://www.youtube.com/channel/UCbtxo2hwzCvkUN0l60wU8_w?view_as=subscriber"><i class="display-flex-center zmdi zmdi-youtube-play"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">About me</h2>
                        <p>Nama : <b>Muhammad Luthfirrohman</b></p>
                        <p>NPM  : <b>18081010132</b></p>
                        <p>Kelas : <b>Pemrograman Web (C)</b></p>
                        <br><br>
                        <h2 class="form-title">About this web</h2>
                        <p>Web ini merupakan implementasi tugas kuliah dalam materi :</p>
                        <ul>
                            <li><h6>Bootstrap</h6></li>
                            <li><h6>PHP</h6></li>
                            <li><h6>MySQL</h6></li>
                        </ul>

                    </div>
                </div>
            </div>
        </section>
    
    <script src="js/jquery/jquery-3.5.1.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>