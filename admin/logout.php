<?php
    session_start();
    $_SESSION = [];
    session_unset();
    session_destroy();

    setcookie('id_FinsResto', '', time()-3600);
    setcookie('kunci_FinsResto', '', time()-3600);
    
    header("Location: login.php");
    exit;
?>