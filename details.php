<?php
$active = 'Cart';
include('header.php');
?>

<?php
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $sql = "SELECT * FROM product WHERE product_id='$product_id'";
    $res = mysqli_query($con, $sql);
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_array($res);
        $p_cat_id = $row['p_cat_id'];
        $product_title = $row['product_title'];
        $product_price = $row['product_price'];
        $product_desc = $row['product_desc'];
        $product_img = $row['product_img'];

        $sql_2 = "SELECT * FROM `product_categories` WHERE p_cat_id='$p_cat_id'";
        $res_2 = mysqli_query($con, $sql_2);
        if (mysqli_num_rows($res_2) > 0) {
            $row_2 = mysqli_fetch_array($res_2);
            $p_cat_title = $row_2['p_cat_title'];
        } else {
            // Nếu không tìm thấy danh mục, có thể thông báo lỗi hoặc gán giá trị mặc định
            $p_cat_title = "Danh mục không xác định";
        }
    } else {
        // Nếu không tìm thấy sản phẩm, có thể thông báo lỗi hoặc chuyển hướng người dùng
        echo "<script>alert('Sản phẩm không tồn tại.');</script>";
        echo "<script>window.location = 'shop.php';</script>";
    }
}
?>

<div class="main">
    <div class="shop">
        <div class="shop__container">
            <ul class="shop__breadcroumb">
                <li><a href="index.php">Trang Chủ</a></li>
                <li>Shop</li>
                <li>
                    <a href="shop.php?p_cat=<?php echo $p_cat_id; ?>"><?php echo $p_cat_title; ?></a>
                </li>
                <li> <?php echo isset($product_title) ? $product_title : ''; ?> </li>
            </ul>
            <?php
            include('sidebar.php');
            ?>
            <div class="details">
                <div class="details__img">
                    <a href="shop.php">
                        <img src="image/<?php echo isset($product_img) ? $product_img : ''; ?>" alt="">
                    </a>
                </div>
                <div class="detail__right">
                    <!-- thêm mặt hàng vào giỏ hàng ,nếu có trong giỏ hàng rồi thì báo trùng -->
                    <?php
                    if (isset($_GET['add_cart'])) {
                        $p_id = $_GET['add_cart'];
                        $ip_add = getRealIpUser();
                  
                        $sql = "SELECT * FROM cart WHERE ip_add='$ip_add' AND p_id='$p_id'";
                        $res = mysqli_query($con, $sql);
                        if (mysqli_num_rows($res) > 0) {
                            echo "<script>alert('Sản phẩm này đã được thêm vào giỏ hàng')</script>";
                            echo "<script>window.open('details.php?product_id=$p_id','_self')</script>";
                        } else {
                            $sql_2 = "INSERT INTO cart (p_id, ip_add )
                                      VALUES ('$p_id', '$ip_add')";
                            $res_2 = mysqli_query($con, $sql_2);
                            echo "<script>window.open('details.php?product_id=$p_id','_self')</script>";
                        }
                    }
                    ?>
                    <form class="detail__box" style="text-align: left; padding-left: 50px" action="details.php?add_cart=<?php echo $product_id; ?>" method="post">
                        <div class="details__desc">
                            <h2>Tên sản phẩm: <?php echo isset($product_title) ? $product_title : ''; ?></h2>
                            <h3 style="text-align: left;"><?php echo "Mô tả sản phẩm"; ?></h3>
                            <h6 style="text-align: left;"><?php echo isset($product_desc) ? $product_desc : ''; ?></h6>
                        </div>

                        <div class="details__center">
                            <div class="details__price">
                               Giá xe <?php echo isset($product_price) ? $product_price : ''; ?> Triệu
                            </div>
                            <div class="details__button">
                                <button type="submit" class="fa fa-shopping-cart">
                                    THÊM VÀO GIỎ HÀNG
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="details__tt">
                        <?php
                        $sql = "SELECT * FROM product ORDER BY rand() LIMIT 3";
                        $res = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_array($res)) {
                            $product_id = $row['product_id'];
                            $product_title = $row['product_title'];
                            $product_img = $row['product_img'];
                            $product_price = $row['product_price'];
                            echo "
                            <div class='details__img'>
                                <a href='details.php?product_id=$product_id'>
                                    <img src='image/$product_img' alt=''>
                                </a>
                                <div>
                                <h3> <a href='details.php?product_id=$product_id'> $product_title </a> </h3>
                                <p class='price'> $product_price Triệu </p>
                                </div>
                            </div>
                            ";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('footer.php');
?>