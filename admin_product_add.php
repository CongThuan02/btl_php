<?php
include('admin_header.php');
include('admin_sidebar.php');
?>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f7fc;
        padding: 20px;
    }

    .containers {
        max-width: 1000px; /* Tăng kích thước của form */
        width: 100%;  /* Đảm bảo form chiếm toàn bộ chiều rộng màn hình */
        margin: 0 auto;
        background-color: white;
        padding: 30px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    .title {
        text-align: center;
        font-size: 1.8em;
        font-weight: bold;
        margin-bottom: 20px;
        color: #333;
    }

    .form__group {
        margin-bottom: 20px; /* Tăng khoảng cách giữa các nhóm */
        display: flex;
        flex-direction: column;
    }

    .form__group span {
        font-weight: bold;
        margin-bottom: 10px;
        color: #555;
    }

    input[type="text"],
    textarea,
    select,
    input[type="file"] {
        padding: 12px;
        border-radius: 5px;
        border: 1px solid #ddd;
        font-size: 1em;
        margin-bottom: 15px; /* Tăng khoảng cách giữa các trường */
        transition: all 0.3s ease;
        width: 100%; /* Đảm bảo các input, select chiếm toàn bộ chiều rộng */
    }

    input[type="text"]:focus,
    textarea:focus,
    select:focus {
        border-color: #007bff;
        outline: none;
    }

    input[type="submit"] {
        background-color: #28a745;
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 5px;
        font-size: 1em;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #218838;
    }

    .error-message {
        color: red;
        font-size: 0.9em;
        margin-top: 5px;
        display: block;
    }

    .message {
        padding: 10px;
        color: white;
        border-radius: 5px;
        margin-bottom: 20px;
        font-weight: bold;
    }

    .message.success {
        background-color: green;
    }

    .message.error {
        background-color: red;
    }
</style>

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
            echo "<script>window.open('admin_product_view.php', '_self');</script>";
        } else {
            $message = 'Error: Không thể thêm sản phẩm. ' . mysqli_error($con);
        }
    }
}
?>

<div class="containers">
    <div class="title">Thêm Sản Phẩm</div>

    <!-- Hiển thị thông báo -->
    <div>  
        <?php if (!empty($message)): ?>
            <div class="message <?= strpos($message, 'Error') !== false ? 'error' : 'success'; ?>">
                <?= $message ?>
            </div>
        <?php endif; ?>
    </div>

    <form id="productForm" action="admin_product_add.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
        <div class="form__group">
            <span>Tiêu đề sản phẩm</span>
            <input name="product_title" type="text" value="<?= $_POST['product_title'] ?? ''; ?>" />
            <div id="title_error" class="error-message"></div>
        </div>
        <div class="form__group">
            <span>Loại</span>
            <select name="product_cat" id="product_cat" required>
               
                <?php
                $sql = "SELECT * FROM `product_categories`";
                $res = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($res)) {
                    $selected = ($_POST['product_cat'] ?? '') == $row['p_cat_id'] ? 'selected' : '';
                    echo "<option value='{$row['p_cat_id']}' $selected>{$row['p_cat_title']}</option>";
                }
                ?>
            </select>
            <div id="product_cat_error" class="error-message"></div>
        </div>
        <div class="form__group">
            <span>Danh mục sản phẩm</span>
            <select name="cat" id="cat" required>
               
                <?php
                $sql = "SELECT * FROM `categories`";
                $res = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($res)) {
                    $selected = ($_POST['cat'] ?? '') == $row['cat_id'] ? 'selected' : '';
                    echo "<option value='{$row['cat_id']}' $selected>{$row['cat_title']}</option>";
                }
                ?>
            </select>
            <div id="cat_error" class="error-message"></div>
        </div>
        <div class="form__group">
            <span>Ảnh</span>
            <input name="product_img" type="file" />
            <div id="img_error" class="error-message"></div>
        </div>
        <div class="form__group">
            <span>Giá sản phẩm</span>
            <input name="product_price" type="text" value="<?= $_POST['product_price'] ?? ''; ?>" />
            <div id="price_error" class="error-message"></div>
        </div>
        <div class="form__group">
            <span>Từ khóa sản phẩm</span>
            <input name="product_keywords" type="text" value="<?= $_POST['product_keywords'] ?? ''; ?>" />
            <div id="keywords_error" class="error-message"></div>
        </div>
        <div class="form__group" style="align-items:start;">
            <span>Mô Tả sản phẩm</span>
            <textarea name="product_desc"><?= $_POST['product_desc'] ?? ''; ?></textarea>
            <div id="desc_error" class="error-message"></div>
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

<script>
    // Hàm validate form
    function validateForm() {
        let isValid = true;

        // Xử lý lỗi cho tiêu đề sản phẩm
        let productTitle = document.querySelector('[name="product_title"]').value;
        if (productTitle.trim() === "") {
            document.getElementById('title_error').textContent = "Vui lòng nhập tiêu đề sản phẩm.";
            isValid = false;
        } else {
            document.getElementById('title_error').textContent = "";
        }

        // Xử lý lỗi cho loại sản phẩm
        let productCat = document.getElementById('product_cat').value;
        if (!productCat) {
            document.getElementById('product_cat_error').textContent = "Vui lòng chọn loại sản phẩm.";
            isValid = false;
        } else {
            document.getElementById('product_cat_error').textContent = "";
        }

        // Xử lý lỗi cho danh mục sản phẩm
        let cat = document.getElementById('cat').value;
        if (!cat) {
            document.getElementById('cat_error').textContent = "Vui lòng chọn danh mục.";
            isValid = false;
        } else {
            document.getElementById('cat_error').textContent = "";
        }

        // Xử lý lỗi cho ảnh sản phẩm
        let productImg = document.querySelector('[name="product_img"]').value;
        if (!productImg) {
            document.getElementById('img_error').textContent = "Vui lòng chọn ảnh sản phẩm.";
            isValid = false;
        } else {
            document.getElementById('img_error').textContent = "";
        }

        // Xử lý lỗi cho giá sản phẩm
        let productPrice = document.querySelector('[name="product_price"]').value;
if (productPrice.trim() === "") {
    document.getElementById('price_error').textContent = "Vui lòng nhập giá sản phẩm.";
    isValid = false;
} else if (isNaN(productPrice)) {
    document.getElementById('price_error').textContent = "Giá sản phẩm phải là một số.";
    isValid = false;
} else {
    document.getElementById('price_error').textContent = "";
}

        // Xử lý lỗi cho từ khóa sản phẩm
        let productKeywords = document.querySelector('[name="product_keywords"]').value;
        if (productKeywords.trim() === "") {
            document.getElementById('keywords_error').textContent = "Vui lòng nhập từ khóa sản phẩm.";
            isValid = false;
        } else {
            document.getElementById('keywords_error').textContent = "";
        }

        // Xử lý lỗi cho mô tả sản phẩm
        let productDesc = document.querySelector('[name="product_desc"]').value;
        if (productDesc.trim() === "") {
            document.getElementById('desc_error').textContent = "Vui lòng nhập mô tả sản phẩm.";
            isValid = false;
        } else {
            document.getElementById('desc_error').textContent = "";
        }

        return isValid;
    }
</script>