<?php
    // Connect Database
    $db_connect = mysqli_connect("localhost", "root", "", 
    "db_restoran");
    // if (!$db_connect)
    // {
    //     die("Connection failed: " . mysqli_connect_error()); 
    // }
    date_default_timezone_set("Asia/Jakarta");
    
    function registrasi($data_registrasi){
        global $db_connect;
        $employee_id = strtolower(stripslashes($data_registrasi["id"]));
        $username = strtolower(stripslashes($data_registrasi["username"]));
        $password = mysqli_real_escape_string($db_connect, $data_registrasi["password"]);
        $repassword = mysqli_real_escape_string($db_connect, $data_registrasi["repassword"]);
        $access = "denied";

        // Username unique checking
        $db_result_username = 
        mysqli_query($db_connect, "SELECT employee_id, employee_username FROM admin_resto WHERE employee_username = '$username'");
        
        if(mysqli_fetch_assoc($db_result_username)){
            echo"
            <script>
                alert('Username sudah terdaftar');
            </script>";
            return false;
            ;
        }
        
        // Confirm Password
        if($password!=$repassword){
            echo"
            <script>
                alert('Pasword tidak sesuai');
            </script>";
            return false;
            ;
        }
        
        // Password Encryption
        // $password = password_hash($password, PASSWORD_DEFAULT);

        // Insert Database
        mysqli_query($db_connect, "INSERT INTO admin_resto 
        VALUES('$employee_id', '$username', '$password', '$access')");
        return mysqli_affected_rows($db_connect);
    }

    function query($query){
        global $db_connect;
        $db_result = mysqli_query($db_connect, $query);
        $rows = [];
        while($row = mysqli_fetch_assoc($db_result)){
            $rows[] = $row;
        }
        return $rows;
    }

    function admin_input_proccess($admin_data_input){
        global $db_connect;
        // Data Picking
        $employee_id = strtolower(stripslashes($admin_data_input["id"]));
        $username = strtolower(stripslashes($admin_data_input["username"]));
        $password = mysqli_real_escape_string($db_connect, $admin_data_input["password"]);
        $access = "denied";
        
        // Image Uploading
        // $gambar = upload();
        // if(!$gambar){
        //     return false;
        // }

        // Query Insert Data
        $query = "INSERT INTO admin_resto 
        VALUES('$employee_id', '$username', '$password', '$access')";
        mysqli_query($db_connect, $query);
        return mysqli_affected_rows($db_connect);
    }

    function mail_input_proccess($mail_data_input){
        global $db_connect;
        // Data Picking
        $username = $_SESSION["success_FinsResto"];
        $email = htmlspecialchars($mail_data_input["email"]);
        $nama = htmlspecialchars($mail_data_input["nama"]);
        $pesan = htmlspecialchars($mail_data_input["pesan"]);
        
        // Image Uploading
        // $gambar = upload();
        // if(!$gambar){
        //     return false;
        // }

        // Query Insert Data
        $query = "INSERT INTO datamail VALUES
                    ('','$username','$email','$nama','$pesan')";
        mysqli_query($db_connect, $query);
        return mysqli_affected_rows($db_connect);
    }

    function upload(){
        $admin_upload_image_name = $_FILES['gambar']['name'];
        $admin_upload_image_size = $_FILES['gambar']['size'];
        $admin_upload_image_error = $_FILES['gambar']['error'];
        $admin_upload_image_tmp = $_FILES['gambar']['tmp_name'];

        // Image Uploading Crosscheck
        if($admin_upload_image_error === 4){
            echo"
            <script>
                alert('Gambar kosong');
            </script>";
            return false;
        }

        // Image Uploading Crosscheck --> Extension Files
        $admin_upload_image_valid = ['jpg','jpeg','png'];

        $admin_upload_image_ext = explode('.',$admin_upload_image_name);

        $admin_upload_image_ext = strtolower(end($admin_upload_image_ext));


        // Find extension luthfi.jpg in requirements(.jpg, .png, .jpeg)
        if(!in_array($admin_upload_image_ext, $admin_upload_image_valid)){
            echo
            "<script>
                alert('File tidak termasuk gambar');
            </script>";
            return false;
        }

        // Imgae_size must be 1MB or lower
        if($admin_upload_image_size > 1000000){
            echo"
            <script>
                alert('Ukuran gambar lebih dari 1MB');
            </script>";
            return false;
        }

        // Uploading Image
        // Make a new Image_name to make each files different
        $admin_upload_image_name_new = uniqid();
        $admin_upload_image_name_new .= '.';
        $admin_upload_image_name_new .= $admin_upload_image_ext;

        move_uploaded_file($admin_upload_image_tmp, 'images/' . $admin_upload_image_name_new);

        return $admin_upload_image_name_new;

       }
    
    function admin_add_access($admin_add_access){
        global $db_connect;
        $access = "Allowed";
        
        mysqli_query($db_connect, "UPDATE employee_access SET employee_access = '$access'
        WHERE employee_id = $admin_add_access");
        return mysqli_affected_rows($db_connect);
    }
    function admin_delete_access($admin_delete_access){
        global $db_connect;
        
        mysqli_query($db_connect, "UPDATE employee_access FROM admin_resto
        WHERE data_id = $admin_delete_access");
        return mysqli_affected_rows($db_connect);
    }


    function book_input_proccess($book_data_input){
        global $db_connect;
        // Data Picking
        $nama = htmlspecialchars($book_data_input["book_nama"]);
        $alamat = htmlspecialchars($book_data_input["book_alamat"]);
        $phone = htmlspecialchars($book_data_input["book_phone"]);
        $tanggal = htmlspecialchars($book_data_input["book_tanggal"]);
        $jam = htmlspecialchars($book_data_input["book_jam"]);
        $kursi = htmlspecialchars($book_data_input["book_kursi"]);
        $timestamp =  date('d-m-Y H:i:s');

        
        // Image Uploading
        // $gambar = upload();
        // if(!$gambar){
        //     return false;
        // }

        // Query Insert Data
        $query = "INSERT INTO booking VALUES
                    ('','$nama','$alamat','$phone','$tanggal','$jam','$kursi', '$timestamp')";
        mysqli_query($db_connect, $query);
        return mysqli_affected_rows($db_connect);
    }
    function book_update_proccess($book_data_update){
        global $db_connect;
        // Data Picking
        $book_id = $book_data_update["book_id"];
        $username = htmlspecialchars($book_data_update["book_nama"]);
        $alamat = htmlspecialchars($book_data_update["book_alamat"]);
        $phone = htmlspecialchars($book_data_update["book_phone"]);
        $tanggal = htmlspecialchars($book_data_update["book_tanggal"]);
        $jam = htmlspecialchars($book_data_update["book_jam"]);
        $kursi = htmlspecialchars($book_data_update["book_kursi"]);
        // $timestamp = $book_data_update["book_timestamp"];
        $new_timestamp =  date('d-m-Y H:i:s');

        // $gambar_lama = htmlspecialchars($admin_data_update["admin_gambar_lama"]);
        // if($_FILES['gambar']['error'] === 4){
        //     $gambar = $gambar_lama;
        // }else{
        //     $gambar = upload();
        // }
        

        // Query Insert Data
        $query = "UPDATE booking SET
                    book_nama = '$username',
                    book_alamat = '$alamat',
                    book_phone = '$phone',
                    book_tanggal = '$tanggal',
                    book_jam = '$jam',
                    book_kursi = '$kursi',
                    book_timestamp = '$new_timestamp'
                    WHERE book_id = $book_id
                    ";
        mysqli_query($db_connect, $query);
        return mysqli_affected_rows($db_connect);
    }
    function book_delete_proccess($book_data_delete){
        global $db_connect;
        
        mysqli_query($db_connect, "DELETE FROM booking
        WHERE book_id = $book_data_delete");
        return mysqli_affected_rows($db_connect);
    }


    function admin_delete_proccess($admin_data_delete){
        global $db_connect;
        
        mysqli_query($db_connect, "DELETE FROM admin_resto
        WHERE employee_id = $admin_data_delete");
        return mysqli_affected_rows($db_connect);
    }


    function mail_delete_proccess($mail_data_delete){
        global $db_connect;
        
        mysqli_query($db_connect, "DELETE FROM datamail
        WHERE mail_id = $mail_data_delete");
        return mysqli_affected_rows($db_connect);
    }

    function admin_update_proccess($admin_data_update){
        global $db_connect;
        // Data Picking
        $employee_id = $admin_data_update["employee_id"];
        $username = htmlspecialchars($admin_data_update["username"]);
        $password = htmlspecialchars($admin_data_update["password"]);
        $access = $admin_data_update["employee_access"];

        // $gambar_lama = htmlspecialchars($admin_data_update["admin_gambar_lama"]);
        // if($_FILES['gambar']['error'] === 4){
        //     $gambar = $gambar_lama;
        // }else{
        //     $gambar = upload();
        // }
        

        // Query Insert Data
        $query = "UPDATE admin_resto SET
                    employee_username = '$username',
                    employee_password = '$password',
                    employee_access = '$access',
                    WHERE employee_id = $employee_id
                    ";
        mysqli_query($db_connect, $query);
        return mysqli_affected_rows($db_connect);
    }

    function admin_search_proccess($admin_data_search){
        $query = "SELECT * FROM admin_resto 
        WHERE
        employee_id LIKE '%$admin_data_search%' OR
        employee_username LIKE '%$admin_data_search%' OR
        employee_access LIKE '%$admin_data_search%' 
        ";
        return query($query);
    }   
    function book_search_proccess($book_data_search){
        $query = "SELECT * FROM booking
        WHERE
        book_id LIKE '%$book_data_search%' OR
        book_nama LIKE '%$book_data_search%' OR
        book_phone LIKE '%$book_data_search%' OR
        book_jam LIKE '%$book_data_search%' OR
        book_kursi LIKE '%$book_data_search%' OR
        book_tanggal LIKE '%$book_data_search%' 
        ";
        return query($query);
    }   
?>