<?php
    session_start();

    if(!isset($_SESSION["login_FinsResto"])){
        header("Location: login.php");
    }

    require 'functions.php';

    // Checking for the button
    if(isset($_POST["add"])){

        // Input Report (Success/Failed)
       if(admin_input_proccess($_POST) > 0){
           echo "<script>
                    alert('Data Berhasil Ditambahkan');
                    document.location.href = 'index.php';
                </script>";
       }
       else{
           echo "<script>
                    alert('Data Gagal Ditambahkan');
                    document.location.href = 'index.php';
                </script>";
       }
    }
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
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        label{color: #1a1a1a;}
    </style>
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
      <li class="nav-item mt-2 active">
        <a class="nav-link" href="index.php"><h6>Admin : <?= $username?></h6><span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item mt-2">
        <a class="nav-link" href="index_admin.php"><h6>Employee</h6></a>
      </li>
      <li class="nav-item mt-2 active">
        <a class="nav-link" href="contact.php"><h6>Mail</h6></a>
      </li>
    </ul>
    <a href="logout.php" class="btn btn-primary" role="button">Logout</a>
    
  </div>
</nav>
    <section class="signup">
        <div class="container" style="margin-top: 100px; padding:10px;">
                <div class="signup-content" style="width: 100%;">
                <div class="signup-form">
                        <h2 class="form-title">Add Contact</h2>
                        <form method="POST" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="friendname"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="friendname" id="friendname" placeholder="Friend Name"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-lock"></i></label>
                                <input type="email" name="email" id="email" placeholder="Email"/>
                            </div>
                            <div class="form-group">
                                <label for="phone"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="phone" name="phone" id="phone" placeholder="Phone"/>
                            </div>
                            <!-- <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>Menyetujui,  <a href="#" class="term-service">Kebijakan & Privasi</a></label>
                            </div> -->
                            <div class="form-group form-button">
                                <input type="submit" name="add" id="add" class="form-submit" value="Tambah Contact"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/resto.jpg" class="rounded-10" alt="sing up image"></figure>
                    </div>
                </div>
            </div>
        </section>
    
    <script src="js/jquery/jquery-3.5.1.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>