<?php

    require 'functions.php';

    // Jumlah data/halaman
    $page_data_load = 2;
    // Jumlah data di database
    $page_data_total = count(query("SELECT * FROM booking"));
    // Cell (pembulatan keatas)
    $page_total = ceil($page_data_total / $page_data_load);
    // If page was set, go to page directly, else = firstpage
    $page_active = (isset($_GET['page'])) ? $_GET["page"]: 1;

    $page_first_data = 
    ($page_data_load * $page_active) - $page_data_load;


    // Picking data from Database
    $mhs = query("SELECT * FROM booking
    LIMIT $page_first_data, $page_data_load");

    // Checking for the button
    if(isset($_POST["add_book"])){

        // Input Report (Success/Failed)
       if(book_input_proccess($_POST) > 0){
           echo "<script>
                    alert('Booking Berhasil Ditambahkan');
                    document.location.href = 'booking.php';
                </script>";
       }
       else{
           echo "<script>
                    alert('Booking Gagal Ditambahkan');
                    document.location.href = 'booking.php';
                </script>";
       }
    }
    // Search button pressed
    if(isset($_POST["search_book"])){
        $mhs_search = book_search_proccess($_POST["keyword"]);
    }

    if(isset($_POST["update_book"])){
        // Update Report (Success/Failed)
       if(book_update_proccess($_POST) > 0){
        echo "<script>
                 alert('Data Booking Berhasil Diubah');
                 document.location.href = 'booking.php';
             </script>";
        }else{
        echo "<script>
                 alert('Data Booking Gagal Diubah');
                 document.location.href = 'booking.php';
             </script>";
    }
    }

    if(isset($_POST["batal_book"])){
        // Update Report (Success/Failed)
       if(book_delete_proccess($_POST) > 0){
        echo "<script>
                 alert('Booking telah dibatalkan');
                 document.location.href = 'booking.php';
             </script>";
        }else{
        echo "<script>
                 alert('Booking tidak dapat dibatalkan');
                //  document.location.href = 'booking.php';
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
                        <a href="booking.php" class="nav-link active"><h5><b>Reservation</b></h5></a>
                    </li>
                    <li class="nav-item mx-md-2">
                        <a href="contact.php" class="nav-link"><h5>Contact Us</h5></a>
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
                                        Reservation
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 pl-lg-0">
                            <div class="card card-details">
                                <h1>Booking List</h1>
                                <p>Fin's Cuisine Main Room</p>
                                <p>Last Update : 
                                <?php
                                    date_default_timezone_set('Asia/Jakarta');
                                    echo date('d-m-Y H:i:s'); // Hasil: 20-01-2017 05:32:15
                                ?></p>
                                <div class="attendee">
                                <table class="table table-responsive-sm table-bordered text-center">
                                        <!-- Button arrow for previous page -->
                                        <?php if( $page_active > 1 ) :?>
                                        <a href="?page=<?= $page_active - 1;  ?>" class="btn btn-outline-dark pt-1 m-1">&laquo;</a>
                                        <?php endif; ?>

                                        <!-- Page Navbar -->
                                        <?php for( $i=1; $i <= $page_total; $i++ ) :?>
                                            <?php if( $i == $page_active ) :?>
                                            <a href="?page=<?= $i;  ?>" style="font-weight: bold;" class="btn btn-outline-dark pt-1 m-1" ><?= $i;  ?></a>
                                            <?php else :?>
                                                <a href="?page=<?= $i;  ?>" class="btn btn-outline-dark pt-1 m-1"><?= $i;  ?></a>
                                            <?php endif;?>
                                        <?php endfor;?>

                                        <!-- Button for next page -->
                                        <?php if( $page_active < $page_total ) :?>
                                        <a href="?page=<?= $page_active + 1;  ?>" class="btn btn-outline-dark pt-1 m-1">&raquo;</a>
                                        <?php endif; ?>
                                        <thead class="bg-dark text-white">
                                            <tr>
                                                <td>ID</td>
                                                <td>Nama</td>
                                                <td>Waktu</td>
                                                <td>Jumlah</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            // $data_id = 1;
                                        ?>
                                        <?php
                                            foreach($mhs as $row) : 
                                        ?>
                                            <tr>
                                                <td class="align-middle">
                                                    <?= $row['book_id']  ?>
                                                </td>
                                                <td class="align-middle">
                                                    <?= $row['book_nama']  ?>
                                                </td>
                                                <td class="align-middle">
                                                    <?= $row['book_tanggal'] . ",<br>" . $row['book_jam'] ?>
                                                </td>
                                                <td class="align-middle">
                                                    <?= $row['book_kursi']  ?>
                                                </td>
                                            </tr>
                                            <?php
                                                endforeach;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="member mt-3">
                                    <h2>Add Reservation</h2>
                                    <form class="form-inline" method="POST" id="register-form">
                                        <label for="nama"
                                        class="sr-only">Name</label>
                                        <input type="text" name="nama"
                                        class="form-control mb-2 mr-sm-2"
                                        id="name" placeholder="Nama Lengkap">

                                        <label for="alamat"
                                        class="sr-only">Asal</label>
                                        <div class="input-group mb-2 mr-sm-2">
                                            <input type="text" name="alamat"
                                            class="form-control datepicker"
                                            id="asal"
                                            placeholder="Alamat"
                                            required>
                                        </div>

                                        <label for="phone"
                                        class="sr-only">Tanggal Book</label>
                                        <div class="input-group mb-2 mr-sm-2">
                                            <input type="text" name="phone"
                                            class="form-control datepicker"
                                            id="phone"
                                            placeholder="No. Telp"
                                            required>
                                        </div>
                                        
                                        <label for="tanggal"
                                        class="sr-only">Malam</label>
                                        <div class="input-group mb-2 mr-sm-2">
                                            <input type="date" name="tanggal"
                                            class="form-control datepicker"
                                            id="tanggal"
                                            placeholder="Tanggal"
                                            required>
                                        </div>

                                        <label for="jam"
                                        class="sr-only">No. HP</label>
                                        <div class="input-group mb-2 mr-sm-2">
                                            <input type="text" name="jam"
                                            class="form-control datepicker"
                                            id="jam"
                                            placeholder="Jam"
                                            required>
                                        </div>

                                        <label for="kursi"
                                        class="sr-only">No. HP Ortu</label>
                                        <div class="input-group mb-2 mr-sm-2">
                                            <input type="text" name="kursi"
                                            class="form-control datepicker"
                                            id="kursi"
                                            placeholder="Jumlah Kursi"
                                            required>
                                        </div>
                                        <div class="container"></div>
                                        <button type="add_book" name="add_book" id="add_book"
                                        class="btn btn-add-now text-light mb-2 px-4 py-2">
                                        Tambahkan Saya
                                        </button>
                                    </form>
                                    <h3 class="mt-2 mb-0">
                                        Note.
                                    </h3>
                                    <p class="disclaimer mb-0">
                                        You are only able to invite member that has register in Travel'in
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card card-details card-right">
                                
                                <h1>Reschedule Reservation</h1>
                                <div class="member mt-3">
                                    <h2>Verification</h2>
                                    <form class="form-inline" method="POST" id="register-form">
                                        <label for="keyword"
                                        class="sr-only">Name</label>
                                        <input type="text" name="keyword"
                                        class="form-control mb-2 mr-sm-2"
                                        id="keyword" placeholder="No. HP" required>

                                        <div class="container"></div>
                                        <button type="submit" name="search_book" id="search_book"
                                        class="btn btn-add-now text-light mb-2 px-4 py-2">
                                        Check
                                        </button>
                                    </form>
                                    <div class="attendee mt-2" id="container">
                                        <?php
                                            if(isset($_POST["search_book"])){
                                                foreach($mhs_search as $row) :
                                        ?>
                                        <table class="trip-information">
                                            <tr>
                                                <th width="10%">
                                                ID <hr></th>
                                                <td width="90%" 
                                                class="text-right">
                                                <?= $row['book_id']  ?><hr></td>
                                            </tr>
                                            <tr>
                                                <th width="10%">
                                                Nama <hr></th>
                                                <td width="90%" 
                                                class="text-right">
                                                <?= $row['book_nama']  ?><hr></td>
                                            </tr>
                                            <tr>
                                                <th width="10%">
                                                Detail <hr></th>
                                                <td width="90%" 
                                                class="text-right">
                                                <?= $row['book_tanggal'] . ",<br>" . $row['book_jam'] ?><hr></td>
                                            </tr>
                                            <tr>
                                                <th width="10%">
                                                Seat <hr></th>
                                                <td width="90%" 
                                                class="text-right">
                                                <?= $row['book_kursi']  ?><hr></td>
                                            </tr>
                                            <tr>
                                                <th><button class="btn btn-warning" data-toggle="modal" data-target="#modalReschedule">Reschedule</button></th>
                                                <td><button class="btn btn-danger" data-toggle="modal" data-target="#modalBatalBook">Batalkan</button></td>
                                            </tr>
                                        </table>
                                        <?php
                                            endforeach;}
                                        ?>
                                </div>
                                    <h3 class="mt-2 mb-0">
                                        Note.
                                    </h3>
                                    <p class="disclaimer mb-0">
                                        Make sure to remember your phone number when Adding Reservation
                                    </p>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- Modal -->
            <div class="modal fade" id="modalReschedule" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h5 class="modal-title text-white" id="exampleModalLongTitle">Reschedule Reservasi</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form class="form-inline" method="post" id="register-form">
                    
                    <label for="book_id"
                        class="sr-only">Kode Booking</label>
                        <div class="input-group">
                            <input type="text" name="book_id"
                            class="form-control"
                            id="book_id"
                            value="<?= $row['book_id']  ?>" hidden
                            >
                        </div>
                    <label for="book_timestamp"
                        class="sr-only">Timestamp</label>
                        <div class="input-group">
                            <input type="text" name="book_timestamp"
                            class="form-control"
                            id="book_id"
                            value="<?= $row['book_timestamp']  ?>" hidden
                            >
                        </div>

                    <label for="nama"
                        class="sr-only">Name</label>
                        <input type="text" name="nama"
                        class="form-control mb-2 mr-sm-2"
                        id="name" value="<?= $row['book_nama']  ?>">

                        <label for="alamat"
                        class="sr-only">Asal</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <input type="text" name="alamat"
                            class="form-control datepicker"
                            id="asal"
                            value="<?= $row['book_alamat']  ?>"
                            required>
                        </div>

                        <label for="phone"
                        class="sr-only">Tanggal Book</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <input type="text" name="phone"
                            class="form-control datepicker"
                            id="phone"
                            value="<?= $row['book_phone']  ?>"
                            required>
                        </div>
                        
                        <label for="tanggal"
                        class="sr-only">Malam</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <input type="date" name="tanggal"
                            class="form-control datepicker"
                            id="tanggal"
                            value="<?= $row['book_tanggal']  ?>"
                            required>
                        </div>

                        <label for="jam"
                        class="sr-only">No. HP</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <input type="text" name="jam"
                            class="form-control datepicker"
                            id="jam"
                            value="<?= $row['book_jam']  ?>"
                            required>
                        </div>

                        <label for="kursi"
                        class="sr-only">No. HP Ortu</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <input type="text" name="kursi"
                            class="form-control datepicker"
                            id="kursi"
                            value="<?= $row['book_kursi']  ?>"
                            required>
                        </div>

                
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary"
                        name="update_book" id="update_book">Simpan Perubahan</button>
                    </div>
                    </div>
                </form>
                </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modalBatalBook" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h5 class="modal-title text-white" id="exampleModalLongTitle">Pembatalan Reservasi</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-inline" method="post" id="register-form">
                        <h6>Anda yakin ingin membatalkan Reservasi ini??</h6>
                        <label for="book_id"
                        class="sr-only">Kode Booking</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <input type="text" name="book_id"
                            class="form-control"
                            id="book_id"
                            value="<?= $row['book_id']  ?>"
                            hidden>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary"
                        name="batal_book" id="batal_book">Batalkan Reservasi</button>
                    </div>
                    </div>
            </form>
            </div>
        </div>
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

    <script src="js/script.js"></script>
    <script>
        $('#jam').datetimepicker({
            format: 'hh:ii',
            language:  'en',
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 1,
            minView: 0,
            maxView: 1,
            forceParse: 0
        });
</script>
</body>
</html>