<?php
include('sidebar.php');
?>
<style>
    /* CSS để checkbox và label hiển thị trên cùng một dòng */
    .checkbox-container {
        align-items: center;
        margin-top: 10px;
    }
    .error-message {
        color: red;
        font-size: 12px;
        display: none;
    }
</style>

<div class="login">
    <div class="login__title">
        <h3>Đăng nhập</h3>
        <h5>Đã có tài khoản của chúng tôi ..?</h5>
    </div>
    <form method="post" class="register__form" onsubmit="return validateForm()">
        <label>Email</label>
        <input type="text" name="user_email" id="user_email" placeholder="Nhập Email">
        <div id="email_error" class="error-message">Vui lòng nhập email hợp lệ.</div>

        <label>Mật khẩu</label>
        <input type="password" name="user_pass" id="password" placeholder="Nhập mật khẩu">
        <div id="password_error" class="error-message">Vui lòng nhập mật khẩu.</div>



        <!-- Thông báo lỗi sẽ được hiển thị dưới checkbox -->
        <div id="error_message" class="error-message">Email hoặc mật khẩu của bạn sai</div>

        <button class="button" name="submit" type="submit">Đăng nhập</button>
    </form>
    <a href="register.php">Không có tài khoản ..? Đăng ký ở đây</a>
    <a href="user_forgot.php">Quên mật khẩu</a>
</div>

<script>
    // Hàm để toggle hiển thị mật khẩu
    function togglePassword() {
        var passwordField = document.getElementById("password");
        var checkbox = document.getElementById("show_password");
        if (checkbox.checked) {
            passwordField.type = "text"; // Hiển thị mật khẩu
        } else {
            passwordField.type = "password"; // Ẩn mật khẩu
        }
    }

    // Hàm validate form trước khi submit
    function validateForm() {
        var email = document.getElementById("user_email").value;
        var password = document.getElementById("password").value;
        var isValid = true;

        // Validate email
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (!emailPattern.test(email)) {
            document.getElementById("email_error").style.display = "block";
            isValid = false;
        } else {
            document.getElementById("email_error").style.display = "none";
        }

        // Validate password
        if (password === "") {
            document.getElementById("password_error").style.display = "block";
            isValid = false;
        } else {
            document.getElementById("password_error").style.display = "none";
        }

        return isValid; // Nếu form không hợp lệ, sẽ không submit
    }
</script>

<?php
if (isset($_POST['submit'])) {
    $user_email = $_POST['user_email'];
    $user_pass = md5($_POST['user_pass']);
    $sql = "SELECT * FROM user WHERE user_email='$user_email' AND user_pass='$user_pass'";
    $res = mysqli_query($con, $sql);
    $add_ip = getRealIpUser();
    $count = mysqli_num_rows($res);
    $sql_2 = "select * from cart where ip_add='$add_ip'";
    $res_2 = mysqli_query($con, $sql_2);
    $count_2 = mysqli_num_rows($res_2);

    // Nếu sai mật khẩu hoặc email thì thông báo lỗi
    if ($count == 0) {
        echo "<script>
                document.getElementById('error_message').style.display = 'block';
              </script>";
        exit();
    }

    // Đăng nhập thành công
    if ($count == 1 && $count_2 == 0) {
        $_SESSION['user_email'] = $user_email;
        $user_query = "SELECT * FROM user WHERE user_email='$user_email'";
        $user_result = mysqli_query($con, $user_query);
        $user_data = mysqli_fetch_assoc($user_result);
        $_SESSION['user_name'] = $user_data['user_name'];
       
        echo "<script>window.open('user_orders.php','_self')</script>";
    } else {
        $_SESSION['user_email'] = $user_email;
        $user_query = "SELECT * FROM user WHERE user_email='$user_email'";
        $user_result = mysqli_query($con, $user_query);
        $user_data = mysqli_fetch_assoc($user_result);
        $_SESSION['user_name'] = $user_data['user_name'];
        
        echo "<script>window.open('cart.php','_self')</script>";
    }
}
?>