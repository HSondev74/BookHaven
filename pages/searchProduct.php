<?php
if (isset($_POST['keyword'])) {
     $keyWord = $_POST['keyword'];
} else {
     $keyWord = '';
}

if (isset($_POST['Categories'])) {
     $categoryId = $_POST['Categories'];
} else {
     $categoryId = '';
}

$sql = "SELECT * FROM sanpham WHERE Ten LIKE '%" . $keyWord . "%'";


// Nếu có danh mục được chọn, thêm điều kiện lọc theo danh mục vào câu truy vấn SQL
if (!empty($categoryId)) {
     $sql .= " AND Theloai_ID = " . $categoryId;
}
$result = mysqli_query($conn, $sql);
$new = mysqli_fetch_assoc($result);

?>
<div id="main" class="container">
     <div class="product-hot">
          <div class="title-hot">
               <h1>Sản Phẩm Tìm Thấy</h1>
          </div>
          <div class="content-products">
               <?php
               if ($result->num_rows > 0) {
                    while ($product = $result->fetch_assoc()) {
                         $images = $product['Hinhanh'];
               ?>

                         <div class="product">
                              <a href="index.php?action=chitietsanpham&id=<?php echo $product['Sanpham_ID']; ?>">

                                   <div class="discount"> -20% </div>
                                   <div class="product-image">
                                        <img src="admin/Dashboard/layout/quanlysanpham/uploads/<?php echo $images; ?>" alt="">
                                        <!-- <a href="pages/addProduct.php?idsp=<?php echo $product['Sanpham_ID'] ?>" class="cart-popup" name="addProduct"><i class='bx bx-cart-add'></i></a> -->
                                   </div>
                                   <span class="heart-product" onclick="changeFavorites(this,<?php echo $product['Sanpham_ID']; ?>)" data-id="<?php echo $product['Sanpham_ID']; ?> "><i class='bx bxs-heart'></i></span>
                                   <p class=" product-title"><?php echo $product['Ten'] ?></p>
                                   <p class="product-price"><?php
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

</div>