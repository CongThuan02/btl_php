<!-- Phần xóa mạng xã hội 
Yêu cầu :khi ấn vào nút xóa mạng xã thì sẽ xóa dữ liệu trong bảng network
        :sau khi ấn xóa sẽ chuyển về trang xem
-->
<?php
include('db.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM `network` WHERE id='$id'";
    $res = mysqli_query($con, $sql);
    if ($res) {
        echo "<script>alert('Xóa thành công mạng xã hội')</script>";
        echo "<script>window.open('admin_network_view.php','_self')</script>";
    }
}