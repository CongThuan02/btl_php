<?php
$active = 'Account';
include('header.php');
if (!isset($_SESSION['user_email'])) {
    echo "<script>window.open('checkout.php','_self')</script>";
}
?>
<style>
    .error {
    color: red; /* Màu đỏ cho thông báo lỗi */
    font-size: 12px; /* Kích thước chữ */
    margin-top: 5px; /* Khoảng cách giữa trường nhập và thông báo lỗi */
}
</style>
<div class="main">
    <div class="shop">
        <div class="shop__container">
            <ul class="shop__breadcroumb">
                <li><a href="index.php">Trang Chủ</a></li>
                <li>Tài khoản</li>
            </ul>
            <?php
            include('user_sidebar.php')
            ?>
            <div class="user__content">
                <div class="user__title">
                    Đổi mật khẩu
                </div>
                <form method="post" class="user__form" id="change-password-form">
                    <label>
                        Mật khẩu cũ
                    </label>
                    <input type="password" name="user_pass" id="user_pass" placeholder="Nhập mật khẩu cũ">
                    <p id="error-pass" class="error"></p>
                    
                    <label>
                        Mật khẩu mới
                    </label>
                    <input type="password" name="new_pass_1" id="new_pass_1" placeholder="Nhập mật khẩu mới">
                    <p id="error-new-pass-1" class="error"></p>
                    
                    <label>
                        Nhập lại mật khẩu mới
                    </label>
                    <input type="password" name="new_pass_2" id="new_pass_2" placeholder="Nhập lại mật khẩu mới">
                    <p id="error-new-pass-2" class="error"></p>

                    <!-- Thông báo lỗi mật khẩu cũ sẽ được hiển thị ở đây -->
                    <p id="error-old-pass" class="error"></p>
                    
                    <button class="button" name="submit" type="submit">Đổi mật khẩu</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include('footer.php');
?>

<script>
document.getElementById('change-password-form').addEventListener('submit', function(e) {
    let isValid = true;
    
    // Reset error messages
    document.getElementById('error-pass').innerText = '';
    document.getElementById('error-new-pass-1').innerText = '';
    document.getElementById('error-new-pass-2').innerText = '';
    document.getElementById('error-old-pass').innerText = ''; // Reset thông báo lỗi mật khẩu cũ
    
    // Get values
    let userPass = document.getElementById('user_pass').value;
    let newPass1 = document.getElementById('new_pass_1').value;
    let newPass2 = document.getElementById('new_pass_2').value;
    
    // Validate user password (must not be empty)
    if (userPass.trim() === '') {
        document.getElementById('error-pass').innerText = 'Mật khẩu cũ không được để trống';
        isValid = false;
    }
    
    // Validate new password (must not be empty)
    if (newPass1.trim() === '') {
        document.getElementById('error-new-pass-1').innerText = 'Mật khẩu mới không được để trống';
        isValid = false;
    }
    
    // Validate confirm new password (must not be empty)
    if (newPass2.trim() === '') {
        document.getElementById('error-new-pass-2').innerText = 'Nhập lại mật khẩu mới không được để trống';
        isValid = false;
    }
    
    // Check if new passwords match
    if (newPass1 !== newPass2) {
        document.getElementById('error-new-pass-1').innerText = 'Mật khẩu mới lần 2 không trùng với lần 1';
        isValid = false;
    }
    
    // If any validation fails, prevent form submission
    if (!isValid) {
        e.preventDefault();
    }
});
</script>

<?php
if (isset($_POST['submit'])) {
    $user_email = $_SESSION['user_email'];
    $user_pass = md5($_POST['user_pass']); // Mã hóa mật khẩu cũ người dùng nhập
    $new_pass_1 = md5($_POST['new_pass_1']); // Mã hóa mật khẩu mới
    $new_pass_2 = md5($_POST['new_pass_2']); // Mã hóa nhập lại mật khẩu mới

    // Kiểm tra nếu mật khẩu cũ có đúng hay không
    $sql = "SELECT * FROM user WHERE user_email='$user_email' AND user_pass='$user_pass'";
    $res = mysqli_query($con, $sql);
    $count = mysqli_num_rows($res);
    if ($count == 0) {
        // Thông báo lỗi dưới input cuối cùng
        echo "<script>document.getElementById('error-old-pass').innerText = 'Mật khẩu cũ không đúng!';</script>";
        exit();
    }

    // Kiểm tra mật khẩu mới và nhập lại mật khẩu mới có trùng nhau không
    if ($new_pass_1 != $new_pass_2) {
        echo "<script>alert('Mật khẩu mới và nhập lại mật khẩu mới không trùng khớp!')</script>";
        exit();
    }

    // Cập nhật mật khẩu mới vào cơ sở dữ liệu
    $sql_2 = "UPDATE user SET user_pass='$new_pass_1' WHERE user_email='$user_email'";
    $res_2 = mysqli_query($con, $sql_2);
    if ($res_2) {
        echo "<script>alert('Bạn đã thay đổi mật khẩu thành công!')</script>";
        echo "<script>window.open('user_orders.php','_self')</script>";
    } else {
        echo "<script>alert('Có lỗi xảy ra trong quá trình thay đổi mật khẩu.')</script>";
    }
}
?>