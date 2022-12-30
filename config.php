<?php
    $server = "127.0.0.1";
    $user = "root";
    $pass = "";
    $database = "sayours_db";
    $db = mysqli_connect($server,$user,$pass,$database);

    if( !$db ){
        die("Gagal terhubung dengan database: " . mysqli_connect_error());
    }

?>