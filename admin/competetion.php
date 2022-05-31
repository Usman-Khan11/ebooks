<?php
include("../includes/db.inc.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Competetion</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

</head>

<body>
    <?php include("../includes/admin_navbar.php"); ?>


    <section>
        <div class="login shadow border">
            <div class="login-triangle"></div>

            <h2 class="login-header">Start a Competetion</h2>

            <form class="login-container" action="" method="post">
                <input type="text" name="com_name" required placeholder="Competetion Name" />
                <textarea name="desc" class="form-control" placeholder="Description"></textarea>
                <input type="number" name="com_price" required placeholder="Price" />
                <br>
                <input type="submit" name="com_btn" />
            </form>
        </div>
    </section>








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

        $(".book_delete").click(function() {
            var id = $(this).attr("data-id");
            $.post("../includes/book_delete.inc.php", {
                id: id
            }, function(data) {
                if (data == 0) {
                    alert("Failed");
                } else {
                    $("body").html(data);
                }
            })
        })
    </script>

</body>

</html>

<?php
if (isset($_POST["com_btn"])) {
  $name = $_POST["com_name"];
  $price = $_POST["com_price"];
  $desc = $_POST["desc"];

  $query = "INSERT INTO quiz (com_name,com_description,com_price,status) VALUES ('$name','$desc','$price',1)";
  $run = mysqli_query($con, $query);
  //$rows = mysqli_num_rows($run);
  if ($run) {
    header("location:Dashboard.php");
  } else {
    echo "Failed";
  }
}
?>
