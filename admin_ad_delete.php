<!-- Phần xóa admin 
Yêu cầu :khi ấn vào nút xóa admin thì sẽ xóa dữ liệu trong bảng ad
        :sau khi ấn xóa sẽ chuyển về trang xem
-->
<?php
include('db.php');
if (isset($_GET['ad_id'])) {
    $ad_id = $_GET['ad_id'];
    $sql = "DELETE FROM `ad` WHERE ad_id='$ad_id'";
    $res = mysqli_query($con, $sql);
    if ($res) {
        echo "<script>alert('Xóa thành công quản trị viên')</script>";
        echo "<script>window.open('admin_ad_view.php','_self')</script>";
    }
}