<?php
include("db.inc.php");
session_start();
$plan = $_POST["name"];
$price = $_POST["price"];
$user_id = $_SESSION["id"];
$date = date("Y/m/d");

$chk_query = "SELECT * FROM membership WHERE user_id='$user_id'";
$chk_run = mysqli_query($con,$chk_query);
if (mysqli_num_rows($chk_run) > 0) {
    echo 2;
    die();
}
else{
    if (!empty($plan) || !empty($user_id)) {
        $query = "INSERT INTO membership (user_id,duration,date,price) VALUES ('$user_id','$plan','$date','$price')";
        $run = mysqli_query($con,$query) or die();
        echo 1;
    }
    else{
        echo 0;
    }
}




   

?>