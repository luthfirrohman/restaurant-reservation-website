<?php
    // Connect Database
    $db_connect = mysqli_connect("localhost", "root", "", 
    "db_restoran");


    function query($query){
        global $db_connect;
        $db_result = mysqli_query($db_connect, $query);
        $rows = [];
        while($row = mysqli_fetch_assoc($db_result)){
            $rows[] = $row;
        }
        return $rows;
    }

    function book_input_proccess($book_data_input){
        global $db_connect;
        // Data Picking
        $nama = htmlspecialchars($book_data_input["nama"]);
        $alamat = htmlspecialchars($book_data_input["alamat"]);
        $phone = htmlspecialchars($book_data_input["phone"]);
        $tanggal = htmlspecialchars($book_data_input["tanggal"]);
        $jam = htmlspecialchars($book_data_input["jam"]);
        $kursi = htmlspecialchars($book_data_input["kursi"]);
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

    function upload(){
        $mhs_upload_image_name = $_FILES['gambar']['name'];
        $mhs_upload_image_size = $_FILES['gambar']['size'];
        $mhs_upload_image_error = $_FILES['gambar']['error'];
        $mhs_upload_image_tmp = $_FILES['gambar']['tmp_name'];

        // Image Uploading Crosscheck
        if($mhs_upload_image_error === 4){
            echo"
            <script>
                alert('Gambar kosong');
            </script>";
            return false;
        }

        // Image Uploading Crosscheck --> Extension Files
        $mhs_upload_image_valid = ['jpg','jpeg','png'];

        $mhs_upload_image_ext = explode('.',$mhs_upload_image_name);

        $mhs_upload_image_ext = strtolower(end($mhs_upload_image_ext));


        if(!in_array($mhs_upload_image_ext, $mhs_upload_image_valid)){
            echo
            "<script>
                alert('File tidak termasuk gambar');
            </script>";
            return false;
        }

        // Imgae_size must be 1MB or lower
        if($mhs_upload_image_size > 1000000){
            echo"
            <script>
                alert('Ukuran gambar lebih dari 1MB');
            </script>";
            return false;
        }

        // Uploading Image
        // Make a new Image_name to make each files different
        $mhs_upload_image_name_new = uniqid();
        $mhs_upload_image_name_new .= '.';
        $mhs_upload_image_name_new .= $mhs_upload_image_ext;

        move_uploaded_file($mhs_upload_image_tmp, 'images/' . $mhs_upload_image_name_new);

        return $mhs_upload_image_name_new;

       }
    


    function mail_input_proccess($mail_data_input){
        global $db_connect;
        // Data Picking
        
        $name = htmlspecialchars($mail_data_input["name"]);
        $email = htmlspecialchars($mail_data_input["email"]);
        $phone = htmlspecialchars($mail_data_input["phone"]);
        $category = htmlspecialchars($mail_data_input["category"]);
        $message = htmlspecialchars($mail_data_input["message"]);

        // Query Insert Data
        $query = "INSERT INTO datamail VALUES
                    ('','$name','$email','$phone','$category', '$message')";
        mysqli_query($db_connect, $query);
        return mysqli_affected_rows($db_connect);
    }

    
    function book_delete_proccess($book_data_delete){
        global $db_connect;

        // Data Picking
        $book_id = $book_data_delete["book_id"];
        mysqli_query($db_connect, "DELETE FROM booking
        WHERE book_id = $book_id");
        return mysqli_affected_rows($db_connect);
    }

    function book_update_proccess($book_data_update){
        global $db_connect;

        // Data Picking
        $book_id = $book_data_update["book_id"];
        $nama = htmlspecialchars($book_data_update["nama"]);
        $alamat = htmlspecialchars($book_data_update["alamat"]);
        $phone = htmlspecialchars($book_data_update["phone"]);
        $tanggal = htmlspecialchars($book_data_update["tanggal"]);
        $jam = htmlspecialchars($book_data_update["jam"]);
        $kursi = htmlspecialchars($book_data_update["kursi"]);
        $timestamp = $book_data_update["book_timestamp"];
        $new_timestamp =  date('d-m-Y H:i:s');

        // $gambar_lama = htmlspecialchars($book_data_update["mhs_gambar_lama"]);
        // if($_FILES['gambar']['error'] === 4){
        //     $gambar = $gambar_lama;
        // }else{
        //     $gambar = upload();
        // }
        

        // Query Insert Data
        $query = "UPDATE booking SET
                    book_id = '$book_id',
                    book_nama = '$nama',
                    book_alamat = '$alamat',
                    book_phone = '$phone',
                    book_tanggal = '$tanggal',
                    book_jam = '$jam',
                    book_kursi = '$kursi',
                    book_timestamp = '$new_timestamp'
                    WHERE book_id = '$book_id'
                    ";
        mysqli_query($db_connect, $query);
        return mysqli_affected_rows($db_connect);
    }

    function book_search_proccess($book_data_search){
        $query = "SELECT * FROM booking 
        WHERE
        book_nama LIKE '%$book_data_search%' OR
        book_phone LIKE '%$book_data_search%' OR
        book_kursi LIKE '%$book_data_search%' 
        ";
        return query($query);
    }

    function registrasi($data_registrasi){
        global $db_connect;

        $username = strtolower(stripslashes($data_registrasi["username"]));
        $password = mysqli_real_escape_string($db_connect, $data_registrasi["password"]);
        $repassword = mysqli_real_escape_string($db_connect, $data_registrasi["repassword"]);

        // Username unique checking
        $db_result_username = 
        mysqli_query($db_connect, "SELECT user_username FROM user WHERE user_username = '$username'");
        
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
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Database
        mysqli_query($db_connect, "INSERT INTO user 
        VALUES('', '$username', '$password')");
        return mysqli_affected_rows($db_connect);
    }
?>