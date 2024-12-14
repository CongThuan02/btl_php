<?php
$active = 'Account';
include('header.php');
?>
<div class="main">
    <div class="shop">
        <div class="shop__container">
            <ul class="shop__breadcroumb">
                <li><a href="index.php">Trang Chủ</a></li>
                <li>Đăng kí</li>
            </ul>
            <?php
            include('sidebar.php');
            ?>
            <div class="register">
                <div class="register__title">
                    Đăng ký
                </div>
                <form action="register.php" method="post" class="register__form" onsubmit="return validateForm()">
    <label>
        Tên của bạn*
    </label>
    <input name="user_name" id="user_name"  type="text" placeholder="Nhập tên của bạn">
    <span id="name-error" style="color: red; display: none;">Vui lòng nhập tên của bạn</span>

    <label>
        Email của bạn*
    </label>
    <input name="user_email" id="user_email"  type="text" placeholder="Nhập Email">
    <span id="email-error" style="color: red; display: none;">Vui lòng nhập Email hợp lệ</span>

    <label>
        Mật khẩu*
    </label>
    <input name="user_pass" id="user_pass"  type="password" placeholder="Nhập mật khẩu mới">
    <span id="pass-error" style="color: red; display: none;">Vui lòng nhập mật khẩu</span>

    <label>
        Mật khẩu*
    </label>
    <input name="user_pass_2" id="user_pass_2"  type="password" placeholder="Nhập lại mật khẩu">
    <span id="pass2-error" style="color: red; display: none;">Mật khẩu không khớp</span>

    <label>
        Số điện thoại*
    </label>
    <input id="user_phone" name="user_phone"  type="text" placeholder="Nhập số điện thoại" maxlength="10" minlength="10">
    <span id="phone-error" style="color: red; display: none;">Số điện thoại không hợp lệ. Vui lòng nhập lại số điện thoại Việt Nam hợp lệ.</span>

    <button type="submit" name="submit" class="btn">Đăng kí</button>
</form>
            </div>
        </div>
    </div>
</div>
<?php

include('footer.php');

?>
<?php
if (isset($_POST['submit'])) {
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_pass = md5($_POST['user_pass']);
    $user_pass_2 = md5($_POST['user_pass_2']);
    $user_phone = $_POST['user_phone'];
    $user_ip = getRealIpUser();
    if ($user_pass == $user_pass_2) {
        $sql = "INSERT INTO `user`(user_name,user_email,user_pass,user_phone,user_ip)
        VALUES ('$user_name','$user_email','$user_pass','$user_phone','$user_ip')
        ";
        // echo $sql;
        $res = mysqli_query($con, $sql);
        $sql_2 = "SELECT * FROM cart WHERE ip_add='$user_ip'";
        $res_2 = mysqli_query($con, $sql_2);
        $count = mysqli_num_rows($res_2);
        if ($count > 0) {
            // nếu chưa từng đăng kí thì sẽ trả về trang checkout
            $_SESSION['user_email'] = $user_email;
            echo "<script>alert('Bạn đã được đăng ký thành công')</script>";
            echo "<script>window.open('checkout.php','_self')</script>";
        } else {
            // nếu đã từng đăng kí thì sẽ trả về trang index
            $_SESSION['user_email'] = $user_email;
            echo "<script>alert('Bạn đã được đăng ký thành công')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        }
    } else {
        echo "<script>alert('Bạn đã nhập pass không trùng nhau')</script>";
        echo "<script>window.open('register.php','_self')</script>";
    }
}
?>

<script>
// JavaScript function to validate all form fields
function validateForm() {
    var valid = true;

    // Validate Name
    var name = document.getElementById('user_name').value;
    var nameError = document.getElementById('name-error');
    if (name.trim() === "") {
        nameError.style.display = 'inline';
        valid = false;
    } else {
        nameError.style.display = 'none';
    }

    // Validate Email
    var email = document.getElementById('user_email').value;
    var emailError = document.getElementById('email-error');
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern.test(email)) {
        emailError.style.display = 'inline';
        valid = false;
    } else {
        emailError.style.display = 'none';
    }

    // Validate Password
    var password = document.getElementById('user_pass').value;
    var passwordError = document.getElementById('pass-error');
    if (password.trim() === "") {
        passwordError.style.display = 'inline';
        valid = false;
    } else {
        passwordError.style.display = 'none';
    }

    // Validate Confirm Password
    var confirmPassword = document.getElementById('user_pass_2').value;
    var confirmPasswordError = document.getElementById('pass2-error');
    if (confirmPassword !== password) {
        confirmPasswordError.style.display = 'inline';
        valid = false;
    } else {
        confirmPasswordError.style.display = 'none';
    }

    // Validate Phone Number
    var phone = document.getElementById('user_phone').value;
    var phoneError = document.getElementById('phone-error');
    var phonePattern = /^(03|04|05|07|08|09)[0-9]{8}$/;
    if (!phonePattern.test(phone)) {
        phoneError.style.display = 'inline';
        valid = false;
    } else {
        phoneError.style.display = 'none';
    }

    return valid; // Return false to prevent form submission if validation fails
}
</script>