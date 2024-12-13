<!-- Phần xóa sản phẩm  
Yêu cầu :khi ấn vào nút xóa sản phẩm  thì sẽ xóa dữ liệu trong bảng product
        :sau khi ấn xóa sẽ chuyển về trang xem
Người làm :Ngô Thị Ánh Tuyết
Fixbug,testing:Lê Minh Phương
-->
<?php
include('db.php');
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $sql = "DELETE FROM `product` WHERE product_id='$product_id'";
    $res = mysqli_query($con, $sql);
    if ($res) {
        echo "<script>alert('Xóa sản phẩm thành công')</script>";
        echo "<script>window.open('admin_product_view.php','_self')</script>";
    }
}