<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "ebooks";

    $delivery_charges = 100;

    $con = mysqli_connect($host,$user,$pass,$db);
    if (!$con) {
        echo "connection failed";
    }
?>
