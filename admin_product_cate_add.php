<?php
include('admin_header.php');
include('admin_sidebar.php');
?>

<div class="containers">
    <div class="title">Thêm Thể Loại Sản Phẩm</div>
    <form action="admin_product_cate_add.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
        <div class="form__group">
            <label for="p_cat_title">Tiêu đề thể loại</label>
            <input id="p_cat_title" name="p_cat_title" type="text"  />
            <div id="error_p_cat_title" class="error-message"></div>
        </div>

        <div class="form__group">
            <label for="p_cat_desc">Mô tả thể loại</label>
            <input id="p_cat_desc" name="p_cat_desc" type="text"  />
            <div id="error_p_cat_desc" class="error-message"></div>
        </div>

        <div class="form__group">
            <input type="submit" value="Gửi" name="submit">
        </div>
    </form>
</div>

<?php
include('admin_footer.php');
?>

<?php
if (isset($_POST['submit'])) {
    $p_cat_title = $_POST['p_cat_title'];
    $p_cat_desc = $_POST['p_cat_desc'];

    // Thêm thể loại vào bảng product_categories
    $sql = "INSERT INTO `product_categories` (p_cat_title, p_cat_desc) 
            VALUES ('$p_cat_title', '$p_cat_desc')";
    $res = mysqli_query($con, $sql);

    if ($res) {
        echo "<script>alert('Thể loại được thêm thành công')</script>";
        echo "<script>window.open('admin_product_cate_view.php','_self')</script>";
    }
}
?>

<script>
    function validateForm() {
        let isValid = true;

        // Lấy giá trị của các ô input
        var p_cat_title = document.getElementById('p_cat_title').value;
        var p_cat_desc = document.getElementById('p_cat_desc').value;

        // Xóa thông báo lỗi cũ (nếu có)
        document.getElementById('error_p_cat_title').innerText = '';
        document.getElementById('error_p_cat_desc').innerText = '';

        // Kiểm tra các trường nhập liệu không được bỏ trống
        if (p_cat_title == "") {
            document.getElementById('error_p_cat_title').innerText = "Tiêu đề thể loại không được để trống.";
            isValid = false;
        }
        if (p_cat_desc == "") {
            document.getElementById('error_p_cat_desc').innerText = "Mô tả thể loại không được để trống.";
            isValid = false;
        }

        return isValid;
    }
</script>

<style>
    .containers {
        width: 60%;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .title {
        text-align: center;
        font-size: 24px;
        color: #333;
        margin-bottom: 20px;
    }

    .form__group {
        margin-bottom: 15px;
    }

    .form__group label {
        display: block;
        font-size: 14px;
        color: #555;
        margin-bottom: 5px;
    }

    .form__group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        box-sizing: border-box;
    }

    .form__group input:focus {
        border-color: #007bff;
        outline: none;
    }

    .form__group input[type="submit"] {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    .form__group input[type="submit"]:hover {
        background-color: #0056b3;
    }

    /* Thêm kiểu cho thông báo lỗi */
    .error-message {
        color: red;
        font-size: 12px;
        margin-top: 5px;
    }
</style>