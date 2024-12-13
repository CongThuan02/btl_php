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
                    Thanh toán ngoại tuyến
                </div>
                <table>
                    <tr>
                        <th>Số tài khoản ngân hàng</th>
                        <th>Họ tên</th>
                        <th>Nội dung</th>
                    </tr>
                    <tr>
                        <td>032854544 -BIDV -Chi nhánh cầu giấy</td>
                        <td>Lê Minh Phương</td>
                        <td>mã hóa đơn</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
include('footer.php');
?>