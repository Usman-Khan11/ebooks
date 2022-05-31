<?php
include("../includes/db.inc.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sign Up</title>
   <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

</head>


<body>
   

   <div class="login">
      <div class="login-triangle"></div>

      <h2 class="login-header">Sign Up</h2>

      <form class="login-container" action="" method="post">
         <p><input required name="name" type="text" placeholder="Your Name"></p>
         <p><input required name="email" type="email" placeholder="Email"></p>
         <p><input required name="password" type="password" placeholder="Password"></p>
         <p><input name="signup_btn" type="submit" value="Create My Account"></p>
      </form>
   </div>


</body>

</html>

<?php
if (isset($_POST["signup_btn"])) {
   $name = $_POST["name"];
   $email = $_POST["email"];
   $pass = $_POST["password"];
   $role = 1;

   $query = "INSERT INTO users (name,email,password,role) VALUES ('$name','$email','$pass','$role')";
   $run = mysqli_query($con, $query);
   //$rows = mysqli_num_rows($run);
   if ($run) {
      header("location:login.php");
      echo "login Success";
   } else {
      echo "SIgnup Failed";
   }
}
?>