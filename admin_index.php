<!-- Bảng điều khiển
-->
<?php
include('admin_header.php');
include('admin_sidebar.php');
?>

<div class="container">
    <div class="title">Bảng điều khiển</div>
    <?php 
    $sql= "SELECT * FROM `user`";
    $res = mysqli_query($con, $sql);
    $count = mysqli_num_rows($res);
    $sql_2= "SELECT * FROM `product`";
    $res_2 = mysqli_query($con, $sql_2);
    $count_2 = mysqli_num_rows($res_2);
    $sql_3= "SELECT * FROM `order`";
    $res_3 = mysqli_query($con, $sql_3);
    $count_3 = mysqli_num_rows($res_3);
    $sql_4= "SELECT * FROM `pay`";
    $res_4 = mysqli_query($con, $sql_4);
    $count_4 = mysqli_num_rows($res_4);
    ?>
    <div style="display:flex;">
        <div class="box">
            <div class="box__left">
                <a href="admin_user_view.php">Người dùng</a>
            </div>
            <div class="box__right">
                <?php 
            echo $count;
            ?>
            </div>
        </div>
        <div class="box">
            <div class="box__left">
                <a href="admin_product_view.php">Sản phẩm</a>
            </div>
            <div class="box__right">
                <?php 
            echo $count_2;
            ?>
            </div>
        </div>
        <div class="box">
            <div class="box__left">
                <a href="admin_order_view.php">Hóa đơn</a>
            </div>
            <div class="box__right">
                <?php 
            echo $count_3;
            ?>
            </div>
        </div>
        <div class="box">
            <div class="box__left">
                <a href="admin_pay_view.php">Thanh toán</a>
            </div>
            <div class="box__right">
                <?php 
            echo $count_4;
            ?>
            </div>
        </div>
    </div>
</div>

<?php
include('admin_footer.php');
?>