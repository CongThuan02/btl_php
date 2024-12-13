<?php
$active = 'Account';
include('header.php');
if (!isset($_SESSION['user_email'])) {
    echo "<script>window.open('checkout.php','_self')</script>";
}
?>
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
                <form method="post" class="user__form">
                    <label>
                        Mật khẩu cũ
                    </label>
                    <input type="password" required name="user_pass" placeholder="Nhập mật khẩu cũ">
                    <label>
                        Mật khẩu mới
                    </label>
                    <input type="password" required name="new_pass_1" placeholder="Nhập mật khẩu mới">
                    <label>
                        Nhập lại mật khẩu mới
                    </label>
                    <input type="password" required name="new_pass_2" placeholder=" Nhập lại mật khẩu mới ">
                    <button class="button" name="submit" type="submit">Đổi mật khẩu</button>
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
    $user_email = $_SESSION['user_email'];
    $user_pass = $_POST['user_pass'];
    $new_pass_1 = $_POST['new_pass_1'];
    $new_pass_2 = $_POST['new_pass_2'];
    $sql = "SELECT * FROM user where user_pass='$user_pass'";
    $res = mysqli_query($con, $sql);
    $count = mysqli_fetch_array($res);
    if ($count == 0) {
        echo "<script>alert('Bạn đã nhập sai mật khẩu cũ')</script>";
        exit();
    }
    if ($new_pass_1 != $new_pass_2) {
        echo "<script>alert('Mật khẩu mới lần 2 không trùng với lần 1')</script>";
        exit();
    }
    $sql_2 = "UPDATE user set user_pass='$new_pass_1' where user_email='$user_email'";
    $res_2 = mysqli_query($con, $sql_2);
    if ($res_2) {
        echo "<script>alert('Bạn đã thay đổi mật khẩu')</script>";
        echo "<script>window.open('user_order.php','_self')</script>";
    }
}
?>