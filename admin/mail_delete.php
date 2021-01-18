<?php
    session_start();

    if(!isset($_SESSION["login_FinsResto"])){
        header("Location: login.php");
    }

    require'functions.php';

    $admin_data = $_GET["mail_id"];

    if( mail_delete_proccess($admin_data) > 0){
        
        // Delete Report (Success/Failed)
        echo "<script>
                 alert('Pesan Berhasil Diunsend');
                 document.location.href = 'contact.php';
             </script>";
    }else{
        echo "<script>
                 alert('Pesan tidak dapat dihapus');
                 document.location.href = 'contact.php';
             </script>";
    }
    
?>