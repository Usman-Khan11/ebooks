<?php
include("../includes/db.inc.php");
?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/admin.css">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />


<link rel="stylesheet" href="../css/form.css">

<?php
include("../includes/admin_navbar.php");
?>

<body>
  <div class="login shadow border">
    <div class="login-triangle"></div>

    <h2 class="login-header">Books Category</h2>

    <form class="login-container" action="" method="post">
      <input type="text" name="cat_name" required placeholder="Book-Category" />
      <br>
      <input type="submit" name="cat_btn" />
    </form>
  </div>
</body>

<?php
if (isset($_POST["cat_btn"])) {
  $name = $_POST["cat_name"];

  $query = "INSERT INTO book_cat (cat_name) VALUES ('$name')";
  $run = mysqli_query($con, $query);
  //$rows = mysqli_num_rows($run);
  if ($run) {
    header("location:Dashboard.php");
  } else {
    echo "SIgnup Failed";
  }
}
?>


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