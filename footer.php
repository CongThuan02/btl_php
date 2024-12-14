<div class="footer">
    <div class="footer__container">
        <div class="footer__box">
            <div class="footer__menu">
                <div class="footer__title">
                    <h3>Menu</h3>
                </div>
                <ul class="footer__list">
                    <li class="footer__item">
                        <a href="cart.php" class="footer__link">
                            Giỏ hàng
                        </a>
                    </li>
                    <li class="footer__item">
                        <a href="contact.php" class="footer__link">
                            Liên hệ
                        </a>
                    </li>
                    <li class="footer__item">
                        <a href="shop.php" class="footer__link">
                            Cửa hàng
                        </a>
                    </li>
                    <!-- <li class="footer__item">
                        <a href="user_checkout.php" class="footer__link">
                            Tài khoản
                        </a>
                    </li> -->
                </ul>
            </div>
            <div class="footer__user">
                <div class="footer__title">
                    <h3>Người dùng</h3>
                </div>
                <ul class="footer__list">
                    <li class="footer__item">
                        <a href="register.php" class="footer__link">
                            Đăng kí
                        </a>
                    </li>
                    <!-- <li class="footer__item">
                        <a href="user_checkout.php" class="footer__link">
                            Đăng nhập
                        </a>
                    </li> -->
                    <li class="footer__item">
                        <a href="user_terms.php" class="footer__link">
                            Điều khoản
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer__box">
            <div class="footer__product">
                <div class="footer__title">
                    <h3>Danh mục sản phẩm hàng đầu</h3>
                </div>
                <ul class="footer__list">
                    <!-- hiện thị ra danh mục sản phẩm -->
                    <?php

                    $sql = "select * from product_categories";

                    $res = mysqli_query($con, $sql);

                    while ($row = mysqli_fetch_array($res)) {

                        $p_cat_id = $row['p_cat_id'];

                        $p_cat_title = $row['p_cat_title'];
                        echo "
                            <li class='footer__item'>
                                <a href='shop.php?p_cat=$p_cat_id' class='footer__link'>
                                    $p_cat_title
                                </a>
                            </li>
                        
                        ";
                    }

                    ?>
                </ul>
            </div>
        </div>

        <div class="footer__box">
            <div class="footer__news">
                <div class="footer__product">
                    <div class="footer__title">
                        <h3>Tin tức sản phẩm mới</h3>
                        <h5>Đừng bỏ Nama bất kì sản phẩm nào của chúng tôi</h5>
                        <!-- feedburner -->
                        <form action="" class="footer__form">
                            <input type="text">
                            <input type="submit">
                        </form>
                    </div>
                </div>
                <div class="footer__contact">
                    <div class="footer__title">
                        <h3>Liên hệ</h3>
                    </div>
                    <div class="footer__icons">
                        <?php 
                        $sql = "SELECT * FROM `network`";
                        $res= mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_array($res)){
                            $icon = $row['icon'];
                            $link = $row['link'];
                            echo "
                            <a href='$link' class='footer__icon'>
                                <i class='fa fa-$icon'></i>
                            </a>
                            ";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="copyright">
    <div class="copyright__container">
        <span>
            &copy;2021
        </span>
   
    </div>
</div>
<div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>
<div class="index__switch">
    <div class="index__circle"></div>
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
<script src="js/index.js"></script>
<script src="js/light_and_dark.js"></script>
<script src="js/to_top.js"></script>
</body>

</html>