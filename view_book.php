<?php
session_start();
include("includes/db.inc.php");
$id = $_GET["id"];
$user_id = $_SESSION["id"];
$query = "SELECT * FROM books WHERE id='$id'";
if (empty($id)) {
    header("location: index.php");
}
$run = mysqli_query($con, $query);
$row = mysqli_num_rows($run);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>
    <?php include("includes/header.inc.php"); ?>
    <section class="my-5 ad_detail_sec">
        <div class="container">
            <div class="row">
                <?php
                if ($row > 0) {
                    foreach ($run as $key) { ?>
                        <div class="col-md-8">
                            <div>
                                <h4 class="fw-bold"><?php echo $key["b_name"]; ?></h4>
                                <br>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <i class=" fas fa-clock text-success"></i>
                                        <small class="text-muted"><?php echo $key["date"]; ?></small>
                                    </div>

                                </div>

                                <div class="my-4">
                                    <img src="<?php echo $key["b_image"]; ?>" class="img_main" width="100%" height="400px">

                                </div>
                                <br>
                                <div class="mx-2 p-4 shadow">
                                    <h5 class="fw-bold">DESCRIPTION</h5>
                                    <?php
                                    $plan_query = "SELECT * FROM membership WHERE user_id='$user_id'";
                                    $plan_run = mysqli_query($con, $plan_query);
                                    if (mysqli_num_rows($plan_run) > 0 && $key["type"] == 2) {
                                        while ($a = mysqli_fetch_assoc($plan_run)) { ?>
                                            <div class="my-3">
                                                <div class="">
                                                    <strong><a href="<?php echo $key["b_pdf"]; ?>" target="_blank">View in PDF</a></strong>
                                                </div>
                                                <div class="my-3">
                                                    <strong><a href="<?php echo $key["b_pdf"]; ?>" download="">PDF Download</a></strong>
                                                </div>
                                            </div>
                                        <?php    }
                                    }
                                    else if ($key["type"] == 1) { ?>
                                        <div class="my-3">
                                            <div class="">
                                                <strong><a href="<?php echo $key["b_pdf"]; ?>" target="_blank">View in PDF</a></strong>
                                            </div>
                                            <div class="my-3">
                                                <strong><a href="<?php echo $key["b_pdf"]; ?>" download="">PDF Download</a></strong>
                                            </div>
                                        </div>
                                    <?php } else {
                                        echo "<strong>Note: </strong><small>You have to Buy a Membership to view online! </small>";
                                    } ?>

                                    <div class="my-3">
                                        <div class="">
                                            <strong>Category:</strong>
                                            <small class="">Mobile</small>
                                        </div>
                                    </div>

                                    <p><strong>About Book:</strong>
                                        <?php echo $key["b_description"]; ?>
                                    </p>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-4 mt-5">
                            <div class="price my-4">
                                <h6>Rs <?php echo $key["b_prize"]; ?>/-</h6>
                                <i class="fas fa-money-bill fa-2x"></i>
                            </div>

                            <div class="phon my-4">

                                <?php if ($key['type'] == 1) { ?>
                                    <button type="button" class="freecart_btn">Add To Cart</button>
                                <?php } else { ?>
                                    <button type="button" class="addtocart_btn" data-att="<?php echo $key['id']; ?>">Add To Cart</button>
                                <?php } ?>
                            </div>


                        </div>
                <?php }
                } ?>
            </div>
        </div>
    </section>


    <?php include("includes/footer.inc.php"); ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js" integrity="sha512-3j3VU6WC5rPQB4Ld1jnLV7Kd5xr+cq9avvhwqzbH/taCRNURoeEpoPBK9pDyeukwSxwRPJ8fDgvYXd6SkaZ2TA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>