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
                    đăng ký
                </div>
                <form action="register.php" method="post" class="register__form">
                    <label>
                        Tên của bạn*
                    </label>
                    <input name="user_name" required type="text" placeholder="Nhập tên của bạn">
                    <label>
                        Email của bạn*
                    </label>
                    <input name="user_email" required type="email" placeholder="Nhập Email">
                    <label>
                        Mật khẩu*
                    </label>
                    <input name="user_pass" required type="password" placeholder="Nhập mật khẩu mới">
                    <label>
                        Mật khẩu*
                    </label>
                    <input name="user_pass_2" required type="password" placeholder="Nhập lại mật khẩu ">
                    <label>
                        Số điện thoại*
                    </label>
                    <input name="user_phone" required type="text" placeholder="Nhập số điện thoại" maxlength="10"
                        minlength="10">
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