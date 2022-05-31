<?php
include("db.inc.php");
$i = $_POST["id"];

if (!empty($i)) {
    $query = "UPDATE enroll SET win=1 WHERE id='$i'";
    $run = mysqli_query($con,$query);
    header("location:../admin/competetion_listing.php");
}
else{
    echo 0;
}

?>