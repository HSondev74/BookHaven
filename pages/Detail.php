<?php
if (isset($_GET['id'])) {

     $idsp = $_GET['id'];
     $sql = "SELECT * FROM sanpham where ID = '" . $idsp . "'";
     $result = mysqli_query($conn, $sql);

     if ($result->num_rows > 0) {
          while ($product = $result->fetch_assoc()) {
               $images = $product['HinhAnh'];

               $danhmuc_id = $product['matheloai'];
               $sql_danhmuc = "SELECT Ten FROM theloai WHERE matheloai = $danhmuc_id";
               $result_danhmuc = mysqli_query($conn, $sql_danhmuc);
               $row_danhmuc = mysqli_fetch_assoc($result_danhmuc);
               $tendanhmuc = $row_danhmuc['Ten'];


?>


<main id="main" class="container">
     <div class="container-details">
          <div class="detail">

               <div class="all-detail">
                    <div class="slide-img-detail">
                         <div class="gallery">
                              <div class="gallery-inner">
                                   <img src="admin/Dashboard/layout/quanlysanpham/uploads/<?php echo $images ?>"
                                        alt="" />
                              </div>

                              <!-- <div class="control prev">
                  <i class="fa-solid fa-arrow-left"></i>
                </div>
                <div class="control next">
                  <i class="fa-solid fa-arrow-right"></i>
                </div> -->

                         </div>

                         <div>
                              <div class="list">
                                   <div>
                                        <img src="admin/Dashboard/layout/quanlysanpham/uploads/<?php echo $images ?>"
                                             alt="" />
                                   </div>
                              </div>
                         </div>

                    </div>

                    <div class="detail-product">
                         <div class="detail-brand"><?php echo $tendanhmuc ?></div>

                         <h4 class="detail-name">
                              <?php echo $product['Ten'] ?>
                         </h4>

                         <div class="detail-price">
                              <?php
                                             $price = $product['Gia'] * 1000;
                                             echo number_format($price, 0, ',', '.') . ' VNĐ'; ?>
                         </div>

                         <div class="parameter-detail">
                              <div class="para">Code: <b>VIBES - <?php echo $product['ID'] ?></b></div>
                              <div class="para">Tình trạng:
                                   <b>Còn hàng</b>
                              </div>
                              <div class="para">Nhà xuất bản: <b><?php echo $tendanhmuc ?></b></div>
                              <div class="para">Xuất xứ thương hiệu: <b>Global</b></div>
                         </div>

                         <div class="detail-ship">
                              <div class="detail-icon">
                                   <img src="./images/img-icon/icon_service_product_1.svg" alt="">
                                   <p>Giao hàng toàn quốc (Hỗ trợ ship COD nhận hàng thanh toán)
                                   <p>
                              </div>
                              <div class="detail-icon">
                                   <img src="./images/img-icon/icon_service_product_2.svg" alt="">
                                   <p>Nhận ngay QUÀ TẶNG và VOUCHER giảm giá cho lần mua hàng tiếp theo
                                   <p>
                              </div>
                              <div class="detail-icon">
                                   <img src="./images/img-icon/icon_service_product_3.svg" alt="">
                                   <p>
                                        Hỗ trợ đổi trong vòng 5 ngày
                                   <p>
                              </div>
                              <div class="detail-icon">
                                   <img src="./images/img-icon/icon_service_product_4.svg" alt="">
                                   <p>Cam kết chính hãng 100%
                                   <p>
                              </div>
                         </div>

                         <div class="detail-pay">
                              <a href="pages/addProduct.php?idsp=<?php echo $product['ID'] ?>&them"
                                   class="detail-add-pay">Thêm vào giỏ hàng</a>
                              <a href="pages/addProduct.php?idsp=<?php echo $product['ID'] ?>&muangay"
                                   class="detail-buy">Mua Ngay</a href="">
                              <!-- <a href="index.php?action=chitietsanpham&id=<?php echo $_GET['id'] ?>" id="submitBtn" class="detail-buy">Mua Ngay</a href=""> -->
                         </div>

                    </div>
               </div>
          </div>
     </div>


     <!-- sanpham lien quan -->
     <div class="product-hot ">
          <div class="title-hot">
               <h1>Sản phẩm liên quan</h1>
          </div>
          <div class="content-products">
               <?php
                              $products_per_page = 5;
                              $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                              $start_index = ($current_page - 1) * $products_per_page;

                              $sql = "SELECT * FROM sanpham WHERE matheloai = $danhmuc_id and ID != $idsp LIMIT $start_index, $products_per_page";

                              $result = mysqli_query($conn, $sql);

                              if ($result->num_rows > 0) {
                                   while ($product = $result->fetch_assoc()) {
                                        $images = $product['HinhAnh'];
                              ?>

               <div class="product">
                    <a href="index.php?action=chitietsanpham&id=<?php echo $product['ID']; ?>">

                         <div class="discount"> -20% </div>
                         <div class="product-image">
                              <img src="admin/Dashboard/layout/quanlysanpham/uploads/<?php echo $images; ?>" alt="">
                              <!-- <a href="pages/addProduct.php?idsp=<?php echo $product['ID'] ?>" class="cart-popup" name="addProduct"><i class='bx bx-cart-add'></i></a> -->
                         </div>
                         <span class="heart-product" onclick="changeFavorites(this,<?php echo $product['ID']; ?>)"
                              data-id="<?php echo $product['ID']; ?> "><i class='bx bxs-heart'></i></span>
                         <p class=" product-title"><?php echo $product['Ten'] ?></p>
                         <p class="product-price">
                              <?php
                                                       $price = $product['Gia'] * 1000;
                                                       echo number_format($price, 0, ',', '.') . ' VNĐ'; ?>
                         </p>
                    </a>
               </div>
               <?php
                                   }
                              } ?>
          </div>
     </div>

     <!-- phan trang -->
     <div class="pagination">
          <?php
                         $sql_count = "SELECT COUNT(*) AS total FROM sanpham WHERE matheloai = $danhmuc_id";
                         $result_count = mysqli_query($conn, $sql_count);
                         $row_count = mysqli_fetch_assoc($result_count);
                         $total_pages = ceil($row_count['total'] / $products_per_page);

                         for ($i = 1; $i <= $total_pages; $i++) {
                              echo "<a href='index.php?action=chitietsanpham&id=$idsp&page=$i'>$i</a>";
                         }
                         ?>
     </div>

     <form method="post" action="pages/uploadComment.php" style="margin: 20px 0;">
          <textarea id="editor" name="comment" id="" cols="30" rows="10" style="width: 100%; padding: 10px;"></textarea>
          <?php
                         if (isset($_SESSION['dangnhap'])) {
                         ?> <button name="addComment" type="submit"
               style="background-color: blue; color: white; padding: 5px 10px; border-radius: 10px;">Bình
               luận</button>
          <?php } else {
                              echo '<button disabled name="addComment" type="submit" style="background-color: grey; color: white; padding: 5px 10px; border-radius: 10px;">Bình
                                   luận</button> 
                                   <p>Bạn phải đăng nhập để bình luận!</p>
                                   ';
                         } ?>
     </form>

     <?php
                    $sql1 = "SELECT * FROM comments ORDER BY created_at ASC LIMIT 10";
                    $result1 = mysqli_query($conn, $sql1);

                    if (mysqli_num_rows($result1) > 0) {
                         while ($row1 = mysqli_fetch_assoc($result1)) {
                              $timestamp = strtotime($row1['created_at']);
                              $formatted_time = date("h:i A", $timestamp);
                              $user_email = $row1['user_email'];
                              $comment_text = $row1['comment_text'];

                              echo "<div style='margin-bottom: 10px;'>";
                              echo "<div style='border: 1px solid #ccc; padding: 10px;'>";
                              echo "<p style='margin: 0; font-size: 14px; color: #666;'>{$formatted_time}</p>";
                              echo "<span style='font-weight: bold; margin-top: 5px; display: block;'>{$user_email} <span style='font-weight: normal;'>{$comment_text}</span></span>";
                              echo "</div>";
                              echo "</div>";
                         }
                    } else {
                         echo "No comments found.";
                    }

                    ?>
</main>
<?php }
     }
} ?>

<?php
?>