<!-- 
Phần giỏ hàng 
Yêu cầu :Hiện ra số lượng sản phẩm có trong giỏ hàng
        :In ra thông tin những sản phẩm đang có trong giỏ hàng
        :Tính tổng giá tiền 1 sản phẩm 
        :Tính tổng giá tiền các sản phẩm
        :Xóa sản phẩm khi chọn xóa và cập nhật lại giỏ hàng 
        :Chọn ngẫu nhiên 3 sản phẩm bên dưới để người dùng ấn xem
 -->
<?php
$active = 'Cart';
include('header.php')

?>
    <?php
    $user_email = $_SESSION['user_email'];
    $sql = "SELECT * FROM user WHERE user_email='$user_email'";
    $res = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($res);
    $user_id = $row['user_id'];
    ?>
<div class="main">
    <div class="shop">
        <div class="shop__container">
            <ul class="shop__breadcroumb">
                <li><a href="index.php">Trang Chủ</a></li>
                <li>Giỏ Hàng</li>
            </ul>
            <form action="cart.php" method="post" enctype="multipart/form-data" class="cart">
                <div class="cart__left">
                    <div class="cart__title">
                        <h1>Cửa Hàng</h1>
                    </div>
                    <div class="cart__desc">
                        <?php
                        $ip_add = getRealIpUser();
                        $sql = "select * from cart where ip_add='$ip_add'";
                        $res = mysqli_query($con, $sql);
                        $count = mysqli_num_rows($res);
                        ?>
                        <span>Bạn đã có <?php echo $count ?> sản phẩm trong giỏ hàng</span>
                    </div>
                    <div class="cart__table">
                        <table>
                            <tr>
                                <th colspan="5">Sản Phẩm</th>
                    
                                <th>Giá tiền/chiếc</th>
                            
                                <th>Xóa</th>
                                <th>Tổng tiền</th>
                            </tr>

                            <?php
                            $total = 0;
                            while ($row = mysqli_fetch_array($res)) {
                                $product_id = $row['p_id'];
                             
                                $sql_2 = "select * from product where product_id='$product_id'";
                                $res_2 = mysqli_query($con, $sql_2);
                                while ($row_2 = mysqli_fetch_array($res_2)) {
                                    $product_title = $row_2['product_title'];
                                    $product_img = $row_2['product_img'];
                                    $only_price = $row_2['product_price'];
                                    $sub_total = $row_2['product_price'] * $qty;
                                    $total += $sub_total;
                                }
                                echo "
                            <tr>
                            <td colspan='4'>
                                <a href='details.php?product_id=$product_id'>
                                    <img src='./image/$product_img' alt=''>
                                </a>
                            </td>
                            <td>
                                <a href='details.php?product_id=$product_id;'>
                                    $product_title
                                </a>
                            </td>
                            
                            <td>$only_price Triệu</td>
                           
                            <td>
                            <input id='delete__$product_id' type='checkbox' name='remove[]' value='$product_id;'>
                            <label for='delete__$product_id'>Xóa</label>
                            </td>
                            <td>
                               $sub_total Triệu
                            </td>
                        </tr>
 ";
                            }

                            ?>

                            <tr>
                                <th colspan="3">Tổng toàn bộ</th>
                                <th colspan="4"></th>
                                <th colspan="3"><?php echo $total; ?></th>
                            </tr>
                        </table>
                        <div class="cart__button">
                            <div class="cart__continue">
                                <a href="index.php">
                                    <button type="button">
                                        <i class="fa fa-angle-left"></i>

                                        <span> Tiếp tục mua hàng</span>
                                    </button>
                                </a>
                            </div>
                            <div class="cart__up">
                                <div class="cart__update">
                                    <a href="details.php">
                                        <button type="submit" name="update">
                                            <i class="fa fa-refresh"></i>
                                            <span>
                                                Cập nhật giỏ hàng
                                            </span>
                                        </button>
                                    </a>
                                </div>
                                <?php
if (isset($_POST['update']) && isset($_POST['remove'])) {
    // Kiểm tra xem mảng 'remove' có tồn tại và có phần tử không
    foreach ($_POST['remove'] as $remove_id) {
        // Loại bỏ dấu chấm phẩy và các ký tự không hợp lệ khác
        $remove_id = rtrim($remove_id, ';');
        
        // Kiểm tra xem $remove_id có phải là số hợp lệ không
        if (is_numeric($remove_id)) {
            $sql = "DELETE FROM cart WHERE p_id='$remove_id'";
            $res = mysqli_query($con, $sql);
            if ($res) {
                echo "<script>window.open('cart.php','_self')</script>";
            }
        }
    }
}
?>
                                <div class="cart__checkout">
                                    <a href="user_order.php?user_id=<?php echo $user_id ?>">
                                        <button type="button">
                                            <span>
                                                Thêm vào giỏ hàng
                                            </span>
                                            <i class="fa fa-angle-right"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cart__right">
                    <div class="order">
                        <div class="order__title">
                            Tóm tắt theo thứ tự
                        </div>
                        <div class="order__desc">
                            Chi phí vận chuyển và chi phí bổ sung được tính dựa trên giá trị bạn đã nhập
                        </div>
                        <div class="order__sub">
                            <span>Đặt hàng Tất cả Tổng phụ</span>
                            <p><?php echo $total; ?> Triệu</p>
                        </div>
                        <div class="order__shipping">
                            <span>Vận chuyển và Xử lý</span>
                            <p>0 Triệu</p>
                        </div>
                        <div class="order__tax">
                            <span>Thuế</span>
                            <p>0 Triệu</p>
                        </div>
                        <div class="order__total">
                            <span>Toàn bộ</span>
                            <p><?php echo $total; ?> Triệu</p>
                        </div>
                    </div>
                </div>
                <div class="cart__like">
                    <div class="cart__box">
                        có thể bạn thích sản phẩm này
                    </div>
                    <?php

                    $sql = "select * from product order by rand() LIMIT 0,3";
                    $res = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_array($res)) {
                        $product_id = $row['product_id'];
                        $product_title = $row['product_title'];
                        $product_price = $row['product_price'];
                        $product_img = $row['product_img'];
                        echo "
                        <div class='cart__product'>
                            <a href='details.php?product_id=$product_id'>
                                <img src='image/$product_img' alt=''>
                            </a>
                            <div class='cart__text'>
                            <a href='details.php?product_id=$product_id'>
                                <h3>
                                    $product_title
                                </h3>
                                </a>
                                <p>
                                    $product_price Triệu
                                </p>
                            </div>
                        </div>

                        ";
                    }
                    ?>

                </div>
            </form>

        </div>
    </div>
</div>
</div>

<?php

include('footer.php')

?>