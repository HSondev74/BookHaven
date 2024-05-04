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
          $sql = "SELECT * FROM sanpham";
          $result = mysqli_query($conn, $sql);


          // Hiển thị dữ liệu trong một bảng
          if ($result->num_rows > 0) {
               while ($row = $result->fetch_assoc()) {
                    $gia_co_dau = number_format($row["Gia"], 0, ',', '.');
                    // $images = explode(',', $row['HinhAnh']);
                    $images = $row['HinhAnh'];
                    echo "<tr>";
                    echo "<td>" . $row["ID"] . "</td>";
                    echo "<td>" . $row["Ten"] . "</td>";
                    echo "</select>";
                    echo "</td>";
                    echo "<td>" . $gia_co_dau . ".000VNĐ</td>";
                    // echo "<td><img src='" . $first_image . "' alt='Product Image' class='product-image'></td>";

                    echo "<td><img src='Dashboard/layout/quanlysanpham/uploads/" . $images . "' alt='Product Image' class='product-image'></td>";
                    // echo "<td>" . $row["tonkho"] . "</td>";
                    echo "<td>" . $row["matheloai"] . "</td>";
                    echo "<td style='max-width: 500px; word-wrap: break-word;overflow-wrap: break-word;' >" . $row["Mota"] . "</td>";
                    echo "<td><a href='?action=sanpham&query=sua&id=" . $row["ID"] . "' style='background-color: orange;
                    color: white;
                    padding: 5px 10px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;' >Sửa</a></td>";
                    echo "<td><a href='Dashboard/layout/quanlysanpham/xoa.php?id=" . $row["ID"] . "' style='background-color: red;
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
</div>