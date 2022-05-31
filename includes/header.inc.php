<header>
   <nav>
      <div class="main_navbar">
         <div class="nav_links">
            <ul>
               <li><a href="books.php">Books</a></li>
               <li><a href="">About</a></li>
               <?php
                    if (isset($_SESSION["role"]) && $_SESSION["role"] == 2) {
                    ?>
                     <li><a href="admin/dashboard.php">Dashboard</a></li>
                 <?php } else{ ?>
                  <li><a href="mybooks.php">My Books</a></li>
                  <li><a href="membership.php">Membership</a></li>
                  <?php }?>
                  <?php
                    if (isset($_SESSION["id"])) {
                    ?>
                     <li><a href="credentials/logout.php">Logout</a></li>
                 <?php } else{ ?>
                  <li><a href="credentials/login.php">Login</a></li>
                  <?php }?>
            </ul>
         </div>
         <div class="logo">
            <!-- <img src="images/ebook.png" width="150"> -->
            <h1><a href="index.php">E-Book</a></h1>
         </div>
         <div class="other_links ">
            <ul>
               <li><a href="add_cart.php"><i class="fas fa-shopping-cart"></i> <small id="cart_count"></small> </a></li>
               <li id="search_toggle"><i class="fas fa-search"></i></li>
               <li id="nav_toggle"><i class="fas fa-bars"></i></li>
            </ul>
         </div>
      </div>

      <div class="search_bar">
         <form action="books.php" method="get">
            <input type="search" name="search" placeholder="Search Here....">
         </form>
      </div>
   </nav>
</header>
<br><br><br>
