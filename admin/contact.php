<?php
// session_destroy();
    session_start();

    if(!isset($_SESSION["login_FinsResto"])){
        header("Location: login.php");
        exit;
    }

    // Connect Database
    require 'functions.php';
    
    $username = $_SESSION["success_FinsResto"];

    // Picking data from Database
    $admin = query("SELECT * FROM datamail");

    if(isset($_POST["send_mail"])){

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
    <title>Admin Fin's Cuisine</title>
    <link rel="shortcut icon" href="images/cutlery.png" />
    <!-- <script src='js/javascript.js'></script> -->
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
            // $getaddress = query("SELECT data_name FROM admin_resto WHERE user_username = '$username'");
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
    <!-- Sing in  Form -->
    <section class="signup">
            <div class="container p-5" style="margin-top: 160px; width:100%;">
                <h2 class="form-title">Received Mail</h2>
                <div class="table-responsive rounded mt-4" id="container">
                    <table class="table table-bordered" id="myTable" width="100%" cellspacing = 0>
                    <thead class="thead-dark">
                            <tr>
                                <th class="align-middle text-center" style="width: 10px;">No.</th>
                                <th class="align-middle text-center" width="180">Nama</th>
                                <th class="align-middle text-center" width="180">Email</th>
                                <th class="align-middle text-center" width="180">No. Telp</th>
                                <th class="align-middle text-center" width="100">Kategori</th>
                                <th>Isi Pesan</th>
                                <th width="10"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $data_id = 1;
                            ?>
                            <?php
                                foreach($admin as $row) :
                            ?>
                            <tr>
                                <td><?= $data_id;  ?></td>
                                <td class="align-middle text-center">
                                    <?= $row["mail_name"];  ?>
                                </td>
                                <td class="align-middle text-center">
                                    <?= $row["mail_email"];  ?>
                                </td>
                                <td class="align-middle text-center">
                                    <?= $row["mail_phone"];  ?>
                                </td>
                                <td class="align-middle text-center">
                                    <?= $row["mail_category"];  ?>
                                </td>
                                <td class="align-middle">
                                    <?= $row["mail_message"];  ?>
                                </td>
                                <td class="align-middle text-center">
                                    <a href="mail_delete.php?mail_id= <?= $row["mail_id"];  ?> "
                                    onclick=" return confirm('Unsend Pesan??'); " class="btn btn-danger align-middle"
                                    >Delete</a>
                                </td>
                            </tr>
                            <?php
                                $data_id++;
                            ?>
                            <?php
                                endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
        </section>
    
    <script src="js/jquery/jquery-3.5.1.min.js"></script>
    <script src="js/script.js"></script>
    <!-- <script src="js/javascript.js"></script> -->
</body>
</html>