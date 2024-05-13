<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ban_sach";

// Tạo kết nối
$conn = mysqli_connect($servername, $username, $password, $database);

// Kiểm tra
if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
}
$emailIsLogin = $_SESSION['login'];
$sql = "select * from loginadmin where tendangnhap = '" . $emailIsLogin . "' LIMIT 1";
$query = mysqli_query($conn, $sql);
$count = mysqli_num_rows($query);
if ($count > 0) {
     $row = mysqli_fetch_array($query);
     // print_r($row);
}
?>
<!-- Header -->
<div class="top-bar">
     <div class="top-bar-left">
          <div class="hamburger-btn">
               <span></span>
               <span></span>
               <span></span>
          </div>
          <div class="logo">
               <img src="images/logo.png">
          </div>
     </div>

     <div class="search-box">
          <input id="searchInput" class="input-box" type="search" placeholder='<?php echo date("d-m-Y"); ?>'>
          <span class="search-btn">
               <i class="fa-solid fa-search"></i>
          </span>
     </div>

     <div class="top-bar-right">
          <div class="mode-switch">
               <i class="fa-solid fa-moon"></i>
          </div>
          <div class="notifications">
               <i class="fa-solid fa-bell"></i>
          </div>
          <div class="profile">
               <img src="images/profile-img.jpg">
          </div>
     </div>
</div>
<!-- end Header -->