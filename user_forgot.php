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
                <form action="user_forgot.php" method="post" class="register__form">
                    <label>
                        Email của bạn*
                    </label>
                    <input name="user_email" required type="email" placeholder="Nhập Email">
                    <label>
                        Số điện thoại*
                    </label>
                    <input name="user_phone" required type="text" placeholder="Nhập số điện thoại">
                    <button type="submit" name="submit" class="btn">Gửi</button>
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
    $user_email = $_POST['user_email'];
    $user_phone = $_POST['user_phone'];
    $user_ip = getRealIpUser();
    $user_pass = 'nhom6' . (rand(100000, 1000000));
    echo "<script>alert('mật khẩu của bạn là $user_pass')</script>";
    $user_pass = md5($user_pass);
    $sql = "SELECT * FROM `user` where user_phone='$user_phone' and user_email='$user_email'";
    $res = mysqli_query($con, $sql);
    // echo $sql;
    $sql_2 = "UPDATE `user` SET 
    user_pass='$user_pass'
    where user_email='$user_email'
    ";
    $res_2 = mysqli_query($con, $sql_2);
    // echo $sql_2;
}
?>