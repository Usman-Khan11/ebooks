<?php
session_start();
if (empty($_SESSION["id"]) || $_SESSION["role"] == 1) {
  header("location:../index.php");
}
?>



<section class="position-relative">
      <div class="admin_header">
        <div>
          <i class="fas fa-bars fa-lg" id="sidebar_toggle"></i>
        </div>
        <div>
          <h5>Hello <?php echo $_SESSION["username"];?></h5>
        </div>
        <div></div>
        <!-- <div>
          <i class="fas fa-ellipsis-v fa-lg"></i>
        </div>
        <div class="small_menu">
        <a href="">Link 1</a>
        <a href="">Link 2</a>
        <a href="">Link 3</a>

      </div> -->
      </div>
      <div class="my-5 "></div>
      <br>
    </section>

    <section>
      <div class="admin_sidebar">
        <ul>
          <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
          <li><a href="books.php"><i class="fas fa-book-open"></i> Books</a></li>
          <li><a href="book_category.php"><i class="fas fa-list"></i> Book Category</a></li>
          <li><a href="competetion.php"><i class="fas fa-home"></i> Start Competetion</a></li>
          <li><a href="all_competetion.php"><i class="fas fa-home"></i> All Competetion</a></li>
          <li><a href="competetion_listing.php"><i class="fas fa-home"></i> Enroll Competetion</a></li>
          <li><a href="orders.php"><i class="fas fa-home"></i> All Orders</a></li>
          <li><a href="../index.php"><i class="fas fa-home"></i> View Website</a></li>
          <li><a href="../credentials/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>


        </ul>
      </div>
    </section>
