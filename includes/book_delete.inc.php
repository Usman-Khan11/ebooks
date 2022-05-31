<?php
include("db.inc.php");
global $id;
$id = $_POST["id"];

if (!empty($id)) {
    $query = "SELECT * FROM books WHERE id='$id'";
    $run = mysqli_query($con,$query) or die();
    if (mysqli_num_rows($run) > 0) {
        foreach ($run as $key) {
            unlink("../".$key["b_image"]);
            unlink("../".$key["b_pdf"]);
        }
    }
    $delquery = "DELETE FROM books WHERE id='$id'";
    $delrun = mysqli_query($con,$delquery) or die();
    
    header("location:../admin/books.php");
}
else{
    echo 0;
}


   

?>