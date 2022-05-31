<?php
include("db.inc.php");
$i = $_POST["ids"];
$status = $_POST["val"];

if (!empty($id) || !empty($status)) {
    $query = "UPDATE orders SET status='$status' WHERE id='$i'";
    $run = mysqli_query($con,$query);
    header("location:../admin/Dashboard.php");
}
else{
    header("location:../index.php");
}

?>