<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "dbbansach";

// Tạo kết nối
$conn = mysqli_connect($servername, $username, $password, $database);

// Kiểm tra
if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
}
