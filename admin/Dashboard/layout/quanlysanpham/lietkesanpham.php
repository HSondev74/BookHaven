<div class="container" style="width: 90%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
     <h2>Danh Sách Sản Phẩm</h2>
     <table style="text-align: center;">
          <tr>
               <th>ID Sản Phẩm</th>
               <th>Tên Sản Phẩm</th>
               <th>Giá</th>
               <th>Hình Ảnh</th>
               <!-- <th>Tồn Kho</th> -->
               <th>ID Danh Mục</th>
               <th>Mô Tả</th>
               <th></th>
               <th></th>
          </tr>
          <?php
          // Truy vấn dữ liệu từ bảng sanpham
          $products_per_page = 2;
          $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
          $start_index = ($current_page - 1) * $products_per_page;
          $keyword = isset($_POST['keyword']) ? trim($_POST['keyword']) : '';
          $sql = "SELECT sanpham.*, theloai.Theloai_ID 
              FROM sanpham 
              INNER JOIN theloai ON sanpham.Theloai_ID = theloai.Theloai_ID";

          if ($keyword !== '') {
               $sql .= " WHERE Ten LIKE '%" . mysqli_real_escape_string($conn, $keyword) . "%'";
          }

          $sql .= " LIMIT $start_index, $products_per_page";

          $result = mysqli_query($conn, $sql);


          // Hiển thị dữ liệu trong một bảng
          if ($result->num_rows > 0) {
               while ($row = $result->fetch_assoc()) {
                    $gia_co_dau = number_format($row["Gia"], 0, ',', '.');
                    // $images = explode(',', $row['HinhAnh']);
                    $images = explode(',', $row['Hinhanh']);
                    if (!empty($images)) {
                         $first_image = $images[0];
                         $second_image = isset($images[1]) ? $images[1] : $images[0];
                    }
                    // $images = $row['Hinhanh'];
                    echo "<tr>";
                    echo "<td>" . $row["Sanpham_ID"] . "</td>";
                    echo "<td>" . $row["Ten"] . "</td>";
                    echo "</select>";
                    echo "</td>";
                    echo "<td>" . $gia_co_dau . ".000VNĐ</td>";
                    // echo "<td><img src='" . $first_image . "' alt='Product Image' class='product-image'></td>";

                    echo "<td><img src='Dashboard/layout/quanlysanpham/uploads/" . $first_image . "' alt='Product Image' class='product-image'></td>";
                    // echo "<td>" . $row["tonkho"] . "</td>";
                    echo "<td>" . $row["Theloai_ID"] . "</td>";
                    echo "<td style='max-width: 500px; word-wrap: break-word;overflow-wrap: break-word;' >" . $row["Mota"] . "</td>";
                    echo "<td><a href='?action=sanpham&query=sua&id=" . $row["Sanpham_ID"] . "' style='background-color: orange;
                    color: white;
                    padding: 5px 10px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;' >Sửa</a></td>";
                    echo "<td><a href='Dashboard/layout/quanlysanpham/xoa.php?id=" . $row["Sanpham_ID"] . "' style='background-color: red;
                    color: white;
                    padding: 5px 10px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;' >Xóa</a></td>";
                    echo "</tr>";
               }
          } else {
               echo "<tr><td colspan='9'>Không có sản phẩm nào.</td></tr>";
          }
          ?>
     </table>
     <div class="pagination">
          <?php
          $key = isset($_GET['keyword']) ? mysqli_real_escape_string($conn, $_GET['keyword']) : '';
          $sql_count = "SELECT COUNT(*) AS total FROM sanpham";

          if (!empty($key)) {
               $sql_count .= " WHERE Ten LIKE '%" . $key . "%'"; // Thêm khoảng trắng trước WHERE
          }

          $result_count = mysqli_query($conn, $sql_count);
          $row_count = mysqli_fetch_assoc($result_count);
          $total_pages = ceil($row_count['total'] / $products_per_page);

          $query_params = $_GET; // Lấy các tham số hiện tại

          // Tạo chuỗi truy vấn với các tham số hiện tại
          $current_query = http_build_query($query_params);


          // First page
          // First page
          if ($current_page > 3) {
               $query_params['page'] = 1; // Chuyển trang về trang 1
               echo "<a href='index.php?" . http_build_query($query_params) . "'>First</a>";
          }

          // Previous page
          if ($current_page > 1) {
               $query_params['page'] = $current_page - 1;
               echo "<a href='index.php?" . http_build_query($query_params) . "'>Prev</a>";
          }

          // Các trang gần trang hiện tại
          for ($i = 1; $i <= $total_pages; $i++) {
               if ($i >= $current_page - 2 && $i <= $current_page + 2) {
                    $query_params['page'] = $i;
                    if ($i == $current_page) {
                         echo "<strong class = 'hover-page'>$i</strong> "; // Trang hiện tại
                    } else {
                         echo "<a href='index.php?" . http_build_query($query_params) . "'>$i</a>";
                    }
               }
          }

          // Next page
          if ($current_page < $total_pages) {
               $query_params['page'] = $current_page + 1;
               echo "<a href='index.php?" . http_build_query($query_params) . "'>Next</a>";
          }

          // Last page
          if ($current_page < $total_pages - 3) {
               $query_params['page'] = $total_pages;
               echo "<a href='index.php?" . http_build_query($query_params) . "'>Last</a>";
          }

          ?>
     </div>
</div>

<script>
     document.addEventListener("DOMContentLoaded", function() {
          const currentUrl = new URL(window.location.href);

          // Đặt giá trị của input dựa trên tham số 'keyword' hiện tại
          const currentKeyword = currentUrl.searchParams.get("keyword");
          if (currentKeyword) {
               document.getElementById("userFilter").value = currentKeyword;
          }
     });

     function retainQueryParams(form) {
          const currentUrl = new URL(window.location.href);

          // Lấy giá trị hiện tại của 'keyword' và cập nhật vào URL
          const keyword = document.getElementById("userFilter").value;
          currentUrl.searchParams.set("keyword", keyword);

          // Đặt action của form với URL mới
          form.action = currentUrl.toString();
     }
     const form = document.querySelector("form.name-custormer");
     form.addEventListener("submit", function() {
          retainQueryParams(this);
     });
</script>