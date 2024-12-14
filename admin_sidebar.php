<!-- Menu tách từ file index.php 
Yêu cầu :có thể linh hoạt 
        :chỉ đến các file view,css,logout
-->
<div class="navbar">
    <ul>
        <li>
            <a href="admin_index.php"> Bảng điều khiển </a>
        </li>
        <li>
            <a href="admin_product_view.php"> Sản phẩm </a>
        </li>
        <li>
            <a href="admin_cate_view.php">Danh mục </a>
        </li>
        <li>
            <a href="admin_product_cate_view.php"> Thể loại </a>
        </li>
        <!-- <li>
            <a href="admin_slider_view.php"> Trình chiếu </a>
        </li> -->
        <li>
            <a href="admin_order_view.php"> Đơn đặt hàng </a>
        </li>
        <li>
            <a href="admin_pay_view.php"> Thanh toán </a>
        </li>
        <!-- <li>
            <a href="admin_css.php"> Chỉnh sửa CSS </a>
        </li> -->
        <li>
            <a href="admin_user_view.php"> Người dùng</a>
        </li>
        <li>
            <?php
            if (isset($_SESSION['ad_email'])) {
                $ad_email = $_SESSION['ad_email'];
                $sql = "SELECT * from `ad` where ad_email='$ad_email'";
                $res = mysqli_query($con, $sql);
                $row = mysqli_fetch_array($res);
                $permission = $row['permission'];
                if ($permission == 1 || $permission == 2) {
                    echo "
                   <a href='admin_ad_view.php'> Người quản trị viên</a>    
                   ";
                } else {
                    echo "
                    <a href='#' style='cursor:context-menu;'> Người quản trị viên</a>   
                    ";
                }
            }
            ?>
        </li>
        <!-- <li>
            <a href="admin_contact_view.php"> Phản Hồi</a>
        </li>
        <li>
            <a href="admin_box_view.php"> Khối</a>
        </li> -->
        <li>
            <a href="admin_network_view.php"> Mạng xã hội</a>
        </li>
        <li>
            <a href="admin_logout.php"> Đăng xuất</a>
        </li>

    </ul>
</div>