<?php
include("../includes/db.inc.php");

$query = "SELECT * FROM enroll";
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
        <title>All Competetion</title>
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    </head>

    <body>
        <?php
        include("../includes/admin_navbar.php");
        ?>


        <div class="my_table admin_all_menu_section">
            <table class="mx-auto mt-5 container">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Competetion Name</th>
                        <th scope="col">File</th>
                        <th scope="col">Winning Price</th>
                        <th scope="col">Action</th>
                     </tr>
                </thead>
                <tbody>
                    <?php
                    while ($data = mysqli_fetch_assoc($run)) {
                        $uid = $data["user_id"];
                        $userquery = "SELECT * FROM users WHERE id='$uid' ";
                        $userrun = mysqli_query($con,$userquery);
                        while ($key=mysqli_fetch_assoc($userrun)) {
                           $comid = $data["com_id"];
                            $comquery = "SELECT * FROM quiz WHERE id='$comid' ";
                            $comrun = mysqli_query($con,$comquery);
                            while ($com=mysqli_fetch_assoc($comrun)) {
                           ?>
                        <tr>
                            <td data-label="Id" class="catId">
                                <?php echo $data["id"] ?>
                            </td>
                            <td data-label="User Name" class="catId">
                                <?php echo $key["name"] ?>
                            </td>
                            <td data-label="Competetion Name" class="catId">
                                <?php echo $com["com_name"] ?>
                            </td>
                            <td data-label="File">
                            <strong><a href="../<?php echo $data["pdf"]; ?>" target="_blank">View in PDF</a></strong>
                            </td>
                            <td data-label="Winning price">Rs
                            <?php echo $com["com_price"]; ?>/-
                            </td>
                            <td data-label="Action"><button type="button" class="win_btn btn btn-success" data-id="<?php echo $data["id"];?>">Win</button></td>
                        </tr>
                <?php
                    }}}
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

            $(".win_btn").click(function() {
                var id = $(this).attr("data-id");
                $.post("../includes/win_update.inc.php",{id:id},function(data) {
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