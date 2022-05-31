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
    <title>Membership</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<style>
    
.sec-title{
  position:relative;
  margin-bottom:70px;
}

.sec-title .title{
  position: relative;
  display: block;
  font-size: 16px;
  line-height: 1em;
  color: #ff8a01;
  font-weight: 500;
  background: rgb(247,0,104);
  background: -moz-linear-gradient(to left, rgba(247,0,104,1) 0%, rgba(68,16,102,1) 25%, rgba(247,0,104,1) 75%, rgba(68,16,102,1) 100%);
  background: -webkit-linear-gradient(to left, rgba(247,0,104,1) 0%,rgba(68,16,102,1) 25%,rgba(247,0,104,1) 75%,rgba(68,16,102,1) 100%);
  background: linear-gradient(to left, rgba(247,0,104) 0%,rgba(68,16,102,1) 25%,rgba(247,0,104,1) 75%,rgba(68,16,102,1) 100%);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#F70068', endColorstr='#441066',GradientType=1 );
  color: transparent;
  -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  text-transform: uppercase;
  letter-spacing: 5px;
  margin-bottom: 15px;
}

.sec-title h2{
  position:relative;
  display: inline-block;
  font-size:48px;
  line-height:1.2em;
  color:#1e1f36;
  font-weight:700;
}

.sec-title .text{
  position: relative;
  font-size: 16px;
  line-height: 28px;
  color: #888888;
  margin-top: 30px;
}

.sec-title.light h2,
.sec-title.light .title{
  color: #ffffff;
  -webkit-text-fill-color:inherit; 
}
.pricing-section {
    position: relative;
    padding: 100px 0 80px;
    overflow: hidden;
}
.pricing-section .outer-box{
  max-width: 1100px;
  margin: 0 auto;
}


.pricing-section .row{
  margin: 0 -30px;
}

.pricing-block{
  position: relative;
  padding: 0 30px;
  margin-bottom: 40px;
}

.pricing-block .inner-box{
  position: relative;
  background-color: #ffffff;
  box-shadow: 0 20px 40px rgba(0,0,0,0.08);
  padding: 0 0 30px;
  max-width: 370px;
  margin: 0 auto;
  border-bottom: 20px solid #40cbb4;
}

.pricing-block .icon-box{
  position: relative;
  padding: 50px 30px 0;
  background-color: #40cbb4;
  text-align: center;
}

.pricing-block .icon-box:before{
  position: absolute;
  left: 0;
  bottom: 0;
  height: 75px;
  width: 100%;
  border-radius: 50% 50% 0 0;
  background-color: #ffffff;
  content: "";
}


.pricing-block .icon-box .icon-outer{
  position: relative;
  height: 150px;
  width: 150px;
  background-color: #ffffff;
  border-radius: 50%;
  margin: 0 auto;
  padding: 10px;
}

.pricing-block .icon-box i{
  position: relative;
  display: block;
  height: 130px;
  width: 130px;
  line-height: 120px;
  border: 5px solid #40cbb4;
  border-radius: 50%;
  font-size: 50px;
  color: #40cbb4;
  -webkit-transition:all 600ms ease;
  -ms-transition:all 600ms ease;
  -o-transition:all 600ms ease;
  -moz-transition:all 600ms ease;
  transition:all 600ms ease;
}

.pricing-block .inner-box:hover .icon-box i{
  transform:rotate(360deg);
}

.pricing-block .price-box{
  position: relative;
  text-align: center;
  padding: 10px 20px;
}

.pricing-block .title{
  position: relative;
  display: block;
  font-size: 24px;
  line-height: 1.2em;
  color: #222222;
  font-weight: 600;
}

.pricing-block .price{
  display: block;
  font-size: 30px;
  color: #222222;
  font-weight: 700;
  color: #40cbb4;
}


.pricing-block .features{
  position: relative;
  max-width: 200px;
  margin: 0 auto 20px;
}

.pricing-block .features li{
  position: relative;
  display: block;
  font-size: 14px;
  line-height: 30px;
  color: #848484;
  font-weight: 500;
  padding: 5px 0;
  padding-left: 30px;
  border-bottom: 1px dashed #dddddd;
}
.pricing-block .features li:before {
    position: absolute;
    left: 0;
    top: 50%;
    font-size: 16px;
    color: #2bd40f;
    -moz-osx-font-smoothing: grayscale;
    -webkit-font-smoothing: antialiased;
    display: inline-block;
    font-style: normal;
    font-variant: normal;
    text-rendering: auto;
    line-height: 1;
    content: "\f058";
    font-family: "Font Awesome 5 Free";
    margin-top: -8px;
}
.pricing-block .features li.false:before{
  color: #e1137b;
  content: "\f057";
}

.pricing-block .features li a{
  color: #848484;
}

.pricing-block .features li:last-child{
  border-bottom: 0;
}

.pricing-block .btn-box{
  position: relative;
  text-align: center;
}

.pricing-block .btn-box a{
  position: relative;
  display: inline-block;
  font-size: 14px;
  line-height: 25px;
  color: #ffffff;
  font-weight: 500;
  cursor: pointer;
  padding: 8px 30px;
  background-color: #40cbb4;
  border-radius: 10px;
  border-top:2px solid transparent;
  border-bottom:2px solid transparent;
  -webkit-transition: all 400ms ease;
  -moz-transition: all 400ms ease;
  -ms-transition: all 400ms ease;
  -o-transition: all 400ms ease;
  transition: all 300ms ease;
}

.pricing-block .btn-box a:hover{
  color: #ffffff;
}

.pricing-block .inner-box:hover .btn-box a{
  color:#40cbb4;
  background:none;
  border-radius:0px;
  border-color:#40cbb4;
}

.pricing-block:nth-child(2) .icon-box i,
.pricing-block:nth-child(2) .inner-box{
  border-color: #1d95d2;
}

.pricing-block:nth-child(2) .btn-box a,
.pricing-block:nth-child(2) .icon-box{
  background-color: #1d95d2;
}

.pricing-block:nth-child(2) .inner-box:hover .btn-box a{
  color:#1d95d2;
  background:none;
  border-radius:0px;
  border-color:#1d95d2;
}

.pricing-block:nth-child(2) .icon-box i,
.pricing-block:nth-child(2) .price{
  color: #1d95d2;
}

.pricing-block:nth-child(3) .icon-box i,
.pricing-block:nth-child(3) .inner-box{
  border-color: #ffc20b;
}

.pricing-block:nth-child(3) .btn-box a,
.pricing-block:nth-child(3) .icon-box{
  background-color: #ffc20b;
}

.pricing-block:nth-child(3) .icon-box i,
.pricing-block:nth-child(3) .price{
  color: #ffc20b;
}

.pricing-block:nth-child(3) .inner-box:hover .btn-box a{
  color:#ffc20b;
  background:none;
  border-radius:0px;
  border-color:#ffc20b;
}

</style>

<body>
    <?php include("includes/header.inc.php"); ?>


    <section class="banner_section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">
                        <h1>E-Books Membership</h1>
                        <br>
                        <p>
                            We are providing Membership facility. If you buy a Membership Plan you have to access all the books in our websites.
                        </p>
                        <br>
                    </div>
                </div>
                
            </div>
        </div>
    </section>


   
    <section class="pricing-section">
        <div class="container">
            <div class="sec-title text-center">
                <h2>Choose a Plan</h2>
            </div>

            <div class="outer-box">
                <div class="row">
                    <!-- Pricing Block -->
                    <div class="pricing-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp">
                        <div class="inner-box">
                            <div class="icon-box">
                                <div class="icon-outer"><i class="fas fa-paper-plane"></i></div>
                            </div>
                            <div class="price-box">
                                <div class="title">Plan 1</div>
                                <h4 class="price">Rs 5000/-</h4>
                            </div>
                            <ul class="features">
                                <li class="true">Easy Access</li>
                                <li class="true">Free Contacts</li>
                                <li class="true">Unlimited Books</li>
                            </ul>
                            <div class="btn-box">
                                <a class="theme-btn plan_btn" data-name="6 Months" data-price="5000">BUY plan</a>
                            </div>
                        </div>
                    </div>

                    <!-- Pricing Block -->
                    <div class="pricing-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="400ms">
                        <div class="inner-box">
                            <div class="icon-box">
                                <div class="icon-outer"><i class="fas fa-gem"></i></div>
                            </div>
                            <div class="price-box">
                                <div class="title">Plan 2</div>
                                <h4 class="price">Rs 10000/-</h4>
                            </div>
                            <ul class="features">
                            <li class="true">Easy Access</li>
                                <li class="true">Free Contacts</li>
                                <li class="true">Unlimited Books</li>
                            </ul>
                            <div class="btn-box">
                                <a class="theme-btn plan_btn" data-name="1 Years" data-price="10000">BUY plan</a>
                            </div>
                        </div>
                    </div>

                    <!-- Pricing Block -->
                    <div class="pricing-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="800ms">
                        <div class="inner-box">
                            <div class="icon-box">
                                <div class="icon-outer"><i class="fas fa-rocket"></i></div>
                            </div>
                            <div class="price-box">
                                <div class="title">Plan 3</div>
                                <h4 class="price">Rs 25000/-</h4>
                            </div>
                            <ul class="features">
                            <li class="true">Easy Access</li>
                                <li class="true">Free Contacts</li>
                                <li class="true">Unlimited Books</li>
                            </ul>
                            <div class="btn-box">
                                <a class="theme-btn plan_btn" data-name="2 Years" data-price="25000">BUY plan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    

    
    <?php include("includes/footer.inc.php"); ?>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js" integrity="sha512-3j3VU6WC5rPQB4Ld1jnLV7Kd5xr+cq9avvhwqzbH/taCRNURoeEpoPBK9pDyeukwSxwRPJ8fDgvYXd6SkaZ2TA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
   
    

</body>

</html>

