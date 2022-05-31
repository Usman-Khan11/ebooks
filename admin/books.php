<?php
include("../includes/db.inc.php");

$query = "SELECT * FROM books";
$run = mysqli_query($con, $query);
$row = mysqli_num_rows($run);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Books</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

</head>

<body>
    <?php
    include("../includes/admin_navbar.php");
    ?>


    <div class="my_btn container">
        <button class="btn-5"><a href="add_books.php">Add New Books</a>
        </button>
    </div>


    <div class="my_table admin_all_menu_section">
        <table class="mx-auto mt-5 container">
            <thead>
                <tr>
                    <th scope="col">Menu Id</th>
                    <th scope="col">Menu Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Price</th>
                    <th scope="col">Type</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($row > 0) {
                    while ($data = mysqli_fetch_assoc($run)) {
                ?>
                        <tr>
                            <td data-label="Id" class="catId">
                                <?php echo $data["id"]; ?>
                            </td>
                            <td data-label="Menu Name">
                                <?php echo $data["b_name"]; ?>
                            </td>
                            <td data-label="Image">
                                <img src="../<?php echo $data["b_image"]; ?>" width="80px">
                            </td>
                            <td data-label="Price">
                                Rs <?php if ($data["type"] == 1) {
                                        echo "0";
                                    } else {
                                        echo $data["b_prize"];
                                    } ?>/-
                            </td>
                            <td data-label="Type">
                                <?php if ($data["type"] == 1) {
                                    echo "Free";
                                } else {
                                    echo "Paid";
                                } ?>
                            </td>
                            <td data-label="Action">

                                <i class="far fa-edit fa-lg text-success pointer book_edit" data-id="<?php echo $data["id"]; ?>" data-bs-toggle="modal" data-bs-target="#exampleModal"></i>
                                <i class="far fa-trash-alt fa-lg text-danger pointer book_delete" data-id="<?php echo $data["id"]; ?>"></i>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">EDIT BOOK</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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

        $(".book_delete").click(function() {
            var id = $(this).attr("data-id");

            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if(willDelete){
                        $.post("../includes/book_delete.inc.php", {
                        id: id
                    }, function(data) {
                        if (data == 0) {
                            alert("Failed");
                        } else {
                            $("body").html(data);
                        }
                    })
                    }
                });
        })

        $(".book_edit").click(function() {
            var id = $(this).attr("data-id");
            $.get("../includes/book_edit.inc.php", {
                id: id
            }, function(data) {
                if (data == 0) {
                    alert("Failed");
                } else {
                    $(".modal-body").html(data);
                }
            })
        })
    </script>
</body>

</html>




<?php


if (isset($_POST["btns"])) {
    $bname = $_POST["bname"];
    $bprice = $_POST["bprice"];
    $bdesc = $_POST["bdesc"];
    $b_cat = $_POST["cat_id"];
    $type = $_POST["type"];
    $date = $_POST["date"];
    $id = $_POST["id"];
    $oldimage = $_POST["old_image"];
    $oldpdf = $_POST["old_pdf"];

    $image = $_FILES["image"]["name"];
    $temp_image = $_FILES["image"]["tmp_name"];
    $image_type = $_FILES["image"]["type"];
    $folder = "../web_images/";
    $db_img = "web_images/";

    $pdf = $_FILES["pdf"]["name"];
    $temp_pdf = $_FILES["pdf"]["tmp_name"];
    $pdf_type = $_FILES["pdf"]["type"];
    $pdf_folder = "../pdf/";
    $db_pdf = "pdf/";

    if (!empty($image) || !empty($pdf)) {
        if (!empty($image)) {
            if (strtolower($image_type) == "image/jpg" || strtolower($image_type) == "image/png" || strtolower($image_type) == "image/jpeg") {
                $folder = "../web_images/" . $image;
                $db_img = "web_images/" . $image;
                move_uploaded_file($temp_image, $folder);
            } else {
                echo "<script>alert('image must be PNG,JPG,JPEG')</script>";
                die();
            }
        } else {
            $db_img = $oldimage;
        }

        if (!empty($pdf)) {
            if (strtolower($pdf_type) == "application/pdf") {
                $pdf_folder = "../pdf/" . $pdf;
                $db_pdf = "pdf/" . $pdf;

                move_uploaded_file($temp_pdf, $pdf_folder);
            } else {
                echo "<script>alert('file must be PDF')</script>";
                die();
            }
        } else {
            $db_pdf = $oldpdf;
        }


        $editquery = "UPDATE books SET b_name='$bname', b_prize='$bprice', b_description='$bdesc', cat_id='$b_cat', type='$type', date='$data', b_image='$db_img', b_pdf='$db_pdf' WHERE id='$id'";
        $editrun = mysqli_query($con, $editquery);
        if ($editrun) {
            echo "<script>window.location.href='Dashboard.php'</script>";
        }
    } else {
        $editquery = "UPDATE books SET b_name='$bname', b_prize='$bprice', b_description='$bdesc', cat_id='$b_cat', type='$type', date='$data', b_image='$oldimage', b_pdf='$oldpdf' WHERE id='$id'";
        $editrun = mysqli_query($con, $editquery);
        if ($editrun) {
            echo "<script>window.location.href='Dashboard.php'</script>";
        }
    }
}
?>