<?php
    session_start();

    if(!isset($_SESSION["login_FinsResto"])){
        header("Location: login.php");
    }

    require'functions.php';

    $admin_data = $_GET["employee_id"];

    if( admin_delete_proccess($admin_data) > 0){
        
        // Delete Report (Success/Failed)
        echo "<script>
                 alert('Data Berhasil Dihapus');
                 document.location.href = 'index.php';
             </script>";
    }else{
        echo "<script>
                 alert('Data Gagal Dihapus');
                 document.location.href = 'index.php';
             </script>";
    }
    
?>