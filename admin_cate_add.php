<?php
include('admin_header.php');
include('admin_sidebar.php');
?>
<style>
    .containers {
        width: 80%;
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

    .btn-submit {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        width: 100%;
        margin-top: 10px;
    }

    .btn-submit:hover {
        background-color: #0056b3;
    }

    /* Thêm hiệu ứng hover cho các input */
    .form__group input:hover {
        border-color: #007bff;
    }
    #error_cat_title, #error_cat_desc{
        color: red;
    }
</style>

<div class="containers">
    <div class="title">Thêm danh mục sản phẩm</div>
    <form action="admin_cate_add.php" method="post" onsubmit="return validateForm()">
        <div class="form__group">
            <label for="cat_title">Tiêu đề danh mục sản phẩm</label>
            <input name="cat_title" type="text" id="cat_title" />
            <div id="error_cat_title" class="error-message"></div>
        </div>
        <div class="form__group">
            <label for="cat_desc">Mô tả danh mục sản phẩm</label>
            <input name="cat_desc" type="text" id="cat_desc" />
            <div id="error_cat_desc" class="error-message"></div>
        </div>
        <div class="form__group">
            <input type="submit" value="Gửi" name="submit" class="btn-submit">
        </div>
    </form>
</div>

<?php
include('admin_footer.php');
?>

<?php
// Xử lý việc lưu dữ liệu sau khi submit
if (isset($_POST['submit'])) {
    $cat_title = $_POST['cat_title'];
    $cat_desc = $_POST['cat_desc'];
    $sql = "INSERT INTO `categories` (cat_title, cat_desc) VALUES ('$cat_title', '$cat_desc')";
    $res = mysqli_query($con, $sql);
    if ($res) {
        echo "<script>alert('Danh mục sản phẩm được thêm thành công ')</script>";
        echo "<script>window.open('admin_cate_view.php','_self')</script>";
    }
}
?>

<script>
    function validateForm() {
        let isValid = true;

        // Lấy giá trị của các ô input
        var cat_title = document.getElementById('cat_title').value;
        var cat_desc = document.getElementById('cat_desc').value;

        // Xóa thông báo lỗi cũ (nếu có)
        document.getElementById('error_cat_title').innerText = '';
        document.getElementById('error_cat_desc').innerText = '';

        // Kiểm tra các trường nhập liệu không được bỏ trống
        if (cat_title == "") {
            document.getElementById('error_cat_title').innerText = "Tiêu đề danh mục sản phẩm không được để trống.";
            isValid = false;
        }
        if (cat_desc == "") {
            document.getElementById('error_cat_desc').innerText = "Mô tả danh mục sản phẩm không được để trống.";
            isValid = false;
        }

        // Trả về giá trị xác nhận việc có lỗi hay không
        return isValid;
    }
</script>
