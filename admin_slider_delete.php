<!-- Phần xóa trình chiếu
Yêu cầu :khi ấn vào nút xóa trình chiếu thì sẽ xóa dữ liệu trong bảng slider
        :sau khi ấn xóa sẽ chuyển về trang xem
-->
<?php
include('db.php');
if (isset($_GET['slider_id'])) {
    $slider_id = $_GET['slider_id'];
    $sql = "DELETE FROM `slider` WHERE slider_id='$slider_id'";
    $res = mysqli_query($con, $sql);
    if ($res) {
        echo "<script>alert('Xóa trình chiếu thành công')</script>";
        echo "<script>window.open('admin_slider_view.php','_self')</script>";
    }
}