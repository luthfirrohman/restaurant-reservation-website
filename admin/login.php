<?php
    session_start();
    require'functions.php';

    // Cookie Checking
    if(isset($_COOKIE['id_FinsResto']) && isset($_COOKIE['kunci_FinsResto'])){
        $cookie_id = $_COOKIE['id_FinsResto'];
        $cookie_kunci = $_COOKIE['kunci_FinsResto'];

        //  Data Picking (admin_id)
        $db_result = mysqli_query($db_connect, "SELECT user_username FROM user WHERE user_id = $cookie_id");
        $row = mysqli_fetch_assoc($db_result);

        // Make sure cookie same as username(hashed)
        if($cookie_kunci === hash('sha256', $row['user_username'])){
            $_SESSION['login_FinsResto'] = true;
        }
    }

    if(isset($_SESSION["login_FinsResto"])){
        $username = $_SESSION['username'];
        header("Location: index.php");
        exit;
    }


    // Checking for the button
    if(isset($_POST["login_FinsResto"])){

        $username = $_POST["username"];
        $password = $_POST["password"];

        $result_username = 
        mysqli_query($db_connect, "SELECT * FROM admin_resto 
        WHERE employee_username = '$username'");

        // Username Checking
        if(mysqli_num_rows($result_username) === 1){
            // Password Checking
            $row = mysqli_fetch_assoc($result_username);
            // if(password_verify($password, $row["user_password"])){
                if($password == $row["employee_password"]){
                // SESSION SET
                $_SESSION["login_FinsResto"] = true;
                $_SESSION["success_FinsResto"] = $username;
                

                // Remember me Checking
                if($_POST["remember"]){
                    // Cookie set
                    setcookie('id_FinsResto', $row['employee_id'], time()+60);
                    setcookie('kunci_FinsResto', 
                    hash('sha256', $row['employee_username']), time()+60);
                }

                header("Location: index.php");
                exit;
            }else{
                header("Location: login.php");
            }
        }

        $error=true;
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
    <!-- <a href="logout.php" class="btn btn-primary" role="button">Logout</a> -->
    
  </div>
</nav>
            <!-- Sing in  Form -->
            <section class="sign-in">
            <div class="container">
                <div class="signin-content" id="signin" style="margin-top: 120px;">
                    <div class="signin-image">
                        <figure style="width: 400px;" ><img src="images/resto.jpg" alt="sing up image"></figure>
                        <div class="social-login">
                            <span class="social-label"> <b>Fin's Cuisine</b></span>
                            <ul class="socials">
                                <li><a href="https://scholar.google.com/citations?user=4spRnH4AAAAJ&hl=id&authuser=1"><i class="display-flex-center zmdi zmdi-accounts"></i></a></li>
                                <li><a href="mailto:18081010132@student.upnjatim.ac.id"><i class="display-flex-center zmdi zmdi-local-post-office"></i></a></li>
                                <li><a href="https://www.youtube.com/channel/UCbtxo2hwzCvkUN0l60wU8_w?view_as=subscriber"><i class="display-flex-center zmdi zmdi-youtube-play"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Login</h2>
                        <?php
                            if(isset($error)) :
                        ?>
                        <p style="color: red;">Username / Password Salah</p><br>
                        <?php
                            endif;
                        ?>
                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="username"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username" id="username" placeholder="Username" required/>
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password" required/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember" id="remember" class="agree-term" />
                                <label for="remember" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="login_FinsResto" id="login-FinsResto" class="form-submit" value="Log in"/>
                            </div>
                            <a href="registrasi.php" class="signup-image-link zmdi zmdi-account-add ">Tidak punya akun?</a>
                        </form>
                        
                    </div>
                </div>
            </div>
        </section>

        <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- <script src="js/main.js"></script> -->
    
</body>
</html>