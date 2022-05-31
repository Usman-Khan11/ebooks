

<?php
session_start();
include("db.inc.php");
$address = $_POST["add"];
$amount = $_POST["total"];
$method = $_POST["m"];
$book_id = $_COOKIE["cart_items"];
$id = $_SESSION["id"];
date_default_timezone_set('Asia/Karachi');
$date = date("Y/m/d");
$time = date("h:i:s a");
$status = "";

if (!empty($address) || !empty($amount)) {
    if ($method == "PDF") {
        $status = "PDF";
    }
    else{
        $status = "Processing";
    }
    $query = "INSERT INTO orders (user_id,books_id,time,date,status,total,address,order_condition) VALUES ('$id','$book_id','$time','$date','$status','$amount','$address','$method')";
    $run = mysqli_query($con,$query);
    echo 1;
}
else{
    header("location:../index.php");
}

?>