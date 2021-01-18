<?php
    
    require '../functions.php';

    $admin_keyword = $_GET["admin_keyword"];
    $query = "SELECT * FROM admin_resto
                WHERE 
                employee_id LIKE '%$admin_keyword%' OR
                employee_username LIKE '%$admin_keyword%' OR
                employee_access LIKE '%$admin_keyword%' 
                ";
                
    $admin = query($query);
?>

<table class="table table-bordered" id="myTable" width="100%" cellspacing = 0>
    <thead class="thead-dark">
        <tr>
            <th>No</th>
            <th>ID Pegawai</th>
            <th>Username</th>
            <th width="100">Akses</th>
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
            <td><?= $data_id;  ?></td>
            <td>
                <?= $row["employee_id"];  ?>
            </td>
            <td>
                <?= $row["employee_username"];  ?>
            </td>
            <td>
                <?= $row["employee_access"];  ?>
                <?php
                    if( $row["employee_access"]=="allowed"){
                ?>
                <h6>Allowed</h6>
                <!-- <button class="btn btn-warning" data-toggle="modal" data-target="#modalEditAdmin">Delete</button> -->
                <?php
                    }else{
                ?>
                <a href="admin_add_access.php?data_id= <?= $row["data_id"];  ?> "
                onclick=" return confirm('Allow Admin Access??'); "
                class="btn btn-success"
                >Allow</a>
                <?php
                    }
                ?>
            </td>
            <td>
                <a href="admin_update.php?employee_id= <?= $row["employee_id"];  ?>"
                class="btn btn-info"
                >Ubah</a> 
                <a href="admin_delete.php?employee_id= <?= $row["employee_id"];  ?> "
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