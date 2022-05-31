<?php
include("../includes/db.inc.php");

$query = "SELECT * FROM book_cat";
$run = mysqli_query($con, $query);
$row = mysqli_num_rows($run);
if ($row > 0) {


?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Book Category</title>
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    </head>

    <body>
        <?php
        include("../includes/admin_navbar.php");
        ?>

        <div class="my_btn container">
            <button class="btn-5">
            <a href="add_books_Category.php">Add Book Category</a>
            </button>
        </div>

        <div class="my_table admin_all_menu_section">
            <table class="mx-auto mt-5 container">
                <thead>
                    <tr>
                        <th scope="col">Category Id</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Action</th>
                     </tr>
                </thead>
                <tbody>
                    <?php
                    while ($data = mysqli_fetch_assoc($run)) {
                    ?>
                        <tr>
                            <td data-label="Category Id" class="catId">
                                <?php echo $data["id"] ?>
                            </td>
                            <td data-label="Category Name">
                                <?php echo $data["cat_name"] ?>
                            </td>
                            <td data-label="Action">
                            <i class="far fa-trash-alt fa-lg text-danger pointer cat_delete" data-id="<?php echo $data["id"] ?>"></i>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
                </tbody>
            </table>
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

            $(".cat_delete").click(function() {
                var id = $(this).attr("data-id");
                $.post("../includes/category_delete.inc.php",{id:id},function(data) {
                    if (data == 0) {
                        alert("Failed");
                    }
                    else{
                        $("body").html(data);
                    }
                })
            })
        </script>
    </body>

    </html>