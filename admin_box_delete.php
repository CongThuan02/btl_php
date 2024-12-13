<!-- Phần xóa khối 
Yêu cầu :khi ấn vào nút xóa khối thì sẽ xóa dữ liệu trong bảng box
        :sau khi ấn xóa sẽ chuyển về trang xem
-->
<?php
include('db.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM `box` WHERE id='$id'";
    $res = mysqli_query($con, $sql);
    if ($res) {
        echo "<script>alert('Xóa thành công khối')</script>";
        echo "<script>window.open('admin_box_view.php','_self')</script>";
    }
}