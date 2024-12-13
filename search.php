<?php
$active = 'Shop';
include('header.php')

?>
<div class="main">
    <div class="shop">
        <div class="shop__container">
            <ul class="shop__breadcroumb">
                <li><a href="index.php">Trang Chủ</a></li>
                <li>Cửa Hàng</li>
            </ul>
            <?php
            include('sidebar.php')
            ?>
            <div class="shop__content">
                <h1 style="text-align: center;">
                    Tìm kiếm sản phẩm liên quan đến :<?php
                                    echo $_SESSION['search'];
                                    ?>
                </h1>
                <div class='shop__product'>
                    <?php
                    $search = $_SESSION['search'];
                    $sql = "SELECT * FROM `product` where product_keywords like '%$search%'";
                    $res = mysqli_query($con, $sql);
                    $count = mysqli_num_rows($res);
                    if ($count <= 0) {
                        echo " <h1 style='text-align: center;'>
                    Không có sản phẩm nào
                    </h1>
                    ";
                    } else {
                        while ($row = mysqli_fetch_array($res)) {
                            $product_id = $row['product_id'];
                            $product_title = $row['product_title'];
                            $product_price = $row['product_price'];
                            $product_img = $row['product_img'];
                            // echo $product_id;
                            echo "
                        <div class='content__product'>
                            <a href='details.php?product_id=$product_id' class='content__link'>
                                <img src='image/$product_img' alt=''>
                            </a>
                            <div class='context__text'>
                                <h3>
                                    $product_title
                                </h3>
                                <p>
                                    $product_price Triệu
                                </p>
                                <p class='content__btn'>
                                    <a href='details.php?product_id=$product_id'>
                                        Xem chi tiết
                                    </a>
                                </p>
                            </div>
                        </div>
                        ";
                        }
                    }


                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>

<?php

include('footer.php')

?>
