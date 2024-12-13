<!-- Phần xóa đơn đặt hàng
Yêu cầu :khi ấn vào nút xóa đơn đạt hàng thì sẽ xóa dữ liệu trong bảng cart
        :sau khi ấn xóa sẽ chuyển về trang xem

-->
<?php
include('db.php');
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $sql = "UPDATE `order` SET status='Hoàn thành đơn' WHERE order_id='$order_id'";
    $res = mysqli_query($con, $sql);
    if ($res) {
        echo "<script>alert('Xử lý đơn đặt hàng thành công')</script>";
        echo "<script>window.open('admin_order_view.php','_self')</script>";
    }
}