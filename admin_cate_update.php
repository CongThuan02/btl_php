<?php
include('admin_header.php');
include('admin_sidebar.php');
?>

<div class="containers">
    <div class="title">Chỉnh sửa danh mục sản phẩm</div>
    <form action="admin_cate_update.php" method="post" onsubmit="return validateForm()">
        <?php
        if (isset($_GET['cat_id'])) {
            $cat_id = $_GET['cat_id'];
            $sql = "SELECT * from `categories` where cat_id='$cat_id'";
            $res = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($res);
            $cat_title = $row['cat_title'];
            $cat_desc = $row['cat_desc'];
        ?>
        
        <div class="form__group">
            <label for="cat_title">Tiêu đề danh mục sản phẩm</label>
            <input type="text" name="cat_title" id="cat_title"  value="<?php echo $cat_title; ?>">
            <div id="error_cat_title" class="error-message"></div>
        </div>

        <div class="form__group">
            <label for="cat_desc">Mô tả danh mục sản phẩm</label>
            <input type="text" name="cat_desc" id="cat_desc"  value="<?php echo $cat_desc; ?>">
            <div id="error_cat_desc" class="error-message"></div>
        </div>

        <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>">

        <div class="form__group">
            <input type="submit" name="submit" value="Cập nhật danh mục" class="btn-submit">
        </div>
        <?php
        }
        ?>
    </form>
</div>

<?php
include('admin_footer.php');
?>

<?php
if (isset($_POST['submit'])) {
    $cat_id = $_POST['cat_id'];
    $cat_title = $_POST['cat_title'];
    $cat_desc = $_POST['cat_desc'];

    // Cập nhật thông tin danh mục sản phẩm
    $sql = "UPDATE `categories` SET cat_title='$cat_title', cat_desc='$cat_desc' WHERE cat_id='$cat_id'";
    $res = mysqli_query($con, $sql);

    if ($res) {
        echo "<script>alert('Đổi danh mục sản phẩm thành công')</script>";
        echo "<script>window.open('admin_cate_view.php','_self')</script>";
    }
}
?>

<script>
    // Hàm kiểm tra tính hợp lệ của form
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

    /* Thêm kiểu cho thông báo lỗi */
    .error-message {
        color: red;
        font-size: 12px;
        margin-top: 5px;
    }
</style>