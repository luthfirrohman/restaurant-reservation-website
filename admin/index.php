<?php
    session_start();
    if(!isset($_SESSION["login_FinsResto"])){
        header("Location: login.php");
        exit;
    }
    // Connect Database
    require 'functions.php';
    $username = $_SESSION["success_FinsResto"];
    // Jumlah data/halaman
    $page_data_load = 4;
    // Jumlah data di database
    $page_data_total = count(query("SELECT * FROM booking"));
    // Cell (pembulatan keatas)
    $page_total = ceil($page_data_total / $page_data_load);
    // If page was set, go to page directly, else = firstpage
    $page_active = (isset($_GET['page'])) ? $_GET["page"]: 1;

    $page_first_data = 
    ($page_data_load * $page_active) - $page_data_load;

    // Picking data from Database
    $admin = query("SELECT * FROM booking
    LIMIT $page_first_data, $page_data_load");

    // Search button pressed
    if(isset($_POST["book_search"])){
        $admin = book_search_proccess($_POST["book_keyword"]);
    }


    if(isset($_POST["add_book"])){

        // Input Report (Success/Failed)
       if(book_input_proccess($_POST) > 0){
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
    <link rel="stylesheet" href="css/style.css?v=<?= time();  ?>">
    <style>
        .loader{
            width: 20px;
            position: absolute;
            padding-left: 5px;
            display: none;
        }
    </style>
</head>
<body style="background-color : #1a1a1a;">
    <?php
        if(isset($_SESSION["success_FinsResto"]) && $_SESSION["success_FinsResto"] != ''){
            $username = $_SESSION["success_FinsResto"];
            // $getaddress = query("SELECT employee_username FROM admin_resto");
        }
    ?>
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
        <a class="nav-link" href="index.php"><h6>Admin : <?= $username?></h6><span class="sr-only">(current)</span></a>
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
    <section class="signup mt-5">
        <!-- <a href="admin_input.php" class="btn btn-primary" style="margin-top: 50px; margin-left: 320px" role="button">Tambah Contact</a> -->
        <button class="btn btn-primary" style="margin-top: 50px; margin-left: 180px" data-toggle="modal" data-target="#modalAddBook">Tambahkan Reservasi</button>
            <!-- <input type="submit" name="add" id="add" class="form-submit" value="Tambah Contact" style="margin-top: 70px; margin-left: 40px"/>  -->
            <div class="container" style="margin-top: 20px; padding:20px; width:100%;">
            <div class="search"  style="float: left; margin-bottom:-40px;">
                <h6 class="form font-weight-bold">Cari Reservasi</h6>
                    <form action="" method="post">
                        <input type="text" name="book_keyword" autofocus
                        placeholder="Masukkan keyword" autocomplete="off"
                        id="book_keyword">
                        <button type="submit" name="book_search" id="book_search">Cari</button>
                        
                        <img src="images/loader.gif" class="loader">
                    </form>
                    <br>
            <!-- Button arrow for previous page -->
                <?php if( $page_active > 1 ) :?>
                    <a href="?page=<?= $page_active - 1;  ?>" style="color:#fff;"><button type="button" class="btn btn-info">&laquo;</button></a>
                <?php endif; ?>

                <!-- Page Navbar -->
                <?php for( $i=1; $i <= $page_total; $i++ ) :?>
                    <?php if( $i == $page_active ) :?>
                        <a href="?page=<?= $i;  ?>" style="font-weight: bold; color:#fff;"><button type="button" class="btn btn-info font-weight-bold"><?= $i;  ?></button></a>
                    <?php else :?>
                        <a href="?page=<?= $i;  ?>" style="color:#fff;"><button type="button" class="btn btn-info"><?= $i;  ?></button></a>
                    <?php endif;?>
                <?php endfor;?>

                <!-- Button for next page -->
                <?php if( $page_active < $page_total ) :?>
                    <a href="?page=<?= $page_active + 1;  ?>" style="color:#fff;"><button type="button" class="btn btn-info">&raquo;</button></a>
                <?php endif; ?>
                </div>

                <div class="signup-content" style="width: 100%;"> 
                    <div class="table-responsive rounded" id="container">
                        <table class="table table-bordered" id="myTable" width="100%" cellspacing = 0>
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No. Telp</th>
                                    <th>Reservasi</th>
                                    <th>Seat</th>
                                    <th>Timestamp</th>
                                    <th></th>
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
                                    <td class="align-middle"><?= $data_id;  ?></td>
                                    <td class="align-middle">
                                        <?= $row["book_id"];  ?>
                                    </td>
                                    <td class="align-middle">
                                        <?= $row["book_nama"];  ?>
                                    </td>
                                    <td class="align-middle">
                                        <?= $row["book_alamat"];  ?>
                                    </td>
                                    <td class="align-middle">
                                        <?= $row["book_phone"];  ?>
                                    </td>
                                    <td class="align-middle">
                                        <?= $row["book_tanggal"]. " " . $row["book_jam"]; ?>
                                    </td>
                                    <td class="align-middle">
                                        <?= $row["book_kursi"];  ?>
                                    </td>
                                    <td class="align-middle">
                                        <?= $row["book_timestamp"];  ?>
                                    </td>
                                    <td class="align-middle">
                                        <a href="book_update.php?book_id= <?= $row["book_id"];  ?>"
                                        class="btn btn-warning"
                                        >Ubah</a> 
                                        <a href="book_delete.php?book_id= <?= $row["book_id"];  ?> "
                                        onclick=" return confirm('Delete Contact??'); "
                                        class="btn btn-danger"
                                        >Hapus</a>
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
                </div>
            </div>
        </section>

        <!-- Modal Add book -->
        <div class="modal fade" id="modalAddBook" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h5 class="modal-title text-white" id="exampleModalLongTitle">Tambahkan Reservasi</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form class="form-inline" method="post" id="register-form">
     
                        </div> -->
                        <div class="form-group mr-1 mb-3">
                            <label for="book_nama"><i class="zmdi zmdi-lock"></i></label>
                            <input type="text" name="book_nama" id="book_nama" required
                            placeholder="Nama Customer"/>
                        </div>
                        <div class="form-group mr-1 mb-3">
                            <label for="book_alamat"><i class="zmdi zmdi-lock"></i></label>
                            <input type="text" name="book_alamat" id="book_alamat" required
                            placeholder="Alamat Customer"/>
                        </div>
                        <div class="form-group mr-1 mb-3">
                            <label for="book_phone"><i class="zmdi zmdi-lock"></i></label>
                            <input type="text" name="book_phone" id="book_phone" required
                            placeholder="No. HP Customer"/>
                        </div>
                        <div class="form-group ml-2 mb-3">
                            <label for="book_tanggal"><i class="zmdi zmdi-lock"></i></label>
                            <input type="date" name="book_tanggal" id="book_tanggal" required
                            placeholder="Tanggal Kedatangan"/>
                        </div>
                        <div class="form-group ml-0 mb-3">
                            <label for="book_jam"><i class="zmdi zmdi-lock"></i></label>
                            <input type="text" name="book_jam" id="book_jam" required
                            placeholder="Jam Kedatangan"/>
                        </div>
                        <div class="form-group ml-2 mb-3">
                            <label for="book_kursi"><i class="zmdi zmdi-lock"></i></label>
                            <input type="text" name="book_kursi" id="book_kursi" required
                            placeholder="Jumlah Seat"/>
                    </div>
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary"
                        name="add_book" id="add_book">Tambahkan</button>
                    </div>
                    </div>
                </form>
                </div>
            </div>
    

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    
    <script src="js/jquery/jquery-3.5.1.min.js"></script>
    <script src="js/script_book.js"></script>
</body>
</html>