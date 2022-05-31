<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Books</title>
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

</head>

<body>
    <?php
    include("../includes/admin_navbar.php");
    ?>

    <div class="login shadow border">
        <div class="login-triangle"></div>

        <h2 class="login-header">Add Books</h2>

        <form class="login-container" action="" method="post" enctype="multipart/form-data">
            <input type="text" name="b_name" required placeholder="Books" />
            <input type="number" name="b_price" required placeholder="Book Price" />
            <input type="text" name="b_desc" required placeholder="Book Description" />
            <select name="category" class="form-select" id="">
                <option>
                    Select Books Category
                </option>
                <?php

                function category()
                {
                    include("../includes/db.inc.php");
                    $cat = "SELECT * FROM book_cat";
                    $run = mysqli_query($con, $cat);
                    $rows = mysqli_num_rows($run);
                    if ($rows > 0) {
                        while ($data = mysqli_fetch_assoc($run)) {
                            echo "<option value='{$data["id"]}'>{$data["cat_name"]}</option>";
                        }
                    }
                }
                category();

                ?>
            </select>

            <br>
            <select name="type" class="form-select">
                <option value="1">
                    free
                </option>
                <option value="2">
                    paid
                </option>
            </select>

            <label class="form-label mt-3 px-1">Book Image</label>
            <input type="file" name="b_image" required />

            <label class="form-label mt-3 px-1">Book PDF</label>
            <input type="file" name="b_pdf" required />


            <input type="submit" value="Add Books" name="books_btn" />
        </form>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../s/bootstrap.bundle.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>

    <script>
        $("#sidebar_toggle").click(function() {
            $(".admin_sidebar").toggleClass("show");
            $(this).toggleClass("fa-times")
        })

        $(".fa-ellipsis-v").click(function() {

            $(".small_menu").slideToggle()
        })
    </script>

</body>

</html>

<?php
include("../includes/db.inc.php");


if (isset($_POST["books_btn"])) {
    $name = $_POST["b_name"];
    $price = $_POST["b_price"];
    $desc = $_POST["b_desc"];
    $b_cat = $_POST["category"];
    $type = $_POST["type"];

    $image = $_FILES["b_image"]["name"];
    $temp_image = $_FILES["b_image"]["tmp_name"];
    $image_type = $_FILES["b_image"]["type"];
    $folder = "../web_images/";
    $db_img = "web_images/";

    if (strtolower($image_type) == "image/jpg" || strtolower($image_type) == "image/png" || strtolower($image_type) == "image/jpeg") {
        $folder = "../web_images/" . $image;
        $db_img = "web_images/" . $image;
        move_uploaded_file($temp_image, $folder);
    } else {
        echo "<script>alert('image must be PNG,JPG,JPEG')</script>";
        die();
    }

    $pdf = $_FILES["b_pdf"]["name"];
    $temp_pdf = $_FILES["b_pdf"]["tmp_name"];
    $pdf_type = $_FILES["b_pdf"]["type"];
    $pdf_folder = "../pdf/";
    $db_pdf = "pdf/";


    if (strtolower($pdf_type) == "application/pdf") {
        $pdf_folder = "../pdf/" . $pdf;
        $db_pdf = "pdf/" . $pdf;

        move_uploaded_file($temp_pdf, $pdf_folder);
    } else {
        echo "<script>alert('file must be PDF')</script>";
        die();
    }

    $date = date("Y-m-d");
    $query = "INSERT INTO books(b_name,b_prize,b_description,b_image,b_pdf,cat_id,date,type) VALUES ('$name','$price','$desc','$db_img','$db_pdf','$b_cat','$date','$type')";
    $run = mysqli_query($con, $query);
    if ($run) {
        echo "<script>window.location.href='Dashboard.php'</script>";
    }
}
?>