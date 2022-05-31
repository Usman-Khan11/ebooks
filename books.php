<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Books</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

</head>
<body>
<?php session_start(); include("includes/header.inc.php"); ?>

<section class="all_books_section">
        <div class="container my-5" data-aos="fade-up">

            <div class="heading mb-4">
                <h2>all Books</h2>
            </div>


            <div class="row">
            <?php
                function All_books()
                {
                    $search = "";
                    if (isset($_GET{"search"})) {
                        $search = $_GET["search"];
                    }
                    include("includes/db.inc.php");
                    $query = "";
                    if (!empty($search)) {
                        $query = "SELECT * FROM books WHERE b_name LIKE '%$search%'";
                    }
                    else{
                        $query = "SELECT * FROM books";
                    }
                    
                    $run = mysqli_query($con, $query);
                    if (mysqli_num_rows($run) > 0) {
                    
                    foreach ($run as $key) {
                ?>

                        <div class="col-lg-3 col-md-4 col-sm-6 col-6 ">
                            <div class="inner border">
                                <div class="">
                                    <img src="<?php echo $key['b_image']; ?>" height="200px" width="100%">
                                </div>
                                <div class="member-info p-2 mt-2">
                                    <?php
                                    $id = $key["cat_id"];
                                    $cat_query = "SELECT * FROM book_cat WHERE id='$id'";
                                    $cat_run = mysqli_query($con, $cat_query);
                                    foreach ($cat_run as $data) {
                                    ?>
                                        <small><?php echo $data['cat_name']; ?></small>
                                    <?php
                                    }
                                    ?>
                                    <br>
                                    <h5><a href="view_book.php?id=<?php echo $key['id']?>"><?php echo $key['b_name']; ?></a></h5>
                                    <p class="desc"><?php echo $key['b_description']; ?></p>
                                    <span><?php if ($key['type'] == 1) {
                                                echo "Free";
                                            } else {
                                                echo "Rs " . $key['b_prize'] . "/-";
                                            }
                                            ?></span>
                                    <br>
                                </div>

                                <?php if ($key['type'] == 1) {?>
                                    <button type="button" class="freecart_btn">Add To Cart</button>
                                <?php } else {?>
                                    <button type="button" class="addtocart_btn" data-att="<?php echo $key['id']; ?>">Add To Cart</button>
                                <?php }?>
                            </div>
                        </div>

                <?php }}
                else{
                    echo "<h3>No Result Found</h3>";
                }
                }
                All_books(); ?>


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