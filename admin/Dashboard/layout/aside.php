<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "dbbansach";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
}

// $sqlOrders = "SELECT COUNT(*) AS new_orders FROM hoadon WHERE DATE(ngaygiao) >= CURDATE() - INTERVAL 3 DAY";
// $sqlTotalOrders = "SELECT SUM(gia) AS doanh_so_trong_7_ngay
// FROM hoadon
// WHERE ngaygiao BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW();
// ";
// $result_orders = $conn->query($sqlOrders);
// $result_total_orders = $conn->query($sqlTotalOrders);


// if (mysqli_num_rows($result_orders) > 0) {
//      $row = mysqli_fetch_assoc($result_orders);
//      $total_orders = $row['new_orders'];
// } else {
//      echo "Không có đơn hàng nào trong cơ sở dữ liệu.";
// }

// if (mysqli_num_rows($result_total_orders) > 0) {
//      $row = mysqli_fetch_assoc($result_total_orders);
//      $total_7days_orders = number_format($row['doanh_so_trong_7_ngay'], 0, ',', '.');
// }



$conn->close();

?>

<!-- <main>
     <div class="head-title">
          <div class="left">
               <h1>Trang Chủ</h1>
               <ul class="breadcrumb" style="display: flex;
     align-items: center;
     grid-gap: 16px;
     margin: 20px 30px;">
                    <li>
                         <a href="#">Trang Chủ</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                         <a class="active" href="#">Home</a>
                    </li>
               </ul>
          </div>
     </div>

     <ul class="box-info">
          <li>
               <i class='bx bxs-calendar-check'></i>
               <span class="text">
                    <h3><?php $total_orders; ?></h3>
                    <p>Đơn mới</p>
               </span>
          </li>
          <li>
               <i class='bx bxs-group'></i>
               <span class="text">
                    <h3> <?php $totalUsers ?> </h3>
                    <p>Số người đã đăng kí</p>
               </span>
          </li>
          <li>
               <i class='bx bxs-dollar-circle'></i>
               <span class="text">
                    <h3><?php $total_7days_orders; ?> VNĐ</h3>
                    <p>Tổng tiền đã bán trong 7 ngày gần nhất</p>
               </span>
          </li>
     </ul>


     <div class="table-data">
          <div class="order">
               <div class="head">
                    <h3>Các Đơn Hàng</h3>
               </div>
               <div class="filter">
                    <input type="text" id="userFilter" placeholder="Tìm theo tên người dùng">
                    <select id="statusFilter" style="padding: 10px 50px; margin: 30px 0; border-radius: 10px;">
                         <option value="">Tất cả trạng thái</option>
                         <option value="chưa xác nhận">Chưa xác nhận</option>
                         <option value="đã xác nhận">Đã xác nhận</option>
                         <option value="đang giao hàng">Đang giao hàng</option>
                    </select>
                    <button class="btn btn-primary" onclick="filterOrders()">Lọc</button>
               </div>
               <table>
                    <thead>
                         <tr>
                              <th>Người Dùng</th>
                              <th>Ngày Đặt Hàng</th>
                              <th>Trạng Thái</th>
                         </tr>
                    </thead>
                    <tbody>
                         <?php

                         $servername = "localhost";
                         $username = "root";
                         $password = "";
                         $database = "dbbansach";
                         $conn = mysqli_connect($servername, $username, $password, $database);


                         if (!$conn) {
                              die("Connection failed: " . mysqli_connect_error());
                         }


                         //                     $sql = "SELECT nguoidung.*, donhang.* FROM nguoidung
                         //    INNER JOIN donhang ON nguoidung.user_id = donhang.user_id";

                         //                     $result = mysqli_query($conn, $sql);

                         //                     if ($result) {
                         //                          if (mysqli_num_rows($result) > 0) {
                         //                               while ($row = mysqli_fetch_assoc($result)) {
                         //                                    $formatted_date = date('d-m-Y', strtotime($row['ngaygiao']));
                         //                                    $status_class = '';
                         //                                    switch ($row['trangthai']) {
                         //                                         case 'chưa xác nhận':
                         //                                              $status_class = 'chưa xác nhận';
                         //                                              break;
                         //                                         case 'đã xác nhận':
                         //                                              $status_class = 'đã xác nhận';
                         //                                              break;
                         //                                         case 'đang giao hàng':
                         //                                              $status_class = 'đang giao hàng';
                         //                                              break;
                         //                                         default:
                         //                                              $status_class = 'chưa xác nhận';
                         //                                    }
                         ?>
                         <tr>
                              <td>
                                   <img src="http://localhost/BanGiay/admin/images/<?php $row['hinhanh'] ?>"
                                        alt="image" class="image">
                                   <p><?php $row['ten']; ?></p>
                              </td>
                              <td><?php $formatted_date; ?></td>
                              <td><span class="status completed"><?php $status_class; ?></span></td>
                         </tr>
                         <?php
                         //           }
                         //      } else {
                         //           echo "<tr><td>Chưa có đơn hàng nào</td></tr>";
                         //      }
                         // } else {
                         //      echo "Error: " . mysqli_error($conn);
                         // }

                         // mysqli_close($conn);
                         ?>

                    </tbody>
               </table>
          </div>
          <div class="todo">
               <div class="head">
                    <h3>Todos</h3>
                    <i class='bx bx-plus'></i>
                    <i class='bx bx-filter'></i>
               </div>
               <ul class="todo-list">
                    <li class="completed">
                         <p>Todo List</p>
                         <i class='bx bx-dots-vertical-rounded'></i>
                    </li>
                    <li class="completed">
                         <p>Todo List</p>
                         <i class='bx bx-dots-vertical-rounded'></i>
                    </li>
                    <li class="not-completed">
                         <p>Todo List</p>
                         <i class='bx bx-dots-vertical-rounded'></i>
                    </li>
                    <li class="completed">
                         <p>Todo List</p>
                         <i class='bx bx-dots-vertical-rounded'></i>
                    </li>
                    <li class="not-completed">
                         <p>Todo List</p>
                         <i class='bx bx-dots-vertical-rounded'></i>
                    </li>
               </ul>
          </div>
     </div>
</main> -->
<!-- MAIN -->



<!--   === Contents Section Starts ===   -->
<!--   === Panel Bar Starts ===   -->
<div class="panel-bar">
     <div class="row-1">
          <h1>Products</h1>
     </div>
     <div class="row-2">
          <a href="#" class="active">Overwiew</a>
          <a href="#">Products</a>
          <a href="#">Total Sells</a>
          <a href="#">Perchases</a>
     </div>
</div>
<!--   === Panel Bar Ends ===   -->
<!--   === Description Starts ===   -->
<div class="description">
     <!--   === Column 1 Starts ===   -->
     <div class="col-1">
          <!--   === Boxes Row Starts ===   -->
          <div class="boxes-row">
               <div class="balance-box">
                    <div class="subject-row">
                         <div class="text">
                              <h3>Total Income</h3>
                              <h1>$70,452<sub>(USD)</sub></h1>
                         </div>
                         <div class="icon">
                              <i class="fa-solid fa-arrow-up"></i>
                         </div>
                    </div>
                    <div class="progress-row">
                         <div class="subject">progress</div>
                         <div class="progress-bar">
                              <div class="progress-line" value="91%" style="max-width: 91%"></div>
                         </div>
                    </div>
               </div>

               <div class="balance-box">
                    <div class="subject-row">
                         <div class="text">
                              <h3>Total Expense</h3>
                              <h1>$64,261<sub>(USD)</sub></h1>
                         </div>
                         <div class="icon">
                              <i class="fa-solid fa-arrow-down"></i>
                         </div>
                    </div>
                    <div class="progress-row">
                         <div class="subject">progress</div>
                         <div class="progress-bar">
                              <div class="progress-line" value="73%" style="max-width: 73%"></div>
                         </div>
                    </div>
               </div>
          </div>
          <!--   === Boxes Row Ends ===   -->
          <!--   === Analytics Chart Starts ===   -->
          <div class="chart">
               <div class="chart-header">
                    <h2>Revenue Analytics</h2>
                    <input type="month" class="date" value="2023-12">
               </div>
               <div class="chart-contents">
                    <section class="chart-grid">
                         <div class="grid-line" value="100%"></div>
                         <div class="grid-line" value="80%"></div>
                         <div class="grid-line" value="60%"></div>
                         <div class="grid-line" value="40%"></div>
                         <div class="grid-line" value="20%"></div>
                         <div class="grid-line" value="0%"></div>
                    </section>
                    <section class="chart-value-wrapper">
                         <div class="chart-value" style="max-height: 62%"></div>
                         <div class="chart-value" style="max-height: 76%"></div>
                         <div class="chart-value" style="max-height: 70%"></div>
                         <div class="chart-value" style="max-height: 82%"></div>
                         <div class="chart-value" style="max-height: 78%"></div>
                         <div class="chart-value" style="max-height: 94%"></div>
                    </section>
                    <section class="chart-labels">
                         <div>Jul</div>
                         <div>Aug</div>
                         <div>Sep</div>
                         <div>Oct</div>
                         <div>Nov</div>
                         <div>Dec</div>
                    </section>
               </div>
          </div>
          <!--   === Analytics Chart Ends ===   -->
     </div>
     <!--   === Column 1 Ends ===   -->
     <!--   === Column 2 Starts ===   -->
     <div class="col-2">
          <!--   === Top Products Starts ===   -->
          <div class="top-products">
               <header class="products-header">
                    <h1>Top Products</h1>
               </header>
               <div class="products-wrapper">

                    <div class="product">
                         <div class="product-img">
                              <img src="images/products/product-1.jpg">
                         </div>
                         <div class="product-desc">
                              <div class="product-row-1">
                                   <h2>Ear Phones</h2>
                                   <i class="fa-solid fa-shopping-cart"></i>
                              </div>
                              <div class="product-row-2">
                                   <p>Lorem ipsum dolor sit amet.</p>
                              </div>
                         </div>
                    </div>

                    <div class="product">
                         <div class="product-img">
                              <img src="images/products/product-2.jpg">
                         </div>
                         <div class="product-desc">
                              <div class="product-row-1">
                                   <h2>Cosmetics</h2>
                                   <i class="fa-solid fa-shopping-cart"></i>
                              </div>
                              <div class="product-row-2">
                                   <p>Lorem ipsum dolor sit amet.</p>
                              </div>
                         </div>
                    </div>

                    <div class="product">
                         <div class="product-img">
                              <img src="images/products/product-3.jpg">
                         </div>
                         <div class="product-desc">
                              <div class="product-row-1">
                                   <h2>Mouse</h2>
                                   <i class="fa-solid fa-shopping-cart"></i>
                              </div>
                              <div class="product-row-2">
                                   <p>Lorem ipsum dolor sit amet.</p>
                              </div>
                         </div>
                    </div>

                    <div class="product">
                         <div class="product-img">
                              <img src="images/products/product-4.jpg">
                         </div>
                         <div class="product-desc">
                              <div class="product-row-1">
                                   <h2>Ceramic</h2>
                                   <i class="fa-solid fa-shopping-cart"></i>
                              </div>
                              <div class="product-row-2">
                                   <p>Lorem ipsum dolor sit amet.</p>
                              </div>
                         </div>
                    </div>

                    <div class="product">
                         <div class="product-img">
                              <img src="images/products/product-5.jpg">
                         </div>
                         <div class="product-desc">
                              <div class="product-row-1">
                                   <h2>Laptop</h2>
                                   <i class="fa-solid fa-shopping-cart"></i>
                              </div>
                              <div class="product-row-2">
                                   <p>Lorem ipsum dolor sit amet.</p>
                              </div>
                         </div>
                    </div>

                    <div class="product">
                         <div class="product-img">
                              <img src="images/products/product-6.jpg">
                         </div>
                         <div class="product-desc">
                              <div class="product-row-1">
                                   <h2>Head Phones</h2>
                                   <i class="fa-solid fa-shopping-cart"></i>
                              </div>
                              <div class="product-row-2">
                                   <p>Lorem ipsum dolor sit amet.</p>
                              </div>
                         </div>
                    </div>

                    <div class="product">
                         <div class="product-img">
                              <img src="images/products/product-7.jpg">
                         </div>
                         <div class="product-desc">
                              <div class="product-row-1">
                                   <h2>Nick Shoes</h2>
                                   <i class="fa-solid fa-shopping-cart"></i>
                              </div>
                              <div class="product-row-2">
                                   <p>Lorem ipsum dolor sit amet.</p>
                              </div>
                         </div>
                    </div>

                    <div class="product">
                         <div class="product-img">
                              <img src="images/products/product-8.jpg">
                         </div>
                         <div class="product-desc">
                              <div class="product-row-1">
                                   <h2>Leather Shoes</h2>
                                   <i class="fa-solid fa-shopping-cart"></i>
                              </div>
                              <div class="product-row-2">
                                   <p>Lorem ipsum dolor sit amet.</p>
                              </div>
                         </div>
                    </div>

               </div>
          </div>
          <!--   === Top Products Ends ===   -->
          <!--   === Total Balance Card Starts ===   -->
          <div class="balance-card">
               <div class="balance-card-top">
                    <div class="text">
                         <h3>Total Income</h3>
                         <h1>$70,452<sub>(USD)</sub></h1>
                    </div>
                    <div class="icon">
                         <i class="fa-solid fa-arrow-up"></i>
                    </div>
               </div>
               <div class="balance-card-middle">
                    <div class="subject">Progress</div>
                    <div class="progress-bar">
                         <div class="progress-line" value="93%" style="max-width: 93%"></div>
                    </div>
               </div>
               <div class="balance-card-bottom">
                    <button class="btn-top-up">
                         Top Up<i class="fa-solid fa-arrow-up"></i>
                    </button>
                    <button class="btn-transfer">
                         Transfer<i class="fa-solid fa-arrow-up"></i>
                    </button>
               </div>
          </div>
          <!--   === Total Balance Card Ends ===   -->
     </div>
     <!--   === Column 2 Ends ===   -->
</div>
<!--   === Description Ends ===   -->
<!--   === Contents Section Ends ===   -->