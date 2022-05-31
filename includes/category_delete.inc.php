<?php
include("db.inc.php");
$id = $_POST["id"];

if (!empty($id)) {
    $query = "DELETE FROM book_cat WHERE id='$id'";
    $run = mysqli_query($con,$query) or die();
    header("location:../admin/book_category.php");
}
else{
    echo 0;
}
?>