<?php
include("../includes/db.inc.php");

$query = "SELECT * FROM orders WHERE status NOT IN ('Delivered') AND status NOT IN ('PDF') ORDER BY id DESC";
$run = mysqli_query($con, $query);
$row = mysqli_num_rows($run);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

</head>

<body>
    <?php
    include("../includes/admin_navbar.php");
    ?>

    <div class="heading">
        <h2>New Orders</h2>
    </div>
    <div class="my_table ">

        <table class="mx-auto container">
            <thead>
                <tr>
                    <th scope="col">Order Id</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Total</th>
                    <th scope="col">Address</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if ($row > 0) {
                    while ($data = mysqli_fetch_assoc($run)) {
                        $book = $data["books_id"];
                        $user = $data["user_id"];
                        global $username;
                        $user_query = "SELECT * FROM users WHERE id='$user'";
                        $user_run = mysqli_query($con, $user_query);
                        if ($user_run) {
                            foreach ($user_run as $u) {
                                $username = $u["name"];
                            }
                        }
                ?>
                        <tr>
                            <td data-label="Id" class="catId">
                                <?php echo $data["id"] ?>
                            </td>
                            <td data-label="User Name">
                                <?php echo $username; ?>
                            </td>
                            <td data-label="Total">
                                Rs <?php echo $data["total"] ?>/-
                            </td>
                            <td data-label="Address">
                                <?php echo $data["address"] ?>
                            </td>
                            <td data-label="Action">

                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#O_<?php echo $data['id']; ?>">
                                    View
                                </button>
                            </td>


                        </tr>
                        <div class="modal fade" id="O_<?php echo $data['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row">
                                                <?php
                                                $sql = "SELECT * FROM books WHERE id='$book'";
                                                $r = mysqli_query($con, $sql);
                                                if ($r) {
                                                    foreach ($r as $key) {
                                                ?>
                                                        <div class="col-md-4">
                                                            <div>
                                                                <img src="../<?php echo $key["b_image"]; ?>" width="100%" height="100px">
                                                                <br>
                                                                <h6 class="my-2"><?php echo $key["b_name"]; ?></h6>
                                                                <p>Rs <?php echo $key["b_prize"] ?>/-</p>
                                                            </div>
                                                        </div>
                                                <?php }
                                                } ?>
                                            </div>
                                            <h6>Date: <?php echo $data["date"]; ?></h6>
                                            <h6>Time: <?php echo $data["time"]; ?></h6>
                                            <h6>Status: <?php echo $data["status"];?></h6>
                                            <h6>Delivery Charges: Rs <?php echo $delivery_charges; ?>/-</h6>
                                            <h6>Total Amount: Rs <?php echo $data["total"]; ?>/-</h6>
                                            <br>
                                            <p>Update Status:</p>
                                            <select class="update_status form-select" data-id="<?php echo $data['id']; ?>">
                                                <option selected disabled><?php echo $data['status'] ?></option>
                                                <option value="">Way to Delivery</option>
                                                <option value="">Delivered</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php }
                } ?>
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

        $(".update_status").change(function() {
            var v = $(this).find("option:selected").text();
            var id = $(this).attr("data-id");
            $.post("../includes/update_status.php", {
                val: v,
                ids: id
            }, function(d) {
                if (d) {
                    $("body").html(d)
                } else {
                    alert("fail")
                }
            })
        })
    </script>
</body>

</html>