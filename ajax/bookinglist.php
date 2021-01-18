<?php
    
    require '../functions.php';

    $keyword = $_GET["keyword"];
    $query = "SELECT * FROM booking 
                WHERE 
                book_phone LIKE '%$keyword%' 
                ";
                
    $mhs_search = query($query);
?>