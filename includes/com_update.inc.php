<?php
include("db.inc.php");
$i = $_POST["id"];

if (!empty($i)) {
    $query = "UPDATE quiz SET status=0 WHERE id='$i'";
    $run = mysqli_query($con,$query);
    header("location:../admin/all_competetion.php");
}
else{
    echo 0;
}

?>