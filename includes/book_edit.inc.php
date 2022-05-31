<?php
include("db.inc.php");
$id = $_GET["id"];

if (!empty($id)) {
    $query = "SELECT * FROM books WHERE id='$id'";
    $run = mysqli_query($con,$query) or die();
    $output = "";
    if (mysqli_num_rows($run) > 0) {
        while ($a = mysqli_fetch_assoc($run)) {
            $output .= "<form action='../admin/books.php' method='post' enctype='multipart/form-data'>
            <img src='../{$a['b_image']}' width='100px'> <br>
            <strong><a href='../{$a['b_pdf']}' target='_blank'>View in PDF</a></strong>
            <input type='text' value='{$a['b_name']}' name='bname' class='form-control my-4' >
            <input type='number' value='{$a['b_prize']}' name='bprice' class='form-control my-4' >
            <textarea value='{$a['b_description']}' name='bdesc' class='form-control my-4' >{$a['b_description']}</textarea>
            <label class='form-label'>Add New Image</label>
            <input type='file' name='image' class='form-control mb-4'>
            <label class='form-label'>Add New PDF</label>
            <input type='file' name='pdf' class='form-control mb-4'>
            <input type='hidden' name='id' value='{$a['id']}'>
            <input type='hidden' name='old_image' value='{$a['b_image']}'>
            <input type='hidden' name='old_pdf' value='{$a['b_pdf']}'>
            <input type='hidden' name='date' value='{$a['date']}'>
            <input type='hidden' name='type' value='{$a['type']}'>
            <input type='hidden' name='cat_id' value='{$a['cat_id']}'>
            <input type='submit' name='btns' class='form-control mb-4'>
            </form>";
        }
    }
    echo $output;
}
else{
    echo 0;
}
?>