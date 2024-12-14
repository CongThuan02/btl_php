<?php
include('admin_header.php');
include('admin_sidebar.php');

// Kiểm tra xem có nhận được product_id từ URL hay không
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $sql = "SELECT * FROM `product` WHERE product_id='$product_id'";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($res);

    // Lấy các giá trị từ cơ sở dữ liệu
    $product_title = $row['product_title'];
    $product_desc = $row['product_desc'];
    $product_price = $row['product_price'];
    $product_keywords = $row['product_keywords'];
    $product_img = $row['product_img'];
}

if (isset($_POST['submit'])) {
    $product_id = $_POST['product_id'];
    $product_title = mysqli_real_escape_string($con, $_POST['product_title']);
    $product_desc = mysqli_real_escape_string($con, $_POST['product_desc']);
    $product_price = mysqli_real_escape_string($con, $_POST['product_price']);
    $product_keywords = mysqli_real_escape_string($con, $_POST['product_keywords']);

    // Khởi tạo mảng thông báo lỗi
    $errors = [];

    // Kiểm tra các ô không để trống
    if (empty($product_title)) {
        $errors['product_title'] = "Tiêu đề sản phẩm không được để trống.";
    }
    if (empty($product_desc)) {
        $errors['product_desc'] = "Mô tả sản phẩm không được để trống.";
    }
    if (empty($product_keywords)) {
        $errors['product_keywords'] = "Từ khóa sản phẩm không được để trống.";
    }

    // Kiểm tra giá sản phẩm là số
    if (!is_numeric($product_price) || $product_price <= 0) {
        $errors['product_price'] = "Giá sản phẩm phải là một số hợp lệ và lớn hơn 0.";
    }

    // Nếu có lỗi, hiển thị lại form với thông báo lỗi
    if (!empty($errors)) {
        // Lặp lại form và thông báo lỗi dưới các trường nhập liệu
        echo "<script>";
        foreach ($errors as $field => $message) {
            echo "document.getElementById('error_" . $field . "').innerText = '" . addslashes($message) . "';";
        }
        echo "</script>";
    } else {
        // Kiểm tra và xử lý ảnh mới (như bạn đã làm trước đó)
        if ($_FILES['product_img']['name'] != '') {
            $product_img = $_FILES['product_img']['name'];
            $temp_name = $_FILES['product_img']['tmp_name'];
            move_uploaded_file($temp_name, "./image/$product_img");
        } else {
            // Nếu không có ảnh mới, giữ ảnh cũ
            $sql = "SELECT product_img FROM `product` WHERE product_id = '$product_id'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);
            $product_img = $row['product_img'];
        }

        // Cập nhật thông tin sản phẩm
        $sql = "UPDATE `product` SET 
                product_img='$product_img',
                product_title='$product_title',
                product_desc='$product_desc',
                product_price='$product_price',
                product_keywords='$product_keywords'
                WHERE product_id='$product_id'";

        $res = mysqli_query($con, $sql);

        if ($res) {
            echo "<script>alert('Đổi sản phẩm thành công');</script>";
            echo "<script>window.open('admin_product_view.php','_self');</script>";
        } else {
            echo "<script>alert('Cập nhật sản phẩm thất bại.');</script>";
        }
    }
}
?>
<style>
    /* Cải thiện giao diện của form */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f7fc;
        margin: 0;
        padding: 0;
    }

    .containers {
        width: 60%;
        margin: 30px auto;
        padding: 20px;
        background-color: white;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        box-sizing: border-box;
    }

    .title {
        text-align: center;
        font-size: 28px;
        color: #333;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 10px;
        display: block;
        color: #555;
    }

    .form-group input[type="text"],
    .form-group input[type="number"],
    .form-group input[type="file"],
    .form-group input[type="submit"] {
        width: 100%;
        padding: 12px;
        font-size: 16px;
        border-radius: 6px;
        border: 1px solid #ddd;
        box-sizing: border-box;
        margin-top: 6px;
        background-color: #fff;
        transition: all 0.3s ease;
    }

    .form-group input[type="text"]:focus,
    .form-group input[type="number"]:focus,
    .form-group input[type="file"]:focus {
        border-color: #007bff;
        outline: none;
    }

    .form-group input[type="submit"] {
        background-color: #28a745;
        color: white;
        font-size: 18px;
        cursor: pointer;
        border: none;
    }

    .form-group input[type="submit"]:hover {
        background-color: #218838;
    }

    .form-group .current-image img {
        max-width: 100%;
        height: auto;
        border-radius: 6px;
        margin-top: 10px;
    }

    .form-group .current-image div {
        font-size: 16px;
        color: #666;
        margin-top: 10px;
    }

    .form-group input[type="file"] {
        padding: 8px;
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .containers {
            width: 90%;
        }

        .title {
            font-size: 24px;
        }
    }
</style>
<style>
    .error-message {
        color: red;
        font-size: 12px;
        margin-top: 5px;
    }
</style>

<script>
    // Validate dữ liệu của form bằng JavaScript
    function validateForm() {
        let isValid = true;

        // Lấy giá trị của các ô input
        var product_title = document.getElementById('product_title').value;
        var product_desc = document.getElementById('product_desc').value;
        var product_price = document.getElementById('product_price').value;
        var product_keywords = document.getElementById('product_keywords').value;

        // Xóa thông báo lỗi cũ (nếu có)
        document.getElementById('error_product_title').innerText = '';
        document.getElementById('error_product_desc').innerText = '';
        document.getElementById('error_product_price').innerText = '';
        document.getElementById('error_product_keywords').innerText = '';

        // Kiểm tra các trường nhập liệu không được bỏ trống
        if (product_title == "") {
            document.getElementById('error_product_title').innerText = "Tiêu đề sản phẩm không được để trống.";
            isValid = false;
        }
        if (product_desc == "") {
            document.getElementById('error_product_desc').innerText = "Mô tả sản phẩm không được để trống.";
            isValid = false;
        }
        if (product_keywords == "") {
            document.getElementById('error_product_keywords').innerText = "Từ khóa sản phẩm không được để trống.";
            isValid = false;
        }

        // Kiểm tra giá sản phẩm là số
        if (isNaN(product_price) || product_price <= 0) {
            document.getElementById('error_product_price').innerText = "Giá sản phẩm phải là một số hợp lệ và lớn hơn 0.";
            isValid = false;
        }

        return isValid;
    }
</script>

<form class="containers" action="admin_product_update.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
    <div class="title">Chỉnh sửa sản phẩm</div>

    <div class="form-group">
        <label for="product_title">Tiêu đề sản phẩm</label>
        <input type="text" name="product_title" id="product_title" value="<?= isset($product_title) ? htmlspecialchars($product_title) : '' ?>" >
        <div id="error_product_title" class="error-message"></div>
    </div>

    <div class="form-group">
        <label for="product_desc">Mô tả sản phẩm</label>
        <input type="text" name="product_desc" id="product_desc" value="<?= isset($product_desc) ? htmlspecialchars($product_desc) : '' ?>" >
        <div id="error_product_desc" class="error-message"></div>
    </div>

    <div class="form-group">
        <label for="product_price">Giá sản phẩm</label>
        <input type="number" name="product_price" id="product_price" value="<?= isset($product_price) ? htmlspecialchars($product_price) : '' ?>" >
        <div id="error_product_price" class="error-message"></div>
    </div>

    <div class="form-group">
        <label for="product_keywords">Từ khóa sản phẩm</label>
        <input type="text" name="product_keywords" id="product_keywords" value="<?= isset($product_keywords) ? htmlspecialchars($product_keywords) : '' ?>" >
        <div id="error_product_keywords" class="error-message"></div>
    </div>

    <div class="form-group current-image">
        <label>Ảnh sản phẩm hiện tại</label>
        <?php if (!empty($product_img) && file_exists("./image/$product_img")): ?>
            <div><img src="./image/<?= htmlspecialchars($product_img) ?>" alt="Ảnh sản phẩm"></div>
        <?php else: ?>
            <div>Ảnh không tồn tại.</div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="product_img">Ảnh sản phẩm mới</label>
        <input type="file" name="product_img" id="product_img">
    </div>

    <input type="hidden" name="product_id" value="<?= isset($product_id) ? htmlspecialchars($product_id) : '' ?>">
    
    <div class="form-group">
        <input type="submit" name="submit" value="Cập nhật sản phẩm">
    </div>
</form>

<?php
include('admin_footer.php');
?>