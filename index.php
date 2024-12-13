<?php
$active = 'Home';
include('header.php');
?>
<div class="main">
 
    <div class="advantages">
        <div class="advantages__container">
            <?php 
            $sql= "SELECT * FROM `box` order by id DESC LIMIT 0,3";
            $res = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($res)) {   
                $title= $row['title'];
                $icon= $row['icon'];
               echo" <div class='advantages__box'>
                    <div class='advantages__icon'>
                        <i class='fa fa-$icon'></i>
                    </div>
                    <h3>
                        <a href='#'>$title</a>
                    </h3>
                </div>
                ";
            }
            ?>
        </div>
    </div>
    <div class="hot">
        <div class="hot__container">
            <h2 class="hot__title">
                Sản Phẩm Mới Nhất
            </h2>
        </div>
    </div>
    <div class="content">
        <div class="content__container">
            <!-- hiện thị ra 8 sản -->
            <?php
            $sql = "SELECT * FROM product order by 1 DESC LIMIT 0,8";
            $res = mysqli_query($con, $sql);
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
            ?>
        </div>
    </div>
</div>
<?php
include('footer.php');
?>