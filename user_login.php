<?php
include('sidebar.php');
?>
<div class="login">
    <div class="login__title">
        <h3>
            đăng nhập
        </h3>
        <h5>
            Đã có tài khoản của chúng tôi ..?
        </h5>
    </div>
    <form method="post" class="register__form">
        <label>
            Email
        </label>
        <input type="text" name="user_email" placeholder="Nhập Email">
        <label>
            Mật khẩu
        </label>
        <input type="password" name="user_pass" placeholder="Nhập mật khẩu ">
        <button class="button" name="submit" type="submit">Đăng nhập</button>
    </form>
    <a href="register.php">
        Không có tài khoản ..? Đăng ký ở đây
    </a>
    <a href="user_forgot.php">
        Quên mật khẩu
    </a>
</div>
</div>
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
    // nếu sai mật khẩu hoặc email thì thoát ra
    if ($count == 0) {
        echo "<script>alert('Email hoặc mật khẩu của bạn sai')</script>";
        exit();
    }
    // nếu đăng nhập chưa có địa chỉ ip thì
    if ($count == 1 and $count_2 == 0) {
        $_SESSION['user_email'] = $user_email;
        echo "<script>alert('Bạn đã đăng nhập thành công')</script>";
        echo "<script>window.open('checkout.php?my_orders','_self')</script>";
    } else {
        $_SESSION['user_email'] = $user_email;
        echo "<script>alert('Bạn đã đăng nhập thành công')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
    }
}
?>