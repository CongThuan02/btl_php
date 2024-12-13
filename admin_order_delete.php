<!-- Phần xóa đơn đặt hàng
Yêu cầu :khi ấn vào nút xóa đơn đạt hàng thì sẽ xóa dữ liệu trong bảng cart
        :sau khi ấn xóa sẽ chuyển về trang xem

-->
<?php
include('db.php');
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $sql = "DELETE FROM `order` WHERE order_id='$order_id'";
    $res = mysqli_query($con, $sql);
    if ($res) {
        echo "<script>alert('Xóa đơn đặt hàng thành công')</script>";
        echo "<script>window.open('admin_order_view.php','_self')</script>";
    }
}