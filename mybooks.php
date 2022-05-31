<?php
session_start();
if (empty($_SESSION["id"])) {
    header("location:credentials/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Books</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

</head>

<style>
    .cart-row {
        padding: 15px 0;
    }

    .cart-row:nth-child(even) {
        background: #efefef;
    }

    .product-name {
        font-size: 16px;
        font-weight: 600;
    }

    .product-options {
        font-size: 12px;
        margin-bottom: 5px;
    }

    .product-options span {
        color: #666;
        font-weight: 400;
        text-transform: uppercase;
    }

    .product-articlenr {
        color: #666;
        font-weight: 400;
        text-transform: uppercase;
    }

    .product-price small {
        color: #666;
        font-weight: 300;
        font-size: 20px;
        margin: 0;
        padding: 0;
        line-height: initial;
    }

    .cart-table .cart-row input {
        width: 30px;
        height: auto;
        padding: 2px;
        border-radius: 0;
        border-color: #000;
        float: left;
        font-size: 14px;
        text-align: center;
    }

    .cart-table .cart-row button.update {
        border: 0;
        padding: 7px 8px;
        background: #000;
        color: #fff;
        font-size: 9px;
        float: left;
        margin-right: 5px;
    }

    .cart-table .cart-row button.delete {
        background-color: #ffb2b2;
        color: #000 !important;
        padding: 7px 13px;
        font-size: 13px;
        border: 0;
        border-radius: 50px;
    }

    .product-price-total {
        font-size: 16px;
        font-weight: 400;
        width: 80%;
        float: left;
    }

    .cart-actions {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .cart-special-holder {
        background: #efefef;
    }

    .cart-special {
        padding: 1em 1em 0;
        display: block;
        margin-top: 0.5em;
        border-top: 1px solid #dadada;
    }

    .cart-special .cart-special-content:before {
        content: "\21b3";
        font-size: 1.5em;
        margin-right: 1em;
        color: #6f6f6f;
        font-family: helvetica, arial, sans-serif;
    }

    .nav-link{
        color: black;
        background-color: #ededed !important;
        margin: 5px;
        font-weight: bold;
    }
    .nav-link.active{
        color: white !important;
        background-color: #1DBB90 !important;
    }
    .nav-item{
        margin: 0 auto;
    }

    .pdf a{
        color: #1DBB90 !important;
        text-decoration: none;
        font-weight: 600;
    }
</style>

<body>

    <?php include("includes/header.inc.php");?>


    <ul class="nav nav-tabs " id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">New Order</a>
        </li>
        <!-- <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Online Book</a>
        </li> -->
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Delivered</a>
        </li>
    </ul>


    <div class="tab-content" id="myTabContent">
        <!-- NEW ORDER -->
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="container">
                <div class="cart-table">
                    <?php
                    function new_order()
                    {
                        include("includes/db.inc.php");
                        $userid = $_SESSION["id"];
                        $sql = "SELECT * FROM orders WHERE user_id='$userid' AND status NOT IN ('delivered') AND status NOT IN ('PDF')";
                        $run = mysqli_query($con, $sql);
                        if (mysqli_num_rows($run) > 0) {
                            foreach ($run as $data) { 
                            $book_id = $data["books_id"];
                            $book_query = "SELECT * FROM books WHERE id='$book_id'";
                            $book_run = mysqli_query($con, $book_query);
                            if (mysqli_num_rows($book_run) > 0) {
                                foreach ($book_run as $key) {
                                ?>

                                <div class="row cart-row">
                                    <div class="col-xs-12 col-md-2">
                                        <img src="<?php echo $key["b_image"];?>" width="100px" height="120px">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="product-articlenr">Order Id: #<?php echo $data["id"];?></div>
                                        <div class="product-name"><?php echo $key["b_name"];?></div>
                                        <div class="product-options"><span>Status:</span> <?php echo $data["status"];?><br><span>Date:</span> <?php echo $data["date"];?><br><span>Time:</span> <?php echo $data["time"];?></div>
                                        <div class="product-price">
                                           
                                            <div class="product-price">Rs <?php echo $key["b_prize"];?>/-</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 cart-actions">
                                        <div class="product-price-total">Rs <?php echo $data["total"];?>/-</div>
                                        <div class="product-delete">
                                            <button type="button" data-toggle="tooltip" title="Ta bort" class="delete" onclick="cart.remove('5');"><i class="fas fa-times-circle"></i></button>
                                        </div>
                                    </div>
                                </div><!-- cart-row-->

                    <?php }
                        }
                    }
                }
            }
                    new_order(); ?>
                </div>

            </div>
        </div>
        <!-- NEW ORDER -->

        <!-- ONLINE BOOK  -->
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        </div>

        <!-- ONLINE BOOK  -->

        <!-- DELIVERED -->
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
        <div class="container">
                <div class="cart-table">
                    <?php
                    function order()
                    {
                        include("includes/db.inc.php");
                        $userid = $_SESSION["id"];
                        $sql = "SELECT * FROM orders WHERE user_id='$userid' AND status='delivered'";
                        $run = mysqli_query($con, $sql);
                        if (mysqli_num_rows($run) > 0) {
                            foreach ($run as $data) { 
                            $book_id = $data["books_id"];
                            $book_query = "SELECT * FROM books WHERE id='$book_id'";
                            $book_run = mysqli_query($con, $book_query);
                            if (mysqli_num_rows($book_run) > 0) {
                                foreach ($book_run as $key) {
                                ?>

                                <div class="row cart-row">
                                    <div class="col-xs-12 col-md-2">
                                        <img src="<?php echo $key["b_image"];?>" width="100px" height="120px">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="product-articlenr">Order Id: #<?php echo $data["id"];?></div>
                                        <div class="product-name"><?php echo $key["b_name"];?></div>
                                        <div class="product-options"><span>Status:</span> <?php echo $data["status"];?><br><span>Date:</span> <?php echo $data["date"];?><br><span>Time:</span> <?php echo $data["time"];?></div>
                                        <div class="product-price">
                                           
                                            <div class="product-price">Rs <?php echo $key["b_prize"];?>/-</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 cart-actions">
                                        <div class="product-price-total">Rs <?php echo $data["total"];?>/-</div>
                                        <div class="product-delete">
                                            <button type="button" data-toggle="tooltip" title="Ta bort" class="delete" onclick="cart.remove('5');"><i class="fas fa-times-circle"></i></button>
                                        </div>
                                    </div>
                                </div><!-- cart-row-->

                    <?php }
                        }
                    }
                }
            }
                    order(); ?>
                </div>

            </div>
        </div>
        <!-- DELIVERED -->
    </div>





    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js" integrity="sha512-3j3VU6WC5rPQB4Ld1jnLV7Kd5xr+cq9avvhwqzbH/taCRNURoeEpoPBK9pDyeukwSxwRPJ8fDgvYXd6SkaZ2TA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

    <script>

    </script>
</body>

</html>