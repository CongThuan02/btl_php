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
                    Xóa tài khoản
                </div>
                <form method="post" action="user_delete.php">
                    <input style="background-color:red; color:white;cursor: pointer;" type="submit" name="Yes" value="Đồng ý xóa tài khoản">
                    <input style="background-color:green; cursor: pointer;" type="submit" name="No" value="Không,tôi không muốn xóa tài khoản">
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include('footer.php');
?>
<?php
$user_email = $_SESSION['user_email'];
if (isset($_POST['Yes'])) {
    $sql = "DELETE from user where user_email='$user_email'";
    $res = mysqli_query($con, $sql);
    if ($res) {
        session_destroy();
        echo "<script>alert('Bạn đã xóa tài khoản thành công')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    }
}
if (isset($_POST['No'])) {

    echo "<script>window.open('user_order.php','_self')</script>";
}
?>