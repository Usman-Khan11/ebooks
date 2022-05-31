<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Books</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <?php include("includes/header.inc.php"); ?>


    <section class="banner_section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="">
                        <h1>Free E-Books Websites</h1>
                        <br>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Et quasi enim eos inventore ex quisquam asperiores. Illum, est obcaecati provident, sed molestiae laboriosam iusto sapiente ea tenetur aperiam eius voluptatibus.
                        </p>
                        <br>
                        <a href="membership.php">Buy a Membership</a>
                    </div>
                </div>
                <div class="col-md-6 bg-white">
                    <img src="images/banner.png" width="100%">
                </div>
            </div>
        </div>
    </section>




    <section class="all_books_section">
        <div class="container mb-5" data-aos="fade-up">

            <div class="heading mb-4">
                <h2>free Books</h2>
            </div>


            <div class="row">
                <?php
                function free_books()
                {
                    include("includes/db.inc.php");
                    $query = "SELECT * FROM books WHERE type=1 LIMIT 8";
                    $run = mysqli_query($con, $query);
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
                                    <h5><a href="view_book.php?id=<?php echo $key['id'] ?>"><?php echo $key['b_name']; ?></a></h5>
                                    <p class="desc"><?php echo $key['b_description']; ?></p>
                                    <span><?php if ($key['type'] == 1) {
                                                echo "--- Free Of Cost ---";
                                            } else {
                                                echo "Rs " . $key['b_prize'] . "/-";
                                            }
                                            ?></span>
                                    <br>
                                </div>

                                <?php if ($key['type'] == 1) { ?>
                                    <button type="button" class="freecart_btn">Add To Cart</button>
                                <?php } else { ?>
                                    <button type="button" class="addtocart_btn" data-att="<?php echo $key['id']; ?>">Add To Cart</button>
                                <?php } ?>


                            </div>
                        </div>

                <?php }
                }
                free_books(); ?>

            </div>
        </div>
    </section>


    <section class="all_books_section">
        <div class="container mb-5" data-aos="fade-up">

            <div class="heading mb-4">
                <h2>All Books</h2>
            </div>


            <div class="row">
                <?php
                function all_books()
                {
                    include("includes/db.inc.php");
                    $query = "SELECT * FROM books WHERE type NOT IN (1) LIMIT 8";
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
                                        <h5><a href="view_book.php?id=<?php echo $key['id'] ?>"><?php echo $key['b_name']; ?></a></h5>
                                        <p class="desc"><?php echo $key['b_description']; ?></p>
                                        <span><?php if ($key['type'] == 1) {
                                                    echo "--- Free Of Cost ---";
                                                } else {
                                                    echo "Rs " . $key['b_prize'] . "/-";
                                                }
                                                ?></span>
                                        <br>
                                    </div>

                                    <?php if ($key['type'] == 1) { ?>
                                        <button type="button" class="freecart_btn">Add To Cart</button>
                                    <?php } else { ?>
                                        <button type="button" class="addtocart_btn" data-att="<?php echo $key['id']; ?>">Add To Cart</button>
                                    <?php } ?>


                                </div>
                            </div>

                <?php }
                    }
                }
                all_books(); ?>

            </div>
        </div>
    </section>



    <section>
        <div class="container my-5">

            <div class="heading mb-4">
                <h2>New Competetion</h2>
            </div>
            <?php
            function quiz()
            {
                include("includes/db.inc.php");
                $query = "SELECT * FROM quiz WHERE status=1 ORDER BY id DESC LIMIT 1";
                $run = mysqli_query($con, $query);
                if (mysqli_num_rows($run) > 0) {
                    foreach ($run as $key) { ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="my-4">
                                    <div class="mb-4 text-center">
                                        <h4><?php echo $key["com_name"]; ?></h4>
                                    </div>
                                    <p class="p-2">
                                        <?php echo $key["com_description"]; ?>
                                    </p>
                                    <div class="mx-3">
                                        <strong>Winning Price:</strong>
                                        <span>Rs <?php echo $key["com_price"]; ?>/-</span>
                                    </div>
                                    <br>
                                    <div class="p-2">
                                        <h6>Enrole Now</h6>
                                        <p><b>NOTE:</b> You can upload only PDF file</p>
                                        <?php if (!empty($_SESSION["id"])) { ?>
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="cmid" value="<?php echo $key["id"]; ?>">
                                                <input type="file" name="com_pdf" class="form-control mt-3" required>
                                                <button name="quiz_btn" class="btn btn-secondary my-3 px-5">Submit</button>
                                            </form>
                                        <?php } else { ?>
                                            <form>
                                                <input type="file" name="com_pdf" class="form-control mt-3">
                                                <button type="button" class="btn btn-secondary quiz_btn my-3 px-5">Submit</button>
                                            </form>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 border">
                                <img src="images/competition.png" width="100%">
                            </div>
                        </div>
            <?php }
                } else {
                    echo "<h4>No Competetion Started</h4>";
                }
            }
            quiz(); ?>
        </div>
    </section>



    <section class="p-5">
        <div class="container-md">
            <div class="mt-4 p-5 bg-light rounded shadow">
                <h2 class="text-center">Competion Result</h2>
                <br>
                <div class="autoplay">
                    <?php
                    function com_result()
                    {
                        include("includes/db.inc.php");
                        $query = "SELECT * FROM enroll INNER JOIN quiz on enroll.com_id=quiz.id WHERE win=1";
                        $run = mysqli_query($con, $query);
                        if (mysqli_num_rows($run) > 0) {
                            foreach ($run as $key) { 
                            $user_query = "SELECT * FROM users WHERE id='{$key["user_id"]}'";
                            $user_run = mysqli_query($con, $user_query);
                            foreach ($user_run as $value) { ?>
                                <div>
                                    <h4 class="text-center primary_color">"<?php echo $key["com_name"];?>"</h4>
                                    <h5 class="text-center">Name: <?php echo $value["name"];?></h5>
                                    <p class="text-center my-3"><a href="<?php echo $key["pdf"]; ?>" target="_blank">View PDF</a></p>
                                </div>
                    <?php
                            } }
                        }
                    }
                    com_result();
                    ?>

                </div>
            </div>
        </div>
    </section>
    <br><br>
    <?php include("includes/footer.inc.php"); ?>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js" integrity="sha512-3j3VU6WC5rPQB4Ld1jnLV7Kd5xr+cq9avvhwqzbH/taCRNURoeEpoPBK9pDyeukwSxwRPJ8fDgvYXd6SkaZ2TA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

    <script>
        $('.autoplay').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            navs: false,
            arrows: false
        });
    </script>

</body>

</html>


<?php

if (isset($_POST["quiz_btn"])) {
    include("includes/db.inc.php");
    $id = $_POST["cmid"];
    $uid = $_SESSION["id"];

    $pdf = $_FILES["com_pdf"]["name"];
    $temp_pdf = $_FILES["com_pdf"]["tmp_name"];
    $pdf_type = $_FILES["com_pdf"]["type"];
    //$pdf_folder = "../com_pdf/";
    $db_pdf = "com_pdf/";


    if (strtolower($pdf_type) == "application/pdf") {
        //$pdf_folder = "../pdf/" . $pdf;
        $db_pdf = "com_pdf/" . $pdf;

        move_uploaded_file($temp_pdf, $db_pdf);
    } else {
        echo "<script>alert('file must be PDF')</script>";
        die();
    }

    $qquery = "INSERT INTO enroll (user_id,com_id,pdf,win) VALUES ('$uid','$id','$db_pdf',0)";
    $qrun = mysqli_query($con, $qquery);
    header("location:index.php");
}

?>