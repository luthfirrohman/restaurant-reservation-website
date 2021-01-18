<?php
require'functions.php';

    if(isset($_POST["register"])){

        if(registrasi($_POST) > 0){
            header("Location: login.php");
            echo "
            <script>
                alert('user created')
            </script>";
            
        }else{
            echo mysqli_error($db_connect);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <style>
        label{
            display: block;
        }
    </style>
    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color : #1a1a1a;">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="index.php"><img src="images/cutlery.png" class="card-img m-2" style="width: 35px;" alt="..."></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item mt-1">
        <a class="nav-link active" href="index.php"><h5>Fin's Cuisine</h5></a>
      </li>
      <li class="nav-item mt-2">
        <a class="nav-link" href="index.php"><h6>Admin : -</h6><span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item mt-2">
        <a class="nav-link" href="index_admin.php"><h6>Employee</h6></a>
      </li>
      <li class="nav-item mt-2">
        <a class="nav-link" href="contact.php"><h6>Mail</h6></a>
      </li>
    </ul>
    <a href="logout.php" class="btn btn-primary" role="button">Logout</a>
    
  </div>
</nav>

            <!-- Sign up form -->
            <section class="signup">
            <div class="container" style="margin-top: 120px;">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Buat Akun</h2>
                        <form method="POST" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="id"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="id" id="id" placeholder="ID Pegawai"/ hidden>
                            </div>
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username" id="username" placeholder="Nama Pengguna"/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="repassword"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="repassword" id="repassword" placeholder="Re-password"/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="register" id="register" class="form-submit" value="Buat Akun"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure style="width: 400px;" ><img src="images/resto.jpg" alt="sing up image"></figure>
                        <a href="login.php" class="signup-image-link">Sudah punya akun? Login</a>
                    </div>
                </div>
            </div>
        </section>

         <!-- JS -->
        <script src="vendor/jquery/jquery.min.js"></script>
</body>
</html>