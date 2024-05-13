<?php
$sql = "SELECT * FROM theloai";
$result = mysqli_query($conn, $sql);

$categories = array();
while ($row = mysqli_fetch_assoc($result)) {
    $categories[] = $row;
}

// Xây dựng câu truy vấn 

$options1 = ["0", "500000", "1000000", "2000000", "3000000", "4000000", "5000000", "6000000", "7000000", "8000000", "9000000", "10000000", "15000000", "20000000"];
$options2 = ["500000", "1000000", "2000000", "3000000", "4000000", "5000000", "6000000", "7000000", "8000000", "9000000", "10000000", "15000000", "20000000"];

$sql = "SELECT * FROM sanpham";

// Xử lý khi có tham số category được gửi từ form
if (isset($_GET['category'])) {
    $id_cate = $_GET['category'];
    $sql = "SELECT * FROM sanpham where Theloai_ID = $id_cate";
}

if (isset($_POST['category'])) {
    $selected_categories = $_POST['category'];
    $category_ids = implode(',', $selected_categories);
    $sql .= " WHERE Theloai_ID IN ($category_ids)";
}


if (isset($_POST['min_price_select']) && isset($_POST['max_price_select'])) {
    $min_price = $_POST['min_price_select'];
    $max_price = $_POST['max_price_select'];
    $sql = "SELECT * FROM sanpham WHERE Gia BETWEEN $min_price AND $max_price";
}

if (isset($_POST['min_price_select']) && isset($_POST['max_price_select']) && (isset($_POST['category']))) {
    $selected_categories = $_POST['category'];
    $category_ids = implode(',', $selected_categories);
    $min_price = $_POST['min_price_select'];
    $max_price = $_POST['max_price_select'];
    $sql = "SELECT * FROM sanpham WHERE Gia BETWEEN $min_price AND $max_price and  Theloai_ID IN ($category_ids) ";
}

if (isset($_POST['sort'])) {
    $sort_option = $_POST['sort'];
    switch ($sort_option) {
        case 'az':
            $sql .= " ORDER BY tensanpham ASC";
            break;
        case 'za':
            $sql .= " ORDER BY tensanpham DESC";
            break;
        case 'price_asc':
            $sql .= " ORDER BY Gia ASC";
            break;
        case 'price_desc':
            $sql .= " ORDER BY Gia DESC";
            break;

        default:
            break;
    }
}
$result = mysqli_query($conn, $sql);
?>


<div class="container " id="main">

    <div class="hidden-search-item-prd">
        <div>Sắp xếp theo</div>
        <form method="POST" action="index.php?action=cuahang">
            <select name="sort" id="sort-select" class="search-in4-item">
                <option value="">Mặc định</option>
                <option value="latest">Mặt hàng mới nhất</option>
                <option value="az">A <i class='bx bx-arrow-to-right'></i> Z</option>
                <option value="za">Z <i class='bx bx-arrow-to-right'></i> A</option>
                <option value="price_asc">Giá tăng dần</option>
                <option value="price_desc">Giá giảm dần</option>
            </select>
            <input type="submit" value="Sắp xếp" />
        </form>
    </div>

    <div class="flex-store">
        <div class="filter-product">
            <div class="in4-prd">
                <h4>THƯƠNG HIỆU</h4>
                <br />
                <div class="name-prd">
                    <form method="post" action="index.php?action=cuahang">
                        <?php foreach ($categories as $category) : ?>
                            <div class="brand-name">
                                <input type="checkbox" id="<?php echo $category['Theloai_ID']; ?>" name="category[]" value="<?php echo $category['Theloai_ID']; ?>" <?php if (isset($_POST['category']) && in_array($category['Theloai_ID'], $_POST['category'])) echo 'checked'; ?>>
                                <label for="<?php echo $category['Theloai_ID']; ?>"><?php echo $category['TenTheloai']; ?></label>
                            </div>
                        <?php endforeach; ?>
                        <br>
                        <h4>Giá từ</h4>

                        <select name="min_price_select" id="sort-select" class="filter-input">
                            <?php foreach ($options1 as $option) : ?>
                                <option value="<?php echo $option; ?>" <?php if (isset($_POST['min_price_select']) && $_POST['min_price_select'] == $option) echo 'selected'; ?>>
                                    <?php echo number_format($option, 0, '', '.') . 'đ'; ?></option>
                            <?php endforeach; ?>
                        </select>

                        <h4>Đến</h4>
                        <select name="max_price_select" id="sort-select" class="filter-input">
                            <?php foreach ($options2 as $option) : ?>
                                <option value="<?php echo $option; ?>" <?php if (isset($_POST['max_price_select']) && $_POST['max_price_select'] == $option) echo 'selected'; ?>>
                                    <?php echo number_format($option, 0, '', '.') . 'đ'; ?></option>
                            <?php endforeach; ?>
                        </select>

                        <input type="submit" name="loc" value="Lọc sản phẩm" class="btn-prd-price" />
                    </form>
                </div>
            </div>

        </div>

        <div class="contents-products">
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
                                <!-- <a href="pages/addProduct.php?idsp=<?php echo $product['ID'] ?>" class="cart-popup" name="addProduct"><i class='bx bx-cart-add'></i></a> -->
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
</div>