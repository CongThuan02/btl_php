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
                    Đơn đặt hàng
                </div>
                <table>
                    <tr>
                        <th>STT</th>
                        <th>Số tiền</th>
                        <th>Hóa đơn</th>
                        <th>Số lượng</th>
                        <th>Kích thước</th>
                        <th>Ngày đặt hàng</th>
                        <th>Thanh toán</th>
                        <th>Trạng thái</th>
                    </tr>
                    <?php
                    $user_email = $_SESSION['user_email'];
                    $sql = "SELECT * FROM user WHERE user_email='$user_email'";
                    // echo $sql;
                    $res = mysqli_query($con, $sql);
                    $row = mysqli_fetch_array($res);
                    $user_id = $row['user_id'];
                    $sql_2 = "SELECT * FROM `order` WHERE user_id='$user_id'";
                    // echo $sql_2;
                    $res_2 = mysqli_query($con, $sql_2);
                    $i = 0;
                    while ($row_2 = mysqli_fetch_array($res_2)) {
                        $order_id = $row_2['order_id'];
                        // Tiền
                        $money = $row_2['money'];
                        // Hóa đơn
                        $receipt = $row_2['receipt'];
                        // Số lượng
                        $qty = $row_2['qty'];
                        // Kích thước
                        $size = $row_2['size'];
                        // Ngày đặt hàng
                        $date = substr($row_2['date'], 0, 11);
                        echo $date;
                        // Thanh toán
                        $status = $row_2['status'];
                        $i++;
                        // Trạng thái
                        if ($status == 'pending') {
                            $status = 'Chưa trả';
                        } else {
                            $status = 'Trả';
                        }
                        echo "
                            <tr>
                            <td>$i</td>
                            <td>$money VND</td>
                            <td>$receipt</td>
                            <td>$qty</td>
                            <td>$size</td>
                            <td>$date</td>
                            <td>$status</td>
                            <td>
                                <a href='user_order-pay.php?order_id=$order_id'>
                                    <button>
                                        Xác nhận đã thanh toán
                                    </button>
                                </a>
                                </td>
                                </tr>
                            ";
                    } ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
include('footer.php');
?>