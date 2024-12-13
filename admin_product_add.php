<?php
include('admin_header.php');
include('admin_sidebar.php');
?>
<?php
$message = ''; // Biến lưu thông báo

if (isset($_POST['submit'])) {
    $product_title = $_POST['product_title'];
    $product_cat = $_POST['product_cat'] ?? null;
    $cat = $_POST['cat'] ?? null;
    $product_price = $_POST['product_price'];
    $product_keywords = $_POST['product_keywords'];
    $product_desc = $_POST['product_desc'];
    $product_img = $_FILES['product_img']['name'];
    $temp_name = $_FILES['product_img']['tmp_name'];

    // Kiểm tra các trường bắt buộc
    if (empty($product_cat)) {
        $message = 'Error: Bạn phải chọn một loại sản phẩm.';
    } elseif (empty($cat)) {
        $message = 'Error: Bạn phải chọn một danh mục.';
    } elseif (empty($product_title) || empty($product_price) || empty($product_keywords) || empty($product_desc)) {
        $message = 'Error: Vui lòng điền đầy đủ thông tin.';
    } elseif (empty($product_img)) {
        $message = 'Error: Bạn phải chọn một ảnh sản phẩm.';
    } elseif (!move_uploaded_file($temp_name, "image/$product_img")) {
        $message = 'Error: Không thể tải lên ảnh sản phẩm.';
    } else {
        // Chèn dữ liệu vào database
        $sql = "INSERT INTO product (p_cat_id, cat_id, date, product_title, product_img, product_price, product_keywords, product_desc) 
                VALUES ('$product_cat', '$cat', NOW(), '$product_title', '$product_img', '$product_price', '$product_keywords', '$product_desc')";
        $res = mysqli_query($con, $sql);

        if ($res) {
            $message = 'Sản phẩm được thêm thành công.';
            // Chuyển hướng về trang hiện tại để reset form
            echo "<script>
                    alert('Sản phẩm được thêm thành công.');
                    window.location.href = window.location.href;
                  </script>";
        } else {
            $message = 'Error: Không thể thêm sản phẩm. ' . mysqli_error($con);
        }
    }
}
?>
<div class="container">
    <div class="title">Thêm Sản Phẩm</div>

    <!-- Hiển thị thông báo -->
    <?php if (!empty($message)): ?>
        <div style="margin-bottom: 20px; padding: 10px; color: white; background-color: <?= strpos($message, 'Error') !== false ? 'red' : 'green'; ?>;">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <form id="productForm" action="admin_product_add.php" method="post" enctype="multipart/form-data">
        <div class="form__group">
            <span>Tiêu đề sản phẩm</span>
            <input name="product_title" type="text" value="<?= $_POST['product_title'] ?? ''; ?>" required />
        </div>
        <div class="form__group">
            <span>Loại</span>
            <select name="product_cat" required>
                <option selected disabled>Chọn Loại</option>
                <?php
                $sql = "SELECT * FROM `product_categories`";
                $res = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($res)) {
                    $selected = ($_POST['product_cat'] ?? '') == $row['p_cat_id'] ? 'selected' : '';
                    echo "<option value='{$row['p_cat_id']}' $selected>{$row['p_cat_title']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form__group">
            <span>Danh mục sản phẩm</span>
            <select name="cat" required>
                <option selected disabled>Chọn Danh Mục</option>
                <?php
                $sql = "SELECT * FROM `categories`";
                $res = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($res)) {
                    $selected = ($_POST['cat'] ?? '') == $row['cat_id'] ? 'selected' : '';
                    echo "<option value='{$row['cat_id']}' $selected>{$row['cat_title']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form__group">
            <span>Ảnh</span>
            <input name="product_img" type="file" required />
        </div>
        <div class="form__group">
            <span>Giá sản phẩm</span>
            <input name="product_price" type="text" value="<?= $_POST['product_price'] ?? ''; ?>" required />
        </div>
        <div class="form__group">
            <span>Từ khóa sản phẩm</span>
            <input name="product_keywords" type="text" value="<?= $_POST['product_keywords'] ?? ''; ?>" required />
        </div>
        <div class="form__group" style="align-items:start;">
            <span>Mô Tả sản phẩm</span>
            <textarea name="product_desc" required><?= $_POST['product_desc'] ?? ''; ?></textarea>
        </div>
        <div class="form__group">
            <span></span>
            <input type="submit" value="Gửi" name="submit">
        </div>
    </form>
</div>

<?php
include('admin_footer.php');


?>