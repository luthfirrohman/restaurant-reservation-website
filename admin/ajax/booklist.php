<?php
    
    require '../functions.php';

    $book_keyword = $_GET["book_keyword"];
    $query = "SELECT * FROM booking
                WHERE 
                book_id LIKE '%$book_keyword%' OR
                book_nama LIKE '%$book_keyword%' OR
                book_phone LIKE '%$book_keyword%' OR
                book_jam LIKE '%$book_keyword%' OR
                book_kursi LIKE '%$book_keyword%' OR
                book_tanggal LIKE '%$book_keyword%' 
                ";
                
    $admin = query($query);
?>

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
                class="btn btn-warning mb-1"
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