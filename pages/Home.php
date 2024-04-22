<main id="main" class="umine-center container">
     <div class="umine-center-top">
          <div class="slider">
               <div class="list-show">
                    <div class="hero-slider-content-2">
                         <h4 class="animated" style="font-weight: 700; font-size: 25px;">Khuyến mãi cực HOT</h4>
                         <h1 class="animated">Combo Trọn Bộ IELTS</h1>
                         <p class="animated">Khuyến mãi 30% khi mua kèm 3 bộ sách IELTS</p>
                         <p class="buy-now">
                              <a href="#" class="animated" tabindex="-1">Mua Ngay </a>
                              <i class="fa fa-arrow-right"></i>
                         </p>
                    </div>
                    <div class="list-image">
                         <img src="https://hanoibookstore.com/storage/banner-bo-3-minmap-02-1.png" alt="" />
                    </div>

                    <!-- <div class="btns">
                         <div class="btn-left btn"><i class="bx bx-chevron-left"></i></div>
                         <div class="btn-right btn"><i class="bx bx-chevron-right"></i></div>
                    </div>
                    <div class="index-images">
                         <div class="index-item index-item-0 active"></div>
                         <div class="index-item index-item-1"></div>
                         <div class="index-item index-item-2"></div>
                         <div class="index-item index-item-3"></div>
                         <div class="index-item index-item-4"></div> -->
               </div>
          </div>
     </div>
     </div>

     <div class="product-hot">
          <div class="title-hot">
               <h1>Sản Phẩm Hot</h1>
          </div>
          <div class="content-products">
               <?php
               $products_per_page = 10;
               $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
               $start_index = ($current_page - 1) * $products_per_page;

               $sql = "SELECT * FROM sanpham LIMIT $start_index, $products_per_page";

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


     <section class="featured section-padding-60">
          <div class="container">
               <div class="row">
                    <div class="col-lg-3 col-md-6 mb-md-3 mb-lg-0">
                         <div class="banner-left-icon d-flex align-items-center wow fadeIn  h-100   animated"
                              style="visibility: visible;">
                              <div class="banner-icon"><img
                                        src="https://hanoibookstore.com/storage/general/icon-truck.png" alt="icon">
                              </div>
                              <div class="banner-text">
                                   <h3 class="icon-box-title">Miễn Phí Ship</h3>
                                   <p>Đơn hàng trên 1 triệu</p>
                              </div>
                         </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-md-3 mb-lg-0">
                         <div class="banner-left-icon d-flex align-items-center wow fadeIn  h-100   animated"
                              style="visibility: visible;">
                              <div class="banner-icon"><img
                                        src="https://hanoibookstore.com/storage/general/icon-purchase.png" alt="icon">
                              </div>
                              <div class="banner-text">
                                   <h3 class="icon-box-title">Miễn Phí trả hàng</h3>
                                   <p>Trong 30 ngày</p>
                              </div>
                         </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-md-3 mb-lg-0">
                         <div class="banner-left-icon d-flex align-items-center wow fadeIn  h-100   animated"
                              style="visibility: visible;">
                              <div class="banner-icon"><img
                                        src="https://hanoibookstore.com/storage/general/icon-bag.png" alt="icon"></div>
                              <div class="banner-text">
                                   <h3 class="icon-box-title">Nhận ưu đãi 20%</h3>
                                   <p>Khi đăng ký thành viên</p>
                              </div>
                         </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-md-3 mb-lg-0">
                         <div class="banner-left-icon d-flex align-items-center wow fadeIn  h-100   animated"
                              style="visibility: visible;">
                              <div class="banner-icon"><img
                                        src="https://hanoibookstore.com/storage/general/icon-operator.png" alt="icon">
                              </div>
                              <div class="banner-text">
                                   <h3 class="icon-box-title">Hỗ trợ 24/24</h3>
                                   <p>Dịch vụ Hỗ trợ 24/24</p>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </section>


     <div class="best-selling">
          <div class="title-selling">
               <h1>Sản Phẩm Bán Chạy</h1>
          </div>
          <div class="content-products">
               <?php
               $sql = "SELECT * FROM sanpham ORDER BY RAND() LIMIT 5";

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
     <div class="see-more" style="display: flex; justify-content:center;">
          <a style="border-radius: 7px;
    border: none;
    padding: 10px;
    background: #dc323c;
    border: 1px solid rgba(60, 60, 60, 0.115);
    color: #FFF;
    font-weight: 900;
    cursor: pointer;
    margin-top: 20px;
    transition: all .2s linear;" class="btn-payment" href="index.php?action=cuahang">Xem Thêm Sản Phẩm</a
               href="index.php?action=cuahang">
     </div>

</main>