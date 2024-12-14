<?php
$active = 'Home';
include('header.php');
?>
<style>/* Các kiểu cho toàn bộ trang */
/* Các kiểu cho toàn bộ trang */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

/* Phần container chính */
.main {
    padding: 30px 15px;
    background-color: #fff;
}

/* Phần Advantages (Lợi ích) */
.advantages {
    margin-bottom: 30px;
    padding: 50px 0;
    background-color: #f9f9f9;
}

.advantages__container {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
}

.advantages__box {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
  
    width: 30%;
    text-align: center;
    margin-bottom: 20px;
    transition: transform 0.3s ease-in-out;
}

.advantages__box:hover {
    transform: translateY(-10px);
}

.advantages__icon {
    font-size: 40px;
    color: #2d9cdb;
    margin-bottom: 15px;
}

.advantages__box h3 {
    font-size: 20px;
    color: #333;
    margin-bottom: 10px;
}

.advantages__box a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
}

/* Phần Sản phẩm Hot (Mới Nhất) */
.hot {
    background-color: #2d9cdb;
    color: #fff;
    padding: 20px 0;
    text-align: center;
}

.hot__title {
    font-size: 30px;
    font-weight: 600;
}

/* Phần Content - Hiển thị sản phẩm */
.content {
    padding: 30px 0;
}

.content__container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.content__product {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    width: 23%;
    margin-bottom: 20px;
    transition: transform 0.3s ease-in-out;
}

.content__product:hover {
    transform: translateY(-10px);
}

.content__link img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 8px;
}

.context__text {
    padding: 10px;
}

.context__text h3 {
    font-size: 18px;
    color: #333;
    margin-bottom: 10px;
}

.context__price {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.context__price p {
    font-size: 16px;
    color: #2d9cdb;
    font-weight: bold;
}

.context__badge {
    background-color: #2d9cdb;
    color: white;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 12px;
}

.content__btn a {
    display: inline-block;
    padding: 10px 15px;
    background-color: #2d9cdb;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
}

.content__btn a:hover {
    background-color: #1a7b9e;
}

/* Responsive design */
@media (max-width: 768px) {
    .advantages__box {
        width: 45%;
    }

    .content__product {
        width: 48%;
    }
}

@media (max-width: 480px) {
    .advantages__box {
        width: 100%;
    }

    .content__product {
        width: 100%;
    }
}</style>
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
            <!-- hiện thị ra 8 sản phẩm -->
            <?php
            $sql = "SELECT * FROM product order by 1 DESC LIMIT 0,8";
            $res = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($res)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_price = $row['product_price'];
                $product_img = $row['product_img'];
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