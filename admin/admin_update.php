<?php
    session_start();

    if(!isset($_SESSION["login_FinsResto"])){
        header("Location: login.php");
    }

    require 'functions.php';

    // Data Picking
    $admin_data = $_GET["data_id"];

    // Query data berdasar admin_id
    $admin = query("SELECT * FROM admin_resto WHERE employee_id = $admin_data")[0];

    // Checking for the button
    if(isset($_POST["edit"])){
        
        // Update Report (Success/Failed)
       if(admin_update_proccess($_POST) > 0){
           echo "<script>
                    alert('Data Berhasil Diubah');
                    document.location.href = 'index.php';
                </script>";
       }else{
           echo "<script>
                    alert('Data Gagal Diubah');
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
            $getaddress = query("SELECT employee_username FROM admin_resto WHERE employee_username = '$username'");
        }
    ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="index.php"><img src="images/cutlery.png" class="card-img m-2" style="width: 35px;" alt="..."></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto active">
      <li class="nav-item mt-1 active">
        <a class="nav-link" href="index.php"><h5>Fin's Cuisine</h5></a>
      </li>
      <li class="nav-item mt-2 active">
        <a class="nav-link" href="index.php"><h6>Admin : <?= $username?></h6><span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item mt-2 active">
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
                        <h2 class="form-title">Edit Contact</h2>
                        <form method="POST" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="username"><i class="zmdi zmdi-lock"></i></label>
                                <input type="text" name="username" id="username" required
                                value="<?= $admin["employee_username"];?>"/>
                            </div>
                            <div class="form-group">
                                <label for="access"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="text" name="access" id="access" required
                                value="<?= $admin["employee_access"];?>"/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="edit" id="edit" class="form-submit" value="Ubah Contact"/>
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