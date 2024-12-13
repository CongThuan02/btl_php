<!-- Phần xóa thể loại  
Yêu cầu :khi ấn vào nút xóa thể loại thì sẽ xóa dữ liệu trong bảng product_categories
        :sau khi ấn xóa sẽ chuyển về trang xem
-->
<?php
    include('db.php');
    if (isset($_GET['p_cat_id'])) {
        $p_cat_id = $_GET['p_cat_id'];
        $sql = "DELETE FROM `product_categories` WHERE p_cat_id='$p_cat_id'";
        $res = mysqli_query($con, $sql);
        if ($res) {
            echo "<script>alert('Xóa thể loại thành công')</script>";
            echo "<script>window.open('admin_product_cate_view.php','_self')</script>";
        }
    }