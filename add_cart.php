<?php
session_start();
include("includes/db.inc.php");
if (empty($_SESSION["id"])) {
    header("location:credentials/login.php");
}
//$userid = $_SESSION["id"];
$val = "";
if (!empty($_COOKIE["cart_items"])) {
    $val = $_COOKIE["cart_items"];
}
$query = "SELECT * FROM books Where id='$val'";
$run = mysqli_query($con, $query);
$check_rows = mysqli_num_rows($run);

global $total;
global $subtotal;
global $count;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <?php include("includes/header.inc.php"); ?>

    <section>
        <div class="container cart-page">
            <table>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>

                <?php
                if ($check_rows > 0) {
                    foreach ($run as $data) {
                        $subtotal = $data["b_prize"];
                        $count = 1;
                        $total = $data["b_prize"] + $delivery_charges;
                ?>
                        <tr>
                            <td>
                                <div class="cart-info">
                                    <img src="<?php echo $data["b_image"]; ?>" />
                                    <div>
                                        <p><?php echo $data["b_name"]; ?></p>
                                        <small><?php echo "Rs " . $data["b_prize"] . "/-"; ?></small>
                                        <br />
                                        <a class="remove" data-id="<?php echo $data["id"]; ?>">Remove</a>
                                    </div>
                                </div>
                            </td>
                            <td><span class="p-2 bg-light px-4"><?php echo 1 ?></span></td>
                            <td><?php echo "Rs " . $data["b_prize"]; ?></td>
                        </tr>
                    <?php } ?>

            </table>
            <br /><br />


            <div class="total-price">
                <table>
                    <tr>
                        <td>Subtotal</td>
                        <td><?php echo "Rs " . $subtotal . "/-"; ?></td>
                    </tr>
                    <tr>
                        <td>Shipping Charges</td>
                        <td><?php echo "Rs " . $count * $delivery_charges . "/-"; ?></td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td><?php echo "Rs " . $total . "/-"; ?></td>
                    </tr>
                </table>

            </div>
        </div>
        <div class="d-grid gap-2 container">
            <button type="button" class="btn_checkout" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Checkout
            </button>
        </div>
    <?php } else {
    ?>
        <tr>
            <td>No Items Here!</td>
        </tr>
    <?php } ?>


    </section>



    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Customer Name: <?php echo $_SESSION["username"]; ?></h6>
                    <h6>Book Name: <?php echo $data["b_name"] ?></h6>
                    <h6>Delivery Charges: Rs <?php echo $delivery_charges ?>/-</h6>
                    <h6>Total Amount: Rs <?php echo $total ?>/-</h6>
                    <div>
                        <input type="text" class="form-control" placeholder="Your Address" id="address">
                        <select id="order_method" class="form-select my-2">
                            <option value="" selected disabled>Choose Order Options</option>
                            <?php
                             if ($data["type"]==1) {
                                 echo '<option value="Book">Buy Book Deliver at Your Door Step</option>';
                             }else{
                            ?>
                            <!-- <option value="PDF">Buy Online PDF</option> -->
                            <option value="Book">Buy Book Deliver at Your Door Step</option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="order" class="btn btn-primary">Order</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js" integrity="sha512-3j3VU6WC5rPQB4Ld1jnLV7Kd5xr+cq9avvhwqzbH/taCRNURoeEpoPBK9pDyeukwSxwRPJ8fDgvYXd6SkaZ2TA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

    <script>
        $(".remove").click(function() {
            $.cookie("cart_items", "", {
                expires: -365
            }, {
                path: '/'
            });
            window.location.reload();
        })

        $("#order").click(() => {
            var address = $("#address").val();
            var amount = <?php echo $total; ?>;
            var method = $("#order_method").find("option:selected").val();
            if (address != "" && method != "") {
                
                $.post("includes/checkout.inc.php", {
                    add: address,
                    total: amount,
                    m: method
                }, function(data) {
                    if (data == 1) {
                        $.cookie("cart_items", "", {
                            expires: -365
                        }, {
                            path: '/'
                        });
                        window.location.replace("index.php");
                    }
                })
            } else {
                swal("Something Went Wrong!")
            }
        })
    </script>

</body>

</html>